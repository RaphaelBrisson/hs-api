<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// Mon modèle pour les favoris
class Favorite extends Model
{
    protected $table = 'favorites';
    protected $fillable = ['artists', 'track_name'];
}
