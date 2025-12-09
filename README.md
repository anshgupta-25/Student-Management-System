# Student Management System (PHP + MySQL)

A clean, exam-ready CRUD application for managing student records using procedural PHP, mysqli, and a MySQL database. Built for DBMS practical exams with simple UI, clear code, and step-by-step setup instructions.

## ✨ Features
- Full CRUD (Create, Read, Update, Delete) with prepared statements and POST-only operations
- Inline success/error banners with automatic redirects
- Delete confirmation dialog plus CSRF-safe POST form
- JSON feed (`students-json.php`) for backups or integrations
- Zero third-party dependencies beyond PHP and MySQL

## 📁 Project Structure
```
Student Management System/
├── add.php
├── students-json.php
├── css/
│   └── styles.css
├── database.sql
├── db.php
├── delete.php
├── edit.php
├── index.php
├── js/
│   └── app.js
└── README.md
```

## 🧱 Database Schema
Run the SQL script in `database.sql` to create the `student_management` database and the `students` table:
- `id` (INT, Primary Key, Auto Increment)
- `name` (VARCHAR)
- `roll_no` (VARCHAR, Unique)
- `branch` (VARCHAR)
- `year` (VARCHAR)
- `email` (VARCHAR, Unique)
- `created_at` (Timestamp)

## ⚙️ Setup Instructions (XAMPP/WAMP)
## ⚙️ Setup Instructions
### Option A · XAMPP/WAMP (Apache)
1. Copy the project folder into `htdocs` (XAMPP) or `www` (WAMP).
2. Start **Apache** and **MySQL** from the control panel.
3. Open `http://localhost/phpmyadmin`, create a database named `student_management`, then import `database.sql`.
4. Edit `db.php` if your MySQL username/password differ from the defaults (root / empty password).
5. Visit `http://localhost/Student%20Management%20System/index.php`.

### Option B · PHP Dev Server + Homebrew MySQL
```bash
# after `brew install mysql`
brew services start mysql
mysql -u root < "/absolute/path/to/database.sql"

cd "/Users/<you>/Desktop/Student Management System"
php -S localhost:8000
```
Then browse to `http://localhost:8000/index.php` (or change the port if needed).

## 💡 Usage Notes
- `index.php` lists students and offers Edit/Delete buttons.
- `add.php` and `edit.php` use POST forms, prepared statements, and input validation.
- `delete.php` deletes via POST and redirects back with success/error messages.
- `students-json.php` outputs every student row as JSON at `http://localhost/Student%20Management%20System/students-json.php` (or `http://localhost:8000/students-json.php` if you use `php -S`).
- `css/styles.css` styles the layout, while `js/app.js` handles delete confirmations.

## 🌐 Helpful URLs
| Purpose | URL (Apache) | URL (PHP dev server) |
| --- | --- | --- |
| Main UI | `http://localhost/Student%20Management%20System/index.php` | `http://localhost:8000/index.php` |
| Add form | `.../add.php` | `http://localhost:8000/add.php` |
| JSON feed | `.../students-json.php` | `http://localhost:8000/students-json.php` |
| phpMyAdmin | `http://localhost/phpmyadmin` | – |

## 🧪 Quick Manual Test Flow
1. Add a new student and expect the success banner.
2. Submit the same roll number/email again to see the friendly duplicate warning.
3. Edit an existing student and confirm the table updates.
4. Delete a record, acknowledging the confirmation prompt.
5. Hit the JSON endpoint and verify the data matches the table.

## 🛠️ Troubleshooting
| Symptom | Fix |
| --- | --- |
| `mysqli_sql_exception: No such file or directory` | Start MySQL (e.g., `brew services start mysql`) and confirm the credentials in `db.php`. |
| `Duplicate entry for key` | Use unique roll numbers/emails; the UI shows a warning without crashing. |
| PHP server port in use | Run `php -S localhost:8080` (or another free port) and update the URLs. |
| Table empty | Re-import `database.sql` or verify via `students-json.php`. |

## ✅ Requirements Covered
- Procedural PHP w/ mysqli
- Prepared statements for all input-based queries
- POST-based forms for Create/Update/Delete
- Success/error flash messages with redirects
- Simple, single-form UI for add/edit and a student table with actions

Happy learning and best of luck with your practical exam! 🎓
