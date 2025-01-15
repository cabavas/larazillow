<?php

namespace App\Http\Controllers;

use \App\Models\Listing;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RealtorListingController extends Controller
{
    public function index(Request $request) {
        $filters = [
            'deleted' => $request->boolean('deleted'),
            ...$request->only(['by', 'order'])
        ];

        return inertia('Realtor/Index', [
            'filters' => $filters,
            'listings' => Auth::user()
                ->listings()
                ->latest()
                ->filter($filters)
                ->get()
        ]);
    }

    public function destroy(Listing $listing)
    {
        $listing->deleteOrFail();
        return redirect()->back()
            ->with('success', 'Listing was deleted!');
    }
}
