alter table patient_details drop column lname;
alter table patient_details drop column image;

alter table patient_details add column phone varchar(255);
alter table patient_details add column ephone varchar(255);
alter table patient_details add column relation varchar(255);
alter table patient_details add column gender varchar(255);
alter table patient_details add column dp varchar(255);
alter table patient_details add column dob date;