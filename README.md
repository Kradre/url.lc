# Link Shortener

A web service, what simply creating short links for long ones.

Created in few hours as test challenge.

## Installation


Install composer required packages
```
composer install
```
Configure db.php and params.php file from examples, located in config folder.
In parameter urlShort from params.php leave the domain you'd use for this size and it's links.
It was made like this if site would have many different domains and you'd need only one for short links.

After configuring db.php, apply migration for url table: 
```
yii migrate
```

For proper work, use web folder as main entry point for web server.


