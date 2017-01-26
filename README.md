# IEPE-FARUSAC
Este proyecto tiene como finalidad la automatización del proceso de inscripción y evaluación de estudiantes de primer ingreso, a las pruebas específicas de la Facultad de Arquitectura, de la Universidad de San Carlos de Guatemala.

## Ambiente de desarrollo
Este proyecto trae su propio ambiente de desarrollo, no es necesario trabajar con WAMP, XAMP o semejantes. A continuación se describe las caracteristicas generales del ambiente:
- Sistema Operativo: Ubuntu 16.04 LTS
- MariaDB 10.1
- PHP 7
- Apache: 2.4.18
- Laravel 5.2

### Requisitos
Primero revise que tiene instalado:

- [Virtualbox](https://www.virtualbox.org/wiki/Downloads)
- [Vagrant](http://www.vagrantup.com/downloads.html)
- [git](http://git-scm.com/downloads)

### Inicializar ambiente de desarrollo
- Clone repositorio remoto `git clone [url del repositorio]`
- Cambie al directorio del proyecto `cd [directorio de proyecto clonado]`
- Inicialice entorno de desarrollo `vagrant up`, esto descargará máquina virtual
y las dependencias, tomará tiempo, por favor no interrumpir la descarga de lo
contrario su ambiente de desarrollo no funcionará adecuadamente.
- Vagrant iniciara la maquina virtual y puphpet se encargara de provisionarla según la configuracion de puphpet/config.yaml. Cuando este proceso inicie verá algo similar a esto:
```
 ____        ____  _   _ ____      _      generated using
|  _ \ _   _|  _ \| | | |  _ \ ___| |_   ___ ___  _ __ ___
| |_) | | | | |_) | |_| | |_) / _ \ __| / __/ _ \| '_ ` _ \
|  __/| |_| |  __/|  _  |  __/  __/ |_ | (_| (_) | | | | | |
|_|    \__,_|_|   |_| |_|_|   \___|\__(_)___\___/|_| |_| |_|
```
- Al finalizar verá un mensaje similar a esto:
```
  ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
  |  ____                _      _    _                    _  |
  | |  _ \ ___  __ _  __| |    / \  | |__   _____   _____| | |
  | | |_) / _ \/ _` |/ _` |   / _ \ | '_ \ / _ \ \ / / _ \ | |
  | |  _ <  __/ (_| | (_| |  / ___ \| |_) | (_) \ V /  __/_| |
  | |_| \_\___|\__,_|\__,_| /_/   \_\_.__/ \___/ \_/ \___(_) |
  |                                                          |
  ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
```
- Si ve algo diferente es porque falló la instalación, dependiendo del error que le muestre deberá remover el directorio
`.vagrant` y repetir el proceso de inicialización. En ocasiones algun componente ya no se encuentra disponible para sud descarga
en la ruta especificada, por lo que puede continuar con el proceso y descargarlo posteriormente.


### Instalar dependencias de proyecto
- Conectarse por ssh a la máquina virtual (dentro del directorio del proyecto) `vagrant ssh` o con putty utilizando las llaves que están en `puphpet/files/dot/ssh`
- Instalar dependencias locales del proyecto `cd /var/www/public_ftp/iepe && composer update`

## Como utilizar ambiente de desarrollo

### Apagar máquina virtual
Cada vez que necesite apagar la máquina virtual del ambiente de desarrollo, solo
necesita hacer `vagrant halt` desde el directorio del proyecto en la terminal.

### Iniciar máquina virtual
Para encender nuevamente la máquina virtual deberá hacer `vagrant up` en la carpeta
del proyecto.

### Revisar estado de máquina virtual
`vagrant status`

## Base de datos
- Nombre: dbiepe

### Usuario root
- nombre: root
- contraseña: 123

### Usuario app
- nombre: dbApp
- contraseña: 123

## ¿Donde veo los cambios realizados en el backend?
Todos los cambios se pueden revisar desde su navegador en [www.iepe.dev](http://www.iepe.dev)
Si el servidor no responde revisar en la maquina fisica (en linux) el archivo /etc/hosts y agregar la entrada(192.168.56.152 iepe.dev www.iepe.dev) o su equivalente en windows. Tambien pruebe correr el comando: sudo vagrant plugin install vagrant-hostmanager

## Paquetes adicionales
- MySql Adminer, para la administracion de las bases de datos. Se puede acceder a éste desde [192.168.56.52/adminer](http://192.168.56.152/adminer)
- Xdebug, para integrar con PhpStorm, Notepad++, Sublime Text o cual quier otro IDE que lo permita. Para mayor información
visitar [How to configure PHPStorm with Xdebug on vagrant box](http://www.sitepoint.com/install-xdebug-phpstorm-vagrant/),
[Xdebug and You: Why You Should be Using a Real Debugger](https://jtreminio.com/2012/07/xdebug-and-you-why-you-should-be-using-a-real-debugger),

## Despliegue en ambiente de producción

### Prerrequisitos del sistema

- PHP >= 5.5.9
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- GD PHP Extension

### Instalación
Pasos:
1. Dirigirse a la carpeta de apache (en ubuntu `/var/www`)

2. Clonar el repositorio `git clone https://github.com/carpio701021/IEPE-FARUSAC`

3. Ingresar a la carpeta del repositorio `IEPE-FARUSAC/www/iepe/`

4. Dar permisos de escritura (755) a la carpeta `IEPE-FARUSAC/www/iepe/storage` 

    `$ sudo chgrp -R www-data /var/www/html/project`
    
    `$ sudo chmod -R 775 /var/www/html/project/storage`
    
5. Correr el comando `composer install`

6. Correr el comando `php artisan key:generate`

7. Editar archivos de configuración en `www/iepe/.env`, si no existe puede utilizar como base el .env.example


### Base de datos
- Para la creación de la base de datos usar `php artisan migrate`
- Para utilizar la data de prueba corra el script `php artisan migrate --seed`
- O puede restablecer un backup de la base de datos.

### Configuraciónes finales
- Para establecer las pantallas de inicio ingrese a su navegador a
`hostconfigurado.com/aspirantes/admin/recursos`.
