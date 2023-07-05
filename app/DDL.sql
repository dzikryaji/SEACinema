CREATE TABLE `sea_cinema`.`account` (
    `id` INT NOT NULL AUTO_INCREMENT , 
    `name` VARCHAR(128) NOT NULL , 
    `username` VARCHAR(128) NOT NULL , 
    `age` INT NOT NULL , 
    `balance` INT NOT NULL,
    `password_hash` VARCHAR(255) NOT NULL , 
        PRIMARY KEY (`id`), 
        UNIQUE (`username`)
) ENGINE = InnoDB;

CREATE TABLE `sea_cinema`.`seats` (
    `id_movie` INT NOT NULL , 
    `seats` VARCHAR(64) NOT NULL 
) ENGINE = InnoDB;

CREATE TABLE `sea_cinema`.`ticket` (
    `id_account` INT NOT NULL , 
    `id_movie` INT NOT NULL , 
    `seats` VARCHAR(64) NOT NULL ,
        FOREIGN KEY (`id_account`) REFERENCES `account`(`id`)
) ENGINE = InnoDB;