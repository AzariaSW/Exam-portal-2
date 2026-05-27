<?php

require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../core/Middleware.php';
require_once __DIR__ . '/../models/User.php';

class TeacherController {

    public function getStudents() {
        Middleware::requireRole('teacher');
        $model = new User(Database::connect());
        // Pass null to get all students regardless of quiz enrollment
        return ['success' => true, 'students' => $model->getStudents(null)];
    }

    public function approveStudent($input) {
        Middleware::requireRole('teacher');

        if (!isset($input['id'], $input['approved']))
            return ['success' => false, 'message' => 'Student ID and approved status are required'];

        return (new User(Database::connect()))->approveStudent($input['id'], $input['approved']);
    }
}
