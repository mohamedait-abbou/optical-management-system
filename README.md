# Optical CRM Management System

[![PHP](https://img.shields.io/badge/PHP-8.5-777BB4?logo=php&logoColor=white)](https://www.php.net/)
[![Laravel](https://img.shields.io/badge/Laravel-13-FF2D20?logo=laravel&logoColor=white)](https://laravel.com/)
[![MySQL](https://img.shields.io/badge/MySQL-8-4479A1?logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Docker](https://img.shields.io/badge/Docker-✓-2496ED?logo=docker&logoColor=white)](https://www.docker.com/)
[![GitHub Actions](https://img.shields.io/badge/CI%2FCD-GitHub%20Actions-2088FF?logo=githubactions&logoColor=white)](https://github.com/features/actions)
[![License](https://img.shields.io/badge/License-MIT-blue.svg)](LICENSE)

A complete customer relationship management (CRM) web application built for **optical stores**. It manages customers, products, prescriptions, orders, payments, invoices, and stock operations from a single modern interface — with role-based access control, PDF invoice generation, and automatic stock tracking.

Built with a **professional DevOps workflow**: Docker containerization, GitHub Actions CI/CD, automated testing, and self-hosted deployment.

> Demo screenshots below. The app is containerized and deployed automatically on every push to `main`.

---

## Table of Contents

- [Features](#features)
- [Technology Stack](#technology-stack)
- [Screenshots](#screenshots)
- [Getting Started](#getting-started)
- [Docker Setup](#docker-setup)
- [Project Structure](#project-structure)
- [CI/CD](#cicd)
- [License](#license)
- [Author](#author)

---

## Features

### Authentication & Roles
- User registration and login
- Profile management
- Role-based access control using Spatie Laravel Permission

Available roles:

- Admin
- Manager
- Employee

### Customer Management
- Create, update, and delete customers
- Search customers and CIN management
- Customer history tracking

### Product Management
- Products CRUD
- Categories and brands management
- Stock tracking

### Prescription Management
- Store customer prescriptions
- Track eye information
- Prescription history

### Order Management
- Create orders and manage order items
- Customer order history
- Automatic stock updates

### Payment Management
- Track payments and payment status
- Remaining balance calculation
- Payment follow-up

### Invoice Management
- Generate invoices
- Export invoices as PDF
- Invoice history

### Stock Management
- Stock entries and exits
- Stock movements history
- Low stock alerts

---

## Technology Stack

### Backend
| Technology | Description |
| --- | --- |
| Laravel 13 | PHP framework |
| PHP 8.5 | Backend language |
| MySQL 8 | Database |

### Frontend
| Technology | Description |
| --- | --- |
| Blade | Templating engine |
| Tailwind CSS | Styling |
| JavaScript | Client-side logic |
| Vite | Build tool |

### DevOps & Tools
| Technology | Description |
| --- | --- |
| Docker & Docker Compose | Containerization of app, MySQL and Mailpit |
| GitHub Actions | CI/CD automation (tests + self-hosted deploy) |
| Self-hosted runner | Production deployment on the server |
| Git & GitHub | Version control |

---

## Screenshots

### Dashboard

![Dashboard](screenshots/dashboard.png)

### Orders

![Orders](screenshots/commandes_det.png)

### Prescription History

![Prescription History](screenshots/Historique_vi.png)

### Database Diagrams

![Class Diagram](screenshots/diagramme_classe.png)

![Entity-Relationship Model](screenshots/modele_entite_association.png)

---

## Getting Started

### Prerequisites

Make sure you have one of the following installed on your machine:

- [Docker](https://www.docker.com/products/docker-desktop/) (recommended)
- PHP 8.5+, Composer, Node.js and npm (local development)

---

## Docker Setup (Recommended)

Docker is the quickest way to run the whole application (Laravel + MySQL + Mailpit) with a single command.

### 1. Clone the repository

```bash
git clone https://github.com/mohamedait-abbou/optical-management-system.git
```

> Alternative: clone from GitLab
> ```bash
> git clone git@gitlab.com:mohamed-ait-abbou-group/optical-crm_pro.git
> ```

### 2. Go inside the project

```bash
cd optical-management-system
```

### 3. Configure the environment

Copy the example environment file:

```bash
cp .env.example .env
```

Set the following values for Docker:

```env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=optical_crm
DB_USERNAME=optical_user
DB_PASSWORD=secret
DB_ROOT_PASSWORD=root_secret
```

### 4. Build and start the containers

```bash
docker compose -f docker-compose.prod.yml up --build
```

The following services will start:

| Service | URL |
| --- | --- |
| Laravel application | http://localhost:8000 |
| Mailpit (email testing) | http://localhost:8025 |
| MySQL | localhost:3306 |

### 5. Run migrations and seeders

In another terminal, inside the project:

```bash
docker compose -f docker-compose.prod.yml exec app php artisan key:generate
docker compose -f docker-compose.prod.yml exec app php artisan migrate --seed
```

> The application is ready. Open http://localhost:8000 in your browser.

### Useful Docker commands

Start in the background:

```bash
docker compose -f docker-compose.prod.yml up -d
```

Stop the containers:

```bash
docker compose -f docker-compose.prod.yml down
```

Check container status:

```bash
docker ps
```

View logs:

```bash
docker compose -f docker-compose.prod.yml logs -f app
```

---

## Local Installation

If you prefer to run the application without Docker:

```bash
git clone https://github.com/mohamedait-abbou/optical-management-system.git
cd optical-management-system

composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm install
npm run dev
```

In a second terminal:

```bash
php artisan serve
```

The application will be available at http://127.0.0.1:8000.

---

## Project Structure

```
├── app/                  # Application logic (controllers, models, services)
├── config/               # Configuration files
├── database/             # Migrations and seeders
├── public/               # Public assets and entry point
├── resources/            # Views (Blade), styles and scripts
├── routes/               # Route definitions
├── tests/                # Automated tests (Pest)
├── screenshots/          # Project screenshots
├── .github/workflows/    # CI/CD pipeline (tests + deploy)
├── Dockerfile            # Production PHP/Apache image
├── docker-compose.yml    # Development services
└── docker-compose.prod.yml  # Production services (deployment)
```

---

## CI/CD

The project uses GitHub Actions to automate the full pipeline:

1. **Tests** (on a GitHub-hosted runner) — installs dependencies, builds frontend assets, runs migrations and the test suite against MySQL.
2. **Deploy** (on a self-hosted runner) — after tests pass, deploys to the production server automatically.

### Deployment flow

```
push to main ──► tests (GitHub runner) ──► deploy (self-hosted runner) ──► http://localhost:8000
```

The deploy job:

- Clones/pulls the code into `/opt/optical-crm` (a dedicated directory, separate from any local checkout)
- Builds and starts the containers from `docker-compose.prod.yml`
- Waits for the app healthcheck (`/up`)
- Runs `php artisan migrate --force` and `php artisan optimize`

### Manual deploy (without GitHub)

```bash
cd /opt/optical-crm
git pull origin main
docker compose -f docker-compose.prod.yml up -d --build
docker compose -f docker-compose.prod.yml exec app php artisan migrate --force
```

### Useful operations

| Task | Command |
| --- | --- |
| App logs | `docker compose -f /opt/optical-crm/docker-compose.prod.yml logs -f app` |
| Restart app | `docker compose -f /opt/optical-crm/docker-compose.prod.yml restart app` |
| Check runner | `systemctl status actions.runner.mohamedait-abbou-optical-management-system.mhd-laptop.service` |
| Restart runner | `sudo systemctl restart actions.runner.mohamedait-abbou-optical-management-system.mhd-laptop.service` |
| Deploy manually (GitHub) | Actions → Laravel CI/CD → **Run workflow** |
| Change app port | Edit `ports:` in `docker-compose.prod.yml` (e.g. `"8080:80"`) |

### Key files

| File | Role |
| --- | --- |
| `.github/workflows/laravel.yml` | CI/CD pipeline definition (tests + deploy) |
| `Dockerfile` | Production image: PHP 8.5, Apache (docroot `public/`), Composer, Node/Vite build |
| `docker-compose.prod.yml` | Production services: app, MySQL 8, Mailpit |
| `/opt/optical-crm/.env` | Production secrets (never committed) |

### Environment / secrets

The production `.env` lives on the server at `/opt/optical-crm/.env` and is never committed. It holds the database credentials and `APP_KEY`. The APP_KEY must stay stable so sessions and encrypted data keep working — never regenerate it during updates.

Workflow location: `.github/workflows/`

---

## License

This project is licensed under the [MIT License](LICENSE).

---

## Author

**Mohamed Ait Abbou** — Computer Science Student & Full-Stack Developer

- GitHub: [@mohamedait-abbou](https://github.com/mohamedait-abbou)

---

*This project is part of an internship — it demonstrates full-stack development, database design, Docker containerization, and CI/CD automation.*
