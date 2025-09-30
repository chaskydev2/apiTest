<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contractor;

class ContractorController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'legal_name'         => 'required|string|max:200',
            'display_name'       => 'nullable|string|max:200',
            'slug'               => 'nullable|string|max:220|unique:contractors,slug',
            'description'        => 'nullable|string',
            'website_url'        => 'nullable|url|max:255',
            'phone'              => 'nullable|string|max:30',
            'email'              => 'nullable|email|max:255',
            'headquarters_city'  => 'nullable|string|max:120',
            'headquarters_state' => 'nullable|string|max:10',
            'country_code'       => 'required|string|size:2',
            'address_line1'      => 'nullable|string|max:200',
            'address_line2'      => 'nullable|string|max:200',
            'zip_code'           => 'nullable|string|max:15',
            'lat'                => 'nullable|numeric',
            'lng'                => 'nullable|numeric',
            'google_rating_avg'  => 'nullable|numeric|min:0|max:5',
            'google_rating_count'=> 'nullable|integer|min:0',
            'status'             => 'nullable|string|in:pending,approved,suspended',
            'tier'               => 'nullable|string|in:Certified,Elite',
        ]);
        $contractor = Contractor::create([
            'id'                  => (string) \Illuminate\Support\Str::uuid(),
            'legal_name'          => $request->legal_name,
            'display_name'        => $request->display_name,
            'slug'                => $request->slug ?? \Illuminate\Support\Str::slug($request->legal_name),
            'description'         => $request->description,
            'website_url'         => $request->website_url,
            'phone'               => $request->phone,
            'email'               => $request->email,
            'headquarters_city'   => $request->headquarters_city,
            'headquarters_state'  => $request->headquarters_state,
            'country_code'        => $request->country_code ?? 'US',
            'address_line1'       => $request->address_line1,
            'address_line2'       => $request->address_line2,
            'zip_code'            => $request->zip_code,
            'lat'                 => $request->lat,
            'lng'                 => $request->lng,
            'google_rating_avg'   => $request->google_rating_avg,
            'google_rating_count' => $request->google_rating_count,
            'status'              => $request->status ?? 'pending',
            'tier'                => $request->tier ?? 'Certified',
            'created_at'          => now(),
            'updated_at'          => now(),
        ]);

        return response()->json($contractor, 201);
    }

    public function showAll()
    {
        return response()->json(Contractor::all());
    }

    public function show($id)
    {
        $contractor = Contractor::find($id);
        return response()->json($contractor);
    }

    public function update(Request $request, $id)
    {
        $contractor = Contractor::find($id);
        $contractor->update($request->all());
        return response()->json($contractor);
    }

    public function destroy($id)
    {
        $contractor = Contractor::find($id);
        $contractor->delete();
        return response()->json(null, 204);
    }
}

