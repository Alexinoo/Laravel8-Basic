<?php

namespace App\Http\Controllers;

use App\Models\About;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $abouts = About::latest()->paginate(5);

        return view('Admin.About.index', compact('abouts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.About.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $about = new About;

        $about->title = $request->title;
        $about->short_desc = $request->short_desc;
        $about->long_desc = $request->long_desc;

        if ($about->save()) {

            return response()->json([
                'status' => 200,
                'message' => 'About content inserted successfully'
            ]);
        } else {

            return response()->json([
                'status' => 400,
                'message' => 'Error inserting record'
            ]);
        }
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
        $about = About::find($id);

        return view('Admin.About.edit', compact('about'));
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
                'title' => 'required|unique:abouts|min:4',
                'short_desc' => 'required',
                'long_desc' => 'required',
            ],
            // Custom error messages
            [
                'title.required' => 'Title cannot be blank',
                'short_desc.required' => 'Short desc cannot be blank',
                'long_desc.required' =>  'Long desc cannot be blank',
            ]
        );

        // USE ELOQUENT ORM
        About::find($id)->update([
            'title' => $request->title,
            'short_desc' =>  $request->short_desc,
            'long_desc' =>  $request->long_desc,
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('home.about')->with('success', 'About content updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = About::find($id)->delete();

        return redirect()->back()->with('success', 'About content deleted successfully');
    }
}
