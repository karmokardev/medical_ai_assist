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
        $this->apiUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent';
    }

    public function chat(string $userMessage): array
    {
        $systemPrompt = "
            তুমি একজন বাংলাদেশী healthcare assistant।
            User যখন symptoms বলবে, তুমি:
            1. সম্ভাব্য সমস্যা বলবে
            2. কোন ধরনের ডাক্তার দেখাতে হবে বলবে
            3. সাধারণ medicine suggest করবে (শুধু generic name দিয়ে)
            4. সবসময় বাংলায় উত্তর দেবে
            5. সবশেষে disclaimer দেবে

            IMPORTANT: Response এর শেষে এই format এ medicine list দেবে:
            MEDICINES: medicine1, medicine2, medicine3

            মনে রাখবে তুমি doctor না, শুধু সাধারণ পরামর্শ দিতে পারবে।
        ";

        $response = Http::post("{$this->apiUrl}?key={$this->apiKey}", [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $systemPrompt . "\n\nUser: " . $userMessage]
                    ]
                ]
            ]
        ]);

        $text = $response->json('candidates.0.content.parts.0.text') ?? 'দুঃখিত, এখন উত্তর দেওয়া সম্ভব হচ্ছে না।';

        // Medicine extract করো
        $medicines = $this->extractMedicines($text);

        // MEDICINES: line টা response থেকে সরাও
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
            $medicine = Medicine::where('generic_name', 'like', '%' . $name . '%')
                ->orWhere('name', 'like', '%' . $name . '%')
                ->first();

            if ($medicine) {
                $found[] = $medicine;
            }
        }

        return $found;
    }
}