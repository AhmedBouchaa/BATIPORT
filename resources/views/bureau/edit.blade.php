@section('contend')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            modification de bureau 
        </h2>
    </x-slot>
     <div class="mt-16 mx-28 bg-white rounded-lg max-w-7xl sm:px-6 lg:px-8 space-y-6">
    <div class="mt-16">
        <form method="POST" class="p-3" action="{{ route('bureau.update',['bureau'=>$bureau,'theid'=>$theid])}}">
        @csrf
        @method('put')
            <!-- titre -->
            <div class="mt-4">
                <x-input-label for="titre" :value="__('Titre')" />
                <x-text-input id="titre" class="block mt-1 w-full" type="text" name="titre" value="{{$bureau->titre}}" autofocus autocomplete="titre" />
                <x-input-error :messages="$errors->get('titre')" class="mt-2" />
            </div>
            <!-- num -->
            <div class="mt-4">
                <x-input-label for="num" :value="__('Numero')" />
                <x-text-input id="num" class="block mt-1 w-full" type="number" name="num" value="{{$bureau->num}}" required autofocus autocomplete="num" />
                <x-input-error :messages="$errors->get('num')" class="mt-2" />
            </div>
            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ms-4" >
                    Register
                </x-primary-button>
            </div>
    </form>
    </div>
</x-app-layout>