# Limg
## An open source image hosting service powered by Laravel
  
<img src="https://i.imgur.com/L4xOtFh.png" width=500>
  
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>

<hr>

## Requirement
- [**PHP**](https://php.net) 5.6.4+ (**7.0** preferred)
- PHP Extensions: openssl, mcrypt and mbstring, phpredis
- Database server: [MySQL](https://www.mysql.com) or [**MariaDB**](https://mariadb.org)
- [Redis](http://redis.io) Server
- [Composer](https://getcomposer.org)
- [Node.js](https://nodejs.org/) with npm

## Installation
* clone the repository: `git clone https://git.latable.dev/Havens/Limg Limg`
* create a database
* install: `composer install --no-dev`
* create configuration env file `.env` refer to `.env.example`
* generate a new application key `php artisan key:generate`
* setup database tables: `php artisan migrate:fresh --seed`


## Setup Discord Login
* go on https://discordapp.com/developers/applications
* create new application
* copy `CLIENT ID` & `CLIENT SECRET`
* paste on `.env` (`CLIENT ID` => `DISCORD_KEY` & `CLIENT SECRET` => `DISCORD_SECRET`)
* go on OAuth2 page and add redirect link : `https://YourApp.Domain/login/discord/callback` 
* add this redirect link in `.env` => `DISCORD_REDIRECT_URI`

<hr>  

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)