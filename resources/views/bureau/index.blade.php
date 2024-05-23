extends('etage.layout')
@section('content')
<div class="mt-16">
    @if($message=Session::get('seccess') )
    <div class="alert alert-light" role="alert">
        {{$message}}
    </div>
    @endif

    <div class="grid grid-cols-1 gap-6">
        @foreach($etages as $eta)
        <a href="" class="mx-5 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2">
            <div class="size-full text-5xl text-center " style="color:rgb(31,41,76)">
                 {{$eta->id}}
            </div>            
        </a>
        @endforeach
    </div>
</div>