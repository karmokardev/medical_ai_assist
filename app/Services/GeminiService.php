<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\Medicine;

class GeminiService
{
    protected string $apiKey;
    protected string $apiUrl;

    public function __construct()
    {
        $this->apiKey = config('services.gemini.key');
        $this->apiUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent';
    }

    public function chat(string $userMessage): array
    {
        $systemPrompt = "তুমি একজন বাংলাদেশী healthcare assistant। User এর symptoms শুনে বাংলায় উত্তর দেবে।

তোমার response এর শেষে অবশ্যই নিচের format এ medicine লিখবে:
MEDICINES: [generic_name_1], [generic_name_2], [generic_name_3]

যেমন গলা ব্যথার জন্য হলে লিখবে:
MEDICINES: Paracetamol, Cetirizine, Ambroxol

উত্তরের format:
**সম্ভাব্য সমস্যা:** এখানে লেখো
**করণীয়:** এখানে লেখো  
**কোন ডাক্তার:** এখানে লেখো
**সতর্কতা:** এটি professional advice নয়, ডাক্তার দেখান।
MEDICINES: এখানে comma দিয়ে generic medicine name লেখো (English এ)";

        $response = Http::timeout(30)->post("{$this->apiUrl}?key={$this->apiKey}", [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $systemPrompt . "\n\nUser এর সমস্যা: " . $userMessage]
                    ]
                ]
            ]
        ]);

        $text = $response->json('candidates.0.content.parts.0.text') ?? 'দুঃখিত, এখন উত্তর দেওয়া সম্ভব হচ্ছে না।';

        $medicines = $this->extractMedicines($text);
        $cleanText = preg_replace('/MEDICINES:.*$/m', '', $text);

        return [
            'message' => trim($cleanText),
            'medicines' => $medicines,
        ];
    }

    private function extractMedicines(string $text): array
    {
        preg_match('/MEDICINES:\s*(.+)$/m', $text, $matches);

        if (empty($matches[1])) return [];

        $names = array_map('trim', explode(',', $matches[1]));
        $found = [];

        foreach ($names as $name) {
            if (empty($name)) continue;
            $medicine = Medicine::where('generic_name', 'like', '%' . $name . '%')
                ->orWhere('name', 'like', '%' . $name . '%')
                ->first();

            if ($medicine) {
                $found[] = $medicine->toArray();
            }
        }

        return $found;
    }
}
