<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Http\Requests\RequestAjoutAnimal;
use App\Http\Requests\RequestUpdateAnimal;

use App\Pets;
use DB;

use Illuminate\Http\Request;

class ControllerAnimaux extends Controller
{
   //permet d'afficher index.php avec la liste de tout les animaux
   public function index(){
       $pets = Pets::orderBy('id', 'asc')->get();
       return view('index', compact('pets'));
    }
    
    //Nous ramène à index.php une fois le formulaire d'ajout fini
    public function create(){
        return redirect()->route('list');
    }

    //Ajouter le nouvel annimal passé en paramètre ($Request) dans la BDD
    public function store(RequestAjoutAnimal $request){
        $type = $request->type;
        $name = $request->name;
        $espece = $request->espece;
        $description = $request->description;
        Pets::create(['id', 'type' => $type, 'name' => $name, 'espece' => $espece, 'description' => $description]);
        return redirect()->route('add');
      
    }
    
    //Nous renvoie sur la page update.php et envoie l'id pour que update puisse travailler
    public function edit($id){
        $pets = Pets::where('id',$id)->get();
        return view('update', compact('pets'));
    }
    
    //Modifie l'animal passé en paramètre ($id) dans la BDD
    public function update(RequestUpdateAnimal $request, $id){
        $type = $request->type;
        $name = $request->name;
        $espece = $request->espece;
        $description = $request->description;
        Pets::where('id',$id)->update(['id'=>$id, 'type' => $type, 'name' => $name, 'espece' => $espece, 'description' => $description]);
        return redirect()->route('list');
    }
    
    //Supprime l'animal passé en paramètre ($id) de la BDD
    public function delete($id){
        Pets::where('id', $id)->delete();
        return redirect()->route('list');
    }
    
    //Trie la liste d'animaux en fonction de leur type
    public function orderByType(){
        $pets = Pets::orderBy('type', 'asc')->get();
        return view('index', compact('pets'));
    }
}
