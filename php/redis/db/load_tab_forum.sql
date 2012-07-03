use demo;
load data local infile '/var/www/demo/php/redis/db/tab_forum.txt' into table tab_forum FIELDS TERMINATED BY ';' ENCLOSED BY '"';
