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
  updated_at timestamp,
  created_at timestamp
);

CREATE TABLE images (
  id int(11) AUTO_INCREMENT PRIMARY KEY,
  name varchar(60) NOT NULL,
  is_avatar int(11),
  product_id int(11),
  created_at timestamp,
  FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (is_avatar) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE friendPivot (
  id_from int(11),
  id_to int(11),
  FOREIGN KEY (id_from) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (id_to) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
)

CREATE TABLE friends (
  user_1 int(11),
  user_2 int(11),
   FOREIGN KEY (user_1) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE,
   FOREIGN KEY (user_2) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
)

