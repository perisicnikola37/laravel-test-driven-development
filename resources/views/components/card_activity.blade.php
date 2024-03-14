@props(['project'])

<div class="w-[230%] mt-5">
    <div class="relative bg-white rounded-lg shadow-md hover:scale-105 duration-300 hover:cursor-pointer">
        <div class="absolute top-0 left-0 h-full bg-[#6366F1]" style="width: 4px; height:25%; margin-top: 20px;">
        </div>
        <div class="p-6">
            @foreach ($project->activity as $activity)
                @include("projects.activity.{$activity->description}")
                <div class="text-sm text-slate-500">{{ $activity->created_at->diffForHumans() }}</div>
            @endforeach
        </div>
    </div>
</div>
