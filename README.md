<!-- 
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>
-->

# RoomBooking's Web
Reserve Room's Web is a web-based room reservation platform designed to facilitate the scheduling and management of room usage across various campus locations. Built using the PHP programming language with the Laravel framework and powered by a MySQL database, this platform offers a user-friendly and functional interface.  Reserve Room's Web makes it easy for users to check room availability, make quick reservations, and receive instant confirmations. With comprehensive event management features, real-time status updates, and robust database integration, 
## Preview
<img src="https://i.ibb.co/gV7LJ2n/Reserve-room-web-1.png" style="max-width:100%">

## Requirement
- PHP
- Composer
- Laravel
- MySql

## Features
-  Admin
-  Authentication
-  Login (Admin/User)
-  Reserve Room
-  etc

## Instalation
1. Download or clone this project.
   ```git
   https://github.com/UkiMahfuda/web-pinjam-ruang.git
   ```
2. Navigate to the `app-pinjam-ruang` folder.
   ```sh
   cd web-pinjam-ruang
   ```
3. Install the required components using Composer.
   ```sh
   composer install
   ```
4. Copy the `.env.example` file to `.env`.
   ```sh
   cp .env.example .env
   ```
5. Generate the `APP_KEY`.
   ```sh
   php artisan key:generate
   ```
6. Install Storage.
   ```sh
   php artisan storage:link
   ```
7. Perform the database migration.
   ```sh
   php artisan migrate:fresh --seed
   ```
8. After successful migration, run the application.
   ```sh
   php artisan serve
   ```
9. Open your browser and go to `127.0.0.1:8000` to use the application.
   
10. Login:
    - email: mahasiswa@gmail.com password: mahasiswa -> User
    - email: admin@gmail.com password: admin -> Admin
