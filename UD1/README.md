# Unidad 1

## Entorno de desarrollo
Para el desarrollo de los ejercicios y ejemplos de esta unidad utilizaremos una infraestructura de 4 contenedores Docker, definidos en el fichero docker-compose.yml.

* **bitnami/apache**: contiene el servidor web Apache 2. El sitio web se situa en el directorio /app del contenedor que está vinculado al directorio actual (UD1), por lo tanto, todos los ficheros que incluyamos en el directorio actual serán desplegados en el servidor web. **El puerto tcp/8080 sobre el que corre Apache en el contenedor está mapeado al puerto tpc/80 de la máquina local.**

* **bitnami/php-fpm**: contiene el intérprete de PHP que será utilizado para ejecutar los ficheros PHP desplegados en el servidor web. Para ello utiliza el puerto TCP 9000.

* **bitnami/mariadb**: contienes el SGBD mariaDB con la base de datos. Escucha peticiones en el **host mariadb** por el **puerto 3306**. La **contraseña** para el usuario **root** es **bitnami**.

* **bitnami/phpmyadmin**: contiene un servidor web con phpMyAdmin. Se comunica directamente con el servidor de bases de datos instalado en el contenedor mariaDB. **El servidor está corriendo en el puerto 8080 del contenedor que está mapeado al puerto 8000 de la máquina local.**

### Arrancar y detener los contenedores
Para **arrancar los contenedores** debes ejecutar desde el directorio base del proyecto (UD1) el comando:
> docker-compose up

Este comando dejará el terminal vinculado a las salidas estándar de los contenedores. Es útil hacerlo así para ver los avisos y errores que se puedan producir en tiempo de ejecución.

Para **arrancar los contenedores** desacoplando el terminal puedes utilizar la opción -d.
> docker-compose up -d

Para detener los contenedores aoplados a un terminal basta con presionar: **Ctrl+C**

Para detener los contenedores iniciados con docker-compose podemos ejecutar el siguiente comando desde la carpeta donde se encuentre el fichero docker-compose.yml:
> docker-compose down

### Configuración del servidor Apache.
Para modificar directivas de configuración del servidor web podemos hacerlo modificando el **fichero ./apache-vhost/myapp.conf**. Ten en cuenta que si el contenedor está corriendo los cambios no se verán reflejados hasta el siguiente arranque... Vamos, que cuando cambiamos este fichero hay que relanzar los contenedores.

### Configuración del intérprete PHP.
Para configurar cuestiones relativas al intérprete de PHP y al módulo de PHP que utiliza el servidor Web (tradicionalmente el fichero php.ini), podemos hacerlo desde el fichero configuracion_php.ini. Para aplicar los cambios debemos reiniciar los contenedores del mismo modo que en el apartado anterior.
