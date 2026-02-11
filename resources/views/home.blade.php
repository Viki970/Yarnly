@extends('layout.app')

@section('title', 'Yarnly - Home')

@push('scripts')
@fluxScripts
@endpush

@section('content')

<!-- ============================================ -->
<!-- HERO SECTION - Blue (matches Home navbar icon) -->
<!-- Purpose: Main landing section with welcome message and CTA buttons -->
<!-- ============================================ -->
<section id="home" class="relative overflow-hidden bg-gradient-to-br from-blue-50 via-indigo-50 to-sky-50 py-20 dark:from-blue-950/40 dark:via-indigo-950/40 dark:to-sky-950/40">
    <div class="absolute -left-16 top-10 h-64 w-64 rounded-full bg-blue-400/30 blur-3xl dark:bg-blue-700/30"></div>
    <div class="absolute -right-10 bottom-10 h-72 w-72 rounded-full bg-sky-300/25 blur-3xl dark:bg-sky-600/25"></div>
    <div class="max-w-6xl mx-auto px-6 text-center lg:px-12">
        <div class="inline-flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-500 to-sky-500 mb-6 shadow-xl shadow-blue-500/30">
            <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
        </div>
        <h1 class="bg-gradient-to-r from-blue-600 via-indigo-600 to-sky-600 bg-clip-text text-5xl font-bold tracking-tight text-transparent sm:text-6xl lg:text-7xl dark:from-blue-400 dark:via-indigo-400 dark:to-sky-400">
            Welcome to Yarnly
        </h1>
        <p class="mt-6 max-w-3xl mx-auto text-xl leading-relaxed text-zinc-600 dark:text-zinc-300">
            Your complete yarn crafting studio. Explore patterns, manage projects, organize your stash, learn new techniques, and connect with a vibrant community.
        </p>
        <div class="mt-10 flex flex-wrap justify-center gap-4">
            @guest
            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="inline-flex items-center justify-center gap-2 rounded-full bg-gradient-to-r from-blue-600 via-indigo-600 to-sky-600 px-10 py-4 text-sm font-bold text-white shadow-2xl shadow-blue-500/50 transition hover:scale-110 hover:shadow-blue-600/60">
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none">
                    <path d="M8.03339 3.65784C8.37932 2.78072 9.62068 2.78072 9.96661 3.65785L11.0386 6.37599C11.1442 6.64378 11.3562 6.85576 11.624 6.96137L14.3422 8.03339C15.2193 8.37932 15.2193 9.62068 14.3422 9.96661L11.624 11.0386C11.3562 11.1442 11.1442 11.3562 11.0386 11.624L9.96661 14.3422C9.62067 15.2193 8.37932 15.2193 8.03339 14.3422L6.96137 11.624C6.85575 11.3562 6.64378 11.1442 6.37599 11.0386L3.65784 9.96661C2.78072 9.62067 2.78072 8.37932 3.65785 8.03339L6.37599 6.96137C6.64378 6.85575 6.85576 6.64378 6.96137 6.37599L8.03339 3.65784Z" stroke="currentColor" stroke-width="1.5" />
                    <path d="M16.4885 13.3481C16.6715 12.884 17.3285 12.884 17.5115 13.3481L18.3121 15.3781C18.368 15.5198 18.4802 15.632 18.6219 15.6879L20.6519 16.4885C21.116 16.6715 21.116 17.3285 20.6519 17.5115L18.6219 18.3121C18.4802 18.368 18.368 18.4802 18.3121 18.6219L17.5115 20.6519C17.3285 21.116 16.6715 21.116 16.4885 20.6519L15.6879 18.6219C15.632 18.4802 15.5198 18.368 15.3781 18.3121L13.3481 17.5115C12.884 17.3285 12.884 16.6715 13.3481 16.4885L15.3781 15.6879C15.5198 15.632 15.632 15.5198 15.6879 15.3781L16.4885 13.3481Z" stroke="currentColor" stroke-width="1.5" />
                </svg>
                Start Creating
            </a>
            @endif
            @if (Route::has('login'))
            <a href="{{ route('login') }}" class="inline-flex items-center justify-center gap-2 rounded-full border-2 border-blue-300 bg-white/80 px-10 py-4 text-sm font-bold text-blue-700 shadow-lg transition hover:border-blue-400 hover:bg-white dark:border-blue-700 dark:bg-zinc-900/80 dark:text-blue-300 dark:hover:border-blue-600">
                Sign In
            </a>
            @endif
            @else
            @if(auth()->user()->is_admin)
            <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center gap-2 rounded-full bg-gradient-to-r from-blue-600 via-indigo-600 to-sky-600 px-10 py-4 text-sm font-bold text-white shadow-2xl shadow-blue-500/50 transition hover:scale-110 hover:shadow-blue-600/60">
                <svg class="h-8 w-8 text-white" viewBox="0 0 24 24" fill="none">

                    <g id="SVGRepo_bgCarrier" stroke-width="0" />

                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />

                    <g id="SVGRepo_iconCarrier">
                        <path d="M6.07821 13.4174C6.37128 13.1247 6.37157 12.6498 6.07886 12.3567C5.78614 12.0636 5.31127 12.0634 5.0182 12.3561L6.07821 13.4174ZM3.85646 14.5764L3.32646 14.0457V14.0457L3.85646 14.5764ZM2.31852 13.0403L1.78851 12.5097L1.78851 12.5097L2.31852 13.0403ZM3.00232 13.4174C3.29539 13.1247 3.29568 12.6498 3.00297 12.3567C2.71025 12.0636 2.23538 12.0634 1.94231 12.3561L3.00232 13.4174ZM11.6057 18.987C11.8988 18.6943 11.8991 18.2194 11.6063 17.9263C11.3136 17.6332 10.8388 17.633 10.5457 17.9257L11.6057 18.987ZM9.38395 20.146L9.91396 20.6767L9.38395 20.146ZM10.9219 21.6821L11.4519 22.2127V22.2127L10.9219 21.6821ZM11.6057 22.0591C11.8988 21.7664 11.8991 21.2915 11.6063 20.9985C11.3136 20.7054 10.8388 20.7051 10.5457 20.9978L11.6057 22.0591ZM10.6328 17.186C10.9257 16.8931 10.9257 16.4182 10.6328 16.1253C10.3399 15.8324 9.86499 15.8324 9.5721 16.1253L10.6328 17.186ZM7.46967 18.2277C7.17678 18.5206 7.17678 18.9955 7.46967 19.2884C7.76256 19.5813 8.23744 19.5813 8.53033 19.2884L7.46967 18.2277ZM7.85705 14.4136C8.14994 14.1207 8.14994 13.6459 7.85705 13.353C7.56415 13.0601 7.08928 13.0601 6.79639 13.353L7.85705 14.4136ZM4.67948 15.4699C4.38659 15.7628 4.38659 16.2376 4.67948 16.5305C4.97238 16.8234 5.44725 16.8234 5.74014 16.5305L4.67948 15.4699ZM7.46042 17.5818C7.75656 17.2921 7.76184 16.8173 7.47223 16.5212C7.18261 16.225 6.70777 16.2197 6.41163 16.5094L7.46042 17.5818ZM4.70206 18.1813C4.40592 18.4709 4.40064 18.9458 4.69026 19.2419C4.97987 19.538 5.45472 19.5433 5.75085 19.2537L4.70206 18.1813ZM5.0182 12.3561L3.32646 14.0457L4.38647 15.1071L6.07821 13.4174L5.0182 12.3561ZM2.84853 13.571L3.00232 13.4174L1.94231 12.3561L1.78851 12.5097L2.84853 13.571ZM2.84853 14.0457C2.71716 13.9145 2.71716 13.7022 2.84853 13.571L1.78851 12.5097C1.0705 13.2268 1.0705 14.3899 1.78851 15.1071L2.84853 14.0457ZM3.32646 14.0457C3.19458 14.1775 2.9804 14.1775 2.84853 14.0457L1.78851 15.1071C2.50602 15.8237 3.66896 15.8237 4.38647 15.1071L3.32646 14.0457ZM10.5457 17.9257L8.85394 19.6154L9.91396 20.6767L11.6057 18.987L10.5457 17.9257ZM11.4519 22.2127L11.6057 22.0591L10.5457 20.9978L10.3919 21.1514L11.4519 22.2127ZM8.85394 22.2127C9.57145 22.9294 10.7344 22.9294 11.4519 22.2127L10.3919 21.1514C10.26 21.2831 10.0458 21.2831 9.91396 21.1514L8.85394 22.2127ZM8.85394 19.6154C8.13593 20.3325 8.13593 21.4956 8.85394 22.2127L9.91396 21.1514C9.78259 21.0202 9.78259 20.8079 9.91396 20.6767L8.85394 19.6154ZM9.5721 16.1253L7.46967 18.2277L8.53033 19.2884L10.6328 17.186L9.5721 16.1253ZM6.79639 13.353L4.67948 15.4699L5.74014 16.5305L7.85705 14.4136L6.79639 13.353ZM6.41163 16.5094L4.70206 18.1813L5.75085 19.2537L7.46042 17.5818L6.41163 16.5094Z" fill="#fff" />
                        <path d="M9.74292 13.0566L10.2725 12.5254L9.74292 13.0566ZM9.74292 8.40116L9.21339 7.87003H9.21339L9.74292 8.40116ZM15.5797 14.2204L16.1092 14.7515V14.7515L15.5797 14.2204ZM10.9103 14.2204L10.3807 14.7515L10.9103 14.2204ZM20.5495 9.26548L20.02 8.73435L20.5495 9.26548ZM15.9551 1.49472C15.5723 1.65283 15.3901 2.09136 15.5482 2.47421C15.7063 2.85706 16.1448 3.03925 16.5277 2.88115L15.9551 1.49472ZM9.79706 13.1073C9.50373 13.3998 9.50302 13.8747 9.79547 14.168C10.0879 14.4613 10.5628 14.4621 10.8561 14.1696L9.79706 13.1073ZM12.6072 12.4238C12.9005 12.1314 12.9012 11.6565 12.6087 11.3632C12.3163 11.0698 11.8414 11.0691 11.5481 11.3616L12.6072 12.4238ZM13.6861 15.786L13.9453 16.4897L13.6861 15.786ZM8.18721 10.2514L7.49137 9.97154L8.18721 10.2514ZM14.4546 4.76267C14.748 4.47021 14.7487 3.99534 14.4562 3.70201C14.1638 3.40868 13.6889 3.40796 13.3956 3.70041L14.4546 4.76267ZM20.02 8.73435L15.0501 13.6893L16.1092 14.7515L21.079 9.79661L20.02 8.73435ZM11.4398 13.6893L10.2725 12.5254L9.21339 13.5877L10.3807 14.7515L11.4398 13.6893ZM18.2148 2.75H18.6983V1.25H18.2148V2.75ZM21.2501 5.29186V5.77394H22.7501V5.29186H21.2501ZM18.6983 2.75C19.4977 2.75 20.022 2.75158 20.4101 2.80361C20.7769 2.85278 20.9079 2.93434 20.987 3.01321L22.0461 1.95096C21.6417 1.54774 21.1417 1.38826 20.6094 1.31691C20.0985 1.24842 19.4554 1.25 18.6983 1.25V2.75ZM22.7501 5.29186C22.7501 4.53722 22.7517 3.89558 22.6829 3.38559C22.6112 2.85381 22.4508 2.35448 22.0461 1.95096L20.987 3.01321C21.0658 3.09176 21.1472 3.22143 21.1964 3.58606C21.2485 3.9725 21.2501 4.49469 21.2501 5.29186H22.7501ZM10.2725 12.5254C9.70713 11.9618 9.33773 11.5913 9.10037 11.2811C8.87618 10.9881 8.84204 10.8391 8.84204 10.7289H7.34204C7.34204 11.3004 7.58305 11.7666 7.90915 12.1927C8.22209 12.6016 8.67813 13.054 9.21339 13.5877L10.2725 12.5254ZM10.3807 14.7515C10.916 15.2852 11.3698 15.7398 11.7798 16.0518C12.2073 16.3769 12.6738 16.6163 13.245 16.6163V15.1163C13.1323 15.1163 12.9818 15.0814 12.688 14.8579C12.3768 14.6212 12.0051 14.2529 11.4398 13.6893L10.3807 14.7515ZM21.079 9.79661C21.7513 9.12636 22.2451 8.65287 22.5042 8.02914L21.119 7.45364C21.0011 7.73733 20.7792 7.97743 20.02 8.73435L21.079 9.79661ZM21.2501 5.77394C21.2501 6.84444 21.2367 7.1702 21.119 7.45364L22.5042 8.02914C22.7634 7.40516 22.7501 6.72176 22.7501 5.77394H21.2501ZM18.2148 1.25C17.2636 1.25 16.5797 1.23679 15.9551 1.49472L16.5277 2.88115C16.8133 2.76321 17.1415 2.75 18.2148 2.75V1.25ZM10.8561 14.1696L12.6072 12.4238L11.5481 11.3616L9.79706 13.1073L10.8561 14.1696ZM15.0501 13.6893C14.6145 14.1236 14.2907 14.4459 14.0134 14.6853C13.7349 14.9258 13.557 15.0343 13.4268 15.0822L13.9453 16.4897C14.3279 16.3488 14.6681 16.1019 14.9938 15.8205C15.3208 15.5381 15.6875 15.172 16.1092 14.7515L15.0501 13.6893ZM13.4268 15.0822C13.3601 15.1068 13.3031 15.1163 13.245 15.1163V16.6163C13.489 16.6163 13.7212 16.5723 13.9453 16.4897L13.4268 15.0822ZM9.21339 7.87003C8.8017 8.28048 8.44233 8.63824 8.16266 8.9574C7.88434 9.27503 7.63891 9.60463 7.49137 9.97154L8.88306 10.5312C8.93632 10.3987 9.05058 10.2201 9.29083 9.94596C9.52973 9.67332 9.84781 9.35566 10.2725 8.93229L9.21339 7.87003ZM7.49137 9.97154C7.39467 10.212 7.34204 10.4628 7.34204 10.7289H8.84204C8.84204 10.6676 8.85286 10.6063 8.88306 10.5312L7.49137 9.97154ZM10.2725 8.93229L14.4546 4.76267L13.3956 3.70041L9.21339 7.87003L10.2725 8.93229Z" fill="#fff" />
                        <path d="M8.03732 10.1018L8.56765 9.57148L8.56686 9.57068L8.03732 10.1018ZM11.6708 6.70352C12.0191 6.92769 12.4831 6.82707 12.7073 6.47876C12.9315 6.13045 12.8309 5.66636 12.4826 5.44219L11.6708 6.70352ZM11.5418 5.72863L11.9477 5.09796L11.9477 5.09796L11.5418 5.72863ZM9.35765 4.60789L9.46729 3.86595L9.35765 4.60789ZM5.19137 7.12001L5.7209 7.65114V7.65114L5.19137 7.12001ZM7.8385 4.80203L8.12592 5.49477L7.8385 4.80203ZM5.73367 8.31238L5.45738 9.00964L5.45738 9.00964L5.73367 8.31238ZM5.5527 9.04774C5.93568 9.20553 6.37406 9.02298 6.53185 8.64C6.68964 8.25702 6.50709 7.81863 6.12411 7.66084L5.5527 9.04774ZM5.41182 8.18485L5.68811 7.4876L5.6881 7.4876L5.41182 8.18485ZM7.6568 10.7819C7.94969 11.0748 8.42456 11.0748 8.71746 10.7819C9.01035 10.489 9.01035 10.0142 8.71746 9.72128L7.6568 10.7819ZM8.15854 9.1636C7.86521 8.87114 7.39034 8.87186 7.09789 9.16519C6.80543 9.45852 6.80615 9.93339 7.09948 10.2258L8.15854 9.1636ZM12.4826 5.44219L11.9477 5.09796L11.1359 6.35929L11.6708 6.70352L12.4826 5.44219ZM11.9477 5.09796C11.421 4.75893 10.9904 4.48119 10.6187 4.28092C10.2377 4.07557 9.87347 3.92597 9.46729 3.86595L9.248 5.34983C9.41668 5.37476 9.60814 5.44027 9.9072 5.60142C10.2157 5.76764 10.5898 6.0078 11.1359 6.35929L11.9477 5.09796ZM5.7209 7.65114C6.19994 7.17354 6.71143 6.6638 7.17057 6.24495C7.39993 6.03572 7.60728 5.85743 7.78387 5.72132C7.97207 5.57626 8.08295 5.5126 8.12592 5.49477L7.55107 4.10929C7.31817 4.20593 7.07924 4.37058 6.86816 4.53327C6.64547 4.70491 6.40406 4.91382 6.15964 5.13679C5.6712 5.58237 5.13501 6.11714 4.66185 6.58887L5.7209 7.65114ZM9.46729 3.86595C8.82208 3.77059 8.15942 3.85688 7.55107 4.10929L8.12592 5.49477C8.49073 5.34341 8.87932 5.29534 9.248 5.34983L9.46729 3.86595ZM5.13554 8.88211L5.45738 9.00964L6.00995 7.61513L5.68811 7.4876L5.13554 8.88211ZM5.45738 9.00964C5.51174 9.03118 5.53257 9.03945 5.5527 9.04774L6.12411 7.66084C6.09245 7.6478 6.06072 7.63524 6.00995 7.61513L5.45738 9.00964ZM4.66185 6.58887C3.9466 7.30195 4.19893 8.51098 5.13554 8.88211L5.6881 7.4876C5.75268 7.51318 5.77259 7.5996 5.7209 7.65114L4.66185 6.58887ZM7.50699 10.6321L7.6568 10.7819L8.71746 9.72128L8.56765 9.57148L7.50699 10.6321ZM7.09948 10.2258L7.50779 10.6329L8.56686 9.57068L8.15854 9.1636L7.09948 10.2258Z" fill="#fff" />
                        <path d="M13.9246 16.025L13.3942 16.5553C13.4058 16.5669 13.4178 16.5781 13.4301 16.5889L13.9246 16.025ZM18.5443 11.4859C18.3191 11.1382 17.8548 11.0389 17.5071 11.264C17.1594 11.4891 17.06 11.9535 17.2852 12.3012L18.5443 11.4859ZM18.26 12.4268L17.6304 12.8344L17.6304 12.8344L18.26 12.4268ZM19.3841 14.6044L20.1259 14.4941L19.3841 14.6044ZM16.8644 18.7582L16.3349 18.2271L16.3349 18.2271L16.8644 18.7582ZM19.1894 16.119L18.4972 15.8301L19.1894 16.119ZM16.5329 18.3607C16.3796 17.976 15.9433 17.7884 15.5585 17.9418C15.1738 18.0951 14.9862 18.5314 15.1396 18.9162L16.5329 18.3607ZM13.8746 16.9786C14.186 17.2517 14.6599 17.2206 14.933 16.9091C15.206 16.5977 15.1749 16.1238 14.8635 15.8507L13.8746 16.9786ZM16.793 18.8294L17.3225 19.3605L17.3225 19.3605L16.793 18.8294ZM14.2159 15.2556C13.923 14.9627 13.4481 14.9627 13.1552 15.2556C12.8623 15.5485 12.8623 16.0234 13.1552 16.3163L14.2159 15.2556ZM17.2852 12.3012L17.6304 12.8344L18.8895 12.0192L18.5443 11.4859L17.2852 12.3012ZM16.3349 18.2271L16.2634 18.2983L17.3225 19.3605L17.394 19.2893L16.3349 18.2271ZM17.6304 12.8344C17.983 13.379 18.2238 13.7518 18.3905 14.0592C18.552 14.3573 18.6174 14.5475 18.6423 14.7147L20.1259 14.4941C20.0656 14.0882 19.9152 13.7245 19.7092 13.3444C19.5082 12.9737 19.2296 12.5443 18.8895 12.0192L17.6304 12.8344ZM17.394 19.2893C17.8671 18.8176 18.4035 18.283 18.8504 17.796C19.0741 17.5523 19.2836 17.3116 19.4558 17.0895C19.619 16.8791 19.7843 16.6406 19.8815 16.4079L18.4972 15.8301C18.4796 15.8724 18.416 15.9827 18.2704 16.1704C18.1339 16.3464 17.9552 16.5531 17.7453 16.7818C17.3252 17.2395 16.8139 17.7495 16.3349 18.2271L17.394 19.2893ZM18.6423 14.7147C18.6967 15.081 18.6487 15.4672 18.4972 15.8301L19.8815 16.4079C20.135 15.8005 20.2218 15.1387 20.1259 14.4941L18.6423 14.7147ZM14.8635 15.8507L14.419 15.461L13.4301 16.5889L13.8746 16.9786L14.8635 15.8507ZM16.2634 18.2983C16.3072 18.2547 16.3661 18.2444 16.4081 18.2528C16.4504 18.2613 16.5069 18.2955 16.5329 18.3607L15.1396 18.9162C15.4965 19.8115 16.6547 20.0263 17.3225 19.3605L16.2634 18.2983ZM14.4549 15.4946L14.2159 15.2556L13.1552 16.3163L13.3942 16.5553L14.4549 15.4946Z" fill="#fff" />
                        <path d="M15.0499 9.41414C15.3433 9.7066 15.8182 9.70588 16.1106 9.41255C16.4031 9.11922 16.4023 8.64434 16.109 8.35189L15.0499 9.41414ZM17.3846 8.35189C17.0913 8.64434 17.0906 9.11922 17.383 9.41255C17.6755 9.70588 18.1504 9.7066 18.4437 9.41414L17.3846 8.35189ZM18.4437 6.0242C17.5063 5.08959 15.9874 5.08959 15.0499 6.0242L16.109 7.08645C16.461 6.73551 17.0326 6.73551 17.3846 7.08645L18.4437 6.0242ZM15.0499 6.0242C14.1113 6.96005 14.1113 8.47829 15.0499 9.41414L16.109 8.35189C15.7583 8.00219 15.7583 7.43615 16.109 7.08645L15.0499 6.0242ZM18.4437 9.41414C19.3824 8.47829 19.3824 6.96005 18.4437 6.0242L17.3846 7.08645C17.7354 7.43615 17.7354 8.00219 17.3846 8.35189L18.4437 9.41414Z" fill="#fff" />
                    </g>

                </svg> Go to Dashboard
            </a>
            @else
            <a href="{{ route('patterns.crochet') }}" class="inline-flex items-center justify-center gap-2 rounded-full bg-gradient-to-r from-blue-600 via-indigo-600 to-sky-600 px-10 py-4 text-sm font-bold text-white shadow-2xl shadow-blue-500/50 transition hover:scale-110 hover:shadow-blue-600/60">
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none">
                    <path d="M8.03339 3.65784C8.37932 2.78072 9.62068 2.78072 9.96661 3.65785L11.0386 6.37599C11.1442 6.64378 11.3562 6.85576 11.624 6.96137L14.3422 8.03339C15.2193 8.37932 15.2193 9.62068 14.3422 9.96661L11.624 11.0386C11.3562 11.1442 11.1442 11.3562 11.0386 11.624L9.96661 14.3422C9.62067 15.2193 8.37932 15.2193 8.03339 14.3422L6.96137 11.624C6.85575 11.3562 6.64378 11.1442 6.37599 11.0386L3.65784 9.96661C2.78072 9.62067 2.78072 8.37932 3.65785 8.03339L6.37599 6.96137C6.64378 6.85575 6.85576 6.64378 6.96137 6.37599L8.03339 3.65784Z" stroke="currentColor" stroke-width="1.5" />
                    <path d="M16.4885 13.3481C16.6715 12.884 17.3285 12.884 17.5115 13.3481L18.3121 15.3781C18.368 15.5198 18.4802 15.632 18.6219 15.6879L20.6519 16.4885C21.116 16.6715 21.116 17.3285 20.6519 17.5115L18.6219 18.3121C18.4802 18.368 18.368 18.4802 18.3121 18.6219L17.5115 20.6519C17.3285 21.116 16.6715 21.116 16.4885 20.6519L15.6879 18.6219C15.632 18.4802 15.5198 18.368 15.3781 18.3121L13.3481 17.5115C12.884 17.3285 12.884 16.6715 13.3481 16.4885L15.3781 15.6879C15.5198 15.632 15.632 15.5198 15.6879 15.3781L16.4885 13.3481Z" stroke="currentColor" stroke-width="1.5" />
                </svg> Explore Patterns
            </a>
            @endif
            @endguest
        </div>
    </div>
