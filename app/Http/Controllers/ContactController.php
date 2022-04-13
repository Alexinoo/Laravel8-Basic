<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::paginate(5);

        return view('Admin.Contact.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Contact.create');
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
                'address' => 'required|min:4',
                'email' => 'required|email',
                'phone' => 'required|min:10',
            ],
            // Custom error messages
            [
                'address.required' => 'Address cannot be blank',
                'email.required' => 'Email cannot be blank',
                'phone.required' => 'Phone cannot be blank',
                // 'brand_image.required' => 'Brand image cannot be blank',
            ]
        );

        Contact::insert([
            'address' =>  $request->address,
            'email' =>  $request->email,
            'phone' =>  $request->phone,
            'created_at' => Carbon::now()
        ]);
        return redirect()->route('admin.contact')->with('success', 'Contact inserted successfully');
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
        $contact = Contact::find($id);

        return view('Admin.Contact.edit', compact('contact'));
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
                'address' => 'required|min:4',
                'email' => 'required|email',
                'phone' => 'required|min:10',
            ],
            // Custom error messages
            [
                'address.required' => 'Address cannot be blank',
                'email.required' => 'Email cannot be blank',
                'phone.required' => 'Phone cannot be blank',
                // 'brand_image.required' => 'Brand image cannot be blank',
            ]
        );

        Contact::find($id)->update([
            'address' =>  $request->address,
            'email' =>  $request->email,
            'phone' =>  $request->phone,
            'updated_at' => Carbon::now()
        ]);
        return redirect()->route('admin.contact')->with('success', 'Contact updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete =  Contact::find($id)->delete();

        return redirect()->route('admin.contact')->with('success', 'Contact deleted successfully');
    }


    // Frontend - Contact
    public function Contact()
    {
        $contact = DB::table('contacts')->first();

        return view('Pages.contact', compact('contact'));
    }
}
