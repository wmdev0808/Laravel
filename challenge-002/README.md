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

    - app/Http/Controllers/ChirpController.php

  - We can then create our Blade view template with a form for creating new Chirps:

    - resources/views/chirps/index.blade.php

    - Ref: Displaying The Validation Errors

      - An `$errors` variable is shared with all of your application's views by the `Illuminate\View\Middleware\ShareErrorsFromSession` middleware, which is provided by the `web` middleware group. When this middleware is applied an `$errors` variable will always be available in your views, allowing you to conveniently assume the `$errors` variable is always defined and can be safely used. The `$errors` variable will be an instance of `Illuminate\Support\MessageBag`.

    - Ref: Retrieving Translation Strings

      - You may retrieve translation strings from your language files using the `__` helper function. If you are using "short keys" to define your translation strings, you should pass the file that contains the key and the key itself to the `__` function using "dot" syntax. For example, let's retrieve the `welcome` translation string from the `lang/en/messages.php` language file:

        ```php
        echo __('messages.welcome');
        ```

      - If the specified translation string does not exist, the `__` function will return the translation string key. So, using the example above, the `__` function would return `messages.welcome` if the translation string does not exist.

    - If your screenshot doesn't look quite like the above, you may need to stop and start the Vite development server for Tailwind to detect the CSS classes in the new file we just created.

- **Navigation menu**

  - Let's take a moment to add a link to the navigation menu provided by Breeze.

  - Update the `navigation.blade.php` component provided by Breeze to add a menu item for desktop screens:

    - resources/views/layouts/navigation.blade.php

  - And also for mobile screens:

    - resources/views/layouts/navigation.blade.php

## Build Chirper with Inertia
