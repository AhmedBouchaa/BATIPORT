<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mes batiments') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
             @foreach($batiments as $bat) 
            <a href="{{ route('batiment.show',$bat->id)}}" class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2">
                <div class=" w-full flex flex-nowrap text-center" style="color:rgb(31,41,76)">
                    <div class="w-2/6">
                        <img class="w-60 h-60" src="/images/{{$bat->image}}">
                    </div>
                    <div class="w-4/6 h-60">
                        <form action="{{route('batiment.destroy',$bat->id)}}" method="post" class="absolute top-3 right-3">
                        @csrf
                        @method('delete')
                        <button type="submit"><img src="{{asset('fermer.png')}}" class="h-6 w-6"></button>
                        </form>
                        <article class="text-nowwrap">
                          <h1 class="mt-3 text-left pl-8 text-2xl uppercase">{{$bat->name}}</h1>
                          <div class="text-left text-ellipsis pl-7 overflow-hidden h-3/5 mt-1">
                                @php
                                    $idsEtages = App\Models\Etage::where('batiment_id', $bat->id)->pluck('id')->toArray();
                                    $idsBureaux = App\Models\Bureau::whereIn('etage_id', $idsEtages)->pluck('id')->toArray();
                                    $nbreBureauxDansBatiment=count($idsBureaux);
                                    $nombrePortsActifs =  App\Models\Port::whereIn('bureau_id', $idsBureaux)->where('active', true)->count();
                                    $nombrePortsInactifs =  App\Models\Port::whereIn('bureau_id', $idsBureaux)->where('active', false)->count();
                                @endphp
                                Ce batiment contient <span class="text-xl">{{$bat->nbetage}}</span> etage(s) ,son reseau est de classe <span class="text-xl">{{$bat->type_reseaux}}</span> avec une adresse <span class="text-xl">{{$bat->adresse_reseau}}</span>
                                <ul>
                                    <li>nombre d'etage(s) etage : {{$bat->nbetage}}</li>
                                    <li>nombre totale de bureau : {{$nbreBureauxDansBatiment}}</li>
                                    <li>nombre de port active: {{$nombrePortsActifs}}</li>
                                    <li>nombre de port inactive :{{$nombrePortsInactifs}}</li>
                                </ul>
                          </div>                         
                        </article>
                        <form action="{{route('batiment.edit',$bat->id)}}" class="absolute bottom-8 right-8">
                            <x-primary-button type="submit">Edit</x-primary-button>
                        </form>
                    </div>
                </div>            
            </a>
            @endforeach 
            <a href="{{route('batiment.create')}}" class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:border-2 border-myyellow ">
                <div class="size-full flex justify-center py-24" style="color:rgb(31,41,76)">
                    <img class="h-7 w-7"  src="{{asset('plus.png')}}">
                </div>
            </a>
        </div>
    </div>
</x-app-layout>
