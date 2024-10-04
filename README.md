# Library Management Backend

This project is the backend API for a Library Management System, built with Laravel.

## Features

- RESTful API for managing readers, books, and book borrowing processes
- CRUD operations for readers and books
- Handle book borrowing and returning

## Prerequisites

Before you begin, ensure you have met the following requirements:

- PHP (v7.4 or later)
- Composer
- MySQL

## Installation

1. Clone the repository
2. Navigate to the project directory
3. Install the dependencies:
   ```
   composer install
   ```

4. Copy the `.env.example` file to `.env` and configure your database settings:
   ```
   cp .env.example .env
   ```

5. Generate an application key:
   ```
   php artisan key:generate
   ```

6. Run the database migrations:
   ```
   php artisan migrate
   ```

## Usage

To start the development server:

```
php artisan serve
```

The API will be available at `http://localhost:8000`.

## API Endpoints

- `GET /api/books`: Get all books
- `POST /api/books`: Add a new book
- `PUT /api/books/{id}`: Update a book
- `DELETE /api/books/{id}`: Delete a book

- `GET /api/readers`: Get all readers
- `POST /api/readers`: Add a new reader
- `PUT /api/readers/{id}`: Update a reader
- `DELETE /api/readers/{id}`: Delete a reader

- `GET /api/borrow-orders`: Get all borrow orders
- `POST /api/borrow-orders`: Create a new borrow order
- `PUT /api/borrow-orders/{id}`: Update a borrow order
- `DELETE /api/borrow-orders/{id}`: Delete a borrow order
- `PUT /api/borrow-orders/{detailedBorrowOrder}/return`: Return a book

## Project Structure

- `app/Http/Controllers`: API controllers
- `app/Models`: Eloquent models
- `database/migrations`: Database migrations
- `routes/api.php`: API routes
