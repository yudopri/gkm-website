<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use App\Models\TahunAjaranSemester;

class GenerateTahunAjaran extends Command
{
    protected $signature = 'generate:tahun-ajaran';
    protected $description = 'Generate data tahun ajaran dan semester jika belum ada';

    public function handle()
    {
        $tahunSekarang = now()->year;
        $tahunDepan = $tahunSekarang + 1;
        $formatTahun = "$tahunSekarang/$tahunDepan";

        $semesters = ['ganjil', 'genap'];

        foreach ($semesters as $semester) {
            $slug = Str::slug("{$tahunSekarang}-{$tahunDepan} {$semester}");

            $sudahAda = TahunAjaranSemester::where('tahun_ajaran', $formatTahun)
                ->where('semester', $semester)
                ->exists();

            if (!$sudahAda) {
                TahunAjaranSemester::create([
                    'tahun_ajaran' => $formatTahun,
                    'semester' => $semester,
                    'slug' => $slug,
                ]);

                $this->info("Ditambahkan: $formatTahun $semester");
            } else {
                $this->info("Sudah ada: $formatTahun $semester");
            }
        }
    }
}