</section>

<!-- ============================================ -->
<!-- PATTERNS SECTION - Emerald (matches Patterns navbar icon) -->
<!-- Purpose: Showcase pattern types - Crochet, Knitting, Embroidery -->
<!-- ============================================ -->
<section id="patterns" class="relative overflow-hidden bg-gradient-to-br from-emerald-50 via-teal-50 to-green-50 py-20 dark:from-emerald-950/40 dark:via-teal-950/40 dark:to-green-950/40">
    <div class="absolute -left-20 top-20 h-80 w-80 rounded-full bg-emerald-400/20 blur-3xl dark:bg-emerald-700/25"></div>
    <div class="absolute -right-16 bottom-20 h-64 w-64 rounded-full bg-teal-300/25 blur-3xl dark:bg-teal-600/20"></div>
    <div class="max-w-6xl mx-auto px-6 lg:px-12">
        <div class="text-center mb-12">
            <div class="inline-flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-500 mb-6 shadow-xl shadow-emerald-500/30">
                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
            </div>
            <h2 class="bg-gradient-to-r from-emerald-600 via-teal-600 to-green-600 bg-clip-text text-4xl font-bold tracking-tight text-transparent sm:text-5xl dark:from-emerald-400 dark:via-teal-400 dark:to-green-400">
                Pattern Library
            </h2>
            <p class="mt-4 max-w-2xl mx-auto text-lg text-zinc-600 dark:text-zinc-300">
                Discover thousands of crochet, knitting, and embroidery patterns. AI-powered organization keeps everything searchable.
            </p>
        </div>
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            <article class="rounded-3xl border border-emerald-300/70 bg-gradient-to-br from-emerald-100 to-teal-100 p-6 shadow-xl shadow-emerald-200/30 transition hover:-translate-y-2 hover:shadow-2xl dark:border-emerald-500/40 dark:from-emerald-900/50 dark:to-teal-900/50">
                <h3 class="text-xl font-bold text-emerald-900 dark:text-white">🧶 Crochet</h3>
                <p class="mt-2 text-sm text-emerald-800/80 dark:text-emerald-100">Blankets, amigurumi & more. Browse 850+ patterns with step-by-step guides.</p>
            </article>
            <article class="rounded-3xl border border-violet-300/70 bg-gradient-to-br from-violet-100 to-purple-100 p-6 shadow-xl shadow-violet-200/30 transition hover:-translate-y-2 hover:shadow-2xl dark:border-violet-500/40 dark:from-violet-900/50 dark:to-purple-900/50">
                <h3 class="text-xl font-bold text-violet-900 dark:text-white">🧵 Knitting</h3>
                <p class="mt-2 text-sm text-violet-800/80 dark:text-violet-100">Sweaters, scarves & more. 1,200+ patterns with gauge calculators.</p>
            </article>
            <article class="rounded-3xl border border-rose-300/70 bg-gradient-to-br from-rose-100 to-pink-100 p-6 shadow-xl shadow-rose-200/30 transition hover:-translate-y-2 hover:shadow-2xl dark:border-rose-500/40 dark:from-rose-900/50 dark:to-pink-900/50">
                <h3 class="text-xl font-bold text-rose-900 dark:text-white">✂️ Embroidery</h3>
                <p class="mt-2 text-sm text-rose-800/80 dark:text-rose-100">Cross stitch, needlepoint. 450+ patterns with color charts.</p>
            </article>
        </div>
    </div>
