## Getting Started

To start the application, follow these steps:

1. Copy the example environment file:
   ```
   cp .env.example .env
   ```

2. Update the database connection settings in the `.env` file to match your local environment.

3. Generate the application key:
   ```
   php artisan key:generate
   ```

4. *(Optional)* If you want to use data from the live server, clone the database from the live database server.

5. Start the development server:
   ```
   php artisan serve
   ```

   Then navigate to [http://localhost:8000](http://localhost:8000) in your browser.
