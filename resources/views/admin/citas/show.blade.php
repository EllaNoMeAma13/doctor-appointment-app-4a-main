<x-admin-layout title="Detalles de la Cita">
    <div class="max-w-7xl mx-auto p-6 font-sans">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Detalles de la Cita</h1>

        <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <p class="text-sm text-gray-500">Paciente</p>
                    <p class="text-lg font-semibold">{{ $cita->patient->full_name }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Doctor</p>
                    <p class="text-lg font-semibold">{{ $cita->doctor->full_name }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Especialidad</p>
                    <p class="text-lg font-semibold">{{ $cita->specialty->name }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Fecha y Hora</p>
                    <p class="text-lg font-semibold">{{ $cita->date }} {{ $cita->time }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Estado</p>
                    <p class="text-lg font-semibold">{{ $cita->status }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Motivo</p>
                    <p class="text-lg font-semibold">{{ $cita->reason ?? 'No especificado' }}</p>
                </div>
            </div>
            <div class="mt-6">
                <a href="{{ route('admin.citas.index') }}" class="px-4 py-2 mr-2 font-bold text-gray-700 bg-gray-200 rounded hover:bg-gray-300">
                    Volver
                </a>
            </div>
        </div>
    </div>
</x-admin-layout>
