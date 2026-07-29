# Optical CRM Management System

## 📌 Overview

Optical CRM Management System is a web application developed for optical stores to manage customers, products, prescriptions, orders, payments, invoices, and stock operations.

The goal of this project is to provide a complete management solution with a modern interface and professional development practices including Docker containerization, CI/CD automation, and cloud deployment.

---

## 🚀 Technologies

### Backend
- Laravel 13
- PHP 8.5
- MySQL 8

### Frontend
- Blade
- Tailwind CSS
- JavaScript
- Vite

### DevOps & Tools
- Git
- GitHub
- Docker
- Docker Compose
- GitHub Actions
- Microsoft Azure

---

# ✨ Main Features

## 🔐 Authentication
- User registration
- Login system
- Profile management

## 👥 Roles & Permissions
Implemented using Spatie Laravel Permission.

Available roles:

- Admin
- Manager
- Employee

Features:
- Role management
- Permission management
- Access control

---

## 👤 Customer Management

- Create customers
- Update customer information
- Delete customers
- Search customers
- CIN management
- Customer history

---

## 👓 Product Management

- Products CRUD
- Categories management
- Brands management
- Product stock tracking

---

## 👁️ Prescription Management

- Store customer prescriptions
- Track eye information
- Prescription history

---

## 🛒 Order Management

- Create orders
- Manage order items
- Customer order history
- Automatic stock updates

---

## 💰 Payment Management

- Track payments
- Payment status
- Remaining balance calculation
- Payment follow-up

---

## 🧾 Invoice Management

- Generate invoices
- Export invoices as PDF
- Invoice history

---

## 📦 Stock Management

- Stock entries
- Stock exits
- Stock movements history
- Low stock alerts

---

# 🏗️ Architecture

Application architecture:

```
User
 |
 |
Laravel Application
 |
 |
MySQL Database
```

Docker architecture:

```
+----------------------+
| Laravel Container    |
| PHP + Apache         |
+----------------------+
           |
           |
+----------------------+
| MySQL Container      |
| Database             |
+----------------------+
```

---

# ⚙️ Installation

## Requirements

Install:

- PHP 8.5+
- Composer
- Node.js
- npm
- Docker Desktop
- Git


---

# Local Installation

Clone the repository:

```bash
git clone https://github.com/YOUR_USERNAME/optical-management-system.git
```

Go inside project:

```bash
cd optical-management-system
```

Install PHP dependencies:

```bash
composer install
```

Create environment file:

```bash
cp .env.example .env
```

Generate Laravel key:

```bash
php artisan key:generate
```

Configure database:

```
DB_CONNECTION=mysql
DB_DATABASE=optical_crm
DB_USERNAME=root
DB_PASSWORD=
```

Run migrations:

```bash
php artisan migrate --seed
```

Install frontend dependencies:

```bash
npm install
```

Run Vite:

```bash
npm run dev
```

Start Laravel:

```bash
php artisan serve
```

Application:

```
http://127.0.0.1:8000
```

---

# 🐳 Docker Setup

Build and start containers:

```bash
docker compose up --build
```

Application:

```
http://localhost:8000
```

Stop containers:

```bash
docker compose down
```

Check containers:

```bash
docker ps
```

---

# 🔄 CI/CD Pipeline

The project uses GitHub Actions to automate:

- Dependency installation
- Laravel checks
- Automated testing

Workflow location:

```
.github/workflows/
```

Pipeline:

```
Developer
    |
    |
Git Push
    |
    |
GitHub Actions
    |
    |
Tests
    |
    |
Deployment
```

---

# ☁️ Cloud Deployment

The application is prepared for deployment on Microsoft Azure.

Deployment workflow:

```
GitHub Repository
        |
        |
GitHub Actions
        |
        |
Docker Image
        |
        |
Azure Cloud
```

---

# 📸 Screenshots

Add screenshots here:

- Login page
- Dashboard
- Customers
- Products
- Orders
- Payments
- Invoice PDF

---

# 👨‍💻 Author

Mohamed Ait Abbou

Computer Science Student

---

# 📄 License

This project is licensed under the MIT License.# test
