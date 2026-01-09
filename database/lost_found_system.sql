-- Create database
CREATE DATABASE IF NOT EXISTS lost_found_system;
USE lost_found_system;

-- =========================
-- Lost Items Table
-- =========================
CREATE TABLE lost_items (
    lost_id INT AUTO_INCREMENT PRIMARY KEY,
    item_type VARCHAR(100) NOT NULL,
    description TEXT,
    lost_location VARCHAR(255),
    lost_date DATE,
    status ENUM('open','closed') DEFAULT 'open',
    reported_by VARCHAR(150)
);

-- =========================
-- Found Items Table
-- =========================
CREATE TABLE found_items (
    found_id INT AUTO_INCREMENT PRIMARY KEY,
    item_type VARCHAR(100) NOT NULL,
    description TEXT,
    found_location VARCHAR(255),
    found_date DATE,
    status ENUM('unclaimed','returned') DEFAULT 'unclaimed'
);

-- =========================
-- Claims Table
-- =========================
CREATE TABLE claims (
    claim_id INT AUTO_INCREMENT PRIMARY KEY,
    lost_id INT,
    found_id INT,
    claimant_name VARCHAR(150),
    verification_notes TEXT,
    claimed_by VARCHAR(150),
    status ENUM('pending','approved','rejected') DEFAULT 'pending',

    FOREIGN KEY (lost_id) REFERENCES lost_items(lost_id),
    FOREIGN KEY (found_id) REFERENCES found_items(found_id)
);

-- =========================
-- Claim Logs Table
-- =========================
CREATE TABLE claim_logs (
    log_id INT AUTO_INCREMENT PRIMARY KEY,
    claim_id INT,
    action VARCHAR(255),
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (claim_id) REFERENCES claims(claim_id)
);
