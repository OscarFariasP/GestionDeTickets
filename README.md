<b>Clona este repositorio ejecutando 

git clone https://github.com/OscarFariasP/GestionDeTickets.git</b>

y a continuación sigue los siguientes pasos.

<b> 1. Instala todas las dependencias.</b>

ejecuta:

 <b>composer install</b> 
 luego
 <b>npm install o yarn install</b> 

<b>2. CONFIGURANDO LA BASE DE DATOS MYSQL EN LARAVEL.</b>

Ubica en la carpeta raíz el archivo sin extensión, env y rellena los siguientes datos, por default son estos.

DB_CONNECTION=mysql

DB_HOST=127.0.0.

DB_PORT=3306

DB_DATABASE=apptest

DB_USERNAME=testapp

DB_PASSWORD=123456789


<b> Nota: Si el archivo env no existe, renombra env.example a env y edita las variables.</b>

<b> 2. BASE DE DATOS Y ACCESO DE USUARIO.</b>

Debes crear una base de datos desde tu gestor de base de datos con el nombre seleccionado en este caso la base de datos debe llamarse <b>apptest</b> y un usuario para la base de datos que tenga el nombre <b>testapp</b>, que acceda con la contraseña <b>123456789</b>.

<b>3. Finalmente Levanta el servidor. </b>

- <b>Activando servidor para Laravel en localhost</b>

ejecuta:

<b> php artisan migrate && php artisan db:seed && php artisan serv</b>

- <b>Compilando ReactJS.</b>
Sin cerrar la consola de comandos, abre otra consola de comandos y ejecuta:

<b>npm run dev</b>

Finalmente abre tu sitio web: http://127.0.0.1:8000/


Usuarios de prueba:

Administrador: 

email: admin@example.com
pass: 123456

Usuario:

email: user@example.com
pass: 123456
