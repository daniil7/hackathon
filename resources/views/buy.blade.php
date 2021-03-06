<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Покупка мерча
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-3">
                <img src="/images/{{App\Models\Product::find($id)->image}}" class="mx-auto">
                <form class="needs-validation mt-5" method="POST" action="/product/buy">
                    @csrf
                    <div class="grid grid-cols-2 gap-1 mr-auto w-3/4 mx-2">
                        <label>Количество</label>
                        <input type="number" class="form-control" name="amount" required>
                        <label>Размер</label>
                        <select name="size">
                            @foreach (App\Models\Product::findOrFail($id)->items as $item)
                                <option value="{{$item->size}}">{{$item->size}}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" name="product_id" value="{{$id}}">
                    <button class="btn btn-primary m-2" type="submit"> Принять </button>
                    <button class="btn btn-primary m-2" type="button"> Подписаться </button>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
