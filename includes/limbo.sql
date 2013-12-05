-- Assignment 2
-- Authors: Stanley Yang, Antony Liang
-- Version 1

-- this line exists for ease of testing
--DROP DATABASE IF EXISTS limbo_db;

--CREATE DATABASE limbo_db;
--USE limbo_db;

CREATE TABLE IF NOT EXISTS users(
	user_id INT UNSIGNED AUTO_INCREMENT,
	first_name VARCHAR(20) NOT NULL,
	last_name VARCHAR(20) NOT NULL,
	email VARCHAR(60) NOT NULL UNIQUE,
	pass VARCHAR(60000) NOT NULL,
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
	name TEXT NOT NULL,
	description TEXT NOT NULL,
	create_date DATETIME NOT NULL,
	update_date TIMESTAMP NOT NULL,
	room TEXT,
	owner TEXT,
	email TEXT,
	phone TEXT,
	finder TEXT,
	status SET('found', 'lost', 'claimed') NOT NULL,
	PRIMARY KEY(id),
	FOREIGN KEY(location_id)
		REFERENCES locations(id)
);

CREATE TABLE IF NOT EXISTS messages(
	id INT AUTO_INCREMENT,
	name TEXT NOT NULL,
	create_date DATETIME NOT NULL,
	email TEXT NOT NULL,
	subject TEXT NOT NULL,
	item_id TEXT,
	message TEXT,
	PRIMARY KEY(id)
);

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

INSERT INTO stuff(location_id, name, description, create_date, room, finder, email, phone, status)
VALUES 
(15, 'iPhone', 'it is shiny', '2013-10-21', '2020', 'Richard', 'email@email.com', '2345678999', 'found'),
(19, 'Wallet', 'cash money', '2013-10-18', 'First Floor', 'Henry', 'email@email.com', '2345678999', 'found'),
(5, 'Ring', 'extra shiny', '2013-11-12', '207', 'Chris', 'email@email.com', '2345678999', 'found');

INSERT INTO stuff(location_id, name, description, create_date, room, owner, email, phone, status)
VALUES 
(21, 'Android', 'it is a robot', '2013-11-04', '037', 'Ricky', 'email@email.com', '2345678999', 'lost'),
(32, 'Purse', 'pretty money', '2013-10-18', 'Second Floor', 'Brian', 'email@email.com', '2345678999', 'lost'),
(6, 'Necklace', 'jingles', '2013-11-12', '207', 'Daniel', 'email@email.com', '2345678999', 'lost');

INSERT INTO users(first_name, last_name, email, pass, reg_date)
VALUES ('first', 'test', 'admin@admin.com', PASSWORD('gaze11e'), Now());

INSERT INTO messages(name, create_date, email, subject, item_id, message)
VALUES
('Mr.Test', Now(), 'test@test.com', 'testmessage', 'shoe', 'TEST MESSAGE');