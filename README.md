## Local installation

required: php 8.1, composer, docker, docker-compose

- git clone git@github.com:tmnsit/bargain-parser.git
- cd bargain-parser/
- docker-compose up
- cd parser-app/
- composer install
- php artisan migrate
- cp .env.example .env
- php artisan key:generate

### Start parse
- php artisan bargain:parse
- php artisan queue:work

http://127.0.0.1/all

