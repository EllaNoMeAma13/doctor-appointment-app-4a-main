<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BloodType;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PatientController extends Controller
{
    public function index()
    {
        return view('admin.patients.index');
    }

    public function create()
    {
        // Redirigir a la creación de usuarios o mostrar un mensaje indicando que se debe crear desde usuarios
        // O si se desea mantener la creación desde aquí, se debe mantener el formulario completo.
        // Pero el usuario pidió quitar el botón de nuevo, así que probablemente no se use este método directamente desde la UI de pacientes.
        // Sin embargo, para mantener la consistencia si se llegara a usar:
        $bloodTypes = BloodType::all();
        return view('admin.patients.create', compact('bloodTypes'));
    }

    public function store(Request $request)
    {
        // Validación y creación completa si se usa
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'id_number' => 'required|string|max:20|unique:users',
            'phone' => 'required|string|max:20',
            'blood_type_id' => 'nullable|exists:blood_types,id',
            'allergies' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|string|max:20',
            'chronic_conditions' => 'nullable|string',
            'family_history' => 'nullable|string',
            'observations' => 'nullable|string',
            'emergency_contact_relationship' => 'nullable|string|max:255',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_number' => $request->id_number,
            'phone' => $request->phone,
        ]);

        $user->assignRole('paciente');

        Patient::create([
            'user_id' => $user->id,
            'blood_type_id' => $request->blood_type_id,
            'allergies' => $request->allergies,
            'address' => $request->address,
            'emergency_contact_name' => $request->emergency_contact_name,
            'emergency_contact_phone' => $request->emergency_contact_phone,
            'chronic_conditions' => $request->chronic_conditions,
            'family_history' => $request->family_history,
            'observations' => $request->observations,
            'emergency_contact_relationship' => $request->emergency_contact_relationship,
        ]);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Paciente creado',
            'text' => 'El paciente ha sido creado exitosamente.'
        ]);

        return redirect()->route('admin.patients.index');
    }

    public function show(Patient $patient)
    {
        return view('admin.patients.show', compact('patient'));
    }

    public function edit(Patient $patient)
    {
        $bloodTypes = BloodType::all();
        return view('admin.patients.edit', compact('patient', 'bloodTypes'));
    }

    public function update(Request $request, Patient $patient)
    {
        // Solo validamos y actualizamos los campos específicos de pacientes
        $request->validate([
            'blood_type_id' => 'nullable|exists:blood_types,id',
            'allergies' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|string|max:20',
            'chronic_conditions' => 'nullable|string',
            'family_history' => 'nullable|string',
            'observations' => 'nullable|string',
            'emergency_contact_relationship' => 'nullable|string|max:255',
        ]);

        // No actualizamos datos del usuario (name, email, etc.) aquí

        $patient->update([
            'blood_type_id' => $request->blood_type_id,
            'allergies' => $request->allergies,
            'address' => $request->address,
            'emergency_contact_name' => $request->emergency_contact_name,
            'emergency_contact_phone' => $request->emergency_contact_phone,
            'chronic_conditions' => $request->chronic_conditions,
            'family_history' => $request->family_history,
            'observations' => $request->observations,
            'emergency_contact_relationship' => $request->emergency_contact_relationship,
        ]);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Paciente actualizado',
            'text' => 'La información médica del paciente ha sido actualizada.'
        ]);

        return redirect()->route('admin.patients.index');
    }

    public function destroy(Patient $patient)
    {
        // Si se elimina desde aquí, eliminamos el usuario completo
        $patient->user->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Paciente eliminado',
            'text' => 'El paciente ha sido eliminado exitosamente.'
        ]);

        return redirect()->route('admin.patients.index');
    }
}
