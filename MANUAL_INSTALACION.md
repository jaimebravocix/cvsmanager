# Manual de Instalación y Configuración
## Sistema de Administración de CVs - Personal Universitario

## REQUISITOS
- PHP 8.2+
- Composer 2.x
- PostgreSQL 14+
- Node.js 18+
- Visual Studio Code

## PASO 1 — Descomprimir y Abrir en VS Code
```
unzip docente-cv.zip -d C:\proyectos\
cd C:\proyectos\docente-cv
code .
```

## PASO 2 — Crear Base de Datos PostgreSQL
En pgAdmin o terminal psql:
```sql
CREATE DATABASE docente_cv WITH ENCODING='UTF8' TEMPLATE template0;
CREATE USER cv_user WITH PASSWORD 'cv_password_seguro';
GRANT ALL PRIVILEGES ON DATABASE docente_cv TO cv_user;
```
CREATE USER dbcvuser WITH PASSWORD 'Ronibrami1409';
GRANT ALL PRIVILEGES ON DATABASE cvsmanager TO dbcvuser;


## PASO 3 — Configurar .env
```
cp .env.example .env
```
Editar .env:
```
APP_NAME="CV Docente Universitario"
APP_URL=http://localhost:8000
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=docente_cv
DB_USERNAME=cv_user
DB_PASSWORD=cv_password_seguro
```

## PASO 4 — Instalar Dependencias
```
composer install
php artisan key:generate
```

## PASO 5 — Migraciones y Seeders
```
php artisan migrate
php artisan db:seed
```

## PASO 6 — Almacenamiento
```
php artisan storage:link
```

## PASO 7 — Iniciar servidor
```
php artisan serve
```
Abrir: http://localhost:8000

## CREDENCIALES DE ACCESO (DEMO)
| Rol            | Email                           | Contraseña  |
|----------------|---------------------------------|-------------|
| administrador  | admin@universidad.edu           | Admin@1234  |
| supervisor     | supervisor@universidad.edu      | Super@1234  |
| docente        | docente@universidad.edu         | Doc@1234    |
| administrativo | administrativo@universidad.edu  | Adm@1234    |

## EXTENSIONES VS CODE RECOMENDADAS
- PHP Intelephense
- Laravel Blade Snippets
- PostgreSQL
- GitLens

## ESTRUCTURA DE TABLAS (22 tablas)
- personas: Datos personales completos
- documentos_identidad: DNI, Pasaporte, Carnet
- direcciones: Domicilio y trabajo
- emails_persona: Correos personales e institucionales
- regimen_pensionario: ONP/AFP con CUSPP
- cuentas_haberes: Banco, cuenta, CCI
- documentos_salud: Exámenes, seguros
- antecedentes: Penal, judicial, policial, REDAM
- formacion_academica: Doctorados, maestrías, cursos
- experiencia_docente: Categoría, régimen, asignatura
- experiencia_profesional: Cargo, institución
- certificaciones_idioma: TOEFL, DELF, niveles A1-C2
- registros_institucionales: RENACYT, CIP, SUNEDU
- produccion_cientifica: Artículos, libros, patentes
- produccion_bibliografica: Textos universitarios
- produccion_investigacion: Proyectos con financiamiento
- congresos: Nombre, tipo, horas, temática, certificado
- reconocimientos: Premios, distinciones
- licencias_profesionales: Colegiatura CIP, etc.
- membresias: IEEE, ACM, etc.
- roles / permissions (Spatie)

## ROLES Y PERMISOS
- administrador: Acceso total + gestión de usuarios
- supervisor: Ve y edita todos los CVs
- docente: Solo su propio CV
- administrativo: Solo su perfil (acceso restringido)

## PRODUCCIÓN - Permisos Linux
```
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## SOLUCIÓN DE PROBLEMAS
- Error conexión BD: Verificar PostgreSQL activo y datos en .env
- Class not found: composer dump-autoload
- Archivos no visibles: php artisan storage:link
- Permisos storage: chmod -R 777 storage bootstrap/cache
