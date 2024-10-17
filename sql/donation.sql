CREATE TABLE
    `blood_donation` (
        `donation_id` varchar(100) NOT NULL,
        `userID` int(11) NOT NULL,
        `donation_date` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        `last_donated_date` date NOT NULL,
        `blood_group` varchar(3) NOT NULL,
        `quantity` int(11) NOT NULL,
        `location` varchar(255) NOT NULL,
        `donor_name` varchar(255) NOT NULL,
        `contact_no` varchar(20) NOT NULL,
        `email` varchar(255),
        `age` int(11) NOT NULL,
        `medical_history` TEXT  NULL,
        `request_status` varchar(20) NOT NULL DEFAULT 'Pending',
        FOREIGN KEY (`userID`) REFERENCES users(`userID`),
        PRIMARY KEY(`donation_id`, `userID`)
    );