<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadMateri extends Model
{
    use HasFactory;
    
    protected $table = "upload_materi";

    protected $fillable = [
        'materi_id',
        'materi',
    ];

    public function uploadMateri(){
        return $this->belongsTo(UploadMateri::class);
    }
}
