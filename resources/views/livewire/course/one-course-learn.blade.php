@extends('layouts.app')

@section('page-title')
    {{ $course->name }}
@endsection

@section('padding-none')
    padding-none
@endsection

@section('content')
    <section class="one-course">
        <div class="container">
            @if(isset($disabled_modules))
                @livewire('course.one-course-learn-show', ['disabled_modules' => $disabled_modules, 'course_modules' => $course_modules,
                'course_id' => $course_id, 'course' => $course])
            @else
                @livewire('course.one-course-learn-show', ['course_modules' => $course_modules, 'course_id' => $course_id, 'course' => $course])
            @endif
    </section>
@endsection
