@extends('layout.app')

@section('title', 'Yarnly - Crochet Patterns')

@section('content')
<section class="relative overflow-hidden bg-gradient-to-br from-emerald-50 via-teal-50 to-sky-50 py-16 dark:from-emerald-950/30 dark:via-teal-950/30 dark:to-sky-950/30">
	<div class="absolute -left-20 top-10 h-48 w-48 rounded-full bg-emerald-300/30 blur-3xl dark:bg-emerald-700/30"></div>
	<div class="absolute -right-12 bottom-10 h-64 w-64 rounded-full bg-teal-300/25 blur-3xl dark:bg-teal-700/25"></div>
	<div class="relative max-w-6xl mx-auto px-6 lg:px-12">
		<p class="inline-flex items-center gap-2 rounded-full bg-white/70 px-4 py-2 text-xs font-semibold uppercase tracking-wide text-emerald-700 ring-1 ring-emerald-200 dark:bg-zinc-900/70 dark:text-emerald-200 dark:ring-emerald-800/60">
			Crochet Spotlight
		</p>
		<div class="mt-6 flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
			<div class="max-w-3xl">
				<h1 class="text-4xl font-bold tracking-tight text-emerald-900 sm:text-5xl dark:text-white">Curated crochet patterns</h1>
				<p class="mt-4 text-lg leading-relaxed text-zinc-600 dark:text-zinc-300">
					Browse featured stitches, step-by-step project guides, and community favorites. Save patterns to your library and pick up where you left off.
				</p>
				<div class="mt-6 flex flex-wrap gap-3">
					<a href="#featured" class="rounded-xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-emerald-500/25 transition hover:translate-y-[-1px] hover:shadow-emerald-500/35">Featured sets</a>
					<a href="#collections" class="rounded-xl bg-white/80 px-5 py-3 text-sm font-semibold text-emerald-800 ring-1 ring-emerald-200 transition hover:bg-white dark:bg-zinc-900/70 dark:text-emerald-100 dark:ring-emerald-800/60">Community picks</a>
				</div>
			</div>
			<div class="grid w-full max-w-md grid-cols-2 gap-4 rounded-2xl bg-white/80 p-4 shadow-xl ring-1 ring-emerald-100 backdrop-blur dark:bg-zinc-900/70 dark:ring-emerald-900/40">
				<div class="rounded-xl bg-gradient-to-br from-emerald-500 to-teal-500 p-4 text-white shadow-lg">
					<p class="text-sm font-medium">New this week</p>
					<p class="mt-3 text-2xl font-bold">12 patterns</p>
					<p class="mt-1 text-sm text-emerald-100">Lacy throws, motifs, and quick makes.</p>
				</div>
				<div class="flex flex-col justify-between rounded-xl bg-white p-4 ring-1 ring-emerald-100 dark:bg-zinc-800 dark:ring-emerald-900/50">
					<div>
						<p class="text-sm font-semibold text-emerald-800 dark:text-emerald-100">Your queue</p>
						<p class="mt-2 text-3xl font-bold text-emerald-900 dark:text-white">3</p>
						<p class="text-sm text-zinc-600 dark:text-zinc-300">Projects ready to start.</p>
					</div>
					<div class="mt-4 flex items-center gap-2 text-xs font-medium text-emerald-700 dark:text-emerald-200">
						<span class="inline-flex h-2 w-2 rounded-full bg-emerald-500"></span>
						Synced with your library
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section id="featured" class="bg-white py-14 dark:bg-zinc-900">
	<div class="max-w-6xl mx-auto px-6 lg:px-12">
		<div class="flex items-center justify-between gap-4">
			<div>
				<p class="text-sm font-semibold text-emerald-700 dark:text-emerald-200">Featured drops</p>
				<h2 class="mt-1 text-3xl font-bold text-zinc-900 dark:text-white">Weekend-worthy crochet picks</h2>
			</div>
			<a href="#collections" class="text-sm font-semibold text-emerald-700 underline-offset-4 hover:underline dark:text-emerald-200">See collections</a>
		</div>

		<div class="mt-8 grid gap-6 md:grid-cols-3">
			<article class="group rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-lg dark:border-emerald-900/40 dark:bg-zinc-900/70">
				<div class="flex items-center justify-between">
					<div class="rounded-lg bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-200">Beginner</div>
					<span class="text-xs font-medium text-emerald-700 dark:text-emerald-200">6 hrs</span>
				</div>
				<h3 class="mt-4 text-lg font-bold text-zinc-900 dark:text-white">Soft Ripple Throw</h3>
				<p class="mt-2 text-sm text-zinc-600 dark:text-zinc-300">Gentle wave pattern using DK yarn; perfect for cozy weekends.</p>
				<div class="mt-4 flex items-center gap-3 text-xs font-semibold text-emerald-700 dark:text-emerald-200">
					<span class="inline-flex h-2 w-2 rounded-full bg-emerald-500"></span>
					1,240 makers saved
				</div>
			</article>

			<article class="group rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-lg dark:border-emerald-900/40 dark:bg-zinc-900/70">
				<div class="flex items-center justify-between">
					<div class="rounded-lg bg-teal-100 px-3 py-1 text-xs font-semibold text-teal-800 dark:bg-teal-900/40 dark:text-teal-200">Intermediate</div>
					<span class="text-xs font-medium text-teal-700 dark:text-teal-200">1 weekend</span>
				</div>
				<h3 class="mt-4 text-lg font-bold text-zinc-900 dark:text-white">Sunburst Granny Bag</h3>
				<p class="mt-2 text-sm text-zinc-600 dark:text-zinc-300">Join bold motifs with a reinforced strap and lined interior.</p>
				<div class="mt-4 flex items-center gap-3 text-xs font-semibold text-emerald-700 dark:text-emerald-200">
					<span class="inline-flex h-2 w-2 rounded-full bg-emerald-500"></span>
					Includes video walkthrough
				</div>
			</article>

			<article class="group rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-lg dark:border-emerald-900/40 dark:bg-zinc-900/70">
				<div class="flex items-center justify-between">
					<div class="rounded-lg bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-200">Beginner</div>
					<span class="text-xs font-medium text-emerald-700 dark:text-emerald-200">90 mins</span>
				</div>
				<h3 class="mt-4 text-lg font-bold text-zinc-900 dark:text-white">Chunky Coaster Set</h3>
				<p class="mt-2 text-sm text-zinc-600 dark:text-zinc-300">Work four quick rounds in super bulky yarn; ideal stash buster.</p>
				<div class="mt-4 flex items-center gap-3 text-xs font-semibold text-emerald-700 dark:text-emerald-200">
					<span class="inline-flex h-2 w-2 rounded-full bg-emerald-500"></span>
					Pattern + stitch chart
				</div>
			</article>
		</div>
	</div>
