# Sistema web para restaurant 
## Laravel 10 Ver. 1.0

![N|Solid](https://qrscann.maydev.tech/all_images/bigbang/Dashboard.jpg)


<div align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  </a>
  <a href="https://tailwindcss.com" target="_blank">
    <img src="https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind CSS">
  </a>
  <a href="https://developer.mozilla.org/en-US/docs/Web/HTML" target="_blank">
    <img src="https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white" alt="HTML5">
  </a>
  <a href="https://developer.mozilla.org/en-US/docs/Web/JavaScript" target="_blank">
    <img src="https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black" alt="JavaScript">
  </a>
  <a href="https://www.mysql.com" target="_blank">
    <img src="https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
  </a>
  <a href="https://laravel-livewire.com" target="_blank">
    <img src="https://img.shields.io/badge/Livewire-4e56a6?style=for-the-badge&logo=laravel-livewire&logoColor=white" alt="Livewire">
  </a>
</div>


**Solución completa para gestión de Mesas y Pedidos** con panel administrativo, menú digital y sistema para la gestion de pedidos, gestion de mesero-garzones

## 🌟 Características Destacadas

### 📊 Panel Administrativo (CRUDS completoS)
- Administración de Categorias.
- Administración de Productos. 
- Administración de Mesas.
- Ordener - Mesas.
- Meseros -Garzones.
- Pedidos en Cocina.
- Admin-Ordenes
- reservas (Hora-Mesa)

### 🔍 Motor de Búsqueda
- Categorias - Por nombre en data table.
- Productos - Por nombre en Tablas (Orden de pedido)
- Mesas - POr nombre en data table
- Meseros - Por nombre, Apellidos, Codigo

### 📱 Multiplataforma
- Web responsive (Tailwind Css)
- API REST para apps móviles,  Forntend Desing
- Exportación de registros a PDF/Excel



## 🛠 Tecnologías Utilizadas

| Backend           | Frontend         | Base de Datos  |
|-------------------|------------------|----------------|
| Laravel 10        | Tailwinds Css    | MySQL 8        |
| Livewire          | Alpine.js        | Redis (Cache)  |
| Php 8.1           | Javascript       |                |


## Diagrma de la Base de datos:
![N|Solid](https://qrscann.maydev.tech/all_images/bigbang/DB_2.jpg)

## 📦 Requisitos del Sistema

- PHP 8.1 o superior
- Composer 2.x
- Node.js 16+
- MySQL 8+
- Servidor web (Apache/Nginx)


## 🚀 Instalación Paso a Paso

1. **Clonar repositorio**
```bash
Desde https:
 https://github.com/maytech76/System-Restaurant.git
 
 Con ClienteGithub:
 gh repo clone maytech76/System-Restaurant

```

### 2. Instalar dependencias...

```sh
composer install
npm install && npm run build
```

### 3 Configuración inicial
```sh
cp .env.example .env
php artisan key:generate
```

### 4 Configurar .ENV (Base de Datos)
```sh
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inmobiliaria_db
DB_USERNAME=root
DB_PASSWORD=tu_contraseña
```

### 5 Ejecutar Migraciones.
```sh
php artisan migrate --seed
```

### 6 Up Server.
```sh
php artisan serve
```

### 7 Ejecutar Servidor Web Vite
```sh
npm run dev
```
## 🛠️ Cómo Contribuir

1. **Haz Fork** del repositorio
2. **Clona** tu fork localmente:
```bash
git remote add origin https://github.com/maytech76/innovar.git -->agregamos el remote Github en  git local
git fetch upstream
 
```

3.**Creas una rama nueva:
```bash
git checkout -b dev2  
```

4.**realiza los cambios y commit:
```bash
git add .
git commit -m "Descripción clara de los cambios"

envia el push:
git push origin mi-contribucion
```

4.Crear un Pull Request (PR)

   > Ve a tu fork en GitHub (github.com/tu-usuario/repositorio)

   > Haz clic en "Compare & Pull Request"

   >  Describe tus cambios y haz clic en "Create Pull Request".



### Estructura del Proyecto

```bash
├── 📁 app/
│   ├── 📁 Http/
│   │   ├── 📁 Controllers/
│   │   │   ├── 🔒 AuthController.php
│   │   │   └── 🏠 CategoryController.php
|   |   |   |-- 🏠 ProductController.php
|   |   |   | 
│   ├── 📁 Models/
│   │   ├── 👤 User.php
│   │   └── 🏡 Category.php
│   │   └── 🏡 Product.php
├── 📁 config/
│   └── 🔐 auth.php
└── 📁 database/
    ├── 🗃️ migrations/
    └── 🌱 seeders/
```

## 📬 Contacto:

¡Siéntete libre de contactarme para preguntas, mejoras o nuevas oportunidades!

<div align="center">
  <a href="https://github.com/maytech76">
    <img src="https://img.shields.io/badge/GitHub-100000?style=for-the-badge&logo=github&logoColor=white" alt="GitHub">
  </a>
  <a href="mailto:admin@maydev.tech">
    <img src="https://img.shields.io/badge/Gmail-D14836?style=for-the-badge&logo=gmail&logoColor=white" alt="Email">
  </a>
  <a href="https://www.linkedin.com/in/marco-antonio-yanez-8664535b/">
    <img src="https://img.shields.io/badge/LinkedIn-0077B5?style=for-the-badge&logo=linkedin&logoColor=white" alt="LinkedIn">
  </a>
</div>

🔗 **Portafolio:** [maydev.tech](https://maydev.tech/portafolio.php)


# Galeria de Iconos :
- 🔐 Seguridad/Autenticación
- 🛡️ Protección
- 📚 Documentación
- 🗃️ Base de datos
- 🔄 Proceso
- ⏳ En progreso
- ✅ Completado
- 📊 Gráficos/Progreso
- 📖 Libro/Docs
- 🔧 Herramientas
- 🏠 Propiedades
- 👤 Usuario
- 🏡 Casa/Propiedad
- 🗂️ Estructura
- 🌱 Seeders
- ✨ Nueva feature
- 💾 Guardar
- 📤 Subir cambios
- 🎯 Objetivo









  
   






