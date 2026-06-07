# ALMA Meat Market

Laravel 13 application for the ALMA meat-market site (three brands: Atenk,
Marila, Luma). Page styles and scripts live in `resources/css` and
`resources/js` and are built by Vite (minified, content-hashed) into
`public/build`; brand and product imagery lives in `storage/app/public`
(tracked project images under `images/`, runtime uploads under
`uploads/products/`) and is served through the `public/storage` symlink.

## Docker stack (recommended)

Apache + PHP 8.4 app container, MySQL 9 (`meat_market` database), phpMyAdmin.

```bash
cd docker
docker compose up -d --build   # build and start the stack
./boot                         # one-time bootstrap
```

`docker/boot` writes `.env` for the `alma-db` service, runs `composer install`,
`key:generate`, waits for MySQL, runs the migrations and seeders, creates the
`storage:link`, then `npm install && npm run build`.

| Service | URL |
|---|---|
| App | http://localhost:8001 |
| phpMyAdmin | http://localhost:8800 |
| MySQL (host access) | 127.0.0.1:3300 |

Ports, credentials and versions: `docker/.env`.

### Day-to-day commands

`./rc <cmd>` runs a command inside the app container as the `alma` user:

```bash
./rc php artisan migrate:fresh --seed
./rc composer require some/package
./rc npm run dev
```

### Seeded logins

- Admins: `atenk@admin.local` / `Atenk@2026`, `marila@admin.local` / `Marila@2026`, `luma@admin.local` / `Luma@2026`
- Customer: `ani@alma.local` / `User@2026`

## Local development without Docker

Runs on host PHP (>= 8.3) against any MySQL (for the docker stack use
`DB_HOST=127.0.0.1`, `DB_PORT=3300`):

```bash
composer install
cp .env.example .env && php artisan key:generate
php artisan migrate --seed
php artisan storage:link
php artisan serve
```

Note: `docker/boot` rewrites `.env` for in-network container values
(`DB_HOST=alma-db`).

## Architecture notes

- Separate `users` and `admins` tables with a custom session guard; passwords
  are hashed with the `Hash` facade (bcrypt). Login checks the admin table
  first, then users.
- Schema: `users`, `admins`, `products`, `warehouses`, `orders`,
  `admin_audit_logs`; conventional `password`/`username` columns, timestamps
  on every table, and a boolean `liked` flag on products.
- `php artisan migrate:fresh --seed` builds a full demo dataset: brand admins,
  sample customers, products across every category and brand, warehouse stock,
  orders in all four statuses, and audit logs.
- All POST endpoints are CSRF-protected; the jQuery layer sends the token from
  the `csrf-token` meta tag. Login and registration are rate-limited.

## Production checklist

Before deploying, set in `.env`: `APP_ENV=production`, `APP_DEBUG=false`, a
unique `APP_KEY`, `SESSION_SECURE_COOKIE=true` (HTTPS), and strong, unique
MySQL credentials (the values in `docker/.env` are local defaults only).
