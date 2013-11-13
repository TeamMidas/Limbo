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

(Now(), Now(), 'Byrne House'),
(Now(), Now(), 'Our Lady Seat of Wisdom Chapel'),
(Now(), Now(), 'Champagnat Hall'),
(Now(), Now(), 'Cornell Boathouse'),
(Now(), Now(), 'Donnelly Hall'),
(Now(), Now(), 'Margaret M. and Charles H. Dyson Center'),
(Now(), Now(), 'Fern Tor'),
(Now(), Now(), 'Fontaine Annex'),
(Now(), Now(), 'Fontaine Hall'),
(Now(), Now(), 'Foy Townhouses'),
(Now(), Now(), 'Fulton Street Townhouses'),
(Now(), Now(), 'New Fulton Townhouses'),
(Now(), Now(), 'Gartland Commons'),
(Now(), Now(), 'Greystone Hall'),
(Now(), Now(), 'Hancock Center'),
(Now(), Now(), 'Kieran Gatehouse'),
(Now(), Now(), 'Kirk House'),
(Now(), Now(), 'Leo Hall'),
(Now(), Now(), 'James A. Cannavino Library'),
(Now(), Now(), 'Longview Park'),
(Now(), Now(), 'Lowell Thomas Communications Center'),
(Now(), Now(), 'Lower Townhouses'),
(Now(), Now(), 'Marian Hall'),
(Now(), Now(), 'Marist Boathouse'),
(Now(), Now(), 'James J. McCann Recreational Center'),
(Now(), Now(), 'Midrise Hall'),
(Now(), Now(), 'New Townhouses'),
(Now(), Now(), 'St. Ann''s Hermitage'),
(Now(), Now(), 'St. Peter''s'),
(Now(), Now(), 'Sheahan Hall'),
(Now(), Now(), 'Steel Plant Art Studios'),
(Now(), Now(), 'Student Center / Rotunda'),
(Now(), Now(), 'Tenney Stadium'),
(Now(), Now(), 'Tennis Pavillion'),
(Now(), Now(), 'Lower West Cedar Townhouses'),
(Now(), Now(), 'Upper West Cedar Townhouses');

SELECT * FROM users;
SELECT * FROM locations;
SELECT * FROM stuff;