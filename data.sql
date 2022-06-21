CREATE DATABASE Sprint;

USE Sprint;

CREATE TABLE Projects (
id INT AUTO_INCREMENT PRIMARY KEY,
Project_Name varchar(30) NOT NULL);

CREATE TABLE Employees (
id INT AUTO_INCREMENT PRIMARY KEY,
Name varchar(30) NOT NULL,
Project_id INT,
FOREIGN KEY (Project_id) REFERENCES Projects(id));

INSERT INTO projects (Project_name)
VALUES ("Java"), ("Python"), ("Go"), ("REACT"), ("Javascript"), ("PHP");

INSERT INTO employees (Name, Project_id)
VALUES ("Jonas", 1), ("Martynas", 2), ("Kazys", 3), ("Birutė", 2), ("Marytė", 4), ("Povilas", 5);

