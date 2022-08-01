<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengurus extends Model
{
    use HasFactory;

    public $timestamp = false;
    public $incrementing = false;

    protected $table = 'pengurus';
    protected $primaryKey = 'NIP';
    protected $guarded = [];

    public function setUpdatedAt($value)
    {
      return NULL;
    }


    public function setCreatedAt($value)
    {
      return NULL;
    }

}
