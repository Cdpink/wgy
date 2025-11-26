<!DOCTYPE html>
<html>
    <head>
        <title>Waggy - help center</title>
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
        </style>
        <div id="navbar"></div>
        
        <!-- Help Center Section -->
        <div class="guide-section py-5 bg-light">
          <div class="guide-container container-fluid">
            <div class="guide-header d-flex justify-content-center align-items-center mb-5 gap-3"style="margin-top: 80px;">
              <i class="bi bi-headset" style="font-size: 2rem;"></i>
              <h3 class="fw-bold text-dark mt-2">Help Center</h3>
            </div>
            
            <!-- Help Center Grid -->
            <div class="container">
              <div class="row">
                <!-- Left Column -->
                <div class="col-md-6">
                  <!-- ACCOUNT HELP -->
                  <div class="mb-5">
                    <h5 class="fw-bold mb-3">Account Help</h5>
                    <ul style="font-size: 0.9rem; line-height: 1.8;">
                      <li>How to create an account</li>
                      <li>Resetting or recovering your password</li>
                      <li>Updating your profile details (name, bio, location, etc.)</li>
                      <li>Managing pet profiles and pet information</li>
                      <li>Deleting your account</li>
                      <li>Changing app settings like notifications or language</li>
                      <li>Linking social media accounts or verifying your phone number</li>
                      <li>Understanding how your account privacy and data protection works</li>
                      <li>Setting profile visibility (public, private, etc.)</li>
                      <li>Troubleshooting login issues (can't log in, forgot credentials, etc.)</li>
                      <li>How to switch or log into multiple accounts</li>
                    </ul>
                  </div>

                  <!-- PRIVACY & DATA MANAGEMENT -->
                  <div class="mb-5">
                    <h5 class="fw-bold mb-3">Privacy & Data Management</h5>
                    <ul style="font-size: 0.9rem; line-height: 1.8;">
                      <li>How your data is stored, used, and protected</li>
                      <li>Understanding data privacy under the Philippine Data Privacy Act (RA 10173)</li>
                      <li>Managing who can see your posts, pet profiles, or messages</li>
                      <li>Blocking and unblocking users</li>
                      <li>Controlling who can message or contact you</li>
                      <li>Downloading a copy of your data</li>
                      <li>Requesting deletion of specific data</li>
                      <li>Opting in/out of promotional emails or notifications</li>
                      <li>Understanding third-party integrations (if any)</li>
                      <li>Managing cookies and tracking preferences</li>
                      <li>How to report a privacy concern or data breach</li>
                    </ul>
                  </div>

                  <!-- EMERGENCY CONTACTS -->
                  <div class="mb-5">
                    <h5 class="fw-bold mb-3">Emergency Contacts</h5>
                    <ul style="font-size: 0.9rem; line-height: 1.8;">
                      <li>If you feel unsafe (such as threats, harassment, or potential abuse), please report the issue immediately through the app or contact local authorities.</li>
                      <li>PNP Anti-Cybercrime Group: <strong>(02) 723-0401 local 7506</strong></li>
                      <li>NBI Cybercrime Division: <strong>(02) 8525-4093</strong></li>
                      <li>Emergency Hotline (Philippines): <strong>911</strong></li>
                    </ul>
                  </div>
                </div>

                <!-- Right Column -->
                <div class="col-md-6">
                  <!-- TECHNICAL SUPPORT -->
                  <div class="mb-5">
                    <h5 class="fw-bold mb-3">Technical Support</h5>
                    <ul style="font-size: 0.9rem; line-height: 1.8;">
                      <li>App won't open or keeps crashing</li>
                      <li>Issues loading content (pet profiles, images, messages, etc.)</li>
                      <li>Slow performance or lagging</li>
                      <li>Notification problems (not receiving alerts)</li>
                      <li>Chat or messaging issues (messages not sending or loading)</li>
                      <li>Problems uploading photos/videos</li>
                      <li>Audio/video call not working (if applicable)</li>
                      <li>GPS or location services not functioning properly</li>
                      <li>Payment or subscription issues (if in-app purchases exist)</li>
                      <li>Connectivity problems (Wi-Fi vs mobile data)</li>
                      <li>App update or compatibility issues (works on iOS, Android versions, etc.)</li>
                    </ul>
                  </div>

                  <!-- REPORTING & FEEDBACK -->
                  <div class="mb-5">
                    <h5 class="fw-bold mb-3">Reporting & Feedback</h5>
                    <ul style="font-size: 0.9rem; line-height: 1.8;">
                      <li>How to report inappropriate or harmful content (posts, profiles, messages)</li>
                      <li>Reporting fake profiles or scams</li>
                      <li>How to report animal abuse or neglect</li>
                      <li>Submitting feedback or feature requests</li>
                      <li>Leaving a review or rating for breeders</li>
                      <li>How to contact customer support (in-app, email, or phone)</li>
                      <li>Expected response time for reports and inquiries</li>
                      <li>Understanding the consequences for violating community guidelines</li>
                    </ul>
                  </div>

                  <!-- ACCESSIBILITY SUPPORT -->
                  <div class="mb-5">
                    <h5 class="fw-bold mb-3">Accessibility Support</h5>
                    <ul style="font-size: 0.9rem; line-height: 1.8;">
                      <li>For Waggy app features (designed to support users with disabilities, including screen reader compatibility, text-to-speech, adjustable font sizes, high contrast mode, etc.)</li>
                      <li>Guidance on using assistive technologies</li>
                      <li>Keyboard shortcuts (if applicable)</li>
                      <li>Instructions for users with visual impairments</li>
                      <li>Support for users with hearing impairments (e.g., captions or visual alerts)</li>
                      <li>How to request additional accessibility features</li>
                      <li>Contact details for accessibility support or concerns</li>
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
            document.getElementById("footer").innerHTML  = navbar;
        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>