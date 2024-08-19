## How to run the project locally

You only need docker for this.

Setup:
1. Clone this repository.
2. Install composer packages by running `docker run --rm -it -v "$(pwd):/app" composer/composer install` command.
3. Make copy of [.env.example](./.env.example) file and name it as `.env`.
4. Make copy of [.env.example](./.env.example) file and name it as `.env.testing`. In this file delete all `DB_` variables and replace them with `DB_CONNECTION=sqlite`
5. Run migrations by running `docker-compose run web php artisan migrate` command.
6. Fill database by running `docker-compose run web php artisan app:data-transfer` command.
7. Create empty `database/database.sqlite` file.
8. Run test migrations by running `docker-compose run web php artisan migrate --env=testing` command.
9. Fill test database by running `docker-compose run web php artisan db:seed --env=testing` command.

Run project:
1. Run command `docker-compose up`.

After running the project, you can find it at http://localhost:5000.

Additional commands you can find in the [Makefile](./Makefile) file.
