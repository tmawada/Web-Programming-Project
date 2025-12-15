# ARCHEX - Cyberpunk Game Store

![ARCHEX Logo](https://img.shields.io/badge/ARCHEX-Game%20Store-d946ef?style=for-the-badge)

**ARCHEX** is a modern, cyberpunk-themed digital game store built with Laravel 11. Experience a sleek, futuristic interface for browsing, purchasing, and managing your game library.

## 🎮 Features

- **Game Store**: Browse and search through a curated collection of games
- **User Authentication**: Secure username-based login and registration
- **Shopping Cart**: Selective checkout with checkbox selection
- **User Library**: Track and access your purchased games
- **Friends System**: Connect with other users, send friend requests, and chat
- **Game Forums**: Community discussions for each game
- **Admin Panel**: Manage games and store content
- **Responsive Design**: Optimized for desktop and mobile devices

## 🎨 Design

ARCHEX features a stunning cyberpunk aesthetic with:
- Deep dark blue/purple background (`#0f0f1a`)
- Vibrant fuchsia/pink accents (`#d946ef`)
- Violet highlights (`#8b5cf6`)
- Smooth animations and transitions
- Modern card-based layouts

## 📋 Prerequisites

Before installing ARCHEX, ensure you have the following installed on your Windows system:

- **PHP** >= 8.2
- **Composer** (PHP dependency manager)
- **MySQL** >= 8.0 or MariaDB
- **Node.js** (optional, for asset compilation)
- **Git** (for cloning the repository)

### Installing Prerequisites on Windows

1. **Install PHP**:
   - Download from [windows.php.net](https://windows.php.net/download/)
   - Add PHP to your system PATH

2. **Install Composer**:
   - Download from [getcomposer.org](https://getcomposer.org/download/)
   - Run the installer

3. **Install MySQL**:
   - Download from [mysql.com](https://dev.mysql.com/downloads/installer/)
   - Or use XAMPP/WAMP which includes MySQL

4. **Install Git**:
   - Download from [git-scm.com](https://git-scm.com/download/win)

## 🚀 Installation & Setup

### 1. Clone the Repository

```bash
git clone https://github.com/tmawada/Web-Programming-Project.git
cd "Web-Programming-Project"
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Environment Configuration

Copy the example environment file:

```bash
copy .env.example .env
```

Edit `.env` file and configure your database:

```env
APP_NAME=ARCHEX
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=archex
DB_USERNAME=root
DB_PASSWORD=your_password_here
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Create Database

Create a new MySQL database named `archex`:

```sql
CREATE DATABASE archex;
```

Or use phpMyAdmin/MySQL Workbench to create the database.

### 6. Run Migrations

```bash
php artisan migrate
```

This will create all necessary tables in your database.

### 7. Seed the Database

```bash
php artisan db:seed
```

This will populate your database with:
- **Admin User**: 
  - Username: `admin`
  - Password: `12345678`
- **Test User**: 
  - Username: `tmawada`
  - Password: `12345678`
- **8 Additional Users** (johndoe, janesmith, etc.)
  - Password: `12345678`
- **Sample Games**: A variety of games across different genres

### 8. Start the Development Server

```bash
php artisan serve
```

The application will be available at: **http://localhost:8000**

## 🎯 Default Credentials

### Admin Account
- **Username**: `admin`
- **Email**: `admin@archex.com`
- **Password**: `12345678`

### Test User Account
- **Username**: `tmawada`
- **Email**: `tmawada@archex.com`
- **Password**: `12345678`

## 📱 Usage Guide

### For Customers

1. **Browse Games**: Visit the store homepage to see available games
2. **Search**: Use the search bar to find games by title or genre
3. **Add to Cart**: Click "Add to Cart" on any game
4. **Selective Checkout**: In cart, select games you want to purchase using checkboxes
5. **Purchase**: Complete checkout to add games to your library
6. **Your Games**: Access purchased games from the "Your Games" menu
7. **Friends**: Connect with other users via the Friends page
8. **Forums**: Discuss games in community forums

### For Administrators

1. **Login**: Use admin credentials
2. **Admin Panel**: Access via user dropdown menu
3. **Manage Games**: Add, edit, or remove games from the store

## 🛠️ Technology Stack

- **Backend**: Laravel 11 (PHP)
- **Frontend**: Blade Templates, Alpine.js, TailwindCSS (CDN)
- **Database**: MySQL
- **Authentication**: Laravel Breeze (username-based)

## 📁 Project Structure

```
ARCHEX/
├── app/
│   ├── Http/Controllers/     # Application controllers
│   ├── Models/                # Eloquent models
│   └── Middleware/            # Custom middleware
├── database/
│   ├── migrations/            # Database migrations
│   └── seeders/               # Database seeders
├── resources/
│   └── views/                 # Blade templates
├── routes/
│   └── web.php                # Web routes
└── public/                    # Public assets
```

## 🔧 Troubleshooting

### Common Issues

**Issue**: Database connection error
- **Solution**: Verify MySQL is running and credentials in `.env` are correct

**Issue**: "Class not found" errors
- **Solution**: Run `composer dump-autoload`

**Issue**: Permission errors
- **Solution**: Ensure `storage` and `bootstrap/cache` directories are writable

**Issue**: Migrations fail
- **Solution**: Drop the database and recreate it, then run migrations again

## 🤝 Contributing

This is a student project for Web Programming course. Contributions and suggestions are welcome!

## 📄 License

This project is created for educational purposes.

## 👨‍💻 Author

**Tommy Mawada**
- GitHub: [@tmawada](https://github.com/tmawada)

## 🎓 Academic Information

- **Course**: Web Programming
- **Institution**: [Your University Name]
- **Year**: 2025

---

**Enjoy your ARCHEX experience! 🎮✨**
