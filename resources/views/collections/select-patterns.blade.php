@extends('layout.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-teal-50 via-white to-emerald-50 dark:from-zinc-950 dark:via-zinc-900 dark:to-teal-950/20 py-12">
    <div class="container mx-auto px-4 max-w-7xl">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-4xl font-bold bg-gradient-to-r from-teal-600 to-emerald-600 bg-clip-text text-transparent mb-2">
                    Select Patterns for Collection
                </h1>
                <p class="text-zinc-600 dark:text-zinc-300 text-lg">
                    Choose the patterns you want to add to your new collection
                </p>
            </div>
            <a href="{{ route('my-collections') }}" 
                class="px-6 py-3 rounded-lg bg-zinc-200 dark:bg-zinc-700 text-zinc-700 dark:text-zinc-200 font-semibold hover:bg-zinc-300 dark:hover:bg-zinc-600 transition-all duration-200">
                <svg class="inline-block h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Collections
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 rounded-lg bg-teal-50 dark:bg-teal-900/30 border border-teal-200 dark:border-teal-800">
                <p class="text-teal-700 dark:text-teal-300">{{ session('success') }}</p>
            </div>
        @endif

        <!-- Info Card -->
        <div class="mb-8 p-6 rounded-xl bg-gradient-to-r from-teal-50 to-emerald-50 dark:from-teal-900/20 dark:to-emerald-900/20 border border-teal-200 dark:border-teal-800">
            <div class="flex items-start gap-4">
                <div class="p-3 rounded-lg bg-teal-100 dark:bg-teal-900/40">
                    <svg class="h-6 w-6 text-teal-600 dark:text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-zinc-900 dark:text-white mb-1">How to Create a Collection</h3>
                    <p class="text-zinc-600 dark:text-zinc-400 text-sm">
                        Select the patterns you want by clicking the checkboxes below. You can select multiple patterns to organize them into a themed collection.
                    </p>
                </div>
            </div>
        </div>

        <!-- Patterns Grid -->
        @if($patterns->isEmpty())
            <div class="text-center py-16">
                <div class="mx-auto w-24 h-24 bg-teal-100 dark:bg-teal-900/40 rounded-full flex items-center justify-center mb-6">
                    <svg class="h-12 w-12 text-teal-600 dark:text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-zinc-900 dark:text-white mb-2">No patterns yet</h3>
                <p class="text-zinc-600 dark:text-zinc-400 mb-6">You need to create patterns before you can add them to collections.</p>
                <a href="{{ route('patterns.create') }}" 
                    class="inline-flex items-center px-6 py-3 rounded-lg bg-gradient-to-r from-teal-600 to-emerald-600 text-white font-semibold hover:from-teal-500 hover:to-emerald-500 transform hover:scale-105 transition-all duration-200 shadow-lg">
                    <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Create Your First Pattern
                </a>
            </div>
        @else
            <div class="mb-6 flex items-center justify-between">
                <p class="text-zinc-600 dark:text-zinc-400">
                    <span id="selected-count" class="font-semibold text-teal-600 dark:text-teal-400">0</span> pattern(s) selected
                </p>
                <button id="continue-btn" disabled
                    class="px-6 py-3 rounded-lg bg-gradient-to-r from-teal-600 to-emerald-600 text-white font-semibold hover:from-teal-500 hover:to-emerald-500 transform hover:scale-105 transition-all duration-200 shadow-lg disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:scale-100">
                    Continue to Collection Details
                    <svg class="inline-block h-5 w-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($patterns as $pattern)
                    <div class="pattern-card bg-white dark:bg-zinc-900 rounded-2xl shadow-lg border-2 border-zinc-200 dark:border-zinc-800 overflow-hidden hover:shadow-xl transition-all duration-300"
                         data-pattern-id="{{ $pattern->id }}">
                        <!-- Checkbox Overlay -->
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
                            
                            <!-- Checkbox -->
                            <div class="absolute top-4 right-4">
                                <label class="flex items-center cursor-pointer">
                                    <input type="checkbox" 
                                           class="pattern-checkbox w-6 h-6 rounded-lg border-2 border-white shadow-lg text-teal-600 focus:ring-0 cursor-pointer"
                                           value="{{ $pattern->id }}">
                                </label>
                            </div>
                        </div>

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

                            <div class="flex items-center justify-between text-sm text-zinc-500 dark:text-zinc-400">
                                @if($pattern->estimated_hours)
                                    <span>{{ $pattern->estimated_hours }} hrs</span>
                                @endif
                                <span>{{ $pattern->makers_saved }} saved</span>
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
    const checkboxes = document.querySelectorAll('.pattern-checkbox');
    const selectedCount = document.getElementById('selected-count');
    const continueBtn = document.getElementById('continue-btn');
    const patternCards = document.querySelectorAll('.pattern-card');
    
    // Update count and button state
    function updateSelection() {
        const checkedCount = document.querySelectorAll('.pattern-checkbox:checked').length;
        selectedCount.textContent = checkedCount;
        continueBtn.disabled = checkedCount === 0;
    }
    
    // Add event listeners to checkboxes
    checkboxes.forEach((checkbox, index) => {
        checkbox.addEventListener('change', function() {
            const card = patternCards[index];
            if (this.checked) {
                card.classList.add('border-teal-500', 'dark:border-teal-400', 'ring-2', 'ring-teal-500', 'dark:ring-teal-400');
                card.classList.remove('border-zinc-200', 'dark:border-zinc-800');
            } else {
                card.classList.remove('border-teal-500', 'dark:border-teal-400', 'ring-2', 'ring-teal-500', 'dark:ring-teal-400');
                card.classList.add('border-zinc-200', 'dark:border-zinc-800');
            }
            updateSelection();
        });
        
        // Make the whole card clickable
        patternCards[index].addEventListener('click', function(e) {
            // Don't toggle if clicking directly on the checkbox
            if (e.target !== checkbox) {
                checkbox.checked = !checkbox.checked;
                checkbox.dispatchEvent(new Event('change'));
            }
        });
    });
    
    // Continue button action
    continueBtn.addEventListener('click', function() {
        const selectedPatterns = Array.from(document.querySelectorAll('.pattern-checkbox:checked'))
            .map(cb => cb.value);
        
        // Redirect to collection creation form with selected pattern IDs
        if (selectedPatterns.length > 0) {
            const params = new URLSearchParams();
            selectedPatterns.forEach(id => params.append('patterns[]', id));
            window.location.href = '{{ route("collections.create") }}?' + params.toString();
        }
    });
});
</script>
@endsection
