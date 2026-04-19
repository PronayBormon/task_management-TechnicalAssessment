````md
# TaskFlow – Task Management System

TaskFlow is a clean and modern task management system built with Laravel 12 and Bootstrap 5.

It helps teams manage tasks, track work progress, and organize daily workflow efficiently.

---

## Features

- Clean responsive frontend
- Admin dashboard
- Task Create / Edit / Delete
- Task Status Management
- Pending / In Progress / Completed tracking
- Search tasks
- Filter tasks
- Pagination
- Frontend task listing
- Task details page
- Authentication system
- Role-based access (Admin / User)
- Clean Laravel MVC structure

---

## 🛠 Technologies Used

### Backend

- PHP 8.2+
- Laravel 12
- Laravel Sanctum
- MySQL

### Frontend

- Blade Template Engine
- Bootstrap 5
- Bootstrap Icons
- ApexCharts (Dashboard charts)

### Tools

- Composer
- NPM (Optional)
- Git

---

## Installation Guide

### 1. Clone Project

```bash
git clone https://github.com/PronayBormon/task_management-TechnicalAssessment.git
cd task_management-TechnicalAssessment
````

### 2. Install Dependencies

```bash
composer install
```

### 3. Setup Environment

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configure Database

Update your `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5. Run Migration & Seeder

```bash
php artisan migrate --seed
```

### 6. Start Project

```bash
php artisan serve
```

Visit:

```bash
http://localhost:8000
```

---

## Demo Credentials

### Admin Login

```txt
Email: admin@gmail.com
Password: 12345678
```

### User Login

```txt
Email: user@gmail.com
Password: 12345678
```

---

## Main Features Overview

### Admin Panel

* Manage all tasks
* Create new task
* Edit existing task
* Delete task
* Change task status
* View statistics dashboard

### Frontend

* Task listing page
* Task details page
* Search tasks
* Filter by status
* Pagination

### Authentication

* Register
* Login
* Logout
* Admin middleware role protection

---

## Project Structure

```bash
app/
├── Http/
│   ├── Controllers/
│   ├── Middleware/
│   └── Requests/

app/
├── Models/

app/
├── Services/
├── Repositories/

resources/
├── views/

routes/
database/
```

---

## Assumptions / Decisions Made

* Used Laravel MVC best practices
* Separated business logic with service layer
* Bootstrap 5 for fast responsive UI
* Laravel Seeder for demo users
* Role-based middleware for admin access
* Pagination instead of load more for cleaner UX

---
