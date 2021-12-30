<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ListingController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Listings/Index', [
            'listings' => Listing::all(),
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

    public function updateListing(Request $request)
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

    public function createListing(Request $request)
    {
        $listing = Listing::create([
            'user_id' => $request->userId,
            'user_name' => $request->userName,
            'address' => $request->address,
            'price' => $request->price,
            'status' => $request->status,
            'date' => date(
                'Y-m-d',
                strtotime(str_replace('-', '/', $request->date)),
            ),
        ]);

        return Redirect::route('listing.index');
    }

    public function get(Request $request)
    {
        return Listing::all();
    }
}
