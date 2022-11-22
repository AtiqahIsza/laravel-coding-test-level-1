@extends('layouts.app')
 
@section('content')
    <div class="max-w-4xl mx-auto mt-8">
    <div class="mb-4">
        <h1 class="text-3xl font-bold text-center">
                Task 2: User Interface
        </h1>
    </div>
    <div class="flex justify-end mt-10">
        <a class="px-2 py-1 rounded-md bg-blue-500 text-sky-100 hover:bg-blue-700" href="{{ route('createEvent') }}">Create New Event</a>
    </div>
   
    <div class="flex flex-col mt-10">
        <div class="flex flex-col">
            <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">

                @if ($message = Session::get('success'))
                    <div class="p-3 rounded bg-green-500 text-green-100 mb-4 m-3">
                        <span>{{ $message }}</span>
                    </div>
                @elseif ($message = Session::get('failed'))
                    <div class="p-3 rounded bg-red-500 text-red-100 mb-4 m-3">
                        <span>{{ $message }}</span>
                    </div>
                @endif

                <div class="container">
                    <form action="{{url('/search')}}" method="POST" role="search">
                        {{ csrf_field() }}
                        <div class="input-group">
                            <input type="text" class="form-control" name="search"
                                placeholder="Search event..."> <span class="input-group-btn">
                                <button type="submit" class="btn btn-default">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </span>
                        </div>
                    </form>
                </div>
                <table class="min-w-full">
                    <tr>
                        <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">No</th>
                        <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">Name</th>
                        <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">Slug</th>
                        <th class="px-12 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50" width="280px">Action</th>
                    </tr>
                    <tbody class="bg-white"> 
                        @foreach ($events as $event)
                        <tr>
                            <td class="px-6 whitespace-no-wrap border-b border-gray-200">{{ ++$i }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $event->name }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $event->slug }}</td>
                            <td class="px-12 py-4 whitespace-no-wrap border-b border-gray-200">
                                <form action="{{ route('destroyEvent', $event->id) }}" method="POST">

                                    <a href="{{ route('viewEvent',$event->id) }}" class="text-indigo-600 hover:text-indigo-900">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>

                                    <a href="{{ route('editEvent',$event->id) }}" class="text-indigo-600 hover:text-indigo-900 text-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                   
                                    @csrf
                                    @method('DELETE')
                      
                                    <button type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-600 hover:text-red-800 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $events->links() !!}
            </div>
        </div>
    </div>
</div>
@endsection