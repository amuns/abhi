create table users(
    id bigint(20) unsigned NOT NULL auto_increment Primary KEY,
    name varchar(255) NOT NULL,
    email varchar(255) NOT NULL UNIQUE,
    password varchar(255) NOT NULL,
    role varchar(255) DEFAULT "PATIENT"
);

create table patient_details(
    id bigint(20) unsigned NOT NULL auto_increment Primary KEY,
    description longtext,
    created_at timestamp DEFAULT current_timestamp,
    updated_at timestamp
);

create table injuries(
    id bigint(20) unsigned NOT NULL auto_increment Primary KEY,
    title varchar(255),
    created_at timestamp DEFAULT current_timestamp,
    updated_at timestamp
);

create table patient_injuries(
    id bigint(20) unsigned NOT NULL auto_increment,
    description varchar(255),
    patient_id bigint(20) unsigned NOT NULL,
    injury_id bigint(20) unsigned NOT NULL,
    created_at timestamp DEFAULT current_timestamp,
    updated_at timestamp
);