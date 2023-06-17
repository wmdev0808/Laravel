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

# 3. Blade

## 14. Blade: The Absolute Basics

## 15. Blade Layouts Two Ways

## 16. A Few Tweaks and Consideration

# 4. Working with Databases

## 17. Environment Files and Database Connections

## 18. Migrations: The Absolute Basics

## 19. Eloquent and the Active Record Pattern

## 20. Make a Post Model and Migration

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
