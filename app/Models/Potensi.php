<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Str;

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

    public function scopeFilter($query, array $filters){
        $query->when($filters['search'] ?? false, function($query, $search){
            return $query->where('judul', 'like', '%' . $search . '%')
                         ->orWhere('deskripsi', 'like', '%' . $search . '%');
        });
    }

    public function excerpt()
    {
        $deskripsi = strip_tags($this->deskripsi);
        $deskripsi = Str::words($deskripsi, 15, '...');

        return $deskripsi;
    }
}
