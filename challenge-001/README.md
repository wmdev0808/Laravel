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

- VS code setup

  - Install `Laravel Blade Snippets`

  - Install `Laravel Blade formatter`

    - settings.json

      ```json
      "bladeFormatter.format.noMultipleEmptyLines": true,
      "[blade]": {
        "editor.defaultFormatter": "shufo.vscode-blade-formatter"
      }
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

- About

  In this lesson, we'll briefly discuss how to go about updating database records using Eloquent. Then, we'll review an example of why escaping user-provided input is essential for the security of your application.

- Wrap body field with HTML paragraph

      > $post = App\Models\Post::first();
      = App\Models\Post {#7170
          id: 1,
          title: "My First Post",
          excerpt: "Lorem ipsum dolor sit amet consectetur adipisicing elit.",
          body: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam blanditiis alias a deleniti aliquam sed exercitationem natus, consequuntur reiciendis amet excepturi labore vero voluptatibus, voluptate debitis? Labore id nemo",
          created_at: "2023-06-20 01:28:16",
          updated_at: "2023-06-20 01:28:16",
          published_at: null,
        }

      > $post->body;
      = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam blanditiis alias a deleniti aliquam sed exercitationem natus, consequuntur reiciendis amet excepturi labore vero voluptatibus, voluptate debitis? Labore id nemo"

      > $post->body = '<p>' . $post->body . '</p>';
      = "<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam blanditiis alias a deleniti aliquam sed exercitationem natus, consequuntur reiciendis amet excepturi labore vero voluptatibus, voluptate debitis? Labore id nemo</p>"

      > $post
      = App\Models\Post {#7170
          id: 1,
          title: "My First Post",
          excerpt: "Lorem ipsum dolor sit amet consectetur adipisicing elit.",
          body: "<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam blanditiis alias a deleniti aliquam sed exercitationem natus, consequuntur reiciendis amet excepturi labore vero voluptatibus, voluptate debitis? Labore id nemo</p>",
          created_at: "2023-06-20 01:28:16",
          updated_at: "2023-06-20 01:28:16",
          published_at: null,
        }

      > $post->save();
      = true

      >

- If we include HTML tags in the middle of the value, Laravel will escape it

      > use App\Models\Post;
      > $post = Post::first();
      = App\Models\Post {#6913
          id: 1,
          title: "My First Post",
          excerpt: "Lorem ipsum dolor sit amet consectetur adipisicing elit.",
          body: "<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam blanditiis alias a deleniti aliquam sed exercitationem natus, consequuntur reiciendis amet excepturi labore vero voluptatibus, voluptate debitis? Labore id nemo</p>",
          created_at: "2023-06-20 01:28:16",
          updated_at: "2023-06-20 09:28:33",
          published_at: null,
        }

      > $post->title = 'My <strong>First</strong> Post';
      = "My <strong>First</strong> Post"

      > $post->save();
      = true

      >

  - Now `My <strong>First</strong> Post` will be shown on the page because Laravel will escape

- Why Laravel escape HTML tags?

  - Suppose that we update the `title` to include HTML `script` tag:

        > $post->title = 'My Post <script>alert("hello")</script>';
        = "My Post <script>alert("hello")</script>"

        > $post->save();
        = true

        >

  - When you visite the post page, the JavaScript code(`alert`) will be executed.
  - That's why, Laravel escape values by default

        {{ $post->title }}

    - Output:

          My Post <script>alert("hello")</script>

## 22. 3 Ways to Mitigate Mass Assignment Vulnerabilities

- About

  In this lesson, we'll discuss everything you need to know about mass assignment vulnerabilities. As you'll see, Laravel provides a couple ways to specify which attributes may or may not be mass assigned. However, there's a third option at the conclusion of this video that is equally valid.

- In Tinker

      > $post = new Post
      = App\Models\Post {#7174}

      > $post->title = 'My Third Post';
      = "My Third Post"

      > $post->excerpt = 'excerpt of post';
      = "excerpt of post"

      > $post->body = '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam blanditiis alias a deleniti aliquam sed exercitationem natus, consequuntur reiciendis amet excepturi labore vero voluptatibus, voluptate debitis? Labore id nemoLorem ipsum dolor sit amet consectetur adipisicing elit. Quam blanditiis alias a deleniti aliquam sed exercitationem natus, consequuntur reiciendis amet excepturi labore vero voluptatibus, voluptate debitis? Labore id nemo</p>';
      = "<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam blanditiis alias a deleniti aliquam sed exercitationem natus, consequuntur reiciendis amet excepturi labore vero voluptatibus, voluptate debitis? Labore id nemoLorem ipsum dolor sit amet consectetur adipisicing elit. Quam blanditiis alias a deleniti aliquam sed exercitationem natus, consequuntur reiciendis amet excepturi labore vero voluptatibus, voluptate debitis? Labore id nemo</p>"

      > $post->save();
      = true

      > Post::all();
      = Illuminate\Database\Eloquent\Collection {#7179
          all: [
            App\Models\Post {#7181
              id: 1,
              title: "My Post <script>alert("hello")</script>",
              excerpt: "Lorem ipsum dolor sit amet consectetur adipisicing elit.",
              body: "<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam blanditiis alias a deleniti aliquam sed exercitationem natus, consequuntur reiciendis amet excepturi labore vero voluptatibus, voluptate debitis? Labore id nemo</p>",
              created_at: "2023-06-20 01:28:16",
              updated_at: "2023-06-20 09:45:47",
              published_at: null,
            },
            App\Models\Post {#7182
              id: 2,
              title: "Eloquent is Amazing",
              excerpt: "Lorem ipsum dolor sit amet consectetur adipisicing elit.",
              body: "<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam blanditiis alias a deleniti aliquam sed exercitationem natus, consequuntur reiciendis amet excepturi labore vero voluptatibus, voluptate debitis? Labore id nemoLorem ipsum dolor sit amet consectetur adipisicing elit. Quam blanditiis alias a deleniti aliquam sed exercitationem natus, consequuntur reiciendis amet excepturi labore vero voluptatibus, voluptate debitis? Labore id nemo</p>",
              created_at: "2023-06-20 09:08:14",
              updated_at: "2023-06-20 09:34:23",
              published_at: null,
            },
            App\Models\Post {#7183
              id: 3,
              title: "My Third Post",
              excerpt: "excerpt of post",
              body: "<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam blanditiis alias a deleniti aliquam sed exercitationem natus, consequuntur reiciendis amet excepturi labore vero voluptatibus, voluptate debitis? Labore id nemoLorem ipsum dolor sit amet consectetur adipisicing elit. Quam blanditiis alias a deleniti aliquam sed exercitationem natus, consequuntur reiciendis amet excepturi labore vero voluptatibus, voluptate debitis? Labore id nemo</p>",
              created_at: "2023-06-20 09:55:47",
              updated_at: "2023-06-20 09:55:47",
              published_at: null,
            },
          ],
        }

      >

- Mass-Assignment

      > Post::create(['title' => 'My Fourth Post', 'excerpt' => 'excerpt of post', 'body' => '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam blanditiis alias a deleniti aliquam sed exercitationem natus, consequuntur reiciendis amet excepturi labore vero voluptatibus, voluptate debitis? Labore id nemo</p>']);

        Illuminate\Database\Eloquent\MassAssignmentException  Add [title] to fillable property to allow mass assignment on [App\Models\Post].

      >

- You should now add fields which you want to allow mass assignments into `fillable` property of corresponding model

  - /app/Models/Post.php

        ...
        protected $fillable = ['title'];

- Run again:

      > Post::create(['title' => 'My Fourth Post', 'excerpt' => 'excerpt of post', 'body' => '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam blanditiis alias a deleniti aliquam sed exercitationem natus, consequuntur reiciendis amet excepturi labore vero voluptatibus, voluptate debitis? Labore id nemo</p>']);

        Illuminate\Database\QueryException  SQLSTATE[HY000]: General error: 1364 Field 'excerpt' doesn't have a default value (Connection: mysql, SQL: insert into `posts` (`title`, `updated_at`, `created_at`) values (My Fourth Post, 2023-06-20 10:09:59, 2023-06-20 10:09:59)).

      >

  - This is because Laravel allows assignments only on values which are listed in `fillable` property and others will be ignored
  - So you should list all the fields for mass assignment

        protected $fillable = ['title', 'excerpt', 'body'];

  - Now the mass assignment works

        > Post::create(['title' => 'My Fourth Post', 'excerpt' => 'excerpt of post', 'body' => '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam blanditiis alias a deleniti aliquam sed exercitationem natus, consequuntur reiciendis amet excepturi labore vero voluptatibus, voluptate debitis? Labore id nemo</p>']);
        = App\Models\Post {#6217
            title: "My Fourth Post",
            excerpt: "excerpt of post",
            body: "<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam blanditiis alias a deleniti aliquam sed exercitationem natus, consequuntur reiciendis amet excepturi labore vero voluptatibus, voluptate debitis? Labore id nemo</p>",
            updated_at: "2023-06-20 10:16:02",
            created_at: "2023-06-20 10:16:02",
            id: 4,
          }

        >

- If you provide `id`, it will also be ignored

      > Post::create(['title' => 'My Fourth Post', 'excerpt' => 'excerpt of post', 'body' => '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam blanditiis alias a deleniti aliquam sed exercitationem natus, consequuntur reiciendis amet excepturi labore vero voluptatibus, voluptate debitis? Labore id nemo</p>', 'id' => 10000]);
      = App\Models\Post {#6226
          title: "My Fourth Post",
          excerpt: "excerpt of post",
          body: "<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam blanditiis alias a deleniti aliquam sed exercitationem natus, consequuntur reiciendis amet excepturi labore vero voluptatibus, voluptate debitis? Labore id nemo</p>",
          updated_at: "2023-06-20 10:19:15",
          created_at: "2023-06-20 10:19:15",
          id: 5,
        }

      >

- 1.  But if you add `id` into `fillable` list, it will assign that value

      > Post::create(['title' => 'My Fourth Post', 'excerpt' => 'excerpt of post', 'body' => '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam blanditiis alias a deleniti aliquam sed exercitationem natus, consequuntur reiciendis amet excepturi labore vero voluptatibus, voluptate debitis? Labore id nemo</p>', 'id' => 10000]);
      > = App\Models\Post {#6220

          title: "My Fourth Post",
          excerpt: "excerpt of post",
          body: "<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam blanditiis alias a deleniti aliquam sed exercitationem natus, consequuntur reiciendis amet excepturi labore vero voluptatibus, voluptate debitis? Labore id nemo</p>",
          id: 10000,
          updated_at: "2023-06-20 10:20:57",
          created_at: "2023-06-20 10:20:57",

      }

      >

- Note: Mass assignment is immediately persisted into database

- These will lead to unexpected update on database, so these are called `mass assignment vulnerability`

- 2. Instead of using `fillable` field, you can also use `guarded` which means it will accept except for ones listed in it

  - app/Models/Post.php

        protected $guarded = ['id'];

  - You need to correct auto increment value on database

        ALTER TABLE blog.posts AUTO_INCREMENT = 5; // 4 is the next id value

  - Run Tinker again:

        php artisan tinker

        > Post::create(['title' => 'My Fourth Post', 'excerpt' => 'excerpt of post', 'body' => '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam blanditiis alias a deleniti aliquam sed exercitationem natus, consequuntur reiciendis amet excepturi labore vero voluptatibus, voluptate debitis? Labore id nemo</p>', 'id' => 100000]);
        = App\Models\Post {#6220
            title: "My Fourth Post",
            excerpt: "excerpt of post",
            body: "<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam blanditiis alias a deleniti aliquam sed exercitationem natus, consequuntur reiciendis amet excepturi labore vero voluptatibus, voluptate debitis? Labore id nemo</p>",
            updated_at: "2023-06-20 10:51:56",
            created_at: "2023-06-20 10:51:56",
            id: 5,
          }

        >

- 3.  Disable mass assignment entirely and then handle the mass assignment in service provider or others

## 23. Route Model Binding

- About

  Laravel's route model binding feature allows us to bind a route wildcard to an Eloquent model instance.

- routes/web.php

      ...

      Route::get('posts/{post}', function ($id) {
          return view('post', [
              'post' => Post::findOrFail($id)
          ]);
      });

- When you use route model binding, You change rewrite the above code like this:

      Route::get('posts/{post}', function (Post $post) {
          return view('post', [
              'post' => $post
          ]);
      });

  - It means `$post` will be a Post matching wildcard(post) as its `id`

  - Note
    - Be sure to match wildcard string(`post`) with argument(`$post`). If they are different, route model binding won't work.

- In /database/migrations/2023_06_20_005430_create_posts_table.php, add the `slug` field:

      $table->string('slug')->unique();

  - Run migration

        php artisan migrate:fresh

- We can rewrite the Route like this:

      Route::get('posts/{post:slug}', function (Post $post) { // Post::where('slug', $post)->firstOrFail()
          return view('post', [
              'post' => $post
          ]);
      });

- The alternative option is to define `getRouteKeyName` method inside a model

      public function getRouteKeyName()
      {
          return 'slug';
      }

  - routes/web.php

        Route::get('posts/{post}', function (Post $post) {
            return view('post', [
                'post' => $post
            ]);
        });

## 24. Your First Eloquent Relationship

- About

  Our next job is to figure out how to assign a category to each post. To allow for this, we'll need to create a new Eloquent model and migration to represent a `Category`.

- Create a model with creating corresponding migration too

      php artisan make:model Category -m

- Add columns in /database/migrations/2023_06_22_100042_create_categories_table.php

      $table->string('name');
      $table->string('slug');

- Add `category_id` column in /database/migrations/2023_06_20_005430_create_posts_table.php

      $table->foreignId('category_id');

- Refresh migration

      php artisan migrate:fresh

- Add data manually using tinker

      php artisan tinker

      > use App\Models\Category;
      > $c = new Category;
      = App\Models\Category {#6212}

      > $c->name = 'Personal';
      = "Personal"

      > $c->slug = 'personal';
      = "personal"

      > $c->save();
      = true

      > $c = new Category;
      = App\Models\Category {#6958}

      > $c->name = 'Work';
      = "Work"

      > $c->slug = 'work';
      = "work"

      > $c->save();
      = true

      > $c = new Category;
      = App\Models\Category {#6213}

      > $c->name = 'Hobbies';
      = "Hobbies"

      > $c->slug = 'hobbies';
      = "hobbies"

      > $c->save();
      = true

      > use App\Models\Post;
      > Post::create([
      . 'title' => 'My Family Post',
      . 'excerpt' => 'Excerpt for my post',
      . 'body' => 'Lorem ipsum dolar sit amet.',
      . 'slug' => 'my-family-post',
      . 'category_id' => 1
      . ]);
      = App\Models\Post {#7183
          title: "My Family Post",
          excerpt: "Excerpt for my post",
          body: "Lorem ipsum dolar sit amet.",
          slug: "my-family-post",
          category_id: 1,
          updated_at: "2023-06-22 10:15:49",
          created_at: "2023-06-22 10:15:49",
          id: 1,
        }

      > Post::create([
      'title' => 'My Work Post',
      'excerpt' => 'Excerpt for my post',
      'body' => 'Lorem ipsum dolar sit amet.',
      'slug' => 'my-work-post',
      'category_id' => 2
      ]);
      = App\Models\Post {#7188
          title: "My Work Post",
          excerpt: "Excerpt for my post",
          body: "Lorem ipsum dolar sit amet.",
          slug: "my-work-post",
          category_id: 2,
          updated_at: "2023-06-22 10:17:32",
          created_at: "2023-06-22 10:17:32",
          id: 2,
        }

      > Post::create([
      'title' => 'My Hobby Post',
      'excerpt' => 'Excerpt for my post',
      'body' => 'Lorem ipsum dolar sit amet.',
      'slug' => 'my-hobby-post',
      'category_id' => 3
      ]);
      = App\Models\Post {#6959
          title: "My Hobby Post",
          excerpt: "Excerpt for my post",
          body: "Lorem ipsum dolar sit amet.",
          slug: "my-hobby-post",
          category_id: 3,
          updated_at: "2023-06-22 10:18:16",
          created_at: "2023-06-22 10:18:16",
          id: 3,
        }

      >

- Add relationship method, `category` into `Post` model

      public function category()
      {
          // hasOne, hasMany, belongsTo, belongsToMany
          return $this->belongsTo(Category::class);
      }

- Now you can get this relationship as a property:

      > php artisan tinker
      > $post = App\Models\Post::first();
      = App\Models\Post {#6913
          id: 1,
          category_id: 1,
          slug: "my-family-post",
          title: "My Family Post",
          excerpt: "Excerpt for my post",
          body: "Lorem ipsum dolar sit amet.",
          created_at: "2023-06-22 10:15:49",
          updated_at: "2023-06-22 10:15:49",
          published_at: null,
        }

      > $post->category
      = App\Models\Category {#7173
          id: 1,
          name: "Personal",
          slug: "personal",
          created_at: "2023-06-22 10:09:57",
          updated_at: "2023-06-22 10:09:57",
        }

      > $post
      = App\Models\Post {#6913
          id: 1,
          category_id: 1,
          slug: "my-family-post",
          title: "My Family Post",
          excerpt: "Excerpt for my post",
          body: "Lorem ipsum dolar sit amet.",
          created_at: "2023-06-22 10:15:49",
          updated_at: "2023-06-22 10:15:49",
          published_at: null,
          category: App\Models\Category {#7173
            id: 1,
            name: "Personal",
            slug: "personal",
            created_at: "2023-06-22 10:09:57",
            updated_at: "2023-06-22 10:09:57",
          },
        }

      > $post->category->name;
      = "Personal"

      >

- Now update `posts`, `post` view templates to include the category name

## 25. Show All Posts Associated With a Category

- About

  Now that we have the concept of a `Category` in our application, let's make a new route that fetches and loads all posts that are associated with the given category.

- Add a new route for fetching all posts belongs to a category

      Route::get('categories/{category}', function (Category $category) {
          return view('posts', [
              'posts' => $category->posts
          ]);
      });

- Define appropriate relation inside `Category` model

      public function posts()
      {
          return $this->hasMany(Post::class);
      }

- Let's test it in Tinker

      php artisan tinker

      > App\Models\Category::first()
      = App\Models\Category {#6915
          id: 1,
          name: "Personal",
          slug: "personal",
          created_at: "2023-06-22 10:09:57",
          updated_at: "2023-06-22 10:09:57",
        }

      > App\Models\Category::first()->posts
      = Illuminate\Database\Eloquent\Collection {#7179
          all: [
            App\Models\Post {#6220
              id: 1,
              category_id: 1,
              slug: "my-family-post",
              title: "My Family Post",
              excerpt: "Excerpt for my post",
              body: "<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam blanditiis alias a deleniti aliquam sed exercitationem natus, consequuntur reiciendis amet excepturi labore vero voluptatibus, voluptate debitis? Labore id nemo</p>",
              created_at: "2023-06-22 10:15:49",
              updated_at: "2023-06-22 10:15:49",
              published_at: null,
            },
          ],
        }

      >

- Now update the views:

      ...
      <a href="/categories/{{ $post->category->id }}">{{ $post->category->name }}</a>

- We will use `slug` instead of `id`

  - Change views

        <a href="/categories/{{ $post->category->slug }}">{{ $post->category->name }}</a>

## 26. Clockwork, and the N+1 Problem

- About

  We introduced a subtle performance issue in the last episode that's known as the N+1 problem. Because Laravel lazy-loads relationships, this means you can potentially fall into a trap where an additional SQL query is executed for every item within a loop. Fifty items...fifty SQL queries. In this episode, I'll show you how to debug these queries - both manually, and with the excellent [Clockwork extension](https://github.com/itsgoingd/clockwork) - and then we'll solve the problem by eager loading any relationships we'll be referencing.

- Manually debug N+1 problem

  - Add logger to show db queries in /routes/web.php

        ...
        Route::get('/', function () {
            \Illuminate\Support\Facades\DB::listen(function ($query) {
                // \Illuminate\Support\Facades\Log::info('foo');
                logger($query->sql);
            });

            return view('posts', [
                'posts' => Post::all()
            ]);
        });

  - Navigate `/` in browser

  - /storage/logs/laravel.log

        [2023-06-22 12:58:48] local.DEBUG: select * from `posts`
        [2023-06-22 12:58:48] local.DEBUG: select * from `categories` where `categories`.`id` = ? limit 1
        [2023-06-22 12:58:48] local.DEBUG: select * from `categories` where `categories`.`id` = ? limit 1
        [2023-06-22 12:58:48] local.DEBUG: select * from `categories` where `categories`.`id` = ? limit 1

  - To show SQL bindings

        logger($query->sql, $query-bindings);

  - /storage/logs/laravel.log

        [2023-06-22 13:02:09] local.DEBUG: select _ from `posts`
        [2023-06-22 13:02:09] local.DEBUG: select _ from `categories` where `categories`.`id` = ? limit 1 [1]
        [2023-06-22 13:02:09] local.DEBUG: select _ from `categories` where `categories`.`id` = ? limit 1 [2]
        [2023-06-22 13:02:09] local.DEBUG: select _ from `categories` where `categories`.`id` = ? limit 1 [3]

- Use Clockwork to debug N+1 problem

  - Repo: https://github.com/itsgoingd/clockwork

  - Installation:

        composer require itsgoingd/clockwork

  - Browser extension

    - [Chrome Web Store](https://chrome.google.com/webstore/detail/clockwork/dmggabnehkmmfmdffgajcflpdjlnoemp)
    - [Firefox Addons](https://addons.mozilla.org/en-US/firefox/addon/clockwork-dev-tools/)

    ![Clockwork - Database tab](./blog-002/public/images/readme/Clockwork.png)

- Solution for N+1 problem

  - /routes/web.php

        Route::get('/', function () {
            return view('posts', [
                'posts' => Post::with('category')->get()
            ]);
        });

  - ![Fix N+1 problem](./blog-002/public/images/readme/N%2B1-fix.png)

## 27. Database Seeding Saves Time

- About

  In this lesson, we'll associate a blog post with a particular author, or user. In the process of adding this, however, we'll yet again run into the issue of needing to manually repopulate our database. This might be a good time to take a few moments to review database seeding. As you'll see, a bit of work up front will save you so much time in the long run.

- Why?

  - When we add a new column, `user_id` as a foreign key into `create_posts_table` migration, we run `php artisan migrate:refresh`, then we lose all of the example data

- /database/seeders/DatabaseSeeder.php

      ...
      public function run(): void
      {
          $user = User::factory()->create();

          // This is only for local development, for production, you are required to create a factory
          $personal = Category::create([
              'name' => 'Personal',
              'slug' => 'personal'
          ]);

          $family = Category::create([
              'name' => 'Family',
              'slug' => 'family'
          ]);

          $work = Category::create([
              'name' => 'Work',
              'slug' => 'work'
          ]);

          Post::create([
              'user_id' => $user->id,
              'category_id' => $family->id,
              'title' => 'My Family Post',
              'slug' => 'my-first-post',
              'excerpt' => 'Lorem ipsum dolar sit amet.',
              'body' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Commodi tempora dolorum cumque eligendi expedita dignissimos, distinctio nostrum ad similique nobis non fuga. Quidem hic quaerat iusto atque repellat illo voluptatum!'
          ]);

          Post::create([
              'user_id' => $user->id,
              'category_id' => $work->id,
              'title' => 'My Work Post',
              'slug' => 'my-second-post',
              'excerpt' => 'Lorem ipsum dolar sit amet.',
              'body' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Commodi tempora dolorum cumque eligendi expedita dignissimos, distinctio nostrum ad similique nobis non fuga. Quidem hic quaerat iusto atque repellat illo voluptatum!'
          ]);
      }

- Artisan command to run DB seeder

      php artisan db:seed

- Make `name` and `slug` to unique in the migration for `*_create_categories_table.php`

      $table->string('name')->unique();
      $table->string('slug')->unique();

- Run db migration freshly and seed altogether

      php artisan migrate:fresh --seed

- When we run `php artisan db:seed` command again, we are getting error related to `Duplicated entry`

  - To fix this, we should add `trancate` method in the head of the seeder

  - /database/seeders/DatabaseSeeder.php

        ...
        User::truncate();
        Category::truncate();
        Post::truncate();

- Define user Eloquent relationship

  - /app/Models/Post.php

        public function user()
        {
            return $this->belongsTo(User::class);
        }

  - /app/Models/User.php (Inverse relationship)

        public function posts() // $user->posts
        {
            return $this->hasMany(Post::class);
        }

- Test in Tinker

      php artisan tinker

      > App\Models\User::first()
      = App\Models\User {#6959
          id: 1,
          name: "Lisette Hauck PhD",
          email: "vrogahn@example.net",
          email_verified_at: "2023-06-22 14:06:55",
          #password: "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi",
          #remember_token: "6Ps05hQbk4",
          created_at: "2023-06-22 14:06:55",
          updated_at: "2023-06-22 14:06:55",
        }

      > App\Models\User::first()->posts
      = Illuminate\Database\Eloquent\Collection {#7216
          all: [
            App\Models\Post {#6255
              id: 1,
              user_id: 1,
              category_id: 2,
              slug: "my-first-post",
              title: "My Family Post",
              excerpt: "Lorem ipsum dolar sit amet.",
              body: "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Commodi tempora dolorum cumque eligendi expedita dignissimos, distinctio nostrum ad similique nobis non fuga. Quidem hic quaerat iusto atque repellat illo voluptatum!",
              created_at: "2023-06-22 14:06:55",
              updated_at: "2023-06-22 14:06:55",
              published_at: null,
            },
            App\Models\Post {#6264
              id: 2,
              user_id: 1,
              category_id: 3,
              slug: "my-second-post",
              title: "My Work Post",
              excerpt: "Lorem ipsum dolar sit amet.",
              body: "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Commodi tempora dolorum cumque eligendi expedita dignissimos, distinctio nostrum ad similique nobis non fuga. Quidem hic quaerat iusto atque repellat illo voluptatum!",
              created_at: "2023-06-22 14:06:55",
              updated_at: "2023-06-22 14:06:55",
              published_at: null,
            },
          ],
        }

      > App\Models\Post::first()
      = App\Models\Post {#7225
          id: 1,
          user_id: 1,
          category_id: 2,
          slug: "my-first-post",
          title: "My Family Post",
          excerpt: "Lorem ipsum dolar sit amet.",
          body: "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Commodi tempora dolorum cumque eligendi expedita dignissimos, distinctio nostrum ad similique nobis non fuga. Quidem hic quaerat iusto atque repellat illo voluptatum!",
          created_at: "2023-06-22 14:06:55",
          updated_at: "2023-06-22 14:06:55",
          published_at: null,
        }

      > App\Models\Post::first()->user
      = App\Models\User {#7224
          id: 1,
          name: "Lisette Hauck PhD",
          email: "vrogahn@example.net",
          email_verified_at: "2023-06-22 14:06:55",
          #password: "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi",
          #remember_token: "6Ps05hQbk4",
          created_at: "2023-06-22 14:06:55",
          updated_at: "2023-06-22 14:06:55",
        }

      > App\Models\Post::with('user')->first()
      = App\Models\Post {#7215
          id: 1,
          user_id: 1,
          category_id: 2,
          slug: "my-first-post",
          title: "My Family Post",
          excerpt: "Lorem ipsum dolar sit amet.",
          body: "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Commodi tempora dolorum cumque eligendi expedita dignissimos, distinctio nostrum ad similique nobis non fuga. Quidem hic quaerat iusto atque repellat illo voluptatum!",
          created_at: "2023-06-22 14:06:55",
          updated_at: "2023-06-22 14:06:55",
          published_at: null,
          user: App\Models\User {#7230
            id: 1,
            name: "Lisette Hauck PhD",
            email: "vrogahn@example.net",
            email_verified_at: "2023-06-22 14:06:55",
            #password: "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi",
            #remember_token: "6Ps05hQbk4",
            created_at: "2023-06-22 14:06:55",
            updated_at: "2023-06-22 14:06:55",
          },
        }

      >

## 28. Turbo Boost With Factories

- About

  Now that you understand the basics of database seeders, let's integrate model factories in order to seamlessly generate any number of database records.

- Create a new factory for Post model

      php artisan make:factory PostFactory

- /database/factories/PostFactory

      <?php

      namespace Database\Factories;

      use App\Models\Category;
      use App\Models\User;
      use Illuminate\Database\Eloquent\Factories\Factory;

      /**
      * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
      */
      class PostFactory extends Factory
      {
          /**
          * Define the model's default state.
          *
          * @return array<string, mixed>
          */
          public function definition(): array
          {
              return [
                  'user_id' => User::factory(),
                  'category_id' => Category::factory(),
                  'title' => fake()->sentence,
                  'slug' => fake()->slug,
                  'excerpt' => fake()->sentence,
                  'body' => fake()->paragraph
              ];
          }
      }

- Create `CategoryFactory`

      php artisan make:factory CategoryFactory

- Run `php artisan migrate:fresh`

- In Tinker

      php artisan tinker

      > App\Models\Post::factory()->create();
      = App\Models\Post {#6345
          user_id: 1,
          category_id: 1,
          title: "Neque et suscipit eius earum rerum neque.",
          slug: "ut-sed-dolore-nihil-non-dolores-nostrum",
          excerpt: "Voluptas asperiores veniam soluta labore.",
          body: "Rerum tenetur vitae laborum. Doloremque optio autem iusto quo. Non tempore voluptatibus id ex est consequatur suscipit. Facere sequi eius ut blanditiis. Sit rerum veritatis sit qui.",
          updated_at: "2023-06-22 15:05:10",
          created_at: "2023-06-22 15:05:10",
          id: 1,
        }

      > App\Models\Post::first()
      = App\Models\Post {#6259
          id: 1,
          user_id: 1,
          category_id: 1,
          slug: "ut-sed-dolore-nihil-non-dolores-nostrum",
          title: "Neque et suscipit eius earum rerum neque.",
          excerpt: "Voluptas asperiores veniam soluta labore.",
          body: "Rerum tenetur vitae laborum. Doloremque optio autem iusto quo. Non tempore voluptatibus id ex est consequatur suscipit. Facere sequi eius ut blanditiis. Sit rerum veritatis sit qui.",
          created_at: "2023-06-22 15:05:10",
          updated_at: "2023-06-22 15:05:10",
          published_at: null,
        }

      > App\Models\Post::with('user')->first()
      = App\Models\Post {#6289
          id: 1,
          user_id: 1,
          category_id: 1,
          slug: "ut-sed-dolore-nihil-non-dolores-nostrum",
          title: "Neque et suscipit eius earum rerum neque.",
          excerpt: "Voluptas asperiores veniam soluta labore.",
          body: "Rerum tenetur vitae laborum. Doloremque optio autem iusto quo. Non tempore voluptatibus id ex est consequatur suscipit. Facere sequi eius ut blanditiis. Sit rerum veritatis sit qui.",
          created_at: "2023-06-22 15:05:10",
          updated_at: "2023-06-22 15:05:10",
          published_at: null,
          user: App\Models\User {#6312
            id: 1,
            name: "Chyna Considine",
            email: "nondricka@example.net",
            email_verified_at: "2023-06-22 15:05:10",
            #password: "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi",
            #remember_token: "D7VfWjsEPk",
            created_at: "2023-06-22 15:05:10",
            updated_at: "2023-06-22 15:05:10",
          },
        }

      > App\Models\Post::with('user', 'category')->first()
      = App\Models\Post {#6293
          id: 1,
          user_id: 1,
          category_id: 1,
          slug: "ut-sed-dolore-nihil-non-dolores-nostrum",
          title: "Neque et suscipit eius earum rerum neque.",
          excerpt: "Voluptas asperiores veniam soluta labore.",
          body: "Rerum tenetur vitae laborum. Doloremque optio autem iusto quo. Non tempore voluptatibus id ex est consequatur suscipit. Facere sequi eius ut blanditiis. Sit rerum veritatis sit qui.",
          created_at: "2023-06-22 15:05:10",
          updated_at: "2023-06-22 15:05:10",
          published_at: null,
          user: App\Models\User {#6298
            id: 1,
            name: "Chyna Considine",
            email: "nondricka@example.net",
            email_verified_at: "2023-06-22 15:05:10",
            #password: "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi",
            #remember_token: "D7VfWjsEPk",
            created_at: "2023-06-22 15:05:10",
            updated_at: "2023-06-22 15:05:10",
          },
          category: App\Models\Category {#6306
            id: 1,
            name: "amet",
            slug: "beatae-id-consequuntur-minus-et-quam-consequatur-consequuntur",
            created_at: "2023-06-22 15:05:10",
            updated_at: "2023-06-22 15:05:10",
          },
        }

      >

- /database/seeders/DatabaseSeeder.php

      ...
      User::truncate();
      Category::truncate();
      Post::truncate();

      Post::factory()->create();

- Run `php artisan db:seed`, then it automatically creates a post and its associated user and category

- Note: Use `truncate` method only if you need refresh data

- /database/seeders/DatabaseSeeder.php

      ...
      Post::factory(5)->create();

- Run `php artisan migrate:fresh --seed`

- If you want to create the same user

  - .../DatabaseSeeder.php

        ...
        $user = User::factory()->create([
            'name' => 'John Doe'
        ]);

        Post::factory(5)->create([
            'user_id' => $user->id
        ]);

- Run `php artisan migrate:fresh --seed`

- Now you can create a user with name `John Doe` and associate it with 5 different posts.

## 29. View All Posts By An Author

- About

  Now that we can associate a blog post with an author, the next obvious step is to create a new route that renders all blog posts written by a particular author.

- Create a new post

      php artisan tinker

      > App\Models\Post::factory()->create()

      = App\Models\Post {#7324
          user_id: 2,
          category_id: 6,
          title: "Similique a quis at debitis tempora et.",
          slug: "fuga-aut-ut-quo-illo-dolores",
          excerpt: "Ut earum ratione voluptatum sunt doloremque.",
          body: "Odio velit porro consequatur omnis odit debitis dolore. Beatae odio praesentium harum. Perspiciatis ut ea dolor minus a quis rerum ea.",
          updated_at: "2023-06-23 00:36:55",
          created_at: "2023-06-23 00:36:55",
          id: 6,
        }

      >

- Order posts by desc

  - /routes/web.php

        Route::get('/', function () {
            return view('posts', [
                'posts' => Post::latest()->with('category')->get()
            ]);
        });

- Change `user` relationship to `author` in `Post` model

  - app/Models/Post.php

        public function author()
        {
            // Assume foreign key is `author_id`, but db column is `user_id`, you should pass `user_id` as a foreign key
            return $this->belongsTo(User::class, 'user_id');
        }

- Eagerly load authors in `/` route

  - routes/web.php

        Route::get('/', function () {
            // You can pass a column to latest() like latest('published_at')
            return view('posts', [
                // 'posts' => Post::latest()->with('category', 'author')->get()
                // You can also use an array as the argument
                'posts' => Post::latest()->with(['category', 'author'])->get()
            ]);
        });

- Create a new route for posts by an author

      Route::get('authors/{author}', function (User $author) {
          return view('posts', [
              'posts' => $author->posts
          ]);
      });

- Update views to include the links to the route

      By <a href="/authors/{{ $post->author->id }}">{{ $post->author->name }}</a> in <a href="/categories/{{ $post->category->slug }}">{{ $post->category->name }}</a>

- Now we want to use `username` instead of `id`, we update the migration for `create_users_table`

      $table->string('username')->unique();

- Update User factory in UserFactory.php

      'username' => fake()->unique()->userName,

- Run migration

      php artisan migrate:fresh --seed

- Change links in views

      <p>
          By <a href="/authors/{{ $post->author->username }}">{{ $post->author->name }}</a> in <a href="/categories/{{ $post->category->slug }}">{{ $post->category->name }}</a>
      </p>

- Change route model binding to accept `username` as the key

      Route::get('authors/{author:username}', function (User $author) {
          return view('posts', [
              'posts' => $author->posts
          ]);
      });

## 30. Eager Load Relationships on an Existing Model

- About

  In this episode, you'll learn how to specify which relationships should be eager loaded by default on a model. We'll also touch on the pros and cons of such an approach.

- When you navigate to posts by category page

  ![](./blog-002/public/images/readme/posts_by_category.png)

- Create more posts belong to that category

      php artisan tinker

      > App\Models\Post::factory(10)->create(['category_id' => 1]);
      = Illuminate\Database\Eloquent\Collection {#6298
          all: [
            App\Models\Post {#6319
              user_id: 2,
              category_id: 1,
              title: "Nihil nisi dolorem ducimus aut nihil.",
              slug: "deserunt-soluta-et-exercitationem-inventore",
              excerpt: "Expedita enim ut voluptatibus eum ipsa occaecati.",
              body: "Consequatur atque exercitationem voluptas qui quod qui nihil. Fugiat fuga atque eos aperiam porro maxime maiores et. Voluptas accusantium impedit vel aliquam omnis nihil. Quas fugit facilis velit commodi.",
              updated_at: "2023-06-23 01:31:14",
              created_at: "2023-06-23 01:31:14",
              id: 6,
            },
            App\Models\Post {#6324
              user_id: 3,
              category_id: 1,
              title: "Est nesciunt libero molestiae itaque.",
              slug: "et-molestiae-sit-suscipit-et",
              excerpt: "Aut consequatur voluptatem quam sint odio qui in.",
              body: "Alias minima et vel cumque quas. Voluptas quasi quia est ut est odio. Sapiente est iure hic sapiente praesentium nemo.",
              updated_at: "2023-06-23 01:31:14",
              created_at: "2023-06-23 01:31:14",
              id: 7,
            },
            ...

- Observe N+1 problem on posts by category page

  ![](./blog-002/public/images/readme/posts_by_category_n%2B1_problem.png)

- To fix this, eagerly load `category`, `author` in /routes/web.php

      Route::get('categories/{category:slug}', function (Category $category) {
          return view('posts', [
              'posts' => $category->posts->load(['category', 'author'])
          ]);
      });

      Route::get('authors/{author:username}', function (User $author) {
          return view('posts', [
              'posts' => $author->posts->load(['category', 'author'])
          ]);
      });

  ![](./blog-002/public/images/readme/posts_by_category_n%2B1_problem_fix.png)

- Adding earger loading on each routes is tedious, so we add them in models themselves so they are also loaded by default

- app/Models/Post

      ...
      protected $with = ['category', 'author'];

- Now remove eager loadings from route definitions

- Check in Tinker

      php artisan tinker

      > App\Models\Post::take(2)->get()
      = Illuminate\Database\Eloquent\Collection {#7236
          all: [
            App\Models\Post {#7229
              id: 1,
              user_id: 1,
              category_id: 1,
              slug: "vel-voluptatum-iste-cumque-ipsam-quod-ut-voluptate-expedita",
              title: "Quam voluptatem libero maxime tempora iste iusto quidem.",
              excerpt: "Consectetur sit blanditiis voluptate voluptatem libero magnam voluptatum.",
              body: "Omnis molestias veritatis facilis consectetur sed earum ex eligendi. Quo quis aliquid ut molestiae corporis ad. Quia amet dolorum facilis et. Est et qui laborum ducimus eaque. Enim tenetur consequatur unde a quia et aliquid.",
              created_at: "2023-06-23 01:18:08",
              updated_at: "2023-06-23 01:18:08",
              published_at: null,
              category: App\Models\Category {#7241
                id: 1,
                name: "rem",
                slug: "harum-voluptas-rerum-aut-quis",
                created_at: "2023-06-23 01:18:08",
                updated_at: "2023-06-23 01:18:08",
              },
              author: App\Models\User {#7234
                id: 1,
                username: "JohnDoe",
                name: "John Doe",
                email: "swift.buford@example.net",
                email_verified_at: "2023-06-23 01:18:08",
                #password: "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi",
                #remember_token: "id9D5ou0Uh",
                created_at: "2023-06-23 01:18:08",
                updated_at: "2023-06-23 01:18:08",
              },
            },
            App\Models\Post {#7230
              id: 2,
              user_id: 1,
              category_id: 2,
              slug: "facilis-consequuntur-dolore-esse-pariatur-quia-illum",
              title: "Tempora omnis sit nam odio nemo voluptatem.",
              excerpt: "Velit eum ut sit vitae mollitia quo.",
              body: "Nihil et a delectus beatae nisi. Rem qui eos consequuntur. Autem fugiat ea officiis quia illum quaerat. Consequatur culpa saepe et ea quaerat quia ut tempora.",
              created_at: "2023-06-23 01:18:08",
              updated_at: "2023-06-23 01:18:08",
              published_at: null,
              category: App\Models\Category {#7239
                id: 2,
                name: "aut",
                slug: "voluptas-numquam-at-nihil-et-molestiae-consequuntur",
                created_at: "2023-06-23 01:18:08",
                updated_at: "2023-06-23 01:18:08",
              },
              author: App\Models\User {#7234},
            },
          ],
        }

- If you don't want to eagerly load a relationship, use `without()` method

      > php artisan tinker

      > App\Models\Post::without('author')->first()
      = App\Models\Post {#7232
          id: 1,
          user_id: 1,
          category_id: 1,
          slug: "vel-voluptatum-iste-cumque-ipsam-quod-ut-voluptate-expedita",
          title: "Quam voluptatem libero maxime tempora iste iusto quidem.",
          excerpt: "Consectetur sit blanditiis voluptate voluptatem libero magnam voluptatum.",
          body: "Omnis molestias veritatis facilis consectetur sed earum ex eligendi. Quo quis aliquid ut molestiae corporis ad. Quia amet dolorum facilis et. Est et qui laborum ducimus eaque. Enim tenetur consequatur unde a quia et aliquid.",
          created_at: "2023-06-23 01:18:08",
          updated_at: "2023-06-23 01:18:08",
          published_at: null,
          category: App\Models\Category {#7259
            id: 1,
            name: "rem",
            slug: "harum-voluptas-rerum-aut-quis",
            created_at: "2023-06-23 01:18:08",
            updated_at: "2023-06-23 01:18:08",
          },
        }

      > App\Models\Post::without(['author', 'category'])->first()
      = App\Models\Post {#7256
          id: 1,
          user_id: 1,
          category_id: 1,
          slug: "vel-voluptatum-iste-cumque-ipsam-quod-ut-voluptate-expedita",
          title: "Quam voluptatem libero maxime tempora iste iusto quidem.",
          excerpt: "Consectetur sit blanditiis voluptate voluptatem libero magnam voluptatum.",
          body: "Omnis molestias veritatis facilis consectetur sed earum ex eligendi. Quo quis aliquid ut molestiae corporis ad. Quia amet dolorum facilis et. Est et qui laborum ducimus eaque. Enim tenetur consequatur unde a quia et aliquid.",
          created_at: "2023-06-23 01:18:08",
          updated_at: "2023-06-23 01:18:08",
          published_at: null,
        }

      >

- Another method would be to never append to the `$with` property and instead extract a repository or special helper method that is responsible for grabbing your posts, applying filters and eager loading relationships.

# 5. Integrate the Design

## 31. Convert the HTML and CSS to Blade

- About

  - I think we're ready to begin constructing the actual blog design for this series. **As discussed in episode four**, I've already written the base HTML and CSS. That means we only need to [download it from GitHub](https://github.com/laracasts/Laravel-From-Scratch-HTML-CSS), and begin migrating it to our Laravel application. As part of this, we'll prepare the layout file and extract a handful of Blade components.

  - Extra Credit: Consider watching the optional [HTML and CSS Workflow](https://laracasts.com/series/html-and-css-workshop) prerequisite series, where we write the HTML and CSS that is referenced in this chapter.

## 32. Blade Components and CSS Grids

- About

  We're making great progress. Let's continue the conversion in this episode, as we take a break from Laravel to play around with CSS grids.

- If we don't have any posts on the database, we are getting errors

  - To fix this using @if in `posts` view

- We can use `$loop` for more controll on iteration

      @dd($loop)

## 33. Convert the Blog Post Page

- About

  With the home page in reasonably good shape, let's now move on to the "view blog post" page and get that up and running.

## 34. A Small JavaScript Dropdown Detour

- About

  We next need to make that "Categories" dropdown on the home page function as expected. I hate to break it to you, but we'll need to reach for a bit of JavaScript to make this work. Don't worry: I'll make this as painless as possible by pulling in the excellent [Alpine.js library](https://github.com/alpinejs/alpine). Let's get through this, and we'll jump back into some Laravel-specific topics!

- Bind all categories into `Catetory` dropdown, but we want to navigate to `posts by category` page when selecting a category.

- Install `Alpine.js`

      <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

- Alpine fundamentals to build a dropdown

  ```html
  <div x-data="{ show: false }">
    <button @click="show = !show">Categories</button>

    <div x-show="show">
      <a href="#" class="block">One</a>
      <a href="#" class="block">Two</a>
      <a href="#" class="block">Three</a>
    </div>
  </div>
  ```

## 35. How to Extract a Dropdown Blade Component

- About

  We've now successfully built the basic functionality for a dropdown menu, but it's not yet reusable. To remedy this, let's extract an `x-dropdown` Blade component. This will come with the side effect of isolating all Alpine-specific code to that single component file.

- From 9.x, you can use named slot shorthand

  - 8.x

        <x-slot name="trigger"></x-slot>

  - 9.x, 10.x

        <x-slot:trigger></x-slot>

- Named route

      Route::get('/', function () {
          return view('posts', [
              'posts' => Post::latest()->get(),
              'categories' => Category::all()
          ]);
      })->name('home');

## 36. Quick Tweaks and Clean-Up

- About

  We're about to move on to the search functionality, but before we do that, let's take five minutes to do some quick clean up.

# 6. Search

## 37. Search (The Messy Way)

- About

  In this new section, we'll implement the search functionality for our blog. I'm going to demonstrate this in two steps. First, in this video, we'll simply get it to work. The code won't be reusable or pretty, but it'll work! Then, in the following episode, we can refactor a bit.

## 38. Search (The Cleaner Way)

- About

  Now that our search form is working, we can take a few moments to refactor the code into something more pleasing to the eye (and reusable). In this episode, not only will we finally have a look at controller classes, but we'll also learn about Eloquent query scopes.

### Controllers

- Introduction

  - Instead of defining all of your request handling logic as closures in your route files, you may wish to organize this behavior using "controller" classes. Controllers can group related request handling logic into a single class. For example, a `UserController` class might handle all incoming requests related to users, including showing, creating, updating, and deleting users. By default, controllers are stored in the `app/Http/Controllers` directory.

- Writing Controllers

  - Basic Controllers

        php artisan make:controller UserController

    - A controller may have any number of public methods which will respond to incoming HTTP requests:

    ```php
    <?php

    namespace App\Http\Controllers;

    use App\Models\User;
    use Illuminate\View\View;

    class UserController extends Controller
    {
        /**
        * Show the profile for a given user.
        */
        public function show(string $id): View
        {
            return view('user.profile', [
                'user' => User::findOrFail($id)
            ]);
        }
    }
    ```

    - Once you have written a controller class and method, you may define a route to the controller method like so:

    ```php
    use App\Http\Controllers\UserController;

    Route::get('/user/{id}', [UserController::class, 'show']);
    ```

    - When an incoming request matches the specified route URI, the `show` method on the` App\Http\Controllers\UserController` class will be invoked and the route parameters will be passed to the method.

    - Controllers are not **required** to extend a base class. However, you will not have access to convenient features such as the `middleware` and `authorize` methods.

### Query Scopes

- Global Scopes

  - Global scopes allow you to add constraints to all queries for a given model. Laravel's own `soft delete` functionality utilizes global scopes to only retrieve "non-deleted" models from the database. Writing your own global scopes can provide a convenient, easy way to make sure every query for a given model receives certain constraints.

  - Generating Scopes

    - To generate a new global scope, you may invoke the make:scope Artisan command, which will place the generated scope in your application's `app/Models/Scopes` directory:

          php artisan make:scope AncientScope

  - Writing Global Scopes

    ```php
    <?php

    namespace App\Models\Scopes;

    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Scope;

    class AncientScope implements Scope
    {
        /**
        * Apply the scope to a given Eloquent query builder.
        */
        public function apply(Builder $builder, Model $model): void
        {
            $builder->where('created_at', '<', now()->subYears(2000));
        }
    }
    ```

    - If your global scope is adding columns to the select clause of the query, you should use the `addSelect` method instead of `select`. This will prevent the unintentional replacement of the query's existing select clause.

  - Applying Global Scopes

    ```php
    <?php

    namespace App\Models;

    use App\Models\Scopes\AncientScope;
    use Illuminate\Database\Eloquent\Model;

    class User extends Model
    {
        /**
        * The "booted" method of the model.
        */
        protected static function booted(): void
        {
            static::addGlobalScope(new AncientScope);
        }
    }
    ```

    - After adding the scope in the example above to the `App\Models\User` model, a call to the `User::all()` method will execute the following SQL query:

      ```sql
      select * from `users` where `created_at` < 0021-02-18 00:00:00
      ```

  - Anonymous Global Scopes

    ```php
    <?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Model;

    class User extends Model
    {
        /**
        * The "booted" method of the model.
        */
        protected static function booted(): void
        {
            static::addGlobalScope('ancient', function (Builder $builder) {
                $builder->where('created_at', '<', now()->subYears(2000));
            });
        }
    }
    ```

  - Removing Global Scopes

    ```php
    User::withoutGlobalScope(AncientScope::class)->get();
    ```

    - Or, if you defined the global scope using a closure, you should pass the string name that you assigned to the global scope:

      ```php
      User::withoutGlobalScope('ancient')->get();
      ```

    - If you would like to remove several or even all of the query's global scopes, you may use the `withoutGlobalScopes` method:

      ```php
      // Remove all of the global scopes...
      User::withoutGlobalScopes()->get();

      // Remove some of the global scopes...
      User::withoutGlobalScopes([
          FirstScope::class, SecondScope::class
      ])->get();
      ```

- Local Scopes

  - Local scopes allow you to define common sets of query constraints that you may easily re-use throughout your application. For example, you may need to frequently retrieve all users that are considered "popular". To define a scope, prefix an Eloquent model method with `scope`.

  - Scopes should always return the same **query** builder instance or `void`:

    ```php
    <?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Model;

    class User extends Model
    {
        /**
        * Scope a query to only include popular users.
        */
        public function scopePopular(Builder $query): void
        {
            $query->where('votes', '>', 100);
        }

        /**
        * Scope a query to only include active users.
        */
        public function scopeActive(Builder $query): void
        {
            $query->where('active', 1);
        }
    }
    ```

  - Utilizing A Local Scope

    - Once the scope has been defined, you may call the scope methods when querying the model. However, you should not include the `scope` prefix when calling the method. You can even chain calls to various scopes:

      ```php
      use App\Models\User;

      $users = User::popular()->active()->orderBy('created_at')->get();
      ```

    - Combining multiple Eloquent model scopes via an `or` query operator may require the use of closures to achieve the correct `logical grouping`:

      ```php
      $users = User::popular()->orWhere(function (Builder $query) {
          $query->active();
      })->get();
      ```

    - However, since this can be cumbersome, Laravel provides a "higher order" `orWhere` method that allows you to fluently chain scopes together without the use of closures:

    ```php
    $users = User::popular()->orWhere->active()->get();
    ```

  - Dynamic Scopes

    - Sometimes you may wish to define a scope that accepts parameters. To get started, just add your additional parameters to your scope method's signature. Scope parameters should be defined after the `$query` parameter:

      ```php
      <?php

      namespace App\Models;

      use Illuminate\Database\Eloquent\Model;

      class User extends Model
      {
          /**
          * Scope a query to only include users of a given type.
          */
          public function scopeOfType(Builder $query, string $type): void
          {
              $query->where('type', $type);
          }
      }
      ```

    - Once the expected arguments have been added to your scope method's signature, you may pass the arguments when calling the scope:

      ```php
      $users = User::ofType('admin')->get();
      ```

# 7. Filtering

## 39. Advanced Eloquent Query Constraints

- About

  Let's keep playing with our Post model's filter() query scope. Maybe we can additionally filter posts according to their category. If we take this approach, we'll then have a powerful way of combining filters. For example, "_give me all posts, written by such-and-such author, that are within the given category, and include the following search text._"

- SQL behind `whereHas`

  ```sql
  SELECT
      *
  FROM
      posts
  WHERE
      EXISTS( SELECT
              *
          FROM
              categories
          WHERE
              categories.id = posts.category_id
                  AND categories.slug = 'xxx')
  ```

- Suppose that we are sending `category` as a query param, we'd like to deal with the URI such as `/?category=culpa-quia-vero-sint-quo&search=Soluta`

- Querying Relationship Existence

  - When retrieving model records, you may wish to limit your results based on the existence of a relationship. For example, imagine you want to retrieve all blog posts that have at least one comment. To do so, you may pass the name of the relationship to the `has` and `orHas` methods:

    ```php
    use App\Models\Post;

    // Retrieve all posts that have at least one comment...
    $posts = Post::has('comments')->get();
    ```

  - You may also specify an operator and count value to further customize the query:

    ```php
    // Retrieve all posts that have three or more comments...
    $posts = Post::has('comments', '>=', 3)->get();
    ```

  - Nested `has` statements may be constructed using "dot" notation. For example, you may retrieve all posts that have at least one comment that has at least one image:

    ```php
    // Retrieve posts that have at least one comment with images...
    $posts = Post::has('comments.images')->get();
    ```

  - If you need even more power, you may use the `whereHas` and `orWhereHas` methods to define additional query constraints on your `has` queries, such as inspecting the content of a comment:

    ```php
    use Illuminate\Database\Eloquent\Builder;

    // Retrieve posts with at least one comment containing words like code%...
    $posts = Post::whereHas('comments', function (Builder $query) {
        $query->where('content', 'like', 'code%');
    })->get();

    // Retrieve posts with at least ten comments containing words like code%...
    $posts = Post::whereHas('comments', function (Builder $query) {
        $query->where('content', 'like', 'code%');
    }, '>=', 10)->get();
    ```

  - Inline Relationship Existence Queries

    - If you would like to query for a relationship's existence with a single, simple where condition attached to the relationship query, you may find it more convenient to use the `whereRelation`, `orWhereRelation`, `whereMorphRelation`, and `orWhereMorphRelation` methods. For example, we may query for all posts that have unapproved comments:

      ```php
      use App\Models\Post;

      $posts = Post::whereRelation('comments', 'is_approved', false)->get();
      ```

    - Of course, like calls to the query builder's `where` method, you may also specify an operator:

      ```php
      $posts = Post::whereRelation(
          'comments', 'created_at', '>=', now()->subHour()
      )->get();
      ```

## 40. Extract a Category Dropdown Blade Component

- About

  Have you noticed that each route needs to pass a collection of categories to the `posts` view? If you take a look, that variable is only ever referenced as part of the main category dropdown. So with that in mind, what if we created a dedicated `x-category-dropdown` component that could be responsible for fetching any data that the dropdown requires? Let's figure out how to allow for that in this episode.

### Blade Templates

#### Components

- Components and slots provide similar benefits to sections, layouts, and includes; however, some may find the mental model of components and slots easier to understand. There are two approaches to writing components: class based components and anonymous components.

- To create a class based component, you may use the `make:component` Artisan command. To illustrate how to use components, we will create a simple Alert component. The `make:component` command will place the component in the `app/View/Components` directory:

      php artisan make:component Alert

  - The `make:component` command will also create a view template for the component. The view will be placed in the `resources/views/components` directory. When writing components for your own application, components are automatically discovered within the `app/View/Components` directory and `resources/views/components` directory, so no further component registration is typically required.

- You may also create components within subdirectories:

      php artisan make:component Forms/Input

  - The command above will create an `Input` component in the `app/View/Components/Forms` directory and the view will be placed in the `resources/views/components/forms` directory.

- If you would like to create an anonymous component (a component with only a Blade template and no class), you may use the `--view` flag when invoking the `make:component` command:

      php artisan make:component forms.input --view

  - The command above will create a Blade file at `resources/views/components/forms/input.blade.php` which can be rendered as a component via `<x-forms.input />`.

- Rendering Components

  - To display a component, you may use a Blade component tag within one of your Blade templates. Blade component tags start with the string `x-` followed by the kebab case name of the component class:

    ```php
    <x-alert/>

    <x-user-profile/>
    ```

  - If the component class is nested deeper within the `app/View/Components` directory, you may use the `.` character to indicate directory nesting. For example, if we assume a component is located at `app/View/Components/Inputs/Button.php`, we may render it like so:

    ```php
    <x-inputs.button/>
    ```

  - If you would like to conditionally render your component, you may define a `shouldRender` method on your component class. If the `shouldRender` method returns `false` the component will not be rendered:

    ```php
    use Illuminate\Support\Str;

    /**
    * Whether the component should be rendered
    */
    public function shouldRender(): bool
    {
        return Str::length($this->message) > 0;
    }
    ```

- Passing Data To Components

  - You may pass data to Blade components using HTML attributes. Hard-coded, primitive values may be passed to the component using simple HTML attribute strings. PHP expressions and variables should be passed to the component via attributes that use the `:` character as a prefix:

    ```php
    <x-alert type="error" :message="$message"/>
    ```

  - You should define all of the component's data attributes in its class constructor. All public properties on a component will automatically be made available to the component's view. It is not necessary to pass the data to the view from the component's `render` method:

    ```php
    <?php

    namespace App\View\Components;

    use Illuminate\View\Component;
    use Illuminate\View\View;

    class Alert extends Component
    {
        /**
        * Create the component instance.
        */
        public function __construct(
            public string $type,
            public string $message,
        ) {}

        /**
        * Get the view / contents that represent the component.
        */
        public function render(): View
        {
            return view('components.alert');
        }
    }
    ```

  - When your component is rendered, you may display the contents of your component's public variables by echoing the variables by name:

    ```php
    <div class="alert alert-{{ $type }}">
        {{ $message }}
    </div>
    ```

  - Casing

    - Component constructor arguments should be specified using `camelCase`, while `kebab-case` should be used when referencing the argument names in your HTML attributes. For example, given the following component constructor:

      ```php
      /**
       * Create the component instance.
      */
      public function __construct(
          public string $alertType,
      ) {}
      ```

    - The `$alertType` argument may be provided to the component like so:

      ```php
      <x-alert alert-type="danger" />
      ```

  - Short Attribute Syntax

    - When passing attributes to components, you may also use a "short attribute" syntax. This is often convenient since attribute names frequently match the variable names they correspond to:

      ```php
      {{-- Short attribute syntax... --}}
      <x-profile :$userId :$name />

      {{-- Is equivalent to... --}}
      <x-profile :user-id="$userId" :name="$name" />
      ```

  - Escaping Attribute Rendering

    - Since some JavaScript frameworks such as Alpine.js also use colon-prefixed attributes, you may use a double colon (`::`) prefix to inform Blade that the attribute is not a PHP expression. For example, given the following component:

      ```php
      <x-button ::class="{ danger: isDeleting }">
          Submit
      </x-button>
      ```

    - The following HTML will be rendered by Blade:

      ````php
      <button :class="{ danger: isDeleting }">
          Submit
      </button>
      ```php
      ````

  - Component Methods

    - In addition to public variables being available to your component template, any public methods on the component may be invoked. For example, imagine a component that has an `isSelected` method:

      ```php
      /**
       * Determine if the given option is the currently selected option.
      */
      public function isSelected(string $option): bool
      {
          return $option === $this->selected;
      }
      ```

    - You may execute this method from your component template by invoking the variable matching the name of the method:

      ```php
      <option {{ $isSelected($value) ? 'selected' : '' }} value="{{ $value }}">
          {{ $label }}
      </option>
      ```

  - Accessing Attributes & Slots Within Component Classes

    - Blade components also allow you to access the component name, attributes, and slot inside the class's render method. However, in order to access this data, you should return a closure from your component's `render` method. The closure will receive a `$data` array as its only argument. This array will contain several elements that provide information about the component:

      ```php
      use Closure;

      /**
      * Get the view / contents that represent the component.
      */
      public function render(): Closure
      {
          return function (array $data) {
              // $data['componentName'];
              // $data['attributes'];
              // $data['slot'];

              return '<div>Components content</div>';
          };
      }
      ```

    - The `componentName` is equal to the name used in the HTML tag after the `x-` prefix. So `<x-alert />`'s `componentName` will be `alert`. The `attributes` element will contain all of the attributes that were present on the HTML tag. The `slot` element is an Illuminate\Support\HtmlString instance with the contents of the component's slot.

    - The closure should return a string. If the returned string corresponds to an existing view, that view will be rendered; otherwise, the returned string will be evaluated as an inline Blade view.

  - Additional Dependencies

    - If your component requires dependencies from Laravel's `service container`, you may list them before any of the component's data attributes and they will automatically be injected by the container:

      ```php
      use App\Services\AlertCreator;

      /**
      * Create the component instance.
      */
      public function __construct(
          public AlertCreator $creator,
          public string $type,
          public string $message,
      ) {}
      ```

  - Hiding Attributes / Methods

    - If you would like to prevent some public methods or properties from being exposed as variables to your component template, you may add them to an `$except` array property on your component:

      ```php
      <?php

      namespace App\View\Components;

      use Illuminate\View\Component;

      class Alert extends Component
      {
          /**
          * The properties / methods that should not be exposed to the component template.
          *
          * @var array
          */
          protected $except = ['type'];

          /**
          * Create the component instance.
          */
          public function __construct(
              public string $type,
          ) {}
      }
      ```

