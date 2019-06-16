#!/bin/bash

# Destiny folder where backups are stored
DEST=../../backups/mysql
CURRDATE=$(date +"%F")
mkdir -p ${DEST}

# Hostname where MySQL is running
HOSTNAME="blue-mysql"
# User name to make backup
USER="dev"
# File where has the mysql user password
PASS="Dev_44#Pass"

DATABASES=$(mysql -h $HOSTNAME -u $USER -p$PASS -e "SHOW DATABASES;" | tr -d "| " | grep -v Database)

[ ! -d $DEST ] && mkdir -p $DEST

for db in $DATABASES; do
  FILE="${DEST}/$db.sql.gz"
  FILEDATE=

  # Be sure to make one backup per day
  [ -f $FILE ] && FILEDATE=$(date -r $FILE +"%F")
  [ "$FILEDATE" == "$CURRDATE" ] && continue

  [ -f $FILE ] && mv "$FILE" "${FILE}.old"
  mysqldump --single-transaction --routines --quick -h $HOSTNAME -u $USER -p$PASS -B $db | gzip > "$FILE"
  chown www-data:www-data "$FILE"
  rm -f "${FILE}.old"
done