<x-admin-layout title="Editar Paciente" :breadcrumb="[
    ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
    ['name' => 'Pacientes', 'url' => '#'], {{-- Aquí puedes poner el route de tu index --}}
    ['name' => 'Editar']
]">

    <div class="p-6 mb-6 overflow-hidden bg-white shadow-xl sm:rounded-lg flex flex-col md:flex-row justify-between items-center gap-4">
        <div class="flex items-center gap-4">
            <div class="w-16 h-16 bg-blue-100 text-blue-500 rounded-full flex items-center justify-center text-2xl font-bold">
                {{ substr($patient->user->name, 0, 2) }}
            </div>
            <h2 class="text-2xl font-bold text-gray-800">{{ $patient->user->name }}</h2>
        </div>

        <div class="flex gap-3">
            <a href="{{ route('admin.patients.index') }}" class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 shadow-sm transition">
                Volver
            </a>
            <button type="submit" form="edit-patient-form" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 shadow-sm transition flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                Guardar cambios
            </button>
        </div>
    </div>

    <form action="{{ route('admin.patients.update', $patient) }}" method="POST" id="edit-patient-form">
        @csrf
        @method('PUT')

        <x-tabs :initialTab="$initialTab ?? 'personales'">
            <x-slot name="header">
                <x-tab-link name="personales" label="Datos personales" :hasError="$errors->hasAny(['name', 'email', 'phone', 'address'])">
                    <x-slot name="icon">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </x-slot>
                </x-tab-link>

                <x-tab-link name="antecedentes" label="Antecedentes" :hasError="$errors->hasAny(['blood_type_id', 'allergies', 'chronic_conditions', 'family_history', 'surgical_history'])">
                    <x-slot name="icon">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </x-slot>
                </x-tab-link>

                <x-tab-link name="informacion" label="Información general" :hasError="$errors->hasAny(['observations'])">
                    <x-slot name="icon">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </x-slot>
                </x-tab-link>

                <x-tab-link name="emergencia" label="Contacto de emergencia" :hasError="$errors->hasAny(['emergency_contact_name', 'emergency_contact_phone', 'emergency_contact_relationship'])">
                    <x-slot name="icon">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    </x-slot>
                </x-tab-link>
            </x-slot>

            <x-tab-content name="personales">
                <div class="bg-blue-50 border-l-4 border-blue-500 rounded-r-lg p-5 mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h3 class="text-blue-800 font-bold flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            Edición de cuenta de usuario
                        </h3>
                        <p class="text-blue-600 text-sm mt-1">La <span class="font-semibold">información de acceso</span> (nombre, email y contraseña) debe gestionarse desde la cuenta de usuario asociada.</p>
                    </div>
                    <a href="{{ route('admin.users.edit', $patient->user) }}" class="shrink-0 bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm flex items-center gap-2 transition">
                        Editar usuario
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-gray-700">
                    <div class="space-y-6">
                        <div>
                            <span class="block text-sm text-gray-500 mb-1">Email asociado</span>
                            <input type="text" disabled value="{{ $patient->user->email }}" class="block w-full bg-gray-100 border-gray-300 rounded-md shadow-sm sm:text-sm text-gray-500 cursor-not-allowed">
                        </div>
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Dirección</label>
                            <input type="text" name="address" id="address" value="{{ old('address', $patient->address) }}"
                                   class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            @error('address') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>
            </x-tab-content>

            <x-tab-content name="antecedentes">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Antecedentes del Paciente</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="blood_type_id" class="block text-sm font-medium text-gray-700">Tipo de Sangre</label>
                        <select name="blood_type_id" id="blood_type_id" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Seleccione...</option>
                            @foreach($bloodTypes as $bloodType)
                                <option value="{{ $bloodType->id }}" {{ old('blood_type_id', $patient->blood_type_id) == $bloodType->id ? 'selected' : '' }}>{{ $bloodType->name }}</option>
                            @endforeach
                        </select>
                        @error('blood_type_id') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="allergies" class="block text-sm font-medium text-gray-700">Alergias</label>
                        <textarea name="allergies" id="allergies" rows="3" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('allergies', $patient->allergies) }}</textarea>
                        @error('allergies') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="chronic_conditions" class="block text-sm font-medium text-gray-700">Condiciones Crónicas</label>
                        <textarea name="chronic_conditions" id="chronic_conditions" rows="3" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('chronic_conditions', $patient->chronic_conditions) }}</textarea>
                        @error('chronic_conditions') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="family_history" class="block text-sm font-medium text-gray-700">Historial Familiar</label>
                        <textarea name="family_history" id="family_history" rows="3" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('family_history', $patient->family_history) }}</textarea>
                        @error('family_history') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="surgical_history" class="block text-sm font-medium text-gray-700">Antecedentes Quirúrgicos</label>
                        <textarea name="surgical_history" id="surgical_history" rows="3" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('surgical_history', $patient->surgical_history ?? '') }}</textarea>
                        @error('surgical_history') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>
            </x-tab-content>

            <x-tab-content name="informacion">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Información General</h3>
                <div class="space-y-6">
                    <div>
                        <label for="observations" class="block text-sm font-medium text-gray-700">Observaciones Generales</label>
                        <textarea name="observations" id="observations" rows="6" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('observations', $patient->observations) }}</textarea>
                        @error('observations') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>
            </x-tab-content>

            <x-tab-content name="emergencia">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Contacto de Emergencia</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="emergency_contact_name" class="block text-sm font-medium text-gray-700">Nombre Contacto</label>
                        <input type="text" name="emergency_contact_name" id="emergency_contact_name" value="{{ old('emergency_contact_name', $patient->emergency_contact_name) }}"
                               class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('emergency_contact_name') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div x-data="{
                        phone: '{{ old('emergency_contact_phone', $patient->emergency_contact_phone) }}',
                        format() {
                            let val = this.phone.replace(/\D/g, '').substring(0, 10);
                            this.phone = val.length > 0 ? val.match(/.{1,2}/g).join('-') : '';
                        }
                    }" x-init="format()">
                        <label for="emergency_contact_phone" class="block text-sm font-medium text-gray-700">Teléfono</label>
                        <input type="text" name="emergency_contact_phone" id="emergency_contact_phone" x-model="phone" @input="format()" maxlength="14" placeholder="00-00-00-00-00"
                               class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('emergency_contact_phone') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="md:col-span-2" x-data="{
                        relation: @json(old('emergency_contact_relationship', $patient->emergency_contact_relationship)),
                        other: '',
                        options: ['Padre', 'Madre', 'Esposo/a', 'Hijo/a', 'Hermano/a', 'Tío/a', 'Abuelo/a', 'Amigo/a'],
                        init() {
                            if (this.relation && !this.options.includes(this.relation)) {
                                this.other = this.relation;
                                this.relation = 'Otro';
                            }
                        }
                    }">
                        <label for="emergency_contact_relationship" class="block text-sm font-medium text-gray-700">Parentesco</label>
                        <select x-model="relation" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Seleccione...</option>
                            <template x-for="option in options" :key="option">
                                <option :value="option" x-text="option"></option>
                            </template>
                            <option value="Otro">Otro</option>
                        </select>
                        <div x-show="relation === 'Otro'" class="mt-2">
                            <input type="text" x-model="other" maxlength="250" placeholder="Especifique parentesco..." class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                        <input type="hidden" name="emergency_contact_relationship" :value="relation === 'Otro' ? other : relation">
                        @error('emergency_contact_relationship') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>
            </x-tab-content>
        </x-tabs>
    </form>

    @push('js')
        <script>
            function handleDelete(patientId) {
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
                        document.getElementById('delete-form-' + patientId).submit();
                    }
                })
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
