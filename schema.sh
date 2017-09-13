#!bash

mysql -u webadmin --password=adminadmin
USE webshop;
CREATE TABLE users (name VARCHAR(20) CHARACTER SET utf8,
                    password VARCHAR(200), salt VARCHAR(50));