</section>

<!-- ============================================ -->
<!-- MODELS SECTION - Purple (matches Models navbar icon) -->
<!-- Purpose: Display 3D model features - Gallery, Top Rated, Recently Added, Create Model -->
<!-- ============================================ -->
<section id="models" class="relative overflow-hidden bg-gradient-to-br from-purple-50 via-violet-50 to-fuchsia-50 py-20 dark:from-purple-950/40 dark:via-violet-950/40 dark:to-fuchsia-950/40">
    <div class="absolute -right-20 top-10 h-72 w-72 rounded-full bg-purple-400/25 blur-3xl dark:bg-purple-700/30"></div>
    <div class="absolute -left-16 bottom-10 h-64 w-64 rounded-full bg-violet-300/20 blur-3xl dark:bg-violet-600/25"></div>
    <div class="max-w-6xl mx-auto px-6 lg:px-12">
        <div class="text-center mb-12">
            <div class="inline-flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-purple-500 to-violet-500 mb-6 shadow-xl shadow-purple-500/30">
                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
            </div>
            <h2 class="bg-gradient-to-r from-purple-600 via-violet-600 to-fuchsia-600 bg-clip-text text-4xl font-bold tracking-tight text-transparent sm:text-5xl dark:from-purple-400 dark:via-violet-400 dark:to-fuchsia-400">
                Model Gallery
            </h2>
            <p class="mt-4 max-w-2xl mx-auto text-lg text-zinc-600 dark:text-zinc-300">
                Browse finished projects, get inspired, and share your own creations with the community.
            </p>
        </div>
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
            <article class="rounded-3xl border border-blue-300/70 bg-gradient-to-br from-blue-100 to-indigo-100 p-6 shadow-xl shadow-blue-200/30 transition hover:-translate-y-2 hover:shadow-2xl dark:border-blue-500/40 dark:from-blue-900/50 dark:to-indigo-900/50">
                <h3 class="text-lg font-bold text-blue-900 dark:text-white">📸 Gallery</h3>
                <p class="mt-2 text-sm text-blue-800/80 dark:text-blue-100">Browse all completed models</p>
            </article>
            <article class="rounded-3xl border border-yellow-300/70 bg-gradient-to-br from-yellow-100 to-amber-100 p-6 shadow-xl shadow-yellow-200/30 transition hover:-translate-y-2 hover:shadow-2xl dark:border-yellow-500/40 dark:from-yellow-900/50 dark:to-amber-900/50">
                <h3 class="text-lg font-bold text-yellow-900 dark:text-white">⭐ Top Rated</h3>
                <p class="mt-2 text-sm text-yellow-800/80 dark:text-yellow-100">Community favorites</p>
            </article>
            <article class="rounded-3xl border border-green-300/70 bg-gradient-to-br from-green-100 to-emerald-100 p-6 shadow-xl shadow-green-200/30 transition hover:-translate-y-2 hover:shadow-2xl dark:border-green-500/40 dark:from-green-900/50 dark:to-emerald-900/50">
                <h3 class="text-lg font-bold text-green-900 dark:text-white">🕐 Recently Added</h3>
                <p class="mt-2 text-sm text-green-800/80 dark:text-green-100">Latest uploads</p>
            </article>
            <article class="rounded-3xl border border-purple-300/70 bg-gradient-to-br from-purple-100 to-violet-100 p-6 shadow-xl shadow-purple-200/30 transition hover:-translate-y-2 hover:shadow-2xl dark:border-purple-500/40 dark:from-purple-900/50 dark:to-violet-900/50">
                <h3 class="text-lg font-bold text-purple-900 dark:text-white">➕ Create Model</h3>
                <p class="mt-2 text-sm text-purple-800/80 dark:text-purple-100">Upload your work</p>
            </article>
        </div>
    </div>
</section>

