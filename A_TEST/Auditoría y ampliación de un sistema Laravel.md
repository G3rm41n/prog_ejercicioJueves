# Auditoría y ampliación de un sistema Laravel

## Proyecto base

Para realizar el trabajo se utilizará el siguiente proyecto desarrollado con Laravel 12:

**WorkTrack HRIS**  
[https://github.com/MasMuham24/WorkTrack-HRIS](https://github.com/MasMuham24/WorkTrack-HRIS)

El sistema permite administrar empleados, asistencia, licencias, oficinas y distintos roles de usuario.  
El objetivo del trabajo es descargar un proyecto Laravel existente, ponerlo en funcionamiento, analizar parte de su estructura e incorporar nuevas funcionalidades.

---

## 1. Preparación del proyecto

* Clonar el repositorio en el equipo de trabajo.
* Realizar las tareas necesarias para poner el sistema en funcionamiento:
  * Instalar las dependencias del proyecto.
  * Configurar el archivo `.env`.
  * Crear y configurar la base de datos.
  * Ejecutar las migraciones y los seeders correspondientes.
  * Ejecutar el proyecto y verificar su correcto funcionamiento.
* Una vez desplegado el sistema, ingresar a la aplicación utilizando alguno de los usuarios disponibles.

---

## 2. Auditoría de inicio de sesión

Implementar un sistema de auditoría que permita registrar cada inicio de sesión exitoso realizado en la aplicación.

Cada registro deberá almacenar como mínimo:
* Usuario que inició sesión.
* Dirección IP desde donde se realizó el acceso.
* Fecha y hora del inicio de sesión.

La información deberá quedar almacenada en la base de datos.

> Para resolver este punto será necesario analizar el funcionamiento actual del login y determinar en qué momento debe generarse el registro de auditoría.

---

## 3. Consulta de auditoría

Crear una nueva sección dentro del sistema que permita consultar los accesos registrados.

Esta sección deberá:
* Mostrar un listado de los inicios de sesión.
* Mostrar usuario, dirección IP, fecha y hora.
* Ordenar los registros comenzando por los accesos más recientes.
* Ser accesible únicamente por usuarios con rol **Administrador**.
* Un usuario que no posea el rol correspondiente no deberá poder acceder a esta sección aunque conozca directamente la URL.

---

## 4. Nueva funcionalidad: exportación del reporte de asistencia

El sistema posee actualmente una sección de reportes de asistencia.

* Agregar la posibilidad de exportar el reporte de asistencia a un archivo **CSV**.
* Desde la pantalla del reporte se deberá incorporar una opción que permita descargar la información mostrada.

El archivo deberá contener como mínimo:
* Empleado.
* Fecha.
* Hora de ingreso.
* Hora de salida.
* Estado de asistencia.

> Si el reporte se encuentra filtrado, por ejemplo por fecha o departamento, la exportación deberá respetar los filtros aplicados.
