<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KonsultasiHasil extends Model {
      protected $table = 'konsultasi_hasil';
    protected $fillable = [
        'user_id','hasil','jawaban','keparahan'
    ];

    protected $casts = [
        'jawaban' => 'array',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function getHasilLabelAttribute() {
    switch($this->hasil) {
        case 'komedo_hitam': return 'Komedo Hitam';
        case 'komedo_putih': return 'Komedo Putih';
        case 'papula':       return 'Papula';
        case 'pustula':      return 'Pustula';
        case 'nodul':        return 'Nodul';
        default:             return 'Tidak Terdeteksi';
    }
}

public function getKeparahanLabelAttribute() {
    switch($this->keparahan) {
        case 'ringan': return 'Ringan';
        case 'sedang': return 'Sedang';
        case 'berat':  return 'Berat';
        default:       return '-';
    }
}
}