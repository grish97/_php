CREATE TABLE users (
  id int(11) AUTO_INCREMENT PRIMARY KEY,
  name varchar(60) NOT NULL,
  last_name varchar(70) NOT NULL,
  email varchar(90) UNIQUE NOT NULL,
  password varchar(100) NOT NULL,
  email_verified_at datetime,
  verification_token varchar(250),
  created_at timestamp
);