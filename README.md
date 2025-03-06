# Custom User Login WordPress Plugin

A simple WordPress plugin to add a custom login form using a shortcode.  This allows you to display a login form on any page or post.

## Description

This plugin provides a custom login form for your WordPress website.  It uses a shortcode `[custom_login_form]` that you can insert into any page or post to display the form.  The plugin includes basic error handling and redirects the user back to the page they were on after a successful login.  It also displays "Lost Password" and "Register" links (if registration is enabled).

## Features

*   Displays a custom login form on any page or post using the `[custom_login_form]` shortcode.
*   Checks if the user is already logged in and displays a relevant message.
*   Includes "Lost Password" and "Register" links.
*   Redirects the user back to the page they were on after successful login.
*   Handles login errors and displays an error message.
*   Translation ready.
*   Basic CSS styling (can be customized).

## Installation

1.  Download the plugin as a ZIP file.
2.  In your WordPress admin area, go to Plugins > Add New.
3.  Click "Upload Plugin" and select the ZIP file you downloaded.
4.  Click "Install Now".
5.  Activate the plugin.

## Usage

1.  Create a new WordPress page (e.g., "Login").
2.  **Important:** Set the *slug* of the page to `login`. This is crucial for the error handling to function correctly.
3.  Add the shortcode `[custom_login_form]` to the content of the "Login" page.
4.  Visit the "Login" page on your website.  You should see the custom login form.

## Customization

*   **CSS Styling:** The plugin includes some basic CSS styling. You can override these styles by adding your own CSS to your theme's stylesheet or using a custom CSS plugin.  The CSS classes used in the form are:
    *   `#custom-login-form` (the main container)
    *   `.input` (for the input fields)
    *   `.submit` (for the submit button)
    *   `.login-error` (for the error message)
*   **Translations:** The plugin is translation-ready. You can create translation files in the `/languages/` directory of the plugin using a tool like Poedit.
