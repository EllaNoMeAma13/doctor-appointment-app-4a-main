<?php

namespace App\Livewire\Doctors;

use App\Models\Doctor;
use App\Models\Specialty;
use App\Models\User;
use Livewire\Component;
use Illuminate\View\View;
use WireUi\Traits\Actions;

class EditDoctor extends Component
{
    use Actions;

    public User $user;
    public Doctor $doctor;

    public $specialties;

    // Form fields
    public $specialty_id;
    public $medical_license_number;
    public $biography;

    protected $rules = [
        'specialty_id' => 'required|exists:specialties,id',
        'medical_license_number' => 'nullable|string|max:255',
        'biography' => 'nullable|string',
    ];

    public function mount(User $user)
    {
        $this->user = $user;
        $this->doctor = $this->user->doctor()->firstOrNew([]);
        $this->specialties = Specialty::all();

        // Populate form fields from the existing or new doctor model
        $this->specialty_id = $this->doctor->specialty_id;
        $this->medical_license_number = $this->doctor->medical_license_number;
        $this->biography = $this->doctor->biography;
    }

    public function render(): View
    {
        return view('livewire.doctors.edit-doctor')
            ->layout('layouts.admin', [
                'title' => 'Editar Información del Doctor',
                'breadcrumb' => [
                    ['name' => 'Doctores', 'url' => route('doctors.index')],
                    ['name' => $this->user->name]
                ]
            ]);
    }

    public function save()
    {
        $validatedData = $this->validate();

        $this->user->doctor()->updateOrCreate(
            ['user_id' => $this->user->id],
            $validatedData
        );

        $this->notification()->success(
            'Información Actualizada',
            'Los datos del doctor han sido guardados correctamente.'
        );
    }

    protected function validationAttributes(): array
    {
        return [
            'specialty_id' => 'especialidad',
            'medical_license_number' => 'cédula profesional',
            'biography' => 'biografía',
        ];
    }
}
