<x-app-layout>
    <style>
    .relative:hover form {
        opacity: 1;
        pointer-events: auto;
    }
    </style>
        <x-slot name="header">
        <h2 class=" flex font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <a href="{{ route('batiment.show',$batiment_id)}}" class="w-7 h-7 mr-5  flex hover:border-black motion-safe:hover:scale-[1.1] transition-all duration-250">
              <img src="{{asset('retour.png')}}">
            </a>
            <span>
              <span>{{ __('etage ')}}</span><span class=" text-myyellow">n° {{$etage->num}}</span>
            </span>
        </h2>
    </x-slot>
    <div style="background-color:rgb(31,41,76);" class="w-2/3 p-1  my-10 mx-auto grid gap-1 grid-cols-3">
        @foreach($bureaux as $bureau)
        <a href="{{ route('bureau.show',[$bureau->id,$batiment_id]) }}" class="w-full h-56 rounded-none  bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex hover:border-black motion-safe:hover:scale-[1.01]  transition-all duration-250 focus:outline focus:outline-2">
            <div class="size-full flex justify-center px-0 py-6 relative ">
                <form action="{{route('bureau.destroy',[$bureau->id,$etage->id])}}" method="post"  class="absolute top-3 right-3 opacity-0 pointer-events-none transition-opacity duration-300">
                  @csrf
                  @method('delete')
                  <button type="submit"><img src="{{asset('fermer.png')}}" class="h-6 w-6"></button>
                </form>
                <form action="{{route('bureau.edit',[$bureau->id,$etage->id])}}" class="absolute bottom-3 right-3 opacity-0 pointer-events-none transition-opacity duration-300">
                  <button type="submit"><img src="{{asset('editer.png')}}" class="h-6 w-6"></button>
                </form>
                <div class="flex-auto">
                    <h1 style="color:rgb(31,41,76);" class="text-center text-xl font-semibold uppercase truncate py-2 h-10">{{$bureau->titre}}</h1>
                    <p style="color:rgb(31,41,76);" class="text-center ">Bureau n°{{$bureau->num}} </p>
                    <div class="text-center" style="color:rgb(31,41,76);">
                        <img class="w-14 h-14 mx-auto" src="{{asset('click.gif')}}" alt="">
                        cliquer pour gérer
                    </div>
                </div>
            </div>
        </a>
        @endforeach
        <a href="{{ route('bureau.create', $etage->id)}}" class="w-full h-56 rounded-none  bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex hover:border-black motion-safe:hover:scale-[1.01]  transition-all duration-250 focus:outline focus:outline-2">
            <div class="size-full flex justify-center  scale-105 py-24">
                <img class="h-7 w-7"  src="{{asset('plus.png')}}">
            </div>
        </a>
    </div>
</x-app-layout>