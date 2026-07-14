@extends('layouts.crm')

@section('page-title','Brand Details')

@section('content')

<div class="bg-white rounded-3xl shadow p-8">

    <h1 class="text-3xl font-bold mb-8">

        {{ $brand->name }}

    </h1>

    <div class="space-y-4">

        <p>

            <strong>Country :</strong>

            {{ $brand->country }}

        </p>

        <p>

            <strong>Logo :</strong>

            {{ $brand->logo }}

        </p>

        <p>

            <strong>Description :</strong>

            {{ $brand->description }}

        </p>

    </div>

</div>

@endsection