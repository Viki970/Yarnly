<?php

namespace App\Http\Controllers;

use App\Models\CrochetPattern;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatternController extends Controller
{
    public function crochet()
    {
        $newest = CrochetPattern::latest()->limit(6)->get();
        
        // Calculate patterns created this week
        $startOfWeek = now()->startOfWeek();
        $endOfWeek = now()->endOfWeek();
        $newThisWeek = CrochetPattern::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
        
        // Count user's favorited patterns
        $favoritesCount = 0;
        if (Auth::check()) {
            /** @var User $user */
            $user = Auth::user();
            $favoritesCount = $user->favoritePatterns()->count();
        }
        
        return view('crochet_patterns', [
            'newest' => $newest, 
            'selectedCategory' => null,
            'newThisWeek' => $newThisWeek,
            'favoritesCount' => $favoritesCount
        ]);
    }

    public function crochetByCategory($category)
    {
        $validCategories = ['blankets', 'amigurumi', 'bags', 'wearables', 'home-decor'];
        
        if (!in_array($category, $validCategories)) {
            return redirect()->route('patterns.crochet');
        }

        $patterns = CrochetPattern::where('category', $category)->latest()->get();
        $newest = CrochetPattern::latest()->limit(6)->get();
        
        // Calculate patterns created this week
        $startOfWeek = now()->startOfWeek();
        $endOfWeek = now()->endOfWeek();
        $newThisWeek = CrochetPattern::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
        
        // Count user's favorited patterns
        $favoritesCount = 0;
        if (Auth::check()) {
            /** @var User $user */
            $user = Auth::user();
            $favoritesCount = $user->favoritePatterns()->count();
        }
        
        return view('crochet_patterns', [
            'patterns' => $patterns,
            'newest' => $newest,
            'selectedCategory' => $category,
            'newThisWeek' => $newThisWeek,
            'favoritesCount' => $favoritesCount
        ]);
    }

    public function view(CrochetPattern $pattern)
    {
        if (!$pattern->pdf_file) {
            return redirect()->back()->with('error', 'Pattern PDF not available');
        }

        return view('pattern_viewer', [
            'pattern' => $pattern,
            'pdfPath' => asset('storage/' . $pattern->pdf_file)
        ]);
    }

    public function download(CrochetPattern $pattern)
    {
        if (!$pattern->pdf_file) {
            return redirect()->back()->with('error', 'Pattern PDF not available');
        }

        $filePath = storage_path('app/public/' . $pattern->pdf_file);
        
        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'Pattern file not found');
        }

        $originalFilename = $pattern->original_filename ?: 'pattern.pdf';
        
        return response()->download($filePath, $originalFilename);
    }

    public function create()
    {
        return view('patterns.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'category' => 'required|in:blankets,amigurumi,bags,wearables,home-decor',
                'difficulty' => 'required|in:beginner,intermediate,advanced',
                'estimated_hours' => 'nullable|integer|min:1|max:200',
                'tags' => 'nullable|string|max:500',
                'pdf_file' => 'required|file|mimes:pdf|max:10240', // Max 10MB
                'image_file' => 'nullable|file|mimes:png,jpg,jpeg|max:5120', // Max 5MB
            ]);

            $pdfFile = $request->file('pdf_file');
            
            // Check MIME type
            if ($pdfFile->getMimeType() !== 'application/pdf') {
                return back()->withInput()->with('error', 'File must be a PDF. Detected type: ' . $pdfFile->getMimeType());
            }

            // Store PDF with original filename preserved
            $originalPdfName = $pdfFile->getClientOriginalName();
            $pdfPath = $pdfFile->store('patterns/pdfs', 'public');
            if (!$pdfPath) {
                return back()->withInput()->with('error', 'Failed to store PDF file on server.');
            }

            $imagePath = null;
            if ($request->hasFile('image_file')) {
                $imageFile = $request->file('image_file');
                if ($imageFile->isValid()) {
                    $imagePath = $imageFile->store('patterns/images', 'public');
                }
            }

            // Process tags - clean up and format
            $tags = null;
            if ($request->filled('tags')) {
                $tagsArray = array_map('trim', explode(',', $request->tags));
                $tagsArray = array_filter($tagsArray, function($tag) {
                    return !empty($tag) && strlen($tag) <= 50;
                });
                $tags = implode(', ', $tagsArray);
            }

            CrochetPattern::create([
                'title' => $request->title,
                'description' => $request->description,
                'category' => $request->category,
                'difficulty' => $request->difficulty,
                'estimated_hours' => $request->estimated_hours,
                'tags' => $tags,
                'pdf_file' => $pdfPath,
                'original_filename' => $originalPdfName,
                'image_path' => $imagePath,
                'user_id' => Auth::id(),
                'makers_saved' => 0,
            ]);

            return redirect()->route('my-patterns')->with('success', 'Pattern created successfully!');
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withInput()->withErrors($e->errors());
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Failed to upload pattern. Error: ' . $e->getMessage());
        }
    }

    public function myPatterns()
    {
        $patterns = CrochetPattern::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('patterns.my-patterns', compact('patterns'));
    }

    /**
     * Toggle favorite status of a pattern for the authenticated user
     */
    public function toggleFavorite(CrochetPattern $pattern)
    {
        /** @var User $user */
        $user = Auth::user();
        
        if ($user->hasFavorited($pattern)) {
            // Unfavorite
            $user->favoritePatterns()->detach($pattern->id);
            $pattern->decrement('makers_saved');
            $favorited = false;
        } else {
            // Favorite
            $user->favoritePatterns()->attach($pattern->id);
            $pattern->increment('makers_saved');
            $favorited = true;
        }
        
        return response()->json([
            'success' => true,
            'favorited' => $favorited,
            'makers_saved' => $pattern->fresh()->makers_saved
        ]);
    }

    /**
     * Display the user's favorite patterns
     */
    public function favorites()
    {
        /** @var User $user */
        $user = Auth::user();
        $favoritePatterns = $user->favoritePatterns()
            ->latest('user_favorites.created_at')
            ->get();

        return view('patterns.favorites', compact('favoritePatterns'));
    }
}
