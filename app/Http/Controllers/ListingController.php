<?php

namespace App\Http\Controllers;

use App\Http\Requests\Listing\StoreListingRequest;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ListingController extends Controller
{
    public function index(Request $request)
    {
        $listings = collect(Listing::with('address')->get())->map(function (
            $listing,
        ) {
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
                ],
            ];
        });

        return Inertia::render('Listings/Index', [
            'listings' => $listings,
        ]);
    }

    public function edit(Listing $listing)
    {
        $new_listing = [
            'id' => $listing->id,
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
            ],
        ];

        return Inertia::render('Listings/Edit', [
            'listing' => $new_listing,
        ]);
    }

    public function show(Listing $listing)
    {
        return Inertia::render('Dashboard');
    }
    public function create(Request $request)
    {
        return Inertia::render('Listings/Create', []);
    }

    public function update(Request $request, Listing $listing)
    {
        // dd($listing);
        // $listing->user_id = auth()->user()->id;
        // $listing->user_name = auth()->user()->name;
        // $listing->price = $request->input('price');
        // $listing->status = $request->input('status');
        // $listing->date = date(
        //     'Y-m-d',
        //     strtotime(str_replace('-', '/', $request->input('date'))),
        // );

        //         $listing->address()->create([
        //             'street1' => $request->input('address.street1'),
        //             'street2' => $request->input('address.street2'),
        //             'city' => $request->input('address.city'),
        //             'state' => $request->input('address.state'),
        //             'postal_code' => $request->input('address.postal_code'),
        //             'country' => $request->input('address.country'),
        //             'latitude' => $request->input('address.latitude'),
        //             'longitude' => $request->input('address.longitude'),
        //         ]);

        // $listing->save();

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

    public function get(Request $request)
    {
        $users = User::all();
        $array = [];

        foreach ($users as &$user) {
            $to_add = Listing::where('user_name', auth()->user()->name)->get();
            $array = [...$array, $user->name => $to_add];
        }

        return $array;
    }

    public function updateListing(Request $request)
    {
        dd(Listing::find(1));
        //         $listing = Listing::find($request->listingId);
        //         dd($listing);
        //         $listing->price = $request->price;
        //         $listing->status = $request->status;
        //         $listing->date = date(
        //             'Y-m-d',
        //             strtotime(str_replace('-', '/', $request->date)),
        //         );
        //
        //         $listing->save();

        return Redirect::route('listing.index');
    }
}
