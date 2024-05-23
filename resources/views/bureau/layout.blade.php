<x-app-layout>
    <style>
        .relative .port-details {
            display: none;
            position: absolute;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 10px;
            border-radius: 5px;
            z-index: 1;
        }

        .relative:hover .port-details {
            display: block;
        }
        @keyframes fadeOut {
            from {
                opacity: 1;
            }
            to {
                opacity: 0;
            }
        }

        .fade-out {
            animation: fadeOut 6s ease-in-out;
        }
    </style>
    </style>
        <x-slot name="header">
        <h2 class=" flex font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <a href="{{ route('etage.show',$bureau->etage_id)}}" class="w-7 h-7 mr-5  flex hover:border-black motion-safe:hover:scale-[1.1] transition-all duration-250">
              <img src="{{asset('retour.png')}}">
            </a>
            <span>
              <span>{{ __('bureau ')}}</span><span class=" text-myyellow">n° {{$bureau->num}}</span>
            </span>
        </h2>
    </x-slot>
    <h1 style="color:rgb(31,41,76);" class="mt-9 text-center text-xl font-semibold uppercase truncate py-2 h-10">{{$bureau->titre}}</h1>
    <div style="background-color:rgb(31,41,76);" class="w-1/3 p-1  my-10 mx-auto grid grid-cols-6">
        @foreach($ports as $port)
        @if($port->active==true)
            <div class="relative w-20 h-20 bg-green-300 border-2 border-white" style="background-image: url({{asset('port.png')}});background-size:contain;background-repeat:no-repeat;">
                <a href="{{ route('port.change',[$port->id,$bureau->id,$batiment_id])}}">
                    <div class="w-2 h-2 bg-green-900 relative top-4 left-14"></div>
                    <div class="text-white text-center mt-4">{{$port->num}}</div>
                </a>
                <div class="port-details w-56">
                    <p>Port: {{$port->num}}</p>
                    @php
                        $listipFound = false;
                        $com=  App\Models\Commutateur::find($port->commutateur_id);
                    @endphp

                    @foreach($listips as $listip)
                        @if($listip->port_id==$port->id)
                            <p>Adresse IP: {{$listip->adresseIP}}</p>
                            {{$listip->type_reseaux}}
                            @php
                                $listipFound = true;
                            @endphp
                            @break
                        @endif
                    @endforeach
                    <p>ce port est connecté avec le commmutateur n° {{$com->num}}</p>
                </div>
            </div>
        @else
        <div class="relative w-20 h-20 bg-red-300 border-2 border-white " style="background-image: url({{asset('port.png')}});background-size:contain;background-repeat:no-repeat;">
            <a href="#" onclick="promptForSwitchNumber('{{ route('port.change', [$port->id, $bureau->id, $batiment_id]) }}')">
                <div class="w-2 h-2 bg-red-900 relative top-4 left-3"></div>
                <div class="text-white text-center mt-4">{{$port->num}}</div>
            </a>
            <div class="port-details">
                <p>Port: {{$port->num}}</p>
            </div>
            </div>
            <script>
                function promptForSwitchNumber(route) {
                const switchNumber = prompt('Entrez le numéro du commutateur:');
                if (switchNumber !== null) {
                // Ajoutez le numéro du commutateur à la route et redirigez l'utilisateur
                window.location.href = `${route}?switchNumber=${switchNumber}`;
                }
                }
            </script>
        @endif
        @endforeach
        <a href="{{route('port.create',[$bureau->id,$batiment_id])}}" class="w-20 h-20 bg-white rounded-none  bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex hover:border-black motion-safe:hover:scale-[1.01]  transition-all duration-250 focus:outline focus:outline-2">
            <div class="size-full flex">
                <img class="h-7 w-7 my-auto mx-auto"  src="{{asset('plus.png')}}">
            </div>
        </a>
    </div>
    @if(session('error'))
        <div class="bg-red-200 rounded w-1/3 p-1  my-10 mx-auto text-center fade-out" id="error-message">
            {{ session('error') }}
        </div>
        <script>
            setTimeout(function() {
                document.getElementById('error-message').classList.add('hidden');
            }, 6000); // Ajoutez un délai de 1000 ms (1 seconde)
        </script>
    @endif
</x-app-layout>