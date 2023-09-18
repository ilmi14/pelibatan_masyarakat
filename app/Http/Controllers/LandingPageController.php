<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Event;
use App\Models\Faq;
use App\Models\Galeri;
use App\Models\Testimoni;
use App\Models\User;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index(){
        $testimoni = Testimoni::where('rating', 5)->get();
        $tutor = User::with('kelas')->where('level', 'tutor')->get();
        $berita = Berita::where('publish', 'Ya')->orderBy('id', 'desc')->get();
        if(count(Event::all())>5){
            $events = Event::orderBy('id', 'desc')->limit(5)->get();
        } else {
            $events = Event::orderBy('id', 'desc')->get();
        }
        $galeri = Galeri::where('publish', "Ya")->inRandomOrder()->limit(15)->get();
        if(count(Faq::all())>5){
            $faq = Faq::all()->random(5);
        } else {
            $faq = Faq::all();
        }
        return view('welcome', ['berita' => $berita, 'galeri' => $galeri, 'faq' => $faq, 'tutor' => $tutor, 'testimoni' => $testimoni, 'events' => $events]);
    }

    public function faq(){
        $faq = Faq::paginate(10);
        return view('faq', ['faq' => $faq]);
    }
    
    public function berita(Request $request){
        // $berita = Berita::where('publish', 'Ya')->orderBy('id', 'desc')->paginate(5);
        // $rekomendasi = Berita::where('publish', 'Ya')->orderBy('id', 'desc')->inRandomOrder()->limit(5)->get();
        // return view('berita.index', ['berita' => $berita, 'rekomendasi' => $rekomendasi]);
        
        $search = $request->search;
        if ($search == true) {
            $berita = Berita::where('publish', 'Ya')->where('judul', 'like', "%".$search."%")->orWhere('isi', 'like', "%".$search."%")->orderBy('id', 'desc')->get();
        } else {
            $berita = Berita::where('publish', 'Ya')->orderBy('id', 'desc')->paginate(10);
        }
        $rekomendasi = Berita::where('publish', 'Ya')->orderBy('id', 'desc')->inRandomOrder()->limit(5)->get();
        return view('berita.index', ['berita' => $berita, 'rekomendasi' => $rekomendasi, 'search' => $search]);
    }

    public function beritaShow($slug){
        $berita = Berita::where('slug', $slug)->where('publish', 'ya')->where('publish', 'Ya')->orderBy('id', 'desc')->firstOrFail();
        $rekomendasi = Berita::where('publish', 'Ya')->orderBy('id', 'desc')->inRandomOrder()->limit(5)->get();
        return view('berita.show', ['berita' => $berita, 'rekomendasi' => $rekomendasi]);
    }
}