### Eloquent

#### Retrieving Single Models / Aggregates

- In addition to retrieving all of the records matching a given query, you may also retrieve single records using the `find`, `first`, or `firstWhere` methods. Instead of returning a collection of models, these methods return a single model instance:

  ```php
  use App\Models\Flight;

  // Retrieve a model by its primary key...
  $flight = Flight::find(1);

  // Retrieve the first model matching the query constraints...
  $flight = Flight::where('active', 1)->first();

  // Alternative to retrieving the first model matching the query constraints...
  $flight = Flight::firstWhere('active', 1);
  ```

- Sometimes you may wish to perform some other action if no results are found. The `findOr` and `firstOr` methods will return a single model instance or, if no results are found, execute the given closure. The value returned by the closure will be considered the result of the method:

  ```php
  $flight = Flight::findOr(1, function () {
      // ...
  });

  $flight = Flight::where('legs', '>', 3)->firstOr(function () {
      // ...
  });
  ```

- Not Found Exceptions

  - Sometimes you may wish to throw an exception if a model is not found. This is particularly useful in routes or controllers. The `findOrFail` and `firstOrFail` methods will retrieve the first result of the query; however, if no result is found, an `Illuminate\Database\Eloquent\ModelNotFoundException` will be thrown:

    ```php
    $flight = Flight::findOrFail(1);

    $flight = Flight::where('legs', '>', 3)->firstOrFail();
    ```

  - If the `ModelNotFoundException` is not caught, a 404 HTTP response is automatically sent back to the client:

    ```php
    use App\Models\Flight;

    Route::get('/api/flights/{id}', function (string $id) {
        return Flight::findOrFail($id);
    });
    ```

