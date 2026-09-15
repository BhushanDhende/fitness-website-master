<?php
/**
 * Database Configuration
 * Compatible with Localhost (XAMPP/WAMP) and InfinityFree / cPanel Hosting.
 */

// Configure your database credentials here or set environment variables
$host = getenv('DB_HOST') ?: 'localhost';
$db   = getenv('DB_NAME') ?: 'fitness_db';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASS') !== false ? getenv('DB_PASS') : '';

$pdo = null;
$conn = null;
$db_connected = false;

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_TIMEOUT => 3
    ]);
    
    $conn = new mysqli($host, $user, $pass, $db);
    if (!$conn->connect_error) {
        $conn->set_charset("utf8mb4");
        $db_connected = true;
    }
} catch (Exception $e) {
    // Graceful fallback: Do not crash entire page if database is temporarily unavailable
    // Log error internally for debugging
    error_log("Database connection notice: " . $e->getMessage());
    $db_connected = false;
}