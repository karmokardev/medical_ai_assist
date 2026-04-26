<?php

namespace Database\Seeders;

use App\Models\Medicine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $medicines = [
            // Painkiller / Fever
            ['name' => 'Napa', 'generic_name' => 'Paracetamol', 'manufacturer' => 'Beximco', 'category' => 'Painkiller', 'price' => 1.00, 'strength' => '500mg', 'description' => 'জ্বর ও ব্যথার জন্য'],
            ['name' => 'Ace', 'generic_name' => 'Paracetamol', 'manufacturer' => 'Square', 'category' => 'Painkiller', 'price' => 1.00, 'strength' => '500mg', 'description' => 'জ্বর ও ব্যথার জন্য'],
            ['name' => 'Napa Extra', 'generic_name' => 'Paracetamol + Caffeine', 'manufacturer' => 'Beximco', 'category' => 'Painkiller', 'price' => 2.00, 'strength' => '500mg+65mg', 'description' => 'মাথাব্যথা ও জ্বরের জন্য'],
            ['name' => 'Ibuprofen', 'generic_name' => 'Ibuprofen', 'manufacturer' => 'Square', 'category' => 'Painkiller', 'price' => 5.00, 'strength' => '400mg', 'description' => 'ব্যথা ও প্রদাহের জন্য'],

            // Antibiotic
            ['name' => 'Azith', 'generic_name' => 'Azithromycin', 'manufacturer' => 'Square', 'category' => 'Antibiotic', 'price' => 60.00, 'strength' => '500mg', 'description' => 'ব্যাকটেরিয়াল ইনফেকশনের জন্য'],
            ['name' => 'Azimax', 'generic_name' => 'Azithromycin', 'manufacturer' => 'Beximco', 'category' => 'Antibiotic', 'price' => 55.00, 'strength' => '500mg', 'description' => 'ব্যাকটেরিয়াল ইনফেকশনের জন্য'],
            ['name' => 'Ciprofloxacin', 'generic_name' => 'Ciprofloxacin', 'manufacturer' => 'Opsonin', 'category' => 'Antibiotic', 'price' => 15.00, 'strength' => '500mg', 'description' => 'ইউরিনারি ও অন্যান্য ইনফেকশনের জন্য'],
            ['name' => 'Amoxicillin', 'generic_name' => 'Amoxicillin', 'manufacturer' => 'ACI', 'category' => 'Antibiotic', 'price' => 10.00, 'strength' => '500mg', 'description' => 'শ্বাসতন্ত্র ও কানের ইনফেকশনের জন্য'],

            // Gastric / Antacid
            ['name' => 'Seclo', 'generic_name' => 'Omeprazole', 'manufacturer' => 'Square', 'category' => 'Gastric', 'price' => 5.00, 'strength' => '20mg', 'description' => 'গ্যাস্ট্রিক ও বুকজ্বালার জন্য'],
            ['name' => 'Losectil', 'generic_name' => 'Omeprazole', 'manufacturer' => 'Beximco', 'category' => 'Gastric', 'price' => 5.00, 'strength' => '20mg', 'description' => 'গ্যাস্ট্রিক আলসারের জন্য'],
            ['name' => 'Pantop', 'generic_name' => 'Pantoprazole', 'manufacturer' => 'Square', 'category' => 'Gastric', 'price' => 8.00, 'strength' => '40mg', 'description' => 'গ্যাস্ট্রিক ও অ্যাসিডিটির জন্য'],
            ['name' => 'Antacid', 'generic_name' => 'Aluminium Hydroxide', 'manufacturer' => 'Beximco', 'category' => 'Gastric', 'price' => 3.00, 'strength' => '200mg', 'description' => 'তাৎক্ষণিক গ্যাস্ট্রিক উপশমের জন্য'],

            // Allergy
            ['name' => 'Fexo', 'generic_name' => 'Fexofenadine', 'manufacturer' => 'Square', 'category' => 'Allergy', 'price' => 8.00, 'strength' => '120mg', 'description' => 'অ্যালার্জির জন্য'],
            ['name' => 'Atarax', 'generic_name' => 'Hydroxyzine', 'manufacturer' => 'UCB', 'category' => 'Allergy', 'price' => 5.00, 'strength' => '10mg', 'description' => 'চুলকানি ও অ্যালার্জির জন্য'],
            ['name' => 'Cetirizine', 'generic_name' => 'Cetirizine', 'manufacturer' => 'Beximco', 'category' => 'Allergy', 'price' => 3.00, 'strength' => '10mg', 'description' => 'সর্দি ও অ্যালার্জির জন্য'],

            // Diabetes
            ['name' => 'Metformin', 'generic_name' => 'Metformin', 'manufacturer' => 'ACI', 'category' => 'Diabetes', 'price' => 4.00, 'strength' => '500mg', 'description' => 'টাইপ ২ ডায়াবেটিসের জন্য'],
            ['name' => 'Glucomet', 'generic_name' => 'Metformin', 'manufacturer' => 'Square', 'category' => 'Diabetes', 'price' => 4.00, 'strength' => '500mg', 'description' => 'রক্তের সুগার নিয়ন্ত্রণের জন্য'],

            // Vitamin
            ['name' => 'Vitamin C', 'generic_name' => 'Ascorbic Acid', 'manufacturer' => 'Square', 'category' => 'Vitamin', 'price' => 2.00, 'strength' => '500mg', 'description' => 'রোগ প্রতিরোধ ক্ষমতা বাড়ানোর জন্য'],
            ['name' => 'Neurobion', 'generic_name' => 'Vitamin B Complex', 'manufacturer' => 'Merck', 'category' => 'Vitamin', 'price' => 10.00, 'strength' => 'B1+B6+B12', 'description' => 'স্নায়ুর সমস্যায়'],
            ['name' => 'Calcium D', 'generic_name' => 'Calcium + Vitamin D', 'manufacturer' => 'Square', 'category' => 'Vitamin', 'price' => 8.00, 'strength' => '500mg', 'description' => 'হাড় মজবুত করার জন্য'],

            // Cold / Cough
            ['name' => 'Tusca', 'generic_name' => 'Dextromethorphan', 'manufacturer' => 'Beximco', 'category' => 'Cough', 'price' => 40.00, 'strength' => '15mg/5ml', 'description' => 'কাশির জন্য'],
            ['name' => 'Adovas', 'generic_name' => 'Ambroxol', 'manufacturer' => 'ACI', 'category' => 'Cough', 'price' => 35.00, 'strength' => '30mg', 'description' => 'কফ ও কাশির জন্য'],

            // Pressure
            ['name' => 'Amlodipine', 'generic_name' => 'Amlodipine', 'manufacturer' => 'Square', 'category' => 'Blood Pressure', 'price' => 6.00, 'strength' => '5mg', 'description' => 'উচ্চ রক্তচাপের জন্য'],
            ['name' => 'Losartan', 'generic_name' => 'Losartan', 'manufacturer' => 'Beximco', 'category' => 'Blood Pressure', 'price' => 8.00, 'strength' => '50mg', 'description' => 'উচ্চ রক্তচাপের জন্য'],
        ];

        foreach ($medicines as $medicine) {
            Medicine::create($medicine);
        }
    }
}
