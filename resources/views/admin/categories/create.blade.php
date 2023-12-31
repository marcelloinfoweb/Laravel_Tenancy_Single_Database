<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Criar Categoria') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <form action="{{route('admin.categories.store')}}" method="POST">
                        @csrf
                        <div class="w-full mb-8">
                            <label>Nome>
                                <input type="text" name="name" class="rounded w-full focus:border-gray-400 focus:ring-0">
                            </label>
                        </div>

                        <div class="w-full mb-8">
                            <label>Descrição
                                <input type="text" name="description"
                                       class="rounded w-full focus:border-gray-400 focus:ring-0">
                            </label>
                        </div>

                        <button
                            class="px-4 py-2 text-xl bg-green-600 hover:bg-green-300 hover:text-green-900 border border-green-900 transition-all ease-in-out duration-200 rounded text-white font-bold">
                            Cadastrar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
