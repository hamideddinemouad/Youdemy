-- Create Database
USE Youdemy;

-- Users Table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Courses Table
CREATE TABLE courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    content TEXT,
    category_id INT NOT NULL,
    teacher_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (teacher_id) REFERENCES users(id),
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

-- Categories Table
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) UNIQUE NOT NULL
);

-- Tags Table
CREATE TABLE tags (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) UNIQUE NOT NULL
);

-- Course_Tags Table (Many-to-Many Relationship)
CREATE TABLE course_tags (
    course_id INT NOT NULL,
    tag_id INT NOT NULL,
    PRIMARY KEY (course_id, tag_id),
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE,
    FOREIGN KEY (tag_id) REFERENCES tags(id) ON DELETE CASCADE
);

-- Student_Courses Table (Many-to-Many Relationship)
CREATE TABLE student_courses (
    student_id INT NOT NULL,
    course_id INT NOT NULL,
    enrolled_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (student_id, course_id),
    FOREIGN KEY (student_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE
);

-- Statistics Table
CREATE TABLE statistics (
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_id INT NOT NULL,
    total_students INT DEFAULT 0,
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE
);

-- Admin Validations Table
CREATE TABLE admin_validations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    teacher_id INT NOT NULL,
    validated_by INT NOT NULL,
    validated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (teacher_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (validated_by) REFERENCES users(id) ON DELETE CASCADE
);

-- Insert Categories
INSERT INTO categories (name) VALUES
('Programming'),
('Design'),
('Marketing'),
('Business'),
('Data Science');

-- Insert Users (Teachers and Admins)
INSERT INTO users (username, email, password, role) VALUES
('john_doe', 'john.doe@example.com', 'password123', 'teacher'),
('jane_smith', 'jane.smith@example.com', 'password456', 'teacher'),
('admin_user', 'admin@example.com', 'adminpassword', 'admin');

-- Insert Tags
INSERT INTO tags (name) VALUES
('JavaScript'),
('HTML'),
('CSS'),
('PHP'),
('React'),
('UX Design'),
('SEO'),
('Machine Learning');

-- Insert Courses
INSERT INTO courses (title, description, content, category_id, teacher_id) VALUES
('Learn JavaScript', 'Comprehensive JavaScript course for beginners.', 'JavaScript Content', 1, 1),
('UX Design for Beginners', 'Introduction to UX Design principles.', 'Design Content', 2, 2),
('Marketing Strategies', 'Effective marketing strategies for modern businesses.', 'Marketing Content', 3, 2),
('Data Science Fundamentals', 'Introduction to data analysis and machine learning.', 'Data Science Content', 5, 1);

-- Insert Course_Tags (Many-to-Many relationship between courses and tags)
INSERT INTO course_tags (course_id, tag_id) VALUES
(1, 1),  -- JavaScript
(1, 2),  -- HTML
(2, 6),  -- UX Design
(3, 7),  -- SEO
(4, 8);  -- Machine Learning

-- Insert Student_Courses (Many-to-Many relationship between students and courses)
INSERT INTO student_courses (student_id, course_id) VALUES
(1, 1),  -- Student 1 enrolled in Learn JavaScript
(2, 2),  -- Student 2 enrolled in UX Design for Beginners
(1, 3),  -- Student 1 enrolled in Marketing Strategies
(3, 4);  -- Student 3 enrolled in Data Science Fundamentals

-- Insert Statistics (Course statistics for total students)
INSERT INTO statistics (course_id, total_students) VALUES
(1, 50),  -- 50 students in Learn JavaScript
(2, 30),  -- 30 students in UX Design for Beginners
(3, 20),  -- 20 students in Marketing Strategies
(4, 15);  -- 15 students in Data Science Fundamentals

-- Insert Admin Validations (Admin validating teachers)
INSERT INTO admin_validations (teacher_id, validated_by) VALUES
(1, 3),  -- Teacher 1 validated by Admin
(2, 3);  -- Teacher 2 validated by Admin
