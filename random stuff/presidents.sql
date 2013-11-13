# Presidents of the United States
# Authors: Stanley Yang, Antony Liang

CREATE DATABASE IF NOT EXISTS site_db;
USE site_db;

DROP TABLE IF EXISTS presidents;

CREATE TABLE presidents(
	id INT AUTO_INCREMENT,
	fname TEXT NOT NULL,
	lname TEXT NOT NULL,
	number INT NOT NULL,
	dob DATETIME NOT NULL,
	PRIMARY KEY(id)
);

INSERT INTO presidents(fname, lname, number, dob) 
VALUES
('George', 'Washington', 1, '1735-02-22 00:00:00'),
('Abraham', 'Lincoln', 16, '1809-02-12 00:00:00'),
('Thomas', 'Jefferson', 3, '1743-04-13 00:00:00'),
('Franklin', 'Roosevelt', 32, '1882-01-30 00:00:00'),
('Ulysses', 'Grant', 18, '1822-04-27 00:00:00');

EXPLAIN presidents;
SELECT * FROM presidents;
SELECT lname, number, dob FROM presidents ORDER BY number;
SELECT lname, number, dob FROM presidents ORDER BY lname;
SELECT lname, number, dob FROM presidents ORDER BY dob DESC;
