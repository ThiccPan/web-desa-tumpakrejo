<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Potensi extends Model
{
    use HasFactory;
    use Sluggable;

    protected $table = 'potensi';
    protected $guarded = [];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'judul_potensi'
            ]
        ];
    }

    public function scopeFilter($query)
    {
            // if (request('search')) {
            //     $query = Potensi::where('judul_potensi', 'like', '%' . request('search') . '%')->paginate(10);
            //     return $query;
            // }
    }
}
