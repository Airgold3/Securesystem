# SecureSystem
Securesystem es un sistema seguro de registro e inicio de sesión que cuenta con un panel de control para poder añadir, editar o eliminar usuarios. Con esto podrás estar tranquilo de posibles ataques que te puedan hacer a tu web.

![GIF](https://user-images.githubusercontent.com/62146446/156011108-7c64f712-51e8-4ed5-9461-586298fd513d.gif)

<div align="center">
  
<img src="https://img.shields.io/badge/PHP-8.0.13-787CB5?style=for-the-badge&logo=php"> <img src="https://img.shields.io/badge/Autor-airgold3-blue?logo=github&style=for-the-badge"> <img src="https://img.shields.io/badge/Licencia-GPLV3-red?style=for-the-badge&logo=gnu"> 
</div>

## Características Generales 📁

<ul>
  <li><a>Contiene un Login, Registro y Verficación del Correo</a></li>
  <li><a>Dashboard (Panel de admin)</a></li>
  <li><a>Contador de usuarios, admins y correos pendientes de verificar</a></li>
  <li><a>Geolocalización en tiempo real de una IP proveniente de un usuario </a></li>
</ul>

## Características de Seguridad 🔒
 
 <ul>
  <li><a>PDO (PHP Data Objects)</a></li>
  <li><a>Anti SQL Injection (Inyección SQL)</a></li>
  <li><a>Anti XSS (Cross Site Scripting)</a></li>
  <li><a>Anti CSRF TOKEN (Cross-Site Request Forgery)</a></li>
  <li><a>Anti Force Brute (Capcha Propio)</a></li>
  <li><a>Anti cookie/session hijacking (Secuestro de cookies/sesión)</a></li>
  <li><a>Hash (sha3-512)</a></li>
  <li><a>Email gmail o yahoo (Solo acepta correos de google o yahoo)</a></li>
 </ul>
 
 ## Instalación 📰
 1. Descagamos el repositorio
 2. Importamos el archivo sql que se encuentra en **database/database.sql** a nuestra base de datos
 3. Nos dirijimos al archivo **includes/config.php**. Cambiamos la contraseña de la base de datos por la nuestra
 4. ¡Disfrutar del sistema seguro!
 
 ## Consejos ⚡️ 
 1. Cambiar el archivo **config.php** que se encuentra en **includes/config.php** y cambiar por tus credenciales.
 2. Para poder entrar al panel tendrás que cambiar el rango del usuario a 1 en la base de datos.
 3. Para acceder al panel de admin nos tendremos que ir a la carpeta admin
 ## Proyecto construido con 🔨
 
* [PHP](https://www.php.net/) - PHP
* [Bootstrap](https://getbootstrap.com/) - Bootstrap
* [PHPMailer](https://github.com/PHPMailer/PHPMailer) - PHPMailer
* [jQuery](https://jquery.com/) - jQuery

## Licencia 📄
   El proyecto está bajo la Licencia (GPLv3) aquí puedes ver el archivo [LICENSE](LICENSE) para ver más detalles.