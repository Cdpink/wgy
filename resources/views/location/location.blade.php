@extends('navbar.nav1')
@section('title', 'Location - Waggy')
@section('body-class', 'bg-[#191B21]')

@section('content')
    <style>
        #mainContent::-webkit-scrollbar {
            width: 0px;
        }

        .location-item {
            transition: background-color 0.2s, color 0.2s;
            text-decoration: none !important;
            font-size: 1.12rem;
        }

        .location-item:hover {
            color: #2D5BFF !important;
            background-color: #1F222A;
            text-decoration: none !important;
        }

        ul li.location-item a {
            text-decoration: none !important;
        }

        ul {
            list-style: none;
        }

        a,
        a:hover,
        a:focus,
        a:active {
            text-decoration: none !important;
        }
    </style>

    <div class="min-h-screen flex">

        <!-- MAIN CONTENT -->
        <main id="mainContent" class="flex-1 ml-72 mr-[300px] px-6 pt-28 max-w-[700px] mx-auto">

            <div class="flex items-center mb-4">
                <a href="#" id="backBtn" class="flex items-center text-white no-underline">
                    <h3 class="bi bi-chevron-left text-7xl inline-block">Location</h3>
                </a>
            </div>


            <!-- Luzon -->
            <div class="mt-5">
                <h3 class="font-semibold mb-3 text-lg text-white">Luzon</h3>
                <ul class="list-none p-0">
                    <li class="location-item py-3 px-2 border-b border-[#2A2D35] cursor-pointer text-white"
                        data-province="Pampanga (Central Luzon)">
                        Pampanga
                    </li>
                    <li class="location-item py-3 px-2 border-b border-[#2A2D35] cursor-pointer text-white"
                        data-province="Cavite (CALABARZON)">
                        Cavite
                    </li>
                    <li class="location-item py-3 px-2 border-b border-[#2A2D35] cursor-pointer text-white"
                        data-province="Laguna">
                        Laguna
                    </li>
                </ul>
            </div>
        </main>

        @section('left-sidebar')
            <a href="../frontend/profile.php" id="profile" class="no-underline flex items-center gap-3 mt-4">
                <img id="petImage" src="./assets/img/hero.png" alt="profile"
                    class="rounded-full w-[50px] h-[50px] object-cover bg-[#333]">
                <div>
                    <h6 id="petName" class="text-white font-semibold mb-2 text-lg">Pet Name</h6>
                    <small id="petBreed" class="text-gray-400 text-base">Breed</small>
                </div>
            </a>

            <!-- breeding -->
            <a href="#" class="no-underline flex items-center gap-4 mt-5 p-2 rounded hover:bg-[#1F222A]">
                <i class="bi bi-heart text-white text-lg"></i>
                <h5 class="text-white mb-0 text-base mt-1">Breeding</h5>
            </a>

            <!-- playdate -->
            <a href="#" class="no-underline flex items-center gap-4 mt-3 p-2 rounded hover:bg-[#1F222A]">
                <i class="bi bi-calendar-event text-white text-lg"></i>
                <h5 class="text-white mb-0 text-base mt-1">Play Date</h5>
            </a>
        @endsection

        @section('right-sidebar')
            <h6 class="text-white font-semibold mb-4">Contacts</h6>
            <div class="flex flex-col gap-2">
                <div class="text-gray-400 text-sm">

                </div>
            </div>
        @endsection

    </div>

    @push('scripts')
        <script>
            // Back button
            document.getElementById('backBtn').addEventListener('click', function (e) {
                e.preventDefault();
                window.history.back();
            });

            // Location items click handler
            const locationItems = document.querySelectorAll('.location-item');
            locationItems.forEach(item => {
                item.addEventListener('click', function () {
                    const province = this.getAttribute('data-province');
                    console.log('Province selected:', province);

                    // Save to localStorage for homepage to read
                    localStorage.setItem('selectedProvince', province);

                    // Redirect to homepage
                    window.location.href = '/home?province=' + encodeURIComponent(province);
                });
            });
        </script>
    @endpush

@endsection