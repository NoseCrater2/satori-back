<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Sale::get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($attributes)
    {
        $currentTime = new DateTime();
        $preGenerated = [
            'folio' => Str::random(5).$currentTime->format('YYYYmmddhhmmss'),
            'date' => $currentTime
        ];
        $sale = new Sale(array_merge($preGenerated, $attributes));

        return $sale;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'client_id' => 'required|exists:clients,id',
            'state' => 'required|boolean',
            'products' => 'required|array|min:1',
            'products.*' => 'required|exists:products,id'
        ]);

        if ($validator->fails()) {
            return Response($validator->errors(), 422);
        }

        DB::transaction(function () use ($data){
           $sale = $this->create($data);
           $sale->save();
           $sale->products()->attach($data['products']);
        });
    }

    /**
     * Display the specified resource.
     */
    public function show($saleId)
    {
        $sale = Sale::findOrFail($saleId);
        return $sale->with('products:id,name,unitary_price,image')->get();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
