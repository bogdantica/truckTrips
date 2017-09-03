<?php

namespace App\Http\Controllers;

use App\Truck\GooglePlace;
use Illuminate\Http\Request;

class PlacesController extends Controller
{
    protected function search(Request $request)
    {
        $db = \DB::table('places')
            ->whereRaw("LOWER(name) = '" . $request->place . "' ")
            ->get(['name', 'id'])
            ->map(function ($item) {
                return (object)[
                    'id' => $item->id,
                    'text' => $item->name
                ];
            });

        $google = (new GooglePlace())
            ->search($request->place)
            ->map(function ($item) {
                return (object)[
                    'id' => $item->google_id,
                    'text' => $item->display
                ];
            });

        $merged = $db->merge($google);

        if ($merged->isEmpty()) {
            $merged->push((object)[
                'id' => 'custom_place_' . $request->place,
                'text' => $request->place
            ]);
        }

        return [
            'items' => $merged
        ];
    }
}
