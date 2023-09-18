<?php

use App\Http\Controllers\admin_dashboard\admin\BeritaController;
use App\Http\Controllers\admin_dashboard\auth\LoginController;
use App\Http\Controllers\admin_dashboard\admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\admin_dashboard\admin\data_event\DeskripsiController;
use App\Http\Controllers\admin_dashboard\admin\data_event\DokumentasiController;
use App\Http\Controllers\admin_dashboard\admin\data_event\PesertaController;
use App\Http\Controllers\admin_dashboard\admin\data_event\PresensiController as Data_eventPresensiController;
use App\Http\Controllers\admin_dashboard\admin\data_event\SertifikatController as Data_eventSertifikatController;
use App\Http\Controllers\admin_dashboard\admin\data_kelas\DataPesertaController;
use App\Http\Controllers\admin_dashboard\admin\data_kelas\HomeController;
use App\Http\Controllers\admin_dashboard\admin\data_kelas\MateriController;
use App\Http\Controllers\admin_dashboard\admin\data_kelas\PresensiController;
use App\Http\Controllers\admin_dashboard\admin\data_kelas\TugasController;
use App\Http\Controllers\admin_dashboard\admin\DataKelasController;
use App\Http\Controllers\admin_dashboard\admin\KelasController;
use App\Http\Controllers\admin_dashboard\admin\data_kelas\ForumController;
use App\Http\Controllers\admin_dashboard\admin\data_kelas\QuizController;
use App\Http\Controllers\admin_dashboard\admin\data_kelas\QuizJawabanController;
use App\Http\Controllers\admin_dashboard\admin\data_kelas\QuizSoalController;
use App\Http\Controllers\admin_dashboard\admin\data_kelas\SertifikatController;
use App\Http\Controllers\admin_dashboard\admin\data_kelas\SilabusController as Data_kelasSilabusController;
use App\Http\Controllers\admin_dashboard\admin\data_kelas\TestimoniController;
use App\Http\Controllers\admin_dashboard\admin\DataEventController;
use App\Http\Controllers\admin_dashboard\admin\EventController;
use App\Http\Controllers\admin_dashboard\admin\FaqController;
use App\Http\Controllers\admin_dashboard\admin\GaleriController;
use App\Http\Controllers\admin_dashboard\admin\KategoriBeritaController;
use App\Http\Controllers\admin_dashboard\admin\TutorController;
use App\Http\Controllers\admin_dashboard\auth\RegistrasiController;
use App\Http\Controllers\admin_dashboard\auth\ResetPasswordController;
use App\Http\Controllers\admin_dashboard\tutor\DashboardController as TutorDashboardController;
use App\Http\Controllers\admin_dashboard\peserta\DashboardController as PesertaDashboardController;
use App\Http\Controllers\admin_dashboard\peserta\EventController as PesertaEventController;
use App\Http\Controllers\admin_dashboard\peserta\eventku\DeskripsiController as PesertaEventkuDeskripsiController;
use App\Http\Controllers\admin_dashboard\peserta\eventku\DokumentasiController as PesertaEventkuDokumentasiController;
use App\Http\Controllers\admin_dashboard\peserta\eventku\PresensiController as PesertaEventkuPresensiController;
use App\Http\Controllers\admin_dashboard\peserta\eventku\SertifikatController as PesertaEventkuSertifikatController;
use App\Http\Controllers\admin_dashboard\peserta\EventkuController as PesertaEventkuController;
use App\Http\Controllers\admin_dashboard\peserta\KelasController as PesertaKelasController;
use App\Http\Controllers\admin_dashboard\peserta\kelasku\ForumController as PesertaKelaskuForumController;
use App\Http\Controllers\admin_dashboard\peserta\kelasku\HomeController as PesertaKelaskuHomeController;
use App\Http\Controllers\admin_dashboard\peserta\kelasku\JawabanTugasController as PesertaKelaskuJawabanTugasController;
use App\Http\Controllers\admin_dashboard\peserta\kelasku\MateriController as PesertaKelaskuMateriController;
use App\Http\Controllers\admin_dashboard\peserta\kelasku\PesertaController as PesertaKelaskuPesertaController;
use App\Http\Controllers\admin_dashboard\peserta\kelasku\PresensiController as PesertaKelaskuPresensiController;
use App\Http\Controllers\admin_dashboard\peserta\kelasku\QuizController as PesertaKelaskuQuizController;
use App\Http\Controllers\admin_dashboard\peserta\kelasku\SertifikatController as PesertaKelaskuSertifikatController;
use App\Http\Controllers\admin_dashboard\peserta\kelasku\SilabusController as PesertaKelaskuSilabusController;
use App\Http\Controllers\admin_dashboard\peserta\kelasku\TestimoniController as PesertaKelaskuTestimoniController;
use App\Http\Controllers\admin_dashboard\peserta\kelasku\TugasController as PesertaKelaskuTugasController;
use App\Http\Controllers\admin_dashboard\peserta\KelaskuController as PesertaKelaskuController;
use App\Http\Controllers\admin_dashboard\tutor\kelasku\ForumController as TutorKelaskuForumController;
use App\Http\Controllers\admin_dashboard\tutor\kelasku\HomeController as TutorKelaskuHomeController;
use App\Http\Controllers\admin_dashboard\tutor\kelasku\MateriController as TutorKelaskuMateriController;
use App\Http\Controllers\admin_dashboard\tutor\kelasku\PesertaController as TutorKelaskuPesertaController;
use App\Http\Controllers\admin_dashboard\tutor\kelasku\PresensiController as TutorKelaskuPresensiController;
use App\Http\Controllers\admin_dashboard\tutor\kelasku\QuizController as TutorKelaskuQuizController;
use App\Http\Controllers\admin_dashboard\tutor\kelasku\QuizJawabanController as TutorQuizJawabanController;
use App\Http\Controllers\admin_dashboard\tutor\kelasku\QuizSoalController as TutorQuizSoalController;
use App\Http\Controllers\admin_dashboard\tutor\kelasku\SilabusController as TutorKelaskuSilabusController;
use App\Http\Controllers\admin_dashboard\tutor\kelasku\SilabusDetailController as TutorKelaskuSilabusDetailController;
use App\Http\Controllers\admin_dashboard\tutor\kelasku\TestimoniController as TutorKelaskuTestimoniController;
use App\Http\Controllers\admin_dashboard\tutor\kelasku\TugasController as TutorKelaskuTugasController;
use App\Http\Controllers\admin_dashboard\tutor\KelaskuController as TutorKelaskuController;
use App\Http\Controllers\DaerahController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\PengaturanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [LandingPageController::class, 'index']);
Route::get('/faq', [LandingPageController::class, 'faq']);
Route::get('/berita', [LandingPageController::class, 'berita']);
Route::get('/berita/{slug}', [LandingPageController::class, 'beritaShow']);

