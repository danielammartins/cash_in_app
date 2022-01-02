Frontend @ [GitHub do Chico](https://github.com/RainyPT/WebSpendingFrontend)

Relatório @ [Overleaf](https://www.overleaf.com/read/xdqxzybgvmfc)


## Setting the project up for testing
Check the .env file to make sure all the database info is corrent for your system i.e., the port number and the host IP. If needed, a copy of the default .env file can be found in the root directory of the laravel project @ env.example.

If you wish to load an external .env file, add the ``--env`` argument followed by the PATH to your .env file when initializing the laravel project via CLI.


Steps:
1. Clone the repo;
2. `cd app-backend`;
3. Start the server with `php artisan serve`

If there are problems with compatibility or dependencies when starting the server, run ``composer update``.

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
