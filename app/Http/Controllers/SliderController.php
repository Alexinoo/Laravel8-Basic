<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
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
                'title' => 'required|min:4',
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

        return redirect()->route('home.slider')->with('success', 'Slider Added successfully');
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
        $slider = Slider::find($id);

        return view('Admin.Slider.edit', compact('slider'));
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
                'title' => 'required|min:4',
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

        $slider = Slider::find($id);

        //LOGIC - Delete from destination and upload a new image
        if ($request->hasfile('image')) {

            $destination = public_path('image/slider/' . $request->image);

            // Check if image exists in the destination folder
            if (File::exists($destination)) {

                // IF SO - DELETE
                File::delete($destination);
            }

            //PROCEED WITH THE UPLOAD

            $slider_image = $request->file('image');

            // get file extension - assign a unique name
            $img_name = time() . '.' . $slider_image->getClientOriginalExtension();

            // Use Image Intervention to resize
            $image_resize = Image::make($slider_image->getRealPath())->resize(1920, 1088);

            //Save in the public directory
            $image_resize->save('image/slider/' . $img_name, 80);

            Slider::find($id)->update([
                'title' =>  $request->title,
                'description' =>  $request->description,
                'image' =>  $img_name,
                'updated_at' => Carbon::now()
            ]);
            return redirect()->route('home.slider')->with('success', 'Slider Updated successfully');
        } else {

            Slider::find($id)->update([
                'title' => $request->title,
                'description' =>  $request->description,
                'updated_at' => Carbon::now()
            ]);
            return redirect()->route('home.slider')->with('success', 'Slider Updated successfully');
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
        $slider = Slider::find($id);
        if ($slider) {

            $destination = public_path('image/slider/' . $slider->image);
            // /Check if image exists in the destination folder
            if (File::exists($destination)) {
                // IF SO - DELETE
                File::delete($destination);
            }

            //Delete category itself
            $slider->delete();

            return redirect()->route('home.slider')->with('success', 'Slider deleted successfully');
        } else {
            return "No slider ID Found";
        }
    }
}
