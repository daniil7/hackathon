<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        @if (Auth::user()->id == $user->id)
            Личный кабинет
        @else
            {{ $user->name }}
        @endif
        </h2>
        <h2>
            Баланс: {{ $user->balance }}
        </h2>
    </x-slot>
</x-app-layout>
