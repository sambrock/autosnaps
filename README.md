<p align="center">
  <a href="http://autosnapsprod2-env.eba-33dhndq8.eu-west-2.elasticbeanstalk.com/"><img width="460" src="https://raw.githubusercontent.com/advanced-web/advanced-application-sambrock/main/public/images/logo.png?token=AKHEMGMDVI2BYMPCXLKFIKC77S4HG"></a>
</p>

<p align="center">An app for sharing 'snaps' for cars from around the world.  </p>

## 🛠 Installation & Set Up

1. [Install Laravel](https://laravel.com/docs/8.x/installation)
```
composer global require laravel/installer
```
2. Clone the repo

3. In the repo folder, install all the dependencies using composer
```
composer install
```
4. Copy .`env.example` to create your `.env` file
```
cp .env.example .env
```
5. Generate application key
```
php artisan key:generate
```
6. Run the database migrations (set the database connection in `.env` before migrating)
```
php artisan migrate
```
7. Install JavaScript dependencies
```
npm install && npm run dev
```
8. Start local development server
```
php artisan serve
```

### Database seeding
To populate the database with seed data:
1. Run the database seeder
```
php artisan db:seed
```
2.  **Note:** It's recommended to have a clean database before seeding. You can refresh your migrations at any point to clean the database by running:
```
php artisan migrate:refresh
```

## 🚀 Production

1. Run production mix
```
npm run production
```
2. Follow [Laravel's deployment guide](https://laravel.com/docs/8.x/deployment) to see your various deployment options.
