@props(['name', 'label', 'icon' => null, 'hasError' => false])

<li>
    <button type="button" @click="activeTab = '{{ $name }}'"
            :class="activeTab === '{{ $name }}'
                ? 'text-indigo-600 border-b-2 border-indigo-600 pb-1'
                : '{{ $hasError ? 'text-red-600' : 'text-gray-600 hover:text-gray-900' }}'"
            class="flex items-center gap-3 font-medium text-left transition-colors w-full">

        @if($hasError)
            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
            </svg>
        @elseif($icon)
            {!! $icon !!}
        @endif

        {{ $label }}
    </button>
</li>
