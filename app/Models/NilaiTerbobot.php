<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiTerbobot extends Model
{
    use HasFactory;
    protected $table = 'nilai_terbobot';
    protected $guarded = [];

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }
}