Route::middleware(['cekLogin'])->group(function(){
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'postLogin'])->name('postlogin');
    Route::get('/lupa-password', [ResetPasswordController::class, 'lupaPassword']);
    Route::post('/lupa-password', [ResetPasswordController::class, 'postLupaPassword'])->name('password.reset');
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'resetPassword'])->name('password.edit');
    Route::post('/reset-password', [ResetPasswordController::class, 'postResetPassword'])->name('password.update');
    Route::get('/registrasi', [RegistrasiController::class, 'registrasi'])->name('registrasi');
    Route::post('/registrasi', [RegistrasiController::class, 'postRegistrasi'])->name('postRegistrasi');
});
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('provinces', [DaerahController::class, 'provinces'])->name('provinces');
Route::get('cities', [DaerahController::class, 'cities'])->name('cities');
Route::get('districts', [DaerahController::class, 'districts'])->name('districts');
Route::get('villages', [DaerahController::class, 'villages'])->name('villages');

Route::prefix('admin')->middleware(['auth', 'ceklevel:admin'])->group(function(){
    Route::get('/dashboard', [AdminDashboardController::class, 'index']);
    Route::post('/dashboard/grafik', [AdminDashboardController::class, 'grafik']);
    Route::get('/profil', [PengaturanController::class, 'profil']);
    Route::get('/akun', [PengaturanController::class, 'akun']);
    // Kelas Pelibatan Masyuarakat
    Route::resource('tutor', TutorController::class);
    Route::put('/kelas', [KelasController::class, 'status'])->name('kelas.update.status');
    Route::resource('kelas', KelasController::class);
    Route::resource('data-kelas', DataKelasController::class);
    Route::resource('data-kelas.home', HomeController::class);
    // Route::put('/data-kelas/{data_kela}/silabus/pilih-silabus', [SilabusKelasController::class, 'pilihSilabus'])->name('data-kelas.silabus.pilih-silabus');
    Route::get('/data-kelas/{data_kela}/silabus/download', [Data_kelasSilabusController::class, 'download'])->name('data-kelas.silabus.download');
    Route::resource('data-kelas.silabus', Data_kelasSilabusController::class);
    Route::get('/data-kelas/{data_kela}/peserta/export', [DataPesertaController::class, 'export']);
    Route::get('/data-kelas/{data_kela}/peserta/export-diterima', [DataPesertaController::class, 'exportDiterima']);
    Route::resource('data-kelas.peserta', DataPesertaController::class);
    Route::middleware(['statusKelasAdmin:Kegiatan Berlangsung,Selesai'])->group(function(){
        Route::post('/data-kelas/{data_kela}/forum/{post_id}/comment', [ForumController::class, 'commentStore'])->name('data-kelas.forum.comment.store');
        Route::put('/data-kelas/{data_kela}/forum/{post_id}/comment/{id}', [ForumController::class, 'commentUpdate'])->name('data-kelas.forum.comment.update');
        Route::delete('/data-kelas/{data_kela}/forum/{post_id}/comment/{id}', [ForumController::class, 'commentDestroy'])->name('data-kelas.forum.comment.destroy');
        Route::resource('data-kelas.forum', ForumController::class);
        Route::resource('data-kelas.materi', MateriController::class);
        Route::get('/data-kelas/{data_kela}/tugas/{tugas}/periksa-tugas/{id}', [TugasController::class, 'periksaTugas'])->name('data-kelas.tugas.periksa-tugas.show');
        Route::resource('data-kelas.tugas', TugasController::class);
        Route::get('/data-kelas/{data_kela}/presensi/{presensi}/export', [PresensiController::class, 'export']);
        Route::resource('data-kelas.presensi', PresensiController::class);
        Route::resource('data-kelas.quiz', QuizController::class);
        Route::resource('data-kelas.quiz.soal', QuizSoalController::class);
        Route::resource('data-kelas.quiz.jawaban', QuizJawabanController::class);
        Route::resource('data-kelas.testimoni', TestimoniController::class);
        Route::resource('data-kelas.sertifikat', SertifikatController::class);
    });
    // Berita Area
    Route::resource('kategori-berita', KategoriBeritaController::class);
    Route::resource('berita', BeritaController::class);
    Route::resource('galeri', GaleriController::class);
    Route::resource('faq', FaqController::class);
    // Event
    Route::resource('event', EventController::class);
    Route::resource('data-event', DataEventController::class);
    Route::resource('data-event.deskripsi', DeskripsiController::class);
    Route::get('/data-event/{data_event}/peserta/export', [PesertaController::class, 'export']);
    Route::resource('data-event.peserta', PesertaController::class)->only('index');
    Route::get('/data-event/{data_event}/presensi/{presensi}/export', [Data_eventPresensiController::class, 'export']);
    Route::resource('data-event.presensi', Data_eventPresensiController::class);
    Route::resource('data-event.dokumentasi', DokumentasiController::class);
    Route::resource('data-event.sertifikat', Data_eventSertifikatController::class);
    // Silabus
    // Route::resource('silabus', SilabusController::class);
    // Route::get('/silabus/{silabu}/download', [SilabusController::class, 'download'])->name('silabus.download');
});

