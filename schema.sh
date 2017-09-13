#!bash

mysql -u webadmin --password=adminadmin -e "
  USE webshop;
  CREATE TABLE users (username VARCHAR(20) CHARACTER SET utf8,
                      password VARCHAR(200),
                      salt VARCHAR(50));
  CREATE TABLE blacklist (password VARCHAR(200));"
