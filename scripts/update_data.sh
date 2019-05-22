#!/bin/sh

set -x

db_filename="aligulac-$(date +%Y-%m-%d)"
storage="/data"

mkdir -p "$storage"

# only refresh data if todays db doesn't exists
if ! [ -f "$storage/$db_filename.sql" ]; then

    # remove old zipped downloads
    rm "$storage/*.sql.gz"

    # archive previous databases
    bzip2 "$storage/*.sql"

    # Download Aligulac's database
    wget -O "$storage/$db_filename.sql.gz" "http://static.aligulac.com/aligulac.sql.gz"

    # unzip it
    gunzip "$storage/$db_filename.sql.gz"
    
    # Remove unwanted/uncompatible stuff from the dump
    sed -i '/^DROP/d' "$storage/$db_filename.sql"
    sed -i '/ALTER TABLE/d' "$storage/$db_filename.sql"
    sed -i '/ADD CONSTRAINT/d' "$storage/$db_filename.sql"
    sed -i '/CREATE INDEX/d' "$storage/$db_filename.sql"
    sed -i '/REVOKE ALL/d' "$storage/$db_filename.sql"
    sed -i '/GRANT ALL/d' "$storage/$db_filename.sql"
    
    # Remove revious data
    psql -d "postgres://postgres:${POSTGRES_PASSWD}@127.0.0.1:5432" < "/var/www/sc2-n1-gg/scripts/clean.sql"

    # Import the data
    psql -d "postgres://postgres:${POSTGRES_PASSWD}@127.0.0.1:5432" < "$storage/$db_filename.sql"
    psql -d "postgres://postgres:${POSTGRES_PASSWD}@127.0.0.1:5432" < "/var/www/sc2-n1-gg/scripts/convert.sql"

    # Clear nginx cache
    rm -rf /tmp/nginx_cache
fi
