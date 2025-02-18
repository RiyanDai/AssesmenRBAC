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

## ScreenShoot (User)
![image](https://github.com/user-attachments/assets/115b180c-dd22-4dd1-92f6-aa1a9f319652)

## ScreenShoot (Manager)
![image](https://github.com/user-attachments/assets/a11c417e-d9ac-4cf4-bef9-61ca5a97f19b)

![image](https://github.com/user-attachments/assets/d046383f-af5a-4b01-a8cd-26b1c41437fa)

![image](https://github.com/user-attachments/assets/736f442b-fe4e-4a96-9e6f-d56e733768f3)

## ScreenShoot (Admin)
![image](https://github.com/user-attachments/assets/c5eaba85-5023-4a20-9038-ea73c9dbb66f)

