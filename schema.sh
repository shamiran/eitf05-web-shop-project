#!bash

mysql -u webadmin --password=adminadmin -e "
  USE webshop;
  drop table users;
  drop table blacklist;
	drop table products;
  CREATE TABLE users (username VARCHAR(20) CHARACTER SET utf8,
                      password VARCHAR(200),
                      salt VARCHAR(50));
  CREATE TABLE blacklist (password VARCHAR(200));
	CREATE TABLE products (id int AUTO_INCREMENT NOT NULL,
			name varchar(50));"
