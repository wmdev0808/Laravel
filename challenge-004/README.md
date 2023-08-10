# Build Modern Laravel Apps Using Inertia.js

Inertia.js is an incredible tool that glues a server-side framework, like Laravel, to a client-side framework, like Vue. With Inertia, you can continue using server-side routing, and controllers, and authentication, and validation. With Inertia, you don't need to learn how to build an API, and you definitely don't need to use OAuth. Instead, relax and continue creating apps the way you traditionally would.

I really think you're going to enjoy Inertia as much as I do. In fact, Laracasts itself uses Inertia under the hood; I wouldn't have it any other way.

## SECTION 1 | The Basics

### 01 What is Inertia.js

- About

  Before we install Inertia.js and have a look around, let's first take five minutes to discuss what Inertia actually is and, more importantly, isn't.

- Things You'll Learn
  - What is Inertia
  - How Inertia Intercepts Links

### 02 Install and Configure Inertia

- About

  We're now ready to install and configure Inertia. In this episode, we'll closely following the Inertia docs, as we pull in the server-side and client-side adapters for Laravel and Vue, respectively. We'll next create the initial layout file, and then compile our assets down using Vite.

- Things You'll Learn
  - Install Inertia
  - Create an Inertia App
  - The @inertia Directive

### 03 Pages

- About

  Now that we've installed and configured Inertia, we can now create our first Page component. You can think of these as the client-side equivalent of a typical Blade view. Let's have a look.

- Things You'll Learn

  - Page Components
  - Inertia::render()

### 04 Inertia Links

- About

  Let's now create a few pages that we can seamlessly link between. But as you'll quickly see, we can't use a standard anchor tag to link from one page to the next. That would perform a full page refresh, which we of course don't want. Instead, we should pull in Inertia's `Link` component, which will intercept the click and automatically perform an AJAX request to the server to fetch the appropriate JSON response for the new page.

- Things You'll Learn

  - Inertia Links
  - AJAX Requests

### 05 Progress Indicators

- About

  If, for any reason, a server request takes a bit of time to prepare the appropriate response data, the user will currently be left waiting without an ounce of feedback. To remedy this, we can install Inertia's [progress indicator package](https://inertiajs.com/progress-indicators), which will display a familiar loading bar at the top of the page for any long-running request.

- Things You'll Learn

  - Progress Indicators
  - PHP sleep()

### 06 Perform Non-GET Requests

- About

  We can also use Inertia's `Link` component to perform non-GET requests. For example, what if we want to render a button that submits a `POST` request to log the user out. How might we do that, when using the `Link` component?

- Things You'll Learn

  - Link Component
  - Set the Method
  - Render as a Button

### 07 Preserve the Scroll Position

- About

  You'll often want to make an Inertia request to the current page in order to retrieve updated data. However, by default, any clicked link will of course reset the scrollbar's position to the top of the page. In situations when that's not desirable, we can leverage the `preserve-scroll` attribute on the Link component.

- Things You'll Learn

  - Preserve Scroll Position

### 08 Active Links

- About

  Next up, we should receive active links. At the moment, if you click any of the items in the navigation bar, there isn't any visual indication that you did in fact select that link. Let's fix that by leveraging both the `$page.url` and `$page.component` properties that Inertia provides to us.

- Things You'll Learn

  - Set Active Links
  - Extract NavLink Components

### 09 Layout Files

- About

  We can finally move on to layout files. At the moment, every page must manually import and render the navigation section. But, clearly, this isn't ideal. Instead, let's extract a `Layout` file that can be responsible for all portions of the UI that should remain consistent as we browse from page to page.

- Things You'll Learn

  - Extract Layouts
  - Basic Section Padding

### 10 Shared Data

- About

  Now that we've successfully extracted a `Layout` component, the next thing we need to sort out is how to share data across components. Luckily, Inertia provides a nice and friendly solution that we'll review in this episode.

- Things You'll Learn

  - HandleInertiaRequests Middleware
  - Share Data

### 11 Global Component Registration

- About

  Before we move on to persistent layouts in the next episode, first I'd like to quickly discuss global component registration. For example, it's slightly combersome to import Inertia's `Link` component every time you want to render what is effectively an anchor tag. If you wish, we can solve this by registering it as a global component.

- Things You'll Learn

  - Register Vue Components Globally
  - Script Setup

### 12 Persistent Layouts

