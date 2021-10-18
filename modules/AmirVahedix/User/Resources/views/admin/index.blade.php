@extends('Dashboard::master')

@section('title', 'همه کاربران')

@section('breadcrumbs')
    <li><a href="{{ route('dashboard.index') }}">پیشخوان</a></li>
    <li><a href="#">کاربران</a></li>
@endsection

@section('content')
    <div class="main-content">
        <livewire:users />
    </div>
@endsection
