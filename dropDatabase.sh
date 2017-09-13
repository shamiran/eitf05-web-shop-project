#!bash

mysql -u webadmin --password=adminadmin -e "
    USE webshop;
    DROP TABLE users;
    DROP TABLE blacklist;
"