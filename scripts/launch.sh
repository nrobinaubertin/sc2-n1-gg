#!/bin/sh

set -xe

# go to the root of the git repository
cdroot() {
    ! [ -e ".git" ] && [ "$(pwd)" != "/" ] && cd .. && cdroot || return 0
}

cdroot
mkdir -p sql

db_filename="aligulac-$(date +%Y-%m-%d)"

# only redownload the db if todays db doesn't exists
if ! [ -f sql/"$db_filename.sql" ] && ! [ "$1" = "--no-update-db" ]; then

    rm -f ./sql/*

    # Download Aligulac's database
    wget -O sql/"$db_filename.sql.gz" "http://static.aligulac.com/aligulac.sql.gz"

    # unzip it
    gunzip sql/"$db_filename.sql.gz"

    # Remove unwanted/uncompatible stuff from the dump
    sed -i '/^DROP/d' sql/"$db_filename.sql"
    sed -i '/ALTER TABLE/d' sql/"$db_filename.sql"
    sed -i '/ADD CONSTRAINT/d' sql/"$db_filename.sql"
    sed -i '/CREATE INDEX/d' sql/"$db_filename.sql"
    sed -i '/REVOKE ALL/d' sql/"$db_filename.sql"
    sed -i '/GRANT ALL/d' sql/"$db_filename.sql"
fi


# prepare the postgres initialization directory
cp docker/init.sql sql/init.sql
cp scripts/convert.sql sql/convert.sql
chmod 755 -R sql

# Launch containers:
CURRENT_USER="$(id -u):$(id -g)" docker-compose up -d --force-recreate --build --renew-anon-volumes --remove-orphans

if ! [ "$1" = "--fast" ]; then
    # wait a bit for postgres to init
    sleep 120

    # install backend dependencies
    docker exec -it sc2-n1-gg_exec_1 php bin/composer install

    # Build the app
    docker exec -it sc2-n1-gg_exec_1 yarn install
    docker exec -it sc2-n1-gg_exec_1 yarn encore production

    # Convert the database:
    #docker exec -it sc2-n1-gg_exec_1 php bin/console doc:sch:up --force
fi

# Remove cache
rm -rf var/cache/*
