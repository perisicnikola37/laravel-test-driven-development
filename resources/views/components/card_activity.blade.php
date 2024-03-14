@props(['project'])

<div class="w-[230%] mt-5">
    <div class="relative bg-white rounded-lg shadow-md hover:scale-105 duration-300 hover:cursor-pointer">
        <div class="absolute top-0 left-0 h-full bg-[#6366F1]" style="width: 4px; height:25%; margin-top: 20px;">
        </div>
        <div class="p-6">
            <h1 class="text-xl font-bold text-slate-900">Activities</h1>
            @foreach ($project->activity as $activity)
                <p class="text-sm text-slate-500 mt-2">{{ $activity->description }}</p>
            @endforeach
        </div>
    </div>
</div>
