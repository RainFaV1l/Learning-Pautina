@extends('layouts.app')

@section('page-title') Панель преподавателя @endsection

@section('grey-bg') grey @endsection

@section('padding-none') padding-none @endsection

@section('content')
    <section class="teacher-panel panel">
        <div class="container">
            @livewire('teacher-panel.courses-show')
        </div>
    </section>
@endsection
