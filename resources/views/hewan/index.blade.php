@extends('layouts.main')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h2>Data Hewan</h2>

    @if(Auth::user()->role == 'admin')
    <a href="{{ route('h