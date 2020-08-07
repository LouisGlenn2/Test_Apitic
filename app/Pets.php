<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pets extends Model{
    //déclare la structure du tableau
    protected $fillable = ['id', 'type', 'name', 'espece', 'description'];
    
    //Permet de retirer l'ajout de colonnes non désiré
    public $timestamps = false;

}

