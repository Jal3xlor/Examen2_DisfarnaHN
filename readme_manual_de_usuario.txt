# DISFARMA Honduras
## Manual de instalación y usuario

**Droguería y Distribuidora Farmacéutica San Rafael S. de R.L.**

---

## 1. Descripción del sistema

DISFARMA Honduras es una plataforma de gestión interna diseñada para centralizar y administrar la información de medicamentos, proveedores y empleados de la empresa.

El sistema permite registrar, consultar, actualizar y eliminar información, además de visualizar indicadores generales desde un dashboard administrativo.

## 2. Tecnologías

- Laravel 13
- PHP 8.3
- MySQL
- Bootstrap 5
- Start Bootstrap SB Admin
- Git

## 3. Requisitos de instalación

- PHP 8.3 o superior.
- Composer.
- MySQL.
- XAMPP o un entorno equivalente.
- Git (opcional).

## 4. Instalación y configuración

**Paso 1. Instalar las dependencias**

Desde PowerShell, ubicarse en la carpeta del proyecto y ejecutar:

```powershell
composer install
```

**Paso 2. Configurar el entorno**

Crear el archivo `.env`:

```powershell
Copy-Item .env.example .env
```

Configurar la conexión a MySQL:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=farmacia-app
DB_USERNAME=root
DB_PASSWORD=
```

Ajustar las credenciales según la configuración del servidor.

**Paso 3. Generar la clave de aplicación**

```powershell
php artisan key:generate
```

**Paso 4. Crear la base de datos**

Desde phpMyAdmin, crear una base de datos con el nombre:

`farmacia-app`

**Paso 5. Crear las tablas**

```powershell
php artisan migrate
```

**Paso 6. Crear el usuario administrador**

```powershell
php artisan db:seed
```

**Paso 7. Iniciar el sistema**

```powershell
php artisan serve
```

Acceder desde el navegador:

http://127.0.0.1:8000

## 5. Acceso al sistema

El acceso se realiza mediante el formulario de inicio de sesión.

**Credenciales iniciales del administrador:**

| Campo | Valor |
|---|---|
| Correo | admin@disfarma.hn |
| Contraseña | Admin12345 |
| Rol | Administrador |

El sistema permite el acceso mediante correos electrónicos que utilicen el dominio `@disfarma.hn`.

## 6. Administración de usuarios

La creación de usuarios se realiza desde la consola de Laravel mediante PowerShell.

**Paso 1.** Ejecutar:

```powershell
php artisan tinker
```

**Paso 2.** Introducir el siguiente código:

```php
App\Models\User::create([
    'name' => 'Nombre del Usuario',
    'email' => 'usuario@disfarma.hn',
    'password' => 'ClaveTemporal123',
    'rol' => 'Usuario',
    'cambiar_password' => true
]);
```

**Paso 3.** Salir de Tinker:

```php
exit
```

**Paso 4.** Proporcionar al usuario su correo y contraseña temporal para iniciar sesión.

### Cambio obligatorio de contraseña

Cuando un usuario inicia sesión por primera vez con `cambiar_password` activado:

1. El sistema valida sus credenciales.
2. Lo redirige al formulario de cambio de contraseña.
3. El usuario introduce y confirma una nueva contraseña.
4. El sistema actualiza la contraseña y habilita el acceso al dashboard.

Las contraseñas se almacenan mediante hashing seguro.

## 7. Funcionalidades del sistema

### Dashboard

Presenta indicadores generales:

- Total de medicamentos registrados.
- Proveedores activos.
- Empleados activos.
- Valor total del inventario.

### Medicamentos

Permite registrar, consultar, editar, eliminar y buscar medicamentos.

Información administrada:

- Código y nombre.
- Categoría.
- Precio y costo.
- Existencias.
- Laboratorio.
- Fecha de vencimiento y registro.
- Número de lote.
- Imagen del medicamento.

**Categorías:** Antibióticos, Analgésicos, Sueros, Material Quirúrgico y Vitaminas.

**Estados del inventario:**

| Existencias | Estado |
|---|---|
| Más de 20 | Óptimo |
| De 10 a 20 | Moderado |
| Menos de 10 | ¡Desabastecimiento! |

### Proveedores

Permite registrar, consultar, editar, eliminar y buscar proveedores.

Información administrada:

- RTN.
- Empresa y contacto.
- Teléfono.
- Categoría.
- Límite de crédito.
- Días de crédito.
- Estado.
- Fecha de registro.

**Categorías:** Fármacos, Material Quirúrgico y Equipos.

**Días de crédito:** 15, 30, 45 y 60 días.

### Empleados

Permite registrar, consultar, editar, eliminar y buscar empleados.

Información administrada:

- Identidad.
- Nombre y apellido.
- Correo electrónico.
- Cargo.
- Salario.
- Fecha de ingreso.
- Estado.

**Cargos:** Regente Farmacéutico, Asistente de Farmacia, Jefe de Bodega, Despachador y Cajero.

## 8. Cierre de sesión

Para finalizar el acceso:

1. Seleccionar el menú del usuario en la barra superior.
2. Presionar la opción de cerrar sesión.
3. El sistema finalizará la sesión y redirigirá al inicio de sesión.

Las secciones administrativas requieren autenticación.

## 9. Base de datos

La base de datos utilizada es `farmacia-app`.

Tablas principales:

- `users`: usuarios y credenciales.
- `medicamentos`: catálogo de medicamentos.
- `proveedores`: información de proveedores.
- `empleados`: información del personal.

### Restaurar una copia de seguridad

1. Abrir phpMyAdmin.
2. Crear la base de datos `farmacia-app`.
3. Seleccionarla.
4. Entrar en **Importar**.
5. Seleccionar el archivo `farmacia-app.sql`.
6. Ejecutar la importación.

## 10. Comandos de mantenimiento

| Comando | Descripción |
|---|---|
| `php artisan serve` | Iniciar el servidor |
| `php artisan migrate` | Ejecutar migraciones |
| `php artisan db:seed` | Ejecutar seeders |
| `php artisan migrate:status` | Consultar migraciones |
| `php artisan route:list` | Consultar rutas |
| `php artisan tinker` | Administrar datos desde consola |
| `php artisan optimize:clear` | Limpiar cachés |

---

**DISFARMA Honduras**

*Sistema de Gestión Farmacéutica.*