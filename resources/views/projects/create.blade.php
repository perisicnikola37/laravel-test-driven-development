@extends('layouts.main.app')

@section('title', 'Project view | @perisicnikola37')

@section('content')
    <h1>
        <div class="flex items-center justify-between">
            @include('layouts.components.breadcrumb')
        </div>
    </h1>

    <div class="flex">
        <div class="w-3/5 mr-10 ml-10">
            <div class="container mx-auto px-4 md:px-6">
                <form action={{ route('projects.store') }} method="POST">
                    @csrf
                    <div class="mx-auto">
                        <h1 class="text-4xl font-bold text-black mb-6">Create a new project</h1>

                        <div>
                            <label for="title"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                            <input type="text" id="title" name="title"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-[60%] p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="John" required />
                        </div>

                        <div>
                            <label for="description"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                            <input type="text" id="description" name="description"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-[60%] p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="John" required />
                        </div>

                        <button type="submit"
                            class="mt-5 mb-5 bg-transparent hover:bg-indigo-500 text-base text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded duration-300 mb-0">
                            Add project
                        </button>

                        <div>
                            <a href="/projects" class="text-indigo-500 hover:underline text-sm flex items-center">
                                <svg class="fill-indigo-400 mr-1" xmlns="http://www.w3.org/2000/svg" width="9"
                                    height="9">
                                    <path
                                        d="m1.649 8.514-.91-.915 5.514-5.523H2.027l.01-1.258h6.388v6.394H7.158l.01-4.226z" />
                                </svg>
                                <span>Go back</span>
                            </a>
                </form>
            </div>
        </div>
    </div>

@endsection
