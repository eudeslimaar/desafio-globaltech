# DESAFÍO GLOBALTECH
## Autor: Eudes Lima

### Proyecto de un dashboard de gestión de pedidos

### Tecnologias y lenguages utilizados
- Docker
- PHP
- JAVASCRIPT
- COMPOSER
- MARIADB
- HTML
- CSS
- JQUERY

### Instalación

1. Levantar Docker para que se pueda ejecutar el proyecto y aguardar a que se termine de inicializar la base de datos que usa stored procedures para cargar contenído inicialmente.
```sh
docker-compose up -d
```
2. caso de que exista algún problema con el auto loader de composer, ejecutar el siguiente comando:
```sh
docker-compose composer dump-autoload
```
3. en caso de algún error con la base de datos, ejecutar el siguiente comando para eliminir el volumen de la base de datos y volver a crearlo.:
```sh
docker-compose down -v
```
4. Acceder a la url http://localhost:8080
