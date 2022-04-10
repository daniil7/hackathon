<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Панель администратора
        </h2>
    </x-slot>

    <?php $product = App\Models\Product::find($id); ?>

    @if($product != null)

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <h2 class="my-5 mx-2">Редактировать объект:</h2>
                <form class="needs-validation" method="POST" action="/tanechka/edit_product" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-2 gap-1 mr-auto w-3/4 mx-2">
                        <label>Название</label>
                        <input type="text" class="form-control" name="name" placeholder="Название объекта" value="{{$product->name}}" required>
                        <label>Цена</label>
                        <input type="number" class="form-control" name="price" placeholder="Цена" value="{{$product->price}}" required>
                        <label>Описание</label>
                        <input type="text" class="form-control" name="description" placeholder="Описание" value="{{$product->description}}">
                        <label>Категория</label>
                        <select name="category_id">
                            @foreach (App\Models\Category::All() as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                        <label>Коллекция</label>
                        <select name="collection_id">
                            @foreach (App\Models\Collection::All() as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                        <label for="img">Загрузить файл</label>
                        <input class="block w-full cursor-pointer bg-gray-50 border border-gray-300 text-gray-900 focus:outline-none focus:border-transparent text-sm rounded-lg" id="img" name="image" type="file">
                        <input type="hidden" name="id" value="{{$product->id}}">
                    </div>
                    <button class="btn btn-primary m-2" type="submit"> Принять </button>
                </form>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <h2 class="my-5 mx-2">Редактировать объект:</h2>
                <form class="needs-validation" method="POST" action="/tanechka/add_item">
                    @csrf
                    <div class="grid grid-cols-2 gap-1 mr-auto w-3/4 mx-2">
                        <label>Изменение количеста</label>
                        <input type="number" class="form-control" name="amount" required>
                        <label>Размер</label>
                        <select name="size">
                            <option value="XS">XS</option>
                            <option value="S">S</option>
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XS">XS</option>
                            <option value="XL">XL</option>
                            <option value="XXL">XXL</option>
                        </select>
                    </div>
                    <input type="hidden" name="product_id" value="{{$product->id}}">
                    <button class="btn btn-primary m-2" type="submit"> Принять </button>
                </form>
            </div>
        </div>
    </div>

    @else

    <h1 class="text-5xl md:text-5xl lg:text-6xl text-center pt-10">
        <span class="">Нет такого id</span>
    </h1>

    @endif

</x-app-layout>
