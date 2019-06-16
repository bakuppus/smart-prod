#!/bin/bash
clear
echo '/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\'
echo " Clone OneAcademy LMS Compoonent "
echo '/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\'
#get paramters
DB_HOST=$2
DB_USER=$3
DB_PASS=$4
DB_NAME=$5
ROOT_DIR=$5_data;
ADMIN_EMAIL=$6
LMS_NAME=$7
SSO_DOMAIN=$8
SSOURL=$SSO_DOMAIN

#mysql -u$DB_USER -p$DB_PASS -h localhost -e "SHOW DATABASES;"

#create new DB
if [ "$1" == "-c" ]; then
echo "Step 1 -- Create new DB [$DB_NAME]"
    mysql --host=$DB_HOST --user=$DB_USER --password=$DB_PASS -e "CREATE DATABASE $DB_NAME CHARACTER SET utf8 COLLATE utf8_general_ci;"
echo " ***  DB $DB_NAME successfully created *** "
fi

#clone default DB
    mysql --host=$DB_HOST --user=$DB_USER --password=$DB_PASS <<< "USE $DB_NAME;"

#echo $DB_user
echo "Step 2 -- Import Default Moodle DB to $DB_NAME"
mysql --host=$DB_HOST --user=$DB_USER --password=$DB_PASS $DB_NAME < lms_default.sql
echo " ***  Default Moodle DB imported successfully *** "

#update User Email Address
echo "Step 3 -- Set Admin email [$ADMIN_EMAIL]"
mysql --host=$DB_HOST --user=$DB_USER --password=$DB_PASS  $DB_NAME -e "UPDATE mdl_user SET email = '$ADMIN_EMAIL' WHERE mdl_user.id = 2;"
echo " ***  Admin email successfully updated *** "

#update LMS name
echo "Step 4 -- Set LMS name [$LMS_NAME]"
mysql --host=$DB_HOST --user=$DB_USER --password=$DB_PASS  $DB_NAME -e "UPDATE mdl_company SET name = '$LMS_NAME', shortname = 'LMS' WHERE mdl_company.id = 1;"
mysql --host=$DB_HOST --user=$DB_USER --password=$DB_PASS  $DB_NAME -e "UPDATE mdl_department SET name = '$LMS_NAME', shortname = 'LMS' WHERE mdl_department.id = 1;"
mysql --host=$DB_HOST --user=$DB_USER --password=$DB_PASS  $DB_NAME -e "UPDATE mdl_course SET fullname = '$LMS_NAME', shortname = 'LMS' WHERE mdl_course.id = 1;"
echo " ***  LMS name successfully updated *** "

#update SSO url
echo "Step 4 -- Set LMS name [$LMS_NAME]"
mysql --host=$DB_HOST --user=$DB_USER --password=$DB_PASS  $DB_NAME -e "UPDATE mdl_config_plugins SET value = '$SSOURL' WHERE mdl_config_plugins.plugin = 'auth_userkey' AND mdl_config_plugins.name = 'wpurl' ;"
echo " ***  LMS name successfully updated *** "

#update Academy name
#UPDATE `mdl_company` SET `name` = 'CairoSchool', `shortname` = 'Cairo' WHERE `mdl_company`.`id` = 1;
#UPDATE `mdl_department` SET `name` = 'Cairo School', `shortname` = 'Cairo' WHERE `mdl_department`.`id` = 1;
#UPDATE `mdl_course` SET `fullname` = 'Cairo School', `shortname` = 'Cairo' WHERE `mdl_course`.`id` = 1;

#crate dataroot folder
echo "Step 3 -- Create Moodle DataRoot Folder"
chown -R www-data.www-data ../moodata;
#mkdir ../moodata/$ROOT_DIR; 
cp -R ../moodata/default_moodledata ../moodata/$ROOT_DIR; 
echo " ***  Moodle DataRoot folder created successfully *** "

#updat dataroot permissions
echo "Step 4 -- Update Moodle DataRoot folder permissions"
sudo chown -R www-data.www-data ../moodata/$ROOT_DIR;
sudo chmod -R 777 ../moodata/$ROOT_DIR;
echo " ***  Moodle DataRoot folder permissions updated successfully *** "