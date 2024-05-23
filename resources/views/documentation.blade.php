
    <x-app-layout>
    <div >
    <div id="toggleNavIcon" class="block md:hidden fixed top-36 left-8 bg-white rounded-full p-2 cursor-pointer">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
        </svg>
    </div>
    <nav id="mininav" style="background-color:rgb(243,244,246);" class="pt-10 w-1/4 float-left grid hidden md:block">
        <button id="closeNavBtn" class="hidden md:hidden float-right mt-2 mr-2">
        <img src="{{asset('fermer.png')}}" class="h-6 w-6 float-right"></button>
        <div id="navcontainer">
            <div class="space-x-8 md:-my-px md:ms-10 md:flex">
                <x-nav-link href="#intro"  :active="request()->routeIs('dashboard')">
                    <div class="text-lg textnav">
                        Introduction
                    </div>
                </x-nav-link>
            </div>
            <div class="space-x-8 md:-my-px md:ms-10 md:flex">
                <x-nav-link href=" #pp" :active="request()->routeIs('dashboard')">
                    <div class="text-lg textnav">
                        Première page
                    </div>
                </x-nav-link>
            </div>        
            <div class="space-x-8 md:-my-px md:ms-10 md:flex">
                <x-nav-link href="#enregistrement" :active="request()->routeIs('dashboard')">
                    <div class="text-lg textnav">
                        Enregistrement
                    </div>
                </x-nav-link>
            </div>        
            <div class="space-x-8 md:-my-px md:ms-10 md:flex">
                <x-nav-link href="#batiment" :active="request()->routeIs('dashboard')">
                    <div class="text-lg textnav">
                        Batiment
                    </div>
                </x-nav-link>
            </div>        
            <div class="space-x-8 md:-my-px md:ms-10 md:flex">
                <x-nav-link href="#commutateur" :active="request()->routeIs('dashboard')">
                    <div class="text-lg textnav">
                        Commutateur
                    </div>
                </x-nav-link>
            </div>        
            <div class="space-x-8 md:-my-px md:ms-10 md:flex">
                <x-nav-link href="#etage" :active="request()->routeIs('dashboard')">
                    <div class="text-lg textnav">
                        Etage
                    </div>
                </x-nav-link>
            </div>
            <div class="space-x-8 md:-my-px md:ms-10 md:flex">
                <x-nav-link href="#bureau" :active="request()->routeIs('dashboard')">
                    <div class="text-lg textnav">
                        Bureau
                    </div>
                </x-nav-link>
            </div>        
            <div class="space-x-8 md:-my-px md:ms-10 md:flex">
                <x-nav-link href="#port" :active="request()->routeIs('dashboard')">
                    <div class="text-lg textnav">
                        Port
                    </div>
                </x-nav-link>
            </div>
        </div>
    </nav>
    
    <div id="main-content" style="border-left: 1px solid black;" class="float-right  z-0 md:w-3/4">
        <div class="thebody  rounded-lg">
            <div class="wrapper p-1">
                <h1>Documentation de <span style="color:rgb(246,197,37);" class="font-bold m-1">Batiport</span></h1> 
                <h2 id="intro"><span style="color:rgb(61,242,196);" class="text-2xl font-bold m-1">Introduction</span></h2>
                <p>
                    Batiport est une application centralisée permettant la création et la gestion efficace de bâtiments, d'étages, de bureaux et de ports. Les utilisateurs peuvent suivre les occupants, planifier la maintenance, gérer les ressources et générer des rapports pour optimiser les performances. Grâce à son interface conviviale et ses fonctionnalités complètes, Batiport simplifie la gestion immobilière tout en améliorant l'efficacité opérationnelle.
                </p>
                
                <div class="entite">
                    <h2 id="pp"><span style="color:rgb(61,242,196);" class="text-2xl font-bold m-1">Première page</span></h2>
                    <p>Lorsque vous ouvrez Batiport, vous êtes accueilli par une interface intuitive présentant toutes les fonctionnalités de gestion immobilière, de la création des entités à la gestion des occupants et des ressources.</p>
                    <img class="myimage image rounded-lg" src="{{asset('Batiport/1.png')}}" alt="">
                    <p>Si vous avez déjà un compte, il vous suffit de cliquer sur "Log in", puis de saisir votre e-mail et votre mot de passe dans le formulaire qui s'affichera. Une fois connecté, vous accéderez à votre application.</p>
                </div>
                
                <div class="entite">
                    <h2 id="enregistrement"><span style="color:rgb(61,242,196);" class="text-2xl font-bold m-1">Enregistrement</span></h2>
                    <p>Pour créer un compte, il vous suffit de cliquer sur "Register". C'est aussi simple que ça !</p>
                    <img class="myimage image rounded-lg" src="{{asset('Batiport/2.png')}}" alt="">
                    <p>Vous serez dirigé vers un formulaire où vous pouvez entrer vos informations. Une fois cela fait, il vous suffit de cliquer sur le bouton "REGISTER" pour finaliser votre inscription.</p>
                    <img class="myimage image rounded-lg" src="{{asset('Batiport/3.png')}}" alt="">
                </div>
                
                
                <div class="entite">
                    <h2 id="batiment"><span style="color:rgb(61,242,196);" class="text-2xl font-bold m-1">Batiment</span></h2>
                    <p>Une fois dans votre espace, pour créer un bâtiment, il vous suffit de cliquer sur le symbole <img width="20px" height="20px" class="bg-white inline " src="{{asset('plus.png')}}" alt="" srcset=""> pour accéder au formulaire de création d'un bâtiment.</p>
                    <img class="myimage image rounded-lg" src="{{asset('Batiport/4.png')}}" alt="">
                    <p>Dans le formulaire, vous devrez fournir les informations fondamentales requises pour créer un bâtiment.</p>
                    <ul>
                        <li>Nom</li>
                        <li>Description</li>
                        <li>Photo</li>
                        <li>Classe de réseau (dépendant du nombre de machines désirées dans votre bâtiment)</li>                        
                        <li>Adresse réseau</li>
                    </ul>
                    <img class="myimage image rounded-lg" src="{{asset('Batiport/5.png')}}" alt="">
                    <p>Une fois que vous avez rempli les informations nécessaires, il vous suffit de cliquer sur "REGISTER" pour enregistrer votre bâtiment.</p>
                    <p>Et voilà, votre bâtiment a été créé !</p>
                </div>
                <div class="entite">
                    <h2 id="commutateur"><span style="color:rgb(61,242,196);" class="text-2xl font-bold m-1">Commutateur</span></h2>
                    <p>Le commutateur est un composant essentiel dans notre application. Son rôle est d'organiser les ports selon un ordre spécifié. Il sert de point de connexion pour les ports, et vous pouvez en créer autant que nécessaire. <br>Cependant, veillez à ce que chaque commutateur ait un numéro unique.
                    <br>
                    Cette zone en gris foncé est dédiée à la présentation, la création ou la suppression des commutateurs. <br>
                    Pour créer un commutateur, il vous suffit de cliquer sur le symbole <img width="20px" height="20px" class="bg-stone-800 inline " src="{{asset('plusblanc.png')}}" alt="" srcset=""> dans la partie conviviale de l'interface. 
                    </p>
                    <img class="myimage image rounded-lg" src="{{asset('Batiport/6.png')}}" alt="">
                    <p>
                        Les informations nécessaires pour un commutateur sont son numéro et le nombre de ports. Vous devez les saisir dans le formulaire qui s'affichera.
                    </p>
                    <img class="myimage image rounded-lg" src="{{asset('Batiport/7.png')}}" alt="">
                    <p>
                        Une fois votre commutateur créé, si vous souhaitez le supprimer, vous remarquerez qu'en survolant le commutateur, cette icône <img width="20px" height="20px" class="bg-stone-800 inline " src="{{asset('closeblanc.png')}}" alt="" srcset=""> apparaîtra en cliquant sur cette croix, le commutateur sera supprimé.
                    </p>
                    <img class="myimage image rounded-lg" src="{{asset('Batiport/8.png')}}" alt="">
                </div>   
                
                <div class="entite">
                    <h2 id="etage"><span style="color:rgb(61,242,196);" class="text-2xl font-bold m-1">Etage</span></h2>
                    Cette zone en blanc est dédiée à la présentation, la création, la modification ou la suppression des étages dans le bâtiment concerné. Pour créer un étage, il vous suffit de cliquer sur le symbole <img width="20px" height="20px" class="bg-white inline " src="{{asset('plus.png')}}" alt="" srcset=""> dans la partie conviviale de l'interface (à gauche).
                    <img class="myimage image rounded-lg" src="{{asset('Batiport/8.png')}}" alt="">
                    Cette interface s'affichera pour remplir les données nécessaires pour un étage. Cliquez sur "REGISTER" pour enregistrer votre étage.
                    <img class="myimage image rounded-lg" src="{{asset('Batiport/9.png')}}" alt="">
                    <p>Voilà, c'est créé. Si vous souhaitez le modifier ou le supprimer, vous devez survoler l'étage dans la partie conviviale. Deux icônes vont apparaître : <br> <img width="20px" height="20px" class="bg-white inline " src="{{asset('fermer.png')}}" alt="" srcset=""> pour supprimer <br><img width="20px" height="20px" class="bg-white inline " src="{{asset('editer.png')}}" alt="" srcset="">  pour modifier.</p>
                    <img class="myimage image rounded-lg" src="{{asset('Batiport/10.png')}}" alt="">
                    <p>En cliquant dessus, vous accéderez à une interface représentant tous les bureaux situés dans cet étage.</p>
                </div>
                <div class="entite">
                    <h2 id="bureau"><span style="color:rgb(61,242,196);" class="text-2xl font-bold m-1">Bureau</span></h2>
                    "De la même manière, si vous souhaitez créer un bureau, vous devez cliquer sur <img width="20px" height="20px" class="bg-white inline " src="{{asset('plus.png')}}" alt="" srcset=""> un formulaire va s'afficher pour entrer le information nécessaire.
                    Si vous souhaitez le modifier ou le supprimer, vous devez survoler le bureau dans la partie conviviale. Deux icônes vont apparaître : <br> <img width="20px" height="20px" class="bg-white inline " src="{{asset('fermer.png')}}" alt="" srcset=""> pour supprimer <br><img width="20px" height="20px" class="bg-white inline " src="{{asset('editer.png')}}" alt="" srcset="">  pour modifier.
                    <p>Pour le gérer, vous devez cliquer sur le bureau.</p>
                    <img class="myimage image rounded-lg" src="{{asset('Batiport/11.png')}}" alt="">
                    <p>Le clic sur un bureau vous dirigera vers cette interface, qui contient tous les ports présents dans ce bureau.</p>
                    <img class="myimage image rounded-lg" src="{{asset('Batiport/13.png')}}" alt="">
                </div>
                <div class="entite">
                    <h2 id="port"><span style="color:rgb(61,242,196);" class="text-2xl font-bold m-1">Port</span></h2>
                    <p>
                        De même, pour créer un port, vous allez cliquer sur <img width="20px" height="20px" class="bg-white inline " src="{{asset('plus.png')}}" alt="" srcset=""><br>Si vous souhaitez activer un port, vous devez le cliquer, ce qui fera apparaître une boîte d'alerte.<br> Vous devrez ensuite entrer le numéro du commutateur auquel vous souhaitez connecter ce port.
                    </p>
                    <img class="myimage image rounded-lg" src="{{asset('Batiport/15.png')}}" alt="">
                    <p>Votre port est maintenant activé. <br> Si vous souhaitez obtenir des informations, il vous suffit de survoler le port, ce qui affichera une petite fenêtre contenant toutes les informations sur ce port.</p>
                    <img class="myimage image rounded-lg" src="{{asset('Batiport/16.png')}}" alt="">
                </div>
            </div>
        </div>
    </div>

    <div id="blurOverlay" class="blur-overlay"></div>
    </div>
