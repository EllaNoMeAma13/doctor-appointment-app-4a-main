<div>
    <div class="p-6 mb-6 overflow-hidden bg-white shadow-xl sm:rounded-lg">
        <div class="flex items-center gap-4">
            <div class="w-16 h-16 bg-blue-100 text-blue-500 rounded-full flex items-center justify-center text-2xl font-bold">
                {{ substr($user->name, 0, 2) }}
            </div>
            <div>
                <h2 class="text-2xl font-bold text-gray-800">{{ $user->name }}</h2>
                <p class="text-sm text-gray-600">Cédula: <span class="font-semibold">{{ $doctor->medical_license_number ?: 'N/A' }}</span></p>
                <p class="text-sm text-gray-600">Biografía: <span class="font-semibold">{{ $doctor->biography ? 'Capturada' : 'N/A' }}</span></p>
            </div>
        </div>
    </div>

    <form wire:submit.prevent="save">
        <x-card title="Información Profesional del Doctor">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <x-select
                        label="Especialidad"
                        placeholder="Seleccione una especialidad"
                        :options="$specialties"
                        option-label="name"
                        option-value="id"
                        wire:model="specialty_id"
                    />
                    <x-input-error for="specialty_id" class="mt-2" />
                </div>
                <div>
                    <x-input
                        label="Cédula Profesional"
                        placeholder="Ej. 12345678"
                        wire:model="medical_license_number"
                    />
                    <x-input-error for="medical_license_number" class="mt-2" />
                </div>
                <div class="md:col-span-2">
                    <x-textarea
                        label="Biografía"
                        placeholder="Describa la trayectoria y enfoque del doctor."
                        wire:model="biography"
                    />
                    <x-input-error for="biography" class="mt-2" />
                </div>
            </div>

            <x-slot name="footer">
                <div class="flex justify-end items-center gap-x-4">
                    <x-button type="submit" spinner="save" loading-delay="short" class="btn btn-primary" label="Guardar Cambios" />
                </div>
            </x-slot>
        </x-card>
    </form>
</div>
