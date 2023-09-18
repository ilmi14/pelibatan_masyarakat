<?php

namespace App\Exports;

use App\Models\RegistrasiEvent;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PesertaEventExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $event_id;

    function __construct($event_id) {
            $this->event_id = $event_id;
    }

    public function collection()
    {
        return RegistrasiEvent::where('event_id', $this->event_id)->get();
    }

    public function map($row): array
    {
        $hari_ini = Carbon::now();
        $tanggal_lahir = Carbon::parse($row->user->tanggal_lahir);
        $umur = $tanggal_lahir->diffInYears($hari_ini);

        return [
            Carbon::parse($row->created_at)->format('j F Y H:i'),
            $row->user->nama,
            $umur,
            $row->user->tipe_anggota,
            $row->user->nomor_telepon,
            $row->user->alamat. ', ' .ucwords(strtolower(\Indonesia::findVillage($row->user->desa_kelurahan)->name)). ', ' .ucwords(strtolower(\Indonesia::findDistrict($row->user->kecamatan)->name)). ', ' .ucwords(strtolower(\Indonesia::findCity($row->user->kabupaten_kota)->name)). ', ' .ucwords(strtolower(\Indonesia::findProvince($row->user->provinsi)->name)),
        ];
    }

    public function headings(): array
    {
        return [
            'Tanggal Mendaftar',
            'Nama',
            'Umur',
            'Tipe Anggota',
            'Nomor Telepon',
            'Alamat',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]],
        ];
    }
}
