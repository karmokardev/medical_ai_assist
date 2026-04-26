<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicine;

class MedicineController extends Controller
{
    public function index(Request $request)
    {
        $query = Medicine::query();

        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('generic_name', 'like', '%' . $request->search . '%');
        }

        if ($request->category) {
            $query->where('category', $request->category);
        }

        $medicines = $query->paginate(12);
        $categories = Medicine::distinct()->pluck('category');

        return view('medicines.index', compact('medicines', 'categories'));
    }

    public function show(Medicine $medicine)
    {
        return view('medicines.show', compact('medicine'));
    }
}
