<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contenus;
use App\Models\Images;
use App\Models\Auteur;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;

class ContenusController extends Controller
{
    //
    public function index()
    {
        $contenus = DB::table('contenus')
            ->where('etat', 0)
            ->get();

        return view("welcome", compact("contenus"));
    }

    public function moreInfo($idContenu, $title)
    {
        $contenu = DB::table('contenus')
            ->join('auteur', 'auteur.id', '=', 'contenus.idauteur')
            ->select('contenus.*', 'auteur.nom', 'auteur.prenom')
            ->where('contenus.id', $idContenu)
            ->first();

        session()->put('idContenu', $idContenu);

        return view("infoContenu", compact("contenu"));
    }


    public function verifyLogin(Request $request)
    {
        $email = $request->input('email');
        $mdp = $request->input('mdp');

        // $admin = Admin::where('email')->first();
        $admin = DB::table('admin')->where('email', $request->input('email'))->first();
        if ($admin && $mdp === $admin->mdp) {
            session()->put('idAdmin', $admin->id);
            return $this->index()->with('idAdmin', $admin->id);
        } else if (!$admin && !$mdp) {
            $errorMessage = 'L\'email et le mot de passe sont incorrects';
        } else if (!$admin) {
            $errorMessage = 'L\'email est incorrect';
        } else {
            $errorMessage = 'Le mot de passe est incorrect';
        }
        return redirect()->back()->withErrors(['email' => $errorMessage]);
    }

    public function insertContenu(Request $request)
    {
        $titre = $request->input('titre');
        $description = $request->input('description');
        $texte = $request->input('texte');
        // $description = $request->get('description');
        $image = $request->image;
        $name = Storage::disk('public')->put('images', $request->image);

        $contenu = new Contenus();
        $contenu->titre = $titre;

        $contenu->description = $description;
        $contenu->texte = $texte;
        $contenu->images = $name;
        $contenu->save();
        return redirect()->route('accueil');
    }

    //test
    public function upload(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/images', $imageName);

            // Enregistrez le nom du fichier dans votre base de données
            $images = new Images();
            $images->image = $imageName;
            $images->save();

            return "Image uploaded and saved successfully!";
        }

        return "No image selected for upload.";
    }

    //modifier
    public function modifierContenu()
    {
        $idContenu = session()->get("idContenu");
        $contenu = Contenus::where('id', $idContenu)->first();

        return view("modifier", compact("contenu"));
    }

    public function modifyContent(Request $request)
    {
        $idContenu = session()->get("idContenu");
        $contenu = Contenus::find($idContenu);
        $titre = $request->input('titre');
        $description = $request->input('description');
        $texte = $request->input('texte');
        $contenu->titre = $titre;

        $contenu->description = $description;
        $contenu->texte = $texte;

        $contenu->update();
        return redirect()->route('accueil');
    }

    public function supprimerContenu()
    {
        $idContenu = session()->get("idContenu");
        $contenu = Contenus::find($idContenu);
        $etat = 1;
        $contenu->etat = $etat;
        $contenu->update();
        return redirect()->route('accueil');
    }

    public function logout()
    {
        if (session()->has('idContenu')) {
            session()->forget('idContenu');
            session()->flush();
        }
        $response = new Response();
        $response->header('Cache-Control', 'no-cache, no-store, must-revalidate');
        $response->header('Pragma', 'no-cache');
        $response->header('Expires', '0');

        return Redirect::to(route('accueil'))->withHeaders($response->headers->all());
    }
}
