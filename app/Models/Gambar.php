<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gambar extends Model
{
    use HasFactory;
    protected $table = 'gambar';
    protected $guarded = [];
    protected $with = ['gambarable'];

    public function gambarable()
    {
        return $this->morphTo();
    }

    public function getRouteKeyName()
    {
        return 'gambar';
    }
}
