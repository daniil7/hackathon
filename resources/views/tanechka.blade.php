<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Панель администратора
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-3">
                <h2>Список категорий:</h2>
                <div class="flex flex-wrap flex-row mb-10">
                    @foreach (App\Models\Category::All() as $item)
                        <span class="bg-cyan-200 text-center rounded mx-4 text-teal-800">{{$item->name}}</span>
                    @endforeach
                </div>
                <form class="needs-validation" method="POST" action="/tanechka/add_category">
                    @csrf
                        <input type="text" class="form-control" name="name" placeholder="Название коллекции" value="" required>
                    <button class="btn btn-primary ml-4" type="submit"> Добавить </button>
                </form>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-3">
                <h2>Список коллекций:</h2>
                <div class="flex flex-wrap flex-row mb-10">
                    @foreach (App\Models\Collection::All() as $item)
                        <span class="bg-cyan-200 text-center rounded mx-4 text-teal-800">{{$item->name}}</span>
                    @endforeach
                </div>
                <form class="needs-validation" method="POST" action="/tanechka/add_collection">
                    @csrf
                        <input type="text" class="form-control" name="name" placeholder="Название коллекции" value="" required>
                    <button class="btn btn-primary ml-4" type="submit"> Добавить </button>
                </form>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-3">
                <h2>Список промокодов:</h2>
                <div class="flex flex-wrap flex-row mb-10">
                    @foreach (App\Models\Promocode::All() as $item)
                        <span class="bg-cyan-200 text-center rounded mx-4 text-teal-800">
                            {{$item->name}}: {{$item->amount}}
                        </span>
                    @endforeach
                </div>
                <form class="needs-validation" method="POST" action="/promocode">
                    @csrf
                        <input type="text" class="form-control" name="name" placeholder="Промокод" value="" required>
                        <label class="ml-4 mr-1">Сумма:</label>
                        <input type="text" class="form-control" name="amount" placeholder="100.00" value="" required>
                    <button class="btn btn-primary ml-4" type="submit"> Добавить </button>
                </form>
            </div>
        </div>
    </div>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <h2 class="my-5 mx-2">Создать новый объект:</h2>
                <form class="needs-validation" method="POST" action="/tanechka/add_product" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-2 gap-1 mr-auto w-3/4 mx-2">
                        <label>Название</label>
                        <input type="text" class="form-control" name="name" placeholder="Название объекта" value="" required>
                        <label>Цена</label>
                        <input type="number" class="form-control" name="price" placeholder="Цена" value="" required>
                        <label>Описание</label>
                        <input type="text" class="form-control" name="description" placeholder="Описание" value="">
                        <label>Категория</label>
                        <select name="category_id" required>
                            @foreach (App\Models\Category::All() as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                        <label>Коллекция</label>
                        <select name="collection_id">
                                <option value="">Ничего</option>
                            @foreach (App\Models\Collection::All() as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                        <label for="img">Загрузить файл</label>
                        <input class="block w-full cursor-pointer bg-gray-50 border border-gray-300 text-gray-900 focus:outline-none focus:border-transparent text-sm rounded-lg" id="img" name="image" type="file">
                    </div>
                    <button class="btn btn-primary m-2" type="submit"> Добавить </button>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
