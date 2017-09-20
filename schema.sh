#!/bin/bash

mysql -u webadmin --password=adminadmin -e "
  USE webshop;
  drop table IF EXISTS users;
  drop table IF EXISTS blacklist;
  drop table IF EXISTS products;

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
                         price VARCHAR(10),
                         image VARCHAR(200),
                         PRIMARY KEY (id));

  INSERT INTO blacklist (password)
    VALUES
    ('Abcd1234'),
    ('12345678'),
    ('11111111'),
    ('11223344'),
    ('123456789'),
    ('987654321');

    INSERT INTO products (id,name,price,image)
      VALUES
      (1, 'Iphone X', '1000.00','http://drop.ndtv.com/TECH/product_database/images/913201720152AM_635_iphone_x.jpeg' ),
      (2, 'Samsung Galaxy S8', '800.00', 'http://drop.ndtv.com/TECH/product_database/images/329201783846PM_635_samsung_galaxy_s8.jpeg'),
      (3, 'Sony Xperia XZ', '800.00', 'http://cdn2.gsmarena.com/vv/pics/sony/sony-xperia-xz-premium-2017-0.jpg'),
      (4, 'Motorola Moto Z2', '700.00', 'http://cdn2.gsmarena.com/vv/pics/motorola/motorola-moto-z2-play-0.jpg') ;
    "
