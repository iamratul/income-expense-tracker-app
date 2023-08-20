@extends('layout.sidenav')
@section('content')
    @include('components.income.create-income')
    @include('components.income.income-list')
    @include('components.income.delete-income')
    @include('components.income.update-income')
@endsection