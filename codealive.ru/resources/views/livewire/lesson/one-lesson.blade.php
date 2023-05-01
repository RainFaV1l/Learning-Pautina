@extends('layouts.app')

@section('page-title') {{ $lesson->name }} @endsection

@section('padding-none') padding-none @endsection

@section('content')
    <section class="lesson one-course one-lesson">
        @if(isset($module_id))
            @livewire('lesson.show-more', ['lesson_id' => $lesson_id, 'module_id' => $module_id])
        @else
            @livewire('lesson.show-more', ['lesson_id' => $lesson_id])
        @endif
    </section>
@endsection
