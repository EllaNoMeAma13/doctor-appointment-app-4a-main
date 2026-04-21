<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use App\Models\User;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        return view('doctors.index');
    }

    /**
     * Show the form for editing the specified resource.
     * The parameter is a User model that has the 'Doctor' role.
     */
    public function edit(User $doctor)
    {
        $doctor->load('doctor'); // Eager load the doctor relationship
        $specialities = Specialty::all();
        return view('doctors.edit', [
            'user' => $doctor,
            'specialities' => $specialities,
        ]);
    }

    /**
     * Update the specified resource in storage.
     * The parameter is the User model, not the Doctor model.
     */
    public function update(Request $request, User $doctor)
    {
        $validated = $request->validate([
            'specialty_id' => 'required|exists:specialties,id',
            'medical_license_number' => 'required|string|max:255',
            'biography' => 'required|string',
        ]);

        // Use updateOrCreate to handle both new and existing doctor records
        $doctor->doctor()->updateOrCreate(
            ['user_id' => $doctor->id], // Condition to find the record
            $validated // Data to update or create
        );

        session()->flash('flash.banner', '¡La información del doctor ha sido actualizada exitosamente!');
        session()->flash('flash.bannerStyle', 'success');

        return redirect()->route('doctors.index');
    }
}
