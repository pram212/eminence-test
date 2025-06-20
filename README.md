# Laravel + Filament
This test uses Laravel and Filament. Please make sure to follow the installation steps and meet all requirements to run the project on your local machine.

### Requirement
- PHP >= 8.2
- composer
- SQLite

---

### Installation
- Clone this repository.
- Open the terminal in the root directory of the project.
- Run the following commands:
- install dependencies
```bash 
composer install
```
- creating .env file
```bash
cp .env.example .env
``` 
- generate key application
```bash 
php artisan key:generate
```
- create sqlite database
```bash 
touch database/database.sqlite 
```
- create database structure and injecting testing data
```bash
php artisan migrate --seed
```
- optimizing application
```bash
php artisan filament:optimize-clear
```
```bash 
php artisan optimize:clear
```
- run development server
```bash 
php artisan serve
```
- open http://loclahost:8000 in your browser

---

### Credentials
1. Admin
- email : admin@example.com
- password : password
2. Developer
- email : developer@example.com
- password : password

---

### Features

#### 1. **Dashboard**

Displays several widgets containing task statistics.

---

#### 2. **Severity Management**

This feature allows you to manage severity data used in tasks. You can view, add, edit, and delete severity records. Bulk deletion using checkboxes is also available.
**Only users with the Admin role have access to this feature.**

---

#### 3. **Status Management**

This feature allows you to manage status data used in tasks. You can view, add, edit, and delete status records. Bulk deletion using checkboxes is also available.
**Only users with the Admin role have access to this feature.**

---

#### 4. **User Management**

This feature allows you to manage user data. You can view, add, edit, and delete user records. Bulk deletion using checkboxes is also available.
**Only users with the Admin role have access to this feature.**

---

#### 5. **Task Management**

This feature allows you to manage tasks. You can view, add, edit, delete tasks, and update their statuses using bulk actions with checkboxes.
**Only users with the Developer role can create, update, delete, and change task statuses.**
**Users with the Admin role can only view all tasks.**

If you log in as an **Admin**, you can view all tasks.
If you log in as a **Developer**, you will only see your own tasks (including the statistics on the dashboard).
