# 👨‍💻 ManagementSYS: Custom Authentication Edition 🔐
Employee Management System (EMS) built with Laravel, featuring a custom-implemented authentication stack without the use of Laravel Breeze.

This project is a core Employee Management System (EMS) designed to track and manage employee data, including personal details, employment status, and compensation. This specific repository showcases a full-stack Laravel application where the entire user authentication system (Registration, Login, and User Roles) was developed manually from scratch, rather than relying on scaffolding tools like Laravel Breeze or Jetstream.

✨ Key Features Showcased
Custom Authentication: Complete, secure implementation of user registration, session management, and login without using Laravel Breeze.

Role-Based Access Control (RBAC): Distinct user roles are enforced to control access to sensitive data (e.g., separating Employee views from Employer/Admin views).

Profile Management: Employees can securely view and update their personal profiles.

Secure File Handling: Implements file upload, storage, and display for profile photos, featuring robust validation and server-side file management (using Laravel's built-in storage disk and symbolic links).

Data Validation & Display: Handles date formatting, read-only fields for employees (Job Title, Salary), and server-side validation.


🛠️ Technology Stack
Backend: PHP (Laravel 12)

Frontend: Bootstrap (for styling and responsiveness)

Database: MySQL/SQLite (Standard Laravel Setup)

Environment: Git, GitHub, VScode 
