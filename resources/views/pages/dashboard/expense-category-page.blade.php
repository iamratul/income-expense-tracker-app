@extends('layout.sidenav')
@section('content')
    @include('components.expense-category.expense-category-create')
    @include('components.expense-category.expense-category-list')
    @include('components.expense-category.expense-category-delete')
    @include('components.expense-category.expense-category-update')
@endsection