/* alter table patient_details drop column lname;
alter table patient_details drop column image;

alter table patient_details add column phone varchar(255);
alter table patient_details add column ephone varchar(255);
alter table patient_details add column relation varchar(255);
alter table patient_details add column gender varchar(255);
alter table patient_details add column dp varchar(255);
alter table patient_details add column dob date; */


/* DELIMITER $$
$$
CREATE TRIGGER age_calculator
BEFORE
ON patient_details FOR EACH ROW
BEGIN 
	DECLARE birth_date DATE;
    DECLARE age INT;

    -- Get the inserted DOB
    SET birth_date = NEW.dob;

    -- Calculate the age
    SET age = TIMESTAMPDIFF(YEAR, dob, CURDATE());

    -- Update the age column in the table
    UPDATE patient_details SET age = age WHERE id = NEW.id;
END$$
DELIMITER ; */

CREATE TABLE abhi.doctor_reports (
	id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
	patient_id BIGINT UNSIGNED NULL,
	diseases LONGTEXT NULL,
	rbc_count varchar(255) NULL,
	wbc_count varchar(255) NULL,
	allergies LONGTEXT NULL,
	advised_tests LONGTEXT NULL,
	test_status varchar(100) NULL,
	blood_group varchar(100) NULL,
	symptoms LONGTEXT NULL,
	prescriptions LONGTEXT NULL,
	diagnosis LONGTEXT NULL,
	prescribed_medicines varchar(255) NULL,
    created_at TIMESTAMP default CURRENT_TIMESTAMP
);

CREATE TABLE abhi.appointments (
	id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
	patient_id BIGINT UNSIGNED NULL,
	user_id BIGINT UNSIGNED NULL,
	status varchar(100),
    created_at TIMESTAMP default CURRENT_TIMESTAMP,
);

create table fresponder_reports ( 
	id bigint unsigned primary key auto_increment,
	patient_id bigint unsigned NULL, 
	location varchar(500) NULL;
	incident_cause varchar(500),
	description LONGTEXT NULL;
	image varchar(255),
	created_at TIMESTAMP default CURRENT_TIMESTAMP
);

