@extends('layouts.app')

@section('page-title') Панель преподавателя @endsection

@section('grey-bg') grey @endsection

@section('padding-none') padding-none @endsection

@section('content')
    <section class="teacher-course-list panel">
        <div class="container teacher__container">
            @livewire('teacher-panel.group-show', ['course_id' => $course_id, 'group_id' => $group_id, 'module_id' => $module_id])
        </div>
    </section>
@endsection
