# Screencasts

## Getting Started

-   Installation

Installing Livewire is so simple. Composer require, and two little lines added to your layout file, and you are fully set up and ready to rumble!

    -   Install Livewire

        ```
        composer require livewire/livewire:^3.0@beta
        ```

    -   Create a Livewire component

        ```
        php artisan make:livewire hello-world
        ```

-   Data Binding

The first and most important concept to understand when using Livewire is "data binding". It's the backbone of page reactivity in Livewire, and it'll be your first introduction into how Livewire works under the hood. Mandatory viewing.

-   Actions

-   Lifecycle Hooks

-   Nesting

-   Events

## A Basic Form With Validation

-   Introduction

-   Setting Up The Component

-   Setting Up The Form

-   Adding Validation

-   Writing Tests

-   Real-Time Validation (TDD)

-   Styling With Tailwind UI

## Form Elements

-   Text Inputs
-   Checkboxes
-   Radio Buttons
-   Select Boxes
-   Submit Buttons

## Form Notifications

-   Introduction
-   TDDing A Profile Form
-   Building The Frontend w/ Tailwind UI
-   Alert Message On Save
-   Toaster Notification On Save W/ AlpineJS
-   Inline Message On Save W/ AlpineJS

## Custom Form Inputs

-   Introduction
-   Extracting Reusable Blade Components
-   Playing Nice With JavaScript Using wire:ignore
-   Diggin Deep Into wire:model
-   Using A Date-Picker: Pikaday
-   Using A Rich-Text Editor: Trix

## File Uploads

-   Introduction
-   Setting Up Gravatar
-   Configuring Filesystem Disks
-   A Basic Avatar Upload
-   Testing File Uploads
-   Showing Upload Previews
-   Uploading Directly To S3
-   Handling Multiple File Uploads
-   Making File Inputs Look Good
-   Integrating With Filepond

## Upgrading To V2

-   Upgrade To V2
-   Refactoring Validation To $rules
-   Binding Directly To Model Properties
-   Refactor Pikaday & Trix to @entangle

## Building Data Tables

-   Intro
-   A Simple Table
-   Pagination
-   Basic Search
-   Basic Sorting
-   Edit Modal
-   Create Modal
-   Advanced Search
-   Bulk Export/Delete
-   Select-All Checkboxes
-   Refactoring For Re-Usability
-   Multi-Column Sorting
-   Configuring Per-Page Results
-   Importing From CSVs
-   Making Everything Fast: Caching Results

## Hack Sessions

-   Supporting Multiple Toaster Notifications At Once
-   Animating A Re-Ordered List
-   Drag & Drop Sorting A List
-   Infinite Pagination
