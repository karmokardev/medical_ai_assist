<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MedicineCSVSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('medicines')->truncate();

        $file = database_path('seeders/medexMedicine.csv');
        
        // পুরো file একসাথে read করো
        $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        
        // Header skip
        array_shift($lines);

        $batch = [];
        $count = 0;
        $now = now();

        foreach ($lines as $line) {
            $row = str_getcsv($line);
            
            if (empty($row[0]) && empty($row[1])) continue;
            if (count($row) < 3) continue;

            $price = isset($row[4]) ? (float) preg_replace('/[^0-9.]/', '', $row[4]) : null;

            $batch[] = [
                'generic_name'  => isset($row[0]) ? mb_substr(trim($row[0]), 0, 255) : null,
                'name'          => isset($row[1]) ? mb_substr(trim($row[1]), 0, 255) : 'Unknown',
                'manufacturer'  => isset($row[2]) ? mb_substr(trim($row[2]), 0, 255) : null,
                'strength'      => isset($row[3]) ? mb_substr(trim($row[3]), 0, 255) : null,
                'price'         => $price,
                'category'      => null,
                'description'   => null,
                'created_at'    => $now,
                'updated_at'    => $now,
            ];

            if (count($batch) >= 500) {
                DB::table('medicines')->insertOrIgnore($batch);
                $count += count($batch);
                $batch = [];
                echo "Imported: {$count}\n";
            }
        }

        if (!empty($batch)) {
            DB::table('medicines')->insertOrIgnore($batch);
            $count += count($batch);
        }

        echo "Total imported: {$count}\n";
    }
}
