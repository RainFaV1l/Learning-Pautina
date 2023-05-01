@extends('layouts.app')

@section('page-title')
    Мои курсы
@endsection

@section('padding-none') padding-none @endsection

@section('content')
    <section class="my-courses">
        <div class="container">
            @livewire('course.my-courses-show')
        </div>
    </section>
@endsection
