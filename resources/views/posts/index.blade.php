@extends('base')
@section('title')
Posts
@endsection

@section('sidebar')
@include('partials.navbar')
@endsection

@section('body')
<div class="flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="mt-2 text-gray-600 dark:text-gray-400 text-xl">
            Hello Kiddos!, Welcome to Posts Page
        </div>
        @livewire('post.post-table')
    </div>

</div>


@endsection
@section('script')
@endsection