-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 16, 2026 at 09:53 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fitness_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `name`, `email`, `comment`, `created_at`) VALUES
(1, 1, 'Bhushan Dhende', 'bhushandhende34@gmail.com', 'The workout logging feature and BMI calculator make tracking fitness goals effortless!', '2026-09-15 19:12:14'),
(2, 0, 'Alex Mercer', 'alex@example.com', 'Awesome plant protein chart! The breakdown of complete vs incomplete proteins was super helpful.', '2026-09-15 20:10:53'),
(3, 0, 'Alex Mercer', 'alex@example.com', 'Awesome plant protein chart! The breakdown is super helpful.', '2026-09-15 20:11:27');

-- --------------------------------------------------------

--
-- Table structure for table `exercises`
--

CREATE TABLE `exercises` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `muscle_group` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `avg_calories_burned_per_min` decimal(5,2) DEFAULT 8.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exercises`
--

INSERT INTO `exercises` (`id`, `name`, `muscle_group`, `description`, `avg_calories_burned_per_min`) VALUES
(1, 'Barbell Bench Press', 'Chest', 'Compound upper body press targeting the pectoralis major and triceps.', 8.50),
(2, 'Incline Dumbbell Press', 'Chest', 'Upper pectoral emphasis with controlled dumbbell pressing movement.', 7.80),
(3, 'Pull-Ups / Chin-Ups', 'Back', 'Bodyweight vertical pulling movement strengthening the latissimus dorsi and biceps.', 9.00),
(4, 'Barbell Deadlift', 'Back', 'Full posterior chain compound lift targeting lats, traps, erectors, and glutes.', 11.50),
(5, 'Overhead Military Press', 'Shoulders', 'Standing barbell press building anterior and lateral deltoid strength.', 7.50),
(6, 'Lateral Dumbbell Raises', 'Shoulders', 'Isolation movement sculpting the medial deltoid heads for shoulder width.', 5.50),
(7, 'Barbell Bicep Curls', 'Arms', 'Classic arm flexion targeting the short and long heads of the biceps.', 6.00),
(8, 'Tricep Rope Pushdown', 'Arms', 'Cable extension targeting the lateral and medial heads of the triceps.', 5.80),
(9, 'Barbell Back Squat', 'Legs', 'Premier compound lower body exercise for quadriceps, hamstrings, and glutes.', 10.50),
(10, 'Romanian Deadlift', 'Legs', 'Hip-hinge movement isolating hamstrings and gluteal muscles.', 8.00),
(11, 'Hanging Leg Raises', 'Abs', 'Dynamic core exercise targeting the lower rectus abdominis.', 6.50),
(12, 'High Intensity Interval Training (HIIT)', 'Cardio', 'Burst sprint cardio optimizing VO2 max and caloric afterburn.', 13.00),
(13, 'Decline Barbell Press', 'Chest', 'Targets the lower sternal head of the pectorals for full chest density.', 7.50),
(14, 'Chest Dips (Forward Lean)', 'Chest', 'Bodyweight compound movement emphasizing the lower and outer pectorals.', 8.20),
(15, 'Cable Chest Flyes', 'Chest', 'Constant tension isolation movement providing deep peak contraction of inner pectorals.', 6.20),
(16, 'Dumbbell Pullover', 'Chest', 'Stretches and expands the ribcage while activating upper pecs and serratus anterior.', 6.80),
(17, 'Push-Ups (Standard & Diamond)', 'Chest', 'Classic bodyweight push variation developing pectoral endurance and core stability.', 7.00),
(18, 'Incline Cable Fly', 'Chest', 'Targets the clavicular head of the pectorals with continuous ascending cable tension.', 6.40),
(19, 'Seated Dumbbell Shoulder Press', 'Shoulders', 'Overhead pressing focusing on anterior and lateral delts with lower back support.', 7.20),
(20, 'Face Pulls', 'Shoulders', 'Cable exercise essential for posterior deltoid development, rotator cuff health, and posture.', 5.80),
(21, 'Bent-Over Rear Delt Flyes', 'Shoulders', 'Isolates the posterior deltoid heads and upper back rhomboids.', 5.40),
(22, 'Barbell Front Raises', 'Shoulders', 'Targeted isolation for the anterior deltoid and upper chest tie-in.', 5.60),
(23, 'Arnold Dumbbell Press', 'Shoulders', 'Rotational dumbbell press hitting all three deltoid heads through full range of motion.', 7.00),
(24, 'Barbell Upright Rows', 'Shoulders', 'Pulling movement targeting lateral deltoids and upper trapezius muscles.', 6.80),
(25, 'Bent-Over Barbell Rows', 'Back', 'Powerful horizontal pulling compound for back thickness, mid-traps, and rhomboids.', 8.80),
(26, 'Lat Pulldown (Wide Grip)', 'Back', 'Cable vertical pulling exercise developing the V-taper wings of the upper lats.', 7.20),
(27, 'Seated Cable Rows', 'Back', 'Neutral grip horizontal row emphasizing mid-back density and lat retraction.', 6.90),
(28, 'Single-Arm Dumbbell Rows', 'Back', 'Unilateral rowing exercise allowing full lat stretch and peak contraction.', 7.40),
(29, 'T-Bar Row', 'Back', 'Heavy compound movement building massive middle and upper back thickness.', 8.20),
(30, 'Hyperextensions (Back Extensions)', 'Back', 'Strengthens the lower back erector spinae, glutes, and hamstrings.', 5.80),
(31, 'Skull Crushers (Lying Triceps Extension)', 'Arms', 'Isolates the long head of the triceps with an EZ curl bar for upper arm mass.', 6.20),
(32, 'Hammer Curls', 'Arms', 'Neutral grip dumbbell curl developing the brachialis and forearm brachioradialis.', 5.60),
(33, 'Close-Grip Barbell Bench Press', 'Arms', 'Compound pressing variation shifting primary load directly onto the triceps.', 7.50),
(34, 'Preacher Curls', 'Arms', 'Strict isolation eliminating momentum to maximize lower bicep peak activation.', 5.40),
(35, 'Overhead Dumbbell Tricep Extension', 'Arms', 'Deep stretch tricep movement targeting the long head of the triceps.', 6.00),
(36, 'Barbell Wrist Curls', 'Arms', 'High-rep forearm flexor exercise enhancing grip strength and forearm mass.', 4.50),
(37, 'Ab Wheel Rollouts', 'Abs', 'Elite anti-extension core movement requiring immense rectus abdominis strength.', 7.80),
(38, 'Plank Hold (Standard & Weighted)', 'Abs', 'Isometric core stabilization strengthening deep transverse abdominis muscles.', 5.00),
(39, 'Cable Woodchoppers', 'Abs', 'Rotational functional movement developing powerful oblique muscles and core rotation.', 6.80),
(40, 'Decline Weighted Crunches', 'Abs', 'High-resistance upper rectus abdominis exercise for deeper abdominal block definition.', 6.00),
(41, 'Bicycle Crunches', 'Abs', 'Alternating cross-body movement activating both upper/lower abs and internal obliques.', 6.20),
(42, 'Russian Twists', 'Abs', 'Seated rotational exercise engaging obliques and hip stabilizers with medicine ball.', 5.80),
(43, 'Dragon Flags', 'Abs', 'Advanced bodyweight core lever exercise made famous by Bruce Lee for total core density.', 8.50),
(44, 'Barbell Hip Thrust', 'Buttocks', 'The premier glute-isolation compound producing maximum tension at peak hip extension.', 8.50),
(45, 'Cable Glute Kickbacks', 'Buttocks', 'Unilateral isolation exercise targeting the gluteus maximus and upper glute shelf.', 5.50),
(46, 'Bulgarian Split Squats (Glute Bias)', 'Buttocks', 'Forward torso lean unilateral squat heavily loading gluteus maximus and medius.', 9.00),
(47, 'Glute Bridges (Banded / Weighted)', 'Buttocks', 'Floor hip extension activating glute fibers with minimal lower back stress.', 6.20),
(48, 'Sumo Deadlift', 'Buttocks', 'Wide-stance deadlift shifting load significantly to glutes, adductors, and hips.', 10.50),
(49, 'Seated Hip Abductions', 'Buttocks', 'Isolates the gluteus medius and minimus for hip stability and outer fullness.', 5.20),
(50, 'High Box Step-Ups', 'Buttocks', 'Unilateral drive through heel maximizing eccentric and concentric glute activation.', 7.60),
(51, 'Romanian Deadlift (Glute Focus)', 'Buttocks', 'Controlled hip hinge stretching gluteus maximus under heavy loaded tension.', 8.20),
(52, 'Leg Press (45-Degree)', 'Legs', 'High-load quad and hamstring movement allowing maximal leg fatigue safely.', 8.80),
(53, 'Lying Leg Curls', 'Legs', 'Machine isolation targeting all heads of the hamstring muscle group through knee flexion.', 6.00),
(54, 'Leg Extensions', 'Legs', 'Quad isolation movement producing intense burn and quadriceps tear-drop definition.', 5.80),
(55, 'Walking Dumbbell Lunges', 'Legs', 'Functional unilateral leg developer testing balance, quad drive, and stamina.', 8.60),
(56, 'Standing Calf Raises', 'Legs', 'Heavy calf isolation loading the gastrocnemius under full stretch and contraction.', 5.20),
(57, 'Front Squats', 'Legs', 'Upright barbell squat shifting tremendous focus onto the anterior quadriceps chain.', 9.80),
(58, 'Treadmill Incline Sprints', 'Cardio', 'Low-impact steep incline running maximizing cardiovascular endurance and leg drive.', 12.00),
(59, 'Rowing Machine (Ergometer)', 'Cardio', 'Full-body cardio conditioning engaging legs, back, arms, and core simultaneously.', 11.50),
(60, 'Jump Rope (Speed & Double Unders)', 'Cardio', 'Agility, coordination, and rapid heart rate conditioning burning rapid calories.', 12.50),
(61, 'Assault Air Bike Sprints', 'Cardio', 'Dual-action push/pull bike providing punishing full-body anaerobic conditioning.', 14.00),
(62, 'Stair Climber / Stepmill', 'Cardio', 'Continuous vertical ascent building glutes and quads while driving heart rate high.', 10.50),
(63, 'Kettlebell Swings', 'Cardio', 'Explosive hip-hinge ballistic cardio torching calories and strengthening posterior chain.', 11.80),
(64, 'Battle Ropes Waves & Slams', 'Cardio', 'Upper body power cardio testing shoulder and core stamina under anaerobic stress.', 11.00);

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_subscribers`
--

CREATE TABLE `newsletter_subscribers` (
  `id` int(11) NOT NULL,
  `email` varchar(150) NOT NULL,
  `subscribed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `newsletter_subscribers`
--

INSERT INTO `newsletter_subscribers` (`id`, `email`, `subscribed_at`) VALUES
(1, 'bhushandhende34@gmail.com', '2026-09-15 19:12:15');

-- --------------------------------------------------------

--
-- Table structure for table `plant_protein`
--

CREATE TABLE `plant_protein` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` varchar(50) NOT NULL,
  `protein_per_100g` decimal(5,2) NOT NULL,
  `calories_per_100g` decimal(6,2) NOT NULL,
  `source_category` varchar(50) DEFAULT 'Legumes',
  `is_complete_protein` tinyint(1) DEFAULT 0,
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plant_protein`
--

INSERT INTO `plant_protein` (`id`, `name`, `type`, `protein_per_100g`, `calories_per_100g`, `source_category`, `is_complete_protein`, `notes`) VALUES
(1, 'Seitan (Vital Wheat Gluten)', 'Wheat Protein', 75.00, 370.00, 'Grains', 0, 'Highest protein density in plant foods; pairs with soy sauce or lentils for complete amino acid profile.'),
(2, 'Spirulina (Dried Powder)', 'Blue-Green Algae', 57.50, 290.00, 'Superfoods', 1, 'Complete protein rich in all 9 essential amino acids, iron, copper, and phycocyanin antioxidants.'),
(3, 'Nutritional Yeast (Nooch)', 'Deactivated Yeast', 50.00, 400.00, 'Superfoods', 1, 'Savory cheesy seasoning fortified with Vitamin B12, zinc, and complete branched-chain amino acids.'),
(4, 'Textured Vegetable Protein (TVP)', 'Defatted Soy Flour', 50.00, 320.00, 'Soy', 1, 'High-yield ground meat alternative with zero cholesterol and immense protein concentration.'),
(5, 'Hemp Seeds (Shelled Hearts)', 'Raw Seeds', 31.50, 553.00, 'Seeds', 1, 'Complete protein with optimal 3:1 Omega-6 to Omega-3 ratio and easily digestible edestin protein.'),
(6, 'Pumpkin Seeds (Pepitas)', 'Raw Seeds', 30.00, 559.00, 'Seeds', 0, 'Loaded with magnesium, zinc, iron, and tryptophan for muscle protein synthesis and sleep quality.'),
(7, 'Lupini Beans (Cooked)', 'Ancient Legume', 26.00, 197.00, 'Legumes', 1, 'Mediterranean miracle bean with low net carbs, very high prebiotic fiber, and complete protein.'),
(8, 'Peanuts & Pure Peanut Butter', 'Legume', 25.80, 567.00, 'Nuts & Legumes', 0, 'Calorically dense source of heart-healthy monounsaturated fats, biotin, and muscle-building energy.'),
(9, 'Almonds (Raw / Roasted)', 'Tree Nut', 21.20, 579.00, 'Nuts', 0, 'Packed with alpha-tocopherol Vitamin E, riboflavin, and calcium for muscular recovery.'),
(10, 'Sunflower Seeds (Shelled)', 'Seeds', 20.80, 584.00, 'Seeds', 0, 'High in selenium, phytosterols, and copper supporting cardiovascular and metabolic function.'),
(11, 'Tempeh (Fermented Whole Soy)', 'Fermented Soy', 20.00, 192.00, 'Soy', 1, 'Whole fermented soybean cake; fermentation breaks down anti-nutrients for maximum bioavailability.'),
(12, 'Tofu (Extra Firm, Pressed)', 'Soy Product', 17.50, 144.00, 'Soy', 1, 'Culinary powerhouse rich in calcium, isoflavones, and all 9 essential amino acids in balance.'),
(13, 'Chia Seeds', 'Raw Seeds', 16.50, 486.00, 'Seeds', 1, 'Hydrophilic superfood yielding soluble mucilage fiber and anti-inflammatory plant Omega-3s (ALA).'),
(14, 'Walnuts', 'Tree Nut', 15.20, 654.00, 'Nuts', 0, 'Premier plant nut for brain health and anti-inflammatory alpha-linolenic acid (ALA).'),
(15, 'Rolled Oats (Dry Flakes)', 'Whole Grain', 13.50, 389.00, 'Grains', 0, 'Abundant in beta-glucan soluble fiber to regulate blood glucose and promote steady gym stamina.'),
(16, 'Edamame (Steamed Pods)', 'Whole Soy', 12.00, 122.00, 'Soy', 1, 'Tender young green soybeans containing complete protein, folate, and Vitamin K.'),
(17, 'Red & Green Lentils (Cooked)', 'Legume', 9.00, 116.00, 'Legumes', 0, 'Rich in non-heme iron, potassium, and slow-digesting resistant starch for gut microbiome fuel.'),
(18, 'Chickpeas (Garbanzo Beans)', 'Legume', 8.90, 164.00, 'Legumes', 0, 'High in dietary fiber, choline, and magnesium; foundation for nutritious hummus and salads.'),
(19, 'Black Beans (Cooked)', 'Legume', 8.90, 132.00, 'Legumes', 0, 'Dark skins provide rich anthocyanin antioxidants supporting cardiovascular and immune health.'),
(20, 'Spelt & Farro (Cooked Grain)', 'Ancient Wheat', 5.50, 127.00, 'Grains', 0, 'Nutty ancient whole grain that preserves high zinc, niacin, and iron content.'),
(21, 'Green Garden Peas (Cooked)', 'Legume', 5.40, 81.00, 'Legumes', 0, 'Fibrous, sweet legume high in vitamins A, C, and K; base ingredient for sports pea protein powders.'),
(22, 'Quinoa (Cooked Seed)', 'Pseudo-Cereal', 4.40, 120.00, 'Grains', 1, 'Naturally gluten-free Andean pseudo-grain delivering all 9 essential amino acids including lysine.'),
(23, 'Wild Rice (Cooked)', 'Aquatic Grass', 4.00, 101.00, 'Grains', 0, 'Contains roughly double the protein of white rice with high phosphorus, folate, and B vitamins.'),
(24, 'Brussels Sprouts (Steamed)', 'Cruciferous', 3.40, 43.00, 'Vegetables', 0, 'High protein-to-calorie ratio; loaded with glucosinolates and antioxidant Vitamin C.'),
(25, 'Soy Milk (Plain, Unsweetened)', 'Plant Milk', 3.30, 45.00, 'Soy', 1, 'Only plant milk with natural protein equivalency to dairy milk with zero lactose or saturated fat.'),
(26, 'Spinach (Boiled / Steamed)', 'Leafy Green', 3.00, 23.00, 'Vegetables', 0, 'Remarkable 50% of calories come from protein; dense in nitrates that boost athletic blood flow.'),
(27, 'Broccoli (Steamed Florets)', 'Cruciferous', 2.80, 35.00, 'Vegetables', 0, 'Contains potent sulforaphane, high bioavailable calcium, and immune-supportive carotenoids.'),
(28, 'Portobello Mushrooms (Grilled)', 'Fungi', 2.50, 22.00, 'Vegetables', 0, 'Savory meat substitute offering rich glutamates, selenium, and cellular ergothioneine.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'Bhushan Dhende', 'bhushan', 'bhushandhende34@gmail.com', 'admin123', '2026-09-15 19:12:14'),
(2, 'Test User', 'demo_user', 'demo@fitness.com', 'password123', '2026-09-15 19:12:14');

-- --------------------------------------------------------

--
-- Table structure for table `user_exercises`
--

CREATE TABLE `user_exercises` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `exercise_id` int(11) DEFAULT NULL,
  `name` varchar(150) NOT NULL,
  `duration_minutes` int(11) DEFAULT 0,
  `sets` int(11) DEFAULT 0,
  `reps` int(11) DEFAULT 0,
  `weight_kg` decimal(5,2) DEFAULT 0.00,
  `date_performed` date NOT NULL,
  `calories_burned` decimal(6,2) DEFAULT 0.00,
  `fat_loss_grams` decimal(6,2) DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_exercises`
--

INSERT INTO `user_exercises` (`id`, `user_id`, `exercise_id`, `name`, `duration_minutes`, `sets`, `reps`, `weight_kg`, `date_performed`, `calories_burned`, `fat_loss_grams`, `created_at`) VALUES
(1, 1, 1, 'Barbell Bench Press', 30, 4, 10, 70.00, '2026-08-15', 255.00, 33.10, '2026-09-15 19:12:14'),
(2, 1, 9, 'Barbell Back Squat', 40, 4, 8, 90.00, '2026-08-16', 420.00, 54.50, '2026-09-15 19:12:14'),
(3, 1, 12, 'High Intensity Interval Training (HIIT)', 20, 1, 1, 0.00, '2026-08-17', 260.00, 33.70, '2026-09-15 19:12:14');

-- --------------------------------------------------------

--
-- Table structure for table `vegan_diet_plan`
--

CREATE TABLE `vegan_diet_plan` (
  `id` int(11) NOT NULL,
  `day_of_week` varchar(20) NOT NULL,
  `meal_time` varchar(50) NOT NULL,
  `meal_name` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `calories` decimal(6,2) DEFAULT 0.00,
  `protein` decimal(5,2) DEFAULT 0.00,
  `fat` decimal(5,2) DEFAULT 0.00,
  `carbs` decimal(5,2) DEFAULT 0.00,
  `source_link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vegan_diet_plan`
--

INSERT INTO `vegan_diet_plan` (`id`, `day_of_week`, `meal_time`, `meal_name`, `description`, `calories`, `protein`, `fat`, `carbs`, `source_link`) VALUES
(1, 'Monday', 'Breakfast', 'Steel-Cut Oatmeal with Chia Seeds & Peanut Butter', 'Rolled oats simmered in soy milk, topped with antioxidant blueberries, chia seeds, and natural peanut butter.', 450.00, 20.00, 16.00, 58.00, 'https://nutritionfacts.org'),
(2, 'Monday', 'Lunch', 'Quinoa Buddha Bowl with Crispy Smoked Tofu', 'Fluffy quinoa topped with marinated crispy smoked tofu cubes, steamed edamame, shredded cabbage, and garlicky tahini dressing.', 620.00, 34.00, 22.00, 72.00, 'https://nutritionfacts.org'),
(3, 'Monday', 'Snack', 'Plant Protein Smoothie with Banana & Hemp Hearts', 'Plant protein powder blended with almond milk, ripe banana, spinach, and shelled hemp hearts for complete BCAAs.', 290.00, 26.00, 6.00, 34.00, 'https://nutritionfacts.org'),
(4, 'Monday', 'Dinner', 'Hearty Red Lentil Coconut Dal with Brown Rice', 'Spiced yellow and red lentils simmered with ginger, garlic, turmeric, coconut milk, and spinach served over brown basmati rice.', 540.00, 24.00, 12.00, 84.00, 'https://nutritionfacts.org'),
(5, 'Tuesday', 'Breakfast', 'Savory Tofu Scramble on Sprouted Sourdough', 'Crumbled firm tofu sauteed with nutritional yeast, turmeric, bell peppers, baby spinach, served over toasted sprouted bread.', 420.00, 26.00, 14.00, 48.00, 'https://nutritionfacts.org'),
(6, 'Tuesday', 'Lunch', 'Mediterranean Chickpea & Avocado Grain Bowl', 'Roasted spiced chickpeas, farro, cherry tomatoes, cucumbers, Kalamata olives, diced avocado, and fresh dill vinaigrette.', 590.00, 22.00, 24.00, 74.00, 'https://nutritionfacts.org'),
(7, 'Tuesday', 'Snack', 'Steamed Sea Salt Edamame & Raw Almonds', 'Steamed whole edamame pods tossed in flaked sea salt paired with whole raw almonds for healthy fats and clean amino acids.', 260.00, 18.00, 14.00, 16.00, 'https://nutritionfacts.org'),
(8, 'Tuesday', 'Dinner', 'Black Bean & Tempeh Enchilada Skillet', 'Crumbled seasoned tempeh, black beans, sweet corn, roasted red peppers, enchilada sauce, and dairy-free cashew queso bake.', 580.00, 35.00, 18.00, 70.00, 'https://nutritionfacts.org'),
(9, 'Wednesday', 'Breakfast', 'Protein Buckwheat Pancakes with Maple & Walnuts', 'Buckwheat and pea-protein pancakes topped with fresh strawberries, crushed walnuts, and pure amber maple syrup.', 510.00, 28.00, 15.00, 68.00, 'https://nutritionfacts.org'),
(10, 'Wednesday', 'Lunch', 'Smoky Tempeh Bacon Wrap with Sweet Potato Wedges', 'Marinated tempeh bacon, romaine lettuce, ripe tomato, and avocado mayo in a whole wheat wrap with baked sweet potato wedges.', 640.00, 32.00, 24.00, 76.00, 'https://nutritionfacts.org'),
(11, 'Wednesday', 'Snack', 'Roasted Paprika Chickpeas & Crisp Apple', 'Crunchy oven-roasted paprika chickpeas paired with a crisp Gala apple and creamy natural almond butter.', 280.00, 12.00, 10.00, 38.00, 'https://nutritionfacts.org'),
(12, 'Wednesday', 'Dinner', 'Thai Coconut Green Curry with Tofu & Jasmine Rice', 'Aromatic coconut green curry loaded with pressed extra-firm tofu, broccoli florets, bamboo shoots, and steamed jasmine rice.', 570.00, 27.00, 20.00, 72.00, 'https://nutritionfacts.org'),
(13, 'Thursday', 'Breakfast', 'Spirulina Superfood Smoothie Bowl with Granola', 'Frozen banana, soy milk, plant protein, and blue spirulina bowl topped with pumpkin seeds, hemp hearts, and toasted granola.', 440.00, 25.00, 12.00, 60.00, 'https://nutritionfacts.org'),
(14, 'Thursday', 'Lunch', 'French Green Lentil & Walnut Bolognese over Penne', 'Slow-simmered green French lentils, crushed walnuts, and San Marzano tomato sauce over whole wheat penne pasta.', 610.00, 29.00, 16.00, 88.00, 'https://nutritionfacts.org'),
(15, 'Thursday', 'Snack', 'Pickled Lupini Beans & 85% Dark Cacao', 'High-protein, keto-friendly Mediterranean lupini beans paired with antioxidant-rich 85% dark chocolate squares.', 230.00, 19.00, 9.00, 18.00, 'https://nutritionfacts.org'),
(16, 'Thursday', 'Dinner', 'Stuffed Bell Peppers with Spiced Seitan & Rice', 'Sweet bell peppers stuffed with seasoned high-protein wheat seitan, black beans, corn, onions, and fresh tomato relish.', 530.00, 38.00, 8.00, 76.00, 'https://nutritionfacts.org'),
(17, 'Friday', 'Breakfast', 'Peanut Butter Overnight Oats with Raw Cacao Nibs', 'Rolled oats and chia seeds soaked in vanilla almond milk, layered with natural peanut butter, sliced banana, and cacao nibs.', 480.00, 22.00, 20.00, 56.00, 'https://nutritionfacts.org'),
(18, 'Friday', 'Lunch', 'Soba Noodle & Edamame Salad with Spicy Peanut Sauce', 'Buckwheat soba noodles, shelled edamame, shredded purple cabbage, and cilantro tossed in a creamy peanut ginger dressing.', 600.00, 30.00, 22.00, 72.00, 'https://nutritionfacts.org'),
(19, 'Friday', 'Snack', 'Roasted Garlic Hummus with Whole Wheat Pita & Cucumbers', 'Creamy roasted garlic chickpea hummus with crisp cucumber slices, baby carrots, and warm whole grain pita wedges.', 270.00, 12.00, 10.00, 34.00, 'https://nutritionfacts.org'),
(20, 'Friday', 'Dinner', 'Crispy Teriyaki Tofu Stir-Fry with Brown Rice', 'Air-fried extra firm tofu glazed in low-sodium ginger teriyaki sauce tossed with snap peas, shiitake mushrooms, and brown rice.', 560.00, 32.00, 15.00, 75.00, 'https://nutritionfacts.org'),
(21, 'Saturday', 'Breakfast', 'Artisan Avocado Toast with Hemp Seeds & Microgreens', 'Seeded sourdough smeared with smashed avocado, lime, hemp hearts, cherry tomatoes, and nutrient-dense sunflower microgreens.', 460.00, 17.00, 24.00, 46.00, 'https://nutritionfacts.org'),
(22, 'Saturday', 'Lunch', 'Chipotle Black Bean & Guacamole Fiesta Bowl', 'Brown rice, cumin black beans, fajita grilled peppers and onions, fresh pico de gallo, roasted sweet corn, and homemade guacamole.', 650.00, 24.00, 22.00, 90.00, 'https://nutritionfacts.org'),
(23, 'Saturday', 'Snack', 'Pea Protein Shake with Wild Antioxidant Berries', 'Vanilla pea and organic brown rice protein isolate shaken with chilled almond milk and blended wild blueberries.', 240.00, 25.00, 4.00, 26.00, 'https://nutritionfacts.org'),
(24, 'Saturday', 'Dinner', 'Velvety Red Lentil Soup with Roasted Garlic Sourdough', 'Creamy slow-simmered red lentil soup infused with cumin, sweet carrots, and coconut cream with a thick slice of toasted sourdough.', 520.00, 22.00, 14.00, 78.00, 'https://nutritionfacts.org'),
(25, 'Sunday', 'Breakfast', 'Warm Cinnamon Quinoa Porridge with Almond Butter & Figs', 'Simmered white quinoa cooked in oat milk and cinnamon, topped with fresh mission figs, sliced almonds, and a drizzle of pure date syrup.', 430.00, 16.00, 15.00, 60.00, 'https://nutritionfacts.org'),
(26, 'Sunday', 'Lunch', 'Tuscan Cannellini Bean & Lacinato Kale Salad', 'Massaged tender kale, creamy cannellini beans, sun-dried tomatoes, toasted pine nuts, and zesty lemon garlic vinaigrette.', 540.00, 23.00, 20.00, 68.00, 'https://nutritionfacts.org'),
(27, 'Sunday', 'Snack', 'Raw Energy Protein Bites with Medjool Dates & Cashews', 'Handmade no-bake energy bites made with Medjool dates, raw cashews, chia seeds, and plant-based protein powder.', 250.00, 12.00, 11.00, 28.00, 'https://nutritionfacts.org'),
(28, 'Sunday', 'Dinner', 'Roasted Butternut Squash & Wild Rice Risotto', 'Caramelized sweet butternut squash folded into creamy arborio and wild rice with fresh rosemary, served with steamed lemon asparagus.', 510.00, 18.00, 10.00, 88.00, 'https://nutritionfacts.org');

-- --------------------------------------------------------

--
-- Table structure for table `workout_routine`
--

CREATE TABLE `workout_routine` (
  `id` int(11) NOT NULL,
  `day_of_week` varchar(20) NOT NULL,
  `workout_name` varchar(100) NOT NULL,
  `muscle_group` varchar(50) NOT NULL,
  `exercise_name` varchar(100) NOT NULL,
  `sets` int(11) DEFAULT 3,
  `reps` int(11) DEFAULT 12,
  `rest_seconds` int(11) DEFAULT 60,
  `duration_minutes` int(11) DEFAULT 15,
  `equipment_needed` varchar(100) DEFAULT 'Barbell / Dumbbell',
  `is_cardio` tinyint(1) DEFAULT 0,
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workout_routine`
--

INSERT INTO `workout_routine` (`id`, `day_of_week`, `workout_name`, `muscle_group`, `exercise_name`, `sets`, `reps`, `rest_seconds`, `duration_minutes`, `equipment_needed`, `is_cardio`, `notes`) VALUES
(1, 'Monday', 'Push Strength & Hypertrophy', 'Chest', 'Barbell Bench Press', 4, 8, 90, 15, 'Barbell & Flat Bench', 0, 'Compound chest developer. Arch upper back, retract scapulae, drive through feet.'),
(2, 'Monday', 'Push Strength & Hypertrophy', 'Chest', 'Incline Dumbbell Press', 3, 10, 75, 12, 'Incline Bench & Dumbbells', 0, 'Focus on upper clavicular chest stretch and peak contraction at the top.'),
(3, 'Monday', 'Push Strength & Hypertrophy', 'Shoulders', 'Overhead Military Press', 3, 8, 90, 12, 'Barbell / Squat Rack', 0, 'Standing overhead press. Brace abs and glutes to avoid hyperextending lower back.'),
(4, 'Monday', 'Push Strength & Hypertrophy', 'Shoulders', 'Lateral Dumbbell Raises', 4, 12, 60, 10, 'Dumbbells', 0, 'Lead with elbows with slight forward lean to isolate medial deltoids.'),
(5, 'Monday', 'Push Strength & Hypertrophy', 'Arms', 'Tricep Rope Pushdown', 3, 12, 60, 8, 'Cable Station & Rope', 0, 'Flare rope outward at the bottom of the movement for peak tricep contraction.'),
(6, 'Monday', 'Push Strength & Hypertrophy', 'Chest', 'Chest Dips', 3, 10, 60, 8, 'Dip Parallel Bars', 0, 'Lean torso forward roughly 30 degrees to maximize pectoral recruitment over triceps.'),
(7, 'Tuesday', 'Pull Power & V-Taper', 'Back', 'Barbell Deadlift', 4, 6, 120, 18, 'Olympic Barbell & Plates', 0, 'Keep bar tight against shins. Engage lats and push floor away with legs.'),
(8, 'Tuesday', 'Pull Power & V-Taper', 'Back', 'Pull-Ups / Wide Lat Pulldown', 4, 8, 90, 12, 'Pull-Up Bar / Cable', 0, 'Full dead hang stretch at top; pull elbows down toward hips to flare lats.'),
(9, 'Tuesday', 'Pull Power & V-Taper', 'Back', 'Bent-Over Barbell Rows', 3, 10, 75, 12, 'Barbell', 0, 'Maintain solid 45-degree hip hinge and pull toward navel.'),
(10, 'Tuesday', 'Pull Power & V-Taper', 'Back', 'Seated Cable Rows', 3, 12, 60, 10, 'Cable Machine & V-Bar', 0, 'Neutral grip; pause and squeeze shoulder blades together for 1 second.'),
(11, 'Tuesday', 'Pull Power & V-Taper', 'Shoulders', 'Face Pulls', 3, 15, 60, 8, 'Cable & Rope Attachment', 0, 'Pull rope to bridge of nose with external rotation for posterior delts and traps.'),
(12, 'Tuesday', 'Pull Power & V-Taper', 'Arms', 'Barbell Bicep Curls', 3, 10, 60, 8, 'EZ-Bar / Barbell', 0, 'Strict form without body sway; control eccentric lowering for 3 seconds.'),
(13, 'Wednesday', 'Leg Day & Core Mastery', 'Legs', 'Barbell Back Squat', 4, 8, 120, 18, 'Squat Rack & Barbell', 0, 'King of leg exercises. Descend to parallel; drive upward through midfoot.'),
(14, 'Wednesday', 'Leg Day & Core Mastery', 'Legs', 'Leg Press (45-Degree)', 3, 12, 90, 12, 'Leg Press Machine', 0, 'Controlled negative tempo; keep feet shoulder width and do not lock knees.'),
(15, 'Wednesday', 'Leg Day & Core Mastery', 'Buttocks', 'Barbell Hip Thrust', 4, 10, 90, 12, 'Barbell & Bench Pad', 0, 'Drive through heels to full hip extension; hold peak glute squeeze for 2s.'),
(16, 'Wednesday', 'Leg Day & Core Mastery', 'Legs', 'Walking Dumbbell Lunges', 3, 12, 60, 10, 'Dumbbells', 0, '12 lunges per leg. Keep torso upright and knee tracking over toes.'),
(17, 'Wednesday', 'Leg Day & Core Mastery', 'Legs', 'Standing Calf Raises', 4, 15, 45, 8, 'Calf Raise Block / Machine', 0, 'Deep stretch at bottom; push onto big toes and hold top contraction.'),
(18, 'Wednesday', 'Leg Day & Core Mastery', 'Abs', 'Hanging Leg Raises', 3, 12, 60, 8, 'Pull-Up Bar', 0, 'Curl hips upward at top to isolate lower rectus abdominis without swinging.'),
(19, 'Thursday', 'Upper Body Definition & Abs', 'Chest', 'Incline Barbell Bench Press', 3, 10, 90, 12, 'Incline Bench & Barbell', 0, '30-degree bench angle for superior upper pectoral recruitment.'),
(20, 'Thursday', 'Upper Body Definition & Abs', 'Back', 'T-Bar Row', 3, 10, 75, 12, 'T-Bar Machine / Landmine', 0, 'Heavy compound builder for mid-back thickness and spinal erectors.'),
(21, 'Thursday', 'Upper Body Definition & Abs', 'Shoulders', 'Arnold Dumbbell Press', 3, 10, 60, 10, 'Dumbbells & Bench', 0, 'Rotational movement hitting all three deltoid heads through full range.'),
(22, 'Thursday', 'Upper Body Definition & Abs', 'Arms', 'Skull Crushers (EZ Bar)', 3, 12, 60, 8, 'EZ Bar & Flat Bench', 0, 'Lower bar toward hairline to emphasize the long head of the triceps.'),
(23, 'Thursday', 'Upper Body Definition & Abs', 'Arms', 'Incline Dumbbell Curls', 3, 12, 60, 8, 'Incline Bench & Dumbbells', 0, 'Deep stretch on the long head of biceps at the bottom position.'),
(24, 'Thursday', 'Upper Body Definition & Abs', 'Abs', 'Cable Woodchoppers', 3, 15, 45, 8, 'Cable Station & Handle', 0, '15 reps each side. Rotate through core and obliques with firm hips.'),
(25, 'Friday', 'Posterior Chain & Arm Blaster', 'Legs', 'Romanian Deadlift (RDL)', 4, 10, 90, 14, 'Barbell / Dumbbells', 0, 'Push hips back until intense hamstring stretch; maintain flat neutral spine.'),
(26, 'Friday', 'Posterior Chain & Arm Blaster', 'Legs', 'Lying Hamstring Curls', 3, 12, 60, 10, 'Leg Curl Machine', 0, 'Keep hips planted into bench; avoid using momentum to curl weight.'),
(27, 'Friday', 'Posterior Chain & Arm Blaster', 'Buttocks', 'Cable Glute Kickbacks', 3, 15, 45, 10, 'Cable Machine & Ankle Strap', 0, 'Isolates gluteus maximus and upper shelf. Squeeze firmly at top.'),
(28, 'Friday', 'Posterior Chain & Arm Blaster', 'Arms', 'Close-Grip Bench Press', 3, 10, 75, 10, 'Barbell & Bench', 0, 'Shoulder-width grip. Primary power movement for dense triceps.'),
(29, 'Friday', 'Posterior Chain & Arm Blaster', 'Arms', 'Hammer Dumbbell Curls', 3, 12, 60, 8, 'Dumbbells', 0, 'Neutral grip developing the brachialis muscle and forearm thickness.'),
(30, 'Friday', 'Posterior Chain & Arm Blaster', 'Abs', 'Plank Hold (Weighted)', 3, 60, 60, 8, 'Exercise Mat & Plate', 0, '60-second isometric hold. Brace core and glutes in rigid hollow position.'),
(31, 'Saturday', 'Cardio Engine & Fat Incinerator', 'Cardio', 'High Intensity Interval Sprints (HIIT)', 10, 1, 45, 20, 'Treadmill / Running Track', 1, '30s all-out sprint at 90% HRmax followed by 45s recovery walk (10 rounds).'),
(32, 'Saturday', 'Cardio Engine & Fat Incinerator', 'Cardio', 'Kettlebell Swings', 4, 20, 60, 10, 'Heavy Kettlebell', 1, 'Explosive hip drive; keep shoulders packed and squeeze glutes at the apex.'),
(33, 'Saturday', 'Cardio Engine & Fat Incinerator', 'Cardio', 'Rowing Machine 500m Intervals', 4, 1, 60, 12, 'Concept2 / Ergometer Rower', 1, 'Full-body cardiovascular output. Drive with legs, swing hips, pull handle.'),
(34, 'Saturday', 'Cardio Engine & Fat Incinerator', 'Cardio', 'Jump Rope Speed Intervals', 5, 100, 45, 10, 'Speed Jump Rope', 1, '100 fast rotations per set. Promotes foot speed, calf tone, and stamina.'),
(35, 'Saturday', 'Cardio Engine & Fat Incinerator', 'Cardio', 'Battle Ropes Waves & Slams', 4, 30, 45, 8, 'Battle Ropes', 1, '30 seconds continuous alternating waves followed by double slams.'),
(36, 'Saturday', 'Cardio Engine & Fat Incinerator', 'Abs', 'Ab Wheel Rollouts', 3, 10, 60, 8, 'Ab Wheel Roller', 0, 'Extend smoothly forward; brace lower back and pull back using pure abs.'),
(37, 'Sunday', 'Mobility, Flexibility & Core Reset', 'Legs', 'Foam Rolling & Myofascial Release', 1, 1, 0, 15, 'High-Density Foam Roller', 0, 'Roll out quads, hamstrings, IT bands, calves, and thoracic upper spine.'),
(38, 'Sunday', 'Mobility, Flexibility & Core Reset', 'Legs', 'World\'s Greatest Stretch & Hip Opener', 3, 8, 30, 10, 'Exercise Mat', 0, '8 reps per side. Unlocks hip flexors, adductors, and thoracic mobility.'),
(39, 'Sunday', 'Mobility, Flexibility & Core Reset', 'Back', 'Cat-Cow & Cobra Spinal Flow', 3, 10, 30, 8, 'Exercise Mat', 0, 'Slow, intentional spinal flexion and extension paired with deep breathing.'),
(40, 'Sunday', 'Mobility, Flexibility & Core Reset', 'Abs', 'Bird-Dog & Dead Bug Core Series', 3, 12, 45, 10, 'Exercise Mat', 0, 'Cross-body stabilization strengthening deep lumbar and pelvic stabilizers.'),
(41, 'Sunday', 'Mobility, Flexibility & Core Reset', 'Cardio', 'Low-Intensity Steady State Walk (LISS)', 1, 1, 0, 30, 'Outdoors / Incline Treadmill', 1, 'Brisk recovery walk keeping heart rate in Zone 2 to facilitate lactate clearance.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exercises`
--
ALTER TABLE `exercises`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletter_subscribers`
--
ALTER TABLE `newsletter_subscribers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `plant_protein`
--
ALTER TABLE `plant_protein`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_exercises`
--
ALTER TABLE `user_exercises`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user` (`user_id`);

--
-- Indexes for table `vegan_diet_plan`
--
ALTER TABLE `vegan_diet_plan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `workout_routine`
--
ALTER TABLE `workout_routine`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `exercises`
--
ALTER TABLE `exercises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `newsletter_subscribers`
--
ALTER TABLE `newsletter_subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `plant_protein`
--
ALTER TABLE `plant_protein`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_exercises`
--
ALTER TABLE `user_exercises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vegan_diet_plan`
--
ALTER TABLE `vegan_diet_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `workout_routine`
--
ALTER TABLE `workout_routine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
