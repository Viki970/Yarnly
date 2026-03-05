@extends('layout.app')

@section('title', 'Share a Post')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-violet-50 via-white to-purple-50 dark:from-zinc-950 dark:via-zinc-900 dark:to-violet-950/20 py-12">
    <div class="container mx-auto px-4 max-w-2xl">

        <!-- Header -->
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gradient-to-br from-violet-100 to-purple-100 dark:from-violet-800/30 dark:to-purple-800/30 shadow-inner mb-4">
                <svg class="w-8 h-8 text-violet-600 dark:text-violet-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
            <h1 class="text-4xl font-extrabold tracking-tight mb-2">
                <span class="bg-gradient-to-r from-violet-700 via-purple-500 to-violet-500 dark:from-violet-300 dark:via-purple-200 dark:to-violet-200 bg-clip-text text-transparent">
                    Share Your Work
                </span>
            </h1>
            <div class="flex items-center justify-center gap-2 mb-3">
                <span class="h-px w-12 bg-gradient-to-r from-transparent to-violet-400 rounded-full"></span>
                <span class="text-violet-600 dark:text-violet-300 text-xs font-semibold uppercase tracking-widest">New Post</span>
                <span class="h-px w-12 bg-gradient-to-l from-transparent to-violet-400 rounded-full"></span>
            </div>
            <p class="text-zinc-500 dark:text-zinc-400 text-sm">Upload photos of your finished project and inspire the community</p>
        </div>

        @if(session('success'))
        <div class="mb-6 p-4 rounded-lg bg-emerald-50 dark:bg-emerald-900/30 border border-emerald-200 dark:border-emerald-800">
            <p class="text-emerald-700 dark:text-emerald-300">{{ session('success') }}</p>
        </div>
        @endif

        <!-- Form Card -->
        <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-lg border border-violet-100 dark:border-violet-900/40 overflow-hidden">
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
                @csrf

                <!-- Image Upload -->
                <div>
                    <label class="block text-sm font-semibold text-zinc-700 dark:text-zinc-300 mb-3">
                        Photos <span class="text-red-500">*</span>
                        <span class="text-zinc-500 dark:text-zinc-400 text-xs font-normal ml-2">(Up to 10 images, max 5MB each)</span>
                    </label>

                    <div id="dropzone"
                         class="relative flex flex-col items-center justify-center border-2 border-dashed border-violet-300 dark:border-violet-700 rounded-xl p-8 cursor-pointer hover:border-violet-500 dark:hover:border-violet-500 transition-colors group bg-violet-50/50 dark:bg-violet-950/20">
                        <input type="file" id="images" name="images[]" accept="image/jpeg,image/png,image/jpg,image/webp"
                               multiple class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                        <div class="flex flex-col items-center gap-2 pointer-events-none">
                            <svg class="w-10 h-10 text-violet-400 dark:text-violet-500 group-hover:text-violet-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <p class="text-sm font-medium text-violet-700 dark:text-violet-300">Click or drag photos here</p>
                            <p class="text-xs text-zinc-500 dark:text-zinc-400">JPEG, PNG, WebP</p>
                        </div>
                    </div>

                    <div id="image-preview" class="mt-4 grid grid-cols-3 sm:grid-cols-5 gap-3 hidden"></div>

                    @error('images')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                    @error('images.*')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Craft Type -->
                <div>
                    <label class="block text-sm font-semibold text-zinc-700 dark:text-zinc-300 mb-3">
                        Craft Type <span class="text-red-500">*</span>
                    </label>
                    <div class="grid grid-cols-3 gap-3">
                        {{-- Crochet --}}
                        <label class="relative cursor-pointer">
                            <input type="radio" name="craft_type" value="crochet"
                                   {{ old('craft_type') === 'crochet' ? 'checked' : '' }}
                                   class="sr-only peer">
                            <div class="flex flex-col items-center gap-2 py-4 px-2 rounded-xl border-2 border-zinc-200 dark:border-zinc-700 peer-checked:border-emerald-500 peer-checked:bg-emerald-50 dark:peer-checked:bg-emerald-950/30 dark:peer-checked:border-emerald-500 transition-all hover:border-emerald-300 dark:hover:border-emerald-600">
                                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600 dark:bg-emerald-900/30 dark:text-emerald-400">
                                    <svg class="h-9 w-9 transform rotate-45" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2c-1.2 0-2.2.8-2.2 1.8v8.4c-.2.1-.4.3-.4.6l-.3 8.4c0 .2.1.3.2.4.1.1.3.2.4.2h1.8c.2 0 .3-.1.4-.2.1-.1.2-.2.2-.4l-.3-8.4c0-.2-.1-.4-.3-.5V4.6c0-.1 0-.1 0-.1 0 0 .1 0 .1 0 .1 0 .2.1.2.2v.6c0 .3.3.6.6.6.7 0 1.2-.5 1.2-1.2v-.3C13.2 2.8 12.4 2 12 2z" />
                                    </svg>
                                </div>
                                <span class="text-xs font-semibold text-zinc-700 dark:text-zinc-300">Crochet</span>
                            </div>
                        </label>
                        {{-- Knitting --}}
                        <label class="relative cursor-pointer">
                            <input type="radio" name="craft_type" value="knitting"
                                   {{ old('craft_type') === 'knitting' ? 'checked' : '' }}
                                   class="sr-only peer">
                            <div class="flex flex-col items-center gap-2 py-4 px-2 rounded-xl border-2 border-zinc-200 dark:border-zinc-700 peer-checked:border-violet-500 peer-checked:bg-violet-50 dark:peer-checked:bg-violet-950/30 dark:peer-checked:border-violet-500 transition-all hover:border-violet-300 dark:hover:border-violet-600">
                                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-violet-100 text-violet-600 dark:bg-violet-900/30 dark:text-violet-400">
                                    <svg class="h-10 w-14" fill="currentColor" viewBox="0 0 512 768">
                                        <path d="M506.267,495.415l-224.299-78.02l121.182-42.146c10.795,15.573,28.774,25.822,49.118,25.822     c32.93,0,59.733-26.803,59.733-59.733c0-32.93-26.803-59.733-59.733-59.733c-32.93,0-59.733,26.803-59.733,59.733     c0,6.46,1.067,12.672,2.97,18.5l-139.503,48.529l-139.503-48.529c1.903-5.828,2.97-12.041,2.97-18.5     c0-32.93-26.803-59.733-59.733-59.733S0.002,308.407,0.002,341.337c0,32.93,26.803,59.733,59.733,59.733     c20.343,0,38.323-10.24,49.118-25.822l121.182,42.146L5.736,495.415c-4.463,1.545-6.81,6.409-5.257,10.854     c1.22,3.524,4.523,5.734,8.055,5.734c0.93,0,1.877-0.154,2.799-0.478l244.668-85.103l244.668,85.103     c0.922,0.324,1.869,0.478,2.799,0.478c3.533,0,6.835-2.21,8.055-5.734C513.077,501.823,510.73,496.959,506.267,495.415z      M460.802,315.737c4.719,0,8.533,3.814,8.533,8.533c0,4.719-3.814,8.533-8.533,8.533c-9.412,0-17.067,7.654-17.067,17.067     c0,4.719-3.814,8.533-8.533,8.533s-8.533-3.814-8.533-8.533C426.668,331.046,441.977,315.737,460.802,315.737z M68.268,332.803     c-9.412,0-17.067,7.654-17.067,17.067c0,4.719-3.814,8.533-8.533,8.533s-8.533-3.814-8.533-8.533     c0-18.825,15.309-34.133,34.133-34.133c4.719,0,8.533,3.814,8.533,8.533C76.802,328.989,72.987,332.803,68.268,332.803z" />
                                    </svg>
                                </div>
                                <span class="text-xs font-semibold text-zinc-700 dark:text-zinc-300">Knitting</span>
                            </div>
                        </label>
                        {{-- Embroidery --}}
                        <label class="relative cursor-pointer">
                            <input type="radio" name="craft_type" value="embroidery"
                                   {{ old('craft_type') === 'embroidery' ? 'checked' : '' }}
                                   class="sr-only peer">
                            <div class="flex flex-col items-center gap-2 py-4 px-2 rounded-xl border-2 border-zinc-200 dark:border-zinc-700 peer-checked:border-rose-500 peer-checked:bg-rose-50 dark:peer-checked:bg-rose-950/30 dark:peer-checked:border-rose-500 transition-all hover:border-rose-300 dark:hover:border-rose-600">
                                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-rose-100 text-rose-600 dark:bg-rose-900/30 dark:text-rose-400">
                                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 274 274">
                                        <path d="M262.353,170.603c-0.792-2.288-19.578-56.177-45.5-69.878c-1.554-0.818-3.18-1.652-4.847-2.501    c7.783-26.139,10.299-47.996,5.188-66.953c-4.981-18.491-22.059-32.213-38.856-31.219c-14.794,0.865-25.295,12.718-28.097,31.701    c-0.88,5.965-0.834,11.387-0.171,16.43c-3.469,4.836-5.841,9.036-6.543,10.325L13.143,266.149    c-0.997,1.579-2.231,3.547-0.955,5.872l1.229,2.206h2.509c2.201,0,3.379-1.476,4.513-2.895L170.42,83.093    c9.569,8.114,21.034,14.245,31.375,19.49c-4.635,14.333-10.776,30.049-18.046,47.328c-19.957,47.483-10.657,86.687,3.401,95.64    c0.705,0.451,1.492,0.663,2.279,0.663c1.402,0,2.77-0.694,3.583-1.968c1.248-1.973,0.673-4.604-1.305-5.852    c-9.896-6.302-18.662-41.109-0.135-85.19c7.13-16.953,13.204-32.467,17.875-46.753c1.186,0.605,2.34,1.201,3.453,1.786    c22.96,12.138,41.26,64.612,41.436,65.136c0.767,2.217,3.18,3.392,5.396,2.631C261.934,175.227,263.115,172.814,262.353,170.603z     M153.986,80.063l-8.353,6.902l3.299-10.325c0.973-3.024,2.791-8.383,5.203-14.131c1.885,4.085,4.272,7.819,7.048,11.236    C157.973,76.713,155.27,79.002,153.986,80.063z M167.345,67.781c-3.671-4.722-6.426-10.077-7.954-16.181    c4.106-7.322,9.021-13.241,14.209-13.241c1.435,0,2.817,0.409,4.096,1.222c2.123,1.341,3.319,3.365,3.48,5.851    C181.564,51.579,174.481,60.464,167.345,67.781z M204.333,94.345c-9.823-5.007-20.164-10.651-28.589-17.891    c5.634-7.28,16.669-23.229,15.198-34.932c-0.513-4.096-2.517-7.482-5.789-9.792c-2.714-1.9-5.686-2.874-8.839-2.874    c-6.551,0-12.868,4.339-18.201,9.704c0.083-1.802,0.232-3.646,0.518-5.571c2.2-14.934,9.569-23.855,20.205-24.477    c0.378-0.021,0.771-0.037,1.16-0.037c11.143,0,24.72,9.088,29.013,24.995C213.57,50.414,211.343,70.354,204.333,94.345z" />
                                    </svg>
                                </div>
                                <span class="text-xs font-semibold text-zinc-700 dark:text-zinc-300">Embroidery</span>
                            </div>
                        </label>
                    </div>
                    @error('craft_type')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-semibold text-zinc-700 dark:text-zinc-300 mb-3">
                        Description
                        <span class="text-zinc-500 dark:text-zinc-400 text-xs font-normal ml-2">(Optional)</span>
                    </label>
                    <textarea id="description" name="description" rows="4"
                              placeholder="Tell us about your project — yarn used, how long it took, what inspired you..."
                              class="w-full px-4 py-3 rounded-lg border border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white placeholder-zinc-400 focus:ring-2 focus:ring-violet-500 focus:border-transparent transition-all resize-none">{{ old('description') }}</textarea>
                    <div class="flex justify-end mt-1">
                        <span id="desc-count" class="text-xs text-zinc-400">0 / 2000</span>
                    </div>
                    @error('description')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tags -->
                <div>
                    <label for="tags" class="block text-sm font-semibold text-zinc-700 dark:text-zinc-300 mb-3">
                        Tags
                        <span class="text-zinc-500 dark:text-zinc-400 text-xs font-normal ml-2">(Optional — separate with commas)</span>
                    </label>
                    <input type="text" id="tags" name="tags" value="{{ old('tags') }}"
                           placeholder="e.g. amigurumi, beginner, colorful, gift"
                           class="w-full px-4 py-3 rounded-lg border border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white placeholder-zinc-400 focus:ring-2 focus:ring-violet-500 focus:border-transparent transition-all">
                    @error('tags')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Actions -->
                <div class="flex justify-end gap-4 pt-4 border-t border-violet-100 dark:border-violet-900/40">
                    <a href="{{ url()->previous() }}"
                       class="px-6 py-3 rounded-lg border border-zinc-300 dark:border-zinc-600 text-zinc-700 dark:text-zinc-300 font-semibold hover:bg-zinc-100 dark:hover:bg-zinc-700 transition-all duration-200">
                        Cancel
                    </a>
                    <button type="submit"
                            class="px-8 py-3 rounded-lg bg-gradient-to-r from-violet-600 to-purple-500 text-white font-semibold hover:from-violet-700 hover:to-purple-600 transform hover:scale-105 transition-all duration-200 shadow-lg shadow-violet-500/25">
                        Share Post
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
    const input    = document.getElementById('images');
    const preview  = document.getElementById('image-preview');
    const dropzone = document.getElementById('dropzone');

    input.addEventListener('change', renderPreviews);

    function renderPreviews() {
        preview.innerHTML = '';
        const files = Array.from(input.files).slice(0, 10);
        if (!files.length) { preview.classList.add('hidden'); return; }
        preview.classList.remove('hidden');
        files.forEach((file, i) => {
            const reader = new FileReader();
            reader.onload = e => {
                const wrapper = document.createElement('div');
                wrapper.className = 'relative group rounded-xl overflow-hidden aspect-square bg-zinc-100 dark:bg-zinc-800';
                wrapper.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover" alt="preview ${i+1}">
                    <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                        <span class="text-white text-xs font-semibold">${i+1}</span>
                    </div>`;
                preview.appendChild(wrapper);
            };
            reader.readAsDataURL(file);
        });
    }

    dropzone.addEventListener('dragover',  e => { e.preventDefault(); dropzone.classList.add('border-violet-500'); });
    dropzone.addEventListener('dragleave', () => dropzone.classList.remove('border-violet-500'));
    dropzone.addEventListener('drop',      e => { e.preventDefault(); dropzone.classList.remove('border-violet-500'); input.files = e.dataTransfer.files; renderPreviews(); });

    const desc  = document.getElementById('description');
    const count = document.getElementById('desc-count');
    desc.addEventListener('input', () => { count.textContent = desc.value.length + ' / 2000'; });
</script>
@endpush
