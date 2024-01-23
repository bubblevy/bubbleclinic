## About BubbleClinic

<b>BubbleClinic</b> is an application used for the process of taking queue numbers at clinics. This kind of application helps in managing patient queues at clinics or health care centers.

## Installation

#### 1. Clone the repository

```sh
git clone git@github.com:alfargenis/bubbleclinic.git
```

#### 2. Copy .env

```sh
cp .env.example .env
```

#### 3. Configure .env

```sh
FAKER_LOCALE=id_ID
FILESYSTEM_DISK=public
```

#### 4. Install depedencies

```sh
composer install
```

#### 5. Generate Key

```sh
php artisan key:generate
```

#### 6. Run Symlink

```sh
php artisan storage:link
```

#### 7. Migrate database

```sh
php artisan migrate
```

#### 8. Database seeders

```sh
php artisan db:seed
```

#### 9. Reset antrian every day with cron job

```sh
php artisan schedule:work
```

#### 10. Run application

```sh
php artisan serve
```
#### <i><b>Note. username: admin & password: @Admin123</b></i>