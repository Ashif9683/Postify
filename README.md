# 📝 Blog Management System

A **Laravel-based Blog Management System** with separate panels for **Admin** and **User** roles. This system allows users to register, log in, and manage their own blog posts, while admins can oversee all users and posts.

---

## 🚀 Features

- User registration and login
- Role-based access (Admin/User)
- Admin dashboard for managing users and posts
- User dashboard for creating, editing, and deleting their own posts
- Fully responsive UI
- Local image upload
- Laravel session-based authentication
- PSR-4 autoloading

---

## 🛠️ Technologies Used

- Laravel (Latest version)
- PHP
- MySQL
- Blade Templating
- Custom CSS (Local)
- Laravel File Storage

## ⚙️ Setup Instructions

```bash
git clone https://github.com/Ashif9683/Postify.git
cd Postify
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
php artisan serve
