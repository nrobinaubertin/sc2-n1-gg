sc2.n1.gg
=========

Download Aligulac's database
```
wget http://static.aligulac.com/aligulac.sql
```

Launch containers:
```
CURRENT_USER="$(id -u):$(id -g)" docker-compose up
```

Start dev container:
```
docker exec -it sc2-n1-gg_exec_1 bash
```

Import database:
```
psql -d 'postgres://postgres:plop@172.20.0.4:5432' postgres < aligulac.sql
```

Convert the database:
```
psql -d 'postgres://postgres:plop@172.20.0.4:5432' postgres < convert.sql
```

Fix the database:
```
php bin/console doc:sch:up --force
```

Build the admin:
```
yarn install && yarn encore dev
```
