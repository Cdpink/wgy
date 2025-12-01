@extends('navbar.nav')
@section('title', 'Create Dog Post - Waggy')
@section('body-class', 'bg-gray-900')

@section('content')
    <div class="d-flex align-items-center justify-content-center min-vh-100 p-3">
        <div class="position-relative rounded-3 p-4" style="background-color: #252938; max-width: 450px; width: 100%;">

            {{-- Close Button --}}
            <button
                class="position-absolute top-0 start-0 m-3 btn btn-link text-decoration-none p-0 d-flex align-items-center justify-content-center"
                style="color: #8b92a7; font-size: 20px; width: 30px; height: 30px;" onclick="closeForm()"
                onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#8b92a7'">
                ✕
            </button>

            {{-- Send Button --}}
            <button class="position-absolute top-0 end-0 m-3 btn btn-primary rounded-2 px-4 py-2"
                style="background-color: #4c6ef5; border: none; font-size: 14px; font-weight: 500;" onclick="submitForm()"
                onmouseover="this.style.backgroundColor='#5c7cfa'" onmouseout="this.style.backgroundColor='#4c6ef5'">
                Send
            </button>

            {{-- Upload --}}
            <div class="text-center mt-5 mb-4">
                <label class="d-block mb-3" style="font-size: 13px; color: #8b92a7;">Upload Your dog photo</label>
                <label for="photoUpload" class="d-inline-flex align-items-center justify-content-center rounded-2"
                    id="photoPreview"
                    style="width: 60px; height: 60px; background: linear-gradient(135deg, #7ba5f5 0%, #5c8ff5 100%); cursor: pointer; transition: 0.3s;">
                    @if(session('uploaded_image'))
                        <img id="previewImg" src="{{ session('uploaded_image') }}"
                            style="width:100%; height:100%; object-fit:cover; border-radius:10px; display:block;">
                    @else
                        <img id="previewImg" src=""
                            style="width:100%; height:100%; object-fit:cover; border-radius:10px; display:none;">
                    @endif
                    <span id="photoIcon"
                        style="font-size: 28px; color: rgba(255,255,255,0.8); display: {{ session('uploaded_image') ? 'none' : 'block' }};">🏔️</span>
                </label>
                <input type="file" id="photoUpload" accept="image/*" class="d-none" onchange="previewImage(event)">
            </div>

            {{-- Form --}}
            <div>
                <label class="d-block mb-3" style="font-size: 13px; color: #8b92a7;">What's all in your mind?</label>
                <div class="mb-3">
                    <textarea id="messageTextArea" class="form-control rounded-2" rows="3" placeholder="Write something..."
                        style="background-color: #1e2230; border: 1px solid #3a3f52; color: #fff; padding: 12px 16px; font-size: 14px; resize: none;"
                        onfocus="hideDropdowns()" onblur="showDropdowns()"></textarea>
                </div>

                <div id="dropdownSection">
                    {{-- Age / Breed --}}
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <button type="button"
                                class="btn w-100 text-start rounded-2 d-flex justify-content-between align-items-center"
                                id="ageButton" onclick="showAgeModal()"
                                style="background-color: #1e2230; border: 1px solid #3a3f52; color: #8b92a7; padding: 12px 16px; font-size: 14px;">
                                <span id="selectedAge" data-value="">Select Age</span>
                                <i class="bi bi-chevron-down"></i>
                            </button>
                        </div>
                        <div class="col-6">
                            <button type="button"
                                class="btn w-100 text-start rounded-2 d-flex justify-content-between align-items-center"
                                id="breedButton" onclick="showBreedModal()"
                                style="background-color: #1e2230; border: 1px solid #3a3f52; color: #8b92a7; padding: 12px 16px; font-size: 14px;">
                                <span id="selectedBreed">Breed</span>
                                <i class="bi bi-chevron-down"></i>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Province / City --}}
                <div class="row g-2 mb-3">
                    <div class="col-6">
                        <button type="button"
                            class="btn w-100 text-start rounded-2 d-flex justify-content-between align-items-center"
                            id="provinceButton" onclick="showProvinceModal()"
                            style="background-color: #1e2230; border: 1px solid #3a3f52; color: #8b92a7; padding: 12px 16px; font-size: 14px;">
                            <span id="selectedProvince">Select Province</span>
                            <i class="bi bi-chevron-down"></i>
                        </button>
                    </div>
                    <div class="col-6">
                        <button type="button"
                            class="btn w-100 text-start rounded-2 d-flex justify-content-between align-items-center"
                            id="cityButton" onclick="showCityModal()"
                            style="background-color: #1e2230; border: 1px solid #3a3f52; color: #8b92a7; padding: 12px 16px; font-size: 14px;"
                            disabled>
                            <span id="selectedCity">Select City</span>
                            <i class="bi bi-chevron-down"></i>
                        </button>
                    </div>
                </div>

                {{-- Interest / Audience --}}
                <div class="row g-2 mb-3">
                    <div class="col-6">
                        <select class="form-select rounded-2" id="selectInterest"
                            style="background-color: #1e2230; border: 1px solid #3a3f52; color: #fff; padding: 12px 16px; font-size: 14px;">
                            <option value="">Interest</option>
                            <option>Breeding</option>
                            <option>Playdate</option>
                        </select>
                    </div>
                    <div class="col-6">
                        <select class="form-select rounded-2" id="selectAudience"
                            style="background-color: #1e2230; border: 1px solid #3a3f52; color: #fff; padding: 12px 16px; font-size: 14px;">
                            <option value="">Audience</option>
                            <option>Public</option>
                            <option>Friends</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modals --}}
    <div id="ageModal" class="modal-container" style="display:none;">
        <div class="modal-content-custom">
            <h5>Select Age</h5>
            <ul id="ageList"></ul>
        </div>
    </div>

    <div id="breedModal" class="modal-container" style="display:none;">
        <div class="modal-content-custom">
            <h5>Select Breed</h5>
            <ul id="breedList"></ul>
        </div>
    </div>

    <div id="provinceModal" class="modal-container" style="display:none;">
        <div class="modal-content-custom">
            <h5>Select Province</h5>
            <ul id="provinceList"></ul>
        </div>
    </div>

    <div id="cityModal" class="modal-container" style="display:none;">
        <div class="modal-content-custom">
            <h5>Select City</h5>
            <ul id="cityList"></ul>
        </div>
    </div>



    <style>
        .modal-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, .5);
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
            max-width: 320px;
            max-height: 420px;
            overflow-y: auto;
            color: #fff;
        }

        .modal-content-custom h5 {
            margin-bottom: 10px;
            font-size: 15px;
        }

        .modal-content-custom ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .modal-content-custom ul li {
            padding: 10px;
            border-bottom: 1px solid #333;
            cursor: pointer;
            font-size: 14px;
        }

        .modal-content-custom ul li:hover {
            background: #252938;
        }
    </style>

    <script>
        function closeForm() { fetch("/clear-upload-session").finally(() => window.location.href = "/home"); }

        function previewImage(event) {
            const file = event.target.files[0];
            if (!file) return;
            const previewImg = document.getElementById("previewImg");
            const icon = document.getElementById("photoIcon");
            previewImg.src = URL.createObjectURL(file);
            previewImg.style.display = "block";
            icon.style.display = "none";
            document.getElementById("photoPreview").style.background = "none";
        }

        function hideDropdowns() { document.getElementById("dropdownSection").style.display = "none"; }
        function showDropdowns() { setTimeout(() => document.getElementById("dropdownSection").style.display = "block", 200); }

        function showAgeModal() { document.getElementById("ageModal").style.display = "flex"; }
        function showBreedModal() { document.getElementById("breedModal").style.display = "flex"; }
        function showProvinceModal() { document.getElementById("provinceModal").style.display = "flex"; }
        function showCityModal() { document.getElementById("cityModal").style.display = "flex"; }

        window.addEventListener('click', function (e) {
            ['ageModal', 'breedModal'].forEach(id => {
                const modal = document.getElementById(id);
                const button = id === 'ageModal' ? document.getElementById('ageButton') : document.getElementById('breedButton');
                if (!e.target.closest(`#${button.id}`) && !e.target.closest(`#${modal.id}`)) {
                    modal.style.display = 'none';
                }
            });
        });

        // Age options - Direct ages 1-5 only
        const ages = [1, 2, 3, 4, 5];
        const ageList = document.getElementById("ageList");

        ages.forEach(age => {
            const li = document.createElement("li");
            li.textContent = age;
            li.style.cursor = "pointer";
            li.style.padding = "8px 12px";
            li.onmouseover = () => li.style.backgroundColor = "#0d6efd";
            li.onmouseout = () => li.style.backgroundColor = "transparent";
            li.onclick = () => {
                const selected = document.getElementById("selectedAge");
                selected.textContent = age;
                selected.dataset.value = age;
                document.getElementById("ageModal").style.display = "none";
            };
            ageList.appendChild(li);
        });

        // Breed options
        const breeds = ["Labrador", "Golden Retriever", "Pug", "Shih Tzu", "Pomeranian"];
        const breedList = document.getElementById("breedList");
        breeds.forEach(breed => {
            const li = document.createElement("li");
            li.textContent = breed;
            li.style.cursor = "pointer";
            li.style.padding = "8px 12px";
            li.onmouseover = () => li.style.backgroundColor = "#0d6efd";
            li.onmouseout = () => li.style.backgroundColor = "transparent";
            li.onclick = () => {
                document.getElementById("selectedBreed").textContent = breed;
                document.getElementById("breedModal").style.display = "none";
            };
            breedList.appendChild(li);
        });

        // Province → City
        const locations = {
            "Pampanga": ["Angeles City", "Mabalacat City", "San Fernando City", "Mexico", "Bacolor", "Guagua", "Porac", "Santa Rita", "Magalang"],
            "Cavite": ["Bacoor City", "Imus City", "Dasmariñas City", "Tagaytay City", "General Trias", "Trece Martires City", "Kawit", "Rosario", "Silang", "Tanza"],
            "Laguna": ["Calamba City", "Santa Rosa City", "Biñan City", "San Pedro City", "Cabuyao City", "San Pablo City", "Los Baños", "Pagsanjan", "Sta. Cruz", "Bay"]
        };
        const provinceList = document.getElementById("provinceList");
        const cityList = document.getElementById("cityList");
        Object.keys(locations).forEach(province => {
            const li = document.createElement("li");
            li.textContent = province;
            li.onclick = () => {
                document.getElementById("selectedProvince").textContent = province;
                document.getElementById("provinceModal").style.display = "none";
                document.getElementById("cityButton").disabled = false;
                cityList.innerHTML = "";
                locations[province].forEach(city => {
                    const cityItem = document.createElement("li");
                    cityItem.textContent = city;
                    cityItem.onclick = () => {
                        document.getElementById("selectedCity").textContent = city;
                        document.getElementById("cityModal").style.display = "none";
                    };
                    cityList.appendChild(cityItem);
                });
            };
            provinceList.appendChild(li);
        });

        // Submit
        function submitForm() {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = "{{ route('posts.store') }}";
            form.enctype = "multipart/form-data";
            form.innerHTML += `<input type="hidden" name="_token" value="{{ csrf_token() }}">`;
            form.innerHTML += `<input type="hidden" name="content" value="${document.getElementById('messageTextArea').value}">`;
            form.innerHTML += `<input type="hidden" name="age" value="${document.getElementById('selectedAge').dataset.value || ''}">`;
            form.innerHTML += `<input type="hidden" name="breed" value="${document.getElementById('selectedBreed').textContent}">`;
            form.innerHTML += `<input type="hidden" name="province" value="${document.getElementById('selectedProvince').textContent}">`;
            form.innerHTML += `<input type="hidden" name="city" value="${document.getElementById('selectedCity').textContent}">`;
            form.innerHTML += `<input type="hidden" name="interest" value="${document.getElementById('selectInterest').value}">`;
            form.innerHTML += `<input type="hidden" name="audience" value="${document.getElementById('selectAudience').value}">`;

            const fileInput = document.getElementById('photoUpload');
            const file = fileInput.files[0];
            if (file) {
                const dt = new DataTransfer();
                dt.items.add(file);
                const newInput = document.createElement('input');
                newInput.type = 'file';
                newInput.name = 'photoUpload';
                newInput.files = dt.files;
                form.appendChild(newInput);
            } else if ("{{ session('uploaded_image') }}") {
                form.innerHTML += `<input type="hidden" name="image_base64" value="{{ session('uploaded_image') }}">`;
            }

            document.body.appendChild(form);
            form.submit();
        }
    </script>
@endsection