@extends('errors::minimal')

@section('title', __('Page Expired'))
@section('code', '419')
@section('message', __('Page Expired'))

@push('redirect')
<div class="text-center">
    <a href="{{ route('login') }}" class="btn btn-primary">Login First</a>
</div>
@endpush
