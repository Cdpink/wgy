@extends('layouts.app')
@section('title', 'Sign Up - Waggy')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-[#f5f5f7] px-6 relative">

  {{-- Back to Waggy link --}}
  <a href="#" class="absolute top-8 right-8 text-blue-600 hover:text-blue-700 text-sm font-medium">
    Back to Waggy
  </a>

  <div class="flex flex-col md:flex-row w-full max-w-5xl items-center justify-center">

    {{-- Left Section --}}
    <div class="md:w-1/2 text-center md:text-left mb-10 md:mb-0 px-6">
      <h1 class="text-4xl font-bold text-blue-600 mb-3">Waggy</h1>
      <p class="text-gray-600 text-base leading-relaxed max-w-xs mx-auto md:mx-0">
        Connect, share, and grow with<br>
        responsible breeders on Waggy.
      </p>
    </div>

    {{-- Right Section --}}
    <div class="md:w-1/2 bg-white rounded-2xl shadow-md p-10 w-full max-w-md">

      <p class="text-gray-400 text-sm mb-5 text-center">
        Automatically scan and validate uploaded pet documents
      </p>

      <form id="register-form" class="space-y-4" 
            action="{{ route('signup.post') }}" 
            method="POST" 
            enctype="multipart/form-data">

        @csrf

        {{-- Email --}}
        <input type="email" id="register-email" name="email" required
               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
               placeholder="Email">

        {{-- Password --}}
        <input type="password" id="register-password" name="password" required
               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
               placeholder="Password">

        {{-- Pet Name + Breed (same logic: breedInput + breedList) --}}
        <div class="flex gap-3">
          <input type="text" id="register-pet-name" name="pet_name" required
                 class="w-1/2 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                 placeholder="Pet Name">

          <div class="relative w-1/2">
            <input type="text" id="breedInput" name="breedtype" required 
                   autocomplete="off"
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                   placeholder="Breed">

            <ul id="breedList" 
                class="absolute bg-white w-full shadow-md rounded-md hidden max-h-40 overflow-y-auto text-sm z-50"></ul>
          </div>
        </div>

        {{-- Dog Age + Gender (custom dropdown like original) --}}
        <div class="flex gap-3">
          <input type="number" id="register-dog-age" name="dog_age" required min="0" max="30"
                 class="w-1/2 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                 placeholder="Dog Age">

          <div class="relative w-1/2">
            <div id="genderTrigger"
                 class="px-4 py-3 border border-gray-300 rounded-lg bg-white cursor-pointer text-gray-500">
              <span id="selectedGender">Gender</span>
            </div>

            <div id="genderOptions"
                 class="absolute top-full left-0 mt-1 bg-white border rounded-lg shadow-md hidden">
              <div class="gender-option px-4 py-2 cursor-pointer hover:bg-gray-100" data-value="Male">Male</div>
              <div class="gender-option px-4 py-2 cursor-pointer hover:bg-gray-100" data-value="Female">Female</div>
            </div>

            <input type="hidden" name="gendertype" id="gendertype" required>
          </div>
        </div>

        {{-- Features --}}
        <textarea id="register-features" name="features"
          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 resize-none"
          rows="2"
          placeholder="Distinguished features: e.g., color, markings"></textarea>

        {{-- Drag & Drop Upload (same IDs: uploadArea, uploadBtn, fileInput, fileName) --}}
        <div id="uploadArea"
             class="border border-gray-300 rounded-lg py-6 px-4 text-center text-gray-500">
          <p class="text-sm">Drag and drop your pet certificate</p>

          <button type="button" id="uploadBtn"
                  class="mt-2 bg-green-600 text-white px-5 py-2 rounded-lg text-sm hover:bg-green-700">
            Upload
          </button>

          <div id="fileName" class="mt-2 text-gray-700 text-sm"></div>
        </div>

        <input type="file" id="fileInput" name="certificate" accept=".pdf,.jpg,.jpeg,.png" class="hidden">

        {{-- Register --}}
        <button type="submit"
                class="w-full bg-blue-600 text-white font-semibold rounded-lg py-3 hover:bg-blue-700">
          Register
        </button>

        {{-- Login --}}
        <p class="text-center text-gray-500 text-sm pt-2">
          Already have an account?
          <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-700 font-medium">Log In</a>
        </p>
      </form>

    </div>
  </div>
</div>

{{-- JAVASCRIPT SECTION --}}
<script>
/* =======================
   AUTOCOMPLETE BREED LIST
======================= */
const breeds = ["Labrador","Poodle","Bulldog","Golden Retriever","Chihuahua","Shih Tzu","Beagle","German Shepherd"];
const breedInput = document.getElementById("breedInput");
const breedList = document.getElementById("breedList");

breedInput.addEventListener("input", () => {
    const value = breedInput.value.toLowerCase();
    breedList.innerHTML = "";
    if (!value) { breedList.classList.add("hidden"); return; }

    const filtered = breeds.filter(b => b.toLowerCase().includes(value));

    filtered.forEach(breed => {
        const li = document.createElement("li");
        li.textContent = breed;
        li.classList.add("px-3", "py-2", "cursor-pointer", "hover:bg-gray-100");
        li.onclick = () => {
            breedInput.value = breed;
            breedList.classList.add("hidden");
        };
        breedList.appendChild(li);
    });

    breedList.classList.remove("hidden");
});

/* =======================
   CUSTOM GENDER DROPDOWN
======================= */
const genderTrigger = document.getElementById("genderTrigger");
const genderOptions = document.getElementById("genderOptions");
const selectedGender = document.getElementById("selectedGender");
const genderInput = document.getElementById("gendertype");

genderTrigger.onclick = () => genderOptions.classList.toggle("hidden");

document.querySelectorAll(".gender-option").forEach(opt => {
    opt.onclick = () => {
        selectedGender.textContent = opt.dataset.value;
        genderInput.value = opt.dataset.value;
        genderOptions.classList.add("hidden");
        genderTrigger.classList.remove("text-gray-500");
    };
});

/* ==========================
   DRAG & DROP + UPLOAD BTN
========================== */
const uploadArea = document.getElementById("uploadArea");
const uploadBtn = document.getElementById("uploadBtn");
const fileInput = document.getElementById("fileInput");
const fileNameDisplay = document.getElementById("fileName");

uploadBtn.onclick = () => fileInput.click();
fileInput.onchange = (e) => {
    fileNameDisplay.textContent = e.target.files[0]?.name ?? "";
};

uploadArea.addEventListener("dragover", e => {
    e.preventDefault();
    uploadArea.classList.add("bg-gray-100");
});

uploadArea.addEventListener("dragleave", () => {
    uploadArea.classList.remove("bg-gray-100");
});

uploadArea.addEventListener("drop", e => {
    e.preventDefault();
    fileInput.files = e.dataTransfer.files;
    fileNameDisplay.textContent = fileInput.files[0]?.name ?? "";
    uploadArea.classList.remove("bg-gray-100");
});
</script>

@endsection
