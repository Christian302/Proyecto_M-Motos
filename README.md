# Sistema Web MMotos

## Descripción del Proyecto

MMotos es un sistema web desarrollado para la gestión y comercialización de motocicletas. La plataforma permite a los usuarios visualizar un catálogo de motocicletas, solicitar cotizaciones, programar pruebas de manejo y consultar información de la empresa.

Además, el sistema cuenta con un panel administrativo que permite gestionar productos, usuarios, solicitudes y métricas del negocio.

---

## Objetivos del Proyecto

* Desarrollar un sistema web funcional para venta de motocicletas
* Implementar un panel administrativo completo
* Gestionar solicitudes de clientes
* Administrar catálogo dinámico de productos
* Implementar autenticación de usuarios

---

## Funcionalidades Principales

### Usuarios

* Visualizar catálogo de motocicletas
* Ver detalles de cada motocicleta
* Solicitar cotización
* Solicitar prueba de manejo
* Registrarse en el sistema
* Iniciar sesión
* Contactar con la empresa

### Panel Administrativo

* Gestión de motocicletas (Agregar, editar, eliminar)
* Gestión de usuarios
* Gestión de solicitudes de cotización
* Gestión de pruebas de manejo
* Subida de imágenes
* Visualización de métricas del sistema

---

## Tecnologías Utilizadas

* HTML5
* CSS3
* JavaScript
* PHP
* MySQL
* Bootstrap
* XAMPP / Apache

---

## Arquitectura del Proyecto

El sistema está desarrollado utilizando arquitectura modular, separando:

* Frontend
* Backend
* Base de Datos
* Panel Administrativo

---

## Estructura del Proyecto

```
MMotos/
│
├── admin/
├── assets/
├── config/
├── includes/
├── uploads/
├── index.php
├── login.php
├── registro.php
└── database.sql
```

---

## Instalación del Proyecto

### 1. Clonar el repositorio

```
git clone https://github.com/tuusuario/mmotos.git
```

### 2. Mover proyecto a XAMPP

Copiar la carpeta del proyecto en:

```
C:\xampp\htdocs\
```

### 3. Crear base de datos

1. Abrir phpMyAdmin
2. Crear base de datos llamada:

```
mmotos
```

3. Importar el archivo:

```
database.sql
```

### 4. Configurar conexión

Editar archivo:

```
config/database.php
```

Configurar:

```
host = localhost
usuario = root
password = ""
base de datos = mmotos
```

---

## Ejecutar Proyecto

Abrir navegador:

```
http://localhost/mmotos
```

---

## Características del Sistema

* Sistema CRUD completo
* Autenticación de usuarios
* Panel administrativo
* Subida de imágenes
* Formularios dinámicos
* Diseño responsive
* Base de datos relacional

---

## Tipo de Proyecto

Proyecto Académico / Portafolio Profesional

---

## Autor

Adonay Macías
Ingeniero en Sistemas y Computación
Desarrollador Web Full Stack
Analista de Datos

---

## Contribuciones

Las contribuciones son bienvenidas. Puedes hacer un fork del proyecto y enviar tus mejoras.

---

## Licencia

Este proyecto es de uso educativo y de portafolio profesional.

---

## Contacto

Puedes contactarme para mejoras o consultas sobre el proyecto.

---

Proyecto desarrollado para portafolio profesional
