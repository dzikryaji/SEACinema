# SEACinema

SEACinema is a user-friendly PHP web application designed to provide a seamless movie browsing experience. Users can effortlessly explore a wide collection of movies, making it easy to find their favorite titles. The app offers a convenient ticket booking feature, allowing users to select showtimes, choose seats, and secure their reservations in just a few clicks. To enhance convenience, SEACinema incorporates a user balance feature, eliminating the need for cash transactions. Users can conveniently manage their account balances within the app, making the ticket booking process smoother than ever.

## Configuration

Before running the SEACinema web app, please make sure to update the configuration file according to your environment.

### `config.php`

The `config.php` file contains the following configuration settings:

```php
define('BASEURL', 'http://localhost/SEACinema/');

// DB
define('DB_HOST', 'localhost');
define('DB_PORT', '3306');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'sea_cinema');
```

- `BASEURL`: The base URL of the SEACinema web app. Update it with the appropriate URL where your web app is hosted.

- `DB_HOST`, `DB_PORT`, `DB_USER`, `DB_PASS`, `DB_NAME`: The database connection details. Modify these settings to match your database configuration. The `DB_NAME` refers to the name of the database where the SEACinema tables will be created.

The `config.php` file is located in the `app/config` folder.

## Database Setup

To set up the SEACinema web app, you need to create the required database and run the DDL (Data Definition Language) script.

### Create Database

Create a new database with the desired name (e.g., `sea_cinema`) in your MySQL or MariaDB server. Make sure the database name matches the value specified in the `DB_NAME` constant of the `config.php` file.

### DDL Script

The `ddl.sql` file, located in the `app` folder, contains the DDL statements to create the necessary tables for the SEACinema web app. Run the following SQL script in the `sea_cinema` (or your chosen) database:

```sql
CREATE TABLE `account` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(128) NOT NULL,
    `username` VARCHAR(128) NOT NULL,
    `age` INT NOT NULL,
    `balance` INT NOT NULL,
    `password_hash` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE (`username`)
) ENGINE = InnoDB;

CREATE TABLE `seats` (
    `id_seats` INT NOT NULL AUTO_INCREMENT,
    `id_movie` INT NOT NULL,
    `date` DATE NOT NULL,
    `showtime` TIME NOT NULL,
    `seats` VARCHAR(64) NOT NULL,
    PRIMARY KEY (`id_seats`)
) ENGINE = InnoDB;

CREATE TABLE `ticket` (
    `id_account` INT NOT NULL,
    `id_movie` INT NOT NULL,
    `id_seats` INT NOT NULL,
    `seats` VARCHAR(64) NOT NULL,
    FOREIGN KEY (`id_account`) REFERENCES `account`(`id`),
    FOREIGN KEY (`id_seats`) REFERENCES `seats`(`id_seats`)
) ENGINE = InnoDB;
```

Run the above SQL statements to create the necessary tables in the database.

## Usage

After configuring the `config.php` file and setting up the database, you can access the SEACinema web app using the defined `BASEURL` in your web browser.

## Folder Structure

The folder structure of the SEACinema web app is as follows:

```
SEACinema/
├── app/
│   ├── config/
│   │   └── config.php
│   ├── ddl.sql
│   └── ... (other files/folders)
├── index.php
├── ... (other files/folders)
└── README.md
```

The `config.php` file

is located in the `app/config` folder, and the `ddl.sql` file is located in the `app` folder.

## HTML Template

The SEACinema web app uses the Hair Salon HTML template from [HTML Codex](https://htmlcodex.com/hair-salon-html-template/). Please visit the provided link for more information about the template, including instructions on how to use and customize it.

## GitHub Repository

The source code of the SEACinema PHP web app is hosted on GitHub. You can find the project repository at:

[GitHub Repository](https://github.com/dzikryaji/SEACinema)

Feel free to explore the repository to access the source code and learn more about the project structure and implementation.

## Credits

The SEACinema web app is developed by [dzikryaji](https://github.com/dzikryaji). The HTML template is provided by [HTML Codex](https://htmlcodex.com/).
