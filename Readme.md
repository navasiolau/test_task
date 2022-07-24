# Installation:
### Download & Docker:
1. git clone git@github.com:navasiolau/test_task.git
2. cd test_task
3. docker-compose up -d

### Backend:
4. docker exec -it back__php bash
5. composer install
6. bin/console doctrine:database:create --if-not-exists
7. bin/console doctrine:schema:create

### Front:
8. docker exec -it front__node bash
9. npm install
10. npm run build

#### Now you can see app on: [http://localhost:8080/](http://localhost:8080/)
#### Api URL: [http://localhost:8081/carts](http://localhost:8081/carts)
