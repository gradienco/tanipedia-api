<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JadwalPupuk extends Model
{
    use SoftDeletes;
    
    protected $table = 'jadwal_pupuk';
    protected $primaryKey = 'id';

}