# Gestor de Tareas - Netberry

## Descripción

Aplicación de gestión de tareas desarrollada con Laravel.

Funcionalidades implementadas:

- Crear tareas.
- Eliminar tareas.
- Asignar múltiples categorías a cada tarea.
- Filtrar tareas por una o varias categorías.
- Interfaz dinámica mediante peticiones AJAX (Axios), sin recarga de página.
- Interfaz responsive desarrollada con Bootstrap 5.

---

## Tecnologías utilizadas

- PHP 8.2
- Laravel 10
- MySQL 8
- Docker
- Bootstrap 5
- Axios
- Vite

---

## Instalación

# Proyecto Laravel + Docker

## Opción 1: Windows + WSL + Docker Desktop (Recomendada en Windows)

Para trabajar en Windows se recomienda utilizar **WSL 2** con una distribución **Ubuntu** y **Docker Desktop** para evitar que la manera en la que interactúa Docker con el sistema de archivos de Windows afecte negativamente al rendimiento.


### Instalar Ubuntu

Desde Microsoft Store instalar la distribución **Ubuntu** y completar la configuración inicial (usuario y contraseña).
Se puede encontrar en el siguiente enlace (o en la propia Microsoft Store):

#### Ubuntu para Windows:
https://apps.microsoft.com/detail/9PDXGNCFSCZV?hl=neutral&gl=ES&ocid=pdpshare

#### Pasar WSL a WSL2

Probablemente, tras la instalación de Ubuntu desde la Microsoft Store, tengamos WSL en su versión 1.
Para utilizar Docker Desktop es necesario que esté en la versión 2.

En primer lugar, comprobaremos la versión instalada ejecutando en PowerShell:

```powershell
wsl -l -v
```

Se nos mostrará algo como esto:
```powershell
NAME                 STATE           VERSION
Ubuntu2.1            Running         1
```

Si en la columna VERSION de la distribución llamada Ubuntu (también puede llamarse Ubuntu2.1 o similares) aparece 2, habremos terminado. Sin embargo, si aparece un 1, debemos ejecutar:

```powershell
wsl --set-version Ubuntu 2
```
IMPORTANTE: En lugar de Ubuntu, en el comando anterior hay que poner el nombre completo que aparece en la columna NAME.

Este proceso puede tomar varios minutos.



### Instalar Docker Desktop

Instalar Docker Desktop y asegurarse de que:

* Está habilitada la integración con WSL 2.
    * Para esto, vaya a ajustes de Docker Desktop: **Settings → Resources → General**  y seleccione la opción WSL2 bajo el texto "Choose how to run Docker containers" (o una opción similar dependiendo de la versión de Docker Desktop).
* La distribución Ubuntu aparece habilitada
    * Para esto, vaya a ajustes de Docker Desktop: y habilite el switch en la sección de Ubuntu en **Settings → Resources → WSL Integration**.

Se puede encontrar en el siguiente enlace (o en la propia Microsoft Store):
#### Docker Desktop para Windows
https://apps.microsoft.com/detail/XP8CBJ40XLBWKX?hl=es-ES&gl=ES&ocid=pdpshare

Una vez configurado todo, para abrir la consola de Ubuntu, simplemente abra el programa llamado "Ubuntu" desde el Inicio de Windows.

Nota: Para poder clonar el repositorio, si no se tiene Git instalado, se debe realizar:

```bash
sudo apt update
sudo apt install git
```

Clone el repositorio ejecutando:
```bash
git clone https://github.com/LauDaphne/netberry.git
```

Nota: Si fuera necesario, instale make en su distribución de Ubuntu/Linux usando
```bash
sudo apt update
sudo apt install make
```

Dentro de la carpeta del proyecto, ejecute el siguiente comando:

```bash
cd netberry
make install
```

Durante la instalación se le pedirá que introduzca los datos de configuración de la base de datos.


### Actualización de WSL

Es posible que, dependiendo de la versión de Windows utilizada, Docker Desktop le solicite actualizar wsl.

Para ello debe ejecutar en PowerShell:

```powershell
wsl --update
```

Reiniciar el equipo si Windows lo solicita.

> **Importante 1**
>
> Es posible que requiera activar características de su equipo. En la barra de búsqueda de Windows introduzca "Activar o desactivar las características de Windows".
> Luego, asegúrese de que tiene marcadas las siguientes opciones:
> * Subsistema de Windows para Linux
> * Plataforma de máquina virtual
> * Hyper-V (opcional).

> **Importante 2**
>
> Se recomienda guardar el proyecto dentro del sistema de archivos de Ubuntu (por ejemplo `~/projects/netberry-tasks`) y no en `C:\...`, ya que el rendimiento de Docker es considerablemente mejor.


---


## Opción 2: Ubuntu (Linux)

Es necesario tener instalado:

* Git
* Docker Engine
* Docker Compose
* Make


### Instalación de los requisitos:

### Git

```bash
sudo apt update
sudo apt install git
```

### Docker Engine y Docker Compose

Se recomienda seguir la guía oficial de Docker para Ubuntu:

https://docs.docker.com/engine/install/ubuntu/

Tras la instalación, verifica que Docker y Docker Compose están disponibles:

```bash
docker --version
docker compose version
```

> **Nota:** En las versiones actuales de Docker, `docker compose` viene incluido como un subcomando de Docker, por lo que no es necesario instalar `docker-compose` por separado.

#### Make

```bash
sudo apt update
sudo apt install make
```

## Instalación del proyecto

Una vez instalados los requisitos, clonar el repositorio:

```bash
git clone https://github.com/LauDaphne/netberry.git
```
Ejecutar el siguiente comando desde dentro de la carpeta del proyecto:

```bash
cd netberry
make install
```

---

## Explicación de Instalación automática (Linux / WSL)

El comando `make install` realiza automáticamente las siguientes tareas:

* Genera el archivo `.env`.
* Solicita las credenciales de la base de datos.
* Levanta los contenedores Docker.
* Espera a que MySQL esté disponible.
* Ajusta los permisos de Laravel.
* Instala las dependencias de Composer.
* Genera la `APP_KEY`.
* Ejecuta las migraciones.
* Ejecuta los seeders.
* Instala las dependencias de Node.
* Compila los assets.

---

## Instalación en Windows sin Ubuntu

Si se desea usar Windows sin instalar Ubuntu tenga en cuenta que el rendimiento puede ser inferior debido a cómo interactúa Docker con el sistema de archivos de Windows.

Aún así, es necesario Docker Desktop. Puede consultar cómo instalarlo en la opción 1.
### 1. Crear el archivo de configuración

Copiar el archivo de ejemplo llamado .env.example en un nuevo archivo llamado .env

---

### 2. Configurar la base de datos

Editar el archivo `.env` y configurar las siguientes variables (puede utilizar el valor que usted desee):

```dotenv
DB_DATABASE=netberry
DB_USERNAME=netberryUser
DB_PASSWORD=ntbrryUserP455
DB_ROOT_PASSWORD=ntbrryRootP455
```

---

### 3. Levantar los contenedores

```bash
docker compose up -d
```

---

### 4. Instalar las dependencias PHP

```bash
docker compose exec php composer install
```
Nota: Antes de realizar este paso es necesario que el servicio de MySQL esté listo y activo para recibir peticiones, lo que puede tardar entre 5 y 30 segundos aproximadamente.


---

### 5. Generar la clave de Laravel

```bash
docker compose exec php php artisan key:generate
```

---

### 6. Ejecutar las migraciones

```bash
docker compose exec php php artisan migrate
```

---

### 7. Ejecutar los seeders

```bash
docker compose exec php php artisan db:seed
```

---

### 8. Instalar las dependencias de Node

```bash
docker compose exec node npm install
```

---

### 9. Compilar los assets

```bash
docker compose exec node npm run build
```

---

## Puesta en marcha

Una vez finalizada la instalación, los contenedores permanecerán ejecutándose en segundo plano.

Para iniciar el proyecto en futuras ocasiones:

```bash
docker compose up -d
```

Para detenerlo:

```bash
docker compose down
```
Eliminación de contenedores y volúmenes (permanente):

```bash
docker compose down -v
```

---

## Estructura del proyecto

El proyecto sigue una arquitectura **MVC** complementado con **Services**.

La estructura principal es:

- Controllers
- Services
- Form Requests
- Models
- Blade Partials
- Módulos JavaScript

---

## Aspectos técnicos destacados

- Uso de **Axios** para realizar peticiones AJAX sin recargar la página.
- Validaciones mediante **Form Requests**.
- Lógica de negocio encapsulada en **Services**.
- Consultas mediante **Eloquent** con **eager loading** para evitar el problema **N+1**.
- Filtrado por múltiples categorías utilizando relaciones de Eloquent.
- Componentes Blade reutilizables para mejorar el mantenimiento del código.

---
