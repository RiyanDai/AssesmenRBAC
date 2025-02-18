# Laravel Assesment for Software Developer Intern Candidates ALVA

Sistem manajemen user dengan role-based access control, absensi, dan daily report menggunakan Laravel 11.

## Fitur

### Role & Permissions
- Admin: Akses penuh ke semua fitur
- Manager: Akses terbatas ke user yang dimanage
- User: Akses ke dashboard, absensi, dan daily report

### User Management
- CRUD Users
- Assign roles (Admin/Manager/User)
- Assign manager untuk user
- Manager hanya bisa manage user dibawahnya

### Attendance System
- User bisa check-in dan check-out
- Status otomatis (present/late)
- History absensi

### Daily Reports
- User bisa submit daily activity report
- Manager bisa lihat report dari user dibawahnya
- Admin bisa lihat semua report

## Teknologi

- PHP 8.3.14
- Laravel 11
- MySQL
- Laravel Breeze (Authentication)
- Tailwind CSS

## Requirement

- PHP >= 8.1
- Composer
- MySQL
- Node.js & NPM

