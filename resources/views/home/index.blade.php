@extends('navbar.nav1')
@section('title', 'Home - Waggy')
@section('body-class', 'bg-gray-900')

@section('content')
<div class="min-h-screen flex">


    <!-- MAIN CONTENT -->
   <main class="flex-1 ml-72 mr-[300px] px-6 pt-28 max-w-[900px] mx-auto">


        <!-- POST INPUT SECTION -->
        <section class="post p-4 mb-4" style="background-color:#292D37; border-radius:5px;">

            <div class="d-flex align-items-start mb-3">
               <img src="{{ auth()->user()->avatar ? asset('storage/'.auth()->user()->avatar) : asset('assets/usericon.png') }}"
                    alt="Profile"
                    class="rounded-circle me-3"
                    style="width:40px; height:40px; object-fit:cover; background:#333;">
                
               <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="w-100">
                @csrf

                <div class="d-flex align-items-center w-100 gap-3">

                    <!-- CLICK AREA THAT REDIRECTS TO FULL POSTING PAGE -->
                    <div onclick="window.location.href='{{ route('posting.page') }}'"
                        style="
                            flex:1; padding:12px 15px; background:#1B1E25;
                            border-radius:12px; color:#adb5bd; min-height:60px;
                            border:none; outline:none; resize:none; cursor:pointer;">
                        What's on your mind?
                    </div>

                    <!-- IMAGE REDIRECT TRIGGER -->
                  <div id="photoBtn"
                    class="text-white d-flex align-items-center justify-content-center"
                    style="cursor:pointer; width:50px; height:50px; background:#1B1E25; border-radius:12px;">
                    <i class="bi bi-image" style="font-size:26px;"></i>
                </div>

                </div>

                <!-- HIDDEN REAL TEXTAREA (used only when submitting from full post page) -->
                <textarea name="content" id="post-content" style="display:none;"></textarea>

                <!-- HIDDEN INPUT FOR FULL POST PAGE ONLY -->
                <input type="file" name="image" id="post-image" accept="image/*" style="display:none;">

            </form>

            </div>

            <!-- Filters -->
            <div id="filter-section" class="filter-container d-flex justify-content-around p-2">
               <div class="position-relative">
                    <button id="filter-age" class="btn btn-link text-white d-flex align-items-center gap-2">
                        <i class="bi bi-calendar fs-4"></i><span>Age</span>
                    </button>
                    
                    <!-- Age Dropdown with Scroll -->
                    <ul id="age-options" 
                        class="list-group position-absolute" 
                        style="display:none; 
                            max-height:250px; 
                            overflow-y:auto; 
                            width:180px;
                            z-index:1000;
                            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
                            border-radius:8px;">

                        <!-- MONTHS -->
                        <li class="list-group-item bg-dark text-white age-select" 
                            data-age="0.25" 
                            style="cursor:pointer; font-size:13px; padding:10px 15px;">
                            3 Months
                        </li>
                        <li class="list-group-item bg-dark text-white age-select" 
                            data-age="0.5" 
                            style="cursor:pointer; font-size:13px; padding:10px 15px;">
                            6 Months
                        </li>
                        <li class="list-group-item bg-dark text-white age-select" 
                            data-age="0.75" 
                            style="cursor:pointer; font-size:13px; padding:10px 15px;">
                            9 Months
                        </li>

                        <!-- YEARS -->
                        <li class="list-group-item bg-dark text-white age-select" 
                            data-age="1" 
                            style="cursor:pointer; font-size:13px; padding:10px 15px;">
                            1 Year Old
                        </li>
                        <li class="list-group-item bg-dark text-white age-select" 
                            data-age="2" 
                            style="cursor:pointer; font-size:13px; padding:10px 15px;">
                            2 Years Old
                        </li>
                        <li class="list-group-item bg-dark text-white age-select" 
                            data-age="3" 
                            style="cursor:pointer; font-size:13px; padding:10px 15px;">
                            3 Years Old
                        </li>
                        <li class="list-group-item bg-dark text-white age-select" 
                            data-age="4" 
                            style="cursor:pointer; font-size:13px; padding:10px 15px;">
                            4 Years Old
                        </li>
                        <li class="list-group-item bg-dark text-white age-select" 
                            data-age="5" 
                            style="cursor:pointer; font-size:13px; padding:10px 15px;">
                            5 Years Old
                        </li>
                        <li class="list-group-item bg-dark text-white age-select" 
                            data-age="6" 
                            style="cursor:pointer; font-size:13px; padding:10px 15px;">
                            6+ Years Old
                        </li>

                    </ul>
                </div>

                <div class="position-relative">
                    <button id="filter-breed" class="btn btn-link text-white d-flex align-items-center gap-2">
                        <i class="bi bi-tag fs-4"></i><span>Breed</span>
                    </button>
                    <ul id="breed-options" class="list-group position-absolute w-100" style="display:none;"></ul>
                </div>

                <div class="position-relative">
                    <button id="filter-location" class="btn btn-link text-white d-flex align-items-center gap-2">
                        <i class="bi bi-geo-alt fs-4"></i><span id="location-text">Location</span>
                    </button>
                    <ul id="location-options" class="list-group position-absolute" style="display:none; min-width:250px;"></ul>
                </div>

                <div class="position-relative">
                <button id="filter-type" class="btn btn-link text-white d-flex align-items-center gap-2">
                    <i class="bi bi-funnel fs-4"></i><span id="filter-type-text">All Posts</span>
                </button>
                <ul id="type-options" class="list-group position-absolute w-100" style="display:none;">
                    <li class="list-group-item bg-dark text-white type-select" data-type="all">All Posts</li>
                    <li class="list-group-item bg-dark text-white type-select" data-type="public">Public Posts</li>
                    <li class="list-group-item bg-dark text-white type-select" data-type="friends">Friends Only</li>
                </ul>
            </div>

            </div>

        </section>

   <!-- ====================== -->
