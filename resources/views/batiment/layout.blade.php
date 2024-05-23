<x-app-layout>
  <style>
    .relative:hover form {
        opacity: 1;
        pointer-events: auto;
    }
    .thebody{
      display:flex;
      justify-content:center;
      align-items:center;
      margin:20px auto;
      padding:20px;
      max-height:100vh;
      width:80%;
    }
    #myimage{
      margin:15px;
      width:70%;
      float:left;
      max-width:320px;
      max-height:320px;
    }
    .wrapper{
      margin:10px auto;
    }
    .text-box{
      color:white;
    }
  </style>
    <x-slot name="header">
        <h2 class=" flex font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <!-- <a href="{{ route('dashboard')}}" class="w-7 h-7 mr-5  flex hover:border-black motion-safe:hover:scale-[1.1] transition-all duration-250">
              <img src="{{asset('retour.png')}}">
            </a> -->
            <span>
              <span>{{ __('batiment ')}}</span><span class="uppercase text-myyellow">{{ $batiment->name}}</span>
            </span>
        </h2>
    </x-slot>


<div class="thebody bg-cyan-900 rounded-lg">
    <div class="wrapper ">
      <img id="myimage" class="rounded-lg" src="/images/{{$batiment->image}}" alt="">
      <div class="text-box">
        <p>
          le batiment <span class="text-4xl">{{$batiment->name}}</span> contient <span class="text-7xl">{{$batiment->nbetage}}</span> etage(s) ,son reseau est de classe <span class="text-4xl">{{$batiment->type_reseaux}}</span> avec une adresse <span class="text-4xl">{{$batiment->adresse_reseau}}</span>
        </p><br>
            <h1 class="text-center text-xl font-semibold py-2 h-10">Descreption</h1>
        {{$batiment->descr}}
      </div>
    </div>
</div>

    <div class="w-10/12 m-auto p-6 lg:p-8 pb-0 grid gap-6  grid-cols-2 md:grid-cols-2" >
      <!-- etages -->
        <div class="mt-auto grid grid-cols-1 md:grid-cols-1">
            <a href="{{ route('etage.create', $batiment->id) }}" style="border-bottom-width: 1px;" class="border-x-2 border-t-2 p-2 rounded-b-none  bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex hover:border-black motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2">
              <div class="size-full flex justify-center scale-105">
                <img class="h-7 w-7"  src="{{asset('plus.png')}}">
              </div>
            </a>
            @foreach($etages as $eta) 
            <a href="{{ route('etage.show',$eta->id) }}" style="border-top-width: 1px;border-bottom-width: 1px;" class="rounded-none border-x-2 p  bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex hover:border-black motion-safe:hover:scale-[1.01]  transition-all duration-250 focus:outline focus:outline-2">
              <div class=" size-full flex justify-center px-0 pt-4 px-4  relative ">
                <form action="{{route('etage.destroy',[$eta->id,$batiment->id])}}" method="post"  class="absolute top-3 right-3 opacity-0 pointer-events-none transition-opacity duration-300">
                  @csrf
                  @method('delete')
                  <button type="submit"><img src="{{asset('fermer.png')}}" class="h-6 w-6"></button>
                </form>
                <form action="{{route('etage.edit',[$eta->id,$batiment->id])}}" class="absolute bottom-3 right-3 opacity-0 pointer-events-none transition-opacity duration-300">
                  <button type="submit"><img src="{{asset('editer.png')}}" class="h-6 w-6"></button>
                </form>
                <span class="mt-0 absolute top-0"> -  etage n° {{$eta->num}}  -</span>
                <div class="h-32 px-4 py-4 flex flex-wrap overflow-auto">
                  @for ($i = 1; $i <= $eta->nbbureau; $i++)
                  <div class="bg-cyan-900 w-10 h-10 mx-1 text-center p-2">B:{{ $i }}</div>
                  @endfor
                </div>
              </div>
            </a>
            @endforeach 
            <div href="" class="border-x-2 border-t-2 p-2 rounded-none  bg-white">
              <div class="size-full flex justify-center scale-105">
              </div>
            </div>
        </div>
        <!-- switchs -->
        <div class="w-2/3 m-auto grid grid-cols-1 md:grid-cols-1 border-black border-x-2 bg-stone-800">
            <a href="{{ route('commutateur.create', $batiment->id) }}" style="border-bottom-width: 1px;" class=" border-black border-t-2 p-2 h-12 rounded-none  bg-stone-800 dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex hover:border-black motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2">
              <div class="size-full flex justify-center scale-105">
                <img class="h-7 w-7"  src="{{asset('plusblanc.png')}}">
              </div>
            </a>
            @foreach($commutateurs as $com) 
            <div style="border-top-width: 1px;border-bottom-width: 1px;" class="mt-1 border-black  mx-2 text-white rounded-none border-x-2 bg-stone-800 dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5  shadow-2xl shadow-gray-500/20 dark:shadow-none flex hover:border-black motion-safe:hover:scale-[1.01]  transition-all duration-250 focus:outline focus:outline-2">
              <div class=" size-full flex justify-center px-0 pt-4 px-4  relative">
                <form action="{{route('commutateur.destroy',[$com->id,$batiment->id])}}" method="post"  class="absolute top-3 right-3 opacity-0 pointer-events-none transition-opacity duration-300">
                  @csrf
                  @method('delete')
                  <button type="submit"><img src="{{asset('closeblanc.png')}}" class="h-6 w-6"></button>
                </form>
                <span class="mt-0 absolute top-0"> -  commutateur n°{{$com->num}} -</span>
                <div class="px-4 py-4 max-h-24 overflow-auto flex flex-wrap ">
                  @for ($i = 1; $i <= $com->nbport; $i++)
                  <div class="bg-cyan-900 w-5 h-5 mx-1 text-center p-2 flex items-center" style="font-size:10px;">{{ $i }}</div>
                  @endfor
                </div>
              </div>
            </div>
            @endforeach 
            <div  class=" border-b-2 border-black p-2 rounded-none  bg-stone-800">
              <div class="size-full flex justify-center scale-105">
              </div>
            </div>
        </div>
    </div>
    <hr>
</x-app-layout>

