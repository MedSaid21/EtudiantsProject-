<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Etudiant;
use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $etudiants = Etudiant::all();
        return response()->json($etudiants);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $e = new Etudiant();
       $e->nom = $request->input('nom');
        $e->prenom = $request->input('prenom');
       $e->note = $request->input('note');

       $e->save();

       return response()->json($e);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
public function show($id)
{
    $etudiant = Etudiant::find($id);

    if (!$etudiant) {
        return response()->json([
            'message' => 'Étudiant non trouvé'
        ], 404); // Code 404 = Not Found
    }

    return response()->json($etudiant);
}


   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
    // 1. Trouver l'étudiant par ID
    $etudiant = Etudiant::find($id);

    // 2. Vérifier s'il existe
    if (!$etudiant) {
        return response()->json(['message' => 'Étudiant non trouvé'], 404);
    }

    // 3. Mettre à jour les champs
    $etudiant->nom = $request->input('nom');
    $etudiant->prenom = $request->input('prenom');
    $etudiant->note = $request->input('note');

    // 4. Sauvegarder dans la base de données
    $etudiant->save();

    // 5. Retourner une réponse JSON
    return response()->json($etudiant); // ✅ retourne l'étudiant modifié
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $etu = Etudiant::find($id);
        $etu->delete();

    }
}
