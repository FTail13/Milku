-- Users Table
CREATE TABLE users (
	id INT AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(50) NOT NULL UNIQUE,
	password VARCHAR(255) NOT NULL,
	role ENUM('admin', 'user') DEFAULT 'user',
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Nurses Table
CREATE TABLE nurses (
	id INT AUTO_INCREMENT PRIMARY KEY,
	firstName VARCHAR(50) NOT NULL,
	lastName VARCHAR(50) NOT NULL,
	yearsOfExperience INT NOT NULL,
	specialization VARCHAR(100) NOT NULL,
	licenseNumber VARCHAR(50) NOT NULL,
	preferredShift ENUM('Morning', 'Evening', 'Night') NOT NULL,
	created_by INT NOT NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	FOREIGN KEY (created_by) REFERENCES users(id)
);

-- Activity Logs Table
CREATE TABLE activity_logs (
	id INT AUTO_INCREMENT PRIMARY KEY,
	user_id INT NOT NULL,
	action VARCHAR(100) NOT NULL,
	details TEXT NOT NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (user_id) REFERENCES users(id)
);