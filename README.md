# Optical CRM Management System

[![PHP](https://img.shields.io/badge/PHP-8.5-777BB4?logo=php&logoColor=white)](https://www.php.net/)
[![Laravel](https://img.shields.io/badge/Laravel-13-FF2D20?logo=laravel&logoColor=white)](https://laravel.com/)
[![MySQL](https://img.shields.io/badge/MySQL-8-4479A1?logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Docker](https://img.shields.io/badge/Docker-✓-2496ED?logo=docker&logoColor=white)](https://www.docker.com/)
[![GitHub Actions](https://img.shields.io/badge/CI%2FCD-GitHub%20Actions-2088FF?logo=githubactions&logoColor=white)](https://github.com/features/actions)
[![License](https://img.shields.io/badge/License-MIT-blue.svg)](LICENSE)

A complete customer relationship management (CRM) web application built for **optical stores**. It manages customers, products, prescriptions, orders, payments, invoices, stock operations, reservations, purchase orders, and notifications from a single modern interface — with role-based access control, PDF invoice generation, and automatic stock tracking.

Built with a **professional DevOps workflow**: Docker containerization, GitHub Actions CI/CD, automated testing, and self-hosted deployment.

> Demo screenshots below. The app is containerized and deployed automatically on every push to `main`.

---

## Table of Contents

- [Features](#features)
- [Technology Stack](#technology-stack)
- [Screenshots](#screenshots)
- [Getting Started](#getting-started)
- [Docker Setup](#docker-setup)
- [Local Development](#local-development)
- [Project Structure](#project-structure)
- [CI/CD](#cicd)
- [License](#license)
- [Author](#author)

---

## Features

### Authentication & Roles
- User registration and login
- Profile management (password, email, delete account)
- Role-based access control using Spatie Laravel Permission

Available roles:
- **Admin** — full access
- **Manager** — operations management
- **Employee** — sales and customer-facing tasks

### Customer Management
- Create, update, and delete customers
- Search by name, CIN, phone, email
- CIN (national ID) tracking
- Full history: orders, prescriptions, payments

### Product Management
- Products CRUD with soft deletes
- Categories and brands management
- Price, cost price, quantity, alert threshold
- Image upload support
- Low stock detection (`quantity <= alert_threshold`)

### Prescription Management
- Store customer prescriptions (OD/OS sphere, cylinder, axis, PD, addition)
- Doctor name and prescription date
- Prescription history per customer

### Order Management
- Create orders with multiple items
- Auto-generates order number
- Links customer + sales user
- Status tracking
- Automatic stock deduction on order creation
- Customer order history

### Payment Management
- Multiple payments per order
- Tracks paid amount and remaining balance automatically
- Payment follow-up ready

### Invoice Management
- One invoice per order (1:1)
- PDF export via DomPDF
- Print-ready layout
- Invoice history

### Stock Management
- Stock entries (IN) and exits (OUT) with full audit trail
- Type, quantity, reference, notes, user tracking
- Automatic movements on orders and purchase order receipts
- Low stock alerts on dashboard

### Purchase Orders & Suppliers
- Supplier management
- Multi-item purchase orders with expected dates
- Status workflow (pending → received)
- Receiving stock auto-updates product quantities

### Reservations & Calendar
- Appointment scheduling (date, time, reason)
- Status workflow (pending → confirmed → completed/cancelled)
- Customer-linked reservations
- Calendar view via FullCalendar
- Automated email reminders (configurable hours before via scheduled command)

### Notifications
- Real-time bell icon dropdown
- Low stock alerts
- Order ready notifications
- New reservation alerts
- Mark as read / mark all as read
- Unread count badge

### Global Search
- Single search bar across all entities
- Searches: customers (name/CIN/phone/email), products, orders, invoices, suppliers, prescriptions, reservations, brands, categories, purchase orders
- Permission-aware results

### Reports
- Dashboard with 12-month sales/orders charts
- Stock by brand visualization
- Low stock product alerts
- Recent activity feed (orders + prescriptions)
- KPIs: total customers, products, brands, orders, prescriptions, total sales

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
| Alpine.js | Client-side interactivity |
| Vite | Build tool |
| FullCalendar | Calendar/reservations UI |

### DevOps & Tools
| Technology | Description |
| --- | --- |
| Docker & Docker Compose | Containerization (dev + prod) |
| GitHub Actions | CI/CD automation (tests + self-hosted deploy) |
| Self-hosted runner | Production deployment on server |
| Pest | Testing framework (unit + feature) |
| Mailpit | Email testing in development |
| k6 | Load testing (smoke/load/stress scripts) |
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

- [Docker](https://www.docker.com/products/docker-desktop/) (recommended)
- OR PHP 8.5+, Composer, Node.js 20+, npm (local development)

---

## Docker Setup

Two compose files are provided:

| File | Purpose |
| --- | --- |
| `docker-compose.yml` | **Development** — mounts source code for hot reload, uses `.env` |
| `docker-compose.prod.yml` | **Production** — multi-stage build, optimized, healthchecks, no source mount |

### 1. Clone the repository

```bash
git clone https://github.com/mohamedait-abbou/optical-management-system.git
cd optical-management-system
```

### 2. Configure environment

```bash
cp .env.example .env
```

Edit `.env` for Docker (MySQL):

```env
APP_ENV=production
APP_DEBUG=false
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=optical_crm
DB_USERNAME=optical_user
DB_PASSWORD=optical_password
DB_ROOT_PASSWORD=root_password
SESSION_DRIVER=database
QUEUE_CONNECTION=database
CACHE_STORE=database
MAIL_HOST=mailpit
```

> The `.env.example` defaults to SQLite for zero-config local testing. For Docker, switch to MySQL as shown above.

### 3. Development (with hot reload)

```bash
docker compose up --build
```

Services:
| Service | URL |
| --- | --- |
| Laravel app | http://localhost:8000 |
| Mailpit (email UI) | http://localhost:8025 |
| MySQL | localhost:3306 |

Run migrations/seeders in another terminal:

```bash
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate --seed
```

### 4. Production

```bash
docker compose -f docker-compose.prod.yml up --build -d
docker compose -f docker-compose.prod.yml exec app php artisan key:generate
docker compose -f docker-compose.prod.yml exec app php artisan migrate --force
docker compose -f docker-compose.prod.yml exec app php artisan optimize
```

The production image uses a multi-stage Dockerfile (PHP 8.5-Apache, Node 20, Composer) with optimized autoloader, cached config/routes/views, and healthchecks.

---

## Local Development (without Docker)

```bash
git clone https://github.com/mohamedait-abbou/optical-management-system.git
cd optical-management-system

composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed

npm install
npm run build        # production assets
# or: npm run dev    # development with Vite HMR
```

In a second terminal:

```bash
php artisan serve
```

App at http://127.0.0.1:8000. Mailpit at http://localhost:8025 (if running via Docker).

---

## Project Structure

```
├── app/                  # Controllers, Models, Services, Commands, Notifications, Mail
├── config/               # Configuration files
├── database/             # Migrations (20+), Factories, Seeders
├── public/               # Public assets, entry point
├── resources/            # Views (Blade), CSS, JS
├── routes/               # Web, API, Auth, Console routes
├── tests/                # Pest tests (Unit + Feature)
├── screenshots/          # Project screenshots
├── .github/workflows/    # CI/CD pipeline (tests + deploy)
├── Dockerfile            # Multi-stage production image (PHP 8.5-Apache, Node 20)
├── docker-compose.yml    # Development services (app, MySQL, Mailpit)
├── docker-compose.prod.yml  # Production services (optimized, healthchecks)
└── package.json          # Frontend deps + k6 scripts
```

---

## CI/CD

The project uses GitHub Actions to automate the full pipeline:

1. **Tests** (GitHub-hosted runner) — installs deps, builds assets, runs migrations, executes Pest test suite against MySQL 8.
2. **Deploy** (self-hosted runner) — on push to `main`, after tests pass, deploys to production server automatically.

### Deployment flow

```
push to main ──► tests (GitHub runner) ──► deploy (self-hosted runner) ──► live
```

The deploy job:
- Clones/pulls code into `/opt/optical-crm`
- Builds and starts containers from `docker-compose.prod.yml`
- Waits for app healthcheck (`/up`)
- Runs `php artisan migrate --force` and `php artisan optimize`

### Manual deploy (without GitHub)

```bash
cd /opt/optical-crm
git pull origin main
docker compose -f docker-compose.prod.yml up -d --build
docker compose -f docker-compose.prod.yml exec app php artisan migrate --force
docker compose -f docker-compose.prod.yml exec app php artisan optimize
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

The production `.env` lives on the server at `/opt/optical-crm/.env` and is never committed. It holds the database credentials and `APP_KEY`. The `APP_KEY` must stay stable so sessions and encrypted data keep working — never regenerate it during updates.

Workflow location: `.github/workflows/`

---

## License

This project is licensed under the [MIT License](LICENSE).

---

## Author

**Mohamed Ait Abbou** — Computer Science Student & Full-Stack Developer

- GitHub: [@mohamedait-abbou](https://github.com/mohamedait-abbou)

---

*This project was built during an internship — it demonstrates full-stack development, database design, Docker containerization, CI/CD automation, and domain modeling for a real-world optical business.*