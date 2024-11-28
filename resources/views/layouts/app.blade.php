<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Hôpital</title>
    <meta name="author" content="David Grzyb">
    <meta name="description" content="">

    <!-- Tailwind CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    @livewireStyles
    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');
        .font-family-karla { font-family: karla; }
        .bg-sidebar { background: #808080; }
        .cta-btn { color: #808080; }
        .upgrade-btn { background: #808080; }
        .upgrade-btn:hover { background: #808080; }
        .active-nav-link { background: #808080; }
        .nav-item:hover { background: #808080; }
        .account-link:hover { background: #808080; }
        body {
            background-image: url("{{ asset('logo/.jpg') }}");
        }

        .w-custom {
            width: 23rem;
        }
        aside.w-16 {
            width: 4rem;
        }
        .hidden-text {
            display: none;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-gray-100 font-family-karla flex">

    <aside class="relative bg-sidebar h-screen w-custom hidden sm:block shadow-xl bg-clip-padding backdrop-filter backdrop-blur-xl bg-opacity-60 border border-gray-200">
        <div class="p-6">
            <div class="flex justify-between">
                <a href="#" id="dashboard-link" class="text-white text-sm font-semibold uppercase hover:text-white">Mon-hôpital</a>
                <i class="fas fa-bars text-white"></i>
            </div>
        </div>
        <nav class="text-white text-base font-semibold pt-3">
            <a href="{{ route('dashboard') }}" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-6 nav-item">
                <i class="fas fa-home mr-2"></i>
                <span class="nav-text">Accueil</span>
            </a>
            <div x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item focus:outline-none">
                    <i class="fas fa-users mr-2"></i>
                    <span class="nav-text">Gestion des patients</span>
                    <i :class="open ? 'fas fa-chevron-up' : 'fas fa-chevron-down'" class="ml-auto"></i>
                </button>
                <div x-show="open" class="pl-8">
                    <a href="{{ route('create') }}" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-6 nav-item">
                        <i class="fas fa-plus mr-2"></i>
                        <span class="nav-text">Ajouter un Patient</span>
                    </a>
                    
                    
                    <a href="{{ route('liste', ['medecinId' => auth()->guard('medecin')->user()->id]) }}" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-6 nav-item">
                        <i class="fas fa-user mr-2"></i>
                        Liste des patients
                    </a>
                    <a href="{{ route('affichage') }}" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-6 nav-item">
                        <i class="fas fa-table mr-2"></i>
                        <span class="nav-text">Affichage en temps réel</span>
                    </a>
                </div>
            </div>
            <div x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item focus:outline-none">
                    <i class="fas fa-sticky-note mr-2"></i>
                    <span class="nav-text">Gestion des Rendez-vous</span>
                    <i :class="open ? 'fas fa-chevron-up' : 'fas fa-chevron-down'" class="ml-auto"></i>
                </button>
                <div x-show="open" class="pl-8">
                    <a href="{{route('Rv_Ajouter')}}" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-6 nav-item">
                        <i class="fas fa-plus mr-2"></i>
                        <span class="nav-text">Ajouter un rendez-vous</span>
                    </a>
                    <a href="{{ route('appointements.index') }}" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-6 nav-item">
                        <i class="fas fa-user mr-2"></i>
                        <span class="nav-text">Liste des rendez-vous</span>
                    </a>
                </div>
            </div>
            <div x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item focus:outline-none">
                    <i class="fas fa-cog mr-2"></i>
                    <span class="nav-text">Paramètres</span>
                    <i :class="open ? 'fas fa-chevron-up' : 'fas fa-chevron-down'" class="ml-auto"></i>
                </button>
                <div x-show="open" class="pl-8">
                    <a href="{{ route('change-password') }}" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-6 nav-item">
                        <i class="fas fa-key mr-2"></i>
                        <span class="nav-text">Changement mot de passe</span>
                    </a>
                </div>
            </div>
        </nav>
    </aside>

    <div class="w-full flex flex-col h-screen overflow-y-hidden">
        <!-- En-tête de bureau -->
        <header class="w-full items-center bg-green-400 py-2 px-6 hidden sm:flex">
           <i class="fas fa-bars text-white"></i>
            <div class="w-1/2"></div>
            <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end">
             <div class="flex items-center">
                <button @click="isOpen = !isOpen" class="relative z-10 w-12 h-12 rounded-full overflow-hidden border-4 border-gray-400 hover:border-gray-300 focus:border-gray-300 focus:outline-none">
                    <img src="{{asset('logo/medecin1.jpeg')}}" alt="Image">
                    {{-- src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&color=ffffff&background=1E3A8A" style="border-radius:50%" --}}
                </button>
               <span class="ml-4 text-white">{{ auth()->guard('medecin')->user() ? auth()->guard('medecin')->user()->nom : "Non défini" }}</span>


                <button x-show="isOpen" @click="isOpen = false" class="h-full w-full fixed inset-0 cursor-default"></button>
                <div x-show="isOpen" class="absolute top-0 w-32 bg-white rounded-lg shadow-lg py-2 mt-16">
                    <a href="/" class="block px-4 py-2 account-link hover:text-white">Déconnexion</a>
                </div>
                </div>

            </div>
        </header>

        <!-- En-tête et navigation mobile -->
        <header x-data="{ isOpen: false }" class="w-full bg-sidebar py-5 px-6 sm:hidden">
            <div class="flex items-center justify-between">
                <a href="index.html" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Admin</a>
                <button @click="isOpen = !isOpen" class="text-white text-3xl focus:outline-none">
                    <i x-show="!isOpen" class="fas fa-bars"></i>
                    <i x-show="isOpen" class="fas fa-times"></i>
                </button>
            </div>
            <!-- Nav déroulant -->
            <!-- Ajoutez les éléments de navigation mobile ici si nécessaire -->
        </header>

        @yield('content')
    </div>

    @livewireScripts

    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
    <!-- ChartJS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>

    <script>
        function toggleSidebar() {
            var sidebar = document.querySelector('aside');
            sidebar.classList.toggle('w-custom');
            sidebar.classList.toggle('w-16');

            var navTexts = document.querySelectorAll('.nav-text');
            navTexts.forEach(function(text) {
                text.classList.toggle('hidden-text');
            });
        }

        document.getElementById('dashboard-link').addEventListener('click', toggleSidebar);
    </script>
</body>
</html>
