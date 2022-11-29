<x-app-layout>
    <x-slot name="header">
        <h1 class="text-3xl font-bold">
            Show Event
        </h1>
        <div class="flex justify-end mt-5">
            <a class="px-2 py-1 rounded-md bg-sky-500 text-sky-100 hover:bg-sky-600" href="{{ route('viewAll') }}">< Back</a>
        </div>
    </x-slot>
    
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex flex-col mt-5">
            <div class="w-full px-6 py-4 bg-white rounded shadow-md ring-1 ring-gray-900/10">
                <h3 class="text-2xl font-semibold">{{ $events->name }}</h3>
                <p class="text-base text-gray-700 mt-5">{{ $events->slug }}</p>
                <p style="text-align: right" class="text-base text-gray-700 mt-5"> <em>Start At:</em> {{ $events->start_at }} <em>End At:</em> {{ $events->end_at }}</p>
            </div>
        </div>
    </div>
</x-app-layout>