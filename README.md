## mymvc-v1.1

just a simple mvc.

## install

Please download, clone, or fork this repository.

## How to run mymvc-v1.1

Previously please install composer if you not have [composer]('https://getcomposer.org/') and after install composer follow a few steps above :

## step 1

Create your database, and setting yor database name in file env.json, but you want to default database please export dbmymvc_2016-09-14.sql to your database.

```json

{
	"driver": "mysql",
	"host": "127.0.0.1",
	"database": "dbmymvc",
	"username": "root",
	"password": "root",
	"charset": "utf8",
	"collation": "utf8_unicode_ci"
}

```
## step 2

Install composer in your directory app.

```bash

composer install

```

## step 3

Build in server, go to directory in your directory run this command :

```bash

php -S localhost:9000

```

