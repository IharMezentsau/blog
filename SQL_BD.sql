DROP SCHEMA IF EXISTS blog_user;
CREATE SCHEMA blog_user;

DROP TABLE IF EXISTS blog_user.t_user;
CREATE TABLE blog_user.t_user(
	`id` INTEGER NOT NULL AUTO_INCREMENT UNIQUE,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL UNIQUE,
    `name` VARCHAR(255),
    `date` DATETIME,
    `validstring` VARCHAR(255) NOT NULL,
    `validreg` BOOLEAN
    
);

SELECT * FROM blog_user.t_user;