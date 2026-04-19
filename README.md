# NatureTrail: Pantonix Tiger Run Dhaka 2026

<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="300" alt="Laravel Logo">
</p>

## 🐅 About the Project

NatureTrail is a specialized marathon registration and event management platform built for the **Prokriti O Jibon Foundation**. The flagship event, **Pantonix Tiger Run Dhaka 2026**, aims to bridge fitness and wildlife conservation, specifically focusing on saving the **Royal Bengal Tiger** and the **Sundarbans**.

### Key Features

- **Modular Architecture:** Clean separation of concerns using `laravel-modules`.
- **Admin Powerhouse:** Fully managed via **Filament v4** for Events and Attendees.
- **Dynamic Frontend:** Real-time countdowns, dynamic event fetching, and automated race fee calculations.
- **Smart Registration:** Automatic age category detection (Infant, Kid, Adult) with admin-defined eligibility restrictions.
- **Image Optimization:** Client-side photo compression before upload to save server bandwidth.

## 🛠 Tech Stack

- **Framework:** Laravel 12.x
- **Admin Panel:** Filament v4 (Unified Schemas)
- **Frontend:** Tailwind CSS, Alpine.js, Blade
- **Architecture:** `nwidart/laravel-modules`
- **Environment:** Optimized for Laragon (Windows) / PHP 8.4

## 🚀 First-Time Setup Instructions

Follow these steps to get your development environment running from scratch.

### 1. Clone and Install Dependencies

```bash
git clone <your-repo-url>
cd tigertrail
composer install
npm install && npm run build


2. Environment Configuration

cp .env.example .env
php artisan key:generate


3. Database and Modules

php artisan migrate
php artisan module:migrate Events
composer dump-autoload

4. Admin Access

php artisan make:filament-user

💡 Common Development Commands
Task	Command
Clear All Cache	php artisan optimize:clear
Rebuild Autoloader	composer dump-autoload
Create New Event	Handled via Admin Panel (/admin/events)
Watch Assets	npm run dev
Clear View Cache	php artisan view:clear
📂 Project Structure Highlights
Modules/Events: Core logic for the Marathon system.
app/Filament: v4 Resource configurations, Tables, and Schemas.
resources/views/frontend: Landing page and registration forms.
public/storage: Runner ID photos and event banners.
🛡 Security and Optimization
Image Handling: All runner photos are compressed to a max width of 1000px using HTML5 Canvas before upload.
Registration Deadlines: "Register Now" buttons automatically disable once the registration_deadline in the database has passed.
📄 License

This project is proprietary software developed for the Prokriti O Jibon Foundation.

Happy Coding! 🐅🐾

php artisan db:seed --class=DummyAttendeeSeeder