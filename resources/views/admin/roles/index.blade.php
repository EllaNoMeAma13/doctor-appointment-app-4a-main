<x-admin-layout title="Gestión de Roles" :breadcrumb="[
    ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
    ['name' => 'Roles'],
]">

    <x-slot name="action">
        <a href="{{ route('admin.roles.create') }}"
            class="flex items-center px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            Nuevo
        </a>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white shadow-xl sm:rounded-lg">
        @livewire('admin.role-table')
    </div>

    @push('js')
        <script>
            const protectedRoles = [1, 2, 3, 4];

            function handleEdit(roleId, url) {
                if (protectedRoles.includes(roleId)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Acción no permitida',
                        text: 'No puedes editar este rol.'
                    });
                } else {
                    window.location.href = url;
                }
            }

            function handleDelete(roleId) {
                if (protectedRoles.includes(roleId)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Acción no permitida',
                        text: 'No puedes eliminar este rol.'
                    });
                } else {
                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: "¡No podrás revertir esto!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sí, ¡eliminar!',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('delete-form-' + roleId).submit();
                        }
                    })
                }
            }

            @if (session()->has('swal'))
                Swal.fire({
                    icon: '{{ session('swal')['icon'] }}',
                    title: '{{ session('swal')['title'] }}',
                    text: '{{ session('swal')['text'] }}',
                });
            @endif
        </script>
    @endpush
</x-admin-layout>
