<x-admin-layout title="Gestión de Doctores" :breadcrumb="[
    ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
    ['name' => 'Doctores'],
]">

    <div class="p-6 overflow-hidden bg-white shadow-xl sm:rounded-lg">
        @livewire('admin.doctor-table')
    </div>

</x-admin-layout>
