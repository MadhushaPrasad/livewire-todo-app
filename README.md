# Livewire Todo App

This is a simple and responsive Todo List web application built with [Laravel Livewire](https://laravel-livewire.com/) and [Tailwind CSS](https://tailwindcss.com/). It allows users to manage their tasks with features such as adding, editing, and deleting tasks.

## Features

- Add new tasks
- Mark tasks as complete or incomplete
- Edit existing tasks
- Delete tasks
- Real-time updates using Livewire

## Installation

1. Clone the repository:
    ```bash
    git clone https://github.com/MadhushaPrasad/livewire-todo-app.git
    ```
2. Navigate into the project directory:
    ```bash
    cd livewire-todo-app
    ```
3. Install dependencies:
    ```bash
    composer install
    npm install
    npm run dev
    ```
4. Set up your `.env` file and generate the application key:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
5. Migrate the database:
    ```bash
    php artisan migrate
    ```
6. Start the development server:
    ```bash
    php artisan serve
    ```

## Technologies Used

- **Laravel**: Backend framework
- **Livewire**: For real-time UI updates
- **Tailwind CSS**: For responsive and modern design

## License

This project is open-source and licensed under the [MIT License](LICENSE).
