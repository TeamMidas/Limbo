-- Assignment 2
-- Authors: Stanley Yang, Antony Liang
-- Version 1

-- this line exists for ease of testing
DROP DATABASE IF EXISTS limbo_db;

CREATE DATABASE IF NOT EXISTS limbo_db;
USE limbo_db;

CREATE TABLE IF NOT EXISTS users(
	user_id INT UNSIGNED AUTO_INCREMENT,
	first_name VARCHAR(20) NOT NULL,
	last_name VARCHAR(20) NOT NULL,
	email VARCHAR(60) NOT NULL UNIQUE,
	pass CHAR(40) NOT NULL,
	reg_date DATETIME NOT NULL,
	PRIMARY KEY (user_id)
);

CREATE TABLE IF NOT EXISTS locations(
	id INT AUTO_INCREMENT,
	create_date DATETIME NOT NULL,
	update_date DATETIME NOT NULL,
	name TEXT NOT NULL,
	PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS stuff(
	id INT AUTO_INCREMENT,
	location_id INT,
	description TEXT NOT NULL,
	create_date DATETIME NOT NULL,
	update_date DATETIME NOT NULL,
	room TEXT,
	owner TEXT,
	finder TEXT,
	status SET('found', 'lost', 'claimed') NOT NULL, -- Did you mean a check constraint here instead of SET?
	PRIMARY KEY(id),
	FOREIGN KEY(location_id)
		REFERENCES locations(id)
);

INSERT INTO users(first_name, last_name, email, pass, reg_date)
VALUES ('admin', 'admin', 'admin@admin.com', 'gaze11e', Now());

INSERT INTO locations(create_date, update_date, name)
VALUES
(Now(), Now(), 'Hancock'),
(Now(), Now(), 'Dyson'),
(Now(), Now(), 'Lowell Thomas'),
(Now(), Now(), 'Fontaine'),
(Now(), Now(), 'Fontaine Annex'),
(Now(), Now(), 'Donnelly'),
(Now(), Now(), 'Rotunda'),
(Now(), Now(), 'Boat House'),
(Now(), Now(), 'McCann Gym');

SELECT * FROM users;
SELECT * FROM locations;
SELECT * FROM stuff;