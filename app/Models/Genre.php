<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Genre extends Model
{
    use HasFactory;

    protected $table = 'genres';

    protected $primaryKey = 'genre_id';

    protected $fillable = [
        'genre_name'
    ];

    public static function findGenreById($genreId){
        return DB::table('genres')->where('genre_id',$genreId)->first();
    }
}
