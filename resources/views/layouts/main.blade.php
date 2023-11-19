<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">

    <title> {{ $title }} | Universitas Teknokrat Indonesia </title>

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{ asset('img/UNIVERSITAS TEKNOKRAT.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/LineIcons.2.0.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-5.0.5-alpha.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/table.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/index.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/responsive.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/normalize.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/landingPage.css') }}" />

</head>

@include('partials.navbar')

@yield('container')

@if (request()->path() !== 'login')
    @include('partials.footer')
@endif

<!--====== Bootstrap js ======-->
<script src="{{ asset('assets/js/bootstrap.bundle-5.0.0.alpha-min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

<!--====== wow js ======-->
<script src="{{ asset('assets/js/wow.min.js') }}"></script>

<!--====== Main js ======-->
<script src="{{ asset('assets/js/main.js') }}"></script>

<script>
    // Get the navbar

    // for menu scroll 
    var pageLink = document.querySelectorAll('.page-scroll');

    pageLink.forEach(elem => {
        elem.addEventListener('click', e => {
            e.preventDefault();
            document.querySelector(elem.getAttribute('href')).scrollIntoView({
                behavior: 'smooth',
                offsetTop: 1 - 60,
            });
        });
    });

    // section menu active
    function onScroll(event) {
        var sections = document.querySelectorAll('.page-scroll');
        var scrollPos = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop;

        for (var i = 0; i < sections.length; i++) {
            var currLink = sections[i];
            var val = currLink.getAttribute('href');
            var refElement = document.querySelector(val);
            var scrollTopMinus = scrollPos + 73;
            if (refElement.offsetTop <= scrollTopMinus && (refElement.offsetTop + refElement.offsetHeight >
                    scrollTopMinus)) {
                document.querySelector('.page-scroll').classList.remove('active');
                currLink.classList.add('active');
            } else {
                currLink.classList.remove('active');
            }
        }
    };

    window.document.addEventListener('scroll', onScroll);


    //===== close navbar-collapse when a  clicked
    let navbarToggler = document.querySelector(".navbar-toggler");
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

    // Ambil semua elemen gambar dengan kelas "randomImage"
    var images = document.querySelectorAll(".randomImage");

    // Daftar URL gambar
    var imageUrls = [
        "{{ asset('assets/images/blog/blog-1.jpg') }}",
        "{{ asset('assets/images/blog/blog-2.jpg') }}",
        "{{ asset('assets/images/blog/blog-3.jpg') }}",
        "{{ asset('assets/images/blog/blog-4.jpg') }}",
        "{{ asset('assets/images/blog/blog-5.jpg') }}",
        "{{ asset('assets/images/blog/blog-6.jpg') }}"
        // Tambahkan URL gambar sesuai kebutuhan
    ];

    // Fungsi untuk mengacak daftar URL gambar
    function shuffleArray(array) {
        for (var i = array.length - 1; i > 0; i--) {
            var j = Math.floor(Math.random() * (i + 1));
            var temp = array[i];
            array[i] = array[j];
            array[j] = temp;
        }
    }

    // Mengacak daftar URL gambar
    shuffleArray(imageUrls);

    // Mengatur gambar pada setiap elemen gambar
    images.forEach(function(image, index) {
        image.src = imageUrls[index];
    });
</script>



</body>

</html>
