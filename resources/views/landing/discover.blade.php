<!DOCTYPE html>
<html>
    <head>
        <title>Waggy - About Us</title>
    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />

    <!-- Bootstrap Icons -->
   <link
     rel="stylesheet"
     href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"
    />

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

            .feature-section {
                padding: 80px 0;
                margin-top: 100px;
            }   

            .feature-img {
                max-width: 100%;
                height: auto;
            }
        </style>
        <div id="navbar"></div>
        

        <!-- Find Connections That Matter -->
        <div class="feature-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <img src="{{ asset('assets/discover journey.jpg') }}" alt="Group of puppies" class="feature-img">
                    </div>
                    <div class="col-md-6">
                        <h2 class="fw-bold mb-4">Find Connections That Matter</h2>
                        <p style="font-size: 0.95rem; line-height: 1.8;">
                            Waggy helps you discover trusted connections in the pet community. Whether you're searching for a responsible breeder, looking to adopt, or simply want to connect with fellow pet lovers, our platform makes it easy to connect with people who share your passion for pets. Every connection is verified and backed by our community's commitment to animal welfare and transparent practices.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Connect with Responsible Breeders and Owners -->
        <div class="feature-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 order-md-2">
                        <img src="{{ asset('assets/onwer discover.jpg') }}" alt="Girl with dog" class="feature-img">
                    </div>
                    <div class="col-md-6 order-md-1">
                        <h2 class="fw-bold mb-4">Connect with Responsible Breeders and Owners</h2>
                        <p style="font-size: 0.95rem; line-height: 1.8;">
                            The Discovery feature allows you to explore verified profiles of breeders and owners in your area. Each profile includes pet details, health records, breeder certifications, and user reviews—so you can make informed comparisons. Or set preferences like breed, age, location, and health status to quickly find your ideal match. Chat directly with owners or breeders to discuss health history, temperament, and care needs before meeting in person.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Explore Local Events and Communities -->
        <div class="feature-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <img src="{{ asset('assets/discovery communities.png') }}" alt="Various dog breeds" class="feature-img">
                    </div>
                    <div class="col-md-6">
                        <h2 class="fw-bold mb-4">Explore Local Events and Communities</h2>
                        <p style="font-size: 0.95rem; line-height: 1.8;">
                            Stay connected with local pet events, meetups, adoption drives, and gatherings happening near you. Whether it's a fun playdate, a dog show, or a breed-specific group, you'll always know what's happening in your area. Join breed-specific or interest-based groups to share tips, ask questions, and connect with like-minded pet lovers in your area.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Smart and Personalized Matching -->
        <div class="feature-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 order-md-2">
                        <img src="{{ asset('assets/matching discovery.jpg') }}" alt="Three dogs sitting" class="feature-img">
                    </div>
                    <div class="col-md-6 order-md-1">
                        <h2 class="fw-bold mb-4">Smart and Personalized Matching</h2>
                        <p style="font-size: 0.95rem; line-height: 1.8;">
                            Waggy uses intelligent algorithms to recommend pets and breeders based on your preferences, lifestyle, and location. Get suggestions tailored to your needs—whether you're looking for a family-friendly companion or a specific breed. Discovery feed tailoring—showing you the most accurate breeders, owners, and pets that match your preferred breed, location, and lifestyle criteria.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Verified and Trusted Network -->
        <div class="feature-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <img src="{{ asset('assets/verified discovery.png') }}" alt="Robot dog toy" class="feature-img">
                    </div>
                    <div class="col-md-6">
                        <h2 class="fw-bold mb-4">Verified and Trusted Network</h2>
                        <p style="font-size: 0.95rem; line-height: 1.8;">
                            At Waggy, trust is at the heart of everything we do. Every breeder, owner, and pet profile undergoes a verification process to ensure safety and credibility. Look for the blue checkmark—it means the user has been verified through ID or video confirmation.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Share, Learn, and Grow -->
        <div class="feature-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 order-md-2">
                        <img src="{{ asset('assets/learn share and grow.png') }}" alt="Three dogs" class="feature-img">
                    </div>
                    <div class="col-md-6 order-md-1">
                        <h2 class="fw-bold mb-4">Share, Learn, and Grow</h2>
                        <p style="font-size: 0.95rem; line-height: 1.8;">
                            Waggy isn't just about finding pets—it's about building a community. Share stories, tips, and milestones with other pet lovers. Get expert advice on training, health, grooming, and more from verified trainers, vets, and experienced owners. Learn from a library of guides, articles, and videos on pet care, responsible breeding, and animal welfare.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Your Journey Starts Here -->
        <div class="feature-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <img src="{{ asset('assets/discover journey.jpg') }}"alt="Golden retriever puppy" class="feature-img">
                    </div>
                    <div class="col-md-6">
                        <h2 class="fw-bold mb-4">Your Journey Starts Here</h2>
                        <p style="font-size: 0.95rem; line-height: 1.8;">
                            Whether you're a first-time pet owner or an experienced breeder, Waggy is here to support you every step of the way. From finding your perfect companion to connecting with a community that shares your love for animals, your journey starts here. Join thousands of pet lovers across the Philippines. Download Waggy today and find your furry best friend!
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div id="footer"></div>
        <script type="module">
            import navbar from "./assets/js/footer.js";
            document.getElementById("footer").innerHTML  = navbar;
        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>