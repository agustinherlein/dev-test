## Instalación de lumen 5.8 en macOS Big Sur 11.5.2

https://lumen.laravel.com/docs/5.8

### Dependencias de lumen

- PHP 7.3
    - Viene preinstalado en macOS, de lo contrario se puede instalar con homebrew 
    - `brew install php@7.3`
- Extensiones de PHP (OpenSSL, PDO, Mbstring)
    - Estas extensiones también vienen preinstaladas, pero para activarlas se debe correr
    - `brew link php@7.3`
- Composer
    - Se siguen las instrucciones de https://getcomposer.org/download/. Se recomienda instalarlo en la carpeta raíz
    - Se debe agregar la ruta de composer al PATH
    - `export PATH=$PATH:~/.composer/vendor/bin`
    - Y mover el archivo composer.phar a la carpeta local
    - `mv composer.phar /usr/local/bin/composer`

## Instalación de lumen

- Con el comando `composer create-project laravel/lumen dev-test "5.8.*"` se crea un nuevo proyecto de lumen con la versión especificada. En este caso se utilizó 5.8. Composer instala las dependencias en la carpeta `vendor`.


## Dependencias del proyecto

- guzzlehttp (para hacer pedidos a la API)
    - `composer require guzzlehttp/guzzle`
- psr-http-message-bridge y psr7 (necesarias para adaptar los requests que hace laravel al estandar PSR7)
    - `composer require symfony/psr-http-message-bridge`
    - `composer require nyholm/psr7`

## Correr el proyecto localmente
- `php -S localhost:8000 -t public`

---

## Integración de API de Spotify

- Registrar aplicación: https://developer.spotify.com/documentation/web-api/quick-start/
- Autorización de la aplicación via token: https://developer.spotify.com/documentation/general/guides/authorization-guide/#client-credentials-flow
- Endpoints utilizados:
    - Búsqueda: https://developer.spotify.com/documentation/web-api/reference/#category-search
    - Álbumes por artista: https://developer.spotify.com/documentation/web-api/reference/#category-artists

## Rutas

- Las rutas están en el archivo `routes/web.php`.
- Se crea una página principal en `/` que muestra un input para buscar artistas y envía la query al endpoint
- En `/api/v1/albums?q=query` se devuelven los álbumes del primer artista que coincida con la query, mostrados en una tabla simple. Este pedido es manejado por un controller ubicado en `app/Http/Controllers/ApiController`.

## Pedidos http

- Dentro de `ApiController` se realizan tres pedidos http para poder devolver los álbumes (ver documentación de la API):
    - Primero a `https://accounts.spotify.com/api/token` utilizando el id de cliente y la clave secreta para obtener un token de autorización.
    - Luego a `https://api.spotify.com/v1/search?q={query}&type=artist` para utilizar la función de búsqueda de artistas.
    - Finalmente a `https://api.spotify.com/v1/artists/{id}/albums` para obtener los álbumes del artista encontrado.

## Vistas

- Los archivos de vistas se ubican en `resources/views`.
- Las dos vistas se hicieron con php y html, utilizando el framework bootstrap 5 para los estilos. https://getbootstrap.com/. 
- También se creó un archivo `public/css/style.css` para estilos adicionales.