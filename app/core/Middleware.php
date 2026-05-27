<?php

class Middleware {


    public static function requireAuth() {
        if (session_status() === PHP_SESSION_NONE) session_start();

        if (empty($_SESSION['user_id'])) {
            http_response_code(401);
            echo json_encode(['success' => false, 'message' => 'Unauthorized. Please log in.']);
            exit;
        }

        return ['id' => $_SESSION['user_id'], 'role' => $_SESSION['role']];
    }


    public static function requireRole($roles) {
        $user  = self::requireAuth();
        $roles = (array) $roles;

        if (!in_array($user['role'], $roles, true)) {
            http_response_code(403);
            echo json_encode(['success' => false, 'message' => 'Forbidden. Insufficient permissions.']);
            exit;
        }

        return $user;
    }


    public static function requireApproved() {
        if (session_status() === PHP_SESSION_NONE) session_start();

        if (empty($_SESSION['approved'])) {
            http_response_code(403);
            echo json_encode(['success' => false, 'message' => 'Your account is pending approval.']);
            exit;
        }
    }
}
