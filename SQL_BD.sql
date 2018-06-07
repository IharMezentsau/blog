DROP SCHEMA IF EXISTS blog_user;
CREATE SCHEMA blog_user;

DROP TABLE IF EXISTS blog_user.t_user;
CREATE TABLE blog_user.t_user(
	`id` INTEGER NOT NULL AUTO_INCREMENT UNIQUE,
    `e_mail` VARCHAR(255) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL UNIQUE,
    `name` VARCHAR(255) 
    
);