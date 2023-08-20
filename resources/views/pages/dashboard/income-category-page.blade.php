@extends('layout.sidenav')
@section('content')
    @include('components.income-category.income-category-create')
    @include('components.income-category.income-category-list')
    @include('components.income-category.income-category-delete')
    @include('components.income-category.income-category-update')
@endsection