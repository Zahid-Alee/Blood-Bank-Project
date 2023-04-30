CREATE TABLE `blood_requests` (
  `request_id` varchar(100) PRIMARY KEY,
  `hospital_name` varchar(255) NOT NULL,
  `blood_group` varchar(3) NOT NULL,
  `quantity` int(11) NOT NULL,
  `request_date` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `request_status` varchar(20) NOT NULL DEFAULT 'Pending',
  `location` varchar(255) NOT NULL,
  `contact_no` varchar(20) NOT NULL
  
);