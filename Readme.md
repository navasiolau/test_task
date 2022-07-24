# Installation:
### Download & Docker:
1. git clone git@github.com:navasiolau/test_task.git
2. cd test_task
3. docker-compose up -d

### Backend:
4. docker exec -it back__php bash
5. composer install
6. bin/console doctrine:database:create
7. bin/console doctrine:schema:create

### Front:
13. docker exec -it front__node bash
14. npm install
15. npm run build
