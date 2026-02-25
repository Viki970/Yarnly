@extends('layout.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-emerald-50 via-white to-teal-50 dark:from-zinc-950 dark:via-zinc-900 dark:to-emerald-950/20 py-12">
    <div class="container mx-auto px-4 max-w-4xl">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent mb-4">
                Create New Pattern
            </h1>
            <p class="text-zinc-600 dark:text-zinc-300 text-lg">
                Share your creativity with the Yarnly community
            </p>
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

        <!-- Form Card -->
        <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-xl border border-emerald-100 dark:border-emerald-900/40 overflow-hidden">
            <form action="{{ route('patterns.store') }}" method="POST" enctype="multipart/form-data" class="p-8">
                @csrf
                
                <!-- Form Fields -->
                <div class="space-y-6">
                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-semibold text-zinc-700 dark:text-zinc-200 mb-3">
                            Pattern Title <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}" required 
                            class="w-full px-4 py-3 rounded-lg border border-emerald-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 dark:border-emerald-700 dark:bg-zinc-800 dark:text-white transition-colors">
                        @error('title')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-semibold text-zinc-700 dark:text-zinc-200 mb-3">
                            Description <span class="text-red-500">*</span>
                        </label>
                        <textarea id="description" name="description" rows="4" required
                            class="w-full px-4 py-3 rounded-lg border border-emerald-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 dark:border-emerald-700 dark:bg-zinc-800 dark:text-white transition-colors">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Craft Type, Category and Difficulty -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Craft Type -->
                        <div>
                            <label for="craft_type" class="block text-sm font-semibold text-zinc-700 dark:text-zinc-200 mb-3">
                                Craft Type <span class="text-red-500">*</span>
                            </label>
                            <select id="craft_type" name="craft_type" required
                                class="w-full px-4 py-3 rounded-lg border border-emerald-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 dark:border-emerald-700 dark:bg-zinc-800 dark:text-white transition-colors">
                                <option value="">Select Craft</option>
                                @foreach(array_keys($categories) as $craft)
                                    <option value="{{ $craft }}" {{ old('craft_type') == $craft ? 'selected' : '' }}>
                                        {{ ucfirst($craft) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('craft_type')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div>
                            <label for="category" class="block text-sm font-semibold text-zinc-700 dark:text-zinc-200 mb-3">
                                Category <span class="text-red-500">*</span>
                            </label>
                            <select id="category" name="category" required
                                class="w-full px-4 py-3 rounded-lg border border-emerald-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 dark:border-emerald-700 dark:bg-zinc-800 dark:text-white transition-colors">
                                <option value="">Select Category</option>
                            </select>
                            @error('category')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="difficulty" class="block text-sm font-semibold text-zinc-700 dark:text-zinc-200 mb-3">
                                Difficulty <span class="text-red-500">*</span>
                            </label>
                            <select id="difficulty" name="difficulty" required 
                                class="w-full px-4 py-3 rounded-lg border border-emerald-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 dark:border-emerald-700 dark:bg-zinc-800 dark:text-white transition-colors">
                                <option value="">Select Difficulty</option>
                                <option value="beginner" {{ old('difficulty') == 'beginner' ? 'selected' : '' }}>Beginner</option>
                                <option value="intermediate" {{ old('difficulty') == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                                <option value="advanced" {{ old('difficulty') == 'advanced' ? 'selected' : '' }}>Advanced</option>
                            </select>
                            @error('difficulty')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Estimated Hours -->
                    <div>
                        <label for="estimated_hours" class="block text-sm font-semibold text-zinc-700 dark:text-zinc-200 mb-3">
                            Estimated Hours
                        </label>
                        <input type="number" id="estimated_hours" name="estimated_hours" value="{{ old('estimated_hours') }}" 
                            min="1" max="200"
                            class="w-full px-4 py-3 rounded-lg border border-emerald-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 dark:border-emerald-700 dark:bg-zinc-800 dark:text-white transition-colors">
                        @error('estimated_hours')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tags -->
                    <div>
                        <label for="tags" class="block text-sm font-semibold text-zinc-700 dark:text-zinc-200 mb-3">
                            Tags (Optional)
                            <span class="text-emerald-600 dark:text-emerald-400 text-xs ml-2">(Separate with commas, e.g., "easy, beginner, cute")</span>
                        </label>
                        <input type="text" id="tags" name="tags" value="{{ old('tags') }}" 
                            placeholder="cute, beginner-friendly, quick, colorful..."
                            class="w-full px-4 py-3 rounded-lg border border-emerald-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 dark:border-emerald-700 dark:bg-zinc-800 dark:text-white transition-colors">
                        <p class="mt-2 text-xs text-zinc-500 dark:text-zinc-400">Tags help other users find your pattern more easily through search</p>
                        @error('tags')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- File Uploads -->
                    <div class="space-y-6">
                        <!-- PDF File -->
                        <div>
                            <label for="pdf_file" class="block text-sm font-semibold text-zinc-700 dark:text-zinc-200 mb-3">
                                Pattern PDF File <span class="text-red-500">*</span>
                                <span class="text-emerald-600 dark:text-emerald-400 text-xs ml-2">(PDF only, max 10MB)</span>
                            </label>
                            <input type="file" id="pdf_file" name="pdf_file" accept=".pdf" required 
                                class="w-full px-4 py-3 rounded-lg border border-emerald-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 dark:border-emerald-700 dark:bg-zinc-800 dark:text-white file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                            <div id="pdfError" class="mt-2 text-sm text-red-600 dark:text-red-400 hidden"></div>
                            @error('pdf_file')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Image File -->
                        <div>
                            <label for="image_file" class="block text-sm font-semibold text-zinc-700 dark:text-zinc-200 mb-3">
                                Pattern Image 
                                <span class="text-emerald-600 dark:text-emerald-400 text-xs ml-2">(PNG or JPG only, max 5MB)</span>
                            </label>
                            <input type="file" id="image_file" name="image_file" accept=".png,.jpg,.jpeg" 
                                class="w-full px-4 py-3 rounded-lg border border-emerald-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 dark:border-emerald-700 dark:bg-zinc-800 dark:text-white file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                            <div id="imageError" class="mt-2 text-sm text-red-600 dark:text-red-400 hidden"></div>
                            @error('image_file')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end gap-4 mt-8 pt-6 border-t border-zinc-200 dark:border-zinc-700">
                    <a href="{{ route('patterns.crochet') }}" 
                        class="px-6 py-3 rounded-lg border border-zinc-300 text-zinc-700 font-semibold hover:bg-zinc-50 dark:border-zinc-600 dark:text-zinc-200 dark:hover:bg-zinc-800 transition-colors">
                        Cancel
                    </a>
                    <button type="submit" 
                        class="px-8 py-3 rounded-lg bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-semibold hover:from-emerald-500 hover:to-teal-500 transform hover:scale-105 transition-all duration-200 shadow-lg">
                        Create Pattern
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    const categories = @json($categories);
    const oldCraftType = "{{ old('craft_type') }}";
    const oldCategory  = "{{ old('category') }}";

    const craftSelect    = document.getElementById('craft_type');
    const categorySelect = document.getElementById('category');

    function populateCategories(craft) {
        categorySelect.innerHTML = '<option value="">Select Category</option>';
        if (!craft || !categories[craft]) return;
        Object.entries(categories[craft]).forEach(([value, label]) => {
            const opt = document.createElement('option');
            opt.value = value;
            opt.textContent = label;
            if (value === oldCategory) opt.selected = true;
            categorySelect.appendChild(opt);
        });
    }

    craftSelect.addEventListener('change', () => populateCategories(craftSelect.value));

    // Re-populate on page load (e.g. after validation error)
    if (oldCraftType) {
        craftSelect.value = oldCraftType;
        populateCategories(oldCraftType);
    }
</script>
@endpush