<!DOCTYPE html>
<html>

<head>
  <title>Waggy - guidelines</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  @vite(['resources/js/app.js'])
  
</head>

<body>
  <style>
    html {
      overflow-y: scroll;
    }

    body {
      font-family: "Montserrat", sans-serif;
      overflow-x: hidden;

    }
  </style>
  <div id="navbar"></div>
 
  <!-- Security Guidelines Section -->
  <div class="guide-section py-5">
    <div class="guide-container container-fluid">
      <div class="guide-header d-flex justify-content-center align-items-center mb-5 gap-3" style="margin-top: 80px;">
        <i class="bi bi-shield-check" style="font-size: 2rem;"></i>
        <h3 class="fw-bold text-dark mt-2">Security Guidelines</h3>
      </div>

      <!-- Guidelines Grid -->
      <div class="container">
        <div class="row">
          <!-- Left Column -->
          <div class="col-md-6">
            <!-- ACCOUNT PROTECTION -->
            <div class="mb-5">
              <h5 class="fw-bold mb-3">Account Protection</h5>
              <ul style="font-size: 0.9rem; line-height: 1.8;">
                <li>Use a strong, unique password with letters, numbers, and symbols.</li>
                <li>Change passwords regularly and log out on public devices.</li>
                <li>Waggy will never ask for your password or verification codes.</li>
                <li>Avoid unofficial apps, links, or phishing emails pretending to be Waggy.</li>
                <li>Report suspicious activity and reset your password immediately.</li>
              </ul>
            </div>

            <!-- SAFE COMMUNICATION -->
            <div class="mb-5">
              <h5 class="fw-bold mb-3">Safe Communication</h5>
              <ul style="font-size: 0.9rem; line-height: 1.8;">
                <li>Treat others with respect and professionalism.</li>
                <li>Avoid sharing financial or sensitive information in chat.</li>
                <li>Meet new users in safe, pet-friendly, public areas and bring a trusted friend.</li>
                <li>If someone makes you uncomfortable, block or report them immediately.</li>
              </ul>
            </div>
          </div>

          <!-- Right Column -->
          <div class="col-md-6">
            <!-- DATA PRIVACY -->
            <div class="mb-5">
              <h5 class="fw-bold mb-3">Data Privacy</h5>
              <ul style="font-size: 0.9rem; line-height: 1.8;">
                <li>Your personal and pet information is encrypted and protected under the Philippine Data Privacy Act
                  (RA 10173).</li>
                <li>Waggy never sells or shares user data for profit — it's only used for safety and feature
                  improvement.</li>
                <li>Adjust privacy settings anytime under <strong>Settings → Privacy → Manage Data</strong>.</li>
                <li>Verified profiles receive a blue checkmark after photo or video verification to prevent fake
                  accounts.</li>
              </ul>
            </div>

            <!-- RESPONSIBLE BREEDING & PET CARE -->
            <div class="mb-5">
              <h5 class="fw-bold mb-3">Responsible Breeding & Pet Care</h5>
              <ul style="font-size: 0.9rem; line-height: 1.8;">
                <li>Connect only with verified breeders who follow ethical practices.</li>
                <li>Share accurate, vet-approved health details before any meet-up.</li>
                <li>Always prioritize pet safety and proper care when engaging in breeding or adoption discussions.</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="footer"></div>
  <script type="module">
    import navbar from "./assets/js/footer.js";
    document.getElementById("footer").innerHTML = navbar;
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>