
# Laravel Blog

  This mini project is for posting articles by users.

## Article Management

- Users can create, update and delete articles.
- Users can comment articles.
- Authorized users can delete their own comments.
- Authorized users can update their own articles.
- Authorized users can delete their own articles.

## Technologies Used

- Laravel 9
- HTML/CSS
- Bootstrap 5

## Installation

- If cloning my project is complete or download is complete, open terminal in project directory.
- Install composer dependicies
  - **composer install** (command)
- Install npm dependicies
  - **npm install**
- Create a copy of .env file
  - **cp .env.example .env**
- Generate an app encryption key
  - **php artisan key:generate**
- Create an empty database for my web project
  - created database name must match from .env file
- Start npm 
  - **npm run build**
- Seed Database
  - **php artisan db:seed**
- Migrate
  - **php artisan migrate**
- Start 
  - **php artisan serve**
- type in url with port 
  - localhost:8000

## Usage

- In Factory, I created users and articles with factory(). So you need to command **php artisan db:seed**



