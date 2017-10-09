#!/bin/bash

mysql -u webadmin --password=adminadmin -e "
  USE webshop;
  drop table IF EXISTS users;
  drop table IF EXISTS blacklist;
  drop table IF EXISTS products;
  drop table IF EXISTS comments;

  CREATE TABLE users (username VARCHAR(100) CHARACTER SET utf8,
                      address VARCHAR(200),
                      password VARCHAR(200),
                      salt VARCHAR(50),
			lastLoginAttempt TIMESTAMP,
			loginAttemptCount INT
			);
  CREATE TABLE blacklist (password VARCHAR(200));
	CREATE TABLE products (id int AUTO_INCREMENT NOT NULL,
			                   name VARCHAR(50),
                         price INT,
                         image VARCHAR(200),
                         PRIMARY KEY (id));

  CREATE TABLE comments (name VARCHAR(30) CHARACTER SET utf8, comment TEXT CHARACTER SET utf8, score INT, timestamp TIMESTAMP);

  INSERT INTO blacklist (password)
    VALUES
    ('Abcd1234'),
    ('Hello123'),
    ('Cat12345'),
    ('ABCD123');

    INSERT INTO products (id,name,price,image)
      VALUES
      (1, 'Iphone X', 1000,'http://drop.ndtv.com/TECH/product_database/images/913201720152AM_635_iphone_x.jpeg' ),
      (2, 'Samsung Galaxy S8', 800, 'http://drop.ndtv.com/TECH/product_database/images/329201783846PM_635_samsung_galaxy_s8.jpeg'),
      (3, 'Sony Xperia XZ', 800, 'http://cdn2.gsmarena.com/vv/pics/sony/sony-xperia-xz-premium-2017-0.jpg'),
      (4, 'Motorola Moto Z2', 700, 'http://cdn2.gsmarena.com/vv/pics/motorola/motorola-moto-z2-play-0.jpg') ;
    "
