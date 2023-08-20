@extends('layout.sidenav')
@section('content')
    @include('components.expense.create-expense')
    @include('components.expense.expense-list')
    @include('components.expense.delete-expense')
    @include('components.expense.update-expense')
@endsection