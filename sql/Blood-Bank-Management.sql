--
-- Database: `user-registration`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(255) NOT NULL,
  `create_at` timestamp  DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE donors (
    `donor_id` INT PRIMARY KEY,
    `donor_name` VARCHAR(255) NOT NULL,
    `blood_group` VARCHAR(3) NOT NULL,
    `last_donated_date` DATE NOT NULL,
    `contact_no` VARCHAR(20) NOT NULL,
    `email` VARCHAR(255),
    `address` VARCHAR(255)
);

CREATE TABLE blood_stock (
    `stock_id` INT PRIMARY KEY,
    `blood_group` VARCHAR(3) NOT NULL,
    `quantity` INT NOT NULL,
    `expiry_date` DATE NOT NULL,
    `location` VARCHAR(255) NOT NULL
);

CREATE TABLE blood_requests (
    `request_id` INT PRIMARY KEY,
    `hospital_name` VARCHAR(255) NOT NULL,
    `blood_group` VARCHAR(3) NOT NULL,
    `quantity` INT NOT NULL,
    `request_date` DATE NOT NULL,
    `request_status` VARCHAR(20) NOT NULL DEFAULT 'Pending',
    `location` VARCHAR(255) NOT NULL
);

CREATE TABLE blood_donation (
    `donation_id` INT PRIMARY KEY ,
    `donor_id` INT NOT NULL,
    `donation_date`  timestamp  DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `blood_group` VARCHAR(3) NOT NULL,
    `quantity` INT NOT NULL,
    `location` VARCHAR(255) NOT NULL,
    FOREIGN KEY (donor_id) REFERENCES donors(donor_id)
);

-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
