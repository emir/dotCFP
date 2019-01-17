# Readme Content
  * [What is dotCFP](#What-is-dotCFP)
  * [Features](#Features)
  * [Install](#Install)
    * [Cloning The Repository](#Cloning-The-Repository)
    * [Dependencies](#Dependencies)
    * [Application Type](#Application-Type)
    * [Check URL](#Check-URL)
    * [Mail Configuration](#Mail-Configuration)
    * [GitHub Integration](#GitHub-Integration)
    * [Creating a Database](#Creating-a-Database)
    * [Migration](#Migration)
    * [Preparing the First Presentation](#Preparing-the-First-Presentation)
  * [Roles](#Roles)
  * [Troubleshooting](#Troubleshooting)
# What is dotCFP
dotCFP is a PHP/Laravel based conference talk submission system. This project is greatly inspired by the @OpenCFP.
# Features
  - Propose, vote, comment and confirmation system from all authorized user roles for talks.<br />
  - Registration, transportation and accommodation information entry for speakers.<br />
  - Profile management for speakers, reviewers and admins.<br />
  - User roles management for admins. <br />
  - Mail notifications and reminders.<br />
  - Detailed event announcement system.

# Install
  ### Requirements
  dotCFP needs to [Laravel 5.7 Requirements](https://laravel.com/docs/5.7#server-requirements)
  ### Cloning The Repository
  Run the following code for cloning dotCFP repository into your working directory.
   ```
     $ git clone git@github.com/emir/dotCFP.git
   ```
  ### Dependencies
  Get [Composer](https://getcomposer.org/) for managing dependencies.
  Copy the composer.phar to project directory and run the following code.
   ```
     $ composer.phar install
   ```
  ### Application Type
   Go to `config/app.php` and set application type from `env`
   For production edit the name of file `.env.example` to `.env`
  ### Check URL
   Go to `config/app.php` and check url from `url`.
   
  ### Mail Configuration
   Go to `config/mail.php` and set your mail configuration.
   ```
   MAIL_HOST=smtp.mailtrap.io
   MAIL_PORT=2525
   MAIL_USERNAME=null
   MAIL_PASSWORD=null
   MAIL_ENCRYPTION=null
   ```
  ### GitHub Integration
  Create your GitHub OAuth app from [here](https://github.com/settings/developers) for authentication and set OAuth app.<br />
    `Homepage URL` : YOUR_HOMEPAGE_URL<br />
    `Authorization callback URL` : YOUR_HOMEPAGE_URL/login/github/callback<br /><br />
  Enter the OAuth app information in `.env` file.
  ```
  GITHUB_CLIENT_ID=
  GITHUB_CLIENT_SECRET=
  GITHUB_CALLBACK_URL=YOUR_HOMEPAGE_URL/login/github/callback
  ```
  ### Creating a Database
  Create a database from your server and go `.env` file to set database.
  ```
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=dotcfp
  DB_USERNAME=root
  DB_PASSWORD=
  ```
  Run the following code for provide secure passwords and user sessions.
  ```
  php artisan key:generate
  ```
  
  ### Migration
  Run the following code for migration.
  ```
  php artisan migrate
  ```
  ### Preparing the First Presentation
  Go to `config/dtcfp.php` for first presentation.<br />
  `config/dtcfp.php` contains details that you can edit the event details on the homepage.<br />
   All variables should be customized for your event.<br />
   
  #### Note
  `Call for Papers` enable between `cfp_start_date` and `cfp_end_date`
  
  
  
 # Roles
   - User
     * Can login with GitHub.
     * Determine the state of transportation.
     * Can be send many talk proposes.
   - Reviewer 
     * Can send new talks.
     * Can edit or delete their own conversations.
     * Can view all talks and comments.
     * Can comment on all conversations.
   - Admin
     * Can send new talks.
     * Can authorize all users Admin or Reviewer roles.
     * Can edit or delete all conversations.
 # Troubleshooting
  ### Specified key was too long.
  This error only occurs under 5.7.7 versions of MySQL. <br />
  Go to `app/providers/AppServiceProvider.php` and set a default string length.
  ```
  use Illuminate\Support\Facades\Schema;

public function boot()
{
    Schema::defaultStringLength(191);
}
  ```


  
