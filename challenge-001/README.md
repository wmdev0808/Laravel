# About

We don't learn tools for the sake of learning tools. Instead, we learn them because they help us accomplish a particular goal. With that in mind, in this series, we'll use the common desire for a blog - with categories, tags, comments, email notifications, and more - as our goal. Laravel will be the tool that helps us get there. Each lesson, geared toward newcomers to Laravel, will provide instructions and techniques that will get you to the finish line.

# 1. Prerequisites and Setup

## 01. An Animated Introduction to MVC

- About

  Before we get started, come along for a quick two minute overview of the MVC architecture. MVC stands for "Model, View, Controller" and is the bedrock for building Laravel applications.

## 02. Initial Environment Setup and Composer

- About

  - I hope you're excited. It's time to dig in. Now, as for prerequisites, you'll need access to a good editor, a terminal, and of course PHP and MySQL. We'll also need to get a tool called [Composer](https://getcomposer.org/) installed on your machine.

- Your First Laravel Project

  - Via the Composer `create-project` command:

    ```bash
    composer create-project laravel/laravel example-app
    ```

  - By globally installing the Laravel installer via Composer:

    ```bash
    composer global require laravel/installer

    laravel new example-app
    ```

  - After the project has been created, start Laravel's local development server using the Laravel's Artisan CLI `serve` command:

    ```bash
    cd example-app

    php artisan serve
    ```

    - Note:

      - To expose the host

        ```bash
        php artisan serve --host=0.0.0.0
        ```

## 03. The Laravel Installer Tool

- About

  - It's very cool that we can whip up a fresh Laravel application by using `composer create-project`; however, there's an even simpler option that allows you to type laravel new project and, bam, you're up and running. In this episode, let's install it globally on our machine.

  - Extra Credit: Install [Laravel Valet](https://laravel.com/docs/10.x/valet#main-content) to make any new Laravel project accessible via http://app-name.test.

## 04. Why Do We Use Tools

- About

  - We don't learn tools for the sake of learning tools. Instead, we learn tools because they help us accomplish something, or solve a problem that we currently have. As an example, you didn't learn how to use a hammer because you wanted to learn how to use a hammer. No, you learned it because it helped you hang a picture on the wall. The same is true for programming languages and frameworks, like Laravel. With that in mind, our goal is one of the most common goals on the internet: build a functional blog to promote our band, or business, or ideas.

  - Extra Credit: Consider watching the optional [HTML and CSS Workflow](http://laracasts.com/series/html-and-css-workshop) prerequisite series that was mentioned in this video.

# 2. The Basics

## 05. How a Route Loads a View

- About

  Let's begin with the basics. If you load the home page for any new Laravel app in the browser, you'll see a basic "welcome" splash page. In this lesson, we'll figure out how a route "listens" for a URI and then loads a view (or HTML) in response.

## 06. Include CSS and JavaScript

- About

  Now that we understand how a particular URI ultimately loads a piece of HTML, let's now figure out how to include some generic CSS and JavaScript assets.

## 07. Make a Route and Link to it

- The simplest form of our blog will surely consist of a list of blog post excerpts, which then individually link to a different page that contains the full post. Let's begin working toward that goal.

## 08. Store Blog Posts as HTML Files

- About

  Before we reach for a database, let's discuss how to store each blog post within its own HTML file. Then, in our routes file, we can use a route wildcard to determine which post needs to be fetched and passed to the view.

## 09. Route Wildcard Constraints

- About

  - Sometimes, you'll wish to limit a route wildcard to only a certain sequence or pattern of characters. Luckily, Laravel makes this a cinch. In this episode, we'll add a constraint to our route to ensure that the blog post slug consists exclusively of any combination of letters, numbers, dashes, and underscores.

## 10. Use Caching for Expensive Operations

- About

  Reaching for `file_get_contents()` each time a blog post is viewed isn't ideal. Think about it: if ten thousand people view a blog post at the same time, that means you're calling `file_get_contents()` ten thousand times. That surely seems wasteful, particularly when blog posts rarely change. What if we instead cached the HTML for each post to improve performance? Learn how in this episode.

## 11. Use the Filesystem Class to Read a Directory

- About

  Let's now figure out to fetch and read all posts within the `resources/posts` directory. Once we have a suitable array, we can then loop over them and display each on the main blog overview page.

## 12. Find a Composer Package for Post Metadata

- About

  At the conclusion of the previous episode, we considered adding metadata to the top of each post file. As it turns out, this metadata format has a name: Yaml Front Matter. Let's see if we can [find a Composer package](https://github.com/spatie/yaml-front-matter) to help us parse it. This will give us a nice opportunity to learn how easy and useful Composer is.

- Problem

  - In the previous episode, files are read by alphabetically. We need a metadata for each file so we can easily sort them based on it. For example,

    - my-fourth-post.html

          ---
          title: My Fourth Post
          excerpt: Lorem ipsum dolor sit amet consectetur
          adipisicing elit. date: 2023-06-17
          ---
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam blanditiis
            alias a deleniti aliquam sed exercitationem natus, consequuntur
            reiciendis amet excepturi labore vero voluptatibus, voluptate debitis?
            Labore id nemo atque!
          </p>

## 13. Collection Sorting and Caching Refresher

- About

  Each post now includes the publish date as part of its metadata, however, the feed is not currently sorted according to that date. Luckily, because we're using Laravel collections, tasks like this our a cinch. In this episode, we'll fix the sorting and then discuss "forever" caching.

- Check cache

  - Open Laravel Tinker

        php artisan tinker
        cache('posts.all')
        = null

  - Refresh the page and then run the command again, we must have contents in the cache now.

        >>> cache('posts.all')
        => Illuminate\Support\Collection...

  - When we add a new page, we are not refreshing the cache

        >>> cache()->forget('posts.all');
        = true

  - Now refresh the page, we will get the last added post as well

        >>> cache()->get('posts.all');
        => Illuminate\Support\Collection ...

  - Experiment other cache methods:

        >>> cache()->put('foo', 'bar');
        = true
        >>> cache()->get('foo');
        = "bar"

        >>> cache(['foo' => 'buzz']);
        => true
        >>> cache('foo');
        => "buzz"

        > cache(['foo' => 'buzz'], now()->addSeconds(3));
        = true

        > cache('foo');
        = null

# 3. Blade

## 14. Blade: The Absolute Basics

- About

  Blade is Laravel's templating engine for your views. You can think of it as a layer on top of PHP to make the syntax required for constructing these views as clean and terse as possible. Ultimately, these Blade templates will be compiled to vanilla PHP behind the scenes.

- A file name should be suffixed by `.blade.php` so it can be compiled into vanilla php.

  - You can check the compiled version at `storage/framework/views/`

        <?php echo e($post->title); ?>

- resources/views/post.blade.php

      ...
      {{ $post->body }}
      ...

  - Then you will get the escaped content, to fix this:

        {!! $post->body !!}

- Use blade directives

  - Instead of using `foreach` statement, you can use a blade directive, `@foreach`

  - You can also use `$loop`

        @dd($loop)

    - posts.blade.php

          ...
          <article class="{{ $loop->even ? 'foobar' : '' }}">

  - There are always vanilla PHP statement equivalent Blade directives:

    - for example

          @if (ture)

          @endif

          @unless

          @endunless

## 15. Blade Layouts Two Ways

- About

  The next problem we need to solve relates to the fact that each of our views contains the full HTML structure - including any potential scripts and stylesheets. This means, should we need to add a new stylesheet, we must update every single view. This clearly won't do. Instead, we can reach for layout files to reduce duplication. In this episode, I'll demonstrate two different ways to create layouts.

- 1. Create and use layout views using `@yield`, `@extends` and `@section`

  - Bottom-up approach

- 2. Use Blade Components

  - Up-down approach

## 16. A Few Tweaks and Consideration

- About

  Before we move on to the next chapter, on databases, let's make a couple tweaks to wrap up these last two sections. First, we'll remove the route constraint that is no longer required. Then, we'll consider the benefits of adding a second `Post::findOrFail()` method that automatically aborts if no post matching the given slug is found.

# 4. Working with Databases

## 17. Environment Files and Database Connections

- About

  Every application will require a certain amount of environment-specific configuration. Examples for this might be the name of the database you're connecting to, or which mail host and port your app uses, or even special keys and secret tokens that third party APIs provide you. You can store configuration like this within your `.env` file, which is located in your project root. In this episode, we'll discuss the essentials of environment files, and then move on to connecting to a MySQL database (using [TablePlus](https://www.tableplus.io/download)).

- .env

  - Config file for app, db, mail, third-party app config

- Database config

  - /config/database.php

- Create a new database `blog`

      mysql> create database blog;

- Run migration

      php artisan migrate

## 18. Migrations: The Absolute Basics

- About

  Now that we've properly connected to MySQL, let's switch our attention over to those mysterious migration classes. Think of a migration as a blueprint for a database table.

- /database/migrations/2014_10_12_000000_create_users_table.php

- Rollback migrations

      php artisan migrate:rollback

- Drop all tables and re-run all migrations

      php artisan migrate:fresh

  - If you change `APP_ENV` to `production`, then run the above command:
    - You'll get a prompt asking, `Do you really wish to run this command?`

## 19. Eloquent and the Active Record Pattern

- About

  Let's now move on to Eloquent, which is Laravel's Active Record implementation. Eloquent allows us to map a database table record to a corresponding Eloquent object. In this episode, you'll learn the initial API - which should seem quite familiar if you followed along with the previous chapter.

- Active record pattern

  - The active record pattern is an approach to accessing data in a database. A database table or view is wrapped into a class. Thus an object instance is tied to a single row in the table.

- Artisan Console

  - Artisan is the command line interface included with Laravel. Artisan exists at the root of your application as the `artisan` script and provides a number of helpful commands that can assist you while you build your application. To view a list of all available Artisan commands, you may use the `list` command:

        php artisan list

  - Every command also includes a "help" screen which displays and describes the command's available arguments and options. To view a help screen, precede the name of the command with `help`:

        php artisan help migrate

- Tinker (REPL)

  - Laravel Tinker is a powerful REPL for the Laravel framework, powered by the [PsySH](https://github.com/bobthecow/psysh) package.

    - `PsySH` is a runtime developer console, interactive debugger and `REPL` for `PHP`.

  - Installation

        composer require laravel/tinker

  - Usage:

    - Tinker allows you to interact with your entire Laravel application on the command line, including your Eloquent models, jobs, events, and more. To enter the Tinker environment, run the `tinker` Artisan command:

          php artisan tinker

    - You can publish Tinker's configuration file using the `vendor:publish` command:

          php artisan vendor:publish --provider="Laravel\Tinker\TinkerServiceProvider"

- In Tinker,

      php artisan tinker

      > $user = new App\Models\User;
      = App\Models\User {#6214}

      > $user->name = 'UserName';
      = "PaulLi"

      > $user->email = 'username@mail.com';
      = "username@mail.com"

      > $user->password = bcrypt('password');
      = "$2y$10$qF1Ed9MXTW.lUniiMW0OMOefHLn7OjP2TUjPE9H6pShwUJTSE58SO"

      > $user->save();
      = true

      > $user->name
      = "UserName"

      > $user->password
      = "$2y$10$qF1Ed9MXTW.lUniiMW0OMOefHLn7OjP2TUjPE9H6pShwUJTSE58SO"

      > $user->email
      = "username@mail.com"

      > $user->name = 'John Doe'
      = "John Doe"

      > $user->save()
      = true

      > User::find(1)
      [!] Aliasing 'User' to 'App\Models\User' for this Tinker session.
      = App\Models\User {#7171
          id: 1,
          name: "John Doe",
          email: "usrname@mail.com",
          email_verified_at: null,
          #password: "$2y$10$qF1Ed9MXTW.lUniiMW0OMOefHLn7OjP2TUjPE9H6pShwUJTSE58SO",
          #remember_token: null,
          created_at: "2023-06-19 14:04:32",
          updated_at: "2023-06-19 14:09:01",
        }

      > User::find(10)
      = null

      > User::findOrFail(10);

        Illuminate\Database\Eloquent\ModelNotFoundException  No query results for model [App\Models\User] 10.

      > User::all()
      = Illuminate\Database\Eloquent\Collection {#7227
          all: [
            App\Models\User {#7225
              id: 1,
              name: "John Doe",
              email: "username@mail.com",
              email_verified_at: null,
              #password: "$2y$10$qF1Ed9MXTW.lUniiMW0OMOefHLn7OjP2TUjPE9H6pShwUJTSE58SO",
              #remember_token: null,
              created_at: "2023-06-19 14:04:32",
              updated_at: "2023-06-19 14:09:01",
            },
          ],
        }

      > $user = new User;
      = App\Models\User {#7221}

      > $user->name = 'Sally'
      = "Sally"

      > $user->email = 'sally@example.com'
      = "sally@example.com"

      > $user->password = bcrypt('password');
      = "$2y$10$Xrb3nbHFMgwbdVTWzg0Gp.SpqzkddZVzRR0Wt.5.iuN4NKmhaSAm."

      > $user->save()
      = true

      > User::all()
      [!] Aliasing 'User' to 'App\Models\User' for this Tinker session.
      = Illuminate\Database\Eloquent\Collection {#6551
          all: [
            App\Models\User {#7169
              id: 1,
              name: "John Doe",
              email: "username@mail.com",
              email_verified_at: null,
              #password: "$2y$10$qF1Ed9MXTW.lUniiMW0OMOefHLn7OjP2TUjPE9H6pShwUJTSE58SO",
              #remember_token: null,
              created_at: "2023-06-19 14:04:32",
              updated_at: "2023-06-19 14:14:49",
            },
            App\Models\User {#7170
              id: 2,
              name: "Sally",
              email: "sally@example.com",
              email_verified_at: null,
              #password: "$2y$10$Xrb3nbHFMgwbdVTWzg0Gp.SpqzkddZVzRR0Wt.5.iuN4NKmhaSAm.",
              #remember_token: null,
              created_at: "2023-06-19 14:16:44",
              updated_at: "2023-06-19 14:16:44",
            },
          ],
        }

      > $users = User::all();
      = Illuminate\Database\Eloquent\Collection {#7178
          all: [
            App\Models\User {#7176
              id: 1,
              name: "John Doe",
              email: "username@mail.com",
              email_verified_at: null,
              #password: "$2y$10$qF1Ed9MXTW.lUniiMW0OMOefHLn7OjP2TUjPE9H6pShwUJTSE58SO",
              #remember_token: null,
              created_at: "2023-06-19 14:04:32",
              updated_at: "2023-06-19 14:14:49",
            },
            App\Models\User {#7175
              id: 2,
              name: "Sally",
              email: "sally@example.com",
              email_verified_at: null,
              #password: "$2y$10$Xrb3nbHFMgwbdVTWzg0Gp.SpqzkddZVzRR0Wt.5.iuN4NKmhaSAm.",
              #remember_token: null,
              created_at: "2023-06-19 14:16:44",
              updated_at: "2023-06-19 14:16:44",
            },
          ],
        }

      > $users->pluck('name');
      = Illuminate\Support\Collection {#6551
          all: [
            "John Doe",
            "Sally",
          ],
        }

      > $users->map(function($user) { return $user->name; });
      = Illuminate\Support\Collection {#6213
          all: [
            "John Doe",
            "Sally",
          ],
        }

      > $users->first();
      = App\Models\User {#7176
          id: 1,
          name: "John Doe",
          email: "username@mail.com",
          email_verified_at: null,
          #password: "$2y$10$qF1Ed9MXTW.lUniiMW0OMOefHLn7OjP2TUjPE9H6pShwUJTSE58SO",
          #remember_token: null,
          created_at: "2023-06-19 14:04:32",
          updated_at: "2023-06-19 14:14:49",
        }

      > $users[0]
      = App\Models\User {#7176
          id: 1,
          name: "John Doe",
          email: "username@mail.com",
          email_verified_at: null,
          #password: "$2y$10$qF1Ed9MXTW.lUniiMW0OMOefHLn7OjP2TUjPE9H6pShwUJTSE58SO",
          #remember_token: null,
          created_at: "2023-06-19 14:04:32",
          updated_at: "2023-06-19 14:14:49",
        }

      >

## 20. Make a Post Model and Migration

- About

  Now that you're a bit more familiar with migration classes and Eloquent models, let's apply this learning to our blog project. We'll remove the old file-based implementation from the previous chapter, and replace it with a brand new Post Eloquent model. We'll also prepare a migration to build up the posts table.

- The relevant PHP Artisan Make commands

  - `make:model` : Create a new Eloquent model class
  - `make:migration` : Create a new migration file

    - For details of the command:

          php artisan help make:migration

- Create a migration for Post model

      php artisan make:migration create_posts_table

- /database/migrations/2023_06_20_005430_create_posts_table.php

      ...
      public function up(): void
      {
          Schema::create('posts', function (Blueprint $table) {
              $table->id();
              $table->string('title');
              $table->text('excerpt');
              $table->text('body');
              $table->timestamps();
              $table->timestamp('published_at')->nullable();
          });
      }

- Run migration

      php artisan migrate

- Create a new model

      php artisan make:model Post

- In Tinker

      php artisan tinker

      > App\Models\Post::all()
      = Illuminate\Database\Eloquent\Collection {#6954
          all: [],
        }

      > App\Models\Post::count()
      = 0

      > $post->title = 'My First Post';
      = "My First Post"

      > $post->excerpt = 'Lorem ipsum dolor sit amet consectetur adipisicing elit.';
      = "Lorem ipsum dolor sit amet consectetur adipisicing elit."

      > $post->body = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam blanditiis'
      = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam blanditiis"

      > $post->save();
      = true

      > use App\Models\Post;
      > Post::count();
      = 1

      > Post::all();
      = Illuminate\Database\Eloquent\Collection {#6954
          all: [
            App\Models\Post {#7175
              id: 1,
              title: "My First Post",
              excerpt: "Lorem ipsum dolor sit amet consectetur adipisicing elit.",
              body: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam blanditiis alias a deleniti aliquam sed exercitationem natus, consequuntur reiciendis amet excepturi labore vero voluptatibus, voluptate debitis? Labore id nemo",
              created_at: "2023-06-20 01:28:16",
              updated_at: "2023-06-20 01:28:16",
              published_at: null,
            },
          ],
        }

      > Post::first();
      = App\Models\Post {#7172
          id: 1,
          title: "My First Post",
          excerpt: "Lorem ipsum dolor sit amet consectetur adipisicing elit.",
          body: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam blanditiis alias a deleniti aliquam sed exercitationem natus, consequuntur reiciendis amet excepturi labore vero voluptatibus, voluptate debitis? Labore id nemo",
          created_at: "2023-06-20 01:28:16",
          updated_at: "2023-06-20 01:28:16",
          published_at: null,
        }

      > Post::find(1);
      = App\Models\Post {#7174
          id: 1,
          title: "My First Post",
          excerpt: "Lorem ipsum dolor sit amet consectetur adipisicing elit.",
          body: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam blanditiis alias a deleniti aliquam sed exercitationem natus, consequuntur reiciendis amet excepturi labore vero voluptatibus, voluptate debitis? Labore id nemo",
          created_at: "2023-06-20 01:28:16",
          updated_at: "2023-06-20 01:28:16",
          published_at: null,
        }

      > $post = Post::find(1);
      = App\Models\Post {#6954
          id: 1,
          title: "My First Post",
          excerpt: "Lorem ipsum dolor sit amet consectetur adipisicing elit.",
          body: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam blanditiis alias a deleniti aliquam sed exercitationem natus, consequuntur reiciendis amet excepturi labore vero voluptatibus, voluptate debitis? Labore id nemo",
          created_at: "2023-06-20 01:28:16",
          updated_at: "2023-06-20 01:28:16",
          published_at: null,
        }

      > $post->title;
      = "My First Post"

      > $post->excerpt;
      = "Lorem ipsum dolor sit amet consectetur adipisicing elit."

      > $post->body;
      = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam blanditiis alias a deleniti aliquam sed exercitationem natus, consequuntur reiciendis amet excepturi labore vero voluptatibus, voluptate debitis? Labore id nemo"

      >

## 21. Eloquent Updates and HTML Escaping

## 22. 3 Ways to Mitigate Mass Assignment Vulnerabilities

## 23. Route Model Binding

## 24. Your First Eloquent Relationship

## 25. Show All Posts Associated With a Category

## 26. Clockwork, and the N+1 Problem

## 27. Database Seeding Saves Time

## 28. Turbo Boost With Factories

## 29. View All Posts By An Author

## 30. Eager Load Relationships on an Existing Model

# 5. Integrate the Design

## 31. Convert the HTML and CSS to Blade

## 32. Blade Components and CSS Grids

## 33. Convert the Blog Post Page

## 34. A Small JavaScript Dropdown Detour

## 35. How to Extract a Dropdown Blade Component

## 36. Quick Tweaks and Clean-Up

# 6. Search

## 37. Search (The Messy Way)

## 38. Search (The Cleaner Way)

# 7. Filtering

## 39. Advanced Eloquent Query Constraints

## 40. Extract a Category Dropdown Blade Component

## 41. Author Filtering

## 42. Merge Category and Search Queries

## 43. Fix a Confusing Eloquent Query Bug

# 8. Pagination

## 44. Laughably Simple Pagination

# 9. Forms and Authentication

## 45. Build a Register User Page

## 46. Automatic Password Hashing With Mutators

## 47. Failed Validation and Old Input Data

## 48. Show a Success Flash Message

## 49. Login and Logout

## 50. Build the Log In Page

## 51. Laravel Breeze Quick Peek

# 10. Comments

## 52. Write the Markup for a Post Comment

## 53. Table Consistency and Foreign Key Constraints

## 54. Make the Comments Section Dynamic

## 55. Design the Comment Form

## 56. Activate the Comment Form

## 57. Some Light Chapter Clean Up

# 11. Newsletters and APIs

## 58. Mailchimp API Tinkering

## 59. Make the Newsletter Form Work

## 60. Extract a Newsletter Service

## 61. Toy Chests and Contracts

# 12. Admin Section

## 62. Limit Access to Only Admins

## 63. Create the Publish Post Form

## 64. Validate and Store Post Thumbnails

## 65. Extract Form-Specific Blade Components

## 66. Extend the Admin Layout

## 67. Create a Form to Edit and Delete Posts

## 68. Group and Store Validation Logic

## 69. All About Authorization

# 13. Conclusion

## 70. Goodbye and Next Steps
