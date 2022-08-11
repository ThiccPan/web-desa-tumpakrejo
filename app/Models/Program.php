<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Program extends Model
{
    use HasFactory;
    use Sluggable;

    protected $table = 'program';
    protected $guarded = [];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'judul',
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
