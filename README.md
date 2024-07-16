# Bill Payments System
A simple RESTful API for managing a simple bill payments system, having just the USERS and TRANSACTIONS table.

## Installation

### Prerequisites

- PHP 8.1
- Laravel 10.x
- Composer
- Apache Server
- MySQL

### Steps
The steps below will guide you to run the project on your local machine. These commands  can be run using Powershell (for Windows OS), or Terminal (for Unix).

1. Clone the repository:
    ```bash
    git clone https://github.com/edokaDev/easybill.git
    cd easybill
    ```
    
2. Install the dependencies:
    ```bash
    composer install
    ```

3. Copy the example environment file
    ```bash
    cp .env.example .env
    ```

4. Update .env file
    Set the following variables in the .env file.
    ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=easybill
    DB_USERNAME=your_db_username
    DB_PASSWORD=your_db_password
    ```

5. Generate the application key:
    ```bash
    php artisan key:generate
    ```

6. Run the database migrations:
    ```bash
    php artisan migrate
    ```
7. Seed Database (Optional)
    ```bash
    php artisan db:seed
    ```
8. Start the development server:
    ```bash
    php artisan serve
    ```

## Tests
To run test, run the command below.
```bash
php artisan test
```

## Data Model
The data model is available at the link below.
```bash
https://dbdiagram.io/d/easyBill-66967d308b4bb5230e7cc48c
```

## Documentation
The Postman document is available at the link below.
```bash
https://documenter.getpostman.com/view/20514107/2sA3kRJ48h
```
