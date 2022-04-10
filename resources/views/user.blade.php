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
        @if (Auth::user()->id == $user->id)
                <form class="needs-validation" method="POST" action="/promocode/activate">
                    @csrf
                        <label>Ввести промокод: </label>
                        <input type="text" class="form-control" name="name" placeholder="PROMO" value="" required>
                    <button class="btn btn-primary" type="submit">Активировать</button>
                </form>
        @endif
    </x-slot>
</x-app-layout>
