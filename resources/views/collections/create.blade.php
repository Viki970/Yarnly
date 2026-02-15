@extends('layout.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-teal-50 via-white to-emerald-50 dark:from-zinc-950 dark:via-zinc-900 dark:to-teal-950/20 py-12">
    <div class="container mx-auto px-4 max-w-4xl">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-4xl font-bold bg-gradient-to-r from-teal-600 to-emerald-600 bg-clip-text text-transparent mb-2">
                    Create New Collection
                </h1>
                <p class="text-zinc-600 dark:text-zinc-300 text-lg">
                    Organize your selected patterns into a beautiful collection
                </p>
            </div>
            <a href="{{ route('collections.select-patterns') }}" 
                class="px-6 py-3 rounded-lg bg-zinc-200 dark:bg-zinc-700 text-zinc-700 dark:text-zinc-200 font-semibold hover:bg-zinc-300 dark:hover:bg-zinc-600 transition-all duration-200">
                <svg class="inline-block h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Pattern Selection
            </a>
        </div>

        <!-- Selected Patterns Preview -->
        <div class="mb-8 p-6 rounded-xl bg-white dark:bg-zinc-900 shadow-lg border border-teal-100 dark:border-teal-900/40">
            <h3 class="text-lg font-semibold text-zinc-900 dark:text-white mb-4">
                Selected Patterns ({{ $patterns->count() }})
            </h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($patterns as $pattern)
                    <div class="relative group">
                        @if($pattern->image_path)
                            <img src="{{ asset('storage/' . $pattern->image_path) }}" 
                                alt="{{ $pattern->title }}" 
                                class="w-full h-24 object-cover rounded-lg">
                        @else
                            <div class="w-full h-24 bg-gradient-to-br from-teal-100 to-emerald-100 dark:from-teal-900/40 dark:to-emerald-900/40 rounded-lg flex items-center justify-center">
                                <svg class="h-8 w-8 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-60 rounded-lg transition-all duration-200 flex items-center justify-center">
                            <p class="text-white text-xs font-semibold opacity-0 group-hover:opacity-100 text-center px-2">{{ Str::limit($pattern->title, 30) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Collection Form -->
        <form action="{{ route('collections.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <!-- Hidden pattern IDs -->
            @foreach($patternIds as $patternId)
                <input type="hidden" name="pattern_ids[]" value="{{ $patternId }}">
            @endforeach

            <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-lg border border-teal-100 dark:border-teal-900/40 p-8">
                <!-- Collection Name -->
                <div class="mb-6">
                    <label for="name" class="block text-sm font-semibold text-zinc-700 dark:text-zinc-300 mb-2">
                        Collection Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name') }}"
                           required
                           class="w-full px-4 py-3 rounded-lg border border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all"
                           placeholder="e.g., Summer Crochet Projects">
                    @error('name')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <label for="description" class="block text-sm font-semibold text-zinc-700 dark:text-zinc-300 mb-2">
                        Description
                    </label>
                    <textarea id="description" 
                              name="description" 
                              rows="4"
                              class="w-full px-4 py-3 rounded-lg border border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all"
                              placeholder="Describe your collection...">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Craft Type -->
                <div class="mb-6">
                    <label for="craft_type" class="block text-sm font-semibold text-zinc-700 dark:text-zinc-300 mb-2">
                        Craft Type <span class="text-red-500">*</span>
                    </label>
                    <select id="craft_type" 
                            name="craft_type" 
                            required
                            class="w-full px-4 py-3 rounded-lg border border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all">
                        <option value="crochet" {{ old('craft_type') == 'crochet' ? 'selected' : '' }}>Crochet</option>
                        <option value="knitting" {{ old('craft_type') == 'knitting' ? 'selected' : '' }}>Knitting</option>
                        <option value="embroidery" {{ old('craft_type') == 'embroidery' ? 'selected' : '' }}>Embroidery</option>
                    </select>
                    @error('craft_type')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Cover Image -->
                <div class="mb-6">
                    <label for="cover_image" class="block text-sm font-semibold text-zinc-700 dark:text-zinc-300 mb-2">
                        Cover Image (Optional)
                    </label>
                    <div class="flex items-center gap-4">
                        <label for="cover_image" class="flex-1 cursor-pointer">
                            <div class="border-2 border-dashed border-zinc-300 dark:border-zinc-700 rounded-lg p-6 text-center hover:border-teal-500 dark:hover:border-teal-400 transition-all">
                                <svg class="mx-auto h-12 w-12 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                </svg>
                                <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400">
                                    <span class="font-semibold text-teal-600 dark:text-teal-400">Click to upload</span> or drag and drop
                                </p>
                                <p class="text-xs text-zinc-500 dark:text-zinc-500 mt-1">PNG, JPG, GIF up to 5MB</p>
                                <p class="text-xs text-zinc-500 dark:text-zinc-500 mt-1">If no image is uploaded, a pattern image will be used</p>
                            </div>
                            <input id="cover_image" 
                                   name="cover_image" 
                                   type="file" 
                                   accept="image/*"
                                   class="hidden"
                                   onchange="previewImage(event)">
                        </label>
                    </div>
                    <div id="preview-container" class="mt-4 hidden">
                        <img id="preview-image" src="" alt="Preview" class="w-full max-w-md rounded-lg shadow-lg">
                    </div>
                    @error('cover_image')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Visibility -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-zinc-700 dark:text-zinc-300 mb-3">
                        Visibility <span class="text-red-500">*</span>
                    </label>
                    <div class="space-y-3">
                        <label class="flex items-start p-4 rounded-lg border-2 border-zinc-300 dark:border-zinc-700 cursor-pointer hover:border-teal-500 dark:hover:border-teal-400 transition-all">
                            <input type="radio" 
                                   name="is_public" 
                                   value="1" 
                                   {{ old('is_public', '1') == '1' ? 'checked' : '' }}
                                   class="mt-1 w-4 h-4 text-teal-600 focus:ring-0 cursor-pointer">
                            <div class="ml-3">
                                <span class="block font-semibold text-zinc-900 dark:text-white">Public</span>
                                <span class="block text-sm text-zinc-600 dark:text-zinc-400">Anyone can view this collection</span>
                            </div>
                        </label>
                        <label class="flex items-start p-4 rounded-lg border-2 border-zinc-300 dark:border-zinc-700 cursor-pointer hover:border-teal-500 dark:hover:border-teal-400 transition-all">
                            <input type="radio" 
                                   name="is_public" 
                                   value="0" 
                                   {{ old('is_public') == '0' ? 'checked' : '' }}
                                   class="mt-1 w-4 h-4 text-teal-600 focus:ring-0 cursor-pointer">
                            <div class="ml-3">
                                <span class="block font-semibold text-zinc-900 dark:text-white">Private</span>
                                <span class="block text-sm text-zinc-600 dark:text-zinc-400">Only you can view this collection</span>
                            </div>
                        </label>
                    </div>
                    @error('is_public')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t border-zinc-200 dark:border-zinc-700">
                    <a href="{{ route('collections.select-patterns') }}" 
                       class="px-6 py-3 rounded-lg bg-zinc-200 dark:bg-zinc-700 text-zinc-700 dark:text-zinc-200 font-semibold hover:bg-zinc-300 dark:hover:bg-zinc-600 transition-all duration-200">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-8 py-3 rounded-lg bg-gradient-to-r from-teal-600 to-emerald-600 text-white font-semibold hover:from-teal-500 hover:to-emerald-500 transform hover:scale-105 transition-all duration-200 shadow-lg">
                        <svg class="inline-block h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Create Collection
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('preview-image');
            const container = document.getElementById('preview-container');
            preview.src = e.target.result;
            container.classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    }
}
</script>
@endsection
