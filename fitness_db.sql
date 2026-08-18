-- =======================================================
-- Lean'N'Green Fitness Website Database Schema
-- Database: `fitness_db`
-- =======================================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `fitness_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `fitness_db`;

-- --------------------------------------------------------
-- Table structure for `users`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `username` VARCHAR(50) NOT NULL UNIQUE,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`) VALUES
(1, 'Bhushan Dhende', 'bhushan', 'bhushandhende34@gmail.com', 'admin123'),
(2, 'Test User', 'demo_user', 'demo@fitness.com', 'password123');

-- --------------------------------------------------------
-- Table structure for `exercises`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `exercises`;
CREATE TABLE `exercises` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(150) NOT NULL,
  `muscle_group` VARCHAR(50) NOT NULL,
  `description` TEXT,
  `avg_calories_burned_per_min` DECIMAL(5,2) DEFAULT 8.00,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `exercises` (`id`, `name`, `muscle_group`, `description`, `avg_calories_burned_per_min`) VALUES
(1, 'Barbell Bench Press', 'Chest', 'Compound upper body press targeting the pectoralis major and triceps.', 8.50),
(2, 'Incline Dumbbell Press', 'Chest', 'Upper pectoral emphasis with controlled dumbbell pressing movement.', 7.80),
(3, 'Pull-Ups / Chin-Ups', 'Back', 'Bodyweight vertical pulling movement strengthening the latissimus dorsi.', 9.00),
(4, 'Barbell Deadlift', 'Back', 'Full posterior chain compound lift targeting lats, traps, and lower back.', 11.50),
(5, 'Overhead Military Press', 'Shoulders', 'Standing barbell press building anterior and lateral deltoid strength.', 7.50),
(6, 'Lateral Dumbbell Raises', 'Shoulders', 'Isolation movement sculpting the medial deltoid heads.', 5.50),
(7, 'Barbell Bicep Curls', 'Arms', 'Classic arm flexion targeting the short and long heads of the biceps.', 6.00),
(8, 'Tricep Rope Pushdown', 'Arms', 'Cable extension targeting the lateral and medial heads of the triceps.', 5.80),
(9, 'Barbell Back Squat', 'Legs', 'Premier compound lower body exercise for quadriceps, hamstrings, and glutes.', 10.50),
(10, 'Romanian Deadlift', 'Legs', 'Hip-hinge movement isolating hamstrings and gluteal muscles.', 8.00),
(11, 'Hanging Leg Raises', 'Abs', 'Dynamic core exercise targeting the lower rectus abdominis.', 6.50),
(12, 'High Intensity Interval Training (HIIT)', 'Cardio', 'Burst sprint cardio optimizing VO2 max and caloric afterburn.', 13.00);

-- --------------------------------------------------------
-- Table structure for `user_exercises`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `user_exercises`;
CREATE TABLE `user_exercises` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL,
  `exercise_id` INT(11) DEFAULT NULL,
  `name` VARCHAR(150) NOT NULL,
  `duration_minutes` INT(11) DEFAULT 0,
  `sets` INT(11) DEFAULT 0,
  `reps` INT(11) DEFAULT 0,
  `weight_kg` DECIMAL(5,2) DEFAULT 0.00,
  `date_performed` DATE NOT NULL,
  `calories_burned` DECIMAL(6,2) DEFAULT 0.00,
  `fat_loss_grams` DECIMAL(6,2) DEFAULT 0.00,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `user_exercises` (`id`, `user_id`, `exercise_id`, `name`, `duration_minutes`, `sets`, `reps`, `weight_kg`, `date_performed`, `calories_burned`, `fat_loss_grams`) VALUES
(1, 1, 1, 'Barbell Bench Press', 30, 4, 10, 70.00, '2026-08-15', 255.00, 33.10),
(2, 1, 9, 'Barbell Back Squat', 40, 4, 8, 90.00, '2026-08-16', 420.00, 54.50),
(3, 1, 12, 'High Intensity Interval Training (HIIT)', 20, 1, 1, 0.00, '2026-08-17', 260.00, 33.70);

-- --------------------------------------------------------
-- Table structure for `workout_routine`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `workout_routine`;
CREATE TABLE `workout_routine` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `day_of_week` VARCHAR(20) NOT NULL,
  `workout_name` VARCHAR(100) NOT NULL,
  `muscle_group` VARCHAR(50) NOT NULL,
  `exercise_name` VARCHAR(100) NOT NULL,
  `sets` INT(11) DEFAULT 3,
  `reps` INT(11) DEFAULT 12,
  `rest_seconds` INT(11) DEFAULT 60,
  `duration_minutes` INT(11) DEFAULT 15,
  `equipment_needed` VARCHAR(100) DEFAULT 'Barbell / Dumbbell',
  `is_cardio` TINYINT(1) DEFAULT 0,
  `notes` TEXT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `workout_routine` (`id`, `day_of_week`, `workout_name`, `muscle_group`, `exercise_name`, `sets`, `reps`, `rest_seconds`, `duration_minutes`, `equipment_needed`, `is_cardio`, `notes`) VALUES
