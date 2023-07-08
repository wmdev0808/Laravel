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

### Showing Chirps

- **Retrieving the Chirps**

  - Let's update the `index` method on our `ChirpController` class to pass Chirps from every user to our index page:

    - app/Http/Controllers/ChirpController.php

    - Here we've used Eloquent's `with` method to `eager-load` every Chirp's associated user. We've also used the `latest` scope to return the records in reverse-chronological order.

  - Note: Returning all Chirps at once won't scale in production. Take a look at Laravel's powerful [pagination](https://laravel.com/docs/pagination) to improve performance.

- **Connecting users to Chirps**

  - We've instructed Laravel to return the `user` relationship so that we can display the name of the Chirp's author. But, the Chirp's `user` relationship hasn't been defined yet. To fix this, let's add a new ["belongs to"](https://laravel.com/docs/eloquent-relationships#one-to-many-inverse) relationship to our `Chirp` model:

    - app/Models/Chirp.php

  - This relationship is the inverse of the "has many" relationship we created earlier on the `User` model.

- **Updating our view**

  - Next, let's update our `chirps.index` component to display the Chirps below our form:

    - resources/views/chirps/index.blade.php

### Editing Chirps

Let's add a feature that's missing from other popular bird-themed microblogging platforms — the ability to edit Chirps!

- **Routing**

  - First we will update our routes file to enable the `chirps.edit` and chirps.update routes for our resource controller. The `chirps.edit` route will display the form for editing a Chirp, while the `chirps.update` route will accept the data from the form and update the model:

    - routes/web.php

  - Our route table for this controller now looks like this:

    | Verb      | URI                  | Action | Route Name    |
    | --------- | -------------------- | ------ | ------------- |
    | GET       | /chirps              | index  | chirps.index  |
    | POST      | /chirps              | store  | chirps.store  |
    | GET       | /chirps/{chirp}/edit | edit   | chirps.edit   |
    | PUT/PATCH | /chirps/{chirp}      | update | chirps.update |

- **Linking to the edit page**

  - Next, let's link our new `chirps.edit` route. We'll use the `x-dropdown` component that comes with Breeze, which we'll only display to the Chirp author. We'll also display an indication if a Chirp has been edited by comparing the Chirp's `created_at` date with its `updated_at` date:

    - resources/views/chirps/index.blade.php

- **Creating the edit form**

  - Let's create a new Blade view with a form for editing a Chirp. This is similar to the form for creating Chirps, except we'll post to the `chirps.update` route and use the `@method` directive to specify that we're making a "PATCH" request. We'll also pre-populate the field with the existing Chirp message:

    - resources/views/chirps/edit.blade.php

- **Updating our controller**

  - Let's update the `edit` method on our `ChirpController` to display our form. Laravel will automatically load the Chirp model from the database using [route model binding](https://laravel.com/docs/9.x/routing#route-model-binding) so we can pass it straight to the view.

  - We'll then `update` the update method to validate the request and update the database.

  - Even though we're only displaying the edit button to the author of the Chirp, we still need to make sure the user accessing these routes is authorized:

    - app/Http/Controllers/ChirpController.php

  - Note: You may have noticed the validation rules are duplicated with the `store` method. You might consider extracting them using Laravel's [Form Request Validation](https://laravel.com/docs/validation#form-request-validation), which makes it easy to re-use validation rules and to keep your controllers light.

- **Authorization**

  - By default, the `authorize` method will prevent everyone from being able to update the Chirp. We can specify who is allowed to update it by creating a [Model Policy](https://laravel.com/docs/authorization#creating-policies) with the following command:

    ```
    php artisan make:policy ChirpPolicy --model=Chirp
    ```

    - This will create a policy class at `app/Policies/ChirpPolicy.php` which we can update to specify that only the author is authorized to update a Chirp:

      - app/Policies/ChirpPolicy.php

- **Testing it out**

  - Time to test it out! Go ahead and edit a few Chirps using the dropdown menu. If you register another user account, you'll see that only the author of a Chirp can edit it.

### Deleting Chirps

- Sometimes no amount of editing can fix a message, so let's give our users the ability to delete their Chirps.

- Hopefully you're starting to get the hang of things now. We think you'll be impressed how quickly we can add this feature.

- **Routing**

  - We'll start again by updating our routes to enable the `chirps.destroy` route:

    - routes/web.php

  - Our route table for this controller now looks like this:

    | Verb      | URI                  | Action  | Route Name     |
    | --------- | -------------------- | ------- | -------------- |
    | GET       | /chirps              | index   | chirps.index   |
    | POST      | /chirps              | store   | chirps.store   |
    | GET       | /chirps/{chirp}/edit | edit    | chirps.edit    |
    | PUT/PATCH | /chirps/{chirp}      | update  | chirps.update  |
    | DELETE    | /chirps/{chirp}      | destroy | chirps.destroy |

- **Updating our controller**

  - Now we can update the `destroy` method on our `ChirpController` class to perform the deletion and return to the Chirp index:

    - app/Http/Controllers/ChirpController.php

- **Authorization**

  - As with editing, we only want our Chirp authors to be able to delete their Chirps, so let's update the `delete` method in our `ChirpPolicy` class:

    - app/Policies/ChirpPolicy.php

  - Rather than repeating the logic from the `update` method, we can define the same logic by calling the `update` method from our `destroy` method. Anyone that is authorized to update a Chirp will now be authorized to delete it as well.

- **Updating our view**

  - Finally, we can add a delete button to the dropdown menu we created earlier in our `chirps.index` view:

    - resources/views/chirps/index.blade.php

- **Testing it out**

  - If you Chirped anything you weren't happy with, try deleting it!

### Notifications & Events

- Let's take Chirper to the next level by sending [email notifications](https://laravel.com/docs/notifications#introduction) when a new Chirp is created.

- In addition to support for sending email, Laravel provides support for sending notifications across a variety of delivery channels, including email, SMS, and Slack. Plus, a variety of community built notification channels have been created to send notification over dozens of different channels! Notifications may also be stored in a database so they may be displayed in your web interface.

- **Creating the notification**

  - Artisan can, once again, do all the hard work for us with the following command:

    ```
    php artisan make:notification NewChirp
    ```

    - This will create a new notification at `app/Notifications/NewChirp.php` that is ready for us to customize.

  - Let's open the `NewChirp` class and allow it to accept the `Chirp` that was just created, and then customize the message to include the author's name and a snippet from the message:

    - app/Notifications/NewChirp.php

  - We could send the notification directly from the `store` method on our `ChirpController` class, but that adds more work for the controller, which in turn can slow down the request, especially as we'll be querying the database and sending emails.

  - Instead, let's dispatch an event that we can listen for and process in a background queue to keep our application snappy.

- **Creating an event**

  - Events are a great way to decouple various aspects of your application, since a single event can have multiple listeners that do not depend on each other.

  - Let's create our new event with the following command:

    ```
    php artisan make:event ChirpCreated
    ```

    - This will create a new event class at `app/Events/ChirpCreated.php`.

  - Since we'll be dispatching events for each new Chirp that is created, let's update our `ChirpCreated` event to accept the newly created `Chirp` so we may pass it on to our notification:

    - app/Events/ChirpCreated.php

- **Dispatching the event**

  - Now that we have our event class, we're ready to dispatch it any time a Chirp is created. You may [dispatch events](https://laravel.com/docs/events#dispatching-events) anywhere in your application lifecycle, but as our event relates to the creation of an Eloquent model, we can configure our `Chirp` model to dispatch the event for us.

    - app/Models/Chirp.php

    - **Ref**: Eloquent Events

      - Eloquent models dispatch several events, allowing you to hook into the following moments in a model's lifecycle: `retrieved`, `creating`, `created`, `updating`, `updated`, `saving`, `saved`, `deleting`, `deleted`, `trashed`, `forceDeleting`, `forceDeleted`, `restoring`, `restored`, and `replicating`.

      - The `retrieved` event will dispatch when an existing model is retrieved from the database. When a new model is saved for the first time, the `creating` and `created` events will dispatch. The `updating` / `updated` events will dispatch when an existing model is modified and the `save` method is called. The `saving` / `saved` events will dispatch when a model is created or updated - even if the model's attributes have not been changed. Event names ending with `-ing` are dispatched before any changes to the model are persisted, while events ending with `-ed` are dispatched after the changes to the model are persisted.

      - To start listening to model events, define a `$dispatchesEvents` property on your Eloquent model. This property maps various points of the Eloquent model's lifecycle to your own [event classes](https://laravel.com/docs/10.x/events). Each model event class should expect to receive an instance of the affected model via its constructor:

      ```php
      <?php

      namespace App\Models;

      use App\Events\UserDeleted;
      use App\Events\UserSaved;
      use Illuminate\Foundation\Auth\User as Authenticatable;
      use Illuminate\Notifications\Notifiable;

      class User extends Authenticatable
      {
          use Notifiable;

          /**
          * The event map for the model.
          *
          * @var array
          */
          protected $dispatchesEvents = [
              'saved' => UserSaved::class,
              'deleted' => UserDeleted::class,
          ];
      }
      ```

      - After defining and mapping your Eloquent events, you may use [event listeners](https://laravel.com/docs/10.x/events#defining-listeners) to handle the events.

      - Note: When issuing a mass update or delete query via Eloquent, the `saved`, `updated`, `deleting`, and `deleted` model events will not be dispatched for the affected models. This is because the models are never actually retrieved when performing mass updates or deletes.

    - Now any time a new `Chirp` is created, the `ChirpCreated` event will be dispatched.

- **Creating an event listener**

  - Now that we're dispatching an event, we're ready to listen for that event and send our notification.

  - Let's create a listener that subscribes to our `ChirpCreated` event:

    ```
    php artisan make:listener SendChirpCreatedNotifications --event=ChirpCreated
    ```

  - The new listener will be placed at `app/Listeners/SendChirpCreatedNotifications.php`. Let's update the listener to send our notifications.

    - app/Listeners/SendChirpCreatedNotifications.php

    - We've marked our listener with the `ShouldQueue` interface, which tells Laravel that the listener should be run in a [queue](https://laravel.com/docs/queues). By default, the "sync" queue will be used to process jobs synchronously; however, you may configure a queue worker to process jobs in the background.

    - We've also configured our listener to send notifications to every user in the platform, except the author of the Chirp. In reality, this might annoy users, so you may want to implement a "following" feature so users only receive notifications for accounts they follow.

    - We've used a [database cursor](https://laravel.com/docs/eloquent#cursors) to avoid loading every user into memory at once.

      - Eloquent Cursors

        - Similar to the `lazy` method, the `cursor` method may be used to significantly reduce your application's memory consumption when iterating through tens of thousands of Eloquent model records.

        - The `cursor` method will only execute a single database query; however, the individual Eloquent models will not be hydrated until they are actually iterated over. Therefore, only one Eloquent model is kept in memory at any given time while iterating over the cursor.

        - Note: Since the `cursor` method only ever holds a single Eloquent model in memory at a time, it cannot eager load relationships. If you need to eager load relationships, consider using [the **lazy** method](https://laravel.com/docs/10.x/eloquent#chunking-using-lazy-collections) instead.

        - Internally, the `cursor` method uses PHP [generators](https://www.php.net/manual/en/language.generators.overview.php) to implement this functionality:

          ```php
          use App\Models\Flight;

          foreach (Flight::where('destination', 'Zurich')->cursor() as $flight) {
          // ...
          }
          ```

        - The `cursor` returns an `Illuminate\Support\LazyCollection` instance. [Lazy collections](https://laravel.com/docs/10.x/collections#lazy-collections) allow you to use many of the collection methods available on typical Laravel collections while only loading a single model into memory at a time:

          ```php
          use App\Models\User;

          $users = User::cursor()->filter(function (User $user) {
              return $user->id > 500;
          });

          foreach ($users as $user) {
              echo $user->id;
          }
          ```

        - Although the `cursor` method uses far less memory than a regular query (by only holding a single Eloquent model in memory at a time), it will still eventually run out of memory. This is [due to PHP's PDO driver internally caching all raw query results in its buffer](https://www.php.net/manual/en/mysqlinfo.concepts.buffering.php). If you're dealing with a very large number of Eloquent records, consider using [the **lazy** method](https://laravel.com/docs/10.x/eloquent#chunking-using-lazy-collections) instead.

  - Note: In a production application you should add the ability for your users to unsubscribe from notifications like these.

  - **Registering the event listener**

    - Finally, let's bind our event listener to the event. This will tell Laravel to invoke our event listener when the corresponding event is dispatched. We can do this within our `EventServiceProvider` class:

      - App\Providers\EventServiceProvider.php

- **Testing it out**

  - You may utilize local email testing tools like [Mailpit](https://github.com/axllent/mailpit) and [HELO](https://usehelo.com/) to catch any emails coming from your application so you may view them. If you are developing via Docker and Laravel Sail then Mailpit is included for you.

  - Alternatively, you may configure Laravel to write mail to a log file by editing the `.env` file in your project and changing the `MAIL_MAILER` environment variable to `log`. By default, emails will be written to a log file located at `storage/logs/laravel.log`.

  - We've configured our notification not to send to the Chirp author, so be sure to register at least two users accounts. Then, go ahead and post a new Chirp to trigger a notification.

  - If you're using Mailpit, navigate to http://localhost:8025/, where you will find the notification for the message you just chirped!

    - Ref: Mailpit Setup

      - Install via bash script (Linux & Mac)

        - Linux & Mac users can install it directly to `/usr/local/bin/mailpit` with:

          ```
          sudo bash < <(curl -sL https://raw.githubusercontent.com/axllent/mailpit/develop/install.sh)
          ```

      - Run Mailpit

        ```
        mailpit
        ```

      - Note: .env setup for Mailpit

        - MAIL_HOST=localhost

          - `mailpit` is set as the default to work with Laravel Sail, since Docker handles the resolution of the service. If you're not using Laravel Sail and Docker `localhost` must be used since your local machine cannot resolve the namespace.

  - **Sending emails in production**

    - To send real emails in production, you will need an SMTP server, or a transactional email provider, such as Mailgun, Postmark, or Amazon SES. Laravel supports all of these out of the box. For more information, take a look at the [Mail documentation](https://laravel.com/docs/mail#introduction)

## Build Chirper with Inertia

### Installation

### Installation

- **Installing Laravel**

  - Quick Installation

    - If you have already installed PHP and Composer on your local machine, you may create a new Laravel project via Composer:

      ```
      composer create-project laravel/laravel chirper
      ```

    - After the project has been created, start Laravel's local development server using the Laravel's Artisan CLI serve command:

      ```
      cd chirper

      php artisan serve
      ```

    - Once you have started the Artisan development server, your application will be accessible in your web browser at http://localhost:8000.

    - For simplicity, you may use SQLite to store your application's data. To instruct Laravel to use SQLite instead of MySQL, update your new application's `.env` file and remove all of the `DB_*` environment variables except for the `DB_CONNECTION` variable, which should be set to `sqlite`:

      ```
      DB_CONNECTION=sqlite
      ```

  - Installation via Docker

    - If you do not have PHP installed locally, you may develop your application using [Laravel Sail](https://laravel.com/docs/sail), a light-weight command-line interface for interacting with Laravel's default Docker development environment, which is compatible with all operating systems. Before we get started, make sure to install [Docker](https://docs.docker.com/get-docker/) for your operating system. For alternative installation methods, check out our full [installation guide](https://laravel.com/docs/installation).

    - The easiest way to install Laravel is using our `laravel.build` service, which will download and create a fresh Laravel application for you. Launch a terminal and run the following command:

      ```
      curl -s "https://laravel.build/chirper" | bash
      ```

    - Sail installation may take several minutes while Sail's application containers are built on your local machine.

    - By default, the installer will pre-configure Laravel Sail with a number of useful services for your application, including a MySQL database server. You may [customize the Sail services](https://laravel.com/docs/installation#choosing-your-sail-services) if needed.

    - After the project has been created, you can navigate to the application directory and start Laravel Sail:

      ```
      cd chirper

      ./vendor/bin/sail up
      ```

    - Note: You can [create a shell alias](https://laravel.com/docs/sail#configuring-a-shell-alias) that allows you execute Sail's commands more easily.

    - When developing applications using Sail, you may execute Artisan, NPM, and Composer commands via the Sail CLI instead of invoking them directly:

      ```
      ./vendor/bin/sail php --version
      ./vendor/bin/sail artisan --version
      ./vendor/bin/sail composer --version
      ./vendor/bin/sail npm --version
      ```

    - Once the application's Docker containers have been started, you can access the application in your web browser at: http://localhost.

- **Installing Laravel Breeze**

  - Next, we will give your application a head-start by installing [Laravel Breeze](https://laravel.com/docs/starter-kits#laravel-breeze), a minimal, simple implementation of all of Laravel's authentication features, including login, registration, password reset, email verification, and password confirmation. Once installed, you are welcome to customize the components to suit your needs.

  - Laravel Breeze offers several options for your view layer, including Blade templates, or [Vue](https://vuejs.org/) and [React](https://reactjs.org/) with [Inertia](https://inertiajs.com/). For this tutorial, you have the option of Vue or React.

  - Open a new terminal in your `chirper` project directory and install your chosen stack with the given commands:

    - React

      ```
      composer require laravel/breeze --dev

      php artisan breeze:install react
      ```

    - Vue

      ```
      composer require laravel/breeze --dev

      php artisan breeze:install vue
      ```

  - Breeze will install and configure your front-end dependencies for you, so we just need to start the Vite development server to enable instant hot-module replacement while we build our application:

    ```
    npm run dev
    ```

  - Finally, open another terminal in your chirper project directory and run the initial database migrations to populate the database with the default tables from Laravel and Breeze:

    ```
    php artisan migrate
    ```

  - If you refresh your new Laravel application in the browser, you should now see a "Register" link at the top-right. Follow that to see the registration form provided by Laravel Breeze.

  - Register yourself an account and log in!

### Creating Chirps

- **Inertia**

  - Not impressed yet? Let's update the `index` method of our `ChirpController` class to render a front-end page component using Inertia. Inertia is what links our Laravel application with our Vue or React front-end:

    - app/Http/Controllers/ChirpController.php

  - We can then create our front-end `Chirps/Index` page component with a form for creating new Chirps:

    - resources/js/Pages/Chirps/Index.jsx

  - That's it! Refresh the page in your browser to see your new form rendered in the default layout provided by Breeze!

  - Now that our front-end is powered by JavaScript, any changes we make to our JavaScript templates will be automatically reloaded in the browser whenever the Vite development server is running via `npm run dev`.

- **Navigation menu**

  - Let's take a moment to add a link to the navigation menu provided by Breeze.

  - Update the `AuthenticatedLayout` component provided by Breeze to add a menu item for desktop screens:

    - resources/js/Layouts/AuthenticatedLayout.jsx

  - And also for mobile screens:

    - resources/js/Layouts/AuthenticatedLayout.jsx

- **Saving the Chirp**

- **Creating a relationship**

- **Mass assignment protection**

- **Updating the migration**

- **Testing it out**

  - Artisan Tinker

### Showing Chirps

### Editing Chirps

### Deleting Chirps

### Notifications & Events

## Deploying

## Conclusion
