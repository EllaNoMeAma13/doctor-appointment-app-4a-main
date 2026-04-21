<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class UserTable extends DataTableComponent
{
    protected $model = User::class;

    public function builder(): Builder
    {
        return User::query()->with('roles');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setTableAttributes([
            'class' => 'min-w-full divide-y divide-gray-200',
        ]);
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable()
                ->searchable(),
            Column::make("Nombre", "name")
                ->sortable()
                ->searchable(),
            Column::make("Email", "email")
                ->sortable()
                ->searchable(),
            Column::make("Número de ID", "id_number")
                ->sortable()
                ->searchable(),
            Column::make("Teléfono", "phone")
                ->sortable()
                ->searchable(),
            Column::make('Rol', 'id')
                ->label(
                    fn ($row, Column $column) => $row->roles->pluck('name')->implode(', ')
                ),
            Column::make('Acciones')
                ->label(
                    fn ($row, Column $column) => view('admin.users.actions')->with('user', $row)
                ),
        ];
    }
}
