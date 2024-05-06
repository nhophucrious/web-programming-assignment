-- address
CREATE TABLE `address` (
  `address_id` INTEGER PRIMARY KEY AUTO_INCREMENT,
  `street_number` VARCHAR(25),
  `street_name` TEXT,
  `ward` TEXT,
  `district` TEXT,
  `province` TEXT
);

-- users
CREATE TABLE `users` (
  `user_id` INTEGER PRIMARY KEY AUTO_INCREMENT,
  `email_address` TEXT NOT NULL,
  `password` CHAR(60) NOT NULL,
  `first_name` TEXT NOT NULL,
  `last_name` TEXT NOT NULL,
  `title` VARCHAR(255),
  `phone_no` VARCHAR(15),
  `avatar` TEXT,
  `gender` BOOL,
  `dob` VARCHAR(10),
  `about_me` TEXT,
  `address_id` INTEGER,
  `skills` TEXT,
  FOREIGN KEY (`address_id`) REFERENCES `address` (`address_id`)
);

CREATE TABLE `employers` (
  `employer_id` INTEGER PRIMARY KEY AUTO_INCREMENT,
  `email_address` TEXT NOT NULL,
  `password` CHAR(60) NOT NULL,
  `employer_name` TEXT NOT NULL,
  `address_id` INTEGER,
  `status` BOOL NOT NULL,
  `phoneNo` VARCHAR(255) NOT NULL,
  `about_us` TEXT,
  FOREIGN KEY (`address_id`) REFERENCES `address` (`address_id`)
);

-- jobs
CREATE TABLE `jobs` (
  `job_id` INTEGER PRIMARY KEY AUTO_INCREMENT,
  `employer_id` INTEGER,
  `job_name` TEXT,
  `job_level` TEXT,
  `job_type` TEXT,
  `job_location` TEXT COMMENT 'on-site or remote',
  `salary` INTEGER,
  `job_description` TEXT,
  `date_posted` DATETIME,
  FOREIGN KEY (`employer_id`) REFERENCES `employers` (`employer_id`)
);

-- education
CREATE TABLE `education` (
  `education_id` INTEGER PRIMARY KEY AUTO_INCREMENT,
  `user_id` INTEGER,
  `degree_name` TEXT,
  `institution_name` TEXT,
  `start_year` VARCHAR(4),
  `end_year` VARCHAR(4),
  FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
);

-- certificate
CREATE TABLE `certificate` (
  `certificate_id` INTEGER PRIMARY KEY AUTO_INCREMENT,
  `user_id` INTEGER,
  `certificate_name` TEXT,
  `issuer` TEXT,
  `year_issued` VARCHAR(4),
  `link` TEXT,

  FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
);

-- exp
CREATE TABLE `exp` (
  `exp_id` INTEGER PRIMARY KEY AUTO_INCREMENT,
  `exp_name` TEXT,
  `year_start` VARCHAR(4),
  `year_end` VARCHAR(4),
  `exp_description` TEXT,
  `user_id` INTEGER,
  FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
);

-- job_requirements
CREATE TABLE `job_requirements` (
  `requirement_id` INTEGER PRIMARY KEY AUTO_INCREMENT,
  `requirement_name` TEXT,
  `job_id` INTEGER,
  FOREIGN KEY (`job_id`) REFERENCES `jobs` (`job_id`)
);

-- job_benefits
CREATE TABLE `job_benefits` (
  `benefit_id` INTEGER PRIMARY KEY AUTO_INCREMENT,
  `benefit_description` TEXT,
  `job_id` INTEGER,
  FOREIGN KEY (`job_id`) REFERENCES `jobs` (`job_id`)
);

-- job_applications
CREATE TABLE `job_applications` (
  `application_id` INTEGER PRIMARY KEY AUTO_INCREMENT,
  `user_id` INTEGER,
  `job_id` INTEGER,
  `date_applied` DATETIME,
  FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  FOREIGN KEY (`job_id`) REFERENCES `jobs` (`job_id`)
);