</section>

<section id="collections" class="bg-gradient-to-br from-emerald-50 via-white to-teal-50 py-14 dark:from-emerald-950/20 dark:via-zinc-900 dark:to-teal-950/20">
	<div class="max-w-6xl mx-auto px-6 lg:px-12">
		<div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
			<div>
				<p class="text-sm font-semibold text-emerald-700 dark:text-emerald-200">Community sets</p>
				<h2 class="text-3xl font-bold text-zinc-900 dark:text-white">Collections you can start tonight</h2>
				<p class="mt-2 text-sm text-zinc-600 dark:text-zinc-300">Save a set to your library or clone it into a project board.</p>
			</div>
			<a href="/" class="text-sm font-semibold text-zinc-600 underline-offset-4 hover:underline dark:text-zinc-300">Back to home</a>
		</div>

		<div class="mt-8 grid gap-6 md:grid-cols-3">
			<div class="rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm ring-1 ring-transparent transition hover:-translate-y-1 hover:ring-emerald-200 dark:border-emerald-900/40 dark:bg-zinc-900/70 dark:hover:ring-emerald-800/50">
				<h3 class="text-lg font-bold text-zinc-900 dark:text-white">Modern Granny Squares</h3>
				<p class="mt-2 text-sm text-zinc-600 dark:text-zinc-300">12-square palette with seamless joins and video tips.</p>
				<div class="mt-4 flex flex-wrap gap-2 text-xs font-semibold text-emerald-700 dark:text-emerald-200">
					<span class="rounded-full bg-emerald-100 px-3 py-1 dark:bg-emerald-900/40">Colorwork</span>
					<span class="rounded-full bg-emerald-100 px-3 py-1 dark:bg-emerald-900/40">Modular</span>
				</div>
			</div>

			<div class="rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm ring-1 ring-transparent transition hover:-translate-y-1 hover:ring-emerald-200 dark:border-emerald-900/40 dark:bg-zinc-900/70 dark:hover:ring-emerald-800/50">
				<h3 class="text-lg font-bold text-zinc-900 dark:text-white">Mindful Stitch Series</h3>
				<p class="mt-2 text-sm text-zinc-600 dark:text-zinc-300">Five meditative projects with breathing prompts and pacing guides.</p>
				<div class="mt-4 flex flex-wrap gap-2 text-xs font-semibold text-emerald-700 dark:text-emerald-200">
					<span class="rounded-full bg-emerald-100 px-3 py-1 dark:bg-emerald-900/40">Wellness</span>
					<span class="rounded-full bg-emerald-100 px-3 py-1 dark:bg-emerald-900/40">Quick wins</span>
				</div>
			</div>

			<div class="rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm ring-1 ring-transparent transition hover:-translate-y-1 hover:ring-emerald-200 dark:border-emerald-900/40 dark:bg-zinc-900/70 dark:hover:ring-emerald-800/50">
				<h3 class="text-lg font-bold text-zinc-900 dark:text-white">Textured Staples</h3>
				<p class="mt-2 text-sm text-zinc-600 dark:text-zinc-300">Ribbed beanies, waffle scarves, and squishy mitts for gifting.</p>
				<div class="mt-4 flex flex-wrap gap-2 text-xs font-semibold text-emerald-700 dark:text-emerald-200">
					<span class="rounded-full bg-emerald-100 px-3 py-1 dark:bg-emerald-900/40">Accessories</span>
					<span class="rounded-full bg-emerald-100 px-3 py-1 dark:bg-emerald-900/40">Texture</span>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
