(function() {
    "use strict";

    //===== Preloader
    window.onload = function() {
        window.setTimeout(fadeout, 100);
    }

    function fadeout() {
        var preloader = document.querySelector('.preloader');
        if (preloader) {
            preloader.style.opacity = '0';
            preloader.style.display = 'none';
        }
    }

    /*=====================================
    Sticky Navbar
    ======================================= */
    window.onscroll = function () {
        var header_navbar = document.getElementById("header_navbar");
        if (header_navbar) {
            var sticky = header_navbar.offsetTop;
            if (window.pageYOffset > sticky) {
                header_navbar.classList.add("sticky");
            } else {
                header_navbar.classList.remove("sticky");
            }
        }

        var backToTop = document.querySelector(".back-to-top");
        if (backToTop) {
            if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
                backToTop.style.display = "block";
            } else {
                backToTop.style.display = "none";
            }
        }
    };

    //===== Close navbar-collapse when a link is clicked
    let navbarToggler = document.querySelector(".navbar-toggler");
    if (navbarToggler) {
        var navbarCollapse = document.querySelector(".navbar-collapse");

        document.querySelectorAll(".page-scroll").forEach(e =>
            e.addEventListener("click", () => {
                navbarToggler.classList.remove("active");
                navbarCollapse.classList.remove('show')
            })
        );

        navbarToggler.addEventListener('click', function() {
            navbarToggler.classList.toggle("active");
        });
    }

    // WOW Scroll Spy Initialization
    if (typeof WOW === "function") {
        var wow = new WOW({
            mobile: false // disabled for mobile
        });
        wow.init();
    }

    document.addEventListener('DOMContentLoaded', function() {
        const dateInput = document.getElementById('time_start_date');
        const timeButtons = document.querySelectorAll('.time-button');
        const startTimeInput = document.getElementById('time_start_time');
        const roomId = document.getElementById('room_id');
        
        const currentRentStartTime = document.getElementById('currentRentStartTime')?.value;
        const currentRentEndTime = document.getElementById('currentRentEndTime')?.value;
        const rentStartDate = document.getElementById('rentStartDate')?.value;
        
        if (dateInput && timeButtons.length && startTimeInput && roomId) {
            
            function disablePastTimes(bookings) {
                const today = new Date();
                const selectedDate = new Date(dateInput.value);
                
                timeButtons.forEach(button => {
                    const buttonTime = button.getAttribute('data-time');
                    const buttonDateTime = new Date(`${dateInput.value}T${buttonTime}:00`);
                    const isInCurrentRent = buttonTime >= currentRentStartTime && buttonTime <= currentRentEndTime;
    
                    // Enable by default
                    button.disabled = false;
                    button.classList.remove('active');
                    
                    // Disable buttons for past times
                    if (selectedDate.toDateString() === today.toDateString() && buttonDateTime < today) {
                        button.disabled = true;
                    }
    
                    // Disable buttons for booked times
                    bookings.forEach(booking => {
                        const start = new Date(booking.time_start_use);
                        const end = new Date(booking.time_end_use);
                        
                        if (buttonDateTime >= start && buttonDateTime < end && !isInCurrentRent) {
                            button.disabled = true;
                        }
                    });
    
                    // Set active class if this is the current rent time
                    if (buttonTime === currentRentStartTime) {
                        button.classList.add('active');
                    }
                });
            }
    
            dateInput.addEventListener('change', function() {
                fetch(`/get-bookings?date=${this.value}&room_id=${roomId.value}`)
                    .then(response => response.json())
                    .then(bookings => {
                        disablePastTimes(bookings);
                    });
            });
    
            fetch(`/get-bookings?date=${rentStartDate}&room_id=${roomId.value}`)
                .then(response => response.json())
                .then(bookings => {
                    disablePastTimes(bookings);
                });
    
            timeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    timeButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');
                    startTimeInput.value = this.getAttribute('data-time');
                });
            });
        }
    });
    
    
})();
