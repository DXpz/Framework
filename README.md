# CRUD de Alumnos - CodeIgniter 4

Sistema de gestión de alumnos desarrollado con CodeIgniter 4, Docker y MySQL.

## Características

- CRUD completo de alumnos (Crear, Leer, Actualizar)
- Diseño minimalista y responsive
- Arquitectura con Docker para fácil despliegue
- Base de datos MySQL
- PHPMyAdmin incluido para administración

## Tecnologías

- **Framework:** CodeIgniter 4.6.4
- **PHP:** 8.2
- **Base de Datos:** MySQL 8.0
- **Contenedores:** Docker & Docker Compose
- **Gestión BD:** PHPMyAdmin

## Requisitos

- Docker
- Docker Compose

## Instalación

1. Clonar el repositorio:
```bash
git clone https://github.com/DXpz/Framework.git
cd Framework
```

2. Levantar los contenedores:
```bash
docker-compose up -d
```

3. Esperar unos segundos mientras MySQL se inicializa

4. Acceder a la aplicación:
- **CRUD:** http://localhost:8080/alumnos
- **Home:** http://localhost:8080
- **PHPMyAdmin:** http://localhost:8081

## Estructura de la Base de Datos

### Tabla: alumnos

| Campo | Tipo | Descripción |
|-------|------|-------------|
| id | INT | ID único (auto-increment) |
| nombre | VARCHAR(100) | Nombre del alumno |
| apellido | VARCHAR(100) | Apellido del alumno |
| telefono | VARCHAR(20) | Teléfono de contacto |
| created_at | TIMESTAMP | Fecha de creación |
| updated_at | TIMESTAMP | Fecha de actualización |

## Credenciales de Base de Datos

- **Base de datos:** crud
- **Usuario:** crud_user
- **Contraseña:** crud_pass
- **Host:** mysql (dentro de Docker) o localhost:3306 (desde host)

## PHPMyAdmin

- **URL:** http://localhost:8081
- **Usuario:** root
- **Contraseña:** root

## Comandos Útiles

### Detener contenedores
```bash
docker-compose down
```

### Ver logs
```bash
docker logs ci_php
docker logs ci_mysql
docker logs ci_phpmyadmin
```

### Reiniciar contenedores
```bash
docker-compose restart
```

### Eliminar todo (incluida la base de datos)
```bash
docker-compose down -v
```

## Rutas Disponibles

- `GET /alumnos` - Lista todos los alumnos
- `GET /alumnos/create` - Formulario para crear alumno
- `POST /alumnos/create` - Guardar nuevo alumno
- `GET /alumnos/edit/{id}` - Formulario para editar alumno
- `POST /alumnos/edit/{id}` - Actualizar alumno existente

## Desarrollo

El proyecto usa un router personalizado para URLs limpias con el servidor PHP built-in dentro de Docker.

### Estructura de Archivos Principales

```
├── app/
│   ├── Controllers/
│   │   └── Alumnos.php
│   ├── Models/
│   │   └── AlumnoModel.php
│   └── Views/
│       └── alumnos/
│           ├── index.php
│           ├── create.php
│           └── edit.php
├── docker-compose.yml
├── Dockerfile
└── router.php
```

## Licencia

MIT License
