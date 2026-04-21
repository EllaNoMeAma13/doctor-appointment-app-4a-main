<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;

class DoctorTable extends DataTableComponent
{
    protected $model = User::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setTableAttributes([
            'class' => 'w-full text-sm text-left text-gray-500',
        ]);
    }

    public function builder(): Builder
    {
        return User::query()
            ->whereHas('roles', fn($query) => $query->where('name', 'Doctor'))
            ->with(['doctor.specialty']);
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Nombre", "name")
                ->sortable()
                ->searchable(),
            Column::make("Email", "email")
                ->sortable()
                ->searchable(),
            Column::make("Especialidad", "doctor.specialty.name")
                ->sortable()
                ->format(fn($value) => $value ?? 'N/A'),
            Column::make("Cédula Profesional", "doctor.medical_license_number")
                ->sortable()
                ->searchable()
                ->format(fn($value) => $value ?? 'N/A'),
            Column::make("Acciones", "id")
                ->format(fn($value, $row, Column $column) => view('admin.doctors.actions', ['user' => $row]))
                ->html(),
        ];
    }
}
