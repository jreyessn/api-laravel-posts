# Laravel API - Posts & Video (Tags)

API desarrollada en Laravel 8+, PHP 8, Autenticación con JWT y Docker.

### ERD
![ERD](https://i.ibb.co/JR61bBs/ERD-Posts-Videos-Laravel.png)

### Solución al requerimiento
Tabla polimórfica (model_tags) relacionada con las tablas de Posts y Videos. De este modo reutiliza el mismo modelo para un comportamiento en común (asociar muchos tags).

## Configuración

Requiere **docker-compose** v1.25.0+ y **Docker** v20+.

Desplegar contenedores con la configuración del **docker-compose.yml**.
```
docker-compose up -d
```
Crear una copia del archivo `.env.example` y llamarlo `.env`. 

Instalar dependencias de laravel con composer.

```
docker exec -it app_posts composer install
```

Generar la key de la aplicación.
```
docker exec -it app_posts php artisan key:generate
```

Correr las migraciones.
```
docker exec -it app_posts php artisan migrate
```

Generar key de JWT.
```
docker exec -it app_posts php artisan jwt:secret
```

Dar permisos a la carpeta de storage
```
docker exec -it app_posts chown -R root:www-data /var/www/html/storage/
```

## Desarrollo

Una vez levantado los contenedores, el ambiente se encontraría desplegado en el puerto **5000**. [http://localhost:5000/](http://localhost:5000/)

## Postman
La colección de Postman ya tiene configuradas las variables de entorno (API y TOKEN). Con hacer login con un usuario dentro de **Auth/Sign In** el access_token se asignará automáticamente a las cabeceras de las peticiones.
