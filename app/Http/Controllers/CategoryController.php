<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // ELOQUENT ORM - Read Data
        // $categories = Category::all(); --BASIC
        // $categories = Category::latest()->get(); //ORDER BY CREATED_AT


        // QUERY BUILDER - Read Data
        $categories = DB::table('categories')->latest()->get();


        return view('Admin.Category.index', compact('categories'));
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
                'category_name' => 'required|unique:categories|max:255',
            ],
            // Custom message errors
            [
                'category_name.required' => 'Category name cannot be blank',
                'category_name.unique' => 'Duplicate found',
                'category_name.max' => 'Category should be less than 255 characters',
            ]
        );

        //ELOQUENT ORM - INSERT DATA
        // Category::insert([
        //     'category_name' => $request->category_name,
        //     'user_id' => Auth::user()->id,
        //     'created_at' => Carbon::now()
        // ]);

        //ELOQUENT ORM -Model Instance
        // $category = new Category;
        // $category->category_name = $request->category_name;
        // $category->user_id =  Auth::user()->id;
        // $category->created_at =   Carbon::now();
        // $category->save();

        //QUERY BUILDER -INSERT DATA
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['user_id']  = Auth::user()->id;
        $data['created_at']  = Carbon::now();

        DB::table('categories')->insert($data);

        return redirect()->back()->with('success', 'Category Added successfully');
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
