# CodeIgniter POS Database Activity

This project is a CodeIgniter 4 POS application created for IT0049 Technical Formative Assessment 2. It replaces the static PHP arrays from the previous activity with records retrieved from a MySQL database.

## Features

* Customer Accounts page
* User Accounts page
* MySQL database connection
* CodeIgniter Models
* Query Builder using `findAll()`
* Database records displayed in HTML tables

## Requirements

* PHP
* Composer
* CodeIgniter 4
* XAMPP
* MySQL
* Web browser

## Database Setup

1. Start Apache and MySQL in XAMPP.
2. Open phpMyAdmin at `http://localhost/phpmyadmin`.
3. Create a database named `pos_db`.
4. Import the included `pos_db.sql` file.

The database contains the following tables:

* `customers`
* `users`

Each table contains at least five sample records.

## Environment Setup

Rename the `env` file to `.env`, then configure the following settings:

```ini
CI_ENVIRONMENT = development

database.default.hostname = localhost
database.default.database = pos_db
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
database.default.DBPrefix =
database.default.port = 3306
```

## Installation

Open a terminal in the project folder and install the required dependencies:

```bash
composer install
```

Start the CodeIgniter development server:

```bash
php spark serve
```

Open the application in a browser:

```text
http://localhost:8080
```

## Application Pages

Customer Accounts:

```text
http://localhost:8080/customer-accounts
```

User Accounts:

```text
http://localhost:8080/user-accounts
```

## Models

The application uses the following CodeIgniter models:

* `CustomerModel`
* `UserModel`

The controllers use the models and the `findAll()` method to retrieve records from the database.

## Author

Marie Jeka Bacani
