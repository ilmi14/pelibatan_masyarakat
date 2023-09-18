<?php

namespace App\Exports;

use App\Models\PresensiEvent;
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

class PresensiEventExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $event_id;
    protected $presensi_id;

    function __construct($event_id, $presensi_id) {
            $this->event_id = $event_id;
            $this->presensi_id = $presensi_id;
    }

    public function collection()
    {
        return User::select('users.*', 'data_presensi_event.id AS presensi_event_id', 'data_presensi_event.created_at AS waktu_mengisi', 'data_presensi_event.status AS presensi_event_status', 'data_presensi_event.gambar AS gambar')
            ->orderBy('users.nama', 'asc')
            ->rightJoin('registrasi_event', 'users.id', '=', 'registrasi_event.user_id')
            ->leftJoin('data_presensi_event', 'data_presensi_event.user_id', '=', DB::raw('users.id AND data_presensi_event.presensi_event_id = ' . $this->presensi_id))
            ->where('users.level', 'peserta')->get();
    }

    public function map($row): array
    {
        $presensi = PresensiEvent::where('event_id', $this->event_id)->findOrFail($this->presensi_id);

        if($row->presensi_event_id != null && $row->presensi_event_status != "Tidak Hadir"){
            $waktu_mengisi = Carbon::parse($row->waktu_mengisi)->format('j F Y H:i');
        } else{
            $waktu_mengisi = '-';
        }
        
        if($row->presensi_event_status != null){
            $status = $row->presensi_event_status;
        } elseif(Carbon::now() > $presensi->tanggal_berakhir && $row->presensi_event_status == null){
            $status = "Tidak Hadir";
        } else{
            $status = "Belum Mengisi";
        }

        return [
            $row->nama,
            $row->tipe_anggota,
            $waktu_mengisi,
            $status,
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
