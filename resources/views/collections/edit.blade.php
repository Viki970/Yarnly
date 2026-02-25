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
                    Edit Collection
                </span>
            </h1>
            <div class="flex items-center justify-center gap-2 mb-3">
                <span class="h-px w-12 bg-gradient-to-r from-transparent to-teal-400 dark:to-teal-400 rounded-full"></span>
                <span class="text-teal-600 dark:text-teal-300 text-xs font-semibold uppercase tracking-widest">Curate your craft</span>
                <span class="h-px w-12 bg-gradient-to-l from-transparent to-teal-400 dark:to-teal-400 rounded-full"></span>
            </div>
            <p class="text-zinc-500 dark:text-zinc-400 text-base">
                Update your collection details
            </p>
        </div>

        <!-- Collection Form -->
        <form action="{{ route('collections.update', $collection) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

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
                           value="{{ old('name', $collection->name) }}"
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
                              placeholder="Describe your collection...">{{ old('description', $collection->description) }}</textarea>
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
                        <option value="crochet" {{ old('craft_type', $collection->craft_type) == 'crochet' ? 'selected' : '' }}>Crochet</option>
                        <option value="knitting" {{ old('craft_type', $collection->craft_type) == 'knitting' ? 'selected' : '' }}>Knitting</option>
                        <option value="embroidery" {{ old('craft_type', $collection->craft_type) == 'embroidery' ? 'selected' : '' }}>Embroidery</option>
                    </select>
                    @error('craft_type')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Current Cover Image -->
                @if($collection->cover_image_path)
                    <div id="cover-image-section">
                        <label class="block text-sm font-semibold text-zinc-700 dark:text-zinc-300 mb-3">
                            Current Cover Image
                        </label>
                        <div class="bg-zinc-50 dark:bg-zinc-800/50 rounded-xl p-4 border border-zinc-200 dark:border-zinc-700">
                            <img src="{{ asset('storage/' . $collection->cover_image_path) }}" 
                                 alt="{{ $collection->name }}" 
                                 class="w-full max-w-md rounded-lg shadow-md mx-auto mb-4">
                            <div class="flex justify-center">
                                <button type="button" 
                                        id="remove-cover-btn"
                                        onclick="removeCoverImage()"
                                        class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border-2 border-red-300 dark:border-red-700 bg-white dark:bg-zinc-800 text-red-600 dark:text-red-400 font-semibold hover:bg-red-50 dark:hover:bg-red-900/20 hover:border-red-400 dark:hover:border-red-600 transition-all duration-200">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Remove Cover Image
                                </button>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Cover Image -->
                <div>
                    <label for="cover_image" class="block text-sm font-semibold text-zinc-700 dark:text-zinc-300 mb-3">
                        {{ $collection->cover_image_path ? 'Change Cover Image (Optional)' : 'Cover Image (Optional)' }}
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
                        <label class="flex items-start p-4 rounded-lg border-2 border-zinc-300 dark:border-zinc-700 cursor-pointer hover:border-teal-500 dark:hover:border-teal-400 transition-all {{ old('is_public', $collection->is_public) ? 'border-teal-500 dark:border-teal-400' : '' }}">
                            <input type="radio" 
                                   name="is_public" 
                                   value="1" 
                                   {{ old('is_public', $collection->is_public) == '1' ? 'checked' : '' }}
                                   class="mt-1 w-4 h-4 text-teal-600 focus:ring-0 cursor-pointer">
                            <div class="ml-3">
                                <span class="block font-semibold text-zinc-900 dark:text-white">Public</span>
                                <span class="block text-sm text-zinc-600 dark:text-zinc-400">Anyone can view this collection</span>
                            </div>
                        </label>
                        <label class="flex items-start p-4 rounded-lg border-2 border-zinc-300 dark:border-zinc-700 cursor-pointer hover:border-teal-500 dark:hover:border-teal-400 transition-all {{ old('is_public', $collection->is_public) == '0' ? 'border-teal-500 dark:border-teal-400' : '' }}">
                            <input type="radio" 
                                   name="is_public" 
                                   value="0" 
                                   {{ old('is_public', $collection->is_public) == '0' ? 'checked' : '' }}
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
                    <a href="{{ route('collections.show', $collection) }}"
                        class="px-6 py-3 rounded-lg border border-zinc-300 dark:border-zinc-600 text-zinc-700 dark:text-zinc-300 font-semibold hover:bg-zinc-100 dark:hover:bg-zinc-700 transition-all duration-200">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-8 py-3 rounded-lg bg-gradient-to-r from-teal-600 to-emerald-500 text-white font-semibold hover:from-teal-700 hover:to-emerald-600 transform hover:scale-105 transition-all duration-200 shadow-lg shadow-teal-500/25">
                        Update Collection
                    </button>
                </div>
                </div><!-- end p-8 space-y-6 -->
            </div>
        </form>
    </div>
</div>

<script>
// Track form changes
let formChanged = false;
const form = document.querySelector('form');

// Track when form fields change
if (form) {
    form.addEventListener('change', function() {
        formChanged = true;
    });

    form.addEventListener('input', function() {
        formChanged = true;
    });
}

// Handle cancel button clicks
document.addEventListener('DOMContentLoaded', function() {
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

function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
        formChanged = true; // Mark form as changed
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

async function removeCoverImage() {
    const button = document.getElementById('remove-cover-btn');
    const originalText = button.innerHTML;
    
    // Show loading state
    button.disabled = true;
    button.innerHTML = `
        <svg class="animate-spin h-5 w-5" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        Removing...
    `;

    try {
        const response = await fetch('{{ route("collections.remove-cover", $collection) }}', {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        });

        const data = await response.json();

        if (data.success) {
            // Remove the entire cover image section with a smooth fade
            const section = document.getElementById('cover-image-section');
            section.style.transition = 'opacity 0.3s ease-out';
            section.style.opacity = '0';
            
            setTimeout(() => {
                section.remove();
            }, 300);

            // Show success message
            const successDiv = document.createElement('div');
            successDiv.className = 'mb-6 p-4 rounded-lg bg-teal-50 dark:bg-teal-900/30 border border-teal-200 dark:border-teal-800';
            successDiv.innerHTML = '<p class="text-teal-700 dark:text-teal-300">Cover image removed successfully!</p>';
            document.querySelector('form').insertBefore(successDiv, document.querySelector('form').firstChild);
            
            // Auto-hide success message after 3 seconds
            setTimeout(() => {
                successDiv.style.transition = 'opacity 0.3s ease-out';
                successDiv.style.opacity = '0';
                setTimeout(() => successDiv.remove(), 300);
            }, 3000);

            // Reset formChanged since the removal was saved
            formChanged = false;
        } else {
            throw new Error(data.message || 'Failed to remove cover image');
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Failed to remove cover image. Please try again.');
        button.disabled = false;
        button.innerHTML = originalText;
    }
}
</script>
@endsection
