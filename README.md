## Food Delivery API

### Setup Instructions

**Requirements:**

> - PHP >= 8.1
> - Composer >= 2.4.3
> - MySQL >= 8.0

**-** Clone the repository in your terminal using `https://github.com/victorive/food-delivery-api.git`

**-** Navigate to the project’s directory using `cd food-delivery-api`

**-** Run `composer install` to install the project’s dependencies.

**-** Run `cp .env.example .env` to create the .env file for the project’s configuration
and `cp .env.example .env.testing` to create the .env file for the testing environment.

**-** Run `php artisan key:generate` to set the application key.

**-** Run `php artisan jwt:secret` to set the JWT secret key.

**-** Create a database with the name **food-delivery-api** or any name of your choice in your current database
server and configure the DB_DATABASE, DB_USERNAME and DB_PASSWORD credentials respectively, in the .env files located in
the project’s root folder. eg.

> DB_DATABASE={{your database name}}
>
> DB_USERNAME= {{your database username}}
>
> DB_PASSWORD= {{your database password}}

**-** Generate API keys for AWS SES and FCM and configure them in both `.env` files.

**-** Run `php artisan migrate --seed` to create your database tables and seed some necessary data for a start.
This data includes an admin user with the credentials below:

`email: admin@admin.com`
`password: password`

**-** Start your queue workers by with `php artisan queue:work` 

**-** Set up the cron configuration to run `php artisan schedule:run >> /dev/null 2>&1` at the specified time interval. Currently, 
there's a command that runs daily at noon.

**-** Run `php artisan serve` to serve your application, then use the link generated to access the API via any
API testing software of your choice.

**-** To run the test suites, ensure you have configured the testing environment using the `.env.testing` file
generated earlier, then run `php artisan test`.

Here's the link to the API documentation on [Postman](https://documenter.getpostman.com/view/20297691/2s946o5VXS)
