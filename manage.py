#!/usr/bin/env python3
"""
Script de gestión para el proyecto CodeIgniter con Docker
Autor: Sistema de Gestión
"""

import subprocess
import sys
import time
import os

# Colores para la terminal
class Colors:
    HEADER = '\033[95m'
    OKBLUE = '\033[94m'
    OKCYAN = '\033[96m'
    OKGREEN = '\033[92m'
    WARNING = '\033[93m'
    FAIL = '\033[91m'
    ENDC = '\033[0m'
    BOLD = '\033[1m'

def print_header(text):
    """Imprime un encabezado decorado"""
    print(f"\n{Colors.HEADER}{Colors.BOLD}{'='*60}{Colors.ENDC}")
    print(f"{Colors.HEADER}{Colors.BOLD}{text.center(60)}{Colors.ENDC}")
    print(f"{Colors.HEADER}{Colors.BOLD}{'='*60}{Colors.ENDC}\n")

def print_success(text):
    """Imprime mensaje de éxito"""
    print(f"{Colors.OKGREEN}[OK] {text}{Colors.ENDC}")

def print_error(text):
    """Imprime mensaje de error"""
    print(f"{Colors.FAIL}[ERROR] {text}{Colors.ENDC}")

def print_info(text):
    """Imprime mensaje informativo"""
    print(f"{Colors.OKCYAN}[INFO] {text}{Colors.ENDC}")

def print_warning(text):
    """Imprime mensaje de advertencia"""
    print(f"{Colors.WARNING}[AVISO] {text}{Colors.ENDC}")

def run_command(command, show_output=True):
    """Ejecuta un comando del sistema"""
    try:
        if show_output:
            result = subprocess.run(command, shell=True, check=True)
        else:
            result = subprocess.run(command, shell=True, check=True, 
                                   stdout=subprocess.PIPE, stderr=subprocess.PIPE)
        return True
    except subprocess.CalledProcessError as e:
        print_error(f"Error al ejecutar: {command}")
        return False

def check_docker():
    """Verifica si Docker está instalado y corriendo"""
    print_info("Verificando Docker...")
    
    # Verificar si docker está instalado
    result = subprocess.run("docker --version", shell=True, 
                          stdout=subprocess.PIPE, stderr=subprocess.PIPE)
    if result.returncode != 0:
        print_error("Docker no está instalado")
        return False
    
    # Verificar si docker está corriendo
    result = subprocess.run("docker info", shell=True, 
                          stdout=subprocess.PIPE, stderr=subprocess.PIPE)
    if result.returncode != 0:
        print_error("Docker no está corriendo. Inicia el servicio con: sudo systemctl start docker")
        return False
    
    print_success("Docker está instalado y corriendo")
    return True

def start_project():
    """Inicia el proyecto"""
    print_header("INICIANDO PROYECTO")
    
    if not check_docker():
        return
    
    print_info("Iniciando contenedores...")
    if run_command("docker compose up -d"):
        print_success("Contenedores iniciados correctamente")
        
        # Esperar a que MySQL esté listo
        print_info("Esperando a que MySQL esté listo...")
        time.sleep(5)
        
        # Crear tabla si no existe
        print_info("Verificando tabla de alumnos...")
        sql = "CREATE TABLE IF NOT EXISTS alumnos (id INT AUTO_INCREMENT PRIMARY KEY, nombre VARCHAR(100) NOT NULL, apellido VARCHAR(100) NOT NULL, telefono VARCHAR(20));"
        if run_command(f"docker exec -i ci_mysql mysql -uroot -proot crud -e \"{sql}\"", show_output=False):
            print_success("Tabla de alumnos verificada/creada")
        
        print("\n" + "="*60)
        print(f"{Colors.OKGREEN}{Colors.BOLD}PROYECTO INICIADO CORRECTAMENTE{Colors.ENDC}")
        print("="*60)
        print(f"\n{Colors.BOLD}Accede a:{Colors.ENDC}")
        print(f"  • Aplicación:    {Colors.OKCYAN}http://localhost:8080{Colors.ENDC}")
        print(f"  • Alumnos:       {Colors.OKCYAN}http://localhost:8080/alumnos{Colors.ENDC}")
        print(f"  • PHPMyAdmin:    {Colors.OKCYAN}http://localhost:8081{Colors.ENDC}")
        print(f"\n{Colors.BOLD}Credenciales PHPMyAdmin:{Colors.ENDC}")
        print(f"  • Usuario: {Colors.WARNING}root{Colors.ENDC}")
        print(f"  • Contraseña: {Colors.WARNING}root{Colors.ENDC}\n")
    else:
        print_error("Error al iniciar los contenedores")

