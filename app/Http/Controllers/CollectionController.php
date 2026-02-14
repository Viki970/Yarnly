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
}