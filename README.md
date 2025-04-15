# Logosorthos Project

This repository contains both the Magellan Laravel application and Directus CMS for the Logosorthos project.

## Setup Instructions

### Prerequisites
- Docker and Docker Compose installed on your machine
- Git

### Local Development Setup

1. Clone this repository:
```bash
git clone <your-repo-url> logosorthos
cd logosorthos
```

2. Run the setup script:
```bash
chmod +x setup.sh
./setup.sh
```

This will:
- Create the necessary directories
- Set proper environment variables
- Start all Docker containers
- Run database migrations
- Generate application keys
- Set proper permissions

3. Access your applications:
   - Laravel (Magellan): http://localhost
   - Directus CMS: http://localhost:8055

### Manual Setup

If you prefer to set up manually:

1. Create directories:
```bash
mkdir -p directus/uploads directus/extensions
```

2. Configure Laravel for Docker:
```bash
cp magellan/.env.docker magellan/.env
```

3. Start Docker containers:
```bash
docker compose up -d
```

4. Run Laravel migrations:
```bash
docker compose exec app php artisan migrate
docker compose exec app php artisan key:generate
docker compose exec app php artisan storage:link
```

## Project Structure

```
logosorthos/
├── docker-compose.yml    # Main Docker Compose configuration
├── magellan/             # Laravel application
│   ├── app/
│   ├── bootstrap/
│   ├── ...
│   └── docker/           # Docker configuration for Laravel
├── directus/             # Directus CMS data
│   ├── extensions/       # Directus extensions
│   └── uploads/          # Directus uploads
└── setup.sh              # Setup script
```

## Development Workflow

### Working on Laravel (Magellan)
1. Make changes in the `magellan/` directory.
2. Run composer/npm commands through Docker:
```bash
docker compose exec app composer install
docker compose exec app npm install
docker compose exec app npm run dev
```

### Working with Directus
1. Access the Directus admin panel at http://localhost:8055
2. Login with the credentials set in your docker-compose.yml
3. Directus data is persisted in the MySQL database and uploads directory

## Deployment

For production deployment:

1. Update environment variables in docker-compose.yml and .env files:
   - Set stronger passwords
   - Set APP_DEBUG=false for Laravel
   - Set proper APP_URL and PUBLIC_URL values
   - Configure email settings

2. Build and start containers:
```bash
docker compose -f docker-compose.yml -f docker-compose.prod.yml up -d
```

## Database Backups

To backup the database:
```bash
docker compose exec db mysqldump -u root -p --all-databases > backup.sql
```

## Troubleshooting

### Container Issues
- Check logs: `docker compose logs [service-name]`
- Restart services: `docker compose restart [service-name]`
- Rebuild containers: `docker compose up -d --build`

### Laravel Issues
- Clear caches: `docker compose exec app php artisan optimize:clear`
- Check logs: `docker compose exec app cat storage/logs/laravel.log`

### Directus Issues
- Check logs: `docker compose logs directus`
- Reset admin password: Update the ADMIN_PASSWORD in docker-compose.yml and restart 