<div>
    <div class="flex justify-between items-center mb-4">
        <div class="relative">
            <input wire:model.lazy="search" type="text" placeholder="Buscar" class="border border-gray-300 rounded-md pl-3 pr-10 py-1.5 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 w-64">
        </div>

        <div class="flex items-center gap-3 text-sm">
            <select wire:model.lazy="perPage" class="border border-gray-300 bg-white text-gray-700 rounded-md px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-500 hover:bg-gray-50 cursor-pointer text-sm">
                <option>10</option>
                <option>25</option>
                <option>50</option>
            </select>
        </div>
    </div>

    <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-max">
                <thead>
                    <tr class="border-b border-gray-200 text-xs font-semibold text-gray-500 uppercase tracking-wider bg-gray-50/50">
                        @php
                            $columnas = ['ID', 'PACIENTE', 'DOCTOR', 'FECHA', 'HORA', 'ESTADO'];
                        @endphp

                        @foreach($columnas as $columna)
                            <th class="px-4 py-4 cursor-pointer hover:bg-gray-100 group" wire:click="sortBy('{{ strtolower($columna) }}')">
                                <div class="flex items-center gap-1">
                                    {{ $columna }}
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-gray-400 group-hover:text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                                    </svg>
                                </div>
                            </th>
                        @endforeach
                        <th class="px-4 py-4 text-center">ACCIONES</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-700 divide-y divide-gray-100 font-medium">
                    @foreach($citas as $cita)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-4 py-4">{{ $cita->id }}</td>
                        <td class="px-4 py-4">{{ $cita->patient->full_name }}</td>
                        <td class="px-4 py-4 text-gray-600">{{ $cita->doctor->full_name }}</td>
                        <td class="px-4 py-4">{{ $cita->date }}</td>
                        <td class="px-4 py-4">{{ $cita->time }}</td>
                        <td class="px-4 py-4 text-gray-600">{{ $cita->status }}</td>
                        <td class="px-4 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.citas.edit', $cita) }}" class="bg-blue-500 hover:bg-blue-600 text-white p-1.5 rounded transition-colors shadow-sm" title="Editar Cita">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                    </svg>
                                </a>
                                <a href="{{ route('admin.citas.show', $cita) }}" class="bg-green-500 hover:bg-green-600 text-white p-1.5 rounded transition-colors shadow-sm" title="Ver Cita">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                                <a href="{{ route('admin.citas.consultation.create', $cita) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white p-1.5 rounded transition-colors shadow-sm" title="Añadir Datos de Consulta">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $citas->links() }}
    </div>
</div>
