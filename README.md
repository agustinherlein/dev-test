# Instalación de lumen 5.8 en macOS Big Sur 11.5.2

https://lumen.laravel.com/docs/5.8

## Dependencias de lumen

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

---

## Instalación de lumen

- Con este comando de composer se crea un nuevo proyecto de lumen en la versión especificada. En este caso se utilizó 5.8
`composer create-project laravel/lumen dev-test "5.8.*"`

## Dependencias del proyecto

- guzzlehttp (para hacer pedidos a la API)
    - `composer require guzzlehttp/guzzle`
- psr-http-message-bridge y psr7 (necesarias para adaptar los requests que hace laravel al estandar PSR7)
    - `composer require symfony/psr-http-message-bridge`
    - `composer require nyholm/psr7`

## Correr el proyecto localmente
- `php -S localhost:8000 -t public`

## Integración de API de Spotify

- Registrar aplicación: https://developer.spotify.com/documentation/web-api/quick-start/
- Autorización de la aplicación via token: https://developer.spotify.com/documentation/general/guides/authorization-guide/#client-credentials-flow
- Endpoints utilizados:
    - Búsqueda: https://developer.spotify.com/documentation/web-api/reference/#category-search
    - Álbumes por artista: https://developer.spotify.com/documentation/web-api/reference/#category-artists

## Rutas y controllers

- Se crea una página principal en `/` que muestra un 