<?php

namespace App\Http\Controllers;

use App\Models\Appartments;
use App\Models\review_ratings;
use App\Http\Requests\StoreAppartmentsRequest;
use App\Http\Requests\UpdateAppartmentsRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class AppartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // code for illustration 
        return Appartments::with('MediaManually')->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAppartmentsRequest $request)
    {
        $this->validate($request, [
            'country' => 'required', 'max:60',
            'city' => 'required', 'max:60',
            'name' => 'required', 'max:60', 'unique:appartments',
            'pricepernight' => 'required', 'min:1', 'max:10000', 'floatval',
         
        ]);
        $appartment = new Appartments;
        $appartment->country = $request->input('country');
        $appartment->city = $request->input('city');
        $appartment->name = $request->input('name');
        $appartment->pricepernight = $request->input('pricepernight');
        $appartment->owner =  Auth::user()->id;
        $appartment->save();
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $appartment->addMediaFromRequest('image')->toMediaCollection('images');
        }
        return "ok";
    }

    /**
     * Display the specified resource.
     */
    public function show(Appartments $appartments)
    {
        $appartments=Appartments::find($appartments);
        return $appartments;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appartments $appartments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAppartmentsRequest $request, $id)
    {
        $this->validate($request, [
            'country' => 'required', 'max:60',
            'city' => 'required', 'max:60',
            'name' => 'required', 'max:60', 'unique:appartments',
            'pricepernight' => 'required', 'min:1', 'max:10000', 'floatval',
         
        ]);
        $appartment = Appartments::find($id);
        return $appartment->update($request->all());

        
        
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Appartments::destroy($id);
        
        return 'ff';

    }
    public function reviewstore(Request $request)
    {

        $review = new review_ratings();
        $review->appartment_id = $request->input('appartment_id');
        $review->comments = $request->input('comment');
        $review->star_rating = $request->input('rating');
        $review->owner = Auth::user()->id;

        $review->save();
        return redirect()->back()->with('flash_msg_success', 'Your review has been submitted Successfully,');
    }
}