Route::prefix('tutor')->name('tutor.')->middleware(['auth', 'ceklevel:tutor'])->group(function(){
    Route::get('/dashboard', [TutorDashboardController::class, 'index']);
    Route::get('/profil', [PengaturanController::class, 'profil']);
    Route::get('/akun', [PengaturanController::class, 'akun']);
    Route::resource('kelasku', TutorKelaskuController::class)->only(['index']);
    Route::resource('kelasku.home', TutorKelaskuHomeController::class);
    // Route::put('/kelasku/{kelasku}/silabus/pilih-silabus', [TutorSilabusKelasController::class, 'pilihSilabus'])->name('kelasku.silabus.pilih-silabus');
    Route::get('/kelasku/{data_kela}/silabus/download', [TutorKelaskuSilabusController::class, 'download'])->name('kelasku.silabus.download');
    Route::resource('kelasku.silabus', TutorKelaskuSilabusController::class);
    Route::resource('kelasku.silabus.detail', TutorKelaskuSilabusDetailController::class);
    Route::resource('kelasku.peserta', TutorKelaskuPesertaController::class);
    Route::middleware(['statusKelas:Kegiatan Berlangsung,Selesai'])->group(function(){
        Route::post('/kelasku/{kelasku}/forum/{post_id}/comment', [TutorKelaskuForumController::class, 'commentStore'])->name('kelasku.forum.comment.store');
        Route::put('/kelasku/{kelasku}/forum/{post_id}/comment/{id}', [TutorKelaskuForumController::class, 'commentUpdate'])->name('kelasku.forum.comment.update');
        Route::delete('/kelasku/{kelasku}/forum/{post_id}/comment/{id}', [TutorKelaskuForumController::class, 'commentDestroy'])->name('kelasku.forum.comment.destroy');
        Route::resource('kelasku.forum', TutorKelaskuForumController::class);
        Route::resource('kelasku.materi', TutorKelaskuMateriController::class);
        Route::get('/kelasku/{kelasku}/tugas/{tugas}/periksa-tugas/{id}', [TutorKelaskuTugasController::class, 'periksaTugas'])->name('kelasku.tugas.periksa-tugas.show');
        Route::put('/kelasku/{kelasku}/tugas/{tugas}/periksa-tugas/{id}', [TutorKelaskuTugasController::class, 'periksaTugasStore'])->name('kelasku.tugas.periksa-tugas.update');
        Route::resource('kelasku.tugas', TutorKelaskuTugasController::class);
        Route::resource('kelasku.presensi', TutorKelaskuPresensiController::class);
        Route::get('/kelasku/{kelasku}/quiz/{tugas_id}/aktif', [TutorKelaskuQuizController::class, 'aktif'])->name('kelasku.quiz.aktif');
        Route::resource('kelasku.quiz', TutorKelaskuQuizController::class);
        Route::get('/kelasku/{kelasku}/quiz/{quiz_id}/soal/{soal_id}/aktif', [TutorQuizSoalController::class, 'aktif'])->name('kelasku.quiz.soal.aktif');
        Route::put('/kelasku/{kelasku}/quiz/{quiz_id}/soal', [TutorQuizSoalController::class, 'status'])->name('kelasku.quiz.soal.update.status');
        Route::resource('kelasku.quiz.soal', TutorQuizSoalController::class);
        Route::resource('kelasku.quiz.jawaban', TutorQuizJawabanController::class);
        Route::resource('kelasku.testimoni', TutorKelaskuTestimoniController::class);
    });
    // silabus
    // Route::resource('silabus', TutorSilabusController::class);
    // Route::middleware(['cekPemilikSilabus'])->group(function(){
    //     Route::resource('silabus.bab', TutorSilabusBabController::class);
    //     Route::resource('silabus.bab.subbab', TutorSilabusSubBabController::class);
    // });
});

