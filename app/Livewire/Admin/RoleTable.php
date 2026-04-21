<?php

namespace App\Livewire\Admin;

use App\Models\Role;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class RoleTable extends DataTableComponent
{
    protected $model = Role::class;

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
            Column::make("Rol", "name")
                ->sortable(),
            Column::make('Acciones')
                ->label(
                    fn ($row, Column $column) => view('admin.roles.actions')->with('role', $row)
                ),
        ];
    }
}
