@section('contend')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('dashboard') }}
        </h2>
    </x-slot>
     <div class="mt-16 mx-28 bg-white rounded-lg max-w-7xl sm:px-6 lg:px-8 space-y-6">
    @if($errors->any())
    <div class="alert alert-danger" role='alert'>
        <ul>
            @foreach($errors->all() as $item)
            <li>{{$item}}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="mt-16">
        <form method="POST" class="p-3" action="{{ route('batiment.update',['batiment'=>$batiment])}}" enctype="multipart/form-data">
        @csrf
        @method('put')
        <!-- Name -->
        <div class="mt-4">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{$batiment->name}}" autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <!-- Description -->
        <div class="mt-4">
            <x-input-label for="description" :value="__('Description')" />
            <textarea id="descr" style="border-color:rgb(226,228,231);"  class="rounded-lg block mt-1 w-full h-28"  name="descr" required autocomplete="descr" >{{$batiment->descr}}</textarea>
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div> 
        <!-- Image --> 
        <div class="mt-4">
            <x-input-label for="image" :value="__('Image')" />
            <input type="file" id="image" value="{{$batiment->image}}" style="border-color:rgb(226,228,231);" class="rounded-lg block mt-1 w-full"  name="image" required autocomplete="image" ></input>
            <x-input-error :messages="$errors->get('image')" class="mt-2" />
        </div>
        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4" >
                Register
            </x-primary-button>
        </div>
    </form>
    </div>
</x-app-layout>