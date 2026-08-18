# 🏋️ Lean'N'Green — Fitness & Workout Management Platform

[![PHP Version](https://img.shields.io/badge/PHP-8.0%2B-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-Database-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-Responsive-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)](https://getbootstrap.com/)
[![JavaScript](https://img.shields.io/badge/JavaScript-Interactive-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)](https://developer.mozilla.org/en-US/docs/Web/JavaScript)
[![License](https://img.shields.io/badge/License-MIT-green.svg?style=for-the-badge)](LICENSE)

**Lean'N'Green** is a full-stack health, fitness, and workout tracking web application designed to empower fitness enthusiasts with interactive workout planning, muscle anatomy exercise guides, vegan & plant-based nutrition charts, daily exercise logging, and body mass index (BMI) tracking.

---

## 🌟 Key Features

- **📊 Comprehensive Workout Routines**: Interactive weekly training schedules categorized by day, muscle focus, sets, reps, and rest intervals.
- **💪 Muscle Group & Anatomy Catalog**: Detailed exercise library broken down by anatomical groups (Chest, Back, Shoulders, Arms, Legs, Buttocks, Abs, and Cardio).
- **📝 Exercise & Caloric Burn Logger**: Log individual workout sessions with real-time caloric expenditure calculations and estimated fat loss metrics.
- **🌱 Plant-Based Nutrition & Vegan Diet Plans**: Curated meal guides detailing macro distribution (Protein, Carbs, Fats, Calories) and high-protein plant sources.
- **⚖️ Interactive BMI Calculator**: Instant Body Mass Index calculator with health category classifications and personalized recommendations.
- **💬 Community Comments & Newsletter**: Real-time user feedback section and newsletter subscription module.
- **🛡️ Admin Management Dashboard**: Dedicated administrative portal to manage users, exercise directories, workout routines, and nutrition plans.

---

## 🛠️ Technology Stack

| Layer | Technologies Used |
|---|---|
| **Backend** | PHP (OOP, PDO & MySQLi database interfaces) |
| **Database** | MySQL (Relational schema with normalized tables) |
| **Frontend** | HTML5, CSS3, JavaScript, jQuery, Bootstrap |
| **UI Components** | Slick Slider, Fancybox, FontAwesome Icons, WOW.js Animations |
| **Web Server** | Apache (XAMPP / WAMP / LAMP compatible) |

---

## 📁 Project Structure

```text
fitness-website-master/
├── admin/                    # Admin portal & management modules
│   └── html/                 # Admin CRUD interfaces (add exercises, diet plans, etc.)
├── assets/                   # Static assets (CSS, JS, Fonts, Images, Plugins)
│   ├── css/                  # Bootstrap, FontAwesome, animations, theme styles
│   ├── js/                   # jQuery, Slick, custom interactive scripts
│   └── images/               # Project images, icons, and illustrations
├── fitness_db.sql            # Turnkey MySQL database schema & sample seed data
├── db.php                    # Centralized PDO & MySQLi database connection
├── index.php                 # Landing page & feature showcase
├── nav.php                   # Global responsive navigation bar
├── footer.php                # Global footer & newsletter subscriber
├── BMI-calc.php              # Interactive Body Mass Index calculator
├── log_exercise.php          # Daily workout & calorie burn logger
├── exercise-done.php         # User workout history & progress log
├── Workout Routine.php       # Weekly workout schedule & exercise breakdown
├── Vegan Diet Plan.php       # Nutritional meal planner
├── Plant Protein.php         # Plant-based protein reference library
├── Chest.php, Back.php...    # Muscle anatomy exercise category pages
├── user-setting.php          # User profile & credentials management
└── style.css                 # Custom stylesheet & layout overrides
```

---

## 🚀 Getting Started (Local Setup)

### Prerequisites
- [XAMPP](https://www.apachefriends.org/) / [WAMP](https://www.wampserver.com/) / LAMP stack installed with **PHP 7.4+ or 8.x** and **MySQL / MariaDB**.

### Step 1: Clone / Copy to Web Server Directory
Copy or clone the repository into your Apache document root:
- **XAMPP (Windows)**: `C:\xampp\htdocs\fitness-website-master`
- **WAMP (Windows)**: `C:\wamp64\www\fitness-website-master`
- **Linux (LAMP)**: `/var/www/html/fitness-website-master`

```bash
git clone https://github.com/<your-username>/fitness-website-master.git
```

### Step 2: Import Database Schema
1. Open your browser and navigate to `http://localhost/phpmyadmin`.
2. Create a new database named **`fitness_db`**.
3. Click on the **Import** tab.
4. Choose the file `fitness_db.sql` from the project root and click **Go**.

### Step 3: Configure Database Connection
Verify the connection credentials in [`db.php`](db.php):
```php
$host = 'localhost';
$db   = 'fitness_db';
$user = 'root';
$pass = ''; // Leave empty for default XAMPP, or your MySQL password
```

### Step 4: Run Application
Open your browser and navigate to:
```text
http://localhost/fitness-website-master/index.php
```

---

## 👥 Default Demo Credentials

- **Admin / Demo User**:
  - **Username**: `bhushan` or `demo_user`
  - **Password**: `admin123` or `password123`
- **Admin Panel URL**: `http://localhost/fitness-website-master/admin/html/dashboard.php`

---

## 📜 License
This project is open-source and available under the [MIT License](LICENSE).
