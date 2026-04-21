<x-admin-layout title="Editar Rol" :breadcrumb="[
    ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
    ['name' => 'Roles', 'url' => route('admin.roles.index')],
    ['name' => 'Editar'],
]">

    <div class="p-6 overflow-hidden bg-white shadow-xl sm:rounded-lg">
        <form action="{{ route('admin.roles.update', $role) }}" method="POST" id="edit-role-form">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nombre del Rol</label>
                <input type="text" name="name" id="name" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('name', $role->name) }}">
                @error('name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <a href="{{ route('admin.roles.index') }}" class="px-4 py-2 mr-2 font-bold text-gray-700 bg-gray-200 rounded hover:bg-gray-300">
                    Cancelar
                </a>
                <button type="submit" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                    Actualizar
                </button>
            </div>
        </form>
    </div>

    @push('js')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const form = document.getElementById('edit-role-form');
                const initialName = document.getElementById('name').value;

                form.addEventListener('submit', function (event) {
                    const currentName = document.getElementById('name').value;

                    if (currentName === initialName) {
                        event.preventDefault(); // Detiene el envío del formulario
                        Swal.fire({
                            icon: 'info',
                            title: 'No se realizaron cambios',
                            text: 'No has modificado el nombre del rol.',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });
        </script>
    @endpush

</x-admin-layout>
