<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Корзина
        </h2>
    </x-slot>

    <?php
    $carts = Auth::user()->cart_items;
    ?>

    @if(empty($carts) == false)

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="grid grid-cols-2 md:grid-cols-3 gap-20 p-10">

                    @foreach ($carts as $cart)

                    <?php
                    $item = App\Models\Item::where('id', $cart->item_id)->first();
                    $product = $item->product()->first();
                     ?>

                        <div class="rounded shadow-lg">
                            <img class="w-full rounded object-center" src="/images/{{$product->image}}">
                            <div class="text-center">
                                <div class="font-bold text-xl">{{$product->name}}</div>
                                <div class="text-sm">{{$product->price}} рублей</div>
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
