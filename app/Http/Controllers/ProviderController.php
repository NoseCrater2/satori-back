<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Provider::get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($attributes)
    {
        $provider = new Provider($attributes);

        return $provider;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'phone' => 'required|max:15',
            'name' => 'required|max:150',
        ]);

        if ($validator->fails()) {
            return Response($validator->errors(), 422);
        }
        return $this->create($data)->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(Provider $provider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Provider $provider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $providerId)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'phone' => 'max:15',
            'name' => 'max:150',
        ]);

        if ($validator->fails()) {
            return Response($validator->errors(), 422);
        }
        $provider =  Provider::findOrFail($providerId);

        $provider->update($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($providerId)
    {
        $provider = Provider::where('id', $providerId)->firstOrFail();
        $provider->delete();
        return Response($provider, 200);
    }
}
