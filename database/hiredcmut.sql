-- address
CREATE TABLE `address` (
  `address_id` integer PRIMARY KEY AUTO_INCREMENT,
  `street_number` varchar(25),
  `street_name` text,
  `ward` text,
  `district` text,
  `province` text
);

-- certificate
CREATE TABLE `certificate` (
  `certificate_id` integer PRIMARY KEY AUTO_INCREMENT,
  `certificate_name` text,
  `issuer` text,
  `year_issued` varchar(4)
);

-- exp
CREATE TABLE `exp` (
  `exp_id` integer PRIMARY KEY AUTO_INCREMENT,
  `exp_name` text,
  `year_start` varchar(4),
  `year_end` varchar(4),
  `user_id` integer
);

-- institution
CREATE TABLE `institution` (
  `institution_id` integer PRIMARY KEY AUTO_INCREMENT,
  `institution_name` text
);

-- education
CREATE TABLE `education` (
  `education_id` integer PRIMARY KEY AUTO_INCREMENT,
  `user_id` integer,
  `institution_id` integer,
  `degree_name` text,
  `start_year` varchar(4),
  `end_year` varchar(4)
);

-- skills
CREATE TABLE `skills` (
  `skill_id` integer PRIMARY KEY AUTO_INCREMENT,
  `skill_name` text
);

-- job_seeker_skills
CREATE TABLE `job_seeker_skills` (
  `user_id` integer,
  `skill_id` integer,
  PRIMARY KEY (`user_id`, `skill_id`)
);

-- users
CREATE TABLE `users` (
  `user_id` integer PRIMARY KEY AUTO_INCREMENT,
  `email_address` text NOT NULL,
  `password` text NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `title` varchar(255),
  `phone_no` varchar(15),
  `avatar` text,
  `gender` bool,
  `dob` varchar(10),
  `about_me` text,
  `address_id` integer,
  `certificate_id` integer,
  FOREIGN KEY (`address_id`) REFERENCES `address` (`address_id`),
  FOREIGN KEY (`certificate_id`) REFERENCES `certificate` (`certificate_id`)
);

-- employers
CREATE TABLE `employers` (
  `employer_id` integer PRIMARY KEY AUTO_INCREMENT,
  `email_address` text NOT NULL,
  `password` text NOT NULL,
  `employer_name` text NOT NULL,
  `address_id` integer,
  `status` bool NOT NULL,
  FOREIGN KEY (`address_id`) REFERENCES `address` (`address_id`)
);

-- jobs
CREATE TABLE `jobs` (
  `job_id` integer PRIMARY KEY AUTO_INCREMENT,
  `employer_id` integer,
  `job_name` text,
  `job_level` text,
  `job_type` text,
  `job_location` text COMMENT 'on-site or remote',
  `salary` integer,
  `job_description` text,
  `date_posted` datetime,
  FOREIGN KEY (`employer_id`) REFERENCES `employers` (`employer_id`)
);

-- job_requirements
CREATE TABLE `job_requirements` (
  `requirement_id` integer PRIMARY KEY AUTO_INCREMENT,
  `requirement_name` text,
  `job_id` integer,
  FOREIGN KEY (`job_id`) REFERENCES `jobs` (`job_id`)
);

-- job_benefits
CREATE TABLE `job_benefits` (
  `benefit_id` integer PRIMARY KEY AUTO_INCREMENT,
  `benefit_description` text,
  `job_id` integer,
  FOREIGN KEY (`job_id`) REFERENCES `jobs` (`job_id`)
);

-- job_applications
CREATE TABLE `job_applications` (
  `application_id` integer PRIMARY KEY AUTO_INCREMENT,
  `user_id` integer,
  `job_id` integer,
  `date_applied` datetime,
  FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  FOREIGN KEY (`job_id`) REFERENCES `jobs` (`job_id`)
);
