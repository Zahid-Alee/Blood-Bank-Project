CREATE TABLE user_notifications (
    `notID` INT(11)  AUTO_INCREMENT,
    `donation_id` varchar(100) NOT NULL,
    `id` int(11) NOT NULL,
    `notDate` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `message` VARCHAR(150) NULL,
    `notFrom` VARCHAR(30) NULL,
    FOREIGN KEY (`donation_id`) REFERENCES blood_donation (`donation_id`),
    FOREIGN KEY (`id`) REFERENCES users(`id`),
    PRIMARY KEY(notID,donation_id,id)
);