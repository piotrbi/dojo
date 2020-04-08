First build docker

```bash
docker-compose up -d --build
```

install dependencies from composer:
```bash
docker exec -it --user=1000 dojo_php bash -c "composer install"
```

then run user story 1:
```bash
docker exec -it --user=1000 dojo_php bash -c "php -f example/us1.php"
```

or user story 2:
```bash
docker exec -it --user=1000 dojo_php bash -c "php -f example/us2.php"
```