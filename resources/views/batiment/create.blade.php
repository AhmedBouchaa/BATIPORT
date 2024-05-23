<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    $(document).ready(function () {
        $('input[name="type_reseaux"]').on('change', function () {
            var placeholder = $(this).data('placeholder');
            $('#adresse_reseau').attr('placeholder', placeholder);
        });
    });
</script>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Creation de Batiment') }}
        </h2>
    </x-slot>

    <div class="mt-16 mx-28 bg-white rounded-lg max-w-7xl sm:px-6 lg:px-8 space-y-6">
        <div class="mt-16">
        <form method="post" class="p-2" action="{{ route('batiment.store') }}" enctype="multipart/form-data">
            @csrf
            @method('post')
            <!-- Name -->
            <div class="mt-4">
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full focus:ring-myblue active:" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <!-- Description -->
            <div class="mt-4">
                <x-input-label for="description" :value="__('Description')" />
                <textarea id="descr" style="border-color:rgb(226,228,231);" class="rounded-lg block mt-1 w-full h-28"  name="descr" required autocomplete="descr" ></textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div> 
            <!-- Image --> 
            <div class="mt-4">
                <x-input-label for="image" :value="__('Image')" />
                <input type="file" id="image" style="border-color:rgb(226,228,231);" class="rounded-lg block mt-1 w-full"  name="image" required autocomplete="image" ></input>
                <x-input-error :messages="$errors->get('image')" class="mt-2" />
            </div>
            <!-- Type de Réseaux -->
            <div class="mt-4">
                <x-input-label :value="__('Classe de Réseaux')" />
                <div class="flex items-center space-x-4">
                <input type="radio" id="typeA" class="text-myyellow active:text-myyellow focus:text-myyellow focus:ring-myyellow" name="type_reseaux" value="A" data-placeholder="XXX.0.0.0" />
                <label for="typeA">A</label>

                <input type="radio" id="typeB" class="text-myyellow active:text-myyellow focus:text-myyellow focus:ring-myyellow" name="type_reseaux" value="B" data-placeholder="XXX.XXX.0.0" />
                <label for="typeB">B</label>

                <input type="radio" id="typeC" class="text-myyellow active:text-myyellow focus:text-myyellow focus:ring-myyellow" name="type_reseaux" value="C" data-placeholder="XXX.XXX.XXX.0" />
                <label for="typeC">C</label>
                </div>
                <x-input-error :messages="$errors->get('type_reseaux')" class="mt-2" />
            </div>
            <!--Description-->
            <div class="m-5 py-5 rounded-lg bg-gradient-to-r from-gray-600 to-cyan-600 text-white">
                <p class="text-xl mb-5 ml-6">Description</p>
                    <dl>
                        <hr class="mt-2">
                        <dt class="text-2xl ml-5">A <span class="text-xs">de grand réseau</span></dt>
                        <dd class="ml-8">Cette classe de réseaux peut réserver à votre bâtiment jusqu'à 16 777 214 machines</dd>
                        <hr class="mt-2">
                        <dt class="text-2xl ml-5">B <span class="text-xs">de moyen réseau</span></dt>
                        <dd class="ml-8">Cette classe de réseaux peut réserver à votre bâtiment jusqu'à 65 534 machines</dd>
                        <hr class="mt-2">
                        <dt class="text-2xl ml-5">C <span class="text-xs">de petit réseau</span></dt>
                        <dd class="ml-8">Cette classe de réseaux peut réserver à votre bâtiment jusqu'à 254 machines</dd>
                    </dl>
                </div>

            <!-- Adresse Réseaux -->
            <div class="mt-4">
                <x-input-label for="adresse_reseau" :value="__('Adresse Réseaux')" />
                <input type="text" id="adresse_reseau" class="rounded-lg block mt-1 w-full " name="adresse_reseau" required autocomplete="adresse_reseau" placeholder="Sélectionnez d'abord le type de réseau">
                <x-input-error :messages="$errors->get('adresse_reseau')" class="mt-2" />
            </div>
            <!-- Botton -->
            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ms-4">
                    Register
                </x-primary-button>
            </div>
        </form>
        </div>
    </div>
</x-app-layout>