- Retrieving Or Creating Models

  - The `firstOrCreate` method will attempt to locate a database record using the given column / value pairs. If the model can not be found in the database, a record will be inserted with the attributes resulting from merging the first array argument with the optional second array argument:

  - The `firstOrNew` method, like `firstOrCreate`, will attempt to locate a record in the database matching the given attributes. However, if a model is not found, a new model instance will be returned. Note that the model returned by `firstOrNew` has not yet been persisted to the database. You will need to manually call the `save` method to persist it:

  ```php
  use App\Models\Flight;

  // Retrieve flight by name or create it if it doesn't exist...
  $flight = Flight::firstOrCreate([
      'name' => 'London to Paris'
  ]);

  // Retrieve flight by name or create it with the name, delayed, and arrival_time attributes...
  $flight = Flight::firstOrCreate(
      ['name' => 'London to Paris'],
      ['delayed' => 1, 'arrival_time' => '11:30']
  );

  // Retrieve flight by name or instantiate a new Flight instance...
  $flight = Flight::firstOrNew([
      'name' => 'London to Paris'
  ]);

  // Retrieve flight by name or instantiate with the name, delayed, and arrival_time attributes...
  $flight = Flight::firstOrNew(
      ['name' => 'Tokyo to Sydney'],
      ['delayed' => 1, 'arrival_time' => '11:30']
  );
  ```