def stop_project():
    """Detiene el proyecto"""
    print_header("DETENIENDO PROYECTO")
    
    print_info("Deteniendo contenedores...")
    if run_command("docker compose down"):
        print_success("Contenedores detenidos correctamente")
    else:
        print_error("Error al detener los contenedores")

def restart_project():
    """Reinicia el proyecto"""
    print_header("REINICIANDO PROYECTO")
    
    print_info("Reiniciando contenedores...")
    if run_command("docker compose restart"):
        print_success("Contenedores reiniciados correctamente")
        print_info(f"Accede a: {Colors.OKCYAN}http://localhost:8080/alumnos{Colors.ENDC}")
    else:
        print_error("Error al reiniciar los contenedores")

def show_status():
    """Muestra el estado de los contenedores"""
    print_header("ESTADO DEL PROYECTO")
    
    print_info("Estado de los contenedores:")
    run_command("docker compose ps")

def show_logs():
    """Muestra los logs de los contenedores"""
    print_header("LOGS DEL PROYECTO")
    
    print_info("Mostrando logs (presiona Ctrl+C para salir)...")
    try:
        run_command("docker compose logs -f")
    except KeyboardInterrupt:
        print("\n")
        print_info("Saliendo de los logs...")

def rebuild_project():
    """Reconstruye los contenedores"""
    print_header("RECONSTRUYENDO PROYECTO")
    
    print_warning("Esto detendrá los contenedores y los reconstruirá")
    confirm = input(f"{Colors.WARNING}¿Estás seguro? (s/n): {Colors.ENDC}").lower()
    
    if confirm == 's':
        print_info("Deteniendo contenedores...")
        run_command("docker compose down")
        
        print_info("Reconstruyendo contenedores...")
        if run_command("docker compose up -d --build"):
            print_success("Contenedores reconstruidos correctamente")
            
            # Esperar y crear tabla
            time.sleep(5)
            sql = "CREATE TABLE IF NOT EXISTS alumnos (id INT AUTO_INCREMENT PRIMARY KEY, nombre VARCHAR(100) NOT NULL, apellido VARCHAR(100) NOT NULL, telefono VARCHAR(20));"
            run_command(f"docker exec -i ci_mysql mysql -uroot -proot crud -e \"{sql}\"", show_output=False)
            
            print_success("Proyecto listo")
            print_info(f"Accede a: {Colors.OKCYAN}http://localhost:8080/alumnos{Colors.ENDC}")
    else:
        print_info("Operación cancelada")

def show_menu():
    """Muestra el menú principal"""
    print_header("GESTOR DE PROYECTO - CodeIgniter Docker")
    print(f"{Colors.BOLD}Selecciona una opción:{Colors.ENDC}\n")
    print(f"  {Colors.OKGREEN}1.{Colors.ENDC} Iniciar proyecto")
    print(f"  {Colors.FAIL}2.{Colors.ENDC} Detener proyecto")
    print(f"  {Colors.WARNING}3.{Colors.ENDC} Reiniciar proyecto")
    print(f"  {Colors.OKCYAN}4.{Colors.ENDC} Ver estado")
    print(f"  {Colors.OKBLUE}5.{Colors.ENDC} Ver logs")
    print(f"  {Colors.WARNING}6.{Colors.ENDC} Reconstruir contenedores")
    print(f"  {Colors.FAIL}0.{Colors.ENDC} Salir\n")

def main():
    """Función principal"""
    while True:
        show_menu()
        choice = input(f"{Colors.BOLD}Opción: {Colors.ENDC}").strip()
        
        if choice == '1':
            start_project()
        elif choice == '2':
            stop_project()
        elif choice == '3':
            restart_project()
        elif choice == '4':
            show_status()
        elif choice == '5':
            show_logs()
        elif choice == '6':
            rebuild_project()
        elif choice == '0':
            print_info("Hasta luego!")
            sys.exit(0)
        else:
            print_error("Opcion no valida")
        
        input(f"\n{Colors.BOLD}Presiona Enter para continuar...{Colors.ENDC}")
        os.system('clear' if os.name == 'posix' else 'cls')

if __name__ == "__main__":
    try:
        main()
    except KeyboardInterrupt:
        print(f"\n\n{Colors.WARNING}Operación cancelada por el usuario{Colors.ENDC}")
        sys.exit(0)
