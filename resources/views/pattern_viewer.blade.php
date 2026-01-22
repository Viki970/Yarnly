@extends('layout.app')

@section('title', $pattern->title . ' - Yarnly Pattern Viewer')

@section('content')
<style>
    /* Make PDF viewer full-screen like a real PDF page */
    .pdf-container {
        width: 100%;
        height: 100vh;
        border: none;
        border-radius: 0;
        overflow: hidden;
        background: #404040;
    }
    
    .pdf-container iframe {
        width: 100%;
        height: 100%;
        border: none;
        background: white;
    }
</style>

<section class="bg-white py-12 dark:bg-zinc-900">
    <div class="max-w-6xl mx-auto px-6 lg:px-12">
        <!-- Header -->
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between mb-8">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <div class="rounded-lg px-3 py-1 text-xs font-semibold @if($pattern->difficulty === 'beginner') bg-emerald-100 text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-200 @elseif($pattern->difficulty === 'intermediate') bg-teal-100 text-teal-800 dark:bg-teal-900/40 dark:text-teal-200 @else bg-orange-100 text-orange-800 dark:bg-orange-900/40 dark:text-orange-200 @endif">
                        {{ ucfirst($pattern->difficulty) }}
                    </div>
                    @if($pattern->estimated_hours)
                        <span class="text-xs font-medium text-emerald-700 dark:text-emerald-200">≈ {{ $pattern->estimated_hours }} hrs</span>
                    @endif
                </div>
                <h1 class="text-3xl font-bold text-zinc-900 dark:text-white">{{ $pattern->title }}</h1>
                <p class="mt-2 text-zinc-600 dark:text-zinc-300">{{ $pattern->description }}</p>
                <div class="mt-3 flex items-center gap-3 text-sm font-semibold text-emerald-700 dark:text-emerald-200">
                    <span class="inline-flex h-2 w-2 rounded-full bg-emerald-500"></span>
                    {{ $pattern->makers_saved }} makers saved
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex gap-3">
                <a href="{{ $pdfPath }}" download class="rounded-lg bg-emerald-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-emerald-700">
                    Download PDF
                </a>
                <a href="{{ route('patterns.crochet') }}" class="rounded-lg border border-emerald-200 bg-white px-6 py-3 text-sm font-semibold text-emerald-800 transition hover:bg-emerald-50 dark:border-emerald-800 dark:bg-zinc-900 dark:text-emerald-200 dark:hover:bg-zinc-800">
                    Back to Patterns
                </a>
            </div>
        </div>

        <!-- PDF Viewer -->
        <div class="pdf-container">
            <iframe 
                src="{{ $pdfPath }}#toolbar=0&navpanes=0&scrollbar=1&zoom=page-width" 
                type="application/pdf"
                title="{{ $pattern->title }} Pattern">
                <p class="p-8 text-center text-zinc-600 dark:text-zinc-300">
                    Your browser doesn't support PDF viewing. 
                    <a href="{{ $pdfPath }}" download class="font-semibold text-emerald-600 hover:underline">Download the PDF</a> instead.
                </p>
            </iframe>
        </div>

        <!-- Pattern Info -->
        <div class="mt-8 grid gap-6 md:grid-cols-3">
            <div class="rounded-2xl border border-emerald-100 bg-white p-6 dark:border-emerald-900/40 dark:bg-zinc-900/70">
                <h3 class="font-semibold text-zinc-900 dark:text-white">Category</h3>
                <p class="mt-1 text-emerald-700 dark:text-emerald-200">{{ ucfirst(str_replace('-', ' ', $pattern->category)) }}</p>
            </div>
            
            <div class="rounded-2xl border border-emerald-100 bg-white p-6 dark:border-emerald-900/40 dark:bg-zinc-900/70">
                <h3 class="font-semibold text-zinc-900 dark:text-white">Difficulty</h3>
                <p class="mt-1 text-emerald-700 dark:text-emerald-200">{{ ucfirst($pattern->difficulty) }}</p>
            </div>
            
            @if($pattern->estimated_hours)
            <div class="rounded-2xl border border-emerald-100 bg-white p-6 dark:border-emerald-900/40 dark:bg-zinc-900/70">
                <h3 class="font-semibold text-zinc-900 dark:text-white">Estimated Time</h3>
                <p class="mt-1 text-emerald-700 dark:text-emerald-200">≈ {{ $pattern->estimated_hours }} hours</p>
            </div>
            @endif
        </div>
    </div>
</section>
@endsection