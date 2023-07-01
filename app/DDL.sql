CREATE TABLE `sea_cinema`.`account` (
    `id` INT NOT NULL AUTO_INCREMENT , 
    `name` VARCHAR(128) NOT NULL , 
    `username` VARCHAR(128) NOT NULL , 
    `age` INT NOT NULL , 
    `password_hash` VARCHAR(255) NOT NULL , 
        PRIMARY KEY (`id`), 
        UNIQUE (`username`)
) ENGINE = InnoDB;