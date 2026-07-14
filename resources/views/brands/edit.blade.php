@extends('layouts.crm')

@section('page-title','Edit Brand')

@section('content')

<div class="space-y-6">

    <h2 class="text-3xl font-bold">

       EDit brand 

 </h2>

    <div class="bg-white rounded-3xl shadow p-8">

        <form
            action="{{ route('brands.update',$brand) }}"
            method="POST"
        >

            @csrf
            @method('PUT')

            @include('brands.form')

            <div class="mt-8 flex justify-end">

                <x-primary-button>

                    Update Brand

                </x-primary-button>

            </div>

        </form>

    </div>

</div>

@endsection