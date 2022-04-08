<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::latest()->paginate(5);

        return view('Admin.Brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'brand_name' => 'required|unique:brands|min:4',
                'brand_image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            // Custom error messages
            [
                'brand_name.required' => 'Brand name cannot be blank',
                'brand_image.required' => 'Brand image cannot be blank',
            ]
        );

        // store the img
        $brand_image = $request->file('brand_image');

        // Get the extension in lower case
        $image_ext = strtolower($brand_image->getClientOriginalExtension());

        // image name
        $img_name = time() . '.' . $image_ext;

        // Store/move in the public directory
        $brand_image->move(public_path('image/brand'), $img_name);

        // USE ELOQUENT ORM
        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $img_name,
            'created_at' => Carbon::now(),
        ]);

        return redirect()->back()->with('success', 'Brand Added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
