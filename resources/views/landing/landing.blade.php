<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Waggy - Dog Community</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  @vite(['resources/js/app.js'])


  <style>
    body {
      font-family: "Montserrat", sans-serif;
      overflow-x: hidden;
    }


    .hero-bg {
      position: absolute;
      width: 100%;
      height: 100%;
      object-fit: cover;
      z-index: 1;
    }

    .hero-overlay {
      position: absolute;
      background: rgba(255, 255, 255, 0.2);
      z-index: 2;
    }

    .feature-card,
    .service-card,
    .benefits-card {
      transition: transform 0.3s ease;
    }
  </style>
</head>

<body>
  <!-- NAVBAR -->
  <div id="navbar"></div>


  <!-- Hero Section -->
  <section class="position-relative d-flex align-items-center justify-content-center text-center overflow-hidden"
    style="height: 100vh; width: 100%;">
    <div class="hero-overlay"></div>
    <img src="{{ asset('assets/hero.png') }}" alt="Dogs Hero Image" class="hero-bg" />

    <div class="position-relative text-dark" style="z-index: 3; max-width: 550px; padding: 30px;">
      <h1 class="fw-bold mb-3" style="font-size: 1.8rem;">Swipe & Go.</h1>
      <p class="mb-4" style="font-size: 0.95rem;">
        Meet breeders, make friends, and find your perfect furry match — one swipe is all it takes.
      </p>
      <div>
        <a href="#" class="btn btn-primary px-3 py-1 me-2">Sign Up</a>
        <a href="#" class="btn btn-outline-dark px-3 py-1">Learn More</a>
      </div>
    </div>
  </section>

  <!-- Features section -->
  <section class="text-center bg-white" style="padding: 155px 0; height: 730px;">
    <div class="container-fluid">

      <!-- Features Header -->
      <div class="text-center mb-5" style="position: relative; top: -20px;">
        <p class="text-uppercase text-dark mb-1" style="font-size: 0.8rem; letter-spacing: 1px;">Features</p>
        <h2 class="fw-bold mb-2" style="font-size: 1.6rem; color: #111;">Powerful tools for social connection</h2>
        <p class="text-secondary" style="font-size: 0.9rem; margin-bottom: 40px;">
          Discover new ways to meet people and expand your network
        </p>
      </div>

      <div class="container">
        <div class="row g-4">
          <!-- Feature 1 -->
          <div class="col-12 col-lg-4">
            <div class="d-flex flex-column rounded overflow-hidden bg-light h-100">
              <img src="{{ asset('assets/Discovery.jpg') }}"  alt="Dogs discovering" class="img-fluid"
                style="height: 200px; object-fit: cover;" />
              <div class="p-3 text-start flex-grow-1">
                <p class="text-uppercase text-secondary mb-2" style="font-size: 0.75rem;">Discovery</p>
                <h3 class="fw-semibold mb-2" style="font-size: 1rem; color: #222;">Find connections that matter</h3>
                <p class="text-secondary mb-3" style="font-size: 0.85rem; line-height: 1.4;">
                  Smart algorithms help you meet like-minded individuals.
                </p>
                <a href="#" class="text-decoration-none fw-semibold" style="color: #d33; font-size: 0.85rem;">Explore
                  →</a>
              </div>
            </div>
          </div>

          <!-- Feature 2 -->
          <div class="col-12 col-lg-4">
            <div class="d-flex flex-column rounded overflow-hidden bg-light h-100">
              <img src="{{ asset('assets/Security Safe.png') }}"  alt="Dog security" class="img-fluid"
                style="height: 200px; object-fit: cover;" />
              <div class="p-3 text-start flex-grow-1">
                <p class="text-uppercase text-secondary mb-2" style="font-size: 0.75rem;">Security</p>
                <h3 class="fw-semibold mb-2" style="font-size: 1rem; color: #222;">Safe networking</h3>
                <p class="text-secondary mb-3" style="font-size: 0.85rem; line-height: 1.4;">
                  Advanced privacy controls protect your personal information.
                </p>
                <a href="#" class="text-decoration-none fw-semibold" style="color: #d33; font-size: 0.85rem;">Protect
                  →</a>
              </div>
            </div>
          </div>

          <!-- Feature 3 -->
          <div class="col-12 col-lg-4">
            <div class="d-flex flex-column rounded overflow-hidden bg-light h-100">
              <img src="{{ asset('assets/Help Center.jpg') }}"  alt="Dog with headset" class="img-fluid"
                style="height: 200px; object-fit: cover;" />
              <div class="p-3 text-start flex-grow-1">
                <p class="text-uppercase text-secondary mb-2" style="font-size: 0.75rem;">Help Center</p>
                <h3 class="fw-semibold mb-2" style="font-size: 1rem; color: #222;">Support when you need it</h3>
                <p class="text-secondary mb-3" style="font-size: 0.85rem; line-height: 1.4;">
                  24/7 assistance for all your questions and concerns.
                </p>
                <a href="#" class="text-decoration-none fw-semibold" style="color: #d33; font-size: 0.85rem;">Support
                  →</a>
              </div>
            </div>
          </div>
        </div>

      </div>
  </section>

  <!-- Getting Started Section -->
  <section class="text-center py-5 bg-white" style="height: 735px; padding: 80px 0;">
    <div class="container-fluid">
      <!-- Section Header -->
      <div class="mx-auto mb-4" style="max-width: 700px; position: relative; bottom: 30px;">
        <p class="text-uppercase text-secondary mb-1" style="font-size: 0.8rem; letter-spacing: 0.5px;">Getting started
        </p>
        <h2 class="fw-bold mb-2" style="font-size: 1.6rem; color: #111;">
          Create your account in four simple steps
        </h2>
        <p class="text-secondary" style="font-size: 0.9rem; line-height: 1.6;">
          Joining Waggy Dog is quick and easy. Follow our step-by-step guide
          to start connecting.
        </p>
      </div>

      <!-- Steps Layout -->
      <div class="row align-items-center justify-content-center g-4">
        <!-- Left Steps -->
        <div class="col-12 col-md-3 text-md-end order-2 order-md-1" style="padding-left: 130px;">
          <div class="mb-4 text-center text-md-end mx-auto" style="max-width: 250px;">
            <div class="mb-2 text-center">
              <i class="bi bi-shield-check d-block text-primary mx-auto mb-2" style="font-size: 1.8rem;"></i>
              <h5 class="mb-0 fw-semibold" style="font-size: 1rem;">Create profile</h5>
            </div>
            <p class="text-secondary text-center" style="font-size: 0.9rem; line-height: 1.5;">
              Enter your basic information and choose a username that represents you.
            </p>
          </div>

          <div class="text-center text-md-end mx-auto" style="max-width: 250px;">
            <div class="mb-2 text-center">
              <i class="bi bi-camera d-block text-primary mx-auto mb-2" style="font-size: 1.8rem;"></i>
              <h5 class="mb-0 fw-semibold" style="font-size: 1rem;">Upload photo</h5>
            </div>
            <p class="text-secondary text-center" style="font-size: 0.9rem; line-height: 1.5;">
              Add a profile picture that shows your personality.
            </p>
          </div>
        </div>

        <!-- Center Image -->
        <div class="col-12 col-md-6 text-center order-1 order-md-2">
          <img src="{{ asset('assets/guide.png') }}"  alt="Dogs illustration" class="img-fluid rounded shadow-sm"
            style="max-width: 400px; border-radius: 12px;" />
        </div>

        <!-- Right Steps -->
        <div class="col-12 col-md-3 text-md-start order-3" style="padding-right: 130px;">
          <div class="mb-4 text-center text-md-start mx-auto" style="max-width: 250px;">
            <div class="mb-2 text-center">
              <i class="bi bi-sliders d-block text-primary mx-auto mb-2" style="font-size: 1.8rem;"></i>
              <h5 class="mb-0 fw-semibold" style="font-size: 1rem;">Set preferences</h5>
            </div>
            <p class="text-secondary text-center" style="font-size: 0.9rem; line-height: 1.5;">
              Customize your interests and connection settings.
            </p>
          </div>

          <div class="text-center text-md-start mx-auto" style="max-width: 250px;">
            <div class="mb-2 text-center">
              <i class="bi bi-people d-block text-primary mx-auto mb-2" style="font-size: 1.8rem;"></i>
              <h5 class="mb-0 fw-semibold" style="font-size: 1rem;">Start connecting</h5>
            </div>
            <p class="text-secondary text-center" style="font-size: 0.9rem; line-height: 1.5;">
              Begin discovering and meeting new people in your network.
            </p>
          </div>
        </div>
      </div>

      <!-- CTA Buttons -->
      <div class="d-flex justify-content-center align-items-center gap-2 mt-4">
        <a href="#" class="btn btn-primary text-decoration-none"
          style="font-size: 0.95rem; border-radius: 6px; padding: 5px 12px;">Get Started</a>
        <a href="#" class="btn btn-outline-dark text-decoration-none"
          style="font-size: 0.95rem; border-radius: 6px; padding: 5px 12px;">Need Help?</a>
      </div>
    </div>
  </section>

  <!-- Service Section -->
  <section class="bg-white" style="padding: 50px 0; height: 715px; position: relative; bottom: 30px;">
    <div class="container-fluid">
      <!-- Header -->
      <div class="text-center mb-5" style="position: relative; top: 20px;">
        <p class="text-uppercase text-secondary mb-1" style="font-size: 0.85rem; letter-spacing: 1px;">Services</p>
        <h2 class="fw-bold mb-2" style="font-size: 1.8rem; color: #111;">Comprehensive social networking solutions</h2>
        <p class="text-secondary" style="font-size: 0.95rem;">
          Designed to make connecting easier and more meaningful.
        </p>
      </div>

      <!-- Row -->
      <div class="row g-3 justify-content-center" style="position: relative; top: 40px;">
        <!-- Card 1 -->
        <div class="col-12 col-md-6 col-lg-5">
          <div class="d-flex flex-column flex-md-row align-items-stretch rounded overflow-hidden"
            style="background: #f0f0f0; height: 300px;">
            <div class="p-4 d-flex flex-column justify-content-center text-start" style="flex: 1;">
              <p class="text-uppercase text-secondary mb-2" style="font-size: 0.75rem;">Discovery</p>
              <h5 class="fw-semibold mb-2" style="font-size: 1.1rem; color: #111;">Find connections across multiple
                interests</h5>
              <p class="text-secondary mb-3" style="font-size: 0.9rem; line-height: 1.5;">
                Smart algorithms help you meet like-minded individuals.
              </p>
              <a href="#" class="text-decoration-none fw-semibold" style="color: #d33; font-size: 0.85rem;">Discover
                →</a>
            </div>
            <div style="flex: 1;">
              <img src="{{ asset('assets/Discovery Connection.jpg') }}"  alt="Discovery Service"
                class="img-fluid w-100 h-100" style="object-fit: cover;" />
            </div>
          </div>
        </div>

        <!-- Card 2 -->
        <div class="col-12 col-md-6 col-lg-5">
          <div class="d-flex flex-column flex-md-row align-items-stretch rounded overflow-hidden"
            style="background: #f0f0f0; height: 300px;">
            <div class="p-4 d-flex flex-column justify-content-center text-start" style="flex: 1;">
              <p class="text-uppercase text-secondary mb-2" style="font-size: 0.75rem;">Security</p>
              <h5 class="fw-semibold mb-2" style="font-size: 1.1rem; color: #111;">Protect your online interactions</h5>
              <p class="text-secondary mb-3" style="font-size: 0.9rem; line-height: 1.5;">
                Robust privacy features keep your data safe.
              </p>
              <a href="#" class="text-decoration-none fw-semibold" style="color: #d33; font-size: 0.85rem;">Secure →</a>
            </div>
            <div style="flex: 1;">
              <img src="{{ asset('assets/Security.jpg') }}"  alt="Security Service" class="img-fluid w-100 h-100"
                style="object-fit: cover;" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Benefits Section -->
  <section class="bg-white" style="padding: 80px 0; height: 600px; position: relative; bottom: 50px;">
    <div class="container-fluid">
      <!-- Header -->
      <div class="text-center mb-5">
        <p class="text-uppercase text-dark mb-1" style="font-size: 0.85rem; letter-spacing: 1px;">Benefits</p>
        <h2 class="fw-bold mb-2" style="font-size: 1.8rem;">Why Choose Waggy Dog</h2>
        <p class="text-dark" style="font-size: 0.95rem;">
          Discover the unique advantages of our social networking platform.
        </p>
      </div>

      <!-- Row -->
      <div class="row g-3 justify-content-center">
        <!-- Card 1 -->
        <div class="col-12 col-md-6 col-lg-5">
          <div class="position-relative rounded overflow-hidden" style="height: 300px;">
            <img src="{{ asset('assets/Convenience.jpg') }}"  alt="Golden Retriever" class="w-100 h-100 d-block"
              style="object-fit: cover;" />
            <div class="position-absolute bottom-0 start-0 w-100 text-white p-3"
              style="z-index: 2; padding: 15px 20px;">
              <p class="text-uppercase mb-2" style="font-size: 0.75rem;">Convenience</p>
              <h5 class="fw-semibold mb-2" style="font-size: 1.1rem;">Seamless user experience</h5>
              <p class="mb-2" style="font-size: 0.9rem; line-height: 1.5;">
                Intuitive design makes connecting with others simple and effortless.
              </p>
              <a href="#" class="text-decoration-none fw-semibold" style="color: #d33; font-size: 0.85rem;">Discover
                →</a>
            </div>
          </div>
        </div>

        <!-- Card 2 -->
        <div class="col-12 col-md-6 col-lg-5">
          <div class="position-relative rounded overflow-hidden" style="height: 300px;">
            <img src="{{ asset('assets/Safety.jpg') }}"  alt="Doberman Alert" class="w-100 h-100 d-block"
              style="object-fit: cover;" />
            <div class="position-absolute bottom-0 start-0 w-100 text-white p-3"
              style="z-index: 2; padding: 15px 20px;">
              <p class="text-uppercase mb-2" style="font-size: 0.75rem;">Safety</p>
              <h5 class="fw-semibold mb-2" style="font-size: 1.1rem;">Secure social interactions</h5>
              <p class="mb-2" style="font-size: 0.9rem; line-height: 1.5;">
                Advanced privacy controls ensure you connect safely with other pet lovers.
              </p>
              <a href="#" class="text-decoration-none fw-semibold" style="color: #d33; font-size: 0.85rem;">Read More
                →</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Connecting Section -->
  <section class="bg-white text-center" style="padding: 80px 0; height: 700px;">
    <div class="container-fluid">
      <div class="mb-4">
        <h1 class="fw-bold mb-3" style="font-size: 1.8rem;">Ready to start connecting</h1>
        <p class="mb-4" style="font-size: 0.95rem; color: #333;">
          Join thousands of users finding meaningful connections on waggy
        </p>
      </div>

      <div class="d-flex justify-content-center gap-3 mb-5">
        <a href="#" class="btn btn-primary text-decoration-none" style="padding: 5px 15px; border-radius: 4px;">Sign
          up</a>
        <a href="#" class="btn btn-outline-dark text-decoration-none"
          style="padding: 5px 15px; border-radius: 4px;">Learn More</a>
      </div>

      <div class="d-flex justify-content-center">
        <img src="../frontend/assets/img/footer dogs.png" alt="Dogs" class="img-fluid mt-3"
          style="width: 100vw; height: 400px; object-fit: cover; display: block; margin: 0; padding: 0;" />
      </div>
    </div>
  </section>

 
<div id="footer"></div>
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>