CREATE DATABASE IF NOT EXISTS hiredcmut;

USE hiredcmut;

CREATE TABLE IF NOT EXISTS users (
    username VARCHAR(255) PRIMARY KEY,
    password VARCHAR(255) NOT NULL,
    is_employer INT NOT NULL,
    UID VARCHAR(255) UNIQUE NOT NULL
);

CREATE TABLE IF NOT EXISTS employers (
    employer_ID VARCHAR(255) PRIMARY KEY,
    address VARCHAR(255),
    description VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS seekers (
    seeker_ID VARCHAR(255) PRIMARY KEY,
    dob DATETIME,
    gender INT,
    cccd INT
);

CREATE TABLE IF NOT EXISTS contact (
    UID VARCHAR(255),
    name VARCHAR(255),
    address_ID VARCHAR(255),
    phone VARCHAR(255),
    email VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS address (
    address_ID VARCHAR(255),
    address VARCHAR(255),
    ward VARCHAR(255),
    district VARCHAR(255),
    city VARCHAR(255),
    state VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS jobs (
    job_ID VARCHAR(255) PRIMARY KEY,
    employer_ID VARCHAR(255),
    name VARCHAR(255),
    salary VARCHAR(255),
    benefits VARCHAR(255),
    description VARCHAR(255),
    pdf_exist INT,
    pdf_link VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS cvs (
    cv_ID VARCHAR(255),
    seeker_ID VARCHAR(255),
    experience INT,
    skills VARCHAR(255),
    languages VARCHAR(255),
    salary VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS degrees (
    degree_ID VARCHAR(255) PRIMARY KEY,
    seeker_ID VARCHAR(255),
    type INT,
    field VARCHAR(255),
    issued DATETIME,
    institution VARCHAR(255),
    pdf_exist INT,
    pdf_link VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS certificates (
    cert_ID VARCHAR(255) PRIMARY KEY,
    seeker_ID VARCHAR(255),
    name VARCHAR(255),
    issued DATETIME,
    pdf_exist INT,
    pdf_link VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS cv_deg (
    cv_ID VARCHAR(255),
    degree_ID VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS cv_cert (
    cv_ID VARCHAR(255),
    cert_ID VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS tags (
    tag_ID VARCHAR(255) PRIMARY KEY,
    name VARCHAR(255),
    description VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS jobs_tag (
    job_ID VARCHAR(255),
    tag_ID VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS applying (
    seeker_ID VARCHAR(255),
    job_ID VARCHAR(255)
);

ALTER TABLE employers ADD FOREIGN KEY (employer_ID) REFERENCES users(UID);
ALTER TABLE seekers ADD FOREIGN KEY (seeker_ID) REFERENCES users(UID);
ALTER TABLE contact ADD FOREIGN KEY (UID) REFERENCES users(UID);
ALTER TABLE jobs ADD FOREIGN KEY (employer_ID) REFERENCES employers(employer_ID);
ALTER TABLE address ADD FOREIGN KEY (address_ID) REFERENCES contact(address_ID);
ALTER TABLE cvs ADD FOREIGN KEY (seeker_ID) REFERENCES seekers(seeker_ID);
ALTER TABLE degrees ADD FOREIGN KEY (seeker_ID) REFERENCES seekers(seeker_ID);
ALTER TABLE certificates ADD FOREIGN KEY (seeker_ID) REFERENCES seekers(seeker_ID);
ALTER TABLE cv_deg ADD FOREIGN KEY (cv_ID) REFERENCES cvs(cv_ID);
ALTER TABLE cv_deg ADD FOREIGN KEY (degree_ID) REFERENCES degrees(degree_ID);
ALTER TABLE cv_cert ADD FOREIGN KEY (cv_ID) REFERENCES cvs(cv_ID);
ALTER TABLE cv_cert ADD FOREIGN KEY (cert_ID) REFERENCES certificates(cert_ID);
ALTER TABLE jobs_tag ADD FOREIGN KEY (job_ID) REFERENCES jobs(job_ID);
ALTER TABLE jobs_tag ADD FOREIGN KEY (tag_ID) REFERENCES tags(tag_ID);
ALTER TABLE applying ADD FOREIGN KEY (seeker_ID) REFERENCES seekers(seeker_ID);
ALTER TABLE applying ADD FOREIGN KEY (job_ID) REFERENCES jobs(job_ID);