<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
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
        // ELOQUENT ORM - Read Data
        // $categories = Category::all(); --BASIC
        // $categories = Category::latest()->get(); //ORDER BY CREATED_AT
        $categories = Category::latest()->paginate(5); //PAGINATION 5 PER PAGE


        // QUERY BUILDER - Read Data
        // $categories = DB::table('categories')->latest()->get();

        // QUERY BUILDER - Read Data - Pagination
        // $categories = DB::table('categories')->latest()->paginate(5);

        // QUERY BUILDER - JOINS
        // $categories = DB::table('categories')
        //     ->join('users', 'categories.user_id', 'users.id')
        //     ->select('categories.*', 'users.name')
        //     ->latest()->paginate(5);


        // SOFT DELETE - DELETE - PUT ITEMS IN A TRASH
        $trashCategory = Category::onlyTrashed()
            ->latest()->paginate(3);


        return view('Admin.Category.index', compact('categories', 'trashCategory'));
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
        // ELOQUENT ORM - FIND
        // $category = Category::find($id);

        // QUERY BUILDER  EDIT - EDIT RECORD  - METHOD -1
        $category  = DB::table('categories')->where('id', $id)->first();

        return view('Admin.Category.edit', compact('category'));
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
                'category_name' => 'required|unique:categories|max:255',
            ],
            // Custom message errors
            [
                'category_name.required' => 'Category name cannot be blank',
                'category_name.unique' => 'Duplicate found',
                'category_name.max' => 'Category should be less than 255 characters',
            ]
        );

        // ELOQUENT ORM EDIT - UPDATE - METHOD -1
        // $category = Category::find($id)->update([
        //     'category_name' => $request->category_name,
        //     'user_id' => Auth::user()->id,
        //     'updated_at' =>   Carbon::now()
        // ]);

        // ELOQUENT ORM EDIT - UPDATE  - METHOD -2
        // $category = Category::find($id);
        // $category->category_name = $request->category_name;
        // $category->user_id =  Auth::user()->id;
        // $category->updated_at =   Carbon::now();
        // $category->update();

        // QUERY BUILDER  - UPDATE RECORD  - METHOD -1
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['user_id']  = Auth::user()->id;
        $data['updated_at']  = Carbon::now();

        DB::table('categories')->where('id', $id)->update($data);

        return redirect()->route('all.category')->with('success', 'Category Updated successfully');
    }



    //SOFT DELETE
    public function SoftDelete($id)
    {
        $delete = Category::find($id)->delete();

        return redirect()->back()->with('success', 'Category Soft Deleted successfully');
    }


    // RESTORE  DELETED Item
    public function Restore($id)
    {
        $delete = Category::withTrashed()->find($id)->restore();

        return redirect()->back()->with('success', 'Category Restored successfully');
    }



    // DELETE PERMANENTLY
    public function DeletePermanent($id)
    {
        $delete = Category::onlyTrashed()->find($id)->forceDelete();

        return redirect()->back()->with('success', 'Category Deleted permanently');
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
