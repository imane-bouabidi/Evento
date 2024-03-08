<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    protected $fillable = ['id','name'];
    protected $table = 'categorie';

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
