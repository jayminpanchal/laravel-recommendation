# Local Setup

Please follow these steps to run the project locallt

create .env file and update DB credentials

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=recommended_app
DB_USERNAME=
DB_PASSWORD=
```

Run migration and seeder to populate db

```
php artisan migrate
php artisan db:seed
```

start the server

```
php artisan serve --class=ProductSeeder
```

Please use below endpoints to get the response. 

```
localhost:8000/api/recommendations/10
```
