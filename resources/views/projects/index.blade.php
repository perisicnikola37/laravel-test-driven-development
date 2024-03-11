@extends('layouts.main.app')

@section('title', 'Test driven development in Laravel | @perisicnikola37')

@section('content')
    <div class="container mx-auto px-4 md:px-6 py-10">
        <!-- Card grid -->
        <h1>
            <div class="flex items-center justify-between mb-5">
                <p class="text-gray-400 text-sm mb-0">My projects</p>
                <a href="{{ route('projects.create') }}">
                    <button
                        class="bg-transparent hover:bg-indigo-500 text-base text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded duration-300 mb-0">
                        Add project
                    </button>
                </a>
            </div>
        </h1>

        <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($projects as $key => $project)
                <div class="relative bg-white rounded-lg shadow-md hover:scale-105 duration-300 hover:cursor-pointer">
                    <div class="absolute top-0 left-0 h-full bg-[#6366F1]" style="width: 4px; height:25%; margin-top: 20px;">
                    </div>
                    <div class="p-6">
                        <h1 class="text-xl font-bold text-slate-900">{{ $project['title'] }}</h1>
                        <p class="text-sm text-slate-500 mt-2">{{ $project['description'] }}</p>
                        <p class="text-sm text-slate-500 mt-2">{{ $project['additional_info'] }}</p>
                        <a class="block text-sm font-medium text-indigo-500 hover:underline mt-4"
                            href="{{ route('projects.show', $project->id) }}">Show more -></a>
                    </div>
                </div>

            @empty
                <div class="text-center text-black text-md">No projects in database</div>
            @endforelse
        </section>
        <!-- End: Card grid -->
    </div>
@endsection
