
CREATE DATABASE IF NOT EXISTS IP_exam_portal
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE IP_exam_portal;

-- USERS 
CREATE TABLE users (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(100)  NOT NULL,
    email      VARCHAR(150)  NOT NULL UNIQUE,
    password   VARCHAR(255)  NOT NULL,
    role       ENUM('student','teacher','admin') NOT NULL DEFAULT 'student',
    approved   TINYINT(1)    NOT NULL DEFAULT 0,
    created_at TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- QUIZZES 

CREATE TABLE quizzes (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    title       VARCHAR(200) NOT NULL,
    description TEXT,
    time_limit  INT          NOT NULL DEFAULT 10,
    teacher_id  INT          NULL,
    created_at  TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_quizzes_teacher
        FOREIGN KEY (teacher_id) REFERENCES users(id) ON DELETE SET NULL
);

CREATE INDEX idx_quizzes_teacher_id ON quizzes (teacher_id);

-- QUESTIONS 

CREATE TABLE questions (
    id             INT AUTO_INCREMENT PRIMARY KEY,
    quiz_id        INT          NOT NULL,
    question       TEXT         NOT NULL,
    option_a       VARCHAR(500) NOT NULL DEFAULT '',
    option_b       VARCHAR(500) NOT NULL DEFAULT '',
    option_c       VARCHAR(500) NOT NULL DEFAULT '',
    option_d       VARCHAR(500) NOT NULL DEFAULT '',
    correct_answer VARCHAR(500) NOT NULL DEFAULT '',
    CONSTRAINT fk_questions_quiz
        FOREIGN KEY (quiz_id) REFERENCES quizzes(id) ON DELETE CASCADE
);

-- RESULTS 
CREATE TABLE results (
    id           INT AUTO_INCREMENT PRIMARY KEY,
    quiz_id      INT          NULL,
    student_id   INT          NULL,
    student_name VARCHAR(100) NOT NULL DEFAULT 'Anonymous',
    quiz_title   VARCHAR(200) NOT NULL,
    score        FLOAT        NOT NULL DEFAULT 0,
    submitted_at TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_results_quiz
        FOREIGN KEY (quiz_id) REFERENCES quizzes(id) ON DELETE SET NULL,
    CONSTRAINT fk_results_student
        FOREIGN KEY (student_id) REFERENCES users(id) ON DELETE SET NULL
);

--  SETTINGS 
CREATE TABLE settings (
    id                      INT AUTO_INCREMENT PRIMARY KEY,
    time_limit              INT        NOT NULL DEFAULT 10,
    max_attempts            INT        NOT NULL DEFAULT 1,
    passing_score           INT        NOT NULL DEFAULT 60,
    randomize_questions     TINYINT(1) NOT NULL DEFAULT 0,
    show_result_immediately TINYINT(1) NOT NULL DEFAULT 1
);

INSERT INTO settings (time_limit, max_attempts, passing_score, randomize_questions, show_result_immediately)
VALUES (10, 1, 60, 0, 1);

