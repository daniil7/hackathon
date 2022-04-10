<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Магазин
        </h2>
    </x-slot>

    <?php
    if($category != null){
        $items = App\Http\Controllers\ProductController::getByCategory($item);
    } else {
        if($collection != null){
            $items = App\Http\Controllers\ProductController::getByCollection($item);
        } else {
            $items = App\Http\Controllers\ProductController::getAll();
        }
    }

    ?>

    @if(empty($items) == false)

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="grid grid-cols-2 md:grid-cols-3 gap-20 p-10">

                    @foreach ($items as $item)

                        <div class="rounded shadow-lg">
                            <img class="w-full rounded object-center" src="/images/{{$item->image}}">
                            <div class="text-center">
                                <div class="font-bold text-xl">{{$item->name}}</div>
                                <div class="text-sm">{{$item->price}} рублей</div>
                                @if(Auth::User()->is_admin)
                                <a href="/tanechka/product/{{$item->id}}">редактировать</a>
                                <a href="/tanechka/remove_product/{{$item->id}}">удалить</a>
                                @endif

                                <a href="/buy/{{$item->id}}">в корзину</a>

                                <!-- @foreach(App\Http\Controllers\ItemController::getAll($item) as $pair)
                                    @foreach ($pair as $size => $amount)
                                    {{$size}} {{$amount}}
                                    @endforeach
                                @endforeach -->
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
