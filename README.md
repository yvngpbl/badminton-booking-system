# Badminton Booking System

A web-based badminton court booking system developed using Laravel and Bootstrap.
This application allows users to book badminton courts, rent badminton equipment, upload payment proof, and track booking status online.

---

## Features

### User Features

* User Registration & Login
* View Available Courts
* Book Badminton Courts
* Rent Badminton Rackets
* Upload Payment Proof
* View Booking History
* Booking Status Tracking
* Cancel Booking

### Admin Features

* Manage Court Availability
* Manage Racket Availability
* View User Bookings
* Approve or Reject Bookings
* Add Booking Notes
* Monitor Uploaded Payment Proof

---

## Tech Stack

* Laravel
* PHP
* Bootstrap
* MySQL
* Blade Template Engine


## Installation

### Clone Repository

```bash
git clone https://github.com/yvngpbl/badminton-booking-system.git
```

### Open Project Folder

```bash
cd badminton-booking-system
```

### Install Dependencies

```bash
composer install
npm install
```

### Configure Environment

Copy `.env.example` file:

```bash
cp .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

### Configure Database

Edit `.env` file:

```env
DB_DATABASE=badminton_booking
DB_USERNAME=root
DB_PASSWORD=
```

### Run Migration

```bash
php artisan migrate
```

(Optional Seeder)

```bash
php artisan db:seed
```

### Run Application

```bash
php artisan serve
```

Open in browser:

```bash
http://127.0.0.1:8000
```

Demo Account
Admin Account
Email    : admin@gmail.com
Password : admin123
You can use this account to access the admin dashboard and manage bookings.

---

## Project Structure

```bash
app/
├── Models
├── Http/Controllers

resources/
├── views

routes/
├── web.php
```

---

## Future Improvements

* Online Payment Gateway
* Real-Time Court Availability
* Booking Calendar
* Email Notifications
* Responsive Mobile Version

---

## Author

**Ahmad Zaky**
Informatics Engineering Student
Universitas Dinamika Bangsa

---

## License

This project is developed for learning and portfolio purposes.

