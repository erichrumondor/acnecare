<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KonsultasiRule extends Model {
    protected $fillable = [
        'nomor_pertanyaan','pertanyaan',
        'jawaban_ya','jawaban_tidak'
    ];
}