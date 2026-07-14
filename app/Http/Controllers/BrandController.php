<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use Illuminate\Http\Request;

class BrandController extends Controller


{

    public function index(Request $request)
    {
        $search = $request->search;

        $brands = Brand::when($search,function($query,$search){

            $query->where('name','like',"%$search%")
                  ->orWhere('country','like',"%$search%");

        })->latest()->paginate(10);

        return view('brands.index',compact('brands','search'));
    }

    public function create()
    {
        return view('brands.create');
    }

    public function store(StoreBrandRequest $request)
    {
        Brand::create($request->validated());

        return redirect()
            ->route('brands.index')
            ->with('success','Brand created successfully.');
    }

    public function show(Brand $brand)
    {
        return view('brands.show',compact('brand'));
    }

    public function edit(Brand $brand)
    {
        return view('brands.edit',compact('brand'));
    }

    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $brand->update($request->validated());

        return redirect()
            ->route('brands.index')
            ->with('success','Brand updated successfully.');
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();

        return redirect()
            ->route('brands.index')
            ->with('success','Brand deleted successfully.');
    }
}