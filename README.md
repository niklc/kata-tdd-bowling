Init:
```bash
docker run -it --rm -v path/to/your/dir:/app --entrypoint bash composer
```

Run container:
```bash
docker run -it --rm -v $PWD:/app --entrypoint bash composer
```

Run tests:
```bash
./vendor/bin/phpunit --color tests/BowlingGameTest.php
```