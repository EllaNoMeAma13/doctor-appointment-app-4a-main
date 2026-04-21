@props(['initialTab' => 'personales'])

<div x-data="{ activeTab: '{{ $initialTab }}' }" class="p-6 overflow-hidden bg-white shadow-xl sm:rounded-lg">
    <div class="flex flex-col md:flex-row gap-8">

        <div class="w-full md:w-1/4 border-r border-gray-100 pr-4">
            <ul class="space-y-6">
                {{ $header }}
            </ul>
        </div>

        <div class="w-full md:w-3/4">
            {{ $slot }}
        </div>
    </div>
</div>
