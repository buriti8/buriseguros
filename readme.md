# [Laravel Example App - Serempre]

# Getting started

## Installation

Clone the repository

    git clone https://github.com/buriti88/serempre.git

Switch to the repo folder

    cd serempre

Install all the dependencies using composer

    composer install

Create a database in mysql

    CREATE DATABASE serempre CHARACTER SET utf8 COLLATE utf8_spanish_ci;

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate --seed

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000 or http://localhost/serempre/public/
 
# Authentication
 
The admin user is: admin and password: Admin$%

The search user is: mburitica and password: Manuel$%