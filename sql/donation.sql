CREATE TABLE
    Feedback (
        `FeedbackID` INT PRIMARY KEY AUTO_INCREMENT,
        `email` varchar(255) NOT NULL,
        `username` varchar(50) NULL,
        `phone` VARCHAR(15) NOT NULL,
        `FeedbackText` TEXT NOT NULL,
        `FeedbackDate` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
    );