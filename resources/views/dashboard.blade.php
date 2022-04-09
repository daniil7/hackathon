<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Магазин
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

                <div class="grid grid-cols-2 md:grid-cols-3 gap-20 p-10">

                    @foreach ($items as $item)

                        <div class="rounded shadow-lg">
                            <img class="w-full rounded object-center" src="/external-content.jpeg">
                            <div class="text-center">
                                <div class="font-bold text-xl">{{$item->name}}</div>
                                <div class="text-sm">100 баллов</div>
                            </div>
                        </div>

                    @endforeach

                </div>

            </div>
        </div>
    </div>

    @else

    <h1 class="text-center mt-5 text-lg">Товаров по вашему запросу нет</h1>

    @endif
</x-app-layout>