<!--     POSTS LOOP HERE    -->
<!-- ====================== -->
@foreach ($posts as $post)

<div class="post mb-4" style="background-color:#292D37; border-radius:8px; overflow:hidden; max-width:800px;">

    {{-- POST HEADER (User Info) --}}
    <div class="p-3 d-flex align-items-center gap-3 border-bottom" style="border-color:#1B1E25;">
       <img src="{{ $post->user->avatar ? asset('storage/'.$post->user->avatar) : asset('assets/usericon.png') }}"
         class="rounded-circle"
         style="width:40px; height:40px; object-fit:cover;">

        <div>
            <h6 class="text-white mb-0" style="font-size:14px;">{{ $post->user->pet_name ?? 'Unknown User' }}</h6>
            <small class="text-white mb-0" style="font-size:12px;">{{ $post->created_at->diffForHumans() }}</small>
        </div>

        <div class="ms-auto position-relative">
    <button class="btn btn-link text-white p-0" onclick="toggleMenu({{ $post->id }})">
        <i class="bi bi-three-dots-vertical fs-5"></i>
    </button>

    <div id="menu-{{ $post->id }}" 
         class="dropdown-menu-custom hidden"
         style="position:absolute; right:0; top:30px; background:#1B1E25; border-radius:8px; width:150px;">

        @if($post->user_id === auth()->id())
            <!-- DELETE -->
            <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="dropdown-item-custom text-danger">Delete</button>
            </form>
        @endif

        <!-- REPORT -->
        <form action="{{ route('posts.report', $post->id) }}" method="POST">
            @csrf
            <button class="dropdown-item-custom">Report</button>
        </form>

        <!-- BLOCK -->
        <form action="{{ route('user.block', $post->user_id) }}" method="POST">
            @csrf
            <button class="dropdown-item-custom">Block</button>
        </form>
    </div>
</div>

    </div>

    {{-- MESSAGE --}}
    @if($post->message)
        <div class="p-3">
            <p class="text-white mb-0" style="font-size:14px; line-height:1.5;">{{ $post->message }}</p>
        </div>
    @endif

    {{-- PHOTO --}}
    @if($post->photo)
        <div class="w-100" style="background-color:#1B1E25; max-height:450px; overflow:hidden; display:flex; align-items:center; justify-content:center;">
            <img src="{{ asset('storage/'.$post->photo) }}"
                 style="width:100%; height:auto; max-height:450px; object-fit:cover; display:block;">
        </div>
    @endif

    {{-- TAGS (AGE / BREED / LOCATION / INTEREST) --}}
    @if($post->city || $post->age || $post->breed || $post->interest)
    <div class="p-3 d-flex flex-wrap gap-2">

        @if($post->city && $post->province)
        <span class="badge text-white d-flex align-items-center gap-1" 
              style="background-color:#1B1E25; font-size:11px; padding:6px 12px; border-radius:20px; font-weight:normal;">
            <i class="bi bi-geo-alt"></i>
            {{ $post->city }}, {{ $post->province }}
        </span>
        @endif

        @if($post->age)
        <span class="badge text-white d-flex align-items-center gap-1" 
              style="background-color:#1B1E25; font-size:11px; padding:6px 12px; border-radius:20px; font-weight:normal;">
            <i class="bi bi-calendar"></i>
            Age: {{ $post->age }}
        </span>
        @endif

        @if($post->breed)
        <span class="badge text-white d-flex align-items-center gap-1" 
              style="background-color:#1B1E25; font-size:11px; padding:6px 12px; border-radius:20px; font-weight:normal;">
            <i class="bi bi-tag"></i>
            {{ $post->breed }}
        </span>
        @endif

        @if($post->interest)
        <span class="badge text-white d-flex align-items-center gap-1" 
              style="background-color:#1B1E25; font-size:11px; padding:6px 12px; border-radius:20px; font-weight:normal;">
            <i class="bi bi-heart"></i>
            {{ $post->interest }}
        </span>
        @endif

    </div>
    @endif

    {{-- ACTION BUTTONS --}}
    <div class="d-flex justify-content-around border-top p-2" style="border-color:#1B1E25;">
        <button class="btn btn-link text-white d-flex align-items-center gap-2" style="font-size:13px; text-decoration:none;">
            <i class="bi bi-chat" style="font-size:18px;"></i>
            <span>Comment</span>
        </button>
        <button class="btn btn-link text-white d-flex align-items-center gap-2" style="font-size:13px; text-decoration:none;">
            <i class="bi bi-share" style="font-size:18px;"></i>
            <span>Share</span>
        </button>
        <button class="btn btn-link text-white d-flex align-items-center gap-2" style="font-size:13px; text-decoration:none;">
            <i class="bi bi-chat-dots" style="font-size:18px;"></i>
            <span>Message</span>
        </button>
    </div>

</div>

@endforeach

        

    </main>

   @section('right-sidebar')
    <h6 class="text-white font-semibold mb-4">Contacts</h6>

    <div class="flex flex-col gap-2">
        @foreach ($contacts as $contact)
            <a href="{{ route('messages', ['contact'=>$contact->id]) }}"
               class="flex items-center gap-3 p-2 rounded hover:bg-gray-800">

                <div class="relative">
                    <img src="{{ $contact->image ?? asset('assets/usericon.png') }}"
                         class="w-10 h-10 rounded-full object-cover">
                </div>

                <div>
                    <h6 class="text-white text-sm">{{ $contact->name }}</h6>
                </div>

            </a>
        @endforeach
    </div>
@endsection

</div>

<style>
.dropdown-menu-custom { 
    display: none;
    padding: 8px 0;
    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
    z-index: 100;
}

.dropdown-item-custom {
    width: 100%;
    background: none;
    border: none;
    color: white;
    padding: 8px 15px;
    text-align: left;
}

.dropdown-item-custom:hover {
    background: #343a40;
}

#age-options {
    scrollbar-width: thin;
    scrollbar-color: #495057 #1B1E25;
}

#age-options::-webkit-scrollbar {
    width: 6px;
}

#age-options::-webkit-scrollbar-track {
    background: #1B1E25;
    border-radius: 8px;
}

#age-options::-webkit-scrollbar-thumb {
    background: #495057;
    border-radius: 8px;
}

#age-options::-webkit-scrollbar-thumb:hover {
    background: #6c757d;
}

/* Hover effect for list items */
.age-select:hover {
    background-color: #343a40 !important;
}

/* Remove default border */
#age-options .list-group-item {
    border: none;
    border-bottom: 1px solid #1B1E25;
}

#age-options .list-group-item:last-child {
    border-bottom: none;
}
</style>


@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggles = [
            {btn: '#filter-age', menu: '#age-options'},
            {btn: '#filter-breed', menu: '#breed-options'},
            {btn: '#filter-location', menu: '#location-options'}
        ];
        toggles.forEach(({btn, menu}) => {
            const button = document.querySelector(btn);
            const menuEl = document.querySelector(menu);
            button.addEventListener('click', e => {
                e.preventDefault();
                e.stopPropagation();
                menuEl.classList.toggle('hidden');
                toggles.forEach(({menu: m}) => { if(m!==menu) document.querySelector(m).classList.add('hidden') });
            });
        });
        document.addEventListener('click', () => {
            toggles.forEach(({menu}) => document.querySelector(menu).classList.add('hidden'));
        });
    });

    function toggleMenu(id){
    document.querySelectorAll('.dropdown-menu-custom').forEach(el => {
        if (el.id !== "menu-"+id) el.style.display = "none";
    });

            const menu = document.getElementById('menu-' + id);
            menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
        }

        document.addEventListener('click', function(e){
            if (!e.target.closest('.dropdown-menu-custom') && !e.target.closest('.bi-three-dots-vertical')) {
                document.querySelectorAll('.dropdown-menu-custom').forEach(el => el.style.display = 'none');
            }
        });

    // NEW: Post type filter
document.addEventListener('DOMContentLoaded', function () {

    const typeBtn = document.querySelector('#filter-type');
    const typeMenu = document.querySelector('#type-options');
    const typeText = document.querySelector('#filter-type-text');

    typeBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        typeMenu.style.display =
            typeMenu.style.display === "none" ? "block" : "none";
    });

    document.querySelectorAll('.type-select').forEach(item => {
        item.addEventListener('click', () => {
            let type = item.dataset.type;

            typeText.innerText = item.innerText;

            // 🔥 Auto-apply filter (reload page with query param)
            window.location.href = "/home?type=" + type;
        });
    });

    document.addEventListener('click', () => typeMenu.style.display = "none");
});

// ===============================
// HOME → PICK IMAGE → REDIRECT TO POST PAGE WITH BASE64
// ===============================
document.addEventListener('DOMContentLoaded', function () {

    const photoBtn = document.getElementById('photoBtn');
    const imageInput = document.getElementById('post-image');

    if (!photoBtn || !imageInput) {
        console.error("❌ photoBtn or post-image NOT FOUND");
        return;
    }

    // When clicking the small photo icon
    photoBtn.addEventListener('click', function () {
        imageInput.click();
    });

    // When selecting an image
    imageInput.addEventListener('change', function (event) {
        const file = event.target.files[0];
        if (!file) return;

        let form = new FormData();
        form.append("image", file);

        fetch("/set-upload-session", {
            method: "POST",
            body: form,
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                window.location.href = "{{ route('posting.page') }}";
            } else {
                console.error("❌ Failed to store session");
            }
        })
        .catch(err => console.error(err));
    });

});



// Toggle Dropdown
document.getElementById('filter-age').addEventListener('click', function (e) {
    e.stopPropagation();
    let menu = document.getElementById('age-options');
    menu.style.display = (menu.style.display === "block") ? "none" : "block";
});

// Hide if clicking outside
document.addEventListener('click', function (e) {
    let btn = document.getElementById('filter-age');
    let menu = document.getElementById('age-options');
    if (!btn.contains(e.target) && !menu.contains(e.target)) {
        menu.style.display = "none";
    }
});

    // When selecting an age → submit filter
    document.querySelectorAll('.age-select').forEach(item => {
        item.addEventListener('click', function () {
            let selectedAge = this.getAttribute('data-age');

            // Redirect with age filter (GET request)
            window.location.href = `/home?age=${selectedAge}`;
        });
    });

</script>
@endpush

@endsection