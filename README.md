# Aplicacion_Crossfit

Descripción breve de la aplicación.

## Requisitos

- PHP (versión 8.1.6)
- Servidor web (Apache, Nginx, etc.)
- Base de datos SQL (MySQL, PostgreSQL, etc.)

## Instalación

1. Clona el repositorio:

2. Configuración de la base de datos:

- Crea una base de datos en tu servidor SQL.
- Importa el archivo SQL `crossfit.sql` proporcionado en la carpeta `sql` a tu base de datos.

3. Configuración del archivo de conexión:

- Abre el archivo `database.php` ubicado en la carpeta `includes`.
- Actualiza los valores de configuración para la conexión a la base de datos, como el host, nombre de usuario, contraseña y nombre de la base de datos.

4. Despliegue:

- Configura un servidor web (Apache, Nginx, etc.) para apuntar al directorio raíz de tu aplicación.
- Asegúrate de que el servidor web tenga configurada la ejecución de archivos PHP.

5. Accede a tu aplicación:

- Abre un navegador web y accede a la URL de tu aplicación.
- Deberías ver la página de inicio de la aplicación.

## Funcionalidades

- Registro de usuarios: Permite a los usuarios crear una cuenta en la aplicación para acceder a sus funcionalidades.
- Compra de suscripción: Permite a los usuarios simular la compra de una suscripción.
- Registro de resultados: Permite a los usuarios registrar su progreso en los entrenamientos, incluyendo las series, repeticiones o pesos utilizados.
- Calendario de entrenamiento: Muestra un calendario con los entrenamientos programados y permite a los usuarios realizar las reservas de las clases.
- Perfil: Permite a los usuarios actualizar datos del perfil, observar y cancelar sus reservas activas.
- Contacto con administrador: Permite a los usuarios contactar con el administrador para sugerencias o quejas.

## Contribuciones

Las contribuciones son bienvenidas. Si deseas mejorar este proyecto, sigue los siguientes pasos:

1. Haz un fork del repositorio.
2. Crea una nueva rama: `git checkout -b mejora/funcionalidad`
3. Realiza los cambios y realiza un commit: `git commit -m 'Agrega una nueva funcionalidad'`
4. Sube los cambios a tu fork: `git push origin mejora/funcionalidad`
5. Abre un pull request en este repositorio.

## Licencia

Todos los derechos reservados. © AdrianRela

## Contacto

Si tienes alguna pregunta o sugerencia, no dudes en ponerte en contacto conmigo a través de https://github.com/AdrianRela.