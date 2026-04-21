<x-admin-layout title="Detalles de la Consulta">
    <div class="max-w-7xl mx-auto p-6 font-sans">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Detalles de la Consulta</h1>

        <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
            @if($consultation)
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <p class="text-sm text-gray-500">Diagnóstico</p>
                        <p class="text-lg font-semibold">{{ $consultation->diagnosis }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Tratamiento</p>
                        <p class="text-lg font-semibold">{{ $consultation->treatment }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Notas Adicionales</p>
                        <p class="text-lg font-semibold">{{ $consultation->notes ?? 'No hay notas adicionales.' }}</p>
                    </div>
                </div>
            @else
                <p class="text-lg font-semibold text-gray-500">No hay datos de consulta para esta cita.</p>
            @endif
            <div class="mt-6">
                <a href="{{ route('admin.citas.index') }}" class="px-4 py-2 mr-2 font-bold text-gray-700 bg-gray-200 rounded hover:bg-gray-300">
                    Volver
                </a>
            </div>
        </div>
    </div>
</x-admin-layout>
