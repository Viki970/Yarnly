@extends('layout.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-emerald-50 via-white to-teal-50 dark:from-zinc-950 dark:via-zinc-900 dark:to-emerald-950/20 py-12">
    <div class="container mx-auto px-4 max-w-7xl">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-4xl font-bold bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent mb-2">
                    My Patterns
                </h1>
                <p class="text-zinc-600 dark:text-zinc-300 text-lg">
                    Manage and view all your created patterns
                </p>
            </div>
            <a href="{{ route('patterns.create') }}" 
                class="px-6 py-3 rounded-lg bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-semibold hover:from-emerald-500 hover:to-teal-500 transform hover:scale-105 transition-all duration-200 shadow-lg">
                <svg class="inline-block h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Create New Pattern
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 rounded-lg bg-emerald-50 dark:bg-emerald-900/30 border border-emerald-200 dark:border-emerald-800">
                <p class="text-emerald-700 dark:text-emerald-300">{{ session('success') }}</p>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 p-4 rounded-lg bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800">
                <p class="text-red-700 dark:text-red-300">{{ session('error') }}</p>
            </div>
        @endif

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white dark:bg-zinc-900 rounded-2xl p-6 shadow-lg border border-emerald-100 dark:border-emerald-900/40">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-emerald-100 dark:bg-emerald-900/40">
                        <svg class="h-8 w-8 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-zinc-600 dark:text-zinc-400">Total Patterns</p>
                        <p class="text-2xl font-bold text-zinc-900 dark:text-white">{{ $patterns->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-zinc-900 rounded-2xl p-6 shadow-lg border border-emerald-100 dark:border-emerald-900/40">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-teal-100 dark:bg-teal-900/40">
                        <svg class="h-8 w-8 text-teal-600 dark:text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-zinc-600 dark:text-zinc-400">Categories</p>
                        <p class="text-2xl font-bold text-zinc-900 dark:text-white">{{ $patterns->groupBy('category')->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-zinc-900 rounded-2xl p-6 shadow-lg border border-emerald-100 dark:border-emerald-900/40">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-orange-100 dark:bg-orange-900/40">
                        <svg class="h-8 w-8 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-zinc-600 dark:text-zinc-400">Avg Difficulty</p>
                        <p class="text-2xl font-bold text-zinc-900 dark:text-white">
                            @if($patterns->isNotEmpty())
                                @php
                                    $difficulties = $patterns->pluck('difficulty')->countBy();
                                    $mostCommon = $difficulties->keys()->first();
                                @endphp
                                {{ ucfirst($mostCommon ?? 'Mixed') }}
                            @else
                                N/A
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Patterns Grid -->
        @if($patterns->isEmpty())
            <div class="text-center py-16">
                <div class="mx-auto w-24 h-24 bg-emerald-100 dark:bg-emerald-900/40 rounded-full flex items-center justify-center mb-6">
                    <svg class="h-12 w-12 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-zinc-900 dark:text-white mb-2">No patterns yet</h3>
                <p class="text-zinc-600 dark:text-zinc-400 mb-6">Start creating and sharing your crochet patterns with the community!</p>
                <a href="{{ route('patterns.create') }}" 
                    class="inline-flex items-center px-6 py-3 rounded-lg bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-semibold hover:from-emerald-500 hover:to-teal-500 transform hover:scale-105 transition-all duration-200 shadow-lg">
                    <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Create Your First Pattern
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($patterns as $pattern)
                    <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-lg border border-emerald-100 dark:border-emerald-900/40 overflow-hidden hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                        @if($pattern->image_path)
                            <img src="{{ asset('storage/' . $pattern->image_path) }}" 
                                alt="{{ $pattern->title }}" 
                                class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-emerald-100 to-teal-100 dark:from-emerald-900/40 dark:to-teal-900/40 flex items-center justify-center">
                                <svg class="h-16 w-16 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                        @endif

                        <div class="p-6">
                            <h3 class="text-xl font-bold text-zinc-900 dark:text-white mb-2">{{ $pattern->title }}</h3>
                            <p class="text-zinc-600 dark:text-zinc-400 text-sm mb-4 line-clamp-2">{{ Str::limit($pattern->description, 100) }}</p>
                            
                            <div class="flex items-center justify-between mb-4">
                                <span class="inline-flex items-center rounded-lg px-3 py-1 text-xs font-semibold bg-{{ $pattern->getDifficultyColor() }}-100 text-{{ $pattern->getDifficultyColor() }}-700 dark:bg-{{ $pattern->getDifficultyColor() }}-900/40 dark:text-{{ $pattern->getDifficultyColor() }}-200">
                                    {{ ucfirst($pattern->difficulty) }}
                                </span>
                                
                                <span class="text-sm text-zinc-500 dark:text-zinc-400">
                                    {{ $pattern->getCategoryLabel() }}
                                </span>
                            </div>

                            <div class="flex items-center justify-between text-sm text-zinc-500 dark:text-zinc-400 mb-4">
                                @if($pattern->estimated_hours)
                                    <span>{{ $pattern->estimated_hours }} hrs</span>
                                @endif
                                <span>{{ $pattern->makers_saved }} saved</span>
                            </div>

                            <div class="flex gap-3">
                                <a href="{{ route('patterns.view', $pattern) }}" 
                                    class="flex-1 text-center px-4 py-2 rounded-lg bg-emerald-600 text-white font-semibold hover:bg-emerald-500 transition-colors">
                                    View Pattern
                                </a>
                                <button 
                                    type="button"
                                    data-pattern-id="{{ $pattern->id }}" 
                                    class="delete-pattern-btn px-4 py-2 rounded-lg bg-red-400 text-white font-semibold hover:bg-red-500 transition-colors">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </div>
                            <!-- Hidden delete form -->
                            <form id="delete-form-{{ $pattern->id }}" action="{{ route('patterns.destroy', $pattern) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>

                            <div class="mt-3 text-xs text-zinc-500 dark:text-zinc-400">
                                Created {{ $pattern->created_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.querySelectorAll('.delete-pattern-btn');
    
    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const patternId = this.getAttribute('data-pattern-id');
            if (confirm('Are you sure you want to delete this pattern? This action cannot be undone.')) {
                document.getElementById('delete-form-' + patternId).submit();
            }
        });
    });
});
</script>
@endsection