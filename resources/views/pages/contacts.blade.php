@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-6 overflow-hidden bg-white shadow-sm sm:rounded-lg md:p-8">
                <h1 class="mb-6 text-3xl font-bold text-center text-gray-800">Контакты</h1>
                <div class="mx-auto prose max-w-none lg:prose-lg">
                    <p>Если у вас есть вопросы, предложения или материалы, которыми вы хотели бы поделиться, пожалуйста, свяжитесь с нами.</p>

                    <h3>Электронная почта</h3>
                    <p>
                        <a href="mailto:memorial8site@gmail.com" class="text-indigo-600 hover:underline">info@dandaron.com</a>
                    </p>

                    {{-- В будущем здесь можно добавить форму обратной связи или другие контакты --}}

                </div>
            </div>
        </div>
    </div>
@endsection