- Retrieving Aggregates

  - When interacting with Eloquent models, you may also use the `count`, `sum`, `max`, and other `aggregate methods` provided by the Laravel `query builder`. As you might expect, these methods return a scalar value instead of an Eloquent model instance:

    ```php
    $count = Flight::where('active', 1)->count();

    $max = Flight::where('active', 1)->max('price');
    ```

## 41. Author Filtering

- About

  Let's next add support for filtering posts according to their respective author. With this final piece of the puzzle, we'll now be able to easily sort all posts by category, or author, or search text, or all of the above.

## 42. Merge Category and Search Queries

- About

  We next need to update both the category dropdown and search input to include all existing and relevant query string parameters. Right now, if we're browsing a certain category, as soon as we perform a search, that current category will revert back to "All." Let's fix that.

- PHP `http_build_query`

  - (PHP 5, PHP 7, PHP 8)

  - `http_build_query` — Generate URL-encoded query string

  - Description ¶

    ```php
    http_build_query(
        array|object $data,
        string $numeric_prefix = "",
        ?string $arg_separator = null,
        int $encoding_type = PHP_QUERY_RFC1738
    ): string
    ```

    - Generates a URL-encoded query string from the associative (or indexed) array provided.

  - Parameters ¶

    - `data`

      - May be an array or object containing properties.

      - If `data` is an array, it may be a simple one-dimensional structure, or an array of arrays (which in turn may contain other arrays).

      - If `data` is an object, then only public properties will be incorporated into the result.

    - `numeric_prefix`

      - If numeric indices are used in the base array and this parameter is provided, it will be prepended to the numeric index for elements in the base array only.

      - This is meant to allow for legal variable names when the data is decoded by PHP or another CGI application later on.

    - `arg_separator`

      - The argument separator. If not set or `null`, `arg_separator.output` is used to separate arguments.

    - `encoding_type`

      - By default, `PHP_QUERY_RFC1738`.

      - If `encoding_type` is `PHP_QUERY_RFC1738`, then encoding is performed per [» RFC 1738](http://www.faqs.org/rfcs/rfc1738) and the `application/x-www-form-urlencoded` media type, which implies that spaces are encoded as plus (+) signs.

      - If `encoding_type` is `PHP_QUERY_RFC3986`, then encoding is performed according to [» RFC 3986](http://www.faqs.org/rfcs/rfc3986), and spaces will be percent encoded (%20).

  - Return Values ¶

    - Returns a URL-encoded string.

  - Examples

    - **Example #1 Simple usage of http_build_query()**

      ```php
      <?php
      $data = array(
          'foo' => 'bar',
          'baz' => 'boom',
          'cow' => 'milk',
          'null' => null,
          'php' => 'hypertext processor'
      );

      echo http_build_query($data) . "\n";
      echo http_build_query($data, '', '&amp;');

      ?>
      ```

      - The above example will output:

        ```bash
        foo=bar&baz=boom&cow=milk&php=hypertext+processor
        foo=bar&amp;baz=boom&amp;cow=milk&amp;php=hypertext+processor
        ```

    - `Example #2 http_build_query() with numerically index elements.`

      ```php
      <?php
      $data = array('foo', 'bar', 'baz', null, 'boom', 'cow' => 'milk', 'php' => 'hypertext processor');

      echo http_build_query($data) . "\n";
      echo http_build_query($data, 'myvar_');
      ?>
      ```

      - The above example will output:

        ```bash
        0=foo&1=bar&2=baz&4=boom&cow=milk&php=hypertext+processor
        myvar_0=foo&myvar_1=bar&myvar_2=baz&myvar_4=boom&cow=milk&php=hypertext+processor
        ```

    - **Example #3 http_build_query() with complex arrays**

      ```php
      <?php
      $data = array(
          'user' => array(
              'name' => 'Bob Smith',
              'age'  => 47,
              'sex'  => 'M',
              'dob'  => '5/12/1956'
          ),
          'pastimes' => array('golf', 'opera', 'poker', 'rap'),
          'children' => array(
              'bobby' => array('age'=>12, 'sex'=>'M'),
              'sally' => array('age'=>8, 'sex'=>'F')
          ),
          'CEO'
      );

      echo http_build_query($data, 'flags_');
      ?>
      ```

      - The above example will output: (word wrapped for readability)

        ```bash
        user%5Bname%5D=Bob+Smith&user%5Bage%5D=47&user%5Bsex%5D=M&
        user%5Bdob%5D=5%2F12%2F1956&pastimes%5B0%5D=golf&pastimes%5B1%5D=opera&
        pastimes%5B2%5D=poker&pastimes%5B3%5D=rap&children%5Bbobby%5D%5Bage%5D=12&
        children%5Bbobby%5D%5Bsex%5D=M&children%5Bsally%5D%5Bage%5D=8&
        children%5Bsally%5D%5Bsex%5D=F&flags_0=CEO
        ```

      - Note:

        - Only the numerically indexed element in the base array "CEO" received a prefix. The other numeric indices, found under pastimes, do not require a string prefix to be legal variable names.

    - **Example #4 Using http_build_query() with an object**

      ```php
      <?php
      class parentClass {
          public    $pub      = 'publicParent';
          protected $prot     = 'protectedParent';
          private   $priv     = 'privateParent';
          public    $pub_bar  = null;
          protected $prot_bar = null;
          private   $priv_bar = null;

          public function __construct(){
              $this->pub_bar  = new childClass();
              $this->prot_bar = new childClass();
              $this->priv_bar = new childClass();
          }
      }

      class childClass {
          public    $pub  = 'publicChild';
          protected $prot = 'protectedChild';
          private   $priv = 'privateChild';
      }

      $parent = new parentClass();

      echo http_build_query($parent);
      ?>
      ```

      - The above example will output:

        ```bash
        pub=publicParent&pub_bar%5Bpub%5D=publicChild
        ```

## 43. Fix a Confusing Eloquent Query Bug

- About

  It looks like we have a slight error within our `filter()` query scope. In this lesson, we'll review the underlying SQL query that's producing the incorrect results, and then fix the bug in our Eloquent query.

- Issue

  - When we enter a speicfic category and a specific search, we are getting extra results

- The original SQL executed:

  ```sql
  SELECT *
  FROM `posts`
  WHERE (
      `title` like '%voluptatem%'
      or `body` like '%voluptatem%'
      and EXISTS (
        SELECT *
        FROM `categories`
        WHERE `posts`.`category_id` = `categories`.`id`
          and `slug` = 'unde-voluptatibus-vitae-aut-quisquam-id-sit-ipsum'
      )
    )
  ORDER BY `created_at` DESC
  ```

- For the right result:

  ```sql
  SELECT *
  FROM `posts`
  WHERE (
      `title` like '%voluptatem%'
      or `body` like '%voluptatem%')

  and EXISTS (
        SELECT *
        FROM `categories`
        WHERE `posts`.`category_id` = `categories`.`id`
          and `slug` = 'unde-voluptatibus-vitae-aut-quisquam-id-sit-ipsum'
      )
    )
  ORDER BY `created_at` DESC
  ```

# 8. Pagination

## 44. Laughably Simple Pagination

- About

  We're currently fetching all posts from the database and rendering them as a grid on the home page. But what happens down the line when you have, say, five hundred blog posts? That's a bit too costly to render. The solution is to leverage pagination - and luckily, Laravel does all the work for you. Come see for yourself.

- To customize Laravel default pagination, you need to publish it:

      php artisan vendor:publish

      Which provider or tag's files would you like to publish?
      Publish files from all providers and tags listed below ............................. 0
      Provider: Clockwork\Support\Laravel\ClockworkServiceProvider ....................... 1
      Provider: Illuminate\Foundation\Providers\FoundationServiceProvider ................ 2
      Provider: Illuminate\Mail\MailServiceProvider ...................................... 3
      Provider: Illuminate\Notifications\NotificationServiceProvider ..................... 4
      Provider: Illuminate\Pagination\PaginationServiceProvider .......................... 5
      Provider: Laravel\Sail\SailServiceProvider ......................................... 6
      Provider: Laravel\Sanctum\SanctumServiceProvider ................................... 7
      Provider: Laravel\Tinker\TinkerServiceProvider ..................................... 8
      Provider: Spatie\LaravelIgnition\IgnitionServiceProvider ........................... 9
      Tag: flare-config .................................................................. 10
      Tag: ignition-config ............................................................... 11
      Tag: laravel-errors ................................................................ 12
      Tag: laravel-mail .................................................................. 13
      Tag: laravel-notifications ......................................................... 14
      Tag: laravel-pagination ............................................................ 15
      Tag: sail .......................................................................... 16
      Tag: sail-bin ...................................................................... 17
      Tag: sail-docker ................................................................... 18
      Tag: sanctum-config ................................................................ 19
      Tag: sanctum-migrations ............................................................ 20

      ❯ 15

      INFO  Publishing [laravel-pagination] assets.

      Copying directory [vendor/laravel/framework/src/Illuminate/Pagination/resources/views] to [resources/views/vendor/pagination] ............... DONE

- Now that you have `bootstrap`, `semanitc-ui`, `tailwind`, etc templates for the pagination in `resources/views/vendor/pagination`, you can choose which one you'll be using for the pagination.

  - app/Providers/AppServiceProvider.php

    ```php
    <?php

    namespace App\Providers;

    use Illuminate\Pagination\Paginator;
    use Illuminate\Support\ServiceProvider;

    class AppServiceProvider extends ServiceProvider
    {
        ...

        /**
        * Bootstrap any application services.
        */
        public function boot(): void
        {
            Paginator::useTailwind(); // default
            Paginator::useBootstrap();
            Paginator::useBootstrapFive();
            Paginator::useBootstrapFour();
            Paginator::useBootstrapThree();

        }
    }
    ```

  - You can add anything from the above code, `useTailwind` is default

- If you use `simplePaginate` instead of `paginate()`, the pagination view will have only `Previous` `Next` links.

  - It is a little bit more performant for large dataset

- To reserve the existing query strings, you can use `withQueryString`

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