<!-- ============================================ -->
<!-- TUTORIALS SECTION - Orange (matches Tutorials navbar icon) -->
<!-- Purpose: Learning resources - Beginner Course, Stitches, Techniques, Videos, Progress, Favorites -->
<!-- ============================================ -->
<section id="tutorials" class="relative overflow-hidden bg-gradient-to-br from-orange-50 via-amber-50 to-yellow-50 py-20 dark:from-orange-950/40 dark:via-amber-950/40 dark:to-yellow-950/40">
    <div class="absolute -left-20 top-20 h-80 w-80 rounded-full bg-orange-400/20 blur-3xl dark:bg-orange-700/25"></div>
    <div class="absolute -right-16 bottom-20 h-64 w-64 rounded-full bg-amber-300/25 blur-3xl dark:bg-amber-600/20"></div>
    <div class="max-w-6xl mx-auto px-6 lg:px-12">
        <div class="text-center mb-12">
            <div class="inline-flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-orange-500 to-amber-500 mb-6 shadow-xl shadow-orange-500/30">
                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>
            <h2 class="bg-gradient-to-r from-orange-600 via-amber-600 to-yellow-600 bg-clip-text text-4xl font-bold tracking-tight text-transparent sm:text-5xl dark:from-orange-400 dark:via-amber-400 dark:to-yellow-400">
                Learn & Master
            </h2>
            <p class="mt-4 max-w-2xl mx-auto text-lg text-zinc-600 dark:text-zinc-300">
                Step-by-step tutorials, video lessons, and technique guides to level up your crafting skills.
            </p>
        </div>
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            <article class="rounded-3xl border border-green-300/70 bg-gradient-to-br from-green-100 to-emerald-100 p-6 shadow-xl shadow-green-200/30 transition hover:-translate-y-2 hover:shadow-2xl dark:border-green-500/40 dark:from-green-900/50 dark:to-emerald-900/50">
                <h3 class="text-xl font-bold text-green-900 dark:text-white">▶️ Beginner Course</h3>
                <p class="mt-2 text-sm text-green-800/80 dark:text-green-100">Start your crafting journey from scratch</p>
            </article>
            <article class="rounded-3xl border border-blue-300/70 bg-gradient-to-br from-blue-100 to-cyan-100 p-6 shadow-xl shadow-blue-200/30 transition hover:-translate-y-2 hover:shadow-2xl dark:border-blue-500/40 dark:from-blue-900/50 dark:to-cyan-900/50">
                <h3 class="text-xl font-bold text-blue-900 dark:text-white">✂️ Stitches</h3>
                <p class="mt-2 text-sm text-blue-800/80 dark:text-blue-100">Learn basic and advanced stitch techniques</p>
            </article>
            <article class="rounded-3xl border border-purple-300/70 bg-gradient-to-br from-purple-100 to-violet-100 p-6 shadow-xl shadow-purple-200/30 transition hover:-translate-y-2 hover:shadow-2xl dark:border-purple-500/40 dark:from-purple-900/50 dark:to-violet-900/50">
                <h3 class="text-xl font-bold text-purple-900 dark:text-white">🤚 Techniques</h3>
                <p class="mt-2 text-sm text-purple-800/80 dark:text-purple-100">Advanced methods and finishing</p>
            </article>
            <article class="rounded-3xl border border-red-300/70 bg-gradient-to-br from-red-100 to-rose-100 p-6 shadow-xl shadow-red-200/30 transition hover:-translate-y-2 hover:shadow-2xl dark:border-red-500/40 dark:from-red-900/50 dark:to-rose-900/50">
                <h3 class="text-xl font-bold text-red-900 dark:text-white">🎥 Video Lessons</h3>
                <p class="mt-2 text-sm text-red-800/80 dark:text-red-100">Step-by-step video guides</p>
            </article>
            <article class="rounded-3xl border border-orange-300/70 bg-gradient-to-br from-orange-100 to-amber-100 p-6 shadow-xl shadow-orange-200/30 transition hover:-translate-y-2 hover:shadow-2xl dark:border-orange-500/40 dark:from-orange-900/50 dark:to-amber-900/50">
                <h3 class="text-xl font-bold text-orange-900 dark:text-white">📈 Progress</h3>
                <p class="mt-2 text-sm text-orange-800/80 dark:text-orange-100">Track your learning journey</p>
            </article>
            <article class="rounded-3xl border border-pink-300/70 bg-gradient-to-br from-pink-100 to-rose-100 p-6 shadow-xl shadow-pink-200/30 transition hover:-translate-y-2 hover:shadow-2xl dark:border-pink-500/40 dark:from-pink-900/50 dark:to-rose-900/50">
                <h3 class="text-xl font-bold text-pink-900 dark:text-white">💖 Favorites</h3>
                <p class="mt-2 text-sm text-pink-800/80 dark:text-pink-100">Your saved tutorials</p>
            </article>
        </div>
    </div>
</section>

<!-- ============================================ -->
<!-- AI ASSISTANT SECTION - Yellow (matches AI Assistant navbar icon) -->
<!-- Purpose: AI-powered tools - Pattern Analysis, Gauge Calculator, Yarn Substitution -->
<!-- ============================================ -->
<section id="ai-assistant" class="relative overflow-hidden bg-gradient-to-br from-yellow-50 via-amber-50 to-orange-50 py-20 dark:from-yellow-950/40 dark:via-amber-950/40 dark:to-orange-950/40">
    <div class="absolute -right-20 top-10 h-72 w-72 rounded-full bg-yellow-400/25 blur-3xl dark:bg-yellow-700/30"></div>
    <div class="absolute -left-16 bottom-10 h-64 w-64 rounded-full bg-amber-300/20 blur-3xl dark:bg-amber-600/25"></div>
    <div class="max-w-6xl mx-auto px-6 lg:px-12">
        <div class="text-center mb-12">
            <div class="inline-flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-yellow-500 to-amber-500 mb-6 shadow-xl shadow-yellow-500/30">
                <svg class="h-8 w-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14 2C14 2.74028 13.5978 3.38663 13 3.73244V4H20C21.6569 4 23 5.34315 23 7V19C23 20.6569 21.6569 22 20 22H4C2.34315 22 1 20.6569 1 19V7C1 5.34315 2.34315 4 4 4H11V3.73244C10.4022 3.38663 10 2.74028 10 2C10 0.895431 10.8954 0 12 0C13.1046 0 14 0.895431 14 2ZM4 6H11H13H20C20.5523 6 21 6.44772 21 7V19C21 19.5523 20.5523 20 20 20H4C3.44772 20 3 19.5523 3 19V7C3 6.44772 3.44772 6 4 6ZM15 11.5C15 10.6716 15.6716 10 16.5 10C17.3284 10 18 10.6716 18 11.5C18 12.3284 17.3284 13 16.5 13C15.6716 13 15 12.3284 15 11.5ZM16.5 8C14.567 8 13 9.567 13 11.5C13 13.433 14.567 15 16.5 15C18.433 15 20 13.433 20 11.5C20 9.567 18.433 8 16.5 8ZM7.5 10C6.67157 10 6 10.6716 6 11.5C6 12.3284 6.67157 13 7.5 13C8.32843 13 9 12.3284 9 11.5C9 10.6716 8.32843 10 7.5 10ZM4 11.5C4 9.567 5.567 8 7.5 8C9.433 8 11 9.567 11 11.5C11 13.433 9.433 15 7.5 15C5.567 15 4 13.433 4 11.5ZM10.8944 16.5528C10.6474 16.0588 10.0468 15.8586 9.55279 16.1056C9.05881 16.3526 8.85858 16.9532 9.10557 17.4472C9.68052 18.5971 10.9822 19 12 19C13.0178 19 14.3195 18.5971 14.8944 17.4472C15.1414 16.9532 14.9412 16.3526 14.4472 16.1056C13.9532 15.8586 13.3526 16.0588 13.1056 16.5528C13.0139 16.7362 12.6488 17 12 17C11.3512 17 10.9861 16.7362 10.8944 16.5528Z" />
                </svg>
            </div>
            <h2 class="bg-gradient-to-r from-yellow-600 via-amber-600 to-orange-600 bg-clip-text text-4xl font-bold tracking-tight text-transparent sm:text-5xl dark:from-yellow-400 dark:via-amber-400 dark:to-orange-400">
                AI-Powered Assistant
            </h2>
            <p class="mt-4 max-w-2xl mx-auto text-lg text-zinc-600 dark:text-zinc-300">
                Get instant help with pattern questions, yarn substitutions, gauge calculations, and more.
            </p>
        </div>
        <div class="grid gap-6 md:grid-cols-3">
            <article class="rounded-3xl border border-yellow-300/70 bg-gradient-to-br from-yellow-100 to-amber-100 p-8 shadow-xl shadow-yellow-200/30 transition hover:-translate-y-2 hover:shadow-2xl dark:border-yellow-500/40 dark:from-yellow-900/50 dark:to-amber-900/50">
                <div class="text-5xl mb-4">🤖</div>
                <h3 class="text-xl font-bold text-yellow-900 dark:text-white">Smart Pattern Analysis</h3>
                <p class="mt-2 text-sm text-yellow-800/80 dark:text-yellow-100">AI reads your patterns and answers questions instantly</p>
            </article>
            <article class="rounded-3xl border border-amber-300/70 bg-gradient-to-br from-amber-100 to-orange-100 p-8 shadow-xl shadow-amber-200/30 transition hover:-translate-y-2 hover:shadow-2xl dark:border-amber-500/40 dark:from-amber-900/50 dark:to-orange-900/50">
                <div class="text-5xl mb-4">🧮</div>
                <h3 class="text-xl font-bold text-amber-900 dark:text-white">Gauge Calculator</h3>
                <p class="mt-2 text-sm text-amber-800/80 dark:text-amber-100">Automatic stitch and row calculations for any size</p>
            </article>
            <article class="rounded-3xl border border-orange-300/70 bg-gradient-to-br from-orange-100 to-red-100 p-8 shadow-xl shadow-orange-200/30 transition hover:-translate-y-2 hover:shadow-2xl dark:border-orange-500/40 dark:from-orange-900/50 dark:to-red-900/50">
                <div class="text-5xl mb-4">🧶</div>
                <h3 class="text-xl font-bold text-orange-900 dark:text-white">Yarn Substitution</h3>
                <p class="mt-2 text-sm text-orange-800/80 dark:text-orange-100">Find perfect alternatives for any yarn type</p>
            </article>
        </div>
    </div>
</section>

<!-- ============================================ -->
<!-- COMMUNITY SECTION - Pink (matches Community navbar icon) -->
<!-- Purpose: Social features - Forums & Discussions, Monthly Challenges -->
<!-- ============================================ -->
<section id="community" class="relative overflow-hidden bg-gradient-to-br from-pink-50 via-rose-50 to-red-50 py-20 dark:from-pink-950/40 dark:via-rose-950/40 dark:to-red-950/40">
    <div class="absolute -left-20 top-20 h-80 w-80 rounded-full bg-pink-400/20 blur-3xl dark:bg-pink-700/25"></div>
    <div class="absolute -right-16 bottom-20 h-64 w-64 rounded-full bg-rose-300/25 blur-3xl dark:bg-rose-600/20"></div>
    <div class="max-w-6xl mx-auto px-6 lg:px-12">
        <div class="text-center mb-12">
            <div class="inline-flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-pink-500 to-rose-500 mb-6 shadow-xl shadow-pink-500/30">
                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                </svg>
            </div>
            <h2 class="bg-gradient-to-r from-pink-600 via-rose-600 to-red-600 bg-clip-text text-4xl font-bold tracking-tight text-transparent sm:text-5xl dark:from-pink-400 dark:via-rose-400 dark:to-red-400">
                Join the Community
            </h2>
            <p class="mt-4 max-w-2xl mx-auto text-lg text-zinc-600 dark:text-zinc-300">
                Connect with fellow crafters, share your projects, get feedback, and participate in challenges.
            </p>
        </div>
        <div class="grid gap-6 md:grid-cols-2">
            <article class="rounded-3xl border border-pink-300/70 bg-gradient-to-br from-pink-100 to-rose-100 p-8 shadow-xl shadow-pink-200/30 transition hover:-translate-y-2 hover:shadow-2xl dark:border-pink-500/40 dark:from-pink-900/50 dark:to-rose-900/50">
                <div class="flex items-center gap-3 mb-4">
                    <div class="h-14 w-14 rounded-2xl bg-gradient-to-br from-pink-500 to-rose-500 flex items-center justify-center text-2xl font-bold text-white shadow-lg">💬</div>
                    <div>
                        <h3 class="text-lg font-bold text-pink-900 dark:text-white">Forums & Discussions</h3>
                        <p class="text-xs text-pink-700 dark:text-pink-100">18 members online now</p>
                    </div>
                </div>
                <p class="text-sm text-pink-800/80 dark:text-pink-100">Ask questions, share tips, and learn from experienced crafters</p>
            </article>
            <article class="rounded-3xl border border-rose-300/70 bg-gradient-to-br from-rose-100 to-red-100 p-8 shadow-xl shadow-rose-200/30 transition hover:-translate-y-2 hover:shadow-2xl dark:border-rose-500/40 dark:from-rose-900/50 dark:to-red-900/50">
                <div class="flex items-center gap-3 mb-4">
                    <div class="h-14 w-14 rounded-2xl bg-gradient-to-br from-rose-500 to-red-500 flex items-center justify-center text-2xl font-bold text-white shadow-lg">🏆</div>
                    <div>
                        <h3 class="text-lg font-bold text-rose-900 dark:text-white">Monthly Challenges</h3>
                        <p class="text-xs text-rose-700 dark:text-rose-100">Next challenge in 5 days</p>
                    </div>
                </div>
                <p class="text-sm text-rose-800/80 dark:text-rose-100">Participate in themed challenges and win prizes</p>
            </article>
        </div>
    </div>
