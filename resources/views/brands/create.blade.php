@extends('layouts.crm')

@section('page-title','New Brand')

@section('content')

<div class="space-y-6">

    <div class="flex justify-between items-center">

        <div>
            <h2 class="text-3xl font-bold">
                Add Brand
            </h2>

            <p class="text-slate-500">
                Create a new optical brand.
            </p>
        </div>

        <a
            href="{{ route('brands.index') }}"
            class="px-5 py-3 rounded-xl border"
        >
          Back
        </a>
    </div>

    <div class="bg-white rounded-3xl shadow p-8">

        <form action="{{ route('brands.store') }}" method="POST">

            @csrf

            @include('brands.form')

            <div class="mt-8 flex justify-end">

                <x-primary-button>

                    Save Brand

                </x-primary-button>

            </div>

        </form>

    </div>

</div>

@endsection