(1, 'Monday', 'Push Power', 'Chest', 'Barbell Bench Press', 4, 8, 90, 20, 'Olympic Barbell & Bench', 0, 'Warm up with empty bar first.'),
(2, 'Monday', 'Push Power', 'Shoulders', 'Overhead Military Press', 3, 10, 60, 15, 'Dumbbells / Barbell', 0, 'Keep core braced.'),
(3, 'Tuesday', 'Pull Hypertrophy', 'Back', 'Lat Pulldowns', 4, 12, 60, 15, 'Cable Lat Machine', 0, 'Focus on mind-muscle squeeze.'),
(4, 'Wednesday', 'Leg Day Mastery', 'Legs', 'Barbell Back Squat', 4, 8, 120, 25, 'Squat Rack', 0, 'Hit parallel depth.'),
(5, 'Thursday', 'Core & Cardio Engine', 'Cardio', 'HIIT Treadmill Sprints', 8, 1, 45, 20, 'Treadmill', 1, '30s sprint / 30s rest interval.');

-- --------------------------------------------------------
-- Table structure for `plant_protein`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `plant_protein`;
CREATE TABLE `plant_protein` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `type` VARCHAR(50) NOT NULL,
  `protein_per_100g` DECIMAL(5,2) NOT NULL,
  `calories_per_100g` DECIMAL(6,2) NOT NULL,
  `source_category` VARCHAR(50) DEFAULT 'Legumes',
  `is_complete_protein` TINYINT(1) DEFAULT 0,
  `notes` TEXT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `plant_protein` (`id`, `name`, `type`, `protein_per_100g`, `calories_per_100g`, `source_category`, `is_complete_protein`, `notes`) VALUES
(1, 'Tofu (Extra Firm)', 'Soy Product', 17.00, 144.00, 'Soy', 1, 'Rich in calcium and complete amino acid profile.'),
(2, 'Tempeh', 'Fermented Soy', 20.00, 192.00, 'Soy', 1, 'Gut-friendly fermented whole bean protein.'),
(3, 'Red Lentils (Cooked)', 'Legume', 9.00, 116.00, 'Legumes', 0, 'High in soluble fiber, folate, and iron.'),
(4, 'Hemp Seeds', 'Seeds', 31.50, 553.00, 'Seeds', 1, 'Optimal Omega 3-to-6 fatty acid ratio.'),
(5, 'Seitan (Wheat Gluten)', 'Wheat Product', 25.00, 120.00, 'Grains', 0, 'Dense high-protein meat alternative.');

-- --------------------------------------------------------
-- Table structure for `vegan_diet_plan`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `vegan_diet_plan`;
CREATE TABLE `vegan_diet_plan` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `day_of_week` VARCHAR(20) NOT NULL,
  `meal_time` VARCHAR(50) NOT NULL,
  `meal_name` VARCHAR(150) NOT NULL,
  `description` TEXT,
  `calories` DECIMAL(6,2) DEFAULT 0.00,
  `protein` DECIMAL(5,2) DEFAULT 0.00,
  `fat` DECIMAL(5,2) DEFAULT 0.00,
  `carbs` DECIMAL(5,2) DEFAULT 0.00,
  `source_link` VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `vegan_diet_plan` (`id`, `day_of_week`, `meal_time`, `meal_name`, `description`, `calories`, `protein`, `fat`, `carbs`, `source_link`) VALUES
(1, 'Monday', 'Breakfast', 'Oatmeal with Chia Seeds & Peanut Butter', 'Rolled oats cooked with plant milk, organic chia seeds, and 2 tbsp peanut butter.', 420.00, 18.00, 16.00, 54.00, 'https://example.com'),
(2, 'Monday', 'Lunch', 'Quinoa Buddha Bowl with Crispy Tofu', 'Steamed tri-color quinoa, pan-seared tofu cubes, broccoli, and tahini drizzle.', 580.00, 32.00, 20.00, 68.00, 'https://example.com'),
(3, 'Monday', 'Dinner', 'Red Lentil Dal with Brown Rice', 'Creamy spiced red lentil curry served with whole grain brown basmati rice.', 510.00, 24.00, 10.00, 82.00, 'https://example.com');

-- --------------------------------------------------------
-- Table structure for `comments`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) DEFAULT NULL,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `comment` TEXT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `comments` (`id`, `user_id`, `name`, `email`, `comment`) VALUES
(1, 1, 'Bhushan Dhende', 'bhushandhende34@gmail.com', 'The workout logging feature and BMI calculator make tracking fitness goals effortless!');

-- --------------------------------------------------------
-- Table structure for `newsletter_subscribers`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `newsletter_subscribers`;
CREATE TABLE `newsletter_subscribers` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(150) NOT NULL UNIQUE,
  `subscribed_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `newsletter_subscribers` (`id`, `email`) VALUES
(1, 'bhushandhende34@gmail.com');

COMMIT;
