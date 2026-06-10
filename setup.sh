#!/bin/bash
echo "======================================="
echo "  CV Docente Universitario - Setup"
echo "======================================="
echo ""
echo "[1/6] Copiando .env..."
cp .env.example .env

echo "[2/6] Instalando dependencias PHP..."
composer install --no-interaction --prefer-dist

echo "[3/6] Generando clave de aplicación..."
php artisan key:generate --force

echo "[4/6] Ejecutando migraciones..."
php artisan migrate --force

echo "[5/6] Ejecutando seeders..."
php artisan db:seed --force

echo "[6/6] Creando enlace de storage..."
php artisan storage:link

echo ""
echo "======================================="
echo "  Instalación completada!"
echo "  Ejecute: php artisan serve"
echo "  URL: http://localhost:8000"
echo "======================================="
