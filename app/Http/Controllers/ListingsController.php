<?php

namespace App\Http\Controllers;

use App\Models\Listings;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingsController extends Controller
{
    public function index()
    {
        // dd();
        return view('Listings.index', ['Listings' => Listings::latest()->filter(request(['tag', 'search']))
            ->paginate(6)]);
    }
    public function manage()
    {

        return view('Listings.manage', ['Listings' => User::find(auth()->id())->Listings()->get()]);
    }
    public function create()
    {
        return view('Listings.create');
    }
    public function store(Request $request)
    {
        // dd($request->file('logo'));
        $vaildData = $request->validate([
            'title' => 'required',
            'email' => ['required', 'email', Rule::unique('listings', 'email')],
            'company' => 'required',
            'location' => 'required',
            'website' => 'required',
            'tags' => 'required',
            'logo' => 'required',
            'description' => 'required'
        ]);
        $vaildData['user_id'] = auth()->id();

        if ($request->hasFile('logo')) {
            $vaildData['logo'] = $request->file('logo')->store('logos', 'public');
        }
        if (Listings::create($vaildData)) {
            return redirect()->route('home')->with('message', 'Listing added successfully');
        }
    }
    public function show($id)
    {
        $listing = Listings::find($id);
        return view('Listings.show', ['Listing' => $listing]);
    }
    public function edit($id)
    {
        $listing = Listings::find($id);
        return view('Listings.edit', ['Listing' => $listing]);
    }
    public function update($id)
    {
        $listing = Listings::find($id);
        if($listing->user_id != auth()->id()){
            abort(403,'Unauthorized action');
        }
        $validData = request()->validate([
            'title' => 'required',
            'email' => ['required', 'email', Rule::unique('listings', 'email')->ignore($listing->id)],
            'company' => 'required',
            'location' => 'required',
            'website' => 'required',
            'tags' => 'required',
            'logo' => 'required',
            'description' => 'required'
        ]);
        if (request()->hasFile('logo')) {
            $validData['logo'] = request()->file('logo')->store('logos', 'public');
        }

        if ($listing->update($validData)) {
            return back()->with('message', 'Listing updated successfully');
        }
    }
    public function delete($id){
        $listing = Listings::find($id);
        if($listing->user_id != auth()->id()){
            abort(403,'Unauthorized action');
        }
        if($listing->delete()){
            return back()->with('message', 'Listing deleted successfully');
        }

    }
}
