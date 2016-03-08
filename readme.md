# Docker Laravel
[![License](https://img.shields.io/badge/license-MIT-blue.svg)](https://packagist.org/packages/ekandreas/docker-laravel)

*** WORK IN PROGRESS ***

AEKAB uses this package to enable Docker dev environment for Laravel project development.

## Requirements
[PHP Composer](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx)

[Docker Machine](https://docs.docker.com/machine/install-machine/) 

## Step by step, getting started

### Step 1, the project root
Install Laravel or go to your Laravel project root
```bash
composer create-project laravel/laravel theproject
```

Step into the project folder
```bash
cd theproject
```

### Step 2, requirements
Install this package with composer and require-dev
```bash
composer require ekandreas/docker-laravel:* --dev
```

### Step 3, the deployfile (deploy.php)
Create a deploy file in the project root, a file called "deploy.php", eg:
```php
<!-- deploy.php in the laravel project root -->
<!-- Change "theproject.dev" to your local dev domain -->
<?php
include_once 'vendor/ekandreas/docker-laravel/recipe.php';

server('theproject.dev', 'default')
    ->env('container', 'laravel')
    ->stage('development');
```

### Step 4, ensure .env
**Note!** It's really important that you have a valid .env -file in the project root because Docker-Laravel will take DB_DATABASE and settings as parameters when creating the mysql container. 
Set the DB_HOST to same as your Docker machine IP!

Partitial example of a .env -file:
```
...
DB_HOST=192.168.99.100
DB_DATABASE=lund
DB_USERNAME=root
DB_PASSWORD=root
...
```

### Step 5, start containers
Run the script command in the terminal at your project root:
```bash
vendor/bin/dep docker:up development
```
If you have installed PHP deployer locally then run it without the path to "dep", just:
```bash
dep docker:up development
```

### Step 6, ensure local DNS
**Note!** Change your DNS so that the URL points to the docker machine! Eg for Mac:
```bash
nano /etc/hosts
```

Then browse to [theproject.dev](http://theproject.dev) and start develop your awesome web app.

### Stopping the containers for another project
Stop the containers (php+mysql)
```bash
dep docker:stop development
```

## Parameters

...

