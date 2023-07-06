# Bootcamp

## Build Chirper with Blade

### Installation

- **Installation via Docker**

  - If you do not have PHP installed locally, you may develop your application using [Laravel Sail](https://laravel.com/docs/sail), a light-weight command-line interface for interacting with Laravel's default Docker development environment, which is compatible with all operating systems.

  - The easiest way to install Laravel is using our `laravel.build` service, which will download and create a fresh Laravel application for you. Launch a terminal and run the following command:

    ```
    curl -s "https://laravel.build/chirper" | bash
    ```

- **Installing Laravel Breeze**

  - Open a new terminal in your `chirper-blade` project directory and install your chosen stack with the given commands:

    ```
    composer require laravel/breeze --dev

    php artisan breeze:install blade
    ```

  - Breeze will install and configure your front-end dependencies for you, so we just need to start the Vite development server to automatically recompile our CSS and refresh the browser when we make changes to our Blade templates:

    ```
    npm run dev
    ```

  - Finally, open another terminal in your chirper project directory and run the initial database migrations to populate the database with the default tables from Laravel and Breeze:

    ```
    php artisan migrate
    ```

  - Register yourself an account and log in!

### Creating Chirps

- You're now ready to start building your new application! Let's allow our users to post short messages called _Chirps_.

- **Models, migrations, and controllers**

  - To allow users to post Chirps, we will need to create models, migrations, and controllers. Let's explore each of these concepts a little deeper:

    - `Models` provide a powerful and enjoyable interface for you to interact with the tables in your database.

    - `Migrations` allow you to easily create and modify the tables in your database. They ensure that the same database structure exists everywhere that your application runs.

    - `Controllers` are responsible for processing requests made to your application and returning a response.

  - Let's create a model, migration, and resource controller for our Chirps with the following command:

    ```
    php artisan make:model -mrc Chirp
    ```

    - You can see all the available options by running the `php artisan make:model --help` command.

- **Routing**

  - We will also need to create URLs for our controller. We can do this by adding "routes", which are managed in the `routes` directory of your project. Because we're using a resource controller, we can use a single `Route::resource()` statement to define all of the routes following a conventional URL structure.

  - To start with, we are going to enable two routes:

    - The `index` route will display our form and a listing of Chirps.

    - The `store` route will be used for saving new Chirps.

  - We are also going to place these routes behind two `middleware`:

    - The `auth` middleware ensures that only logged-in users can access the route.
    - The `verified` middleware will be used if you decide to enable email verification.

  - routes/web.php

    ```php
    ...
    Route::resource('chirps', ChirpController::class)
      ->only(['index', 'store'])
      ->middleware(['auth', 'verified']);
    ...
    ```

    - This will create the following routes:

      | Verb | URI     | Action | Route Name   |
      | ---- | ------- | ------ | ------------ |
      | GET  | /chirps | index  | chirps.index |
      | POST | /chirps | store  | chirps.store |

  - You may view all of the routes for your application by running the `php artisan route:list` command.

- **Blade**

  - Not impressed yet? Let's update the `index` method of our `ChirpController` class to render a Blade view:

## Build Chirper with Inertia
