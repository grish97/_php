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

CREATE TABLE products (
  id int(11) AUTO_INCREMENT PRIMARY KEY,
  name varchar(60) NOT NULL,
  description TEXT  NOT NULL,
  price int(11) NOT NULL,
  image_name varchar(100) NOT NULL,
  updated_at datetime,
  created_at timestamp
);

CREATE TABLE images (
  id int(11) AUTO_INCREMENT PRIMARY KEY,
  name varchar(60) NOT NULL,
  is_avatar int(11)
  product_id int(11),
  updated_at datetime,
  created_at timestamp,
  FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE ON UPDATE CASCADE
  FOREIGN KEY (is_avatar) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE notice (
  id int(11) AUTO_INCREMENT PRIMARY KEY,
  userId int(11),
  status int(11),
  message varchar(256),
  created_at timestamp
)