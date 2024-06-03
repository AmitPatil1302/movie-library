# Movie Library

## Overview

Movie Library is a web application where users can create and manage lists of movies. Users can create lists of movies, add movies to these lists, and choose to make their lists public or private. Public lists can be shared with others via a link.

## Features

- User authentication (sign up and sign in)
- Create and manage movie lists
- Add movies to lists
- Public and private lists
- Search for movies

## Project Structure

movie-library/
├── css/
│ └── styles.css
├── js/
│ └── scripts.js
├── php/
│ ├── add_movies.php
│ ├── config.php
│ ├── signup.php
│ ├── signin.php
│ ├── create_list.php
│ ├── view_lists.php
│ ├── search_movies.php
│ ├── home.php
│ └── logout.php
├── index.html
├── signup.html
├── signin.html
├── create_list.html
├── add_movies.html
├── home.html
├── setup.sql
└── index.php

## Setup

### Prerequisites

- XAMPP or any other local server setup with PHP and MySQL support.
- Web browser.

### Installation

1. **Clone the repository**

    ```sh
    git clone https://github.com/yourusername/movie-library.git
    ```

2. **Move to the project directory**

    ```sh
    cd movie-library
    ```

3. **Configure the database**

    - Open PHPMyAdmin and create a new database named `movie_library`.
    - Import the `setup.sql` file into the `movie_library` database to create the necessary tables.
    - Update the `config.php` file with your database credentials.

    ```php
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "movie_library";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    ?>
    ```

4. **Start the local server**

    - Place the project folder in the `htdocs` directory if using XAMPP.
    - Start Apache and MySQL from the XAMPP control panel.

5. **Access the application**

    Open your web browser and navigate to:

    ```
    http://localhost/movie-library/
    ```

## Usage

1. **Sign Up**

    - Navigate to the Sign Up page and create a new account.

2. **Sign In**

    - Sign in with your newly created account.

3. **Create Movie Lists**

    - Navigate to "Create a New List" and create your movie lists.

4. **Add Movies to Lists**

    - Navigate to "Add Movies to List" and add movies to your created lists.

5. **View and Manage Lists**

    - View your lists on the Home page. You can see all your lists and manage them.

