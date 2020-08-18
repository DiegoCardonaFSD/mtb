## Plataforma MTB - Ecommerce

La plataforma que realicé, es una plataforma donde el cliente de MTB, puede entrar a mi sitio y ver la bicicleta que estoy ofreciendo en el momento, hay algunas fotos, una amplia descripción y un boton para comprar ahora.

Para esta plataforma decidí que registrarse es obligatorio antes de hacer la compra, esto con el fin de hacer uso de las migraciones, usar auth, y poder poner configurar diferentes relaciones en los modelos.

Una vez el usuario se registra, ingresa a un proceso de checkout, que consta de 3 pasos:
1. En el primero se solicita la información personal para hacer la orden (decidi pedirle todos los campos necesarios, para que Place To Pay nos lleve directamente, a la parte donde se ingresan los datos de tarjeta de crédito.).
2. Se muestra una pantalla donde el usuario puede verificar sus datos, editarlos o continuar el proceso al tercer paso.
3. Inicio proceso en Place To Pay para realizar el pago.

En esta plataforma podemos ver el listado de órdenes que hemos creado, independiente del estado que tengan, cabe anotar que los usuarios que son creados de manera autónoma por el formulario de registro, todos quedan en nuestra plataforma con el rol cliente,  de momento tenemos un único administrador, cuyo objetivo es poder ver todas las órdenes que se han realizado en el sistema, para acceder a esta sección bascan con dar click en la opción Área de miembros.

Una vez ingresamos al área de miembros, vamos a poder interactuar de diferente manera con las órdenes que hay allí registradas, vamos a poder registrar nuevas órdenes, editar, ver o eliminar,  todo dependiendo del estado en el que se encuentre la orden.

Como es usual  la mayoría de los usuarios que van a la pasarela de pagos, despues de realizar el pago, no vuelven al sitio, para ello creé una tarea programada que se encarga de esar verificando el estado de las órdenes pendientes de modo que podamos tener el estado de las órdenes actualizado.


### Algunos de los conceptos que apliqué en esta plaforma fueron:

- TDD: tengo varias  clases en el folder de tests para pruebas unitarias, donde me enfoqué de manera didáctica en validar los diferentes métodos que tengo en los controladores, estas puebas fueron configuradas para hacerse en sqlite en memoria.

- En la base de datos, utilice las migraciones, los factory y los seeders, para toda la manipulacion de datos, y creación de datos de prueba.

- En toda la plataforma estoy usando el archivo de traducciones, configuré la localización en America/Bogota y en Español, de este modo dejé preparada la plataforma para el momento en que tengamos que volverla multi-idioma.

- Para las vistas uitlicé blade y tambien instalé la dependencia de Laravel/Collective para la manipulación de los formularios.

- En la mayoría de los casos utilcé los controladores estandar, en muchas otras prefierí crear métodos personalizados haciendo uso de rutas individuales, o de rutas genéricas.

- para el consumo del api de Place to Pay, lo hice a través de un adaptador, pensando en que a futuro pueden haber mas opciones y pensando siempre en tener las responsabilidades a nivel de código mas divididas.

- Para el consumo del api, lo hice a traves de curl (ya que fue con el que hice el test para el api, de modo que me queria familiarizar antes, y por cuestiones de tiempo no me dió para implementar algo así como Guzzle).

- Siempre parto de la base de tener un código limpio, aunque a veces el tener un código limpio, implica tener mucho conocimiento a la hora de un desarrollador poder entrar a modificarlo, sin embargo, hice varios ciclos de refactorización al código.

- También hice uso de un Request personalizado, donde implementé las validaciones de mis formularios.

- El formulario se usa como un partial desde varias vistas,  con el fin único de centralizar el manejo de éste, simplificando los puntos de contacto a la hora de hacer modificaciones.

- A nivel de git, utilicé la rama master que viene por defecto, pero hice todo mi desarrollo en la rama develop, que es como usalmente me gusta realizarlo, solo voy a master cuando tengo una versión estable para producción.

## Instrucciones de instalación

Hasta el momento, la configuración se hace de manera estandar como todas las aplicaciones de Laravel.

1. se clona el repositorio.
2. se ejecuta el comando composer install, para instalar todas las dependiencias del proyecto.
3. se configura el archivo .env, con todas las variables de entorno que se utilizaron en el desarrollo.
- En este punto es importante crear una base de datos en mysql con su respectivo usuario.
- Le damos un título adecuado a la plataforma.
- organizamos las variables de entorno:
PLACE_TO_PAY_LOGIN="" //se coloca el login del entorno a conectar
PLACE_TO_PAY_SECRET_KEY="" //se coloca la clave secreta
PLACE_TO_PAY_EXPIRATION_MINUTES=10 //tiempo de expiración de la transacción, por motivo de pruebas lo puse en 10 minutos
PLACE_TO_PAY_CURRENCY="COP" //moneda por defecto peso Colombiano
PLACE_TO_PAY_DEFAULT_LOCALE="es_CO" //localización por defecto Español Colombia
PLACE_TO_PAY_RETURN_URL="http://...../payment/return/" se coloca el dominio donde de momento vamos a recibir el retorno cuando el usuario regrese de la pasarela a nuestra tienda.
PLACE_TO_PAY_CANCEL_URL="http://...../payment/return/"
PLACE_TO_PAY_SERVICE_URL="https://test.placetopay.com/redirection/api/session" //url del servicio que vamos a consumir

- esto lo hacemos para no hardcodear estos estados en el código
ORDER_STATUS_PROCESSING="PROCESSING"
ORDER_STATUS_APPROVED="APPROVED"
ORDER_STATUS_ENDED="ENDED"
ORDER_STATUS_PAYED="PAYED"
ORDER_STATUS_CREATED="CREATED"
ORDER_STATUS_REJECTED="REJECTED"
ORDER_STATUS_NEW="NEW"

Ejecutamos las migraciones + los seeders 
php artisan migrate
php artisan db:seed

De momento estas son las instrucciones de instalación.

Feliz Dia!

DiegoCardona









