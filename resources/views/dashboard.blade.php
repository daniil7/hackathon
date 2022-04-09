<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <?php
    if($category == null){
        $items = App\Http\Controllers\ProductController::getAll($category);
    } else {
        $items = App\Http\Controllers\ProductController::getByCategory($category);
    }
    ?>

    @if(empty($items) == false)

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

            @foreach ($items as $item)

            

            @endforeach

            </div>
        </div>
    </div>

    @else

    Товаров по вашему запросу нет

    @endif
</x-app-layout>
