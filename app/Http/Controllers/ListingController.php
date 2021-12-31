<?php

namespace App\Http\Controllers;

use App\Http\Requests\Listing\StoreListingRequest;
use App\Models\Listing;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ListingController extends Controller
{
    public function index(Request $request)
    {
        $listings = collect(Listing::with('address')->get())->map(function($listing) {
            return [
                'uuid' => $listing->uuid,
                'price' => $listing->price,
                'status' => $listing->status,
                'date' => $listing->date,
                'address' => [
                   'street1' => $listing->address->street1,
                   'street2' => $listing->address->street2,
                   'city' => $listing->address->city,
                   'state' => $listing->address->state,
                   'postal_code' => $listing->address->postal_code,
                ] 
            ];
        });
        
        return Inertia::render('Listings/Index', [
            'listings' => $listings
        ]);
    }

    public function edit(Listing $listing)
    {
        return Inertia::render('Listings/Edit', [
            'listing' => $listing,
        ]);
    }

    public function show(Listing $listing)
    {
        return Inertia::render('Listings/Show', [
            'listing' => $listing,
        ]);
    }
    public function create(Request $request)
    {
        return Inertia::render('Listings/Create', []);
    }

    public function update(Request $request)
    {
        $listing = Listing::find($request->listingId);

        $listing->address = $request->address;
        $listing->price = $request->price;
        $listing->status = $request->status;
        $listing->date = date(
            'Y-m-d',
            strtotime(str_replace('-', '/', $request->date)),
        );

        $listing->save();

        return Redirect::route('listing.index');
    }

    /**
     * Store a newly created listing.
     *
     * @param StoreListingRequest $request
     * @return RedirectResponse
     */
    public function store(StoreListingRequest $request)
    {
        $listing = Listing::create([
            'user_id' => auth()->user()->id,
            'user_name' => auth()->user()->name,
            'price' => $request->input('price'),
            'status' => $request->input('status'),
            'date' => date(
                'Y-m-d',
                strtotime(str_replace('-', '/', $request->input('date'))),
            ),
        ]);
        
        var_dump($request->all());
        
        $listing->address()->create([
            'street1' => $request->input('address.street1'),
            'street2' => $request->input('address.street2'),
            'city' => $request->input('address.city'),
            'state' => $request->input('address.state'),
            'postal_code' => $request->input('address.postal_code'),
            'country' => $request->input('address.country'),
            'latitude' => $request->input('address.latitude'),
            'longitude' => $request->input('address.longitude'),
        ]);
        
        return Redirect::route('listing.index');
    }

    public function input(Request $request)
    {
        return Listing::all();
    }
}
