<?php

namespace App\Http\Controllers;

use App\Models\CrochetPattern;
use Illuminate\Http\Request;

class PatternController extends Controller
{
    public function crochet()
    {
        $newest = CrochetPattern::latest()->limit(6)->get();
        
        // Calculate patterns created this week
        $startOfWeek = now()->startOfWeek();
        $endOfWeek = now()->endOfWeek();
        $newThisWeek = CrochetPattern::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
        
        return view('crochet_patterns', [
            'newest' => $newest, 
            'selectedCategory' => null,
            'newThisWeek' => $newThisWeek
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
        
        return view('crochet_patterns', [
            'patterns' => $patterns,
            'newest' => $newest,
            'selectedCategory' => $category,
            'newThisWeek' => $newThisWeek
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
}