Route::prefix('peserta')->name('peserta.')->middleware(['auth', 'ceklevel:peserta'])->group(function(){
    Route::get('/dashboard', [PesertaDashboardController::class, 'index']);
    Route::get('/profil', [PengaturanController::class, 'profil']);
    Route::get('/akun', [PengaturanController::class, 'akun']);
    // Kelas Pelibatan Masyarakat
    Route::post('kelas/{id}', [PesertaKelasController::class, 'daftar'])->name('kelas.daftar');
    Route::resource('kelas', PesertaKelasController::class);
    Route::resource('kelasku', PesertaKelaskuController::class)->only(['index']);
    Route::middleware(['cekUserRegistrasi'])->group(function(){
        Route::resource('kelasku.home', PesertaKelaskuHomeController::class);
        Route::resource('kelasku.silabus', PesertaKelaskuSilabusController::class);
    });
    Route::middleware(['cekRegistrasi', 'statusKelas:Kegiatan Berlangsung,Selesai'])->group(function(){
        // Forum
        Route::post('/kelasku/{kelasku}/forum/{post_id}/comment', [PesertaKelaskuForumController::class, 'commentStore'])->name('kelasku.forum.comment.store');
        Route::put('/kelasku/{kelasku}/forum/{post_id}/comment/{id}', [PesertaKelaskuForumController::class, 'commentUpdate'])->name('kelasku.forum.comment.update');
        Route::delete('/kelasku/{kelasku}/forum/{post_id}/comment/{id}', [PesertaKelaskuForumController::class, 'commentDestroy'])->name('kelasku.forum.comment.destroy');
        // Kirim Tugas
        Route::post('/kelasku/{kelasku}/kirim-tugas/{tugas_id}', [PesertaKelaskuJawabanTugasController::class, 'store'])->name('tugas.jawaban.store');
        // Jawaban Quiz
        Route::get('/kelasku/{kelasku}/quiz/{quiz_id}/jawaban', [PesertaKelaskuQuizController::class, 'hasil'])->name('quiz.jawaban.show');
        Route::post('/kelasku/{kelasku}/quiz/{quiz_id}/jawaban', [PesertaKelaskuQuizController::class, 'jawaban'])->name('quiz.jawaban.store');
        
        // Route::resource('kelasku.peserta', PesertaKelaskuPesertaController::class);
        Route::resource('kelasku.forum', PesertaKelaskuForumController::class);
        Route::resource('kelasku.materi', PesertaKelaskuMateriController::class);
        Route::resource('kelasku.tugas', PesertaKelaskuTugasController::class);
        Route::resource('kelasku.presensi', PesertaKelaskuPresensiController::class);
        Route::resource('kelasku.quiz', PesertaKelaskuQuizController::class);
        Route::resource('kelasku.testimoni', PesertaKelaskuTestimoniController::class);
        Route::get('/kelasku/{kelasku}/sertifikat', [PesertaKelaskuSertifikatController::class, 'index']);
        Route::get('/kelasku/{kelasku}/sertifikat/show', [PesertaKelaskuSertifikatController::class, 'show'])->name('kelasku.sertifikat.download');
    });
    // Event
    Route::post('event/{id}', [PesertaEventController::class, 'daftar'])->name('event.daftar');
    Route::resource('event', PesertaEventController::class);
    Route::resource('eventku', PesertaEventkuController::class)->only(['index']);
    Route::middleware(['cekRegistrasiEvent'])->group(function(){
        Route::resource('eventku.deskripsi', PesertaEventkuDeskripsiController::class);
        Route::resource('eventku.dokumentasi', PesertaEventkuDokumentasiController::class);
        Route::resource('eventku.presensi', PesertaEventkuPresensiController::class);
        Route::get('/eventku/{eventku}/sertifikat', [PesertaEventkuSertifikatController::class, 'index']);
        Route::get('/eventku/{eventku}/sertifikat/show', [PesertaEventkuSertifikatController::class, 'show'])->name('eventku.sertifikat.download');
    });
});

Route::middleware(['auth', 'ceklevel:admin,tutor,peserta'])->group(function(){
    Route::get('/kelasku/{kelas}/materi/download/{id}', [DownloadController::class, 'materi'])->name("materi.download");
    Route::get('/kelasku/{kelas}/tugas/download/{id}', [DownloadController::class, 'tugas'])->name("tugas.download");
    Route::get('/kelasku/{kelas}/jawaban-tugas/download/{id}', [DownloadController::class, 'jawabanTugas'])->name("jawaban.tugas.download");
    Route::get('/eventku/{kelas}/dokumentasi/download/{id}', [DownloadController::class, 'dokumentasi'])->name("dokumentasi.download");
    Route::put('/profil', [PengaturanController::class, 'update_profil'])->name('profil.update');
    Route::put('/akun', [PengaturanController::class, 'update_akun'])->name('akun.update');
});
