# giorgi-zanqaidze-movie-quotes-upgraded

The Movie Quotes Application is a web-based platform that allows users to register, create, and share their favorite movie quotes. With an intuitive interface and a range of features, users can easily express their love for cinema by contributing their unique quotes, engaging with other users' quotes through likes and comments, and receiving real-time notifications.

#

### Table of Contents

-   [Prerequisites](#prerequisites)
-   [Tech Stack](#tech-stack)
-   [Getting Started](#getting-started)
-   [Migrations](#migration)
-   [Development](#development)
-   [Database Design Diagram](#project-structure)

#

### Prerequisites

-   <img src="https://github.com/RedberryInternship/example-project-laravel/raw/master/readme/assets/php.svg" width="35" style="position: relative; top: 4px" /> _PHP10.7.1_and up_
-   <img src="https://github.com/RedberryInternship/example-project-laravel/raw/master/readme/assets/mysql.png" width="35" style="position: relative; top: 4px" /> _MYSQL@8 and up_
-   <img src="https://github.com/RedberryInternship/example-project-laravel/raw/master/readme/assets/npm.png" width="35" style="position: relative; top: 4px" /> _npm@9.5.0 and up\_
-   <img src="https://github.com/RedberryInternship/example-project-laravel/raw/master/readme/assets/composer.png" width="35" style="position: relative; top: 6px" /> _composer@2.5.5 and up\_

#

### Tech Stack

-   <img src="https://github.com/RedberryInternship/example-project-laravel/raw/master/readme/assets/laravel.png" height="18" style="position: relative; top: 4px" /> [Laravel@6.x](https://laravel.com/docs/6.x) - back-end framework
-   <img src="https://github.com/RedberryInternship/example-project-laravel/raw/master/readme/assets/spatie.png" height="19" style="position: relative; top: 4px" /> [Spatie Translatable](https://github.com/spatie/laravel-translatable) - package for translation
-   <img src="https://dannyherran.com/wp-content/uploads/2022/01/laravel-sanctum.png" height="19" style="position: relative; top: 4px" /> [Laravel Sanctum](https://laravel.com/docs/10.x/sanctum) - authentication system for SPAs (single page applications)

#

### Getting Started

1\. First of all you need to clone E Space repository from github:

```sh
git clone https://github.com/RedberryInternship/giorgi-zanqaidze-movie-quotes-back.git
```

2\. Next step requires you to run _composer install_ in order to install all the dependencies.

```sh
composer install
```

3\. after you have installed all the PHP dependencies, it's time to install all the JS dependencies:

```sh
npm install
```

in order to build your JS/SaaS resources.

4\. Now we need to set our env file. Go to the root of your project and execute this command.

```sh
cp .env.example .env
```

```sh
5\. key generage
php artisan key:generate
```

And now you should provide **.env** file all the necessary environment variables:

#

**MYSQL:**

> DB_CONNECTION=mysql

> DB_HOST=127.0.0.1

> DB_PORT=3306

> DB_DATABASE=**\***

> DB_USERNAME=**\***

> DB_PASSWORD=**\***

**GOOGLE CLIENT**

> GOOGLE_CLIENT_ID="953164056244-sk94nk3afa81fbf5s3i9qd09r62lmccq.apps.googleusercontent.com"
> GOOGLE_CLIENT_SECRET="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"

**PUSHER**

> PUSHER_APP_ID=**\***
> PUSHER_APP_KEY=**\***
> PUSHER_APP_SECRET=**\***
> PUSHER_HOST=
> PUSHER_PORT=**\***
> PUSHER_SCHEME=https
> PUSHER_APP_CLUSTER=eu

**SMTP**

> MAIL_MAILER=smtp
> MAIL_DRIVER=smtp
> MAIL_HOST=smtp.googlemail.com
> MAIL_PORT=465
> MAIL_USERNAME=**\***
> MAIL_PASSWORD=**\***
> MAIL_ENCRYPTION=ssl
> MAIL_FROM_NAME="${APP_NAME}"

**PUSHER**

> BROADCAST_DRIVER=pusher
> CACHE_DRIVER=file
> FILESYSTEM_DISK=public
> QUEUE_CONNECTION=sync
> SESSION_DRIVER=file
> SESSION_LIFETIME=120

**URLs**

> BASE_URL=http://localhost:5173
> FRONT_END_URL=http://localhost:5173

**SESSION DOMAIN**

> SESSION_DOMAIN=localhost

**SANCTUM DOMAIN**

> SANCTUM_STATEFUL_DOMAINS=localhost:5173

##### Now, you should be good to go!

#

### Migration

if you've completed getting started section, then migrating database if fairly simple process, just execute:

```sh
php artisan migrate
```

#

### Development

You can run Laravel's built-in development server by executing:

```sh
  php artisan serve
```

it builds your tailwind.js files into executable scripts.

Project structure is fairly straitforward(at least for laravel developers)...

For more information about project standards, take a look at these docs:

-   [Laravel](https://laravel.com/docs/6.x)

[Database Design Diagram]

<a href="https://ibb.co/MCGpW31">Draw Sql</a>
