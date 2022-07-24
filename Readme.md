# Installation:
### Download & Docker:
1. git clone git@github.com:navasiolau/test_task.git
2. cd test_task
3. setup xdebug.ini:
   1. Mac:   cp docker/back/php/conf.d/xdebug.mac.ini docker/back/php/conf.d/xdebug.ini
4. create .env file for docker-compose:
   1. cp .dist.env .env
5. docker-compose up -d

### DB:
6. docker exec -it back__db bash
7. mysql -u root -proot
8. CREATE DATABASE test;
9. docker exec -it back__php bash
10. bin/console doctrine:schema:create

### Back:
11. docker exec -it back__php bash
12. composer install

### Front:
13. docker exec -it front__node bash
14. npm install
15. npm run build
