<?php

namespace App\Exports;

use App\Models\RegistrasiKelas;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PesertaExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $kelas_id;

    function __construct($kelas_id) {
            $this->kelas_id = $kelas_id;
    }

    public function collection()
    {
        return RegistrasiKelas::where('kelas_id', $this->kelas_id)->get();
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
            ucwords(strtolower(\Indonesia::findCity($row->user->tempat_lahir)->name)),
            Carbon::parse($row->user->tanggal_lahir)->format('j F Y'),
            $row->user->jenis_kelamin,
            $row->user->tipe_anggota,
            $row->user->nomor_telepon,
            $row->user->alamat. ', ' .ucwords(strtolower(\Indonesia::findVillage($row->user->desa_kelurahan)->name)). ', ' .ucwords(strtolower(\Indonesia::findDistrict($row->user->kecamatan)->name)). ', ' .ucwords(strtolower(\Indonesia::findCity($row->user->kabupaten_kota)->name)). ', ' .ucwords(strtolower(\Indonesia::findProvince($row->user->provinsi)->name)),
            $row->motivasi,
            $row->status,
        ];
    }

    public function headings(): array
    {
        return [
            'Tanggal Mendaftar',
            'Nama',
            'Umur',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Jenis Kelamin',
            'Tipe Anggota',
            'Nomor Telepon',
            'Alamat',
            'Motivasi',
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
