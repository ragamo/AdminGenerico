App Genérica
==============

Paquetes incluidos:

- CodeIgniter 3.0.0
  - FacebookApi
  - Bitly
  - UF Sii
- Modular Extensions - HMVC
- Smarty 3.0.8
- Modernizr 2.6.3
- jQuery 1.11.0
- Fancybox 2.1.5



Admin Genérico
==============

Paquetes incluidos:

- CodeIgniter 3.0.0
  - Excel
- Smarty 3.0.8
- GroceryCRUD 1.5.0
- ImageCRUD 0.5
- jQuery 1.11.0
- Bootstrap 3.0.0
  - Ace Skin for Bootstrap
  
Módulos y permisos
------------------

Cada módulo debe registrarse en libraries/menu.php -> function items()

La aplicación (admin) verificará si cada usuario posee los permisos indicados para leer el controller indicado.

El sistema de permisos considera cada controller como un módulo independiente. 

Por defecto, el SQL de instalación genera un nuevo usuario administrador:
- User: admin
- Pass: admin

Además asigna permisos para leer los controllers "home" y "administrators".

Cuando se agregan nuevos módulos (o controllers) deben ser asignados a través del administrador de usuarios para que aparezcan en el menú.


Otros
-----

El admin tiene capacidad HMVC, pero no viene instalado por defecto. Si se requiere, se deben copiar los directorios /third_party y /code de /application.
