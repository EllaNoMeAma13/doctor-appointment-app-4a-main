<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Specialty;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    public function index()
    {
        return view('admin.citas.index');
    }

    public function create()
    {
        return view('admin.citas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'specialty_id' => 'required|exists:specialties,id',
            'date' => 'required|date',
            'time' => 'required',
        ]);

        Cita::create($request->all());

        return redirect()->route('admin.citas.index')->with('success', 'Cita creada exitosamente.');
    }

    public function show(Cita $cita)
    {
        return view('admin.citas.show', compact('cita'));
    }

    public function edit(Cita $cita)
    {
        $patients = Patient::all();
        $doctors = Doctor::all();
        $specialties = Specialty::all();
        return view('admin.citas.edit', compact('cita', 'patients', 'doctors', 'specialties'));
    }

    public function update(Request $request, Cita $cita)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'specialty_id' => 'required|exists:specialties,id',
            'date' => 'required|date',
            'time' => 'required',
        ]);

        $cita->update($request->all());

        return redirect()->route('admin.citas.index')->with('success', 'Cita actualizada exitosamente.');
    }

    public function destroy(Cita $cita)
    {
        $cita->delete();
        return redirect()->route('admin.citas.index')->with('success', 'Cita eliminada exitosamente.');
    }

    public function createConsultation(Cita $cita)
    {
        return view('admin.citas.consultation-create', compact('cita'));
    }

    public function storeConsultation(Request $request, Cita $cita)
    {
        $request->validate([
            'diagnosis' => 'required',
            'treatment' => 'required',
        ]);

        $cita->consultation()->create($request->all());

        return redirect()->route('admin.citas.index')->with('success', 'Datos de la consulta guardados exitosamente.');
    }

    public function showConsultation(Cita $cita)
    {
        $consultation = $cita->consultation;
        return view('admin.citas.consultation-show', compact('consultation'));
    }
}
