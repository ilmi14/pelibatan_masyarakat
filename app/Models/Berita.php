<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $table = "berita";

    protected $fillable = [
        "kategori_id", 
        "judul",
        "slug",
        "isi",
        "banner",
        "publish",
    ];
    
    public function kategori(){
        return $this->belongsTo(KategoriBerita::class);
    }
}
