@extends('layouts.main.app')

@section('title', 'Project view | @perisicnikola37')

@section('content')
    <h1>
        <div class="flex items-center justify-between">
            @include('layouts.components.breadcrumb')
            <a href="{{ route('projects.edit', $project) }}">
                <button
                    class="bg-transparent mr-5 hover:bg-indigo-500 text-base text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded duration-300 mb-0">
                    Edit project
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
                        <h2 class="text-lg font-medium">
                            <form action="{{ $task->path() }}" method="POST" class="flex justify-between">
                                @method('PATCH')
                                @csrf
                                <input name="body" type="text" value="{{ $task->body }}"
                                    class="w-full bg-[#F4F4F8]  {{ $task->completed ? 'text-gray-500' : '' }}">
                                <input name="completed" type="checkbox" {{ $task->completed ? 'checked' : '' }}
                                    onChange="this.form.submit()">
                            </form>
                        </h2>
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
        <div class="flex flex-col">
            <x-card :project="$project" />
            <x-card_activity :project="$project" />
        </div>
    </div>

@endsection
