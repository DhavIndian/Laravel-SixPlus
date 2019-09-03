# Laravel 6.0 Optimized With Vue JS Fast Page Loading No Waiting
## Installation

Development environment requirements :

Setting up your development environment on your local machine :
```bash
$ git clone https://github.com/DhavIndian/lara6.git
$ cd lara6
$ composer install
$ npm install
$ php artisan serve
$ npm run watch

```
Now you can access the application via [http://localhost:8000](http://localhost:8000).


## Useful commands
Seeding the database :
```bash

```

Running tests :
```bash

```

Discover package
```bash
$ docker-compose run --rm --no-deps blog-server php artisan package:discover
```

In development environnement, rebuild the database :
```bash
$ docker-compose run --rm blog-server php artisan migrate:fresh --seed
```

## Contributing

Do not hesitate to contribute to the project by adapting or adding features ! Bug reports or pull requests are welcome.

## License

This project is released under the [MIT](http://opensource.org/licenses/MIT) license.
