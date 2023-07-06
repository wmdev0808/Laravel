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

- **Saving the Chirp**

  - Our form has been configured to post messages to the `chirps.store` route that we created earlier. Let's update the `store` method on our `ChirpController` class to validate the data and create a new Chirp:

    - app/Http/Controllers/ChirpController.php

      - We're using Laravel's powerful validation feature to ensure that the user provides a message and that it won't exceed the 255 character limit of the database column we'll be creating.

      - We're then creating a record that will belong to the logged in user by leveraging a `chirps` relationship. We will define that relationship soon.

      - Finally, we can return a redirect response to send users back to the `chirps.index` route.

- **Creating a relationship**

  - You may have noticed in the previous step that we called a `chirps` method on the `$request->user()` object. We need to create this method on our `User` model to define a ["has many"](https://laravel.com/docs/eloquent-relationships#one-to-many) relationship:

    - app/Models/User.php

- **Mass assignment protection**

  - Passing all of the data from a request to your model can be risky. Imagine you have a page where users can edit their profiles. If you were to pass the entire request to the model, then a user could edit any column they like, such as an `is_admin` column. This is called a [mass assignment vulnerability](https://en.wikipedia.org/wiki/Mass_assignment_vulnerability).

  - Laravel protects you from accidentally doing this by blocking mass assignment by default. Mass assignment is very convenient though, as it prevents you from having to assign each attribute one-by-one. We can enable mass assignment for safe attributes by marking them as "fillable".

  - Let's add the `$fillable` property to our `Chirp` model to enable mass-assignment for the `message` attribute:

    - app/Models/Chirp.php

- **Updating the migration**

  - The only thing missing is extra columns in our database to store the relationship between a `Chirp` and its `User` and the message itself. Remember the database migration we created earlier? It's time to open that file to add some extra columns:

    - `databases/migration/<timestamp>_create_chirps_table.php`

  - We haven't migrated the database since we added this migration, so let do it now:

    ```
    php artisan migrate
    ```

  - Note: Each database migration will only be run once. To make additional changes to a table, you will need to create another migration. During development, you may wish to update an undeployed migration and rebuild your database from scratch using the `php artisan migrate:fresh` command.

- **Testing it out**

  - We're now ready to send a Chirp using the form we just created! We won't be able to see the result yet because we haven't displayed existing Chirps on the page.

  - If you leave the message field empty, or enter more than 255 characters, then you'll see the validation in action.

  - Artisan Tinker

    - This is great time to learn about [Artisan Tinker](https://laravel.com/docs/artisan#tinker), a REPL ([Read-eval-print loop](https://en.wikipedia.org/wiki/Read%E2%80%93eval%E2%80%93print_loop)) where you can execute arbitrary PHP code in your Laravel application.

    - In your console, start a new tinker session:

      ```
      php artisan tinker
      ```

    - Next, execute the following code to display the Chirps in your database:

      ```
      > \App\Models\Chirp::all();
      = Illuminate\Database\Eloquent\Collection {#7199
          all: [
            App\Models\Chirp {#7201
              id: 1,
              user_id: 1,
              message: "I'm building Chirper with Laravel!",
              created_at: "2023-07-06 14:29:14",
              updated_at: "2023-07-06 14:29:14",
            },
          ],
        }

      >
      ```

    - You may exit Tinker by using the `exit` command, or by pressing `Ctrl + c`.

## Build Chirper with Inertia
