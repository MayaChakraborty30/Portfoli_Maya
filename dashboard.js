let slideIndex = 0;
        showSlides();

        function showSlides() {
            let slides = document.getElementsByClassName("carousel-slide");
            let dots = document.getElementsByClassName("dot");
            for (let i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";  
            }
            slideIndex++;
            if (slideIndex > slides.length) {slideIndex = 1}    
            for (let i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex-1].style.display = "block";  
            dots[slideIndex-1].className += " active";
            setTimeout(showSlides, 4000); // Change image every 4 seconds
        }

        function currentSlide(n) {
            slideIndex = n;
            showSlides();
        }

        // Set fixed coordinates
        const lat = 27.2297233;
        const lng = 88.4943797;

        // Function to initialize map
        function showPosition() {
            // Initialize Leaflet map with fixed location and no zoom controls
            var map = L.map('map', {
                center: [lat, lng],
                zoom: 50,
                zoomControl: false, // Disable the zoom control
                scrollWheelZoom: false, // Disable scroll wheel zoom
                doubleClickZoom: false, // Disable double click zoom
                boxZoom: false, // Disable box zoom
                touchZoom: false // Disable touch zoom
            });

            // Add tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Add marker
            L.marker([lat, lng]).addTo(map)
                .bindPopup('Golitar,Singtam')
                .openPopup();
        }

        // Call showPosition to initialize map
        window.onload = showPosition;

        function redirectToLogin() {
            window.location.href = 'login.html';
        }
