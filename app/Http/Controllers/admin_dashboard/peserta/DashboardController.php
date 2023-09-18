<?php

namespace App\Http\Controllers\admin_dashboard\peserta;

use App\Http\Controllers\Controller;
use App\Models\DataPresensi;
use App\Models\Kelas;
use App\Models\Materi;
use App\Models\Presensi;
use App\Models\Quiz;
use App\Models\RegistrasiEvent;
use App\Models\RegistrasiKelas;
use App\Models\Tugas;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request){
        $class = $request->kelas ." ". $request->tahun;
        $tahun = $request->tahun;
        
        $kelas = RegistrasiKelas::with('kelas')->where('user_id', Auth::user()->id)->get();
        if($kelas->count()>0){
            foreach ($kelas as $kela) {
                $className[] = preg_replace('~\\s+\\S+$~', "", $kela->kelas->nama_kelas);
                $pilihTahun[] = Carbon::parse($kela->kelas->tanggal_mulai)->format('Y');
            }
            $namaKelas = array_unique($className, SORT_REGULAR);
            $pilihTahun = array_unique($pilihTahun, SORT_REGULAR);
        } else {
            $namaKelas = null;
            $pilihTahun = null;
        }

        if ($class == true && $tahun == true) {
            $cariKelas = Kelas::where('nama_kelas', $class)->whereYear('tanggal_mulai', $tahun)->first();
            
            $hadir = Presensi::whereHas('dataPresensi', function($query){
                return $query->where('user_id', Auth::user()->id)->where('status', 'Hadir');
            })
            ->whereHas('kelas', function($query) use ($class, $tahun){
                return $query->where('nama_kelas', $class)
                ->whereYear('tanggal_mulai', $tahun);
            })->get()->count();
    
            $sakit = Presensi::whereHas('dataPresensi', function($query){
                return $query->where('user_id', Auth::user()->id)->where('status', 'Sakit');
            })
            ->whereHas('kelas', function($query) use ($class, $tahun){
                return $query->where('nama_kelas', $class)
                ->whereYear('tanggal_mulai', $tahun);
            })->get()->count();
            
            $izin = Presensi::whereHas('dataPresensi', function($query){
                return $query->where('user_id', Auth::user()->id)->where('status', 'Izin');
            })
            ->whereHas('kelas', function($query) use ($class, $tahun){
                return $query->where('nama_kelas', $class)
                ->whereYear('tanggal_mulai', $tahun);
            })->get()->count();
    
            $countTidakHadir = Presensi::whereHas('dataPresensi', function($query){
                return $query->where('user_id', Auth::user()->id)->where('status', 'Tidak Hadir');
            })
            ->whereHas('kelas', function($query) use ($class, $tahun){
                return $query->where('nama_kelas', $class)
                ->whereYear('tanggal_mulai', $tahun);
            })->get()->count();
            
            $countDataTidakHadir = Presensi::select('presensi.*')
                ->leftJoin('registrasi_kelas', 'registrasi_kelas.kelas_id', '=', 'presensi.kelas_id')
                ->where('registrasi_kelas.user_id', Auth::user()->id)
                ->where('presensi.tanggal_berakhir', '<' , Carbon::now()->format('Y-m-d'))
                ->whereHas('kelas', function($query) use ($class, $tahun){
                    return $query->where('nama_kelas', $class)
                    ->whereYear('tanggal_mulai', $tahun);
                })->get()->count();
                
            $tidakHadir = ($countDataTidakHadir+$countTidakHadir) - ($hadir+$sakit+$izin);
                
            $presensi = Presensi::whereHas('kelas', function($query) use ($tahun, $class){
                return $query->whereYear('tanggal_mulai', $tahun)
                ->where('nama_kelas', $class)
                ->whereHas('registrasiKelas', function($query) use ($tahun){
                    return $query->where('user_id', Auth::user()->id);
                });
            })
            ->where('kelas_id', $cariKelas->id)->orderBy('id', 'desc')->limit(3)->get();

            $tugas = Tugas::whereHas('kelas', function($query) use ($tahun, $class){
                return $query->whereYear('tanggal_mulai', $tahun)
                ->where('nama_kelas', $class)
                ->whereHas('registrasiKelas', function($query) use ($tahun){
                    return $query->where('user_id', Auth::user()->id);
                });
            })
            ->where('kelas_id', $cariKelas->id)->orderBy('id', 'desc')->limit(3)->get();
            
            $quiz = Quiz::whereHas('kelas', function($query) use ($tahun, $class){
                return $query->whereYear('tanggal_mulai', $tahun)
                ->where('nama_kelas', $class)
                ->whereHas('registrasiKelas', function($query) use ($tahun){
                    return $query->where('user_id', Auth::user()->id);
                });
            })
            ->where('kelas_id', $cariKelas->id)->orderBy('id', 'desc')->limit(3)->get();
            
            $materi = Materi::whereHas('kelas', function($query) use ($tahun, $class){
                return $query->whereYear('tanggal_mulai', $tahun)
                ->where('nama_kelas', $class)
                ->whereHas('registrasiKelas', function($query) use ($tahun){
                    return $query->where('user_id', Auth::user()->id);
                });
            })
            ->where('kelas_id', $cariKelas->id)->orderBy('id', 'desc')->limit(3)->get();
        } else {
            $cariKelas = null;

            $hadir = DataPresensi::where('user_id', Auth::user()->id)->where('status', 'Hadir')
            ->whereHas('presensi', function($query){
                return $query->whereYear('tanggal_mulai', Carbon::now()->format('Y'));
            })->get()->count();

            $sakit = DataPresensi::where('user_id', Auth::user()->id)->where('status', 'Sakit')
            ->whereHas('presensi', function($query){
                return $query->whereYear('tanggal_mulai', Carbon::now()->format('Y'));
            })->get()->count();
            
            $izin = DataPresensi::where('user_id', Auth::user()->id)->where('status', 'Izin')
            ->whereHas('presensi', function($query){
                return $query->whereYear('tanggal_mulai', Carbon::now()->format('Y'));
            })->get()->count();
            
            $countTidakHadir = DataPresensi::where('user_id', Auth::user()->id)->where('status', 'Tidak Hadir')
            ->whereHas('presensi', function($query){
                return $query->whereYear('tanggal_mulai', Carbon::now()->format('Y'));
            })
            ->get()->count();
            
            $countDataTidakHadir = Presensi::select('presensi.*')
            ->leftJoin('registrasi_kelas', 'registrasi_kelas.kelas_id', '=', 'presensi.kelas_id')
            ->where('registrasi_kelas.user_id', Auth::user()->id)
            ->get()->count();

            $tidakHadir = ($countDataTidakHadir+$countTidakHadir) - ($hadir+$sakit+$izin);

            $presensi = Presensi::whereHas('kelas', function($query) use ($tahun){
                return $query->whereYear('tanggal_mulai', Carbon::now()->format('Y'))
                ->whereHas('registrasiKelas', function($query) use ($tahun){
                    return $query->where('user_id', Auth::user()->id);
                });
            })
            ->orderBy('id', 'desc')->limit(3)->get();
            
            $tugas = Tugas::whereHas('kelas', function($query) use ($tahun){
                return $query->whereYear('tanggal_mulai', Carbon::now()->format('Y'))
                ->whereHas('registrasiKelas', function($query) use ($tahun){
                    return $query->where('user_id', Auth::user()->id);
                });
            })
            ->orderBy('id', 'desc')->limit(3)->get();
            
            $quiz = Quiz::whereHas('kelas', function($query) use ($tahun){
                return $query->whereYear('tanggal_mulai', Carbon::now()->format('Y'))
                ->whereHas('registrasiKelas', function($query) use ($tahun){
                    return $query->where('user_id', Auth::user()->id);
                });
            })
            ->orderBy('id', 'desc')->limit(3)->get();
            
            $materi = Materi::whereHas('kelas', function($query) use ($tahun){
                return $query->whereYear('tanggal_mulai', Carbon::now()->format('Y'))
                ->whereHas('registrasiKelas', function($query) use ($tahun){
                    return $query->where('user_id', Auth::user()->id);
                });
            })
            ->orderBy('id', 'desc')->limit(3)->get();
        }

        $kelasku = Kelas::where('tutor_id', Auth::user()->id)->orderBy('id', 'desc')->limit(3)->get();

        return view('admin_dashboard.peserta.dashboard', [
            'hadir' => $hadir,
            'tidakHadir' => $tidakHadir,
            'sakit' => $sakit,
            'izin' => $izin,

            'pilihTahun' => $pilihTahun,
            'cariKelas' => $cariKelas, 
            'kelas' => $kelas, 
            'namaKelas' => $namaKelas, 
            'kelasku' => $kelasku, 
            
            'presensi' => $presensi, 
            'tugas' => $tugas, 
            'quiz' => $quiz,
            'materi' => $materi,
        ]);

        // $kelasku = RegistrasiKelas::with('kelas')->where('user_id', Auth::user()->id)->where('status', 'Diterima')->orderBy('id', 'desc')->limit(3)->get();
        // $eventku = RegistrasiEvent::with('event')->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->limit(3)->get();
        // return view('admin_dashboard.peserta.dashboard', ['kelasku' => $kelasku, 'eventku' => $eventku]);
    }
}
