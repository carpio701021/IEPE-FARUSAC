
Conversación abierta. 3 mensajes. Todos los mensajes leídos.

Ir al contenido
Uso de Correo de Facultad de Ingeniería, USAC con lectores de pantalla
Buscar


jodaches@gmail.com 

Correo
REDACTAR
Etiquetas
Recibidos (8)
Destacados
Importantes
Chats
Enviados
Borradores
Categorías
Social
Promociones (3)
Notificaciones
Foros
Más 
Hangouts

 
 
 
Mover a Recibidos Más 
38 de unas 82  
 
Ocultar todos Imprimir todo En una ventana nueva
Actualización SAPE 
Recibidos
x 

Jose Chavarria <jodaches@gmail.com>
Archivos adjuntos5 abr.

para Oscar, José, mí, Carlos 
Buenos días, quería comentarles que ya están disponibles nuevos cambios para la plataforma de primer ingreso, van incluidos la calificación con percentiles diferentes para cada carrera, también que el resultado que se muestra al estudiante se hace de forma general y no detallado.

Instrucciones para publicar los cambios:

1. En la raíz del proyecto ejecutar "git pull origin master"
2. En la raíz del proyecto ejecutar "php artisan migrate"
3. Crear en la base de datos el procedimiento "resumenCalificacion" (adjunto script)

Por último quedaría validar que efectivamente los cambios han sido aplicados y cumplen satisfactoriamente su funcionalidad.

Quedamos a la espera de cualquier duda o comentario, saludos

José Chavarría
Zona de los archivos adjuntos

Carlos Lozano <carlos.lozano@farusac.edu.gt>
5 abr.

para Jose, Oscar, José, mí 
Enterado.

Gracias.


José Victor Tobias Romero <jose.tobias@farusac.edu.gt>
11 abr.

para Jose, Oscar, mí 
Buen día a todos,

Les comento que los cambios ya fueron aplicados, por favor verificar que este funcionando correctamente y cualquier inconveniente me pueden informar por este medio.

Saludos,

	
Haz clic aquí para responder, responder a todos o reenviar
3,8 GB en uso
Administrar
Política del programa
Con la tecnología de Google
Última actividad de la cuenta: hace 1 hora
Información detallada
Usuarios (4)
Foto de perfil de Daniel Chavarria
Daniel Chavarria
Usac

Mostrar detalles

DROP PROCEDURE IF EXISTS resumenCalificacion;
DELIMITER //
CREATE PROCEDURE resumenCalificacion(pAplicacion_id INT)
BEGIN

SELECT ash.aplicacion_id,

SUM(IF(carrera = 'diseño' AND resultado = 'aprobado',1,0)) as aprobados_disenio, 
SUM(IF(carrera = 'diseño' AND resultado = 'reprobado',1,0)) as reprobados_disenio, 

SUM(IF(carrera = 'arquitectura' AND resultado = 'aprobado',1,0)) as aprobados_arquitectura, 
SUM(IF(carrera = 'arquitectura' AND resultado = 'reprobado',1,0)) as reprobados_arquitectura,

SUM(IF(carrera = 'arquitectura' AND nota_RA>=percentil_RA,1,0)) as aprobados_RA, 
SUM(IF(carrera = 'arquitectura' AND nota_APE>=percentil_APE,1,0)) as aprobados_APE, 
SUM(IF(carrera = 'arquitectura' AND nota_RV>=percentil_RV,1,0)) as aprobados_RV, 
SUM(IF(carrera = 'arquitectura' AND nota_APN>=percentil_APN,1,0)) as aprobados_APN, 

SUM(IF(carrera = 'arquitectura' AND nota_RA<percentil_RA,1,0)) as reprobados_RA, 
SUM(IF(carrera = 'arquitectura' AND nota_APE<percentil_APE,1,0)) as reprobados_APE, 
SUM(IF(carrera = 'arquitectura' AND nota_RV<percentil_RV,1,0)) as reprobados_RV, 
SUM(IF(carrera = 'arquitectura' AND nota_APN<percentil_APN,1,0)) as reprobados_APN, 


SUM(IF(carrera = 'diseño' AND nota_RA>=percentil_RA_disenio,1,0)) as aprobados_RA_disenio, 
SUM(IF(carrera = 'diseño' AND nota_APE>=percentil_APE_disenio,1,0)) as aprobados_APE_disenio, 
SUM(IF(carrera = 'diseño' AND nota_RV>=percentil_RV_disenio,1,0)) as aprobados_RV_disenio, 
SUM(IF(carrera = 'diseño' AND nota_APN>=percentil_APN_disenio,1,0)) as aprobados_APN_disenio, 

SUM(IF(carrera = 'diseño' AND nota_RA<percentil_RA_disenio,1,0)) as reprobados_RA_disenio, 
SUM(IF(carrera = 'diseño' AND nota_APE<percentil_APE_disenio,1,0)) as reprobados_APE_disenio, 
SUM(IF(carrera = 'diseño' AND nota_RV<percentil_RV_disenio,1,0)) as reprobados_RV_disenio, 
SUM(IF(carrera = 'diseño' AND nota_APN<percentil_APN_disenio,1,0)) as reprobados_APN_disenio

FROM aspirantes_aplicaciones a
JOIN formularios f ON f.NOV = a.aspirante_id
JOIN aplicaciones_salones_horarios ash ON ash.id = a.aplicacion_salon_horario_id
JOIN aplicaciones ap ON ap.id = ash.aplicacion_id
WHERE ap.id = pAplicacion_id;

END

// DELIMITER ;