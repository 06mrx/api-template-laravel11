@extends('errors::minimal')

@section('title', __('Forbidden'))
{{-- @section('code', '403') --}}
@section('message', __("403 " . $exception->getMessage() ?: 'Forbidden 😓'))
