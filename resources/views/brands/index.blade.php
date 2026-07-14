@extends('layouts.crm')

@section('page-title','Brands')

@section('content')

<div class="space-y-6">

    <div class="flex justify-between items-center">

        <h1 class="text-3xl font-bold">

            Brands

        </h1>

        <a
            href="{{ route('brands.create') }}"
            class="bg-indigo-600 text-white px-5 py-3 rounded-xl"
        >
            + New Brand
        </a>

    </div>

    <form>

        <input
            type="text"
            name="search"
            value="{{ $search }}"
            placeholder="Search Brand..."
            class="w-full rounded-xl border p-3"
        >

    </form>

    <div class="bg-white rounded-3xl shadow overflow-hidden">

        <table class="w-full">

            <thead class="bg-slate-100">

                <tr>

                    <th class="p-4 text-left">Name</th>

                    <th class="p-4 text-left">Country</th>

                    <th class="p-4 text-left">Actions</th>

                </tr>

            </thead>

            <tbody>

            @forelse($brands as $brand)

                <tr class="border-t">

                    <td class="p-4">

                        {{ $brand->name }}

                    </td>

                    <td class="p-4">

                        {{ $brand->country }}

                    </td>

                    <td class="p-4 flex gap-2">

                        <a href="{{ route('brands.show',$brand) }}">
                            View
                        </a>

                        <a href="{{ route('brands.edit',$brand) }}">
                            Edit
                        </a>

                        <form
                            action="{{ route('brands.destroy',$brand) }}"
                            method="POST"
                        >

                            @csrf
                            @method('DELETE')

                            <button>

                                Delete

                            </button>

                        </form>
                    
                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="3" class="p-8 text-center">

                        No brands found.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

    {{ $brands->links() }}

</div>

@endsection