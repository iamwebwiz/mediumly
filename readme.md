# Mediumly

> A minimalistic [Medium.com](https://medium.com) clone built with Laravel PHP Framework and Tailwind CSS

## Installation

-   Clone the repository

```
git clone https://github.com/iamwebwiz/mediumly.git
```

-   Navigate into `mediumly` directory

```
cd ./mediumly
```

-   Copy the contents of `.env.example` to `.env`

```
cp .env.example .env
```

-   Install composer dependencies

```
composer install
```

-   Generate Application Key

```
php artisan key:generate
```

Configure your database variables in `.env`

-   Run migrations and seeders

```
php artisan migrate --seed
```

## Demo

-   Check out the demo [here](https://mediumly.herokuapp.com)
-   [Login here](https://mediumly.herokuapp.com/login)

**Admin Credentials**

-   Email: admin@mediumly.com
-   Password: securepass

## Test

Run tests with this command on your terminal:

```
composer test
```

Cheers!!!
