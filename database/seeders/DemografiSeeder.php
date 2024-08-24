<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DemografiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = [
            "Pengalaman menggunakan Artificial Intelligence (AI)" => [
                "answer" => [
                    "Sudah",
                    "Belum"
                ],
                "form_type" => "radio",
            ],

            "Lama Penggunaan Teknologi Kecerdasan Buatan" => [
                "answer" => [
                    "Kurang dari 1 tahun",
                    "1-2 tahun",
                    "Diatas 2 tahun"
                ],
                "form_type" => "radio",
            ],

            "Intensitas Penggunaan Teknologi Kecerdasan Buatan" => [
                "answer" => [
                    "1x sehari",
                    "1-3x seminggu",
                    "1x seminggu",
                    "1-3x sebulan",
                    "1x sebulan",
                ],
                "form_type" => "radio",
            ],

            "Kendala Penggunaan Teknologi Kecerdasan Buatan" => [
                "answer" => [
                    "Tidak Ada Kendala",
                    "AI itu Berbayar",
                    "Keterbatasan Sinyal",
                    "Informasi AI tidak valid",
                    "AI tidak aman",
                    "Tidak paham penggunaan AI",
                ],
                "form_type" => "radio",
            ],

            "Teknologi AI yang sering digunakan" => [
                "answer" => [
                    "Humata",
                    "Chatgpt",
                    "Poeai",
                    "Slide AI",
                    "Grammarly",
                    "ClaudeAI",
                    "Bing AI",
                    "Character AI",
                    "chatPDF",
                    "Sider AI",
                    "PDF.AI",
                    "Quillbot AI",
                    "Paperpal",
                    "Paragraph AI",
                    "Typing mind",
                    "Power drill.AI"
                ],
                "form_type" => "checkbox",
            ]
        ];

        foreach ($questions as $key => $question) {
            DB::table('demografi')->insert([
                'question' => $key,
                'slug_question' => \Str::slug($key),
                'answer' => json_encode($question["answer"]),
                'is_positive' => true,
                'form_type' => $question['form_type'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
