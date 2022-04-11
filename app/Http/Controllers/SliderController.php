<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Image;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::paginate(5);

        return view('Admin.Slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Slider.create');
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
                'title' => 'required|unique:sliders|min:4',
                'description' => 'required|max:255',
                'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            // Custom error messages
            [
                'title.required' => 'Title cannot be blank',
                'description.required' => 'Description cannot be blank',
                'description.required' => 'Slider image cannot be blank',
            ]
        );

        // store the img
        $slider_image = $request->file('image');

        // Get Image name with nextension 
        $image_name = time() . '.' . $slider_image->getClientOriginalExtension();

        // Use Image Intervention to resize
        $image_resize = Image::make($slider_image->getRealPath())->resize(1920, 1088);

        //Save in the public directory
        $image_resize->save('image/slider/' . $image_name, 80);


        // USE ELOQUENT ORM
        Slider::insert([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $image_name,
            'created_at' => Carbon::now(),
        ]);

        return redirect()->back()->with('success', 'Slider Added successfully');
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
