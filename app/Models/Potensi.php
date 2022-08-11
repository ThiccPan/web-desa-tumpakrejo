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
                'source' => 'judul'
            ]
        ];
    }

    public function gambar()
    {
        return $this->morphMany(Gambar::class,'gambarable');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
