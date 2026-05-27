<?php

require_once __DIR__ . '/../app/core/Database.php';
require_once __DIR__ . '/../app/core/Middleware.php';
require_once __DIR__ . '/../app/core/Validator.php';
require_once __DIR__ . '/../app/controllers/AuthController.php';
require_once __DIR__ . '/../app/controllers/AdminController.php';
require_once __DIR__ . '/../app/controllers/TeacherController.php';
require_once __DIR__ . '/../app/controllers/QuizController.php';
require_once __DIR__ . '/../app/controllers/ResultController.php';
require_once __DIR__ . '/../app/controllers/SettingsController.php';

if (session_status() === PHP_SESSION_NONE) session_start();

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: http://localhost");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(204); exit; }

$path   = $_GET['url'] ?? '';
$method = $_SERVER['REQUEST_METHOD'];
$input  = json_decode(file_get_contents("php://input"), true) ?? [];

function respond(array $data, int $status = 200): void {
    http_response_code($status);
    echo json_encode($data);
    exit;
}

// --- AUTH (public) ---
if ($path === 'auth/login'    && $method === 'POST') respond((new AuthController())->login($input));
if ($path === 'auth/register' && $method === 'POST') respond((new AuthController())->register($input));
if ($path === 'auth/logout'   && $method === 'POST') respond((new AuthController())->logout());

// --- ADMIN ---
if ($path === 'admin/users'           && $method === 'GET')  respond((new AdminController())->getUsers());
if ($path === 'admin/delete'          && $method === 'POST') respond((new AdminController())->deleteUser($input));
if ($path === 'admin/approve-teacher' && $method === 'POST') respond((new AdminController())->approveTeacher($input));

// --- TEACHER ---
if ($path === 'teacher/students' && $method === 'GET')  respond((new TeacherController())->getStudents());
if ($path === 'teacher/approve'  && $method === 'POST') respond((new TeacherController())->approveStudent($input));

// --- QUIZ ---
if ($path === 'quiz/create' && $method === 'POST') respond((new QuizController())->create($input));
if ($path === 'quiz/list'   && $method === 'GET')  respond((new QuizController())->getAll());
if ($path === 'quiz/upload' && $method === 'POST') respond((new QuizController())->upload($input));

// --- RESULTS ---
if ($path === 'results/save' && $method === 'POST') respond((new ResultController())->save($input));
if ($path === 'results/list' && $method === 'GET')  respond((new ResultController())->getAll());

// --- SETTINGS ---
if ($path === 'settings/get'  && $method === 'GET')  respond((new SettingsController())->get());
if ($path === 'settings/save' && $method === 'POST') respond((new SettingsController())->save($input));

// --- 404 ---
respond(['success' => false, 'message' => "Route not found: $path"], 404);
