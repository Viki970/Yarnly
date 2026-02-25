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
                    Select Patterns for Collection
                </span>
            </h1>
            <div class="flex items-center justify-center gap-2 mb-3">
                <span class="h-px w-12 bg-gradient-to-r from-transparent to-teal-400 dark:to-teal-400 rounded-full"></span>
                <span class="text-teal-600 dark:text-teal-300 text-xs font-semibold uppercase tracking-widest">Curate your craft</span>
                <span class="h-px w-12 bg-gradient-to-l from-transparent to-teal-400 dark:to-teal-400 rounded-full"></span>
            </div>
            <p class="text-zinc-500 dark:text-zinc-400 text-base">
                Choose the patterns you want to add to your new collection
            </p>
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
                <div class="flex gap-3">
                    @if($collections->count() > 0)
                        <button id="add-to-existing-btn" disabled
                            class="px-6 py-3 rounded-lg bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-semibold hover:from-emerald-500 hover:to-teal-500 transform hover:scale-105 transition-all duration-200 shadow-lg disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:scale-100">
                            <svg class="inline-block h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Add to Existing Collection
                        </button>
                    @endif
                    <button id="continue-btn" disabled
                        class="px-6 py-3 rounded-lg bg-gradient-to-r from-teal-600 to-emerald-600 text-white font-semibold hover:from-teal-500 hover:to-emerald-500 transform hover:scale-105 transition-all duration-200 shadow-lg disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:scale-100">
                        Continue to Collection Details
                        <svg class="inline-block h-5 w-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </button>
                </div>
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

<!-- Modal for selecting existing collection -->
<div id="collection-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-2xl max-w-2xl w-full max-h-[80vh] overflow-hidden">
        <!-- Modal Header -->
        <div class="bg-gradient-to-r from-emerald-600 to-teal-600 px-6 py-4">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-bold text-white">Add to Existing Collection</h2>
                <button onclick="closeModal()" class="text-white hover:text-gray-200 transition-colors">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Modal Body -->
        <div class="p-6 overflow-y-auto max-h-[calc(80vh-140px)]">
            <p class="text-zinc-600 dark:text-zinc-400 mb-4">
                Select a collection to add the <span id="modal-pattern-count" class="font-semibold text-emerald-600 dark:text-emerald-400">0</span> selected pattern(s):
            </p>
            
            @if($collections->count() > 0)
                <div class="space-y-3">
                    @foreach($collections as $collection)
                        <label class="flex items-start p-4 rounded-xl border-2 border-zinc-200 dark:border-zinc-700 cursor-pointer hover:border-emerald-400 dark:hover:border-emerald-500 transition-all group">
                            <input type="radio" 
                                   name="selected_collection" 
                                   value="{{ $collection->id }}"
                                   class="mt-1 w-5 h-5 text-emerald-600 focus:ring-emerald-500 cursor-pointer">
                            <div class="ml-4 flex-1">
                                <div class="flex items-start justify-between mb-2">
                                    <h3 class="font-bold text-zinc-900 dark:text-white text-lg">{{ $collection->name }}</h3>
                                    <span class="inline-flex items-center rounded-lg px-2 py-1 text-xs font-semibold 
                                        @if($collection->craft_type === 'crochet')
                                            bg-emerald-100 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-200
                                        @elseif($collection->craft_type === 'knitting')
                                            bg-blue-100 text-blue-700 dark:bg-blue-900/40 dark:text-blue-200
                                        @else
                                            bg-purple-100 text-purple-700 dark:bg-purple-900/40 dark:text-purple-200
                                        @endif
                                    ">
                                        {{ ucfirst($collection->craft_type) }}
                                    </span>
                                </div>
                                @if($collection->description)
                                    <p class="text-sm text-zinc-600 dark:text-zinc-400 mb-2">{{ Str::limit($collection->description, 100) }}</p>
                                @endif
                                <div class="flex items-center gap-4 text-xs text-zinc-500 dark:text-zinc-400">
                                    <span class="flex items-center gap-1">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        {{ $collection->patterns->count() }} {{ Str::plural('pattern', $collection->patterns->count()) }}
                                    </span>
                                    <span class="flex items-center gap-1">
                                        @if($collection->is_public)
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            Public
                                        @else
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                            </svg>
                                            Private
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </label>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Modal Footer -->
        <div class="bg-zinc-50 dark:bg-zinc-800 px-6 py-4 flex items-center justify-end gap-3">
            <button onclick="closeModal()" 
                    class="px-6 py-2.5 rounded-lg bg-zinc-200 dark:bg-zinc-700 text-zinc-700 dark:text-zinc-200 font-semibold hover:bg-zinc-300 dark:hover:bg-zinc-600 transition-all">
                Cancel
            </button>
            <button onclick="addToCollection()" 
                    id="add-btn"
                    class="px-6 py-2.5 rounded-lg bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-semibold hover:from-emerald-500 hover:to-teal-500 transition-all shadow-lg">
                <svg class="inline-block h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Add Patterns
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.pattern-checkbox');
    const selectedCount = document.getElementById('selected-count');
    const continueBtn = document.getElementById('continue-btn');
    const addToExistingBtn = document.getElementById('add-to-existing-btn');
    const patternCards = document.querySelectorAll('.pattern-card');
    
    // Update count and button state
    function updateSelection() {
        const checkedCount = document.querySelectorAll('.pattern-checkbox:checked').length;
        selectedCount.textContent = checkedCount;
        continueBtn.disabled = checkedCount === 0;
        if (addToExistingBtn) {
            addToExistingBtn.disabled = checkedCount === 0;
        }
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

    // Add to existing collection button
    if (addToExistingBtn) {
        addToExistingBtn.addEventListener('click', function() {
            openModal();
        });
    }
});

// Modal functions
function openModal() {
    const modal = document.getElementById('collection-modal');
    const selectedCount = document.querySelectorAll('.pattern-checkbox:checked').length;
    document.getElementById('modal-pattern-count').textContent = selectedCount;
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    const modal = document.getElementById('collection-modal');
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
    // Clear radio selection
    document.querySelectorAll('input[name="selected_collection"]').forEach(radio => radio.checked = false);
}

// Add patterns to selected collection
async function addToCollection() {
    const selectedCollection = document.querySelector('input[name="selected_collection"]:checked');
    
    if (!selectedCollection) {
        alert('Please select a collection first.');
        return;
    }

    const collectionId = selectedCollection.value;
    const selectedPatterns = Array.from(document.querySelectorAll('.pattern-checkbox:checked'))
        .map(cb => cb.value);

    if (selectedPatterns.length === 0) {
        alert('No patterns selected.');
        return;
    }

    const addBtn = document.getElementById('add-btn');
    const originalText = addBtn.innerHTML;
    
    // Show loading state
    addBtn.disabled = true;
    addBtn.innerHTML = `
        <svg class="animate-spin inline-block h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        Adding...
    `;

    try {
        const response = await fetch(`/collections/${collectionId}/add-patterns`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ pattern_ids: selectedPatterns })
        });

        const data = await response.json();

        if (data.success) {
            // Redirect to my collections page
            window.location.href = '/my-collections';
        } else {
            throw new Error(data.message || 'Failed to add patterns');
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Failed to add patterns to collection. Please try again.');
    } finally {
        addBtn.disabled = false;
        addBtn.innerHTML = originalText;
    }
}

</script>
@endsection
