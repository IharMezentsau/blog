DROP SCHEMA IF EXISTS blog_user;
CREATE SCHEMA blog_user;

DROP TABLE IF EXISTS blog_user.t_user;
CREATE TABLE blog_user.t_user(
	`id` INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT UNIQUE,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL UNIQUE,
    `name` VARCHAR(255),
    `date` DATETIME,
    `validstring` VARCHAR(255) NOT NULL,
    `validreg` BOOLEAN
    
);

DROP TABLE IF EXISTS blog_user.t_message;
CREATE TABLE blog_user.t_message (
	`id` INTEGER NOT NULL PRIMARY KEY UNIQUE AUTO_INCREMENT,
    `date` DATETIME NOT NULL,
    `user_id` INTEGER NOT NULL,
    `message` TEXT NOT NULL,
    
    FOREIGN KEY (user_id) REFERENCES blog_user.t_user(id) ON UPDATE CASCADE ON DELETE CASCADE
    
);

DROP TABLE IF EXISTS blog_user.t_answer_message;
CREATE TABLE blog_user.t_answer_message (
	`id` INTEGER NOT NULL PRIMARY KEY UNIQUE AUTO_INCREMENT,
    `date` DATETIME NOT NULL,
    `user_id` INTEGER NOT NULL,
    `message_id` INTEGER NOT NULL,
    `answer` TEXT NOT NULL,
    
    FOREIGN KEY (user_id) REFERENCES blog_user.t_user(id) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (message_id) REFERENCES blog_user.t_message(id) ON UPDATE CASCADE ON DELETE CASCADE
    
);

SELECT * FROM blog_user.t_user;
UPDATE blog_user.t_user SET validreg = 1 WHERE id = TRUE;
SELECT * FROM blog_user.t_user;