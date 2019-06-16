#!/bin/bash
shopt -s extglob nullglob

bindir=../../app/bin
basedir=~../../app/moodata/
backupdir=../../backups/mysql
omitdir="_data|moodledata"

# Create array
if [[ -z $omitdir ]]; then
   cdarray=( "$basedir"/*/ )
else
   cdarray=( "$basedir"/!($omitdir)/ )
fi
# remove leading basedir:
cdarray=( "${cdarray[@]#"$basedir/"}" )
# remove trailing backslash and insert Exit choice
cdarray=( "${cdarray[@]%/}" )

# Display the menu:
#printf 'Please choose from the following. Enter 0 to exit.\n'
for i in "${!cdarray[@]}"; do
    
printf  " $basedir${cdarray[i]}"
    sudo chmod -R 755 $basedir"/"${!cdarray[i]}
    FILENAME=${cdarray[i]}-$(date +%-Y%-m%-d)-$(date +%s).tgz
    cd $basedir && tar -zcvf $backupdir$FILENAME ${cdarray[i]} && cd $bindir
done
printf '\n'



# DESTDIR="/home/<username>/Backups/"
 #FILENAME=ug-$(date +%-Y%-m%-d)-$(date +%-T).tgz
 #tar --create --gzip --file=$DESTDIR$FILENAME $SRCDIR