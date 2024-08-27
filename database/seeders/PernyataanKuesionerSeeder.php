<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PernyataanKuesionerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                "variable_id" => 1,
                "indikator" => "Easiness",
                "kode_indikator" => "OPT1",
                "isi_kuesioner" => "Teknologi Artificial Intelligence (AI) akan membuat pekerjaan saya lebih mudah.",
                'is_positive' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                "variable_id" => 1,
                "indikator" => "Connectivity",
                "kode_indikator" => "OPT2",
                "isi_kuesioner" => "Teknologi Artificial Intelligence (AI) dapat membantu saya terhubung dengan berbagai pencarian tugas kuliah.",
                'is_positive' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                "variable_id" => 1,
                "indikator" => "Efficiency",
                "kode_indikator" => "OPT3",
                "isi_kuesioner" => "Teknologi Artificial Intelligence (AI) akan membantu saya menyelesaikan tugas-tugas lebih efisien.",
                'is_positive' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                "variable_id" => 1,
                "indikator" => "Effectiveness",
                "kode_indikator" => "OPT4",
                "isi_kuesioner" => "Saya yakin dengan menggunakan teknologi Artificial Intelligence (AI) membuat pekerjaan saya lebih efektif.",
                'is_positive' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                "variable_id" => 1,
                "indikator" => "Productivity",
                "kode_indikator" => "OPT5",
                "isi_kuesioner" => "Teknologi Artificial Intelligence (AI) akan meningkatkan produktivitas saya dalam menyelesaikan tugas-tugas kuliah.",
                'is_positive' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                "variable_id" => 2,
                "indikator" => "Solve Problem",
                "kode_indikator" => "INV1",
                "isi_kuesioner" => "Teknologi Artificial Intelligence (AI) membantu saya menyelesaikan pekerjaan saya.",
                'is_positive' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                "variable_id" => 2,
                "indikator" => "Independency",
                "kode_indikator" => "INV2",
                "isi_kuesioner" => "Saya merasa percaya diri dalam mengadopsi dan menggunakan teknologi Artificial Intelligence (AI).",
                'is_positive' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                "variable_id" => 2,
                "indikator" => "Challenges",
                "kode_indikator" => "INV3",
                "isi_kuesioner" => "Saya tertarik untuk mencoba aplikasi atau alat berbasis Teknologi Artificial Intelligence (AI).",
                'is_positive' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                "variable_id" => 2,
                "indikator" => "Stimulation",
                "kode_indikator" => "INV4",
                "isi_kuesioner" => "Saya terdorong untuk selalu mengikuti perkembangan terbaru dalam teknologi Artificial Intelligence (AI).",
                'is_positive' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                "variable_id" => 2,
                "indikator" => "Strength of Competition",
                "kode_indikator" => "INV5",
                "isi_kuesioner" => "Saya adalah salah satu orang yang pertama di kelas yang mengadopsi teknologi Artificial Intelligence (AI).",
                'is_positive' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                "variable_id" => 3,
                "indikator" => "Complication",
                "kode_indikator" => "DCS1",
                "isi_kuesioner" => "Saya cemas ketika harus menggunakan teknologi Artificial Intelligence (AI) untuk menyelesaikan tugas-tugas saya.",
                'is_positive' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                "variable_id" => 3,
                "indikator" => "Difficulty",
                "kode_indikator" => "DCS2",
                "isi_kuesioner" => "Menurut saya cara penggunaan Teknologi Artificial Intelligence (AI) akan sulit dipahami.",
                'is_positive' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                "variable_id" => 3,
                "indikator" => "Dependence",
                "kode_indikator" => "DCS3",
                "isi_kuesioner" => "Saya merasa bahwa terlalu banyak mengandalkan Teknologi Artificial Intelligence (AI) dapat menghambat kemampuan saya untuk belajar hal-hal baru secara mandiri.",
                'is_positive' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                "variable_id" => 3,
                "indikator" => "Lack of Support",
                "kode_indikator" => "DCS4",
                "isi_kuesioner" => "Saya merasa ragu untuk mengadopsi Teknologi Artificial Intelligence (AI) karena tidak adanya dukungan yang memadai dari institusi.",
                'is_positive' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                "variable_id" => 3,
                "indikator" => "Incompatibility",
                "kode_indikator" => "DCS5",
                "isi_kuesioner" => "Saya tidak akan bisa cepat menyesuaikan diri dengan perkembangan teknologi Artificial Intelligence.",
                'is_positive' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                "variable_id" => 4,
                "indikator" => "Failure",
                "kode_indikator" => "INS1",
                "isi_kuesioner" => "Saya merasa khawatir tentang kemungkinan kegagalan teknis dari teknologi Artificial Intelligence (AI)",
                'is_positive' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                "variable_id" => 4,
                "indikator" => "Threat Reducing",
                "kode_indikator" => "INS2",
                "isi_kuesioner" => "Saya takut ada yang akan memanfaatkan data saya melalui Artificial Intelligence (AI).",
                'is_positive' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                "variable_id" => 4,
                "indikator" => "Interaction",
                "kode_indikator" => "INS3",
                "isi_kuesioner" => "Saya tidak nyaman berinteraksi dengan teknologi Artificial Intelligence (AI) dalam menyelesaikan tugas atau proyek.",
                'is_positive' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                "variable_id" => 4,
                "indikator" => "Distraction",
                "kode_indikator" => "INS4",
                "isi_kuesioner" => "Saya khawatir penggunaan Artificial Intelligence (AI) akan membuat saya tidak fokus terhadap kuliah saya.",
                'is_positive' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                "variable_id" => 4,
                "indikator" => "Incredulity",
                "kode_indikator" => "INS5",
                "isi_kuesioner" => "Saya tidak yakin kemampuan teknologi Artificial Intelligence (AI) akan memberikan hasil atau solusi yang tepat.",
                'is_positive' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('pernyataan_kuesioner')->insert($data);
    }
}
