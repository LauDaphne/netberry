@extends('layouts.app')

@section('content')

    @include('tasks.partials.form')

    <hr class="my-4">

    @include('tasks.partials.filter')

    <hr class="my-4">

    @include('tasks.partials.table')

@endsection
