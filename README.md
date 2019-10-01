# Link Shortener

A web service, what simply creating short links for long ones.

Created in few hours as test challenge.

## Requirements 

Latest Docker and docker-compose

## Installation

In the root of project do those commands:

1.  ``` docker-compose up -d ```
2. ``` docker-compose run --rm php composer install ```
3. ``` docker-compose run --rm php yii migrate --interactive=0 ```
4. ``` chmod -R 777 web/assets/  ```

The whole service is now up on 8000 port.

### Admin access

<b>Login: </b>admin

<b>Password: </b>admin