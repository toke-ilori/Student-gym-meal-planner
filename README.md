# Student Gym and Meal Planner

A secure multi-user full-stack web application built with PHP and MySQL that enables students to plan workouts and track meals with macro data. The system includes authentication, session-based access control, and user-specific data isolation.

## Tech Stack

- PHP
- MySQL
- HTML/CSS
- MAMP (local development)

## Features

- User registration and login
- Session-based authentication
- Secure database queries using prepared statements
- Workout tracking (planned date, title, duration, optional notes)
- Meal tracking (planned date, type, title, calories, macros)
- User-specific data isolation (users can only access their own meals/workouts)

## Security Considerations

- Passwords are securely hashed using password_hash()
- All database queries use prepared statements to prevent SQL injection
- Session-based authentication protects restricted routes
- User-specific queries enforce data isolation (users can only access their own records)

## Database Schema (Summary)

The application uses three main tables:

### users
- id
- name
- email (unique)
- password_hash
- created_at

### workouts
- id
- user_id (foreign key)
- planned_date
- title
- duration_minutes
- notes
- created_at

### meals
- id
- user_id (foreign key)
- planned_date
- meal_type
- title
- calories
- protein_g
- carbs_g
- fats_g
- created_at

## Project Structure

student-gym-meal-planner/
- index.php
- dashboard.php
- logout.php
- assets/
  - css/
  - js/ (reserved for future updates)
- auth/
  - login.php
  - register.php
- planner/
  - planner.php
  - add_workout.php
  - add_meal.php
  - delete_item.php
- includes/
  - config.php
  - db.php
  - auth_check.php
- storage/
  - app.sql

## How to Run Locally (MAMP)

1. Clone the repository:
   - git clone https://github.com/toke-ilori/Student-gym-meal-planner

2. Move the project folder into:
   - /Applications/MAMP/htdocs/

3. Start MAMP and ensure Apache and MySQL are running.

4. Create and import the database:
   - Open phpMyAdmin: http://localhost:8888/phpMyAdmin
   - Create a database (example name: Student_gym_meal_planner)
   - Import the SQL file located at:
     - storage/app.sql

5. Configure your database connection:
   - Update credentials in includes/db.php
   - Typical MAMP MySQL settings:
     - host: 127.0.0.1
     - port: 8889
     - username: root
     - password: root
     - database: Student_gym_meal_planner

6. Open the project in your browser:
   - http://localhost:8888/student-gym-meal-planner/

## Notes

- The assets/js folder is currently reserved for future JavaScript improvements (e.g., confirmation prompts, dynamic UI updates).
- Future improvements may include edit/update functionality, daily macro summaries, total calorie intake and deployment.
