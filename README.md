# PHP MySQL Search Engine Project

## Project Overview

This project demonstrates how to create a search engine using PHP and MySQL from scratch. The application allows users to search, insert, and display site details stored in a MySQL database. The system effectively handles file uploads, database operations, and search functionalities.

## Features

- **Creating a Search Engine in PHP & MySQL**: This project is designed to teach you how to build a fully functional search engine using PHP and MySQL.
- **Fetching Data from MySQL Database**: Retrieve and display data from a MySQL database based on user search queries.
- **Inserting Site Details**: Users can add new site details (including images) to the database, which are then searchable and displayable.
- **Dynamic Search Result Pages**: The project dynamically generates pages displaying search results based on user input.
- **Image Uploading & Display**: Users can upload site images which are then displayed in the search result pages.

## Key Components

### 1. `search.html`

- **Purpose**: Collects search queries from users.
- **Form Method**: Uses the `POST` method to submit the query to `result.php`.
- **Navigation**: Provides links to other pages for inserting data and viewing properties.

### 2. `result.php`

- **Purpose**: Processes the search query, performs a database search, and handles potential insertions.
- **Method Handling**: Ensures the form data is processed via `POST`.
- **Database Interaction**: Includes both query checking and data insertion logic.
- **Error Handling**: Displays appropriate messages for errors or success.

### 3. `insert_site.php`

- **Purpose**: Allows users to insert new site data into the database, including file uploads.
- **File Upload Handling**: Manages file uploads with validation and error checking.
- **Database Insertion**: Inserts the form data and uploaded file information into the database.
- **User Feedback**: Provides clear messages on file upload status and data insertion results.

## Key Actions and Adjustments

### 1. Consistent Form Methods

- **Form Method**: `search.html` uses the `POST` method to submit the search query.
- **Data Handling**: `result.php` processes the form data using `POST` to match the form submission method.

### 2. Correct Handling of File Upload

- **File Upload Process**: Properly handles the file upload process, including validation, size checks, and moving the file to the desired directory.
- **Error Messages**: Error messages and file upload success messages are clearly displayed to the user.

### 3. Database Operations

- **Database Connection**: Established a successful connection to the MySQL database.
- **Data Insertion**: Successfully inserted form data into the database and verified that the insertion was successful.

### 4. Sanitization and Error Handling

- **Sanitization**: Used `mysqli_real_escape_string()` to sanitize inputs, preventing SQL injection.
- **Error Handling**: Added error handling to display informative messages for both successful operations and any issues encountered during database interactions.

### 5. File and Data Verification

- **File Verification**: Confirmed that the file was uploaded to the correct directory.
- **Data Verification**: Ensured that the newly inserted data can be retrieved and displayed through the search functionality.

## If Everything is Working

If the system is now functioning as expected, you have successfully resolved the previous issues. Moving forward, you can:

- **Test Thoroughly**: Conduct additional tests to ensure that all edge cases and potential errors are handled correctly.
- **Review and Refactor**: Look over your code to see if there are opportunities for refactoring or improving readability and maintainability.
- **Implement Additional Features**: Consider adding more features or improving the user interface based on user feedback.

## Tools and Technologies

- **HTML, CSS**: For creating the structure and styling of the web pages.
- **PHP**: For server-side scripting and handling form submissions, database operations.
- **MySQL**: For storing and managing the site details and search queries.
- **USBWebserver & PHPMyAdmin**: For local server management and database administration.
