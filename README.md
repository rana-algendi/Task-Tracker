# 📝 Task-Tracker - Efficient Task Management System

A robust and lightweight task management application built with **Laravel**. This project demonstrates the core principles of building scalable web applications, focusing on clean code, organized database relationships, and a user-friendly interface for managing daily productivity.

## 🚀 Key Features

* **Task Management:** Create, Read, Update, and Delete (CRUD) tasks with ease.
* **Status Tracking:** Categorize tasks based on their progress (e.g., Pending, In Progress, Completed).
* **Task Prioritization:** Assign priority levels to help users focus on what matters most.
* **User-Centric Design:** Personalized task lists for authenticated users (Ensuring data privacy).
* **Search & Filter:** Quickly find tasks by title or filter them by their current status.

## 🛠️ Technical Stack

* **Backend:** [Laravel](https://laravel.com)
* **Frontend:** Blade Templating, Tailwind CSS / Bootstrap
* **Database:** MySQL
* **Tools:** Eloquent ORM, Laravel Validation

## 📂 Architecture Highlights

* **Security:** Implemented Laravel's built-in Authentication to ensure each user only manages their own data.
* **Data Integrity:** Used Database Migrations and Eloquent relationships to maintain a clean and reliable schema.
* **Optimization:** Utilized "Route Model Binding" for cleaner Controllers and more efficient querying.

## ⚙️ Quick Start

1. **Clone the repository:**
   ```bash
   git clone [https://github.com/rana-algendi/Task-Tracker.git](https://github.com/rana-algendi/Task-Tracker.git)
2.Install Dependencies:


    composer install
    npm install && npm run dev
3.Environment Setup:

    Rename .env.example to .env

    Run php artisan key:generate

    Configure your database in .env

4.Run Migrations:


    php artisan migrate
5.Start the Server:


    php artisan serve
Developed  by Rana Algendi
