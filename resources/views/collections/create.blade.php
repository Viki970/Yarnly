@extends('layout.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-teal-50 via-white to-emerald-50 dark:from-zinc-950 dark:via-zinc-900 dark:to-teal-950/20 py-12">
    <div class="container mx-auto px-4 max-w-4xl">
        <!-- Header -->
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gradient-to-br from-teal-100 to-emerald-100 dark:from-teal-800/30 dark:to-emerald-800/30 shadow-inner mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-teal-600 dark:text-teal-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
            </div>
            <h1 class="text-5xl font-extrabold tracking-tight mb-3">
                <span class="bg-gradient-to-r from-teal-700 via-emerald-500 to-teal-500 dark:from-teal-300 dark:via-emerald-200 dark:to-teal-200 bg-clip-text text-transparent">
                    Create New Collection
                </span>
            </h1>
            <div class="flex items-center justify-center gap-2 mb-3">
                <span class="h-px w-12 bg-gradient-to-r from-transparent to-teal-400 dark:to-teal-400 rounded-full"></span>
                <span class="text-teal-600 dark:text-teal-300 text-xs font-semibold uppercase tracking-widest">Curate your craft</span>
                <span class="h-px w-12 bg-gradient-to-l from-transparent to-teal-400 dark:to-teal-400 rounded-full"></span>
            </div>
            <p class="text-zinc-500 dark:text-zinc-400 text-base">
                Organize your selected patterns into a beautiful collection
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

        <!-- Selected Patterns Preview -->
        <div class="mb-8">
            <h3 class="text-sm font-semibold text-zinc-700 dark:text-zinc-300 mb-4 uppercase tracking-widest">
                Selected Patterns ({{ $patterns->count() }})
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($patterns as $pattern)
                    <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-lg border-2 border-teal-200 dark:border-teal-800 overflow-hidden hover:shadow-xl transition-all duration-300">
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
                        </div>

                        <!-- Pattern Details -->
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
        </div>

        <!-- Collection Form -->
        <form action="{{ route('collections.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- Hidden pattern IDs -->
            @foreach($patternIds as $patternId)
                <input type="hidden" name="pattern_ids[]" value="{{ $patternId }}">
            @endforeach

            <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-lg border border-teal-100 dark:border-teal-900/40 overflow-hidden">
                <div class="p-8 space-y-6">
                <!-- Collection Name -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-zinc-700 dark:text-zinc-300 mb-3">
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
                <div>
                    <label for="description" class="block text-sm font-semibold text-zinc-700 dark:text-zinc-300 mb-3">
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
                <div>
                    <label for="craft_type" class="block text-sm font-semibold text-zinc-700 dark:text-zinc-300 mb-3">
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
                <div>
                    <label for="cover_image" class="block text-sm font-semibold text-zinc-700 dark:text-zinc-300 mb-3">
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
                <div>
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

                <!-- Action Buttons -->
                <div class="flex justify-end gap-4 mt-8 pt-6 border-t border-teal-100 dark:border-teal-900/40">
                    <a href="{{ route('collections.select-patterns') }}"
                        class="px-6 py-3 rounded-lg border border-zinc-300 dark:border-zinc-600 text-zinc-700 dark:text-zinc-300 font-semibold hover:bg-zinc-100 dark:hover:bg-zinc-700 transition-all duration-200">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-8 py-3 rounded-lg bg-gradient-to-r from-teal-600 to-emerald-500 text-white font-semibold hover:from-teal-700 hover:to-emerald-600 transform hover:scale-105 transition-all duration-200 shadow-lg shadow-teal-500/25">
                        Create Collection
                    </button>
                </div>
                </div><!-- end p-8 space-y-6 -->
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
