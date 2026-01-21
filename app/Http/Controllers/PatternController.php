<?php

namespace App\Http\Controllers;

use App\Models\CrochetPattern;
use Illuminate\Http\Request;

class PatternController extends Controller
{
    public function crochet()
    {
        $featured = CrochetPattern::where('featured', true)->limit(3)->get();
        return view('crochet_patterns', ['featured' => $featured, 'selectedCategory' => null]);
    }

    public function crochetByCategory($category)
    {
        $validCategories = ['blankets', 'amigurumi', 'bags', 'wearables', 'home-decor'];
        
        if (!in_array($category, $validCategories)) {
            return redirect()->route('patterns.crochet');
        }

        $patterns = CrochetPattern::where('category', $category)->get();
        $featured = CrochetPattern::where('featured', true)->limit(3)->get();
        
        return view('crochet_patterns', [
            'patterns' => $patterns,
            'featured' => $featured,
            'selectedCategory' => $category,
        ]);
    }
}
