<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadTugas extends Model
{
    use HasFactory;

    protected $table = "upload_tugas";

    protected $fillable = [
        'tugas_id',
        'tugas',
    ];

    public function uploadTugas(){
        return $this->belongsTo(UploadTugas::class);
    }
}
