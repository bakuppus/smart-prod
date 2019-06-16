#!/bin/bash

my_dir="$(dirname "$0")"
DB_USER="root"
DB_PASS="pass123"

## test mysql container connection by show MYSQL version 
echo "[1/3] --------> echo Mysql versions ";
docker exec -i platform_one_db_1 mysql -u$DB_USER -p$DB_PASS <<< "SHOW VARIABLES LIKE '%version%';"
echo "[1/3] -------->  (done)";

docker exec -i platform_one_db_1 mysql -u$DB_USER -p$DB_PASS < $my_dir/SQL/create_local_DB.sql

echo "[2/3] --------> import Wordpress default DB ";

docker exec -i platform_one_db_1 mysql -u$DB_USER -p$DB_PASS < $my_dir/SQL/wp_default.sql
echo "[2/3] -------->  (done)";

echo "[3/3] --------> import LMS default DB ";

docker exec -i platform_one_db_1 mysql -u$DB_USER -p$DB_PASS < $my_dir/SQL/lms_default.sql
echo "[3/3] -------->  (done)";

//copy wp-config.php
//copy moodle conifg.php
//copy moodledata to lms_dev_one
//docker exec -i platform_one_server_1
//mkdir lms_dev_one && chown -R www-data.www-data 