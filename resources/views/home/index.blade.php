@extends('navbar.nav1')
@section('title', 'Home - Waggy')
@section('body-class', 'bg-gray-900')

@section('content')
    <style>
        .modal-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, .7);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        .modal-content-custom {
            background: #1e2230;
            border-radius: 12px;
            padding: 20px;
            width: 90%;
            max-width: 400px;
            max-height: 500px;
            overflow-y: auto;
            color: #fff;
        }

        .modal-content-custom h5 {
            margin-bottom: 15px;
            font-size: 16px;
            font-weight: 600;
        }

        .modal-content-custom ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .modal-content-custom ul li {
            padding: 12px;
            border-bottom: 1px solid #333;
            cursor: pointer;
            font-size: 14px;
            transition: background 0.2s;
        }

        .modal-content-custom ul li:hover {
            background: #252938;
            color: #2D5BFF;
        }

        .dropdown-menu-custom {
            background: #1B1E25;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        .dropdown-item-custom {
            display: block;
            width: 100%;
            padding: 10px 15px;
            background: transparent;
            border: none;
            color: #fff;
            text-align: left;
            font-size: 14px;
            cursor: pointer;
            transition: background 0.2s;
        }

        .dropdown-item-custom:hover {
            background: #252938;
        }

        .dropdown-item-custom.text-danger {
            color: #dc3545;
        }

        .dropdown-item-custom.text-danger:hover {
            background: rgba(220, 53, 69, 0.1);
        }
    </style>

    <div class="min-h-screen flex">

        <!-- MAIN CONTENT -->
        <main class="flex-1 ml-72 mr-[300px] px-6 pt-28 max-w-[900px] mx-auto">

            <!-- POST INPUT SECTION -->
            <section class="post p-4 mb-4" style="background-color:#292D37; border-radius:5px;">

                <div class="d-flex align-items-start mb-3">
                    <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('assets/usericon.png') }}"
                        alt="Profile" class="rounded-circle me-3"
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
                            <div id="photoBtn" class="text-white d-flex align-items-center justify-content-center"
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
                        <button id="filter-age" onclick="showAgeModal()"
                            class="btn btn-link text-white d-flex align-items-center gap-2">
                            <i class="bi bi-calendar fs-4"></i><span id="age-text">Age</span>
                        </button>
                    </div>

                    <div class="position-relative">
                        <button id="filter-breed" onclick="showBreedModal()"
                            class="btn btn-link text-white d-flex align-items-center gap-2">
                            <i class="bi bi-tag fs-4"></i><span id="breed-text">Breed</span>
                        </button>
                    </div>

                    <!-- LOCATION FILTER WITH MODAL -->
                    <div class="position-relative">
                        <button id="filter-location" onclick="showCityModal()"
                            class="btn btn-link text-white d-flex align-items-center gap-2">
                            <i class="bi bi-geo-alt fs-4"></i><span id="location-text">Location</span>
                        </button>
                    </div>

                    <div class="position-relative">
                        <button id="filter-type" onclick="showAudienceModal()"
                            class="btn btn-link text-white d-flex align-items-center gap-2">
                            <i class="bi bi-funnel fs-4"></i>
                            <span id="filter-type-text">Audience</span>
                        </button>
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

                        <a href="{{ route('profile.show', $post->user->id) }}"
                            class="d-flex align-items-center gap-3 text-decoration-none">

                            <img src="{{ $post->user->avatar ? asset('storage/' . $post->user->avatar) : asset('assets/usericon.png') }}"
                                class="rounded-circle" style="width:40px; height:40px; object-fit:cover;">

                            <div>
                                <h6 class="text-white mb-0" style="font-size:14px;">
                                    {{ $post->user->pet_name ?? 'Unknown User' }}
                                </h6>
                                <small class="text-white mb-0" style="font-size:12px;">
                                    {{ $post->created_at->diffForHumans() }}
                                </small>
                            </div>

                        </a>

                        <div class="ms-auto position-relative">
                            <button class="btn btn-link text-white p-0" onclick="toggleMenu({{ $post->id }})">
                                <i class="bi bi-three-dots-vertical fs-5"></i>
                            </button>

                            <div id="menu-{{ $post->id }}" class="dropdown-menu-custom"
                                style="position:absolute; right:0; top:30px; background:#1B1E25; border-radius:8px; width:150px; display:none;">

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
                        <div class="w-100"
                            style="background-color:#1B1E25; max-height:450px; overflow:hidden; display:flex; align-items:center; justify-content:center;">
                            <img src="{{ asset('storage/' . $post->photo) }}"
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

                        {{-- LIKE BUTTON --}}
                        <button class="btn btn-link text-white d-flex align-items-center gap-2"
                            style="font-size:13px; text-decoration:none;">
                            <i class="bi bi-heart" style="font-size:18px;"></i>
                            <span>Like</span>
                        </button>

                        {{-- ADD FRIEND BUTTON (only show if not own post) --}}
                        @if($post->user_id !== auth()->id())
                            @php
                                $friendRequest = \App\Models\FriendRequest::where(function ($q) use ($post) {
                                    $q->where('sender_id', auth()->id())
                                        ->where('receiver_id', $post->user_id);
                                })->first();

                                $isFriend = auth()->user()->isFriendsWith($post->user_id);
                            @endphp

                            @if($isFriend)
                                {{-- Already Friends --}}
                                <button class="btn btn-link text-success d-flex align-items-center gap-2"
                                    style="font-size:13px; text-decoration:none;" disabled>
                                    <i class="bi bi-check-circle" style="font-size:18px;"></i>
                                    <span>Friends</span>
                                </button>
                            @elseif($friendRequest && $friendRequest->status === 'pending')
                                {{-- Cancel Friend Request --}}
                                <form action="{{ route('friend-requests.cancel', $friendRequest->id) }}" method="POST" class="m-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link text-warning d-flex align-items-center gap-2"
                                        style="font-size:13px; text-decoration:none;">
                                        <i class="bi bi-x-circle" style="font-size:18px;"></i>
                                        <span>Cancel Request</span>
                                    </button>
                                </form>
                            @else
                                {{-- Send Friend Request --}}
                                <form action="{{ route('friend-requests.send') }}" method="POST" class="m-0">
                                    @csrf
                                    <input type="hidden" name="receiver_id" value="{{ $post->user_id }}">
                                    <button type="submit" class="btn btn-link text-white d-flex align-items-center gap-2"
                                        style="font-size:13px; text-decoration:none;">
                                        <i class="bi bi-person-plus" style="font-size:18px;"></i>
                                        <span>Add Friend</span>
                                    </button>
                                </form>
                            @endif
                        @endif

                        {{-- MESSAGE BUTTON --}}
                        <a href="{{ route('messages') }}" class="btn btn-link text-white d-flex align-items-center gap-2"
                            style="font-size:13px; text-decoration:none;">
                            <i class="bi bi-chat-dots" style="font-size:18px;"></i>
                            <span>Comment</span>
                        </a>

                    </div>

                </div>

            @endforeach

        </main>

        @section('right-sidebar')
            <h6 class="text-white font-semibold mb-4">Contacts</h6>

            <div class="flex flex-col gap-2">
                @foreach ($contacts as $contact)
                    <a href="{{ route('messages', ['contact' => $contact->id]) }}"
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

    <!-- Age Selection Modal -->
    <div id="ageModal" class="modal-container" style="display:none;">
        <div class="modal-content-custom position-relative">
            <button class="position-absolute top-0 end-0 m-2 btn-close btn-close-white" onclick="closeAgeModal()"></button>
            <h5>Select Age</h5>
            <ul id="ageList"></ul>
        </div>
    </div>

    <!-- Breed Selection Modal -->
    <div id="breedModal" class="modal-container" style="display:none;">
        <div class="modal-content-custom position-relative">
            <button class="position-absolute top-0 end-0 m-2 btn-close btn-close-white"
                onclick="closeBreedModal()"></button>
            <h5>Select Breed</h5>
            <ul id="breedList"></ul>
        </div>
    </div>

    <!-- City Selection Modal -->
    <div id="cityModal" class="modal-container" style="display:none;">
        <div class="modal-content-custom position-relative">
            <button class="position-absolute top-0 end-0 m-2 btn-close btn-close-white" onclick="closeCityModal()"></button>
            <h5 id="modal-title">Select City</h5>
            <ul id="cityList"></ul>
        </div>
    </div>

    <!-- Audience Selection Modal -->
    <div id="audienceModal" class="modal-container" style="display:none;">
        <div class="modal-content-custom position-relative">
            <button class="position-absolute top-0 end-0 m-2 btn-close btn-close-white"
                onclick="closeAudienceModal()"></button>
            <h5>Select Audience</h5>
            <ul id="audienceList"></ul>
        </div>
    </div>

    @push('scripts')
        <script>
            const locationData = {
                "Pampanga": ["Angeles City", "Mabalacat City", "San Fernando City", "Mexico", "Bacolor", "Guagua", "Porac", "Santa Rita", "Magalang"],
                "Cavite": ["Bacoor City", "Imus City", "Dasmariñas City", "Tagaytay City", "General Trias", "Trece Martires City", "Kawit", "Rosario", "Silang", "Tanza"],
                "Laguna": ["Calamba City", "Santa Rosa City", "Biñan City", "San Pedro City", "Cabuyao City", "San Pablo City", "Los Baños", "Pagsanjan", "Sta. Cruz", "Bay"]
            };

            const ages = [1, 2, 3, 4, 5];
            const breeds = ["Labrador", "Golden Retriever", "Pug", "Shih Tzu", "Pomeranian"];
            const audiences = ["Public", "Friends"];

            // LOCATION FILTER LOGIC
            let selectedProvince = localStorage.getItem('selectedProvince') || '';
            let selectedCity = localStorage.getItem('selectedCity') || '';

            const urlParams = new URLSearchParams(window.location.search);
            const provinceParam = urlParams.get('province');
            const cityParam = urlParams.get('city');

            if (provinceParam) {
                selectedProvince = provinceParam.split(' (')[0];
                localStorage.setItem('selectedProvince', selectedProvince);
            }

            if (cityParam) {
                selectedCity = cityParam;
                localStorage.setItem('selectedCity', cityParam);
            }

            function updateLocationText() {
                const locationText = document.getElementById('location-text');
                locationText.textContent = 'Location';
            }

            function showCityModal() {
                if (!selectedProvince) {
                    window.location.href = '/location';
                    return;
                }

                const modal = document.getElementById('cityModal');
                const cityList = document.getElementById('cityList');
                const modalTitle = document.getElementById('modal-title');

                modalTitle.textContent = `Select City in ${selectedProvince}`;
                cityList.innerHTML = '';

                const cities = locationData[selectedProvince] || [];

                cities.forEach(city => {
                    const li = document.createElement('li');
                    li.textContent = city;
                    li.onclick = () => {
                        selectedCity = city;
                        localStorage.setItem('selectedCity', city);
                        updateLocationText();
                        closeCityModal();
                        window.location.href = `/home?province=${encodeURIComponent(selectedProvince)}&city=${encodeURIComponent(selectedCity)}`;
                    };
                    cityList.appendChild(li);
                });

                modal.style.display = 'flex';
            }

            function closeCityModal() {
                document.getElementById('cityModal').style.display = 'none';
            }

            // AGE MODAL
            function showAgeModal() {
                const modal = document.getElementById('ageModal');
                const ageList = document.getElementById('ageList');

                ageList.innerHTML = '';

                ages.forEach(age => {
                    const li = document.createElement('li');
                    li.textContent = age + " year(s)";
                    li.onclick = () => {
                        closeAgeModal();
                        window.location.href = `/home?age=${age}`;
                    };
                    ageList.appendChild(li);
                });

                modal.style.display = 'flex';
            }

            function closeAgeModal() {
                document.getElementById('ageModal').style.display = 'none';
            }

            // BREED MODAL
            function showBreedModal() {
                const modal = document.getElementById('breedModal');
                const breedList = document.getElementById('breedList');

                breedList.innerHTML = '';

                breeds.forEach(breed => {
                    const li = document.createElement('li');
                    li.textContent = breed;
                    li.onclick = () => {
                        closeBreedModal();
                        window.location.href = `/home?breed=${encodeURIComponent(breed)}`;
                    };
                    breedList.appendChild(li);
                });

                modal.style.display = 'flex';
            }

            function closeBreedModal() {
                document.getElementById('breedModal').style.display = 'none';
            }

            // AUDIENCE MODAL
            function showAudienceModal() {
                const modal = document.getElementById('audienceModal');
                const audienceList = document.getElementById('audienceList');

                audienceList.innerHTML = '';

                audiences.forEach(audience => {
                    const li = document.createElement('li');
                    li.textContent = audience;
                    li.onclick = () => {
                        closeAudienceModal();
                        window.location.href = `/home?audience=${audience.toLowerCase()}`;
                    };
                    audienceList.appendChild(li);
                });

                modal.style.display = 'flex';
            }

            function closeAudienceModal() {
                document.getElementById('audienceModal').style.display = 'none';
            }

            // Close modals when clicking outside
            document.getElementById('ageModal')?.addEventListener('click', function (e) {
                if (e.target === this) {
                    closeAgeModal();
                }
            });

            document.getElementById('breedModal')?.addEventListener('click', function (e) {
                if (e.target === this) {
                    closeBreedModal();
                }
            });

            document.getElementById('cityModal')?.addEventListener('click', function (e) {
                if (e.target === this) {
                    closeCityModal();
                }
            });

            document.getElementById('audienceModal')?.addEventListener('click', function (e) {
                if (e.target === this) {
                    closeAudienceModal();
                }
            });

            updateLocationText();

            // Toggle menu for post options (Delete, Report, Block)
            function toggleMenu(postId) {
                const menu = document.getElementById('menu-' + postId);
                const allMenus = document.querySelectorAll('.dropdown-menu-custom');

                allMenus.forEach(m => {
                    if (m.id !== 'menu-' + postId) {
                        m.style.display = 'none';
                    }
                });

                // Toggle current menu
                menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
            }

            // Close menus when clicking outside
            document.addEventListener('click', function (e) {
                if (!e.target.closest('.dropdown-menu-custom') && !e.target.closest('button[onclick^="toggleMenu"]')) {
                    document.querySelectorAll('.dropdown-menu-custom').forEach(menu => {
                        menu.style.display = 'none';
                    });
                }
            });

            // Image upload redirect to posting page
            document.addEventListener('DOMContentLoaded', function () {
                const photoBtn = document.getElementById('photoBtn');
                const imageInput = document.getElementById('post-image');

                if (!photoBtn || !imageInput) {
                    console.error("photoBtn or post-image NOT FOUND");
                    return;
                }

                photoBtn.addEventListener('click', function () {
                    imageInput.click();
                });

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
                                console.error("Failed to store session");
                            }
                        })
                        .catch(err => console.error(err));
                });
            });

        </script>
    @endpush

@endsection