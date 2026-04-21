<?php

namespace App\Livewire\Admin;

use App\Models\Cita;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Specialty;
use Livewire\Component;

class CreateCita extends Component
{
    // Search filters
    public $date;
    public $time;
    public $specialty_id;

    // Collections
    public $specialties;
    public $patients;
    public $availableDoctors = [];

    // Form fields
    public $selectedDoctorId;
    public $selectedDoctor;
    public $selectedTime;
    public $patientId;
    public $reason;

    public function mount()
    {
        $this->specialties = Specialty::all();
        $this->patients = Patient::all();
        $this->date = now()->format('Y-m-d');
    }

    public function searchAvailability()
    {
        // This will be implemented later. For now, we'll use dummy data.
        $this->availableDoctors = Doctor::with('user', 'specialty')->inRandomOrder()->take(2)->get();
    }

    public function selectSlot($doctorId, $time)
    {
        $this->selectedDoctorId = $doctorId;
        $this->selectedDoctor = Doctor::with('user')->find($doctorId);
        $this->selectedTime = $time;
    }

    public function store()
    {
        $this->validate([
            'date' => 'required|date',
            'selectedTime' => 'required',
            'selectedDoctorId' => 'required|exists:doctors,id',
            'patientId' => 'required|exists:patients,id',
        ]);

        Cita::create([
            'date' => $this->date,
            'time' => $this->selectedTime,
            'doctor_id' => $this->selectedDoctorId,
            'patient_id' => $this->patientId,
            'specialty_id' => $this->selectedDoctor->specialty_id,
            'reason' => $this->reason,
        ]);

        session()->flash('success', 'Cita creada exitosamente.');
        return redirect()->route('admin.citas.index');
    }

    public function render()
    {
        return view('livewire.admin.create-cita');
    }
}
