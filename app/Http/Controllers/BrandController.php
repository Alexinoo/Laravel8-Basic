<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Image;

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

        // Get Image name with nextension 
        $image_name = time() . '.' . $brand_image->getClientOriginalExtension();

        // Use Image Intervention to resize
        $image_resize = Image::make($brand_image->getRealPath())->resize(400, 300);

        //Save in the public directory
        $image_resize->save('image/brand/' . $image_name, 80);


        // USE ELOQUENT ORM
        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $image_name,
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
        $brand = Brand::find($id);

        return view('Admin.Brand.edit', compact('brand'));
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
        $validated = $request->validate(
            [
                'brand_name' => 'required|min:4',
                // 'brand_image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            // Custom error messages
            [
                'brand_name.required' => 'Brand name cannot be blank',
                // 'brand_image.required' => 'Brand image cannot be blank',
            ]
        );
        $brand = Brand::find($id);

        //LOGIC - Delete from destination and upload a new image
        if ($request->hasfile('brand_image')) {

            $destination = public_path('image/brand/' . $request->brand_image);

            // Check if image exists in the destination folder
            if (File::exists($destination)) {

                // IF SO - DELETE
                File::delete($destination);
            }

            //PROCEED WITH THE UPLOAD

            $brand_image = $request->file('brand_image');

            // get file extension - assign a unique name
            $img_name = time() . '.' . $brand_image->getClientOriginalExtension();

            // Store/move in the public directory
            $brand_image->move(public_path('image/brand'), $img_name);

            //Save the filename in the db
            $brand->brand_image = $img_name;

            Brand::find($id)->update([
                'brand_name' =>  $request->brand_name,
                'brand_image' =>  $img_name,
                'updated_at' => Carbon::now()
            ]);
            return redirect()->route('all.brand')->with('success', 'Brand Updated successfully');
        } else {

            Brand::find($id)->update([
                'brand_name' =>  $request->brand_name,
                'updated_at' => Carbon::now()
            ]);
            return redirect()->route('all.brand')->with('success', 'Brand Updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::find($id);
        if ($brand) {

            $destination = public_path('image/brand/' . $brand->brand_image);
            // /Check if image exists in the destination folder
            if (File::exists($destination)) {
                // IF SO - DELETE
                File::delete($destination);
            }

            //Delete category itself
            $brand->delete();

            return redirect()->route('all.brand')->with('success', 'Brand deleted successfully');
        } else {
            return "No brand ID Found";
        }
    }
}