- About

  Currently, layout state is reset each time we click from page to page. This is because every page component includes the `Layout` as part of its template. As such, when you visit a new page, that component, including the layout, is destroyed. If you instead want state from your layouts to persist across pages - such as for a podcast that continues playing as your browse the site - we'll need to review persistent layouts.

- Things You'll Learn

  - Persistent Layouts
  - State

### 13 Default Layouts

- About

  Now that we have persistent layouts working, if you wish, we can next remove the need to manually import and set the `Layout` for every single page component.

- Things You'll Learn

  - Default Layouts
  - CommonJS Imports

### 14 Code Splitting and Dynamic imports

- About

  Before we move on to something else, let's quickly touch upon dynamic imports and how that can potentially affect your bundle. If the app you're building warrants it, we can asynchronously download the JavaScript for each page in real-time, as the user browses your site.

- Things You'll Learn

  - Async Functions
  - Dynamic Imports
  - Mix Extraction

### 15 Dynamic Title and Meta Tags

- About

  Next up, let's figure out how to make the `head` portion of our HTML dynamic. Luckily, Inertia makes this a cinch by offering a `Head` component that we can pull in.

- Things You'll Learn

  - Inertia's Head Component
  - Set Head Defaults

### 16 An Important SPA Security Concern

- About

  In this episode, as we begin our review of how Eloquent data can be fetched and sent to the client-side, we'll need to take some time to discuss an incredibly important concern when building any SPA: data that is returned from an AJAX request is of course entirely visible to the end-user. With this in mind, you must pay special attention to ensure that you aren't accidentally exposing private information.

- Things You'll Learn

  - Eloquent Data Fetching
  - Collection Mapping
  - SPA Security

### 17 Pagination

- About

  You'll be happy to hear that Laravel makes a pagination laughably simple to implement. In this episode, we'll add a list of pagination links to the bottom of our users table.

- Things You'll Learn

  - Laravel Pagination
  - The through() Method
  - Dynamic Vue Components

### 18 Filtering, State, and Query Strings

- About

  Now that we have pagination working properly, let's next implement real-time search filtering. When we type into a search box, the table of users should automatically refresh to show only the users that match the given search query. Let's get to work!

- Things You'll Learn

  - Filtering
  - State Preservation
  - Eloquent Search

## SECTION 2 | Forms

### 19 Inertia Forms 101

- About

  Processing forms With Vue, Inertia, and Laravel is a joy. It instantly feels familiar, while offering wild amounts of power and flexibility. Let's by asynchronously submitting a simple form for creating a user.

- Things You'll Learn

  - Inertia Post Requests
  - Laravel Validation

### 20 Display Failed Validation Messages

- About

  In the previous episode, we got the "happy path" of our form to work properly. But what about situations where the validation checks failed? Let's conditionally render a red validation message below each input that failed the validator.

- Things You'll Learn

  - Inertia Errors
  - Display Validation Messages

### 21 Inertia's Form Helper

- About

  Anyone who has ever shipped a form to production knows that users will do all sorts of weird things that you didn't expect. To demonstrate this, we'll solve the "spam click the submit button" problem by conditionally disabling the button after the first click. Then, we'll switch over to using Inertia's form helper, which makes tasks like this laughably simple.

- Things You'll Learn

  - Inertia's Form Helper

## SECTION 3 | Throttling

### 22 Better Performance With Throttle and Debounce

- About

  Whenever you make a network request as a response to the user typing into an input, it's essential that you implement some form of request throttling. There's no need to make dozens of instant requests to your server if you don't have to. In this episode, we'll solve this by reviewing Lodash's debounce and throttle functions and discussing the differences between the two.

- Things You'll Learn

  - Throttle
  - Debounce
  - Network Requests

## SECTION 4 | Authentication and Authorization

### 23 Authentication With Inertia

- About

  Authentication with Inertia is, really, no different than performing authentication in a traditional server-side Laravel app. No tokens. No OAuth. None of that. Instead, submit the form with Inertia in the way you've already learned, and then let Laravel handle the rest. This will all feel incredibly familiar to you.

- Things You'll Learn

  - Basic Authentication
  - Intended Redirects

### 24 Authorization Tips

- About

  Let's wrap up this series by discussing how you might go about handling authorization. We certainly don't want to duplicate this sort of logic for both the server-side and client-side. Instead, we can pass any relevant authorization logic from the controller, as a component prop.

- Things You'll Learn

  - Laravel Policies
  - Per-Record Authorization
  - Can Middleware
