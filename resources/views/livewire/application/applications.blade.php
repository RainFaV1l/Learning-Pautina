@extends('layouts.app')

@section('page-title') Заявки на курс @endsection

@section('padding-none') padding-none @endsection

@section('content')
    <section class="my-courses applications">
        <div class="container">
            <div class="content">
                @livewire('application.application-show')
            </div>
        </div>
    </section>
@endsection('content')
