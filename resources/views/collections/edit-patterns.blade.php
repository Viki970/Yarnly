@extends('layout.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-teal-50 via-white to-emerald-50 dark:from-zinc-950 dark:via-zinc-900 dark:to-teal-950/20 py-12">
    <div class="container mx-auto px-4 max-w-7xl">
        <!-- Header -->
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gradient-to-br from-teal-100 to-emerald-100 dark:from-teal-800/30 dark:to-emerald-800/30 shadow-inner mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-teal-600 dark:text-teal-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
            </div>
            <h1 class="text-5xl font-extrabold tracking-tight mb-3">
                <span class="bg-gradient-to-r from-teal-700 via-emerald-500 to-teal-500 dark:from-teal-300 dark:via-emerald-200 dark:to-teal-200 bg-clip-text text-transparent">
                    Edit Patterns
                </span>
            </h1>
            <div class="flex items-center justify-center gap-2 mb-3">
                <span class="h-px w-12 bg-gradient-to-r from-transparent to-teal-400 dark:to-teal-400 rounded-full"></span>
                <span class="text-teal-600 dark:text-teal-300 text-xs font-semibold uppercase tracking-widest">{{ $collection->name }}</span>
                <span class="h-px w-12 bg-gradient-to-l from-transparent to-teal-400 dark:to-teal-400 rounded-full"></span>
            </div>
            <p class="text-zinc-500 dark:text-zinc-400 text-base">
                Select or deselect patterns to add or remove from this collection
            </p>
        </div>

        <form action="{{ route('collections.update-patterns', $collection) }}" method="POST" class="space-y-6">
            @csrf
            
            @if($patterns->count() > 0)
                <!-- Patterns Grid -->
                <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-lg border border-teal-100 dark:border-teal-900/40 p-8">
                    <div class="mb-6 flex items-center justify-between">
                        <h2 class="text-2xl font-bold text-zinc-900 dark:text-white">
                            Your Patterns ({{ $patterns->count() }})
                        </h2>
                        <div class="flex gap-3">
                            <button type="button" 
                                    onclick="selectAll()" 
                                    class="px-4 py-2 rounded-lg bg-teal-100 dark:bg-teal-900/40 text-teal-700 dark:text-teal-200 font-semibold hover:bg-teal-200 dark:hover:bg-teal-900/60 transition-all duration-200">
                                Select All
                            </button>
                            <button type="button" 
                                    onclick="deselectAll()" 
                                    class="px-4 py-2 rounded-lg bg-zinc-200 dark:bg-zinc-700 text-zinc-700 dark:text-zinc-200 font-semibold hover:bg-zinc-300 dark:hover:bg-zinc-600 transition-all duration-200">
                                Deselect All
                            </button>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($patterns as $pattern)
                            @php
                                $isSelected = $collectionPatternIds->contains($pattern->id);
                            @endphp
                            <label class="group cursor-pointer">
                                <div class="relative bg-white dark:bg-zinc-900 rounded-2xl shadow-lg border-2 transition-all duration-300 overflow-hidden
                                    {{ $isSelected ? 'border-teal-500 dark:border-teal-400 ring-2 ring-teal-200 dark:ring-teal-800' : 'border-zinc-200 dark:border-zinc-800 hover:border-teal-300 dark:hover:border-teal-600' }}">
                                    
                                    <!-- Checkbox -->
                                    <div class="absolute top-4 right-4 z-10">
                                        <input type="checkbox" 
                                               name="pattern_ids[]" 
                                               value="{{ $pattern->id }}"
                                               {{ $isSelected ? 'checked' : '' }}
                                               class="pattern-checkbox w-6 h-6 text-teal-600 bg-white dark:bg-zinc-800 border-2 border-zinc-300 dark:border-zinc-600 rounded-md focus:ring-2 focus:ring-teal-500 cursor-pointer transition-all">
                                    </div>

                                    <!-- Pattern Image -->
                                    <div class="relative">
                                        @if($pattern->image_path)
                                            <img src="{{ asset('storage/' . $pattern->image_path) }}" 
                                                alt="{{ $pattern->title }}" 
                                                class="w-full h-48 object-cover">
                                        @else
                                            <div class="w-full h-48 bg-gradient-to-br from-teal-100 to-emerald-100 dark:from-teal-900/40 dark:to-emerald-900/40 flex items-center justify-center">
                                                <svg class="h-16 w-16 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>
                                            </div>
                                        @endif
                                        
                                        <!-- Selected Overlay -->
                                        <div class="absolute inset-0 bg-teal-500/20 backdrop-blur-sm flex items-center justify-center opacity-0 {{ $isSelected ? 'group-hover:opacity-100' : '' }} transition-opacity">
                                            <svg class="h-16 w-16 text-white drop-shadow-lg" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                    </div>

                                    <!-- Pattern Details -->
                                    <div class="p-6">
                                        <h3 class="text-xl font-bold text-zinc-900 dark:text-white mb-2 line-clamp-1">{{ $pattern->title }}</h3>
                                        <p class="text-zinc-600 dark:text-zinc-400 text-sm mb-4 line-clamp-2">{{ Str::limit($pattern->description, 100) }}</p>
                                        
                                        <div class="flex items-center justify-between mb-4">
                                            <span class="inline-flex items-center rounded-lg px-3 py-1 text-xs font-semibold 
                                                @if($pattern->difficulty === 'beginner') 
                                                    bg-emerald-100 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-200
                                                @elseif($pattern->difficulty === 'intermediate') 
                                                    bg-teal-100 text-teal-700 dark:bg-teal-900/40 dark:text-teal-200
                                                @else 
                                                    bg-orange-100 text-orange-700 dark:bg-orange-900/40 dark:text-orange-200
                                                @endif">
                                                {{ ucfirst($pattern->difficulty) }}
                                            </span>
                                            
                                            @if($pattern->estimated_hours)
                                                <span class="text-sm text-zinc-500 dark:text-zinc-400">
                                                    {{ $pattern->estimated_hours }} hrs
                                                </span>
                                            @endif
                                        </div>

                                        <div class="flex items-center justify-between text-sm text-zinc-500 dark:text-zinc-400">
                                            <span>{{ $pattern->makers_saved }} saved</span>
                                        </div>
                                    </div>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-lg border border-teal-100 dark:border-teal-900/40 overflow-hidden">
                    <div class="flex items-center justify-between p-6">
                        <p class="text-zinc-600 dark:text-zinc-400">
                            <span id="selected-count" class="font-bold text-teal-600 dark:text-teal-400">{{ $collectionPatternIds->count() }}</span> pattern(s) selected
                        </p>
                        <div class="flex items-center gap-4">
                            <a href="{{ route('collections.show', $collection) }}"
                                class="px-6 py-3 rounded-lg border border-zinc-300 dark:border-zinc-600 text-zinc-700 dark:text-zinc-300 font-semibold hover:bg-zinc-100 dark:hover:bg-zinc-700 transition-all duration-200">
                                Cancel
                            </a>
                            <button type="submit"
                                class="px-8 py-3 rounded-lg bg-gradient-to-r from-teal-600 to-emerald-500 text-white font-semibold hover:from-teal-700 hover:to-emerald-600 transform hover:scale-105 transition-all duration-200 shadow-lg shadow-teal-500/25">
                                Update Patterns
                            </button>
                        </div>
                    </div>
                </div>
            @else
                <!-- No Patterns -->
                <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-lg border border-teal-100 dark:border-teal-900/40 p-12 text-center">
                    <svg class="mx-auto h-24 w-24 text-zinc-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <h3 class="text-2xl font-bold text-zinc-900 dark:text-white mb-2">No Patterns Available</h3>
                    <p class="text-zinc-600 dark:text-zinc-400 mb-6">You don't have any patterns yet. Create some patterns first to add them to your collection.</p>
                    <a href="{{ route('patterns.create') }}" 
                       class="inline-flex items-center gap-2 px-6 py-3 rounded-lg bg-gradient-to-r from-teal-600 to-emerald-600 text-white font-semibold hover:from-teal-500 hover:to-emerald-500 transform hover:scale-105 transition-all duration-200 shadow-lg">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Create New Pattern
                    </a>
                </div>
            @endif
        </form>
    </div>
</div>

<script>
// Track form changes
let formChanged = false;
const initialState = {};

// Store initial checkbox states
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.pattern-checkbox').forEach((checkbox, index) => {
        initialState[index] = checkbox.checked;
        checkbox.addEventListener('change', function() {
            updateSelectedCount();
            checkForChanges();
        });
    });

    // Handle cancel button clicks
    const cancelButtons = document.querySelectorAll('a[href*="collections"][href*="show"]');
    cancelButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            if (formChanged) {
                if (!confirm('You have unsaved changes. Are you sure you want to leave without saving?')) {
                    e.preventDefault();
                }
            }
        });
    });
});

// Check if form has changed from initial state
function checkForChanges() {
    let changed = false;
    document.querySelectorAll('.pattern-checkbox').forEach((checkbox, index) => {
        if (checkbox.checked !== initialState[index]) {
            changed = true;
        }
    });
    formChanged = changed;
}

function selectAll() {
    document.querySelectorAll('.pattern-checkbox').forEach(checkbox => {
        checkbox.checked = true;
    });
    updateSelectedCount();
    checkForChanges();
}

function deselectAll() {
    document.querySelectorAll('.pattern-checkbox').forEach(checkbox => {
        checkbox.checked = false;
    });
    updateSelectedCount();
    checkForChanges();
}

function updateSelectedCount() {
    const count = document.querySelectorAll('.pattern-checkbox:checked').length;
    document.getElementById('selected-count').textContent = count;
}
</script>
@endsection
