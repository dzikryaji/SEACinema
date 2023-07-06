CREATE TABLE `account` (
    `id` INT NOT NULL AUTO_INCREMENT , 
    `name` VARCHAR(128) NOT NULL , 
    `username` VARCHAR(128) NOT NULL , 
    `age` INT NOT NULL , 
    `balance` INT NOT NULL,
    `password_hash` VARCHAR(255) NOT NULL , 
        PRIMARY KEY (`id`), 
        UNIQUE (`username`)
) ENGINE = InnoDB;

CREATE TABLE `seats` (
    `id_seats` INT NOT NULL AUTO_INCREMENT,
    `id_movie` INT NOT NULL , 
    `date` DATE NOT NULL , 
    `showtime` TIME NOT NULL , 
    `seats` VARCHAR(64) NOT NULL,
     PRIMARY KEY (`id_seats`)
) ENGINE = InnoDB;

CREATE TABLE `ticket` (
    `id_account` INT NOT NULL , 
    `id_movie` INT NOT NULL , 
    `id_seats` INT NOT NULL , 
    `seats` VARCHAR(64) NOT NULL ,
        FOREIGN KEY (`id_account`) REFERENCES `account`(`id`),
        FOREIGN KEY (`id_seats`) REFERENCES `seats`(`id_seats`)
) ENGINE = InnoDB;