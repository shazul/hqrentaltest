# Swimming Competition API

Laravel REST API for managing a remote swimming competition leaderboard.

## Installation

```bash
# Clone repository
git clone git@github.com:shazul/hqrentaltest.git
cd hqrentaltest

# Install dependencies
composer install

# Configure environment
cp .env.example .env
php artisan key:generate

# Run migrations and seed database
php artisan migrate
php artisan db:seed --class=AthleteSeeder

# Start server
php artisan serve
```

## API Endpoints

The Athlete ID (UUID) must be fetched from the DB beforehand.

### Get Leaderboard
```bash
curl -X GET http://localhost:8000/api/competitions/leaderboard
```

### Start Athlete
```bash
curl -X POST http://localhost:8000/api/competitions/athlete/{id}/start
```

### Finish Athlete
```bash
curl -X PUT http://localhost:8000/api/competitions/athlete/{id}/finish
```

## Console Commands

Manage athlete status via command line:

```bash
# List available athletes
php artisan athlete:manage wrong-id start

# Start athlete
php artisan athlete:manage {athlete_id} start

# Finish athlete
php artisan athlete:manage {athlete_id} finish
```
