<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CollectionController extends Controller
{
    /**
     * Display the user's collections
     */
    public function myCollections()
    {
        $collections = Collection::where('user_id', Auth::id())
            ->latest()
            ->with('patterns') // Eager load patterns for efficiency
            ->get();

        // Group collections by craft type
        $crochetCollections = $collections->where('craft_type', 'crochet');
        $knittingCollections = $collections->where('craft_type', 'knitting');
        $embroideryCollections = $collections->where('craft_type', 'embroidery');

        return view('collections.my-collections', compact('collections', 'crochetCollections', 'knittingCollections', 'embroideryCollections'));
    }

    /**
     * Show pattern selection page for creating a collection
     */
    public function selectPatterns()
    {
        $patterns = \App\Models\CrochetPattern::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('collections.select-patterns', compact('patterns'));
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

        $patterns = \App\Models\CrochetPattern::whereIn('id', $patternIds)
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
            'pattern_ids.*' => 'exists:crochet_patterns,id',
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
}