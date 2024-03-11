@extends('layouts.main.app')

@section('title', 'Project view | @perisicnikola37')

@section('content')
    <h1>
        <div class="flex items-center justify-between">
            @include('layouts.components.breadcrumb')
            <a href="{{ route('projects.create') }}">
                <button
                    class="bg-transparent mr-5 hover:bg-indigo-500 text-base text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded duration-300 mb-0">
                    Add project
                </button>
            </a>
        </div>
    </h1>

    <div class="flex">
        <div class="w-3/5 mr-10 ml-10">
            <div class="bg-white p-8 rounded-lg shadow-lg">
                <h1 class="text-2xl font-semibold mb-6">Tasks</h1>
                @foreach ($project->tasks as $task)
                    <div class="bg-[#F4F4F8] p-4 rounded-lg mb-4">
                        <h2 class="text-lg font-medium">{{ $task->body }}</h2>
                    </div>
                @endforeach
                <h2 class="text-lg font-medium">
                    <form action="{{ $project->path() . '/tasks' }}" method="POST">
                        @csrf
                        <input type="text"
                            class="pl-4 py-4 outline-indigo-400 border-indigo-200 border-2 rounded-md px-4 w-full"
                            placeholder="Start adding tasks.." name="body">
                    </form>
                </h2>
            </div>

            <div class="bg-white p-8 rounded-lg shadow-lg mt-10">
                <h1 class="text-2xl font-semibold mb-6">General Notes</h1>
                <div class="bg-[#F4F4F8] p-4 rounded-lg">
                    <h2 class="text-lg font-medium">Lorem ipsum.</h2>
                </div>
            </div>
        </div>

        <div class="w-1/5">
            <div class="relative bg-white rounded-lg shadow-md hover:scale-105 duration-300 hover:cursor-pointer">
                <div class="absolute top-0 left-0 h-full bg-[#6366F1]" style="width: 4px; height:25%; margin-top: 20px;">
                </div>
                <div class="p-6">
                    <h1 class="text-xl font-bold text-slate-900">{{ $project['title'] }}</h1>
                    <p class="text-sm text-slate-500 mt-2">{{ $project['description'] }}</p>
                    <p class="text-sm text-slate-500 mt-2">{{ $project['additional_info'] }}</p>
                </div>
            </div>
        </div>
    </div>

@endsection
