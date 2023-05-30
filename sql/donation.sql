CREATE TABLE
    `blood_stock` (
        `stock_id` varchar(100) PRIMARY KEY,
        `blood_group` varchar(3) NOT NULL,
        `quantity` int(11) NOT NULL,
        `last_updated` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );