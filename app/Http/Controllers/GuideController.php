<?php

namespace App\Http\Controllers;

use App\Models\Diagnosis;
use App\Models\Intervention;
use Illuminate\Http\Request;

class GuideController extends Controller
{
    public function index()
    {
        $diagnoses = Diagnosis::all();
        $interventions = Intervention::all();
        return view('guide.index', compact('diagnoses', 'interventions'));
    }
}