</section>

<!-- ============================================ -->
<!-- FINAL CTA SECTION - Call to Action -->
<!-- Purpose: Encourage user registration or navigation with buttons -->
<!-- ============================================ -->
<section class="bg-gradient-to-br from-violet-50 via-fuchsia-50 to-rose-50 py-16 dark:from-violet-950/40 dark:via-fuchsia-950/40 dark:to-rose-950/40">
    <div class="max-w-5xl mx-auto px-6 text-center lg:px-12">
        <div class="flex flex-wrap justify-center gap-4">
            @guest
            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="inline-flex items-center justify-center gap-2 rounded-full bg-gradient-to-r from-fuchsia-600 via-violet-600 to-sky-600 px-10 py-4 text-sm font-bold text-white shadow-2xl shadow-violet-500/50 transition hover:scale-110 hover:shadow-violet-600/60">
                <span>✨</span> Create free account
            </a>
            @endif
            @else
            @if(auth()->user()->is_admin)
            <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center gap-2 rounded-full bg-gradient-to-r from-fuchsia-600 via-violet-600 to-sky-600 px-10 py-4 text-sm font-bold text-white shadow-2xl shadow-violet-500/50 transition hover:scale-110 hover:shadow-violet-600/60">
                <svg class="h-8 w-8 text-white" viewBox="0 0 24 24" fill="none">

                    <g id="SVGRepo_bgCarrier" stroke-width="0" />

                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />

                    <g id="SVGRepo_iconCarrier">
                        <path d="M6.07821 13.4174C6.37128 13.1247 6.37157 12.6498 6.07886 12.3567C5.78614 12.0636 5.31127 12.0634 5.0182 12.3561L6.07821 13.4174ZM3.85646 14.5764L3.32646 14.0457V14.0457L3.85646 14.5764ZM2.31852 13.0403L1.78851 12.5097L1.78851 12.5097L2.31852 13.0403ZM3.00232 13.4174C3.29539 13.1247 3.29568 12.6498 3.00297 12.3567C2.71025 12.0636 2.23538 12.0634 1.94231 12.3561L3.00232 13.4174ZM11.6057 18.987C11.8988 18.6943 11.8991 18.2194 11.6063 17.9263C11.3136 17.6332 10.8388 17.633 10.5457 17.9257L11.6057 18.987ZM9.38395 20.146L9.91396 20.6767L9.38395 20.146ZM10.9219 21.6821L11.4519 22.2127V22.2127L10.9219 21.6821ZM11.6057 22.0591C11.8988 21.7664 11.8991 21.2915 11.6063 20.9985C11.3136 20.7054 10.8388 20.7051 10.5457 20.9978L11.6057 22.0591ZM10.6328 17.186C10.9257 16.8931 10.9257 16.4182 10.6328 16.1253C10.3399 15.8324 9.86499 15.8324 9.5721 16.1253L10.6328 17.186ZM7.46967 18.2277C7.17678 18.5206 7.17678 18.9955 7.46967 19.2884C7.76256 19.5813 8.23744 19.5813 8.53033 19.2884L7.46967 18.2277ZM7.85705 14.4136C8.14994 14.1207 8.14994 13.6459 7.85705 13.353C7.56415 13.0601 7.08928 13.0601 6.79639 13.353L7.85705 14.4136ZM4.67948 15.4699C4.38659 15.7628 4.38659 16.2376 4.67948 16.5305C4.97238 16.8234 5.44725 16.8234 5.74014 16.5305L4.67948 15.4699ZM7.46042 17.5818C7.75656 17.2921 7.76184 16.8173 7.47223 16.5212C7.18261 16.225 6.70777 16.2197 6.41163 16.5094L7.46042 17.5818ZM4.70206 18.1813C4.40592 18.4709 4.40064 18.9458 4.69026 19.2419C4.97987 19.538 5.45472 19.5433 5.75085 19.2537L4.70206 18.1813ZM5.0182 12.3561L3.32646 14.0457L4.38647 15.1071L6.07821 13.4174L5.0182 12.3561ZM2.84853 13.571L3.00232 13.4174L1.94231 12.3561L1.78851 12.5097L2.84853 13.571ZM2.84853 14.0457C2.71716 13.9145 2.71716 13.7022 2.84853 13.571L1.78851 12.5097C1.0705 13.2268 1.0705 14.3899 1.78851 15.1071L2.84853 14.0457ZM3.32646 14.0457C3.19458 14.1775 2.9804 14.1775 2.84853 14.0457L1.78851 15.1071C2.50602 15.8237 3.66896 15.8237 4.38647 15.1071L3.32646 14.0457ZM10.5457 17.9257L8.85394 19.6154L9.91396 20.6767L11.6057 18.987L10.5457 17.9257ZM11.4519 22.2127L11.6057 22.0591L10.5457 20.9978L10.3919 21.1514L11.4519 22.2127ZM8.85394 22.2127C9.57145 22.9294 10.7344 22.9294 11.4519 22.2127L10.3919 21.1514C10.26 21.2831 10.0458 21.2831 9.91396 21.1514L8.85394 22.2127ZM8.85394 19.6154C8.13593 20.3325 8.13593 21.4956 8.85394 22.2127L9.91396 21.1514C9.78259 21.0202 9.78259 20.8079 9.91396 20.6767L8.85394 19.6154ZM9.5721 16.1253L7.46967 18.2277L8.53033 19.2884L10.6328 17.186L9.5721 16.1253ZM6.79639 13.353L4.67948 15.4699L5.74014 16.5305L7.85705 14.4136L6.79639 13.353ZM6.41163 16.5094L4.70206 18.1813L5.75085 19.2537L7.46042 17.5818L6.41163 16.5094Z" fill="#fff" />
                        <path d="M9.74292 13.0566L10.2725 12.5254L9.74292 13.0566ZM9.74292 8.40116L9.21339 7.87003H9.21339L9.74292 8.40116ZM15.5797 14.2204L16.1092 14.7515V14.7515L15.5797 14.2204ZM10.9103 14.2204L10.3807 14.7515L10.9103 14.2204ZM20.5495 9.26548L20.02 8.73435L20.5495 9.26548ZM15.9551 1.49472C15.5723 1.65283 15.3901 2.09136 15.5482 2.47421C15.7063 2.85706 16.1448 3.03925 16.5277 2.88115L15.9551 1.49472ZM9.79706 13.1073C9.50373 13.3998 9.50302 13.8747 9.79547 14.168C10.0879 14.4613 10.5628 14.4621 10.8561 14.1696L9.79706 13.1073ZM12.6072 12.4238C12.9005 12.1314 12.9012 11.6565 12.6087 11.3632C12.3163 11.0698 11.8414 11.0691 11.5481 11.3616L12.6072 12.4238ZM13.6861 15.786L13.9453 16.4897L13.6861 15.786ZM8.18721 10.2514L7.49137 9.97154L8.18721 10.2514ZM14.4546 4.76267C14.748 4.47021 14.7487 3.99534 14.4562 3.70201C14.1638 3.40868 13.6889 3.40796 13.3956 3.70041L14.4546 4.76267ZM20.02 8.73435L15.0501 13.6893L16.1092 14.7515L21.079 9.79661L20.02 8.73435ZM11.4398 13.6893L10.2725 12.5254L9.21339 13.5877L10.3807 14.7515L11.4398 13.6893ZM18.2148 2.75H18.6983V1.25H18.2148V2.75ZM21.2501 5.29186V5.77394H22.7501V5.29186H21.2501ZM18.6983 2.75C19.4977 2.75 20.022 2.75158 20.4101 2.80361C20.7769 2.85278 20.9079 2.93434 20.987 3.01321L22.0461 1.95096C21.6417 1.54774 21.1417 1.38826 20.6094 1.31691C20.0985 1.24842 19.4554 1.25 18.6983 1.25V2.75ZM22.7501 5.29186C22.7501 4.53722 22.7517 3.89558 22.6829 3.38559C22.6112 2.85381 22.4508 2.35448 22.0461 1.95096L20.987 3.01321C21.0658 3.09176 21.1472 3.22143 21.1964 3.58606C21.2485 3.9725 21.2501 4.49469 21.2501 5.29186H22.7501ZM10.2725 12.5254C9.70713 11.9618 9.33773 11.5913 9.10037 11.2811C8.87618 10.9881 8.84204 10.8391 8.84204 10.7289H7.34204C7.34204 11.3004 7.58305 11.7666 7.90915 12.1927C8.22209 12.6016 8.67813 13.054 9.21339 13.5877L10.2725 12.5254ZM10.3807 14.7515C10.916 15.2852 11.3698 15.7398 11.7798 16.0518C12.2073 16.3769 12.6738 16.6163 13.245 16.6163V15.1163C13.1323 15.1163 12.9818 15.0814 12.688 14.8579C12.3768 14.6212 12.0051 14.2529 11.4398 13.6893L10.3807 14.7515ZM21.079 9.79661C21.7513 9.12636 22.2451 8.65287 22.5042 8.02914L21.119 7.45364C21.0011 7.73733 20.7792 7.97743 20.02 8.73435L21.079 9.79661ZM21.2501 5.77394C21.2501 6.84444 21.2367 7.1702 21.119 7.45364L22.5042 8.02914C22.7634 7.40516 22.7501 6.72176 22.7501 5.77394H21.2501ZM18.2148 1.25C17.2636 1.25 16.5797 1.23679 15.9551 1.49472L16.5277 2.88115C16.8133 2.76321 17.1415 2.75 18.2148 2.75V1.25ZM10.8561 14.1696L12.6072 12.4238L11.5481 11.3616L9.79706 13.1073L10.8561 14.1696ZM15.0501 13.6893C14.6145 14.1236 14.2907 14.4459 14.0134 14.6853C13.7349 14.9258 13.557 15.0343 13.4268 15.0822L13.9453 16.4897C14.3279 16.3488 14.6681 16.1019 14.9938 15.8205C15.3208 15.5381 15.6875 15.172 16.1092 14.7515L15.0501 13.6893ZM13.4268 15.0822C13.3601 15.1068 13.3031 15.1163 13.245 15.1163V16.6163C13.489 16.6163 13.7212 16.5723 13.9453 16.4897L13.4268 15.0822ZM9.21339 7.87003C8.8017 8.28048 8.44233 8.63824 8.16266 8.9574C7.88434 9.27503 7.63891 9.60463 7.49137 9.97154L8.88306 10.5312C8.93632 10.3987 9.05058 10.2201 9.29083 9.94596C9.52973 9.67332 9.84781 9.35566 10.2725 8.93229L9.21339 7.87003ZM7.49137 9.97154C7.39467 10.212 7.34204 10.4628 7.34204 10.7289H8.84204C8.84204 10.6676 8.85286 10.6063 8.88306 10.5312L7.49137 9.97154ZM10.2725 8.93229L14.4546 4.76267L13.3956 3.70041L9.21339 7.87003L10.2725 8.93229Z" fill="#fff" />
                        <path d="M8.03732 10.1018L8.56765 9.57148L8.56686 9.57068L8.03732 10.1018ZM11.6708 6.70352C12.0191 6.92769 12.4831 6.82707 12.7073 6.47876C12.9315 6.13045 12.8309 5.66636 12.4826 5.44219L11.6708 6.70352ZM11.5418 5.72863L11.9477 5.09796L11.9477 5.09796L11.5418 5.72863ZM9.35765 4.60789L9.46729 3.86595L9.35765 4.60789ZM5.19137 7.12001L5.7209 7.65114V7.65114L5.19137 7.12001ZM7.8385 4.80203L8.12592 5.49477L7.8385 4.80203ZM5.73367 8.31238L5.45738 9.00964L5.45738 9.00964L5.73367 8.31238ZM5.5527 9.04774C5.93568 9.20553 6.37406 9.02298 6.53185 8.64C6.68964 8.25702 6.50709 7.81863 6.12411 7.66084L5.5527 9.04774ZM5.41182 8.18485L5.68811 7.4876L5.6881 7.4876L5.41182 8.18485ZM7.6568 10.7819C7.94969 11.0748 8.42456 11.0748 8.71746 10.7819C9.01035 10.489 9.01035 10.0142 8.71746 9.72128L7.6568 10.7819ZM8.15854 9.1636C7.86521 8.87114 7.39034 8.87186 7.09789 9.16519C6.80543 9.45852 6.80615 9.93339 7.09948 10.2258L8.15854 9.1636ZM12.4826 5.44219L11.9477 5.09796L11.1359 6.35929L11.6708 6.70352L12.4826 5.44219ZM11.9477 5.09796C11.421 4.75893 10.9904 4.48119 10.6187 4.28092C10.2377 4.07557 9.87347 3.92597 9.46729 3.86595L9.248 5.34983C9.41668 5.37476 9.60814 5.44027 9.9072 5.60142C10.2157 5.76764 10.5898 6.0078 11.1359 6.35929L11.9477 5.09796ZM5.7209 7.65114C6.19994 7.17354 6.71143 6.6638 7.17057 6.24495C7.39993 6.03572 7.60728 5.85743 7.78387 5.72132C7.97207 5.57626 8.08295 5.5126 8.12592 5.49477L7.55107 4.10929C7.31817 4.20593 7.07924 4.37058 6.86816 4.53327C6.64547 4.70491 6.40406 4.91382 6.15964 5.13679C5.6712 5.58237 5.13501 6.11714 4.66185 6.58887L5.7209 7.65114ZM9.46729 3.86595C8.82208 3.77059 8.15942 3.85688 7.55107 4.10929L8.12592 5.49477C8.49073 5.34341 8.87932 5.29534 9.248 5.34983L9.46729 3.86595ZM5.13554 8.88211L5.45738 9.00964L6.00995 7.61513L5.68811 7.4876L5.13554 8.88211ZM5.45738 9.00964C5.51174 9.03118 5.53257 9.03945 5.5527 9.04774L6.12411 7.66084C6.09245 7.6478 6.06072 7.63524 6.00995 7.61513L5.45738 9.00964ZM4.66185 6.58887C3.9466 7.30195 4.19893 8.51098 5.13554 8.88211L5.6881 7.4876C5.75268 7.51318 5.77259 7.5996 5.7209 7.65114L4.66185 6.58887ZM7.50699 10.6321L7.6568 10.7819L8.71746 9.72128L8.56765 9.57148L7.50699 10.6321ZM7.09948 10.2258L7.50779 10.6329L8.56686 9.57068L8.15854 9.1636L7.09948 10.2258Z" fill="#fff" />
                        <path d="M13.9246 16.025L13.3942 16.5553C13.4058 16.5669 13.4178 16.5781 13.4301 16.5889L13.9246 16.025ZM18.5443 11.4859C18.3191 11.1382 17.8548 11.0389 17.5071 11.264C17.1594 11.4891 17.06 11.9535 17.2852 12.3012L18.5443 11.4859ZM18.26 12.4268L17.6304 12.8344L17.6304 12.8344L18.26 12.4268ZM19.3841 14.6044L20.1259 14.4941L19.3841 14.6044ZM16.8644 18.7582L16.3349 18.2271L16.3349 18.2271L16.8644 18.7582ZM19.1894 16.119L18.4972 15.8301L19.1894 16.119ZM16.5329 18.3607C16.3796 17.976 15.9433 17.7884 15.5585 17.9418C15.1738 18.0951 14.9862 18.5314 15.1396 18.9162L16.5329 18.3607ZM13.8746 16.9786C14.186 17.2517 14.6599 17.2206 14.933 16.9091C15.206 16.5977 15.1749 16.1238 14.8635 15.8507L13.8746 16.9786ZM16.793 18.8294L17.3225 19.3605L17.3225 19.3605L16.793 18.8294ZM14.2159 15.2556C13.923 14.9627 13.4481 14.9627 13.1552 15.2556C12.8623 15.5485 12.8623 16.0234 13.1552 16.3163L14.2159 15.2556ZM17.2852 12.3012L17.6304 12.8344L18.8895 12.0192L18.5443 11.4859L17.2852 12.3012ZM16.3349 18.2271L16.2634 18.2983L17.3225 19.3605L17.394 19.2893L16.3349 18.2271ZM17.6304 12.8344C17.983 13.379 18.2238 13.7518 18.3905 14.0592C18.552 14.3573 18.6174 14.5475 18.6423 14.7147L20.1259 14.4941C20.0656 14.0882 19.9152 13.7245 19.7092 13.3444C19.5082 12.9737 19.2296 12.5443 18.8895 12.0192L17.6304 12.8344ZM17.394 19.2893C17.8671 18.8176 18.4035 18.283 18.8504 17.796C19.0741 17.5523 19.2836 17.3116 19.4558 17.0895C19.619 16.8791 19.7843 16.6406 19.8815 16.4079L18.4972 15.8301C18.4796 15.8724 18.416 15.9827 18.2704 16.1704C18.1339 16.3464 17.9552 16.5531 17.7453 16.7818C17.3252 17.2395 16.8139 17.7495 16.3349 18.2271L17.394 19.2893ZM18.6423 14.7147C18.6967 15.081 18.6487 15.4672 18.4972 15.8301L19.8815 16.4079C20.135 15.8005 20.2218 15.1387 20.1259 14.4941L18.6423 14.7147ZM14.8635 15.8507L14.419 15.461L13.4301 16.5889L13.8746 16.9786L14.8635 15.8507ZM16.2634 18.2983C16.3072 18.2547 16.3661 18.2444 16.4081 18.2528C16.4504 18.2613 16.5069 18.2955 16.5329 18.3607L15.1396 18.9162C15.4965 19.8115 16.6547 20.0263 17.3225 19.3605L16.2634 18.2983ZM14.4549 15.4946L14.2159 15.2556L13.1552 16.3163L13.3942 16.5553L14.4549 15.4946Z" fill="#fff" />
                        <path d="M15.0499 9.41414C15.3433 9.7066 15.8182 9.70588 16.1106 9.41255C16.4031 9.11922 16.4023 8.64434 16.109 8.35189L15.0499 9.41414ZM17.3846 8.35189C17.0913 8.64434 17.0906 9.11922 17.383 9.41255C17.6755 9.70588 18.1504 9.7066 18.4437 9.41414L17.3846 8.35189ZM18.4437 6.0242C17.5063 5.08959 15.9874 5.08959 15.0499 6.0242L16.109 7.08645C16.461 6.73551 17.0326 6.73551 17.3846 7.08645L18.4437 6.0242ZM15.0499 6.0242C14.1113 6.96005 14.1113 8.47829 15.0499 9.41414L16.109 8.35189C15.7583 8.00219 15.7583 7.43615 16.109 7.08645L15.0499 6.0242ZM18.4437 9.41414C19.3824 8.47829 19.3824 6.96005 18.4437 6.0242L17.3846 7.08645C17.7354 7.43615 17.7354 8.00219 17.3846 8.35189L18.4437 9.41414Z" fill="#fff" />
                    </g>

                </svg>Continue in dashboard
            </a>
            @else
            <a href="{{ route('patterns.crochet') }}" class="inline-flex items-center justify-center gap-2 rounded-full bg-gradient-to-r from-fuchsia-600 via-violet-600 to-sky-600 px-10 py-4 text-sm font-bold text-white shadow-2xl shadow-violet-500/50 transition hover:scale-110 hover:shadow-violet-600/60">
                <span>🎨</span> Start Crafting
            </a>
            @endif
            @endguest
            <a href="#patterns" class="inline-flex items-center justify-center gap-2 rounded-full border-2 border-violet-300 bg-white/80 px-10 py-4 text-sm font-bold text-violet-700 shadow-lg transition hover:border-violet-400 hover:bg-white dark:border-violet-700 dark:bg-zinc-900/80 dark:text-violet-300 dark:hover:border-violet-600">
                Explore the pieces
            </a>
        </div>
    </div>
