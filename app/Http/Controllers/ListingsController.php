<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingsController extends Controller
{
    //show all listings
    public function index() {
        return view('listings.index',
        [
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(6) //latest() to show the latest listing first
            //Listing::all() the same as Listing::get()
        ]);
    }

    //show single listing
    public function show(Listing $listing   ) {
        return view('listings.show', ['listing' => $listing]);
    }

    //show create form
    public function create() {
        return view('listings.create');
    }

    //store listing data
    public function store(Request $request) {
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', 'unique:listings,company'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        Listing::create($formFields);

        return redirect('/')->with('message', 'Listing created successfully!');
    }
}
