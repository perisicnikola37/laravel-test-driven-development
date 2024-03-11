@extends('layouts.main.app')

@section('title', 'Page Title')

@section('content')
    <div class="relative font-inter antialiased">
        <main class="relative min-h-screen bg-slate-900 overflow-hidden">
            <div class="container mx-auto px-4 md:px-6 py-24">
                <!-- Card grid -->
                <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse ($projects as $key => $project)
                        <div class="bg-white rounded-lg shadow-md">
                            <img class="w-full h-44 object-cover rounded-t-lg"
                                src="https://cdn.hdwebsoft.com/wp-content/uploads/2021/11/Thiet-ke-chua-co-ten-4.jpg.webp"
                                alt="{{ $project['title'] }}">
                            <div class="p-6">
                                <h1 class="text-xl font-bold text-slate-900">{{ $project['title'] }}</h1>
                                <p class="text-sm text-slate-500 mt-2">{{ $project['description'] }}</p>
                                <p class="text-sm text-slate-500 mt-2">{{ $project['additional_info'] }}</p>
                                <a class="block text-sm font-medium text-indigo-500 hover:underline mt-4"
                                    href="{{ $project['link'] }}">Read more -></a>
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-white">No projects in database</div>
                    @endforelse
                </section>
                <!-- End: Card grid -->
            </div>
        </main>
        <!-- Page footer -->
        <footer class="absolute left-6 right-6 md:left-12 md:right-auto bottom-4 md:bottom-8 text-center md:text-left">
            <a class="text-xs text-slate-500 hover:underline" href="https://cruip.com">&copy;Cruip - Tailwind CSS
                templates</a>
        </footer>
        <!-- Banner with links -->
        <div class="fixed bottom-0 right-0 w-full md:bottom-6 md:right-12 md:w-auto z-50"
            :class="bannerOpen ? '' : 'hidden'" x-data="{ bannerOpen: true }">
            <div class="bg-slate-800 text-sm p-3 md:rounded shadow flex justify-between">
                <div class="text-slate-500 inline-flex">
                    <a class="font-medium hover:underline text-slate-300"
                        href="https://cruip.com/creating-a-css-only-card-slider-with-tailwind-css/" target="_blank">
                        Read Tutorial
                    </a>
                    <span class="italic px-1.5">or</span>
                    <a class="font-medium hover:underline text-indigo-500 flex items-center"
                        href="https://github.com/cruip/cruip-tutorials/blob/main/card-slider/index.html" target="_blank"
                        rel="noreferrer">
                        <span>Download</span>
                        <svg class="fill-indigo-400 ml-1" xmlns="http://www.w3.org/2000/svg" width="9" height="9">
                            <path d="m1.649 8.514-.91-.915 5.514-5.523H2.027l.01-1.258h6.388v6.394H7.158l.01-4.226z" />
                        </svg>
                    </a>
                </div>
                <button class="text-slate-500 hover:text-slate-400 pl-2 ml-3 border-l border-slate-700"
                    @click="bannerOpen = false">
                    <span class="sr-only">Close</span>
                    <svg class="w-4 h-4 shrink-0 fill-current" viewBox="0 0 16 16">
                        <path
                            d="M12.72 3.293a1 1 0 00-1.415 0L8.012 6.586 4.72 3.293a1 1 0 00-1.414 1.414L6.598 8l-3.293 3.293a1 1 0 101.414 1.414l3.293-3.293 3.293 3.293a1 1 0 001.414-1.414L9.426 8l3.293-3.293a1 1 0 000-1.414z" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
@endsection
