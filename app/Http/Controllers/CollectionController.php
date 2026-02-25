<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CollectionController extends Controller
{
    /**
     * Display the user's collections
     */
    public function myCollections(Request $request)
    {
        $filter = $request->get('filter', 'all');
        
        $collections = Collection::where('user_id', Auth::id())
            ->latest()
            ->with(['patterns', 'user']) // Eager load patterns and user for efficiency
            ->get();

        // Group collections by craft type
        $crochetCollections = $collections->where('craft_type', 'crochet');
        $knittingCollections = $collections->where('craft_type', 'knitting');
        $embroideryCollections = $collections->where('craft_type', 'embroidery');

        return view('profile.my-collections', compact('collections', 'crochetCollections', 'knittingCollections', 'embroideryCollections', 'filter'));
    }

    /**
     * Show pattern selection page for creating a collection
     */
    public function selectPatterns()
    {
        $patterns = \App\Models\Pattern::where('user_id', Auth::id())
            ->latest()
            ->get();

        $collections = Collection::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('collections.select-patterns', compact('patterns', 'collections'));
    }

    /**
     * Show the form for creating a new collection
     */
    public function create(Request $request)
    {
        $patternIds = $request->input('patterns', []);
        
        if (empty($patternIds)) {
            return redirect()->route('collections.select-patterns')
                ->with('error', 'Please select at least one pattern for your collection.');
        }

        $patterns = \App\Models\Pattern::whereIn('id', $patternIds)
            ->where('user_id', Auth::id())
            ->get();

        return view('collections.create', compact('patterns', 'patternIds'));
    }

    /**
     * Store a newly created collection in the database
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'is_public' => 'required|boolean',
            'craft_type' => 'required|in:crochet,knitting,embroidery',
            'pattern_ids' => 'required|array|min:1',
            'pattern_ids.*' => 'exists:patterns,id',
        ]);

        // Handle cover image upload
        $coverImagePath = null;
        if ($request->hasFile('cover_image')) {
            $coverImagePath = $request->file('cover_image')->store('collections/covers', 'public');
        }

        // Create the collection
        $collection = Collection::create([
            'name' => $request->name,
            'description' => $request->description,
            'craft_type' => $request->craft_type,
            'cover_image_path' => $coverImagePath,
            'is_public' => $request->is_public,
            'user_id' => Auth::id(),
        ]);

        // Attach patterns to collection
        $collection->patterns()->attach($request->pattern_ids);

        return redirect()->route('my-collections')
            ->with('success', 'Collection created successfully!');
    }

    /**
     * Display a single collection with its patterns
     */
    public function show(Collection $collection)
    {
        // Load the collection with its patterns and user (author)
        $collection->load(['patterns', 'user']);

        return view('collections.show', compact('collection'));
    }

    /**
     * Show the form for editing a collection
     */
    public function edit(Collection $collection)
    {
        // Verify that the collection belongs to the authenticated user
        if ($collection->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('collections.edit', compact('collection'));
    }

    /**
     * Update the specified collection in storage
     */
    public function update(Request $request, Collection $collection)
    {
        // Verify that the collection belongs to the authenticated user
        if ($collection->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'is_public' => 'required|boolean',
            'craft_type' => 'required|in:crochet,knitting,embroidery',
        ]);

        // Handle cover image upload
        $coverImagePath = $collection->cover_image_path;
        
        // Upload new cover image if provided
        if ($request->hasFile('cover_image')) {
            // Delete old cover image if it exists
            if ($coverImagePath && Storage::disk('public')->exists($coverImagePath)) {
                Storage::disk('public')->delete($coverImagePath);
            }
            $coverImagePath = $request->file('cover_image')->store('collections/covers', 'public');
        }

        // Update the collection
        $collection->update([
            'name' => $request->name,
            'description' => $request->description,
            'craft_type' => $request->craft_type,
            'cover_image_path' => $coverImagePath,
            'is_public' => $request->is_public,
        ]);

        return redirect()->route('collections.show', $collection)
            ->with('success', 'Collection updated successfully!');
    }

    /**
     * Remove the cover image from a collection
     */
    public function removeCover(Collection $collection)
    {
        // Verify that the collection belongs to the authenticated user
        if ($collection->user_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized action.'], 403);
        }

        // Delete the cover image if it exists
        if ($collection->cover_image_path && Storage::disk('public')->exists($collection->cover_image_path)) {
            Storage::disk('public')->delete($collection->cover_image_path);
        }

        // Update the collection to remove the cover image path
        $collection->update([
            'cover_image_path' => null,
        ]);

        return response()->json(['success' => true, 'message' => 'Cover image removed successfully!']);
    }

    /**
     * Show the form for editing patterns in a collection
     */
    public function editPatterns(Collection $collection)
    {
        // Verify that the collection belongs to the authenticated user
        if ($collection->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Get all patterns belonging to the user
        $patterns = \App\Models\Pattern::where('user_id', Auth::id())
            ->latest()
            ->get();

        // Get IDs of patterns currently in the collection
        $collectionPatternIds = $collection->patterns->pluck('id');

        return view('collections.edit-patterns', compact('collection', 'patterns', 'collectionPatternIds'));
    }

    /**
     * Update the patterns in a collection
     */
    public function updatePatterns(Request $request, Collection $collection)
    {
        // Verify that the collection belongs to the authenticated user
        if ($collection->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'pattern_ids' => 'nullable|array',
            'pattern_ids.*' => 'exists:patterns,id',
        ]);

        // Get the pattern IDs from the request (empty array if none selected)
        $patternIds = $request->input('pattern_ids', []);

        // Verify that all patterns belong to the authenticated user
        if (!empty($patternIds)) {
            $userPatternCount = \App\Models\Pattern::whereIn('id', $patternIds)
                ->where('user_id', Auth::id())
                ->count();

            if ($userPatternCount !== count($patternIds)) {
                abort(403, 'Unauthorized action.');
            }
        }

        // Sync the patterns with the collection
        $collection->patterns()->sync($patternIds);

        return redirect()->route('collections.show', $collection)
            ->with('success', 'Collection patterns updated successfully!');
    }

    /**
     * Add patterns to an existing collection
     */
    public function addPatternsToExisting(Request $request, Collection $collection)
    {
        // Verify that the collection belongs to the authenticated user
        if ($collection->user_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized action.'], 403);
        }

        $request->validate([
            'pattern_ids' => 'required|array|min:1',
            'pattern_ids.*' => 'exists:patterns,id',
        ]);

        $patternIds = $request->input('pattern_ids');

        // Verify that all patterns belong to the authenticated user
        $userPatternCount = \App\Models\Pattern::whereIn('id', $patternIds)
            ->where('user_id', Auth::id())
            ->count();

        if ($userPatternCount !== count($patternIds)) {
            return response()->json(['success' => false, 'message' => 'Unauthorized action.'], 403);
        }

        // Get existing pattern IDs in the collection
        $existingPatternIds = $collection->patterns()->pluck('pattern_id')->toArray();

        // Attach only new patterns (avoid duplicates)
        $newPatternIds = array_diff($patternIds, $existingPatternIds);
        
        if (!empty($newPatternIds)) {
            $collection->patterns()->attach($newPatternIds);
            $count = count($newPatternIds);
            return response()->json([
                'success' => true, 
                'message' => "$count pattern(s) added to collection successfully!",
                'count' => $count
            ]);
        } else {
            return response()->json([
                'success' => true, 
                'message' => 'All selected patterns are already in this collection.',
                'count' => 0
            ]);
        }
    }

    /**
     * Download all patterns in a collection as a ZIP file
     */
    public function downloadAll(Collection $collection)
    {
        // Load the collection's patterns
        $collection->load('patterns');

        // Filter patterns that have PDF files
        $patternsWithPdf = $collection->patterns->filter(function ($pattern) {
            return !empty($pattern->pdf_file);
        });

        if ($patternsWithPdf->isEmpty()) {
            return redirect()->back()->with('error', 'No patterns with PDF files found in this collection.');
        }

        // Create a temporary directory for the ZIP file
        $zipFileName = str_replace(' ', '_', $collection->name) . '_patterns.zip';
        $zipPath = storage_path('app/temp/' . $zipFileName);
        
        // Ensure temp directory exists
        if (!file_exists(storage_path('app/temp'))) {
            mkdir(storage_path('app/temp'), 0755, true);
        }

        // Create ZIP archive
        $zip = new \ZipArchive();
        if ($zip->open($zipPath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) !== true) {
            return redirect()->back()->with('error', 'Could not create ZIP file.');
        }

        // Add each pattern's PDF to the ZIP
        foreach ($patternsWithPdf as $pattern) {
            $pdfPath = storage_path('app/public/' . $pattern->pdf_file);
            
            if (file_exists($pdfPath)) {
                $filename = $pattern->original_filename ?: ($pattern->title . '.pdf');
                // Make sure the filename is unique and safe
                $filename = preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $filename);
                $zip->addFile($pdfPath, $filename);
            }
        }

        $zip->close();

        // Return the ZIP file as a download and delete after sending
        return response()->download($zipPath, $zipFileName)->deleteFileAfterSend(true);
    }

    /**
     * Remove the specified collection from storage
     */
    public function destroy(Collection $collection)
    {
        // Verify that the collection belongs to the authenticated user
        if ($collection->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Delete the collection (relationships in collection_pattern will be automatically deleted)
        $collection->delete();

        return redirect()->route('my-collections')
            ->with('success', 'Collection deleted successfully!');
    }

    /**
     * Toggle favorite status for a collection
     */
    public function toggleFavorite(Collection $collection)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        if ($user->hasFavoritedCollection($collection)) {
            // Unfavorite
            $user->favoriteCollections()->detach($collection->id);
            $favorited = false;
        } else {
            // Favorite
            $user->favoriteCollections()->attach($collection->id);
            $favorited = true;
        }
        
        return response()->json([
            'success' => true,
            'favorited' => $favorited,
            'favorites_count' => $collection->fresh()->favorites_count
        ]);
    }
}