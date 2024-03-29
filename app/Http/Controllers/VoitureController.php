<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Voiture;

class VoitureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $voitures = Voiture::all();
        return response()->json($voitures, 201);
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
    public function EstimationPrixVoitures(Request $request)
    {
        $voitures = $request->validate([
            'marque' => 'required',
            'modele' => 'required',
            'annee' => 'required',
        ]);

        $selectVoituresSimilaire = Voiture::where('marque', $voitures['marque'])
                                            ->where('modele',$voitures['modele'])
                                            ->where('annee', $voitures['annee'])
                                            ->get();

        if($selectVoituresSimilaire->isEmpty())
        {
            return response()->json(['message'=>'aucune voitures s'], 404);
        }

        $total = $selectVoituresSimilaire->sum('prix');
        $price = $total/$selectVoituresSimilaire->count();

        return response()->json(['estimation'=>$price]);
    }

    /**
     * Display the specified resource.
     */
    public function show(c $c)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(c $c)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, c $c)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(c $c)
    {
        //
    }
}
