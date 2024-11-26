#!/bin/bash

# Configuración de la base de datos
DB_USER="root"  # Usuario por defecto de XAMPP
DB_PASS=""      # XAMPP no tiene contraseña por defecto
DB_NAME="piza4"
SQL_FILE="piza4.sql"

# Ruta al ejecutable de MySQL en XAMPP
# MYSQL_PATH="/c/xampp-7.4/mysql/bin/mysql"
MYSQL_PATH="/c/xampp/mysql/bin/mysql"

# Colores para los mensajes de salida
GREEN='\033[0;32m'
RED='\033[0;31m'
NC='\033[0m' # Sin Color

# Función para imprimir mensajes con colores
print_message() {
    echo -e "${GREEN}$1${NC}"
}

print_error() {
    echo -e "${RED}$1${NC}"
}

# Verificar si existe el ejecutable de MySQL en XAMPP
if [ ! -f "$MYSQL_PATH" ]; then
    print_error "No se encuentra MySQL en la ruta de XAMPP ($MYSQL_PATH)"
    print_error "Por favor, verifica que XAMPP esté instalado correctamente y que la ruta sea la correcta"
    exit 1
fi

# Verificar si existe el archivo SQL
if [ ! -f "$SQL_FILE" ]; then
    print_error "Error: ¡No se encontró el archivo $SQL_FILE!"
    exit 1
fi

print_message "Iniciando la configuración de la base de datos..."

# Eliminar la base de datos si existe y crear una nueva
"$MYSQL_PATH" -u "$DB_USER" ${DB_PASS:+-p"$DB_PASS"} -e "DROP DATABASE IF EXISTS $DB_NAME; CREATE DATABASE $DB_NAME CHARACTER SET utf8 COLLATE utf8_spanish_ci;"

if [ $? -eq 0 ]; then
    print_message "¡Base de datos $DB_NAME creada exitosamente!"
else
    print_error "¡Error al crear la base de datos!"
    print_error "Asegúrate de que el servicio MySQL de XAMPP esté ejecutándose"
    exit 1
fi

# Importar el archivo SQL
"$MYSQL_PATH" -u "$DB_USER" ${DB_PASS:+-p"$DB_PASS"} "$DB_NAME" < "$SQL_FILE"

if [ $? -eq 0 ]; then
    print_message "¡Importación de la base de datos completada con éxito!"
    print_message "¡Configuración completada! Tu base de datos $DB_NAME está lista para usar."
else
    print_error "¡Error al importar la base de datos!"
    exit 1
fi