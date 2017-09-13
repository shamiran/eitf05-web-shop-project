#!bash

mysql -u webadmin --password=adminadmin -e "USE webshop;
drop table users;
CREATE TABLE users (name VARCHAR(20) CHARACTER SET utf8,
                    password VARCHAR(200), salt VARCHAR(50), blacklist VARCHAR(50));
                    "
