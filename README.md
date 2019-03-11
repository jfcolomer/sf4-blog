# sf4-blog
Dockerised Symfony 4 blogsite.

### Installing

Requirements
* [Docker](https://docs.docker.com/)
* [Docker-compose](https://docs.docker.com/compose/)

#### Clone the project
```
$ git clone https://github.com/jfcolomer/sf4-blog.git
```

#### Run dependencies
```
$ docker-compose run --rm --no-deps blog-server composer install
$ docker run --rm -it -v $(pwd):/application -w /application node yarn run install
```

#### Assets
The assets are managed via [Webpack encore](https://symfony.com/doc/current/frontend.html).
Some commands are available, you can run those in a container like :
```
$ docker run --rm -it -v $(pwd):/application -w /application node yarn encore dev
$ docker run --rm -it -v $(pwd):/application -w /application node yarn encore dev --watch
$ docker run --rm -it -v $(pwd):/application -w /application node yarn encore production --progress
```
Just notice that, running those in a container do not trigger webpack-notifier.
You should run these commands directly on your host to use it. In this case be 
sure you have yarn installed.

### Running docker containers

#### Running containers
```
$ docker-compose up -d
$ start http://localhost:8000/ # Windows
$ open http://localhost:8000/ # Mac
```

#### Stopping containers
```
$ docker-compose stop
```

### Migrations

```
$ docker-compose exec blog-server php bin/console doctrine:migrations:migrate
```

And run datafixtures

```
$ docker-compose exec blog-server php bin/console doctrine:fixtures:load
```

### Account
You can connect as admin with these infos :

```
login : admin
password : password
```