@extends('layouts.app')
@section('content')
    <div class="p-4 bg-white rounded-lg shadow-md sm:p-6 lg:p-8">
        <h1 class="mb-4 text-3xl font-bold text-gray-800">Биография: {{ $author->name }}</h1>
        @if ($author->bio)
            <div class="prose max-w-none lg:prose-lg">
                {!! $author->bio !!}
            </div>
        @else
            <p class="text-gray-600">Биографические данные для этого автора еще не добавлены.</p>
        @endif
    </div>
@endsection
