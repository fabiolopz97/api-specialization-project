CREATE DATABASE IF NOT EXISTS api_beauty_center;
USE api_beauty_center;

CREATE TABLE roles(
id              int(255) auto_increment not null,
name            varchar(50) NOT NULL,
created_at      datetime DEFAULT NULL,
updated_at      datetime DEFAULT NULL,
CONSTRAINT pk_roles PRIMARY KEY (id)
)ENGINE=InnoDb;

CREATE TABLE employees(
id              int(255) auto_increment NOT NULL,
identification  varchar(10) NOT NULL, 
name            varchar(50) NOT NULL,
surname         varchar(100),
phone           int(10),
address         varchar(255),
email           varchar(255) NOT NULL,
created_at      datetime DEFAULT NULL,
updated_at      datetime DEFAULT NULL,
CONSTRAINT pk_employees PRIMARY KEY (id)
)ENGINE=InnoDb;

CREATE TABLE customers(
id              int(255) auto_increment  NOT NULL,
name            varchar(50) NOT NULL,
surname         varchar(100),
phone           int(10),
email           varchar(255),
password        varchar(255) NOT NULL,
created_at      datetime DEFAULT NULL,
updated_at      datetime DEFAULT NULL,
CONSTRAINT pk_customers  PRIMARY KEY (id)
)ENGINE=InnoDb;

CREATE TABLE services(
id              int(255) auto_increment NOT NULL, 
name            varchar(50) NOT NULL,
duration        datetime DEFAULT NULL,
created_at      datetime DEFAULT NULL,
updated_at      datetime DEFAULT NULL,
CONSTRAINT pk_services PRIMARY KEY (id)
)ENGINE=InnoDb;

CREATE TABLE roles_employees(
id              int(255) auto_increment NOT NULL,
role_id         int(255) NOT NULL,
employee_id     int(255) NOT NULL,
created_at      datetime DEFAULT NULL,
updated_at      datetime DEFAULT NULL,
CONSTRAINT pk_roles_employees PRIMARY KEY (id),
CONSTRAINT fk_role_employee_employee FOREIGN KEY(employee_id) REFERENCES employees(id),
CONSTRAINT fk_role_employee_role FOREIGN KEY(role_id) REFERENCES roles(id)
)ENGINE=InnoDb;

CREATE TABLE employees_services(
id              int(255) auto_increment NOT NULL, 
employee_id     int(255) NOT NULL,
service_id      int(255) NOT NULL,
created_at      datetime DEFAULT NULL,
updated_at      datetime DEFAULT NULL,
CONSTRAINT pk_employees_services PRIMARY KEY (id),
CONSTRAINT fk_employee_service_employee FOREIGN KEY(employee_id) REFERENCES employees(id),
CONSTRAINT fk_employee_service_service FOREIGN KEY(service_id) REFERENCES services(id)
)ENGINE=InnoDb;

CREATE TABLE appointments(
id              int(255) auto_increment NOT NULL,
customer_id     int(255) NOT NULL,
service_id      int(255) NOT NULL,
start_time      datetime DEFAULT NULL,
end_time        datetime DEFAULT NULL,
created_at      datetime DEFAULT NULL,
updated_at      datetime DEFAULT NULL,
CONSTRAINT pk_appointments PRIMARY KEY(id),
CONSTRAINT fk_appointment_customer FOREIGN KEY(customer_id) REFERENCES customers(id),
CONSTRAINT fk_appointment_service FOREIGN KEY(service_id) REFERENCES services(id)
)ENGINE=InnoDb;

CREATE TABLE posts(
id              int(255) auto_increment NOT NULL,
employee_id     int(255) NOT NULL,
title           varchar(255) NOT NULL,
content         text,
image           varchar(255),
created_at      datetime DEFAULT NULL,
updated_at      datetime DEFAULT NULL,
CONSTRAINT pk_posts PRIMARY KEY(id),
CONSTRAINT fk_post_employee FOREIGN KEY(employee_id) REFERENCES employees(id)
)ENGINE=InnoDb;