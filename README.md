.warning {
  --text: #6a737d;  // theme text color default
  --title: inherit; // theme title color (falls back to text color by default)
  --background: #f8f8f9;
  --border: #8b939c;
}

Frontend @ [GitHub do Chico](https://github.com/RainyPT/WebSpendingFrontend)

Relatório @ [Overleaf](https://www.overleaf.com/read/xdqxzybgvmfc)


## Setting the project up for testing
Check the .env file to make sure all the database info is corrent for your system i.e., the port number and the host IP. If needed, a copy of the default .env file can be found in the root directory of the laravel project @ env.example.

If you wish to load an external .env file, add the ``--env`` argument followed by the PATH to your .env file when initializing the laravel project via CLI.


Steps:
1. Clone the repo;
2. `cd app-backend`;
4. Start the server with `php artisan serve`

If there are problems with compatibility or dependencies when starting the server, run ``composer update``.

The local database is, by default, not included with the other files. To set it up for testing, create a `database.sqlite` file in `/database/` and run the migrations with `php artisan migrate`. 
<p class="callout warning">If the .env file database info was changed, you will need to update the new .env with the correct database information! </p>


### Testing the API with Postman
Make sure to add the key `Accept` with the value `application/json` headers.


# API Documentation

## Public Routes

- [ ] '/'
- [x] '/login'
- [x] '/register'
- [ ] '/contact-us'

## Protected Routes
- [ ]  '/dashboard'
- [ ]  '/graphs'
- [ ]  '/expenses'
- [x]  '/logout'

## Endpoints

- [x]  GET '/expenses/{id}'
- [x]  POST '/expenses/{id}'
- [x]  DELETE '/expenses/{id}'
- [x]  PUT '/expenses/{id}'
- [x]  GET '/expenses/search/{name}'

## Coming soon
- [ ]  '/expenses/import'
- [ ]  '/expenses/export'