</x-app-layout>
    <style>
        #navcontainer{
            padding-left:10%;
        }
        .textnav{
            padding-top:20px;
            width: 200px;
            margin-left:0px;
            text-align:center;
        }
        #mininav{
            height:100%;
        }

        .entite{
            margin-right:15px;
            margin-left:15px;
        }
        h1{
            font-size:50px;
        }
        h2{
            font-weight:700;
            font-size:25px;
            margin-top:15px;
            margin-bottom:13px;
        }
        .nav-fixe {
        position: fixed;
        top: 0;
        left: 0;
        z-index: 100;
        }
        .relative:hover form {
            opacity: 1;
            pointer-events: auto;
        }
        .thebody{
        background-color:rgb(243,244,246);
        display:flex;
        justify-content:center;
        align-items:center;
        margin:20px auto;
        padding:20px;
        }
        .myimage{
        margin:10px auto;
        margin-top:20px;
        margin-bottom:40px;
        }
        .wrapper{
        margin:10px auto;
        }
        .text-box{
        color:white;
        }
        x-app-layout{
             background-color:blue;
        }
        /* Superposition floue */
        .blur-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Couleur de fond semi-transparente */
            backdrop-filter: blur(5px); /* Flou de l'arrière-plan */
            z-index: 999; /* Assurez-vous que la superposition est au-dessus de tout le reste */
            display: none; /* Par défaut, la superposition est cachée */
        }

        /* Désactiver les événements de clic sur la superposition */
        .blur-overlay.active {
            display: block;
            pointer-events: auto;
        }

        /* Flouter le contenu principal lorsque le nav est ouvert */
        #main-content.blur {
            filter: blur(5px);
        }
    </style>
        <!-- Script JavaScript pour basculer la visibilité du nav -->
    <script>
        var nav = document.getElementById('mininav');
        var toggleNavIcon = document.getElementById('toggleNavIcon');
        var closeNavBtn = document.getElementById('closeNavBtn');
        var blurOverlay = document.getElementById('blurOverlay');
        var mainContent = document.getElementById('main-content');

        function toggleNav() {
            nav.classList.toggle('hidden');
            toggleNavIcon.classList.toggle('hidden');
            closeNavBtn.classList.toggle('hidden');
            if (window.innerWidth <= 1024) {
                mainContent.classList.toggle('blur');
            }
        }

        toggleNavIcon.addEventListener('click', function() {
            toggleNav();
        });

        closeNavBtn.addEventListener('click', function() {
            toggleNav();
        });

        window.addEventListener('resize', function() {
            if (window.innerWidth > 1024) {
                mainContent.classList.remove('blur');
                nav.classList.remove('hidden');
                toggleNavIcon.classList.remove('hidden');
                closeNavBtn.classList.add('hidden');
            }
            else
            {
                nav.classList.add('hidden');
            }
        });
        window.addEventListener('scroll', () => {
        if (window.scrollY > 0) {
            nav.classList.add('nav-fixe');
        } else {
            nav.classList.remove('nav-fixe');
        }
        }); 

        window.addEventListener('resize', function() {
            if (window.innerWidth <= 768 ) {
                const element = document.querySelector('#mininav');
            }
            });

    </script>
