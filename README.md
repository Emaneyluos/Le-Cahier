# Le Cahier
A remote knowledge retention system for educational institutions.

## Getting Started

### Docker
1. If not already done, [install Docker Compose](https://docs.docker.com/compose/install/) (v2.10+).
2. Run `docker compose build --no-cache` to build fresh images.
3. Run `docker compose up --pull always -d --wait` to start the project.

### Symfony
4. Run `make composer c=install` to initialize Composer.
5. Run `make sf c=importmap:install` to install dependencies.
6. *In production environment,* Run `make sf c=asset-map:compile`.

### Database
7. Run `make sf c=doctrine:database:create` to create the database.
8. Run `make sf c=make:migration` to create a fresh migration.
9. Run `make sf c=doctrine:migrations:migrate` to apply the migration to the database.
10. *Optional:* Run `make sf c=doctrine:fixtures:load` to load fixtures.
11. Open `https://localhost:5050` for PG Admin.

12. Open `https://localhost` in your favorite web browser and [accept the auto-generated TLS certificate](https://stackoverflow.com/a/15076602/1352334); take a look at the Makefile!

**Enjoy!**