</section>

<!-- ============================================ -->
<!-- CONTACT FORM SECTION -->
<!-- Purpose: Allow users to send messages/inquiries -->
<!-- ============================================ -->
<section id="contact" class="relative overflow-hidden bg-gradient-to-br from-blue-50 via-indigo-50 to-sky-50 py-20 dark:from-blue-950/40 dark:via-indigo-950/40 dark:to-sky-950/40">
    <div class="absolute -left-20 top-20 h-80 w-80 rounded-full bg-blue-400/20 blur-3xl"></div>
    <div class="absolute -right-16 bottom-20 h-64 w-64 rounded-full bg-sky-300/25 blur-3xl"></div>

    <div class="relative max-w-4xl mx-auto px-6 lg:px-12">
        <div class="text-center mb-12">
            <div class="inline-flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-500 to-sky-500 mb-6 shadow-xl shadow-blue-500/30">
                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
            <h2 class="bg-gradient-to-r from-blue-600 via-indigo-600 to-sky-600 bg-clip-text text-4xl font-bold tracking-tight text-transparent sm:text-5xl dark:from-blue-400 dark:via-indigo-400 dark:to-sky-400">Get in Touch</h2>
            <p class="mt-4 text-lg text-zinc-600 dark:text-zinc-300">Have questions? We'd love to hear from you.</p>
        </div>

        <form class="space-y-6 relative">
            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <label for="name" class="block text-sm font-bold text-blue-700 dark:text-blue-300 mb-2">Name</label>
                    <input type="text" id="name" name="name" required
                        class="w-full rounded-xl border-2 border-blue-200 bg-white px-4 py-3 text-zinc-900 shadow-md transition-all duration-300 
                        hover:border-blue-400 hover:shadow-lg hover:shadow-blue-200/50 hover:-translate-y-0.5
                        focus:border-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-500/20 focus:shadow-xl focus:shadow-indigo-300/30
                        dark:border-blue-700 dark:bg-zinc-800 dark:text-white 
                        dark:hover:border-blue-500 dark:hover:shadow-blue-500/30
                        dark:focus:border-indigo-400 dark:focus:ring-indigo-400/20"
                        placeholder="Your name">
                </div>
                <div>
                    <label for="email" class="block text-sm font-bold text-indigo-700 dark:text-indigo-300 mb-2">Email</label>
                    <input type="email" id="email" name="email" required
                        class="w-full rounded-xl border-2 border-indigo-200 bg-white px-4 py-3 text-zinc-900 shadow-md transition-all duration-300
                        hover:border-indigo-400 hover:shadow-lg hover:shadow-indigo-200/50 hover:-translate-y-0.5
                        focus:border-sky-500 focus:outline-none focus:ring-4 focus:ring-sky-500/20 focus:shadow-xl focus:shadow-sky-300/30
                        dark:border-indigo-700 dark:bg-zinc-800 dark:text-white
                        dark:hover:border-indigo-500 dark:hover:shadow-indigo-500/30
                        dark:focus:border-sky-400 dark:focus:ring-sky-400/20"
                        placeholder="your@email.com">
                </div>
            </div>
            <div>
                <label for="subject" class="block text-sm font-bold text-sky-700 dark:text-sky-300 mb-2">Subject</label>
                <input type="text" id="subject" name="subject" required
                    class="w-full rounded-xl border-2 border-sky-200 bg-white px-4 py-3 text-zinc-900 shadow-md transition-all duration-300
                    hover:border-sky-400 hover:shadow-lg hover:shadow-sky-200/50 hover:-translate-y-0.5
                    focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-500/20 focus:shadow-xl focus:shadow-blue-300/30
                    dark:border-sky-700 dark:bg-zinc-800 dark:text-white
                    dark:hover:border-sky-500 dark:hover:shadow-sky-500/30
                    dark:focus:border-blue-400 dark:focus:ring-blue-400/20"
                    placeholder="What's this about?">
            </div>
            <div>
                <label for="message" class="block text-sm font-bold text-blue-700 dark:text-blue-300 mb-2">Message</label>
                <textarea id="message" name="message" rows="6" required
                    class="w-full rounded-xl border-2 border-blue-200 bg-white px-4 py-3 text-zinc-900 shadow-md transition-all duration-300 resize-none
                    hover:border-blue-400 hover:shadow-lg hover:shadow-blue-200/50 hover:-translate-y-0.5
                    focus:border-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-500/20 focus:shadow-xl focus:shadow-indigo-300/30
                    dark:border-blue-700 dark:bg-zinc-800 dark:text-white
                    dark:hover:border-blue-500 dark:hover:shadow-blue-500/30
                    dark:focus:border-indigo-400 dark:focus:ring-indigo-400/20"
                    placeholder="Your message..."></textarea>
            </div>
            <div class="text-center">
                <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-full bg-gradient-to-r from-blue-600 via-indigo-600 to-sky-600 px-10 py-4 text-sm font-bold text-white shadow-2xl shadow-blue-500/50 transition-all duration-300 hover:scale-105 hover:shadow-2xl hover:shadow-indigo-500/60 hover:-translate-y-1">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                    </svg>
                    Send Message
                </button>
            </div>
        </form>
    </div>
