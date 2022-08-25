<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Berita extends Model
{
    use HasFactory;
    use Sluggable;

    protected $table = 'berita';
    protected $guarded = [];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'judul'
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function gambar()
    {
        return $this->morphMany(Gambar::class,'gambarable');
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
