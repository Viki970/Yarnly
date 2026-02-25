<?php

namespace App\Http\Controllers;

use App\Models\CrochetPattern;
use App\Models\Collection;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        
        // Get public collections with patterns and users
        $collections = Collection::where('is_public', true)
            ->with(['patterns', 'user'])
            ->latest()
            ->limit(6)
            ->get();
        
        return view('patterns.crochet.crochet_patterns', [
            'newest' => $newest, 
            'selectedCategory' => null,
            'newThisWeek' => $newThisWeek,
            'favoritesCount' => $favoritesCount,
            'collections' => $collections
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
        
        // Get public collections with patterns and users
        $collections = Collection::where('is_public', true)
            ->with(['patterns', 'user'])
            ->latest()
            ->limit(6)
            ->get();
        
        return view('patterns.crochet.crochet_patterns', [
            'patterns' => $patterns,
            'newest' => $newest,
            'selectedCategory' => $category,
            'newThisWeek' => $newThisWeek,
            'favoritesCount' => $favoritesCount,
            'collections' => $collections
        ]);
    }

    public function knitting()
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
        
        // Get public collections with patterns and users  (knitting type)
        $collections = Collection::where('is_public', true)
            ->where('craft_type', 'knitting')
            ->with(['patterns', 'user'])
            ->latest()
            ->limit(6)
            ->get();
        
        return view('patterns.knitting.knitting_patterns', [
            'newest' => $newest, 
            'selectedCategory' => null,
            'newThisWeek' => $newThisWeek,
            'favoritesCount' => $favoritesCount,
            'collections' => $collections
        ]);
    }

    public function knittingByCategory($category)
    {
        $validCategories = ['sweaters', 'scarves', 'accessories', 'socks', 'hats'];
        
        if (!in_array($category, $validCategories)) {
            return redirect()->route('patterns.knitting');
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
        
        // Get public collections with patterns and users (knitting type)
        $collections = Collection::where('is_public', true)
            ->where('craft_type', 'knitting')
            ->with(['patterns', 'user'])
            ->latest()
            ->limit(6)
            ->get();
        
        return view('patterns.knitting.knitting_patterns', [
            'patterns' => $patterns,
            'newest' => $newest,
            'selectedCategory' => $category,
            'newThisWeek' => $newThisWeek,
            'favoritesCount' => $favoritesCount,
            'collections' => $collections
        ]);
    }

    public function view(CrochetPattern $pattern)
    {
        if (!$pattern->pdf_file) {
            return redirect()->back()->with('error', 'Pattern PDF not available');
        }

        return view('patterns.crochet.pattern_viewer', [
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
        return view('patterns.crochet.create');
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

        return view('profile.my-patterns', compact('patterns'));
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
    public function favorites(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();
        
        // Get filter parameters
        $tab = $request->get('tab', 'patterns'); // patterns or collections
        $craftFilter = $request->get('filter', 'all'); // all, crochet, knitting, embroidery
        
        // Get all favorite patterns
        $allFavoritePatterns = $user->favoritePatterns()
            ->latest('user_favorites.created_at')
            ->get();
        
        // Get all favorite collections
        $allFavoriteCollections = $user->favoriteCollections()
            ->latest('collection_favorites.created_at')
            ->get();
        
        // Count totals
        $totalFavorites = $allFavoritePatterns->count() + $allFavoriteCollections->count();
        $totalPatterns = $allFavoritePatterns->count();
        $totalCollections = $allFavoriteCollections->count();
        
        // Group patterns by craft type
        $crochetPatterns = $allFavoritePatterns->where('craft_type', 'crochet');
        $knittingPatterns = $allFavoritePatterns->where('craft_type', 'knitting');
        $embroideryPatterns = $allFavoritePatterns->where('craft_type', 'embroidery');
        
        // Group collections by craft type
        $crochetCollections = $allFavoriteCollections->where('craft_type', 'crochet');
        $knittingCollections = $allFavoriteCollections->where('craft_type', 'knitting');
        $embroideryCollections = $allFavoriteCollections->where('craft_type', 'embroidery');
        
        // Apply craft type filter for patterns
        if ($craftFilter === 'all') {
            $favoritePatterns = $allFavoritePatterns;
        } else {
            $favoritePatterns = $allFavoritePatterns->where('craft_type', $craftFilter);
        }
        
        // Apply craft type filter for collections
        if ($craftFilter === 'all') {
            $favoriteCollections = $allFavoriteCollections;
        } else {
            $favoriteCollections = $allFavoriteCollections->where('craft_type', $craftFilter);
        }
        
        return view('profile.favorites', compact(
            'favoritePatterns',
            'favoriteCollections',
            'totalFavorites',
            'totalPatterns',
            'totalCollections',
            'crochetPatterns',
            'knittingPatterns',
            'embroideryPatterns',
            'crochetCollections',
            'knittingCollections',
            'embroideryCollections',
            'tab',
            'craftFilter'
        ));
    }

    /**
     * Delete a pattern
     */
    public function destroy(CrochetPattern $pattern)
    {
        // Ensure only the owner can delete the pattern
        if ($pattern->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'You are not authorized to delete this pattern.');
        }

        // Delete associated files
        if ($pattern->image_path) {
            Storage::disk('public')->delete($pattern->image_path);
        }
        if ($pattern->pdf_path) {
            Storage::disk('public')->delete($pattern->pdf_path);
        }

        // Delete the pattern
        $pattern->delete();

        return redirect()->route('my-patterns')->with('success', 'Pattern deleted successfully!');
    }
}
