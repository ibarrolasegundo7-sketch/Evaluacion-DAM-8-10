# Evaluación — CRUD con Control de Accesos en PHP y MySQL


**Situación problemática:** Son contratados para desarrollar el sistema interno de la concesionaria de autos usados **"Rodados del Sudeste"**. La empresa les solicita un sistema con una interfaz de validación de usuarios y niveles (`admin` y `usuario`). Dicha interfaz web contará con la visualización de los vehículos que tienen en venta. Cada vehículo tendrá `marca`, `modelo`, `año`, `precio`, `descripción` e `imagen`, y se podrá visualizar de forma individual haciendo click en su tarjeta. Los usuarios comunes solo podrán visualizar la información; los administradores podrán agregar, modificar y eliminar elementos.

**Restricciones de la evaluación:**
- Sin acceso a internet. Está permitido usar apuntes de carpeta.
- Prohibido el uso de asistentes de IA, foros, chat o copia entre compañeros.
- Se evalúa el código en funcionamiento.
- Se permite el uso del archivo de conexion.php de algun trabajo anterior.

---

## Módulo 1: Base de Datos y Registro Seguro de Usuarios

1. **Estructura de las tablas:** Diseñar en MySQL una tabla `usuarios` con los campos `id`, `email`, `password` y `rol` (valores posibles: `admin` y `usuario`). Diseñar además la tabla `vehiculos` con los campos `id`, `marca`, `modelo`, `anio`, `precio`, `descripcion` e `imagen`.

2. **Almacenamiento de Credenciales:** Implementar el script de registro evitando guardar contraseñas en texto plano. Se debe procesar la contraseña utilizando la función `password_hash()` con el algoritmo por defecto de PHP.

3. **Prevención de Inyección SQL:** Todas las consultas a la base de datos (tanto inserción como lectura) deben ejecutarse de forma obligatoria mediante **sentencias preparadas con PDO**. No se admite concatenación de variables dentro del SQL.

---

## Módulo 2: Autenticación y Manejo de Sesiones

1. **Flujo de Login:**
   - Consultar el usuario por su correo/username mediante consultas preparadas.
   - Validar la contraseña enviada por el formulario contra el hash almacenado utilizando `password_verify()`.

2. **Gestión de Sesión:**
   - Al autenticar correctamente al usuario, iniciar la sesión con `session_start()`.
   - Almacenar los datos clave del usuario (ID, email y rol) en el superglobal `$_SESSION`.

3. **Cierre de Sesión:** Crear el script `logout.php` que limpie el arreglo `$_SESSION`, destruya la sesión en el servidor y redirija al usuario al login.

---

## Módulo 3: Autorización y Guardianes (Guards / Middleware)

1. **Módulo de Protección (`auth.php`):** Desarrollar un archivo centralizado con funciones reutilizables:
   - `esta_autenticado()`: comprueba si existe la sesión activa.
   - `requerir_autenticacion()`: redirige a `login.php` si el usuario no ha iniciado sesión.
   - `requerir_rol($rol_esperado)`: verifica si el usuario posee el rol adecuado para realizar la acción. Si no tiene los permisos suficientes, debe detener la ejecución y retornar un encabezado de respuesta HTTP `403 Forbidden`.

2. **Protección del CRUD:** Aplicar los guardianes en las páginas del panel de administración para restringir las acciones de alta, baja y modificación de datos únicamente a usuarios autorizados.

---

## Módulo 4: Controles Integrales de Seguridad

1. **Saneamiento y Validación de Entradas:** Filtrar y validar los datos recibidos mediante formularios (campos obligatorios, tipos, longitudes).

2. **Mitigación de XSS (Cross-Site Scripting):** Toda salida de datos hacia el HTML (como nombres de usuario o registros cargados desde la base de datos) debe sanitizarse usando `htmlspecialchars()` antes de ser renderizada en el navegador.

---

## Entregable y Estructura del Proyecto

Se entrega la carpeta completa del proyecto junto con el archivo `schema.sql`. Estructura esperada (los nombres son sugeridos, no obligatorios):

```
schema.sql               (script de creación de la base de datos)
config/db.php            (conexión PDO)
auth.php                 (guards / funciones de autorización)
registro.php
login.php
logout.php
index.php                (catálogo en tarjetas)
detalle.php              (detalle por ?id=)
panel.php                (admin: listado con acciones)
vehiculo_form.php        (alta y edición según reciba id)
vehiculo_eliminar.php
```

> **Nota:** la `imagen` se almacena como una **URL en texto** (no se sube archivo).

---

## Criterios de Evaluación

| Criterio | Descripción | Puntos |
| :--- | :--- | :---: |
| **Seguridad en Contraseñas** | Correcto uso de `password_hash()` y `password_verify()` sin texto plano. | 2 |
| **Protección contra Inyecciones** | Ausencia total de consultas concatenadas directamente en SQL (uso de PDO y sentencias preparadas). | 2 |
| **Sesiones y Estado** | Manejo de `$_SESSION`, `session_regenerate_id(true)` y destrucción limpia al salir. | 2 |
| **Autorización** | Guards de `auth.php` funcionando correctamente y respuesta `403 Forbidden` adecuada. | 2 |
| **Saneamiento e Integridad** | Validación de formularios y uso de `htmlspecialchars()` en las salidas. | 1 |
| **CRUD funcional** | Alta, baja, modificación y consulta respetando los permisos por rol. | 1 |
| **Total** | | **10** |

