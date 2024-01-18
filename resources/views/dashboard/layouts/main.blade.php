<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <title>{{ $title }} | Universitas Teknokrat Indonesia</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/UNIVERSITAS TEKNOKRAT.png') }}">
</head>

<body>

    <div class="screen-cover d-none d-xl-none"></div>

    <div class="row">
        <div class="col-12 col-lg-3 col-navbar d-none d-xl-block">

            @include('dashboard.partials.sidebar')

        </div>


        <div class="col-12 col-xl-9">
            @include('dashboard.partials.navbar')

            @yield('container')

        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <script>
        const navbar = document.querySelector('.col-navbar')
        const cover = document.querySelector('.screen-cover')

        const sidebar_items = document.querySelectorAll('.sidebar-item')

        function toggleNavbar() {
            navbar.classList.toggle('d-none')
            cover.classList.toggle('d-none')
        }

        function toggleActive(e) {
            sidebar_items.forEach(function(v, k) {
                v.classList.remove('active')
            })
            e.closest('.sidebar-item').classList.add('active')

        }

        document.addEventListener('DOMContentLoaded', function() {
            var nameInput = document.getElementById('name');
            var sisaMinSpan = document.getElementById('sisaMin');

            nameInput.addEventListener('input', function() {
                var inputValue = nameInput.value.length;
                var minCharacter = 4;

                // Update sisaMinSpan
                sisaMinSpan.textContent = Math.max(0, minCharacter - inputValue);

                // Tampilkan notifikasi jika kurang dari 4 karakter
                if (inputValue < minCharacter) {
                    showNotification('Nama Lengkap harus memiliki setidaknya 4 karakter.');
                }
            });

            // Fungsi untuk menampilkan notifikasi
            function showNotification(message) {
                var notification = document.createElement('div');
                notification.className = 'alert alert-danger alert-dismissible fade show';
                notification.innerHTML = message +
                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                document.body.appendChild(notification);

                // Menghilangkan notifikasi setelah beberapa detik (misalnya, 3 detik)
                setTimeout(function() {
                    notification.style.display = 'none';
                }, 3000);
            }
        });
    </script>
</body>

</html>