</section>

<!-- ============================================ -->
<!-- FOOTER - Copyright -->
<!-- Purpose: Copyright notice and legal information -->
<!-- ============================================ -->
<footer class="border-t border-zinc-200 bg-zinc-50 py-8 dark:border-zinc-800 dark:bg-zinc-900">
    <div class="max-w-6xl mx-auto px-6 lg:px-12">
        <div class="text-center text-sm text-zinc-600 dark:text-zinc-400">
            <p>&copy; {{ date('Y') }} Yarnly. All rights reserved.</p>
            <p class="mt-2">Made with <span class="text-rose-500">❤</span> for the yarn crafting community</p>
        </div>
    </div>
</footer>
@endsection
@section('slices')
<!-- Slices Section -->
<div class="absolute right-0 top-0 h-24 w-24 -translate-y-8 translate-x-8 rounded-full bg-emerald-400/30 blur-2xl"></div>
<p class="text-xs font-bold uppercase tracking-widest text-emerald-700 dark:text-emerald-200">🎯 Projects</p>
<h3 class="mt-3 text-xl font-bold text-emerald-900 dark:text-white">Boards that stay calm</h3>
<p class="mt-2 text-sm text-emerald-900/80 dark:text-emerald-50">Current lane: Focus · 3 milestones due this week · blockers flagged with yarn requirements.</p>
<div class="mt-4 inline-flex items-center gap-2 rounded-full bg-white/90 px-4 py-2 text-xs font-bold text-emerald-700 shadow-lg shadow-emerald-200/50 dark:bg-emerald-900/60 dark:text-emerald-100">→ Open project view</div>
</article>
<article id="patterns" class="relative h-full overflow-hidden rounded-3xl border border-amber-300/70 bg-gradient-to-br from-amber-100 via-orange-100 to-yellow-100 p-6 shadow-xl shadow-amber-300/30 transition hover:-translate-y-2 hover:shadow-2xl hover:shadow-amber-400/40 dark:border-amber-500/40 dark:from-amber-900/50 dark:via-orange-900/50 dark:to-yellow-900/50">
    <div class="absolute right-0 top-0 h-24 w-24 -translate-y-8 translate-x-8 rounded-full bg-amber-400/30 blur-2xl"></div>
    <p class="text-xs font-bold uppercase tracking-widest text-amber-700 dark:text-amber-200">📐 Pattern library</p>
    <h3 class="mt-3 text-xl font-bold text-amber-900 dark:text-white">AI-smart pattern brain</h3>
    <p class="mt-2 text-sm text-amber-900/80 dark:text-amber-50">Recent uploads parsed · stitch counts aligned with gauge · substitutions approved for two palettes.</p>
    <div class="mt-4 inline-flex items-center gap-2 rounded-full bg-white/90 px-4 py-2 text-xs font-bold text-amber-700 shadow-lg shadow-amber-200/50 dark:bg-amber-900/60 dark:text-amber-100">→ View latest patterns</div>
</article>
<article id="stash" class="relative h-full overflow-hidden rounded-3xl border border-rose-300/70 bg-gradient-to-br from-rose-100 via-pink-100 to-fuchsia-100 p-6 shadow-xl shadow-rose-300/30 transition hover:-translate-y-2 hover:shadow-2xl hover:shadow-rose-400/40 dark:border-rose-500/40 dark:from-rose-900/50 dark:via-pink-900/50 dark:to-fuchsia-900/50">
    <div class="absolute right-0 top-0 h-24 w-24 -translate-y-8 translate-x-8 rounded-full bg-rose-400/30 blur-2xl"></div>
    <p class="text-xs font-bold uppercase tracking-widest text-rose-700 dark:text-rose-200">🧶 Stash + suppliers</p>
    <h3 class="mt-3 text-xl font-bold text-rose-900 dark:text-white">Inventory without spreadsheets</h3>
    <p class="mt-2 text-sm text-rose-900/80 dark:text-rose-50">Auto depletion on handoffs, low-stock pings, and preferred suppliers one tap away.</p>
    <div class="mt-4 inline-flex items-center gap-2 rounded-full bg-white/90 px-4 py-2 text-xs font-bold text-rose-700 shadow-lg shadow-rose-200/50 dark:bg-rose-900/60 dark:text-rose-100">→ Check stash health</div>
</article>
<article id="community" class="relative h-full overflow-hidden rounded-3xl border border-sky-300/70 bg-gradient-to-br from-sky-100 via-indigo-100 to-violet-100 p-6 shadow-xl shadow-sky-300/30 transition hover:-translate-y-2 hover:shadow-2xl hover:shadow-sky-400/40 dark:border-sky-500/40 dark:from-sky-900/50 dark:via-indigo-900/50 dark:to-violet-900/50">
    <div class="absolute right-0 top-0 h-24 w-24 -translate-y-8 translate-x-8 rounded-full bg-sky-400/30 blur-2xl"></div>
    <p class="text-xs font-bold uppercase tracking-widest text-sky-700 dark:text-sky-200">👥 Community + learning</p>
    <h3 class="mt-3 text-xl font-bold text-sky-900 dark:text-white">Guild energy, threaded</h3>
    <p class="mt-2 text-sm text-sky-900/80 dark:text-sky-50">Live threads, class replays, and polls keep every maker looped in without leaving Yarnly.</p>
    <div class="mt-4 inline-flex items-center gap-2 rounded-full bg-white/90 px-4 py-2 text-xs font-bold text-sky-700 shadow-lg shadow-sky-200/50 dark:bg-sky-900/60 dark:text-sky-100">→ Visit community</div>
</article>
</div>
</div>
</section>

