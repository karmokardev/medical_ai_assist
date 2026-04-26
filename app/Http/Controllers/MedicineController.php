<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    public function index(Request $request)
    {
        $query = Medicine::query();

        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('generic_name', 'like', '%' . $request->search . '%')
                  ->orWhere('manufacturer', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->category) {
            $query->where('generic_name', 'like', '%' . $request->category . '%');
        }

        if ($request->manufacturer) {
            $query->where('manufacturer', 'like', '%' . $request->manufacturer . '%');
        }

        if ($request->price_max) {
            $query->where('price', '<=', $request->price_max);
        }

        if ($request->price_min) {
            $query->where('price', '>=', $request->price_min);
        }

        $medicines = $query->paginate(12);

        $manufacturers = Medicine::whereNotNull('manufacturer')
            ->distinct()
            ->orderBy('manufacturer')
            ->pluck('manufacturer')
            ->take(50);

        $categories = [
            '💊 Antibiotic' => 'Antibiotic',
            '🤒 Painkiller' => 'Paracetamol',
            '🫁 Cough & Cold' => 'Ambroxol',
            '🔥 Gastric' => 'Omeprazole',
            '🤧 Allergy' => 'Cetirizine',
            '💉 Diabetes' => 'Metformin',
            '❤️ Blood Pressure' => 'Amlodipine',
            '🦠 Antifungal' => 'Fluconazole',
            '😴 Sleep' => 'Clonazepam',
            '🧴 Skin' => 'Clotrimazole',
            '👁️ Eye' => 'Ciprofloxacin',
            '🦷 Dental' => 'Amoxicillin',
        ];

        return view('medicines.index', compact('medicines', 'categories', 'manufacturers'));
    }

    public function show(Medicine $medicine)
    {
        $related = Medicine::where('generic_name', $medicine->generic_name)
            ->where('id', '!=', $medicine->id)
            ->take(4)
            ->get();

        return view('medicines.show', compact('medicine', 'related'));
    }
    public function search(Request $request)
{
    $medicines = Medicine::where('name', 'like', '%' . $request->q . '%')
        ->orWhere('generic_name', 'like', '%' . $request->q . '%')
        ->select('id', 'name', 'generic_name', 'price', 'manufacturer')
        ->limit(8)
        ->get();

    return response()->json($medicines);
}
}