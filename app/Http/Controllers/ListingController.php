<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Gate;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Gate::authorize('viewAny', Listing::class);
        
        $filters = $request->only(['priceFrom', 'priceTo', 'beds', 'baths', 'areaFrom', 'areaTo']);
        
        return inertia('Listing/Index',
        [
            'filters' => $filters,
            'listings' => Listing::latest()
            ->filter($filters)->paginate()->withQueryString()
            ]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
        // if (Auth::user()->cannot('view', $listing)) {
        //     abort(403);
        // }
        Gate::authorize('view',$listing);
        return inertia('Listing/Show', [
            'listing' => $listing
        ]);
    }
}
