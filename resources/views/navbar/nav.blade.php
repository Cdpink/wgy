<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Waggy')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            background-color: #191B21;
            overflow: hidden;
        }

        /* NAV */
        .home-nav {
            background-color: #282C36;
            height: 70px;
        }
        .home-navlinks {
            color: rgba(255,255,255,0.7);
            padding: 8px 16px;
            border-radius: 8px;
            transition: .2s;
            text-decoration: none;
        }
        .home-navlinks:hover {
            background-color: rgba(255,255,255,0.1);
            color: white;
        }

        /* SIDEBAR */
        #left-sidebar {
            width: 280px;
            height: calc(100vh - 70px);
            position: fixed;
            top: 70px;
            left: 0;
            background-color: #191B21;
            border-right: 1px solid rgba(255,255,255,0.05);
            overflow-y: auto;
            z-index: 2;
            padding: 1.5rem;
        }

        /* MAIN CONTENT (EXTEND) */
       .main-wrapper {
        position: absolute;
        top: 70px;
        left: 280px;
        right: 0;                 /* ← Important para hindi sumagad */
        height: calc(100vh - 70px);
        overflow-y: auto;
        padding: 1.5rem 2.5rem;   /* ← dagdag spacing sa kanan */
        background-color: #1B1E25;
    }

    .home-navlinks.active {
        background-color: rgba(255,255,255,0.12);
        color: #fff;
    }

    /* CHAT DRAWER PANEL */
    #chatDrawer {
        width: 320px;
        height: 100vh;
        background:#191B21;
        position: fixed;
        top: 0;
        right: -350px;                /* HIDDEN STATE */
        transition: .3s ease;
        border-left: 1px solid rgba(255,255,255,0.07);
        z-index: 9999;
        color:white;
    }

    #chatDrawer.open {
        right: 0;                     /* SHOW WHEN OPEN */
    }

    .chat-item:hover {
        background: rgba(255,255,255,0.08);
    }



    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="home-nav d-flex align-items-center px-4" style="height:70px;">
        <a class="d-flex align-items-center text-decoration-none" href="#">
            <img src="{{ asset('assets/logo.png') }}" style="height:40px;" class="me-2">
            <div class="d-flex flex-column">
                <span class="text-white fw-semibold">Waggy</span>
                <small class="text-white" style="font-size: .7rem;">Community</small>
            </div>
        </a>

        <div class="d-flex align-items-center gap-4 mx-auto">

            <a href="{{ route('home') }}" class="home-navlinks fs-4 {{ request()->routeIs('home') ? 'active' : '' }}">
                <i class="bi bi-house"></i>
            </a>

            <a href="{{ route('friend-requests') }}" class="home-navlinks fs-4 {{ request()->routeIs('friend-requests') ? 'active' : '' }}">
                <i class="bi bi-person-add"></i>
            </a>

            <a href="{{ route('messages') }}" class="home-navlinks fs-4 {{ request()->routeIs('messages') || request()->routeIs('messages.*') ? 'active' : '' }}">
                <i class="bi bi-chat-dots"></i>
            </a>

            <a href="{{ route('location') }}" class="home-navlinks fs-4 {{ request()->routeIs('location') ? 'active' : '' }}">
                <i class="bi bi-geo-alt"></i>
            </a>

            <a href="{{ route('notifications') }}" class="home-navlinks fs-4 {{ request()->routeIs('notifications') ? 'active' : '' }}">
                <i class="bi bi-bell"></i>
            </a>

        </div>

        <div class="d-flex align-items-center gap-3">
            <button class="btn btn-link text-white p-0" style="font-size:20px; opacity:.7;">
                <i class="bi bi-search"></i>
            </button>

            <!-- PROFILE DROPDOWN -->
            <div class="position-relative">
                <a href="#" id="profileDropdown" class="d-flex align-items-center gap-2 text-decoration-none">
                    <img src="{{ auth()->user()->avatar ? asset('storage/'.auth()->user()->avatar) : asset('assets/usericon.png') }}"
                         style="width:36px; height:36px; border-radius:50%; object-fit:cover;">
                    <i class="bi bi-chevron-down text-white" style="font-size:12px;"></i>
                </a>

                <ul id="dropdownMenu" class="dropdown-menu dropdown-menu-end" style="display:none;">
                    <li><a class="dropdown-item" href="{{ route('setting') }}"><i class="bi bi-gear me-2"></i>Settings</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                    <a class="dropdown-item" href="#"
                      onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                    </a>
                </li>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                      @csrf
                  </form>

                </ul>
            </div>
        </div>
    </nav>


    <!-- RIGHT CHAT DRAWER (HIDDEN BY DEFAULT) -->
    <div id="chatDrawer">
        <div class="chat-header d-flex justify-content-between align-items-center px-3 py-2">
            <h5 class="m-0 text-white">Chats</h5>
            <button id="closeChat" class="btn text-white"><i class="bi bi-x-lg"></i></button>
        </div>

        <div class="chat-search p-2">
            <input type="text" class="form-control form-control-sm text-black"
                placeholder="Search Messenger.." style="background:white;border:none;">
        </div>

        <div class="chat-list p-2">
            <!-- SAMPLE CHAT LIST -->
            <div class="chat-item d-flex align-items-center p-2 rounded" style="cursor:pointer;">
                <img src="{{ asset('assets/usericon.png') }}" width="40" height="40" class="rounded-circle me-2">
                <div>
                    <b class="text-white">Sample User</b><br>
                    <small class="text-secondary">Hello there!</small>
                </div>
            </div>
        </div>
    </div>


    <!-- SIDEBAR -->
    <div id="left-sidebar">

        <a href="{{ route('profile') }}" class="d-flex align-items-center gap-3 text-decoration-none mb-4">
            <img src="{{ auth()->user()->avatar ? asset('storage/'.auth()->user()->avatar) : asset('assets/usericon.png') }}"
                 style="width:50px; height:50px; border-radius:50%; object-fit:cover;">
            <div>
                <h5 class="text-white m-0">{{ auth()->user()->pet_name }}</h5>
                <small class="text-white">{{ auth()->user()->pet_breed }}</small>
            </div>
        </a>

        <a href="#" class="d-flex align-items-center gap-3 p-2 text-decoration-none rounded">
            <i class="bi bi-heart text-white fs-5"></i>
            <span class="text-white">Breeding</span>
        </a>

        <a href="#" class="d-flex align-items-center gap-3 p-2 text-decoration-none mt-3 rounded">
            <i class="bi bi-calendar-event text-white fs-5"></i>
            <span class="text-white">Play Date</span>
        </a>

    </div>

    <!-- MAIN CONTENT (WHERE OTHER PAGES GO) -->
    <div class="main-wrapper">
        @yield('content')
    </div>

    <script>
        const profileBtn = document.getElementById("profileDropdown");
        const menu = document.getElementById("dropdownMenu");

        profileBtn.onclick = function(e){
            e.preventDefault();
            menu.style.display = menu.style.display === "block" ? "none" : "block";
        }

        document.addEventListener("click", function(e){
            if(!profileBtn.contains(e.target)) menu.style.display = "none";
        });

        const msgBtn = document.querySelector("a[href='{{ route('messages') }}']"); // Message icon
        const chatDrawer = document.getElementById("chatDrawer");
        const closeChat = document.getElementById("closeChat");

        msgBtn.addEventListener("click", (e) => {
            e.preventDefault();
            chatDrawer.classList.add("open");
        });

        closeChat.addEventListener("click", () => {
            chatDrawer.classList.remove("open");
        });
    </script>

</body>
</html>
