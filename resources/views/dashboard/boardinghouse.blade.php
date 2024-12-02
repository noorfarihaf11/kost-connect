@extends('dashboard.layouts.main')

@section('content')
    <div class="container grid px-6 mx-auto">
        @if (Gate::allows('admin'))
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Rumah Kost</h2>
        @elseif (Gate::allows('owner'))
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Rumah Kost Saya</h2>
        @endif

        <div class="flex items-center justify-between mb-4">
            <h4 class="text-lg font-semibold text-gray-600 dark:text-gray-300">Daftar Rumah Kost</h4>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach ($houses as $rumah)
                <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-md dark:border-gray-700 dark:bg-gray-800">
                    <div class="h-40 overflow-hidden rounded-lg">
                        <a href="#">
                            <img class="w-full h-full object-cover"
                                src="https://www.adira.co.id/img/frontend/news/thumb_rumahmewahminimalisjpg.jpg"
                                alt="">
                        </a>
                    </div>
                    <div class="pt-4">
                        <h5 class="text-lg font-semibold text-gray-900 dark:text-white hover:underline">
                            {{ $rumah->name }}
                        </h5>
                        <p class="text-sm text-gray-700 dark:text-gray-400">
                            {{ $rumah->owner->name }} | {{ $rumah->owner->phone }}
                        </p>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400"> Lokasi : {{ $rumah->address }}, {{ $rumah->city->name_city }}</p>

                        <div class="mt-4 flex justify-between items-center">
                            <span class="px-2 py-1 text-sm font-semibold rounded-full text-white 
                                {{ $rumah->gender_type == 'putra' ? 'bg-blue-600' : ($rumah->gender_type == 'putri' ? 'bg-pink-600' : 'bg-orange-600') }}">
                                {{ ucfirst($rumah->gender_type) }}
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
