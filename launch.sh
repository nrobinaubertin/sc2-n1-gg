#!/bin/sh

set -x

mkdir sql

db_filename="aligulac-$(date +%Y-%m-%d)"

# only redownload the db if todays db doesn't exists
if ! [ -f sql/"$db_filename.sql" ]; then
    # Remove previous downloaded db
    rm ./sql/*.sql ./sql/*.sql.gz

    # Download Aligulac's database
    wget -O sql/"$db_filename.sql.gz" "http://static.aligulac.com/aligulac.sql.gz"

    # unzip it
    gunzip sql/"$db_filename.sql.gz"
    
    # Remove non data stuff from the dump
    sed -i '/DROP/d' sql/"$db_filename.sql"
    sed -i '/ALTER TABLE/d' sql/"$db_filename.sql"
    sed -i '/ADD CONSTRAINT/d' sql/"$db_filename.sql"
    sed -i '/CREATE INDEX/d' sql/"$db_filename.sql"
    sed -i '/REVOKE ALL/d' sql/"$db_filename.sql"
    sed -i '/GRANT ALL/d' sql/"$db_filename.sql"
fi

# prepare the postgres initialization directory
cp docker/init.sql sql/init.sql
cp docker/convert.sql sql/convert.sql
chmod 755 -R sql

# Launch containers:
CURRENT_USER="$(id -u):$(id -g)" docker-compose up -d --force-recreate --build --renew-anon-volumes

# wait a bit for postgres to init
sleep 120

# install backend dependencies
docker exec -it sc2-n1-gg_exec_1 php bin/composer install

# Clear cache
docker exec -it sc2-n1-gg_exec_1 php bin/console c:c --env=prod

# Build the app
docker exec -it sc2-n1-gg_exec_1 yarn install
docker exec -it sc2-n1-gg_exec_1 yarn encore production

# Convert the database:
#docker exec -it sc2-n1-gg_exec_1 php bin/console doc:sch:up --force
