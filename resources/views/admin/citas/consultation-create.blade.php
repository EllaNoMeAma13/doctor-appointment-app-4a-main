<x-admin-layout title="Añadir Datos de Consulta">
    @php
        // Simulación del catálogo. ESTO DEBERÍA VENIR DE TU CONTROLADOR
        // Ejemplo en el Controller: $catalogoMedicamentos = Medicamento::orderBy('nombre')->get();
        $catalogoMedicamentos = [
            (object)['id' => 1, 'nombre' => 'Amoxicilina 500mg'],
            (object)['id' => 2, 'nombre' => 'Paracetamol 500mg'],
            (object)['id' => 3, 'nombre' => 'Ibuprofeno 400mg'],
            (object)['id' => 4, 'nombre' => 'Omeprazol 20mg'],
            (object)['id' => 5, 'nombre' => 'Loratadina 10mg'],
        ];
    @endphp

    <div class="max-w-5xl mx-auto p-6 font-sans bg-gray-50/50 min-h-screen">

        <div class="text-sm font-bold text-gray-800 mb-2">
            Consulta
        </div>

        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-end mb-6 gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">{{ $cita->patient->full_name }}</h1>
                <p class="text-sm text-gray-500 mt-1">DNI: <span class="font-medium">{{ $cita->patient->user->id_number }}</span></p>
            </div>

            <div class="flex items-center gap-3">
                <button class="flex items-center gap-2 bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium py-2 px-4 rounded-md text-sm transition-colors shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Ver Historia
                </button>

                <button class="flex items-center gap-2 bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium py-2 px-4 rounded-md text-sm transition-colors shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Consultas Anteriores
                </button>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-lg shadow-sm"
             {{-- Inicializamos Alpine.js aquí. Definimos la pestaña activa y un array vacío con una fila por defecto para los medicamentos --}}
             x-data="{
                tab: 'consulta',
                medicamentos: [{ medicamento_id: '', dosis: '', frecuencia: '' }]
             }">

            <div class="flex items-center border-b border-gray-100 px-6 pt-4">
                <button type="button" @click="tab = 'consulta'"
                        :class="tab === 'consulta' ? 'text-indigo-600 border-b-2 border-indigo-600' : 'text-gray-500 hover:text-gray-700'"
                        class="flex items-center gap-2 font-semibold pb-3 px-2 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Consulta
                </button>

                <button type="button" @click="tab = 'receta'"
                        :class="tab === 'receta' ? 'text-indigo-600 border-b-2 border-indigo-600' : 'text-gray-500 hover:text-gray-700'"
                        class="flex items-center gap-2 font-semibold pb-3 px-6 transition-colors ml-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                    </svg>
                    Receta
                </button>
            </div>

            <form action="{{ route('admin.citas.consultation.store', $cita) }}" method="POST" class="p-6">
                @csrf

                <div x-show="tab === 'consulta'" class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Diagnóstico</label>
                        <textarea name="diagnosis" rows="4" placeholder="Describa el diagnóstico del paciente aquí..."
                                  class="w-full border border-gray-300 rounded-md px-4 py-3 text-sm text-gray-700 placeholder-gray-400 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 resize-y"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tratamiento</label>
                        <textarea name="treatment" rows="4" placeholder="Describa el tratamiento recomendado aquí..."
                                  class="w-full border border-gray-300 rounded-md px-4 py-3 text-sm text-gray-700 placeholder-gray-400 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 resize-y"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Notas</label>
                        <textarea name="notes" rows="3" placeholder="Agregue notas adicionales sobre la consulta..."
                                  class="w-full border border-gray-300 rounded-md px-4 py-3 text-sm text-gray-700 placeholder-gray-400 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 resize-y"></textarea>
                    </div>
                </div>

                {{-- style="display: none" previene que parpadee el diseño antes de que cargue Alpine.js --}}
                <div x-show="tab === 'receta'" style="display: none;" class="mb-6">

                    <div class="bg-gray-50/50 border border-gray-100 rounded-lg p-4 mb-4 space-y-4">
                        <template x-for="(med, index) in medicamentos" :key="index">
                            <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-start relative pb-4 border-b border-gray-200 last:border-0 last:pb-0">

                                <div class="md:col-span-5">
                                    <label class="block text-xs font-medium text-gray-500 mb-1.5">Medicamento</label>
                                    {{-- El 'name' envía un array a Laravel: recetas[0][medicamento_id], recetas[1]... --}}
                                    <select :name="`recetas[${index}][medicamento_id]`" x-model="med.medicamento_id" required
                                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm text-gray-700 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 bg-white">
                                        <option value="" disabled>Seleccione un medicamento...</option>
                                        @foreach($catalogoMedicamentos as $medicamento)
                                            <option value="{{ $medicamento->id }}">{{ $medicamento->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="md:col-span-2">
                                    <label class="block text-xs font-medium text-gray-500 mb-1.5">Dosis</label>
                                    <input type="text" :name="`recetas[${index}][dosis]`" x-model="med.dosis" placeholder="Ej: 1 tab" required
                                           class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm text-gray-700 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 bg-white">
                                </div>

                                <div class="md:col-span-4">
                                    <label class="block text-xs font-medium text-gray-500 mb-1.5">Frecuencia / Duración</label>
                                    <input type="text" :name="`recetas[${index}][frecuencia]`" x-model="med.frecuencia" placeholder="Ej: cada 8 horas por 7 días" required
                                           class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm text-gray-700 placeholder-gray-400 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 bg-white">
                                </div>

                                <div class="md:col-span-1 flex justify-end md:justify-center pt-6">
                                    {{-- Solo muestra el botón de eliminar si hay más de 1 medicamento en la lista --}}
                                    <button type="button" @click="medicamentos.splice(index, 1)" x-show="medicamentos.length > 1"
                                            class="bg-red-400 hover:bg-red-500 text-white p-2 rounded-md transition-colors shadow-sm" title="Eliminar medicamento">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>

                            </div>
                        </template>
                    </div>

                    <button type="button" @click="medicamentos.push({ medicamento_id: '', dosis: '', frecuencia: '' })"
                            class="flex items-center gap-2 bg-white border border-gray-300 text-gray-600 hover:bg-gray-50 hover:text-gray-800 text-sm font-medium py-2 px-4 rounded-md transition-colors shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Añadir Medicamento
                    </button>
                </div>

                <div class="flex justify-end pt-6 mt-4 border-t border-gray-100 gap-3">
                    <a href="{{ url()->previous() }}" class="flex items-center gap-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium py-2.5 px-6 rounded-md transition duration-150 shadow-sm">
                        Volver
                    </a>
                    <button type="submit" class="flex items-center gap-2 bg-indigo-500 hover:bg-indigo-600 text-white font-medium py-2.5 px-6 rounded-md transition duration-150 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                        </svg>
                        Guardar Consulta
                    </button>
                </div>

            </form>
        </div>
    </div>
</x-admin-layout>
