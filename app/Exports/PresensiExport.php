<?php

namespace App\Exports;

use App\Models\Presensi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PresensiExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $kelas_id;
    protected $presensi_id;

    function __construct($kelas_id, $presensi_id) {
            $this->kelas_id = $kelas_id;
            $this->presensi_id = $presensi_id;
    }

    public function collection()
    {
        return User::select('users.*', 'data_presensi.id AS presensi_id', 'data_presensi.created_at AS waktu_mengisi', 'data_presensi.status AS presensi_status', 'data_presensi.gambar AS gambar')
            ->orderBy('users.nama', 'asc')
            ->rightJoin('registrasi_kelas', 'users.id', '=', 'registrasi_kelas.user_id')
            ->leftJoin('data_presensi', 'data_presensi.user_id', '=', DB::raw('users.id AND data_presensi.presensi_id = ' . $this->presensi_id))
            ->where('users.level', 'peserta')->get();
    }

    public function map($row): array
    {
        $presensi = Presensi::where('kelas_id', $this->kelas_id)->findOrFail($this->presensi_id);

        if($row->presensi_id != null && $row->presensi_status != "Tidak Hadir"){
            $waktu_mengisi = Carbon::parse($row->waktu_mengisi)->format('j F Y H:i');
        } else{
            $waktu_mengisi = '-';
        }
        
        if($row->presensi_status != null){
            $status = $row->presensi_status;
        } elseif(Carbon::now() > $presensi->tanggal_berakhir && $row->presensi_status == null){
            $status = "Tidak Hadir";
        } else{
            $status = "Belum Mengisi";
        }

        return [
            $row->nama,
            $row->tipe_anggota,
            $waktu_mengisi,
            $status,
            // Carbon::parse($row->waktu_mengisi)->format('j F Y H:i'),
            // $row->presensi_status,
        ];
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Tipe Anggota',
            'Waktu Mengisi',
            'Status',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]],
        ];
    }
}
