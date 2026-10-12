# Car Types API — Laravel CRUD Example

A Laravel API example for managing car **brands, models, fuel types and categories**.

## Technologies and features
- Laravel / PHP, Eloquent models, REST-style resource controllers.
- Endpoints for `brands`, `models`, `fuels` and `categories`.
- Request validation, JSON responses and Laravel API resources.
- Car-model records link to brands, fuels and categories.

## API overview
| Resource | Example route | Purpose |
| --- | --- | --- |
| Brands | `/api/brands` | List/create/show/update/delete brand records |
| Models | `/api/models` | CRUD for vehicle models |
| Fuels | `/api/fuels` | Manage fuel types |
| Categories | `/api/categories` | Manage vehicle categories |

These routes describe the source code; no deployed API URL is provided.

## Local development
```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```
Configure a local database first. Check the exact installed PHP/Laravel version and project migrations before running the application.

## Security and production-readiness notes
**This repository is a development showcase and should not be deployed unreviewed.**

- The repository currently tracks `.env` and `.env.test`. Review and eliminate exposed secrets (including Git history); rotate any credentials that were real.
- API routes currently lack explicit authentication/authorization middleware. Add the necessary access controls before production use.
- Validate foreign-key relationships, uploads and mass-assignment policies; add integration tests.
- The tracked `vendor/` directory should be removed from source control and covered by `.gitignore`.

**Maintainer:** [zakibox](https://github.com/zakibox) · [Freelance portfolio and projects](https://github.com/zakibox/project-take).
