<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;
    use Sluggable;

    protected $table = 'album';
    protected $guarded = [];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nama',
                'onUpdate' => true
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