# Binsta - A Social Platform for Programmers

Binsta is an Instagram-like platform for programmers to share and explore code snippets. Built using a custom framework with Twig and RedBeanPHP, it offers features such as account registration, profile customization, syntax-highlighted posts, user interaction (likes, comments), and a personalized feed. Additional features include forking code snippets and multiple color schemes for enhanced visual customization.

## Installation

To set up Binsta, you will need the following tools installed on your system:

1. **PHP** - Download and install PHP via [XAMPP](https://www.apachefriends.org/download.html). Verify installation with the command:
   ```bash
   php -v
   ```
2. **Composer** - Install Composer from [this guide](https://getcomposer.org/doc/00-intro.md#installation-windows). Verify installation with:
   ```bash
   composer -v
   ```
3. **Node.js** (for TailwindCSS) - Download Node.js from [here](https://nodejs.org/en/download). Verify installation with:
   ```bash
   node -v
   ```

## Setup

Follow these steps to set up the project:

1. Clone the repository:
   ```bash
   git clone https://github.com/MartijnKerpentier/binsta.git
   ```
2. Navigate to the project directory:
   ```bash
   cd binsta
   ```
3. Install PHP dependencies:
   ```bash
   composer install
   ```
4. Install Node.js dependencies:
   ```bash
   npm install
   ```
5. Start TailwindCSS watcher:
   ```bash
   npm run watch
   ```

## Database Configuration

1. Set up a database server and create a database named `binsta`.

2. Import the `import.sql` file to set up the required tables. This can be done via a database management tool like phpMyAdmin or through the terminal:

   ```bash
   mysql -u <username> -p binsta < import.sql
   ```

3. Update the database connection in `index.php` and `seeder.php`:

   ```php
   R::setup('mysql:host=<host>;dbname=binsta', '<username>', '<password>');
   ```

4. Populate the database with sample data using the seeder script:

   ```bash
   php database/seeder.php
   ```

## Features

- **User Accounts**: Registration, login, and profile customization (bio, display name, profile picture).
- **Posts**: Share code snippets with captions and syntax highlighting.
- **Feed**: View posts from followed users.
- **Interaction**: Like and comment on posts.
- **Forking**: Create a copy of a code snippet to customize or build upon.
- **Color Schemes**: Choose custom colors for posts.

## Database Structure

### User Table

| Field            | Type         | Constraint      |
| ---------------- | ------------ | --------------- |
| id (PK)          | int unsigned | AUTO\_INCREMENT |
| username         | varchar(191) | NOT NULL        |
| password         | varchar(191) | NOT NULL        |
| email            | varchar(191) | NOT NULL        |
| profile\_picture | varchar(191) | NULL            |
| bio              | varchar(191) | NULL            |
| display\_name    | varchar(191) | NULL            |

### Post Table

| Field         | Type         | Constraint      |
| ------------- | ------------ | --------------- |
| id (PK)       | int unsigned | AUTO\_INCREMENT |
| user\_id (FK) | int unsigned | NOT NULL        |
| caption       | varchar(191) | NULL            |
| image         | varchar(191) | NULL            |
| created\_at   | varchar(191) | NOT NULL        |

### Comment Table

| Field         | Type         | Constraint      |
| ------------- | ------------ | --------------- |
| id (PK)       | int unsigned | AUTO\_INCREMENT |
| user\_id (FK) | int unsigned | NOT NULL        |
| post\_id (FK) | int unsigned | NOT NULL        |
| text          | varchar(191) | NOT NULL        |
| posted\_on    | varchar(191) | NOT NULL        |

### Snippet Table

| Field         | Type         | Constraint      |
| ------------- | ------------ | --------------- |
| id (PK)       | int unsigned | AUTO\_INCREMENT |
| user\_id (FK) | int unsigned | NOT NULL        |
| text          | varchar(191) | NOT NULL        |
| language      | varchar(191) | NOT NULL        |

### Fork Table

| Field            | Type         | Constraint      |
| ---------------- | ------------ | --------------- |
| id (PK)          | int unsigned | AUTO\_INCREMENT |
| snippet\_id (FK) | int unsigned | NOT NULL        |
| user\_id (FK)    | int unsigned | NOT NULL        |

### Follower Table

| Field             | Type         | Constraint      |
| ----------------- | ------------ | --------------- |
| id (PK)           | int unsigned | AUTO\_INCREMENT |
| user\_id (FK)     | int unsigned | NOT NULL        |
| follower\_id (FK) | int unsigned | NOT NULL        |

### Like Table

| Field         | Type         | Constraint      |
| ------------- | ------------ | --------------- |
| id (PK)       | int unsigned | AUTO\_INCREMENT |
| user\_id (FK) | int unsigned | NOT NULL        |
| post\_id (FK) | int unsigned | NOT NULL        |

## License

This project is open-source and available under the [MIT License](LICENSE).

