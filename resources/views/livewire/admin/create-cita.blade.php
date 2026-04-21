<div class="max-w-7xl mx-auto p-6 font-sans bg-gray-50 min-h-screen">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Nuevo</h1>

    <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6 mb-6">
        <h2 class="text-lg font-semibold text-gray-800">Buscar disponibilidad</h2>
        <p class="text-sm text-gray-500 mb-4">Encuentra el horario perfecto para tu cita.</p>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
            <div>
                <label class="block text-sm text-gray-600 mb-1">Fecha</label>
                <input type="date" wire:model.lazy="date" class="w-full border border-gray-300 rounded-md pl-3 pr-10 py-2 text-sm focus:ring-indigo-500 focus:border-indigo-500 text-gray-700">
            </div>

            <div>
                <label class="block text-sm text-gray-600 mb-1">Especialidad (opcional)</label>
                <select wire:model.lazy="specialty_id" class="w-full border border-gray-300 rounded-md pl-3 pr-8 py-2 text-sm focus:ring-indigo-500 focus:border-indigo-500 text-gray-700 appearance-none bg-white">
                    <option value="">Todas</option>
                    @foreach($specialties as $specialty)
                        <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <button wire:click="searchAvailability" class="w-full bg-indigo-500 hover:bg-indigo-600 text-white font-medium py-2 px-4 rounded-md transition duration-150">
                    Buscar disponibilidad
                </button>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-4">
            @foreach($availableDoctors as $doctor)
            <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-14 h-14 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-400 font-bold text-xl">
                        {{ substr($doctor->user->name, 0, 2) }}
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">{{ $doctor->user->name }}</h3>
                        <p class="text-sm text-indigo-500">{{ $doctor->specialty->name }}</p>
                    </div>
                </div>
                <hr class="border-gray-100 mb-4">
                <div>
                    <p class="text-sm text-gray-600 font-medium mb-3">Horarios disponibles:</p>
                    <div class="flex flex-wrap gap-2">
                        {{-- Dummy times --}}
                        @foreach(['08:00:00', '09:00:00', '10:00:00'] as $time)
                            <button wire:click="selectSlot({{ $doctor->id }}, '{{ $time }}')" class="px-6 py-2 rounded-md text-sm font-medium transition-colors
                                {{ $selectedDoctorId == $doctor->id && $selectedTime == $time
                                    ? 'bg-indigo-500 text-white hover:bg-indigo-600'
                                    : 'bg-indigo-200 text-indigo-700 hover:bg-indigo-300' }}">
                                {{ $time }}
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6 sticky top-6">
                <h2 class="text-lg font-bold text-gray-800 mb-6">Resumen de la cita</h2>

                @if($selectedDoctor && $selectedTime)
                <div class="space-y-4 text-sm mb-6">
                    <div class="flex justify-between border-b border-gray-50 pb-2">
                        <span class="text-gray-500">Doctor:</span>
                        <span class="font-medium text-gray-800">{{ $selectedDoctor->user->name }}</span>
                    </div>
                    <div class="flex justify-between border-b border-gray-50 pb-2">
                        <span class="text-gray-500">Fecha:</span>
                        <span class="font-medium text-gray-800">{{ $date }}</span>
                    </div>
                    <div class="flex justify-between border-b border-gray-50 pb-2">
                        <span class="text-gray-500">Horario:</span>
                        <span class="font-medium text-gray-800">{{ $selectedTime }}</span>
                    </div>
                </div>

                <form wire:submit.prevent="store" class="space-y-4">
                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Paciente</label>
                        <select wire:model.lazy="patientId" class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-indigo-500 focus:border-indigo-500 bg-white">
                            <option value="">Seleccione un paciente</option>
                            @foreach($patients as $patient)
                                <option value="{{ $patient->id }}">{{ $patient->user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Motivo de la cita</label>
                        <textarea wire:model.lazy="reason" rows="3" class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-indigo-500 focus:border-indigo-500 resize-none"></textarea>
                    </div>

                    <button type="submit" class="w-full bg-indigo-500 hover:bg-indigo-600 text-white font-medium py-2.5 px-4 rounded-md transition duration-150 mt-2">
                        Confirmar cita
                    </button>
                </form>
                @else
                <p class="text-sm text-gray-500">Seleccione un doctor y un horario para ver el resumen.</p>
                @endif
            </div>
        </div>
    </div>
</div>