<section id="projects" class="bg-gradient-to-br from-emerald-50 via-teal-50 to-cyan-50 py-16 dark:from-emerald-950/40 dark:via-teal-950/40 dark:to-cyan-950/40">
    <div class="max-w-6xl mx-auto px-6 lg:px-12">
        <div class="grid gap-12 lg:grid-cols-[0.9fr_1.1fr]">
            <div class="space-y-4">
                <p class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-[0.32em] text-transparent bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text">🎯 Workflow taste</p>
                <h2 class="text-3xl font-semibold tracking-tight text-zinc-900 dark:text-white">See how projects, patterns, and stash talk to each other.</h2>
                <p class="text-base text-zinc-600 dark:text-zinc-300">This slice mirrors the actual flow you’ll find inside: capture a pattern, set milestones, sync stash, and share progress without leaving the board.</p>
                <ul class="mt-6 space-y-5 text-sm text-zinc-600 dark:text-zinc-300">
                    <li class="flex gap-4">
                        <span class="mt-1 inline-flex h-9 w-9 items-center justify-center rounded-full bg-white shadow-sm dark:bg-zinc-800">1</span>
                        <div>
                            <h3 class="font-semibold text-zinc-900 dark:text-white">Capture</h3>
                            <p>Drop PDFs or voice notes. AI tags yarn weight, skill level, and alerts on gauge drift.</p>
                        </div>
                    </li>
                    <li class="flex gap-4">
                        <span class="mt-1 inline-flex h-9 w-9 items-center justify-center rounded-full bg-white shadow-sm dark:bg-zinc-800">2</span>
                        <div>
                            <h3 class="font-semibold text-zinc-900 dark:text-white">Plan</h3>
                            <p>Milestones auto-calc yarn needs and reserve stash. Suppliers stay attached to each task.</p>
                        </div>
                    </li>
                    <li class="flex gap-4">
                        <span class="mt-1 inline-flex h-9 w-9 items-center justify-center rounded-full bg-white shadow-sm dark:bg-zinc-800">3</span>
                        <div>
                            <h3 class="font-semibold text-zinc-900 dark:text-white">Share</h3>
                            <p>Thread updates, quick polls, and one-click invites keep collaborators aligned.</p>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="relative overflow-hidden rounded-[2rem] border border-zinc-200 bg-white p-8 shadow-xl dark:border-zinc-800 dark:bg-zinc-950">
                <div class="grid gap-6">
                    <div class="rounded-2xl border border-emerald-300/60 bg-gradient-to-br from-emerald-100 to-teal-100 p-5 shadow-lg shadow-emerald-200/30 dark:border-emerald-500/40 dark:from-emerald-900/50 dark:to-teal-900/50">
                        <div class="flex items-center justify-between text-xs font-bold uppercase tracking-widest text-emerald-700 dark:text-emerald-200">
                            <span class="flex items-center gap-1">🎯 Board</span>
                            <span class="rounded-full bg-emerald-500/30 px-2 py-1">✓ Synced</span>
                        </div>
                        <p class="mt-2 text-lg font-bold text-emerald-900 dark:text-white">Focus lane · 3 cards</p>
                        <p class="text-sm text-emerald-800/80 dark:text-emerald-100">Tasks grouped by fiber type and deadline, with stash auto-reserved.</p>
                    </div>
                    <div class="rounded-2xl border border-amber-300/70 bg-gradient-to-br from-amber-100 to-orange-100 p-5 shadow-lg shadow-amber-200/30 dark:border-amber-500/40 dark:from-amber-900/50 dark:to-orange-900/50">
                        <p class="flex items-center gap-1 text-xs font-bold uppercase tracking-widest text-amber-700 dark:text-amber-200">📐 Pattern brain</p>
                        <p class="mt-2 text-lg font-bold text-amber-900 dark:text-white">Stitch math verified</p>
                        <p class="text-sm text-amber-800/80 dark:text-amber-100">Latest chart matched to DK gauge · 2 substitutions approved.</p>
                    </div>
                    <div class="rounded-2xl border border-rose-300/70 bg-gradient-to-br from-rose-100 to-pink-100 p-5 shadow-lg shadow-rose-200/30 dark:border-rose-500/40 dark:from-rose-900/50 dark:to-pink-900/50">
                        <p class="flex items-center gap-1 text-xs font-bold uppercase tracking-widest text-rose-700 dark:text-rose-200">🧶 Stash pulse</p>
                        <p class="mt-2 text-lg font-bold text-rose-900 dark:text-white">Balanced</p>
                        <p class="text-sm text-rose-800/80 dark:text-rose-100">Reserve 2 skeins for Atlas Socks · reorder reminder set for Moonlit DK.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="relative border-y border-sky-200 bg-gradient-to-br from-sky-50 via-indigo-50 to-violet-50 py-16 dark:border-sky-900 dark:from-sky-950/40 dark:via-indigo-950/40 dark:to-violet-950/40">
    <div class="max-w-6xl mx-auto grid gap-12 px-6 lg:grid-cols-[1.1fr_0.9fr] lg:px-12">
        <div class="space-y-4">
            <p class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-[0.4em] text-transparent bg-gradient-to-r from-sky-600 to-indigo-600 bg-clip-text">👥 Community + learning</p>
            <h2 class="text-3xl font-semibold tracking-tight text-zinc-900 dark:text-white">Threads, classes, and drops you can preview from home.</h2>
            <p class="text-base text-zinc-600 dark:text-zinc-300">Tap into upcoming events, trending threads, and spotlight drops without leaving the homepage. Each tile mirrors the feel of the community hub.</p>
            <div class="space-y-4">
                <article class="rounded-3xl border border-sky-300/80 bg-gradient-to-br from-sky-100 to-indigo-100 p-6 shadow-xl shadow-sky-200/40 dark:border-sky-500/40 dark:from-sky-900/50 dark:to-indigo-900/50">
                    <div class="flex items-center gap-3">
                        <div class="h-14 w-14 rounded-2xl bg-gradient-to-br from-emerald-500 via-teal-500 to-sky-500 p-0.5 shadow-lg">
                            <div class="flex h-full items-center justify-center rounded-[14px] bg-gradient-to-br from-emerald-400 to-sky-500 text-2xl font-bold text-white">G</div>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-sky-900 dark:text-white">Guild check-in</p>
                            <p class="flex items-center gap-1 text-xs font-semibold uppercase tracking-widest text-sky-700 dark:text-sky-100">⏱️ Starts in 45 minutes</p>
                        </div>
                    </div>
                    <p class="mt-4 text-sm text-sky-900/90 dark:text-sky-50">🔥 Palette swaps thread is hot · 💬 18 typing · 📊 2 polls closing soon.</p>
                </article>
                <article class="rounded-3xl border border-amber-300/80 bg-gradient-to-br from-amber-100 to-orange-100 p-6 shadow-xl shadow-amber-200/40 dark:border-amber-500/40 dark:from-amber-900/50 dark:to-orange-900/50">
                    <div class="flex items-center gap-3">
                        <div class="h-14 w-14 rounded-2xl bg-gradient-to-br from-amber-500 via-orange-500 to-rose-500 p-0.5 shadow-lg">
                            <div class="flex h-full items-center justify-center rounded-[14px] bg-gradient-to-br from-amber-400 to-rose-500 text-2xl font-bold text-white">S</div>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-amber-900 dark:text-white">Spotlight drop</p>
                            <p class="flex items-center gap-1 text-xs font-semibold uppercase tracking-widest text-amber-700 dark:text-amber-100">✨ Aurora Fade Shawl</p>
                        </div>
                    </div>
                    <p class="mt-4 text-sm text-amber-900/90 dark:text-amber-50">👥 128 makers contributed · 🧶 14 suppliers · 🎥 replays and kit links pinned.</p>
                </article>
            </div>
        </div>
        <div class="relative overflow-hidden rounded-[2.5rem] border border-violet-300/80 bg-gradient-to-br from-fuchsia-500 via-violet-500 via-sky-500 to-emerald-500 p-8 text-white shadow-2xl shadow-violet-500/40 dark:border-violet-500/60">
            <div class="absolute right-0 top-0 h-32 w-32 -translate-y-8 translate-x-8 rounded-full bg-white/20 blur-3xl"></div>
            <div class="absolute bottom-0 left-0 h-28 w-28 translate-x-4 translate-y-4 rounded-full bg-white/10 blur-2xl"></div>
            <div class="relative flex items-center justify-between text-xs font-bold uppercase tracking-widest text-white/90">
                <span class="flex items-center gap-1">📊 Community metrics</span>
                <span class="inline-flex h-2 w-2 animate-pulse rounded-full bg-white"></span>
            </div>
            <div class="mt-10 grid gap-6 text-sm">
                <div>
                    <p class="text-white/70">Monthly makers onboarded</p>
                    <p class="text-4xl font-semibold">+640</p>
                </div>
                <div>
                    <p class="text-white/70">Patterns launched this week</p>
                    <p class="text-4xl font-semibold">87</p>
                </div>
                <div>
                    <p class="text-white/70">Shared checklists completed</p>
                    <p class="text-4xl font-semibold">1,204</p>
                </div>
            </div>
            <div class="mt-10 rounded-3xl bg-white/10 p-5 backdrop-blur">
                <p class="text-xs uppercase tracking-[0.4em] text-white/70">Next up</p>
                <p class="mt-3 text-lg font-semibold">Live finishing class</p>
                <p class="text-sm text-white/80">Blocking masterclass with Nova Fibers · replay auto-saved.</p>
            </div>
        </div>
    </div>
</section>

<section class="bg-gradient-to-br from-violet-50 via-fuchsia-50 to-rose-50 py-20 dark:from-violet-950/40 dark:via-fuchsia-950/40 dark:to-rose-950/40">
    <div class="max-w-5xl mx-auto px-6 text-center lg:px-12">
        <p class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-[0.3em] text-transparent bg-gradient-to-r from-fuchsia-600 via-violet-600 to-rose-600 bg-clip-text">🎯 Everything in reach</p>
        <h2 class="mt-3 bg-gradient-to-r from-violet-600 via-fuchsia-600 to-rose-600 bg-clip-text text-3xl font-bold tracking-tight text-transparent dark:from-violet-400 dark:via-fuchsia-400 dark:to-rose-400">Jump from this homepage into any part of Yarnly with confidence.</h2>
        <p class="mt-4 text-base text-zinc-600 dark:text-zinc-300">Pick a slice—projects, patterns, stash, or community—and continue exactly where the preview left off.</p>

        <div class="mt-10 flex flex-wrap justify-center gap-4">
            @guest
            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="inline-flex items-center justify-center gap-2 rounded-full bg-gradient-to-r from-fuchsia-600 via-violet-600 to-sky-600 px-10 py-4 text-sm font-bold text-white shadow-2xl shadow-violet-500/50 transition hover:scale-110 hover:shadow-violet-600/60">
                <span>✨</span> Create free account
            </a>
            @endif
            @else
            @if(auth()->user()->is_admin)
            <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center gap-2 rounded-full bg-gradient-to-r from-fuchsia-600 via-violet-600 to-sky-600 px-10 py-4 text-sm font-bold text-white shadow-2xl shadow-violet-500/50 transition hover:scale-110 hover:shadow-violet-600/60">
                <span>🚀</span> Continue in dashboard
            </a>
            @else
            <a href="{{ route('patterns.crochet') }}" class="inline-flex items-center justify-center gap-2 rounded-full bg-gradient-to-r from-fuchsia-600 via-violet-600 to-sky-600 px-10 py-4 text-sm font-bold text-white shadow-2xl shadow-violet-500/50 transition hover:scale-110 hover:shadow-violet-600/60">
                <span>🧶</span> Browse Patterns
            </a>
            @endif
            @endguest
            <a href="#flyover" class="inline-flex items-center justify-center gap-2 rounded-full border-2 border-violet-300 bg-white/80 px-10 py-4 text-sm font-bold text-violet-700 shadow-lg transition hover:border-violet-400 hover:bg-white dark:border-violet-700 dark:bg-zinc-900/80 dark:text-violet-300 dark:hover:border-violet-600">
                Explore the pieces
            </a>
        </div>
    </div>
</section>

@endsection