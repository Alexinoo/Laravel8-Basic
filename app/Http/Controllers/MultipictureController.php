<?php

namespace App\Http\Controllers;

use App\Models\Multipicture;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;

class MultipictureController extends Controller
{
    public function __construct()
    {
        // Call default middleware
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Multipicture::all();
        return view('Admin.Multipicture.index', compact('images'));
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
                'images' => 'required|max:2048',
            ],
            // Custom error messages
            [
                'images.required' => 'images cannot be blank',
            ]
        );

        // store the img
        $image = $request->file('images');

        foreach ($image as $key => $img) {

            // Get Image name with extension 
            $image_name[$key] = $img->getClientOriginalName();

            // Use Image Intervention to resize
            Image::make($img)->resize(300, 300)->save('image/multi/' . $image_name[$key], 80);

            // USE ELOQUENT ORM
            Multipicture::insert([
                'image' => $image_name[$key],
                'created_at' => Carbon::now(),
            ]);
        }

        return redirect()->back()->with('success', 'Pictures Added successfully');
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
