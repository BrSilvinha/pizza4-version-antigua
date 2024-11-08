# Sistema de Gestión para Pizzería

Este proyecto es un sistema de gestión para una pizzería, desarrollado en PHP utilizando el patrón de diseño MVC (Modelo-Vista-Controlador). El sistema permite la gestión de usuarios, roles, productos, pedidos, mesas, y pisos.

## Requisitos

- PHP >= 7.4
- MySQL
- Composer

## Instalación

1. Clonar el repositorio:

```bash
git clone https://github.com/Bjohan23/pizza4.git
cd pizza4
```
ingresamos al proyecto y abrimos con vscode o algun otro editor
```bash
cd pizza4
```

2. Instalar dependencias con Composer: puedes precionar la tecla ctrl + ñ para que se abra la terminal 

```bash
composer install
```
eso seria todo

4. Importar la base de datos utilizando [`piza4.sql`](command:_github.copilot.openRelativePath?%5B%7B%22scheme%22%3A%22file%22%2C%22authority%22%3A%22%22%2C%22path%22%3A%22%2Fc%3A%2Fxampp%2Fhtdocs%2Fpizza4%2Fpiza4.sql%22%2C%22query%22%3A%22%22%2C%22fragment%22%3A%22%22%7D%5D "c:\\xampp\htdocs\pizza4\piza4.sql") para estructura y datos iniciales:


## Uso

Para acceder al sistema, navega a la carpeta `public/` en tu servidor local. La autenticación es requerida para acceder a las funcionalidades del sistema.

## Estructura del Proyecto

El proyecto sigue el patrón MVC y se organiza en las siguientes carpetas principales:

- `app/`: Contiene los controladores (`Controllers/`), modelos (`Models/`) y vistas (`Views/`).
- `config/`: Archivos de configuración.
- `public/`: Punto de entrada del sistema y recursos estáticos (CSS, imágenes).
- `vendor/`: Dependencias de Composer.

## Contribuir

Para contribuir al proyecto, por favor crea un fork del repositorio, realiza tus cambios y envía un pull request.

## Errores y Mejoras
agregar algun issue en el repo