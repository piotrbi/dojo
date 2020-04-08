##Build

First build docker

```bash
docker-compose up -d --build
```

install dependencies from composer:
```bash
docker exec -it --user=1000 dojo_php bash -c "composer install"
```

##Usage

then run user story 1:
```bash
docker exec -it --user=1000 dojo_php bash -c "php -f example/us1.php"
```

or user story 2:
```bash
docker exec -it --user=1000 dojo_php bash -c "php -f example/us2.php"
```

##Tests

```bash
docker exec -it --user=1000 dojo_php bash -c "vendor/bin/phpunit"
```

should result with:
```bash
PHPUnit 9.1.1 by Sebastian Bergmann and contributors.

........................                                          24 / 24 (100%)

Time: 221 ms, Memory: 8.00 MB

OK (24 tests, 36 assertions)

Generating code coverage report in HTML format ... done [62 ms]

```