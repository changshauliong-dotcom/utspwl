<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $dataMahasiswa = [
            ['nim' => '23100013', 'nama' => 'RYAN FEBRIANTO'],
            ['nim' => '23110001', 'nama' => 'KELIO XENELLY'],
            ['nim' => '23110002', 'nama' => 'ALVIN VALENTINO'],
            ['nim' => '23110006', 'nama' => 'DHAVID BHERTUS'],
            ['nim' => '23110007', 'nama' => 'ALDO RIVALDI'],
            ['nim' => '23110009', 'nama' => 'FELIX FILBERT'],
            ['nim' => '23110010', 'nama' => 'VITA'],
            ['nim' => '23110011', 'nama' => 'CELLO FIBRYAN GIRL'],
            ['nim' => '23110015', 'nama' => 'WENDI'],
            ['nim' => '23110017', 'nama' => 'BRYAN HENRILSEN'],
            ['nim' => '23110018', 'nama' => 'FERNANDO JOCEVINE'],
            ['nim' => '23110021', 'nama' => 'STEVEN EDMUND PRATAMA'],
            ['nim' => '23110022', 'nama' => 'JACKY FERNANDO'],
            ['nim' => '23110023', 'nama' => 'STENLY KURNIAWAN'],
            ['nim' => '23110027', 'nama' => 'RONNEY PANGNATHAN'],
        ];

        foreach ($dataMahasiswa as $mhs) {
            Mahasiswa::updateOrCreate(
                ['nim' => $mhs['nim']],
                ['nama' => $mhs['nama']]
            );
        }
    }
}