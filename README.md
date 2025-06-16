# Assignment Task


# 1. Install PHP dependencies
composer install

# 2. Copy .env example and set your environment variables
cp .env.example .env

# 3. Generate application key
php artisan key:generate

# 4. Run database migrations
php artisan migrate

# 5 Seed the database with a Super Admin account
php artisan db:seed

# 6. Start the queue worker (for handling jobs, e.g., emails, notifications)
php artisan queue:work

