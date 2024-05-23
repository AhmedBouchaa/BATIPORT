@section('contend')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Creation d\'etage') }}
        </h2>
    </x-slot>
    <div class="mt-16 mx-28 bg-white rounded-lg max-w-7xl sm:px-6 lg:px-8 space-y-6">
        <div class="mt-16">
            <form method="post" class="p-3" action="{{route('etage.store',$theid)}}">
            @csrf
            @method('post')
            <!-- num -->
            <div class="mt-4">
                <x-input-label for="num" :value="__('Numero')" />
                <x-text-input id="num" class="block mt-1 w-full" type="number" name="num" :value="old('num')" required autofocus autocomplete="num" />
                <x-input-error :messages="$errors->get('num')" class="mt-2" />
            </div>
            <!-- nbre de bureau  -->
            <div class="mt-4">
            <x-input-label for="nbbureau" :value="__('Nombre de bureau')" />
            <x-text-input id="nbbureau" class="block mt-1 w-full" type="number" name="nbbureau" :value="old('nbbureau')" required autocomplete="nbbureau" />
            <x-input-error :messages="$errors->get('nbbureau')" class="mt-2" />
            </div>
            <div class="flex items-center justify-end mt-4">
            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ms-4" >
                    Register
                </x-primary-button>
            </div>
        </div>
    </div>
</x-app-layout>







  