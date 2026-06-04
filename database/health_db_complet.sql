-- ==================================================
-- BASE DE DONNÉES COMPLÈTE : health_db
-- Colle tout ce code dans phpMyAdmin > SQL
-- ==================================================

CREATE DATABASE IF NOT EXISTS health_db;
USE health_db;

-- Table: users
CREATE TABLE IF NOT EXISTS users (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(100) NOT NULL,
    email      VARCHAR(100) NOT NULL UNIQUE,
    password   VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table: calculator_history (BMI)
CREATE TABLE IF NOT EXISTS calculator_history (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    user_id    INT NOT NULL,
    height     INT NOT NULL,
    weight     INT NOT NULL,
    age        INT NOT NULL,
    gender     VARCHAR(10) NOT NULL,
    activity   FLOAT NOT NULL,
    bmi        FLOAT NOT NULL,
    calories   INT NOT NULL,
    status     VARCHAR(50) NOT NULL,
    advice     TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Table: run_tracker
CREATE TABLE IF NOT EXISTS run_tracker (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    user_id    INT NOT NULL,
    date       DATE NOT NULL,
    distance   FLOAT NOT NULL,
    time       FLOAT NOT NULL,
    pace       FLOAT NOT NULL,
    company    VARCHAR(50),
    notes      TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Table: sleep_tracker
CREATE TABLE IF NOT EXISTS sleep_tracker (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    user_id    INT NOT NULL,
    date       DATE NOT NULL,
    hours      FLOAT NOT NULL,
    quality    VARCHAR(20) NOT NULL,
    notes      TEXT,
    advice     VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Table: nutrition_tracker
CREATE TABLE IF NOT EXISTS nutrition_tracker (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    user_id    INT NOT NULL,
    meal_name  VARCHAR(100) NOT NULL,
    calories   INT NOT NULL,
    water      FLOAT NOT NULL,
    notes      TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Table: contact_messages
CREATE TABLE IF NOT EXISTS contact_messages (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(100) NOT NULL,
    email      VARCHAR(100) NOT NULL,
    message    TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
