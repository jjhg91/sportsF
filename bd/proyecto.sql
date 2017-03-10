create database proyecto

use proyecto

create table pais(
id_pais int auto_increment not null,
pais varchar(50)not null,
constraint pk_pai primary key(id_pais));

create table zonahoraria(
id_zhoraria int auto_increment not null,
zonahoraria time not null,
ciudad varchar (20) not null,
constraint pk_zh primary key(id_zhoraria));

create table postal(
id_postal int auto_increment not null,
c_postal int not null,
constraint pk_p primary key(id_postal));

create table nombre(
id_nombre int auto_increment not null,
nombre varchar(50)not null,
constraint pk_no primary key(id_nombre));

create table apellido(
id_apellido int auto_increment not null,
apellido varchar(50)not null,
constraint pk_ap primary key(id_apellido));

create table natalidad(
id_natalidad int auto_increment not null,
natalidad date not null,
constraint pk_na primary key(id_natalidad));

create table edi_perfil(
id_edperfil int auto_increment not null,
perfil varchar(20) not null,
constraint pk_edp primary key(id_edperfil));

create table nivel_usuario(
id_nivusuario int auto_increment not null,
nivel_usuario varchar (20) not null,
constraint pk_nu primary key(id_nivusuario));

create table statusuario(
id_stusuario int auto_increment not null,
stusuario varchar (20) not null,
constraint pk_stu primary key(id_stusuario));

create table genero(
id_genero int auto_increment not null,
genero varchar (10),
constraint pk_ge primary key(id_genero));
	

create table usuarios(
id_usuarios int auto_increment not null,
usuario varchar(30) not null,
correo varchar(50) not null,
contra varchar(20) not null,
foto varchar(15) not null default 'image.jpeg',
banner varchar(15) not null default 'hiter.jpg',
id_zhoraria1 int not null,
id_pais1 int not null,
id_genero1 int not null,
id_edperfil1 int not null default 1,
id_postal1 int not null default 1,
id_nombre1 int not null default 1,
id_apellido1 int not null default 1,
id_natalidad1 int not null default 1,
id_nivusuario1 int not null default 1,
id_stusuario1 int not null default 1,
constraint pk_us primary key(id_usuarios),
constraint fk_ge1 foreign key(id_genero1) references genero(id_genero),
constraint fk_pai1 foreign key(id_pais1) references pais (id_pais),
constraint fk_zh1 foreign key(id_zhoraria1) references zonahoraria (id_zhoraria),
constraint fk_po1 foreign key(id_postal1) references postal (id_postal),
constraint fk_no1 foreign key(id_nombre1) references nombre(id_nombre),
constraint fk_ap1 foreign key(id_apellido1) references apellido (id_apellido),
constraint fk_na1 foreign key(id_natalidad1) references natalidad (id_natalidad),
constraint fk_edp1 foreign key(id_edperfil1) references  edi_perfil(id_edperfil),
constraint fk_nu1 foreign key(id_nivusuario1) references nivel_usuario (id_nivusuario),
constraint fk_stu foreign key(id_stusuario1) references statusuario (id_stusuario));

create table deportes(
id_deportes int auto_increment not null,
deportes varchar(20) not null,
foto_d varchar(20) not null,
constraint pk_de primary key(id_deportes));

create table equipos(
id_equipos int auto_increment not null,
equipos varchar(30) not null,
constraint pk_eq primary key(id_equipos));

create table ligas(
id_ligas int auto_increment not null,
ligas varchar(30) not null,
id_deportes1 int not null,
constraint pk_li primary key(id_ligas),
constraint fk_de1 foreign key(id_deportes1) references deportes (id_deportes));

create table partidos(
id_partidos int auto_increment not null,
id_equiposh int not null,
id_equiposv int not null,
id_ligas2 int not null,
fecha datetime not null,
uno float not null,
dos float not null,
tres float not null, 
puntuacion_h int not null default 0,
puntuacion_v int not null default 0,
actualizado int not null default 1,
constraint pk_pa primary key(id_partidos),
constraint fk_eqh foreign key(id_equiposh) references equipos (id_equipos),
constraint fk_eqv foreign key(id_equiposv) references equipos (id_equipos),
constraint fk_li foreign key(id_ligas2) references ligas (id_ligas));

create table resultado_jugada(
id_rjugada int auto_increment not null,
resultado_j varchar (20)not null,
constraint pk_rj primary key(id_rjugada));

create table jugadas(
id_jugadas int auto_increment not null,
id_usuarios1 int not null,
id_partidos1 int not null,
puntos_jugados int not null,
puntos_a_ganar int not null,
jugada int not null,
fecha_jugada datetime not null,
id_rjugada1 int not null default 1,
constraint pk_ju primary key(id_jugadas),
constraint fk_pa1 foreign key(id_partidos1) references partidos (id_partidos),
constraint fk_us1 foreign key(id_usuarios1) references usuarios (id_usuarios),
constraint fk_ju foreign key(jugada) references resultado_jugada (id_rjugada),
constraint fk_rj1 foreign key(id_rjugada1) references resultado_jugada (id_rjugada));

create table puntos(
id_usuarios2 int not null,
puntos_ganados int not null default 5000,
puntos_bonus_diario int not null default 0,
puntos_promociones int not null default 0,
puntos_referidos int not null default 0,
puntos_subreferidos int not null default 0,
punstos_enjuego int not null default 0,
puntos_perdidos int not null default 0,
puntos_regalos int not null default 0,
puntos_acumulados int as (((puntos_ganados+puntos_promociones+puntos_referidos+puntos_subreferidos)-puntos_perdidos)-puntos_regalos),
constraint fk_us2 foreign key(id_usuarios2) references usuarios (id_usuarios));

create table ligas_equipos(
id_ligas1 int not null,
id_equipos1 int not null,
constraint fk_li1 foreign key(id_ligas1) references ligas (id_ligas),
constraint fk_eq1 foreign key(id_equipos1) references equipos (id_equipos));

create table deporte_favorito(
id_usuarios4 int not null,
id_deportes2 int not null,
constraint fk_us4 foreign key(id_usuarios4) references usuarios (id_usuarios),
constraint fk_de2 foreign key(id_deportes2) references deportes (id_deportes));

create table regalos(
id_regalos int auto_increment not null,
regalo varchar(30) not null,
p_necesarios int not null,
foto_regalo varchar(30) not null,
descripcion_regalo varchar(200) not null,
constraint pk_rg primary key(id_regalos));

create table promociones(
id_promo int auto_increment not null,
promocion varchar(30) not null,
tipo_promo varchar(30) not null,
p_obtener int not null,
foto_promo varchar(30) not null,
constraint pk_pr primary key(id_promo));


create table status_regalo(
id_status_r int auto_increment not null,
status_r varchar (20) not null,
constraint pk_sr primary key (id_status_r));

create table reg_obtenidos(
id_usuarios5 int not null,
id_regalos1 int not null,
id_status_r1 int not null default 1,
constraint fk_sr foreign key(id_status_r1) references status_regalo (id_status_r),
constraint fk_us5 foreign key(id_usuarios5) references usuarios (id_usuarios),
constraint fk_rg foreign key(id_regalos1) references regalos (id_regalos));

create table promo_hecha(
id_usuarios6 int not null,
id_promo1 int not null,
constraint fk_us6 foreign key(id_usuarios6) references usuarios (id_usuarios),
constraint fk_pr foreign key(id_promo1) references promociones (id_promo));

create table statu_seguidor(
id_sseguidor int auto_increment not null,
statu_s varchar(10) not null,
constraint pk_sts primary key(id_sseguidor));

create table seguidores(
id_seguidor int not null,
id_seguido int not null,
statu_s1 int not null default 1,
constraint fk_ssr foreign key(id_seguidor) references usuarios (id_usuarios),
constraint fk_sso foreign key(id_seguido) references usuarios (id_usuarios),
constraint fk_sts1 foreign key(statu_s1) references statu_seguidor (id_sseguidor));

create table bonus_diario(
id_bonus_d int auto_increment not null,
seguidillas varchar (20) not null,
puntos int not null,
constraint pk_bd primary key(id_bonus_d));

create table ingreso(
id_usuarios7 int not null,
ip int not null,
f_ingreso datetime not null,
id_bonus_d1 int not null default 1,
constraint fk_us7 foreign key(id_usuarios7) references usuarios (id_usuarios),
constraint fk_bd1 foreign key(id_bonus_d1) references bonus_diario (id_bonus_d));

create table direccion(
id_usuarios8 int not null,
direccion varchar(100) not null,
constraint fk_us8 foreign key(id_usuarios8) references usuarios (id_usuarios));

create table referidos(
id_usuarios3 int not null,
id_referidos int not null,
constraint fk_us3 foreign key(id_usuarios3) references usuarios (id_usuarios),
constraint fk_re foreign key(id_referidos) references usuarios (id_usuarios));

create table subreferidos(
id_usuarios9 int not null,
id_subreferidos int not null,
constraint fk_us9 foreign key(id_usuarios9) references usuarios (id_usuarios),
constraint fk_sbr foreign key(id_subreferidos) references usuarios (id_usuarios));

create table pote(
id_pote int auto_increment not null,
id_partidos2 int not null,
coste_pote int not null,
premio_pote int not null,
constraint pk_pt primary key(id_pote),
constraint fk_pa2 foreign key(id_partidos2) references partidos (id_partidos));

create table jugada_pote(
id_usuarios10 int not null,
id_pote1 int not null,
resultado_h_pote int not null,
resultado_v_pote int not null,
fecha_pote datetime not null,
id_rpote1 int not null default 1,
constraint fk_us10 foreign key(id_usuarios10) references usuarios(id_usuarios),
constraint fk_pt1 foreign key(id_pote1) references pote(id_pote),
constraint fk_rj2 foreign key(id_rpote1) references resultado_jugada (id_rjugada));


create table porra(
id_porra int auto_increment not null,
nombre_p varchar(100) not null,
premio_p int not null,
constraint pk_po primary key(id_porra));

create table porra_equipos(
id_porra4 int not null,
id_partidos4 int not null,
id_rjugada4 int not null default 1,
constraint fk_po4 foreign key(id_porra4) references porra(id_porra),
constraint fk_pa4 foreign key(id_partidos4) references partidos(id_partidos),
constraint fk_rj4 foreign key(id_rjugada4) references resultado_jugada(id_rjugada));

create table jugada_porra(
id_usuarios11 int not null,
id_porra2 int not null,
id_partidos5 int not null,
id_jugada_porra int not null,
constraint fk_us11 foreign key(id_usuarios11) references usuarios(id_usuarios),
constraint fk_po2 foreign key(id_porra2) references porra(id_porra),
constraint fk_pa5 foreign key(id_partidos5) references partidos(id_partidos),
constraint fk_rjp foreign key(id_jugada_porra) references resultado_jugada(id_rjugada));


create table balance(
id_usuarios12 int not null,
domingo int not null default 0,
lunes int not null default 0,
martes int not null default 0,
miercoles int not null default 0,
jueves int not null default 0,
viernes int not null default 0,
sabado int not null default 0,
constraint fk_us12 foreign key(id_usuarios12) references usuarios(id_usuarios));



















DROP= elimina bd y tablas
DELETE= elimina datos
TRUNCATE= elimina todo el registo de una tabla

GROUP BY
ORDE BY
LIMIT 
TOP 


UPDATE tabla SET CAMPO=nuevo valor where id_tabla


INSERT INTO tabla(campos) VALUES(datos)

SELECT * FROM tabla 

SELECT campo FROM tabla1 inner join tabla2 on tabla2.claveprimaria=tabla1.claveforania

where condiciones >=<

select SUM(campos a sumar) as total from tabla

datename 
getdate 

trigger

alter table puntos add puntos_acumulados as ( puntos_ganados-puntos_perdidos)

update puntos set puntos_acumulados=(select SUM(puntos_acumulados-puntos_ganados) 
	as total from puntos where id_usuarios2=2)where id_usuarios2=2

	SELECT id_partidos,id_equiposh,id_equiposv,fecha,deportes FROM partidos 
inner join equipos on equipos.id_equipos=partidos.id_equiposh
inner join ligas_equipos on ligas_equipos.id_equipos3=equipos.id_equipos
inner join ligas on ligas.id_ligas=ligas_equipos.id_ligas2
inner join deportes on deportes.id_deportes=ligas.id_deportes1
WHERE deportes = 'beisbol'


obtener ip: $_SERVER["HTTP_CLIENT_IP"];
$_SERVER["REMOTE_ADDR"];



INSERT INTO usuarios 
inner join pais on pais.id_pais=usuarios.id_pais1 
inner join zonahoraria on zonahoraria.id_zhoraria=usuarios.id_zhoraria1 
(usuario,correo,contra,id_pais,,id_zhoraria1,pais,zonahoraria) 
VALUES ('".$usu."','".$cor."','".$cont."','"$pai"','"$zho"','"$pai"','"$zho"')












SELECT * FROM zhoraria



SELECT usuario,foto,banner,puntos_acumulados FROM USUARIOS 
inner join puntos on puntos.id_usuarios2=usuarios.id_usuarios order by puntos_acumulados asc limit 100;










---------- STATUS REGALOS-----------

INSERT INTO status_regalo(status_r) VALUES('Solicitado');
INSERT INTO status_regalo(status_r) VALUES('Revisando jugadas');
INSERT INTO status_regalo(status_r) VALUES('Procesando');
INSERT INTO status_regalo(status_r) VALUES('Entregado');



----------------REgALOS -------------

INSERT INTO regalos(regalo,p_necesarios,foto_regalo,descripcion_regalo) VALUES('','','');


----------BONUS DIARIOS--------

INSERT INTO bonus_diario(seguidillas,puntos) VALUES('1','100');
INSERT INTO bonus_diario(seguidillas,puntos) VALUES('2','200');
INSERT INTO bonus_diario(seguidillas,puntos) VALUES('3','300');
INSERT INTO bonus_diario(seguidillas,puntos) VALUES('4','400');
INSERT INTO bonus_diario(seguidillas,puntos) VALUES('5','500');
INSERT INTO bonus_diario(seguidillas,puntos) VALUES('6','600');
INSERT INTO bonus_diario(seguidillas,puntos) VALUES('7','700');




-----------STATUS SEGUIDOR----------

INSERT INTO statu_seguidor(statu_s) VALUES('Esperando confirmacion');
INSERT INTO statu_seguidor(statu_s) VALUES('Confirmado');


--------RESULTADO JUGADA-------------

INSERT INTO resultado_jugada(resultado_j) VALUES('En juego');
INSERT INTO resultado_jugada(resultado_j) VALUES('Home');
INSERT INTO resultado_jugada(resultado_j) VALUES('Enpate');
INSERT INTO resultado_jugada(resultado_j) VALUES('Visitante');


-------------------NATALIDAD------------------

INSERT INTO natalidad(natalidad) VALUES('09-06-1991');




----------------CODIGO POSTAL-----------------

INSERT INTO postal(c_postal) VALUES(0000);



-------------NOMBRE----------

INSERT INTO nombre(nombre) VALUES('Actualizar');



----------------APELLIDO---------

INSERT INTO apellido(apellido) VALUES('Actualizar');




-----------GENERO----------

INSERT INTO genero(genero) VALUES('Actualizar');
INSERT INTO genero(genero) VALUES('Masculino');
INSERT INTO genero(genero) VALUES('Femenino');





--------EDITAR PERFIL----------

INSERT INTO edi_perfil(perfil) VALUES('No editado');
INSERT INTO edi_perfil(perfil) VALUES('Editado');



--------STATUS USUARIO-------

INSERT INTO statusuario(stusuario) VALUES('Normal');
INSERT INTO statusuario(stusuario) VALUES('Supervisar');
INSERT INTO statusuario(stusuario) VALUES('Bloqueado');



--------- NIVEL USUARIO ------

INSERT INTO nivel_usuario(nivel_usuario) VALUES('CEO');
INSERT INTO nivel_usuario(nivel_usuario) VALUES('Admin');
INSERT INTO nivel_usuario(nivel_usuario) VALUES('Normal');
INSERT INTO nivel_usuario(nivel_usuario) VALUES('Vip1');
INSERT INTO nivel_usuario(nivel_usuario) VALUES('Vip2');
INSERT INTO nivel_usuario(nivel_usuario) VALUES('Vip3');


------DEPORTES-----

INSERT INTO deportes(deportes,foto_d) VALUES('Futbol','futb.png');
INSERT INTO deportes(deportes,foto_d) VALUES('Baloncesto','balonce.png');
INSERT INTO deportes(deportes,foto_d) VALUES('Beisbol','bat.png');
INSERT INTO deportes(deportes,foto_d) VALUES('Hockey','hock.png');
INSERT INTO deportes(deportes,foto_d) VALUES('Futbol americano','famer.png');
INSERT INTO deportes(deportes,foto_d) VALUES('Tenis','teni.png');
INSERT INTO deportes(deportes,foto_d) VALUES('E-sports','');
INSERT INTO deportes(deportes,foto_d) VALUES('Artes marciales','');



----INSERT PAISES ----------

INSERT INTO pais(pais) VALUES("Afganistán");
INSERT INTO pais(pais) VALUES("Islas Gland");
INSERT INTO pais(pais) VALUES("Albania");
INSERT INTO pais(pais) VALUES("Alemania");
INSERT INTO pais(pais) VALUES("Andorra");
INSERT INTO pais(pais) VALUES("Angola");
INSERT INTO pais(pais) VALUES("Anguilla");
INSERT INTO pais(pais) VALUES("Antártida");
INSERT INTO pais(pais) VALUES("Antigua y Barbuda");
INSERT INTO pais(pais) VALUES("Antillas Holandesas");
INSERT INTO pais(pais) VALUES("Arabia Saudí");
INSERT INTO pais(pais) VALUES("Argelia");
INSERT INTO pais(pais) VALUES("Argentina");
INSERT INTO pais(pais) VALUES("Armenia");
INSERT INTO pais(pais) VALUES("Aruba");
INSERT INTO pais(pais) VALUES("Australia");
INSERT INTO pais(pais) VALUES("Austria");
INSERT INTO pais(pais) VALUES("Azerbaiyán");
INSERT INTO pais(pais) VALUES("Bahamas");
INSERT INTO pais(pais) VALUES("Bahréin");
INSERT INTO pais(pais) VALUES("Bangladesh");
INSERT INTO pais(pais) VALUES("Barbados");
INSERT INTO pais(pais) VALUES("Bielorrusia");
INSERT INTO pais(pais) VALUES("Bélgica");
INSERT INTO pais(pais) VALUES("Belice");
INSERT INTO pais(pais) VALUES("Benin");
INSERT INTO pais(pais) VALUES("Bermudas");
INSERT INTO pais(pais) VALUES("Bhután");
INSERT INTO pais(pais) VALUES("Bolivia");
INSERT INTO pais(pais) VALUES("Bosnia y Herzegovina");
INSERT INTO pais(pais) VALUES("Botsuana");
INSERT INTO pais(pais) VALUES("Isla Bouvet");
INSERT INTO pais(pais) VALUES("Brasil");
INSERT INTO pais(pais) VALUES("Brunéi");
INSERT INTO pais(pais) VALUES("Bulgaria");
INSERT INTO pais(pais) VALUES("Burkina Faso");
INSERT INTO pais(pais) VALUES("Burundi");
INSERT INTO pais(pais) VALUES("Cabo Verde");
INSERT INTO pais(pais) VALUES("Islas Caimán");
INSERT INTO pais(pais) VALUES("Camboya");
INSERT INTO pais(pais) VALUES("Camerún");
INSERT INTO pais(pais) VALUES("Canadá");
INSERT INTO pais(pais) VALUES("República Centroafricana");
INSERT INTO pais(pais) VALUES("Chad");
INSERT INTO pais(pais) VALUES("República Checa");
INSERT INTO pais(pais) VALUES("Chile");
INSERT INTO pais(pais) VALUES("China");
INSERT INTO pais(pais) VALUES("Chipre");
INSERT INTO pais(pais) VALUES("Isla de Navidad");
INSERT INTO pais(pais) VALUES("Ciudad del Vaticano");
INSERT INTO pais(pais) VALUES("Islas Cocos");
INSERT INTO pais(pais) VALUES("Colombia");
INSERT INTO pais(pais) VALUES("Comoras");
INSERT INTO pais(pais) VALUES("República Democrática del Congo");
INSERT INTO pais(pais) VALUES("Congo");
INSERT INTO pais(pais) VALUES("Islas Cook");
INSERT INTO pais(pais) VALUES("Corea del Norte");
INSERT INTO pais(pais) VALUES("Corea del Sur");
INSERT INTO pais(pais) VALUES("Costa de Marfil");
INSERT INTO pais(pais) VALUES("Costa Rica");
INSERT INTO pais(pais) VALUES("Croacia");
INSERT INTO pais(pais) VALUES("Cuba");
INSERT INTO pais(pais) VALUES("Dinamarca");
INSERT INTO pais(pais) VALUES("Dominica");
INSERT INTO pais(pais) VALUES("República Dominicana");
INSERT INTO pais(pais) VALUES("Ecuador");
INSERT INTO pais(pais) VALUES("Egipto");
INSERT INTO pais(pais) VALUES("El Salvador");
INSERT INTO pais(pais) VALUES("Emiratos Árabes Unidos");
INSERT INTO pais(pais) VALUES("Eritrea");
INSERT INTO pais(pais) VALUES("Eslovaquia");
INSERT INTO pais(pais) VALUES("Eslovenia");
INSERT INTO pais(pais) VALUES("España");
INSERT INTO pais(pais) VALUES("Islas ultramarinas de Estados Unidos");
INSERT INTO pais(pais) VALUES("Estados Unidos");
INSERT INTO pais(pais) VALUES("Estonia");
INSERT INTO pais(pais) VALUES("Etiopía");
INSERT INTO pais(pais) VALUES("Islas Feroe");
INSERT INTO pais(pais) VALUES("Filipinas");
INSERT INTO pais(pais) VALUES("Finlandia");
INSERT INTO pais(pais) VALUES("Fiyi");
INSERT INTO pais(pais) VALUES("Francia");
INSERT INTO pais(pais) VALUES("Gabón");
INSERT INTO pais(pais) VALUES("Gambia");
INSERT INTO pais(pais) VALUES("Georgia");
INSERT INTO pais(pais) VALUES("Islas Georgias del Sur y Sandwich del Sur");
INSERT INTO pais(pais) VALUES("Ghana");
INSERT INTO pais(pais) VALUES("Gibraltar");
INSERT INTO pais(pais) VALUES("Granada");
INSERT INTO pais(pais) VALUES("Grecia");
INSERT INTO pais(pais) VALUES("Groenlandia");
INSERT INTO pais(pais) VALUES("Guadalupe");
INSERT INTO pais(pais) VALUES("Guam");
INSERT INTO pais(pais) VALUES("Guatemala");
INSERT INTO pais(pais) VALUES("Guayana Francesa");
INSERT INTO pais(pais) VALUES("Guinea");
INSERT INTO pais(pais) VALUES("Guinea Ecuatorial");
INSERT INTO pais(pais) VALUES("Guinea-Bissau");
INSERT INTO pais(pais) VALUES("Guyana");
INSERT INTO pais(pais) VALUES("Haití");
INSERT INTO pais(pais) VALUES("Islas Heard y McDonald");
INSERT INTO pais(pais) VALUES("Honduras");
INSERT INTO pais(pais) VALUES("Hong Kong");
INSERT INTO pais(pais) VALUES("Hungría");
INSERT INTO pais(pais) VALUES("India");
INSERT INTO pais(pais) VALUES("Indonesia");
INSERT INTO pais(pais) VALUES("Irán");
INSERT INTO pais(pais) VALUES("Iraq");
INSERT INTO pais(pais) VALUES("Irlanda");
INSERT INTO pais(pais) VALUES("Islandia");
INSERT INTO pais(pais) VALUES("Israel");
INSERT INTO pais(pais) VALUES("Italia");
INSERT INTO pais(pais) VALUES("Jamaica");
INSERT INTO pais(pais) VALUES("Japón");
INSERT INTO pais(pais) VALUES("Jordania");
INSERT INTO pais(pais) VALUES("Kazajstán");
INSERT INTO pais(pais) VALUES("Kenia");
INSERT INTO pais(pais) VALUES("Kirguistán");
INSERT INTO pais(pais) VALUES("Kiribati");
INSERT INTO pais(pais) VALUES("Kuwait");
INSERT INTO pais(pais) VALUES("Laos");
INSERT INTO pais(pais) VALUES("Lesotho");
INSERT INTO pais(pais) VALUES("Letonia");
INSERT INTO pais(pais) VALUES("Líbano");
INSERT INTO pais(pais) VALUES("Liberia");
INSERT INTO pais(pais) VALUES("Libia");
INSERT INTO pais(pais) VALUES("Liechtenstein");
INSERT INTO pais(pais) VALUES("Lituania");
INSERT INTO pais(pais) VALUES("Luxemburgo");
INSERT INTO pais(pais) VALUES("Macao");
INSERT INTO pais(pais) VALUES("ARY Macedonia");
INSERT INTO pais(pais) VALUES("Madagascar");
INSERT INTO pais(pais) VALUES("Malasia");
INSERT INTO pais(pais) VALUES("Malawi");
INSERT INTO pais(pais) VALUES("Maldivas");
INSERT INTO pais(pais) VALUES("Malí");
INSERT INTO pais(pais) VALUES("Malta");
INSERT INTO pais(pais) VALUES("Islas Malvinas");
INSERT INTO pais(pais) VALUES("Islas Marianas del Norte");
INSERT INTO pais(pais) VALUES("Marruecos");
INSERT INTO pais(pais) VALUES("Islas Marshall");
INSERT INTO pais(pais) VALUES("Martinica");
INSERT INTO pais(pais) VALUES("Mauricio");
INSERT INTO pais(pais) VALUES("Mauritania");
INSERT INTO pais(pais) VALUES("Mayotte");
INSERT INTO pais(pais) VALUES("México");
INSERT INTO pais(pais) VALUES("Micronesia");
INSERT INTO pais(pais) VALUES("Moldavia");
INSERT INTO pais(pais) VALUES("Mónaco");
INSERT INTO pais(pais) VALUES("Mongolia");
INSERT INTO pais(pais) VALUES("Montserrat");
INSERT INTO pais(pais) VALUES("Mozambique");
INSERT INTO pais(pais) VALUES("Myanmar");
INSERT INTO pais(pais) VALUES("Namibia");
INSERT INTO pais(pais) VALUES("Nauru");
INSERT INTO pais(pais) VALUES("Nepal");
INSERT INTO pais(pais) VALUES("Nicaragua");
INSERT INTO pais(pais) VALUES("Níger");
INSERT INTO pais(pais) VALUES("Nigeria");
INSERT INTO pais(pais) VALUES("Niue");
INSERT INTO pais(pais) VALUES("Isla Norfolk");
INSERT INTO pais(pais) VALUES("Noruega");
INSERT INTO pais(pais) VALUES("Nueva Caledonia");
INSERT INTO pais(pais) VALUES("Nueva Zelanda");
INSERT INTO pais(pais) VALUES("Omán");
INSERT INTO pais(pais) VALUES("Países Bajos");
INSERT INTO pais(pais) VALUES("Pakistán");
INSERT INTO pais(pais) VALUES("Palau");
INSERT INTO pais(pais) VALUES("Palestina");
INSERT INTO pais(pais) VALUES("Panamá");
INSERT INTO pais(pais) VALUES("Papúa Nueva Guinea");
INSERT INTO pais(pais) VALUES("Paraguay");
INSERT INTO pais(pais) VALUES("Perú");
INSERT INTO pais(pais) VALUES("Islas Pitcairn");
INSERT INTO pais(pais) VALUES("Polinesia Francesa");
INSERT INTO pais(pais) VALUES("Polonia");
INSERT INTO pais(pais) VALUES("Portugal");
INSERT INTO pais(pais) VALUES("Puerto Rico");
INSERT INTO pais(pais) VALUES("Qatar");
INSERT INTO pais(pais) VALUES("Reino Unido");
INSERT INTO pais(pais) VALUES("Reunión");
INSERT INTO pais(pais) VALUES("Ruanda");
INSERT INTO pais(pais) VALUES("Rumania");
INSERT INTO pais(pais) VALUES("Rusia");
INSERT INTO pais(pais) VALUES("Sahara Occidental");
INSERT INTO pais(pais) VALUES("Islas Salomón");
INSERT INTO pais(pais) VALUES("Samoa");
INSERT INTO pais(pais) VALUES("Samoa Americana");
INSERT INTO pais(pais) VALUES("San Cristóbal y Nevis");
INSERT INTO pais(pais) VALUES("San Marino");
INSERT INTO pais(pais) VALUES("San Pedro y Miquelón");
INSERT INTO pais(pais) VALUES("San Vicente y las Granadinas");
INSERT INTO pais(pais) VALUES("Santa Helena");
INSERT INTO pais(pais) VALUES("Santa Lucía");
INSERT INTO pais(pais) VALUES("Santo Tomé y Príncipe");
INSERT INTO pais(pais) VALUES("Senegal");
INSERT INTO pais(pais) VALUES("Serbia y Montenegro");
INSERT INTO pais(pais) VALUES("Seychelles");
INSERT INTO pais(pais) VALUES("Sierra Leona");
INSERT INTO pais(pais) VALUES("Singapur");
INSERT INTO pais(pais) VALUES("Siria");
INSERT INTO pais(pais) VALUES("Somalia");
INSERT INTO pais(pais) VALUES("Sri Lanka");
INSERT INTO pais(pais) VALUES("Suazilandia");
INSERT INTO pais(pais) VALUES("Sudáfrica");
INSERT INTO pais(pais) VALUES("Sudán");
INSERT INTO pais(pais) VALUES("Suecia");
INSERT INTO pais(pais) VALUES("Suiza");
INSERT INTO pais(pais) VALUES("Surinam");
INSERT INTO pais(pais) VALUES("Svalbard y Jan Mayen");
INSERT INTO pais(pais) VALUES("Tailandia");
INSERT INTO pais(pais) VALUES("Taiwán");
INSERT INTO pais(pais) VALUES("Tanzania");
INSERT INTO pais(pais) VALUES("Tayikistán");
INSERT INTO pais(pais) VALUES("Territorio Británico del Océano Índico");
INSERT INTO pais(pais) VALUES("Territorios Australes Franceses");
INSERT INTO pais(pais) VALUES("Timor Oriental");
INSERT INTO pais(pais) VALUES("Togo");
INSERT INTO pais(pais) VALUES("Tokelau");
INSERT INTO pais(pais) VALUES("Tonga");
INSERT INTO pais(pais) VALUES("Trinidad y Tobago");
INSERT INTO pais(pais) VALUES("Túnez");
INSERT INTO pais(pais) VALUES("Islas Turcas y Caicos");
INSERT INTO pais(pais) VALUES("Turkmenistán");
INSERT INTO pais(pais) VALUES("Turquía");
INSERT INTO pais(pais) VALUES("Tuvalu");
INSERT INTO pais(pais) VALUES("Ucrania");
INSERT INTO pais(pais) VALUES("Uganda");
INSERT INTO pais(pais) VALUES("Uruguay");
INSERT INTO pais(pais) VALUES("Uzbekistán");
INSERT INTO pais(pais) VALUES("Vanuatu");
INSERT INTO pais(pais) VALUES("Venezuela");
INSERT INTO pais(pais) VALUES("Vietnam");
INSERT INTO pais(pais) VALUES("Islas Vírgenes Británicas");
INSERT INTO pais(pais) VALUES("Islas Vírgenes de los Estados Unidos");
INSERT INTO pais(pais) VALUES("Wallis y Futuna");
INSERT INTO pais(pais) VALUES("Yemen");
INSERT INTO pais(pais) VALUES("Yibuti");
INSERT INTO pais(pais) VALUES("Zambia");
INSERT INTO pais(pais) VALUES("Zimbabue");





---------ZONA HORARIA--------

INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-11:00','Pacific/Midway');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-11:00','Pacific/Niue');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-11:00','Pacific/Pago_pago');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-10:00','America/Adak');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-10:00','Paficic/Honolulu');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-10:00','Pacific/Johnston');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-10:00','Pacific/Rarotonga');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-10:00','Pacific/Tahiti');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-09:30','Pacific/Marquesas');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-09:00','America/Anchorage');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-09:00','America/Juneau');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-09:00','America/Metlakatla');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-09:00','America/Nome');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-09:00','America/Sitka');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-09:00','America/Yakutat');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-09:00','Pacific/Gambier');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-08:00','America/Dawson');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-08:00','America/Los_Angeles');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-08:00','America/Tijuana');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-08:00','America/Vancouver');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-08:00','America/Whitehorse');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-08:00','Pacific/Pitcairn');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-07:00','America/Boise');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-07:00','America/Cambridge_Bay');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-07:00','America/Chihuahua');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-07:00','America/Creston');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-07:00','America/Dawson_Creek');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-07:00','America/Denver');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-07:00','America/Edmonton');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-07:00','America/Fort_Nelson');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-07:00','America/Hermosillo');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-07:00','America/Inuvik');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-07:00','America/Mazatlan');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-07:00','America/Ojinaga');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-07:00','America/Phoenix');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-07:00','America/Yellowknife');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-06:00','America/Bahia_Banderas');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-06:00','America/Belize');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-06:00','America/Chicago');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-06:00','America/Costa_Rica');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-06:00','America/El_Salvador');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-06:00','America/Guatemala');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-06:00','America/Indiana/Knox');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-06:00','America/Indiana/Tell_City');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-06:00','America/Managua');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-06:00','America/Matamoros');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-06:00','America/Menominee');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-06:00','America/Merida');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-06:00','America/Mexico_City');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-06:00','America/Monterrey');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-06:00','America/North_Dakota/Beulah');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-06:00','America/North_Dakota/Center');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-06:00','America/North_Dakota/New_Salem');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-06:00','America/Rainy_River');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-06:00','America/Rankin_Inlet');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-06:00','America/Regina');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-06:00','America/Resolute');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-06:00','America/Swift_Current');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-06:00','America/Tegucigalpa');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-06:00','America/Winnipeg');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-06:00','Pacific/Easter');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-06:00','Pacific/Galapagos');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-05:00','America/Atikokan');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-05:00','America/Bogota');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-05:00','America/Cancun');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-05:00','America/Cayman');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-05:00','America/Detroit');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-05:00','America/Eirunepe');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-05:00','America/Guayaquil');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-05:00','America/Havana');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-05:00','America/Indiana/Indianapolis');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-05:00','America/Indiana/Marengo');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-05:00','America/Indiana/Petersburg');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-05:00','America/Indiana/Vevay');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-05:00','America/Indiana/Vincennes');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-05:00','America/Indiana/Winamac');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-05:00','America/Iqaluit');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-05:00','America/Jamaica');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-05:00','America/Kentucky/Louisville');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-05:00','America/Kentucky/Monticello');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-05:00','America/Lima');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-05:00','America/Nassau');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-05:00','America/New_York');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-05:00','America/Nipigon');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-05:00','America/Panama');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-05:00','America/Pangnirtung');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-05:00','America/Port-au-Prince');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-05:00','America/Rio_Branco');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-05:00','America/Thunder_Bay');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-05:00','America/Toronto');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-04:00','America/Anguilla');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-04:00','America/Antigua');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-04:00','America/Aruba');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-04:00','America/Asuncion');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-04:00','America/Barbados');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-04:00','America/Blanc-Sablon');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-04:00','America/Boa_Vista');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-04:00','America/Campo_Grande');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-04:00','America/Caracas');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-04:00','America/Cuiaba');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-04:00','America/Curacao');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-04:00','America/Dominica');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-04:00','America/Glace_Bay');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-04:00','America/Goose_Bay');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-04:00','America/Grand_Turk');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-04:00','America/Grenada');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-04:00','America/Guadeloupe');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-04:00','America/Guyana');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-04:00','America/Halifax');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-04:00','America/Kralendijk');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-04:00','America/La_Paz');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-04:00','America/Lower_Princes');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-04:00','America/Manaus');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-04:00','America/Marigot');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-04:00','America/Martinique');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-04:00','America/Moncton');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-04:00','America/Montserrat');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-04:00','America/Porto_Velho');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-04:00','America/Port_of_Spain');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-04:00','America/Puerto_Rico');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-04:00','America/Santiago');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-04:00','America/Santo_Domingo');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-04:00','America/St_Barthelemy');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-04:00','America/St_Kitts');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-04:00','America/St_Lucia');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-04:00','America/St_Thomas');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-04:00','America/St_Vincent');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-04:00','America/Thule');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-04:00','America/Tortola');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-04:00','Antarctica/Palmer');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-04:00','Atlantic/Bermuda');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-03:30','America/St_Johns');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-03:00','America/Araguaina');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-03:00','America/Argentina/Buenos_Aires');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-03:00','America/Argentina/Catamarca');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-03:00','America/Argentina/Cordoba');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-03:00','America/Argentina/Jujuy');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-03:00','America/Argentina/La_Rioja');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-03:00','America/Argentina/Mendoza');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-03:00','America/Argentina/Rio_Gallegos');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-03:00','America/Argentina/Salta');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-03:00','America/Argentina/San_Juan');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-03:00','America/Argentina/San_Luis');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-03:00','America/Argentina/Tucuman');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-03:00','America/Argentina/Ushuaia');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-03:00','America/Bahia');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-03:00','America/Belem');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-03:00','America/Cayenne');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-03:00','America/Fortaleza');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-03:00','America/Godthab');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-03:00','America/Maceio');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-03:00','America/Miquelon');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-03:00','America/Montevideo');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-03:00','America/Paramaribo');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-03:00','America/Recife');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-03:00','America/Santarem');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-03:00','America/Sao_Paulo');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-03:00','Antarctica/Rothera');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-03:00','Atlantic/Stanley');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-02:00','America/Noronha');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-02:00','Atlantic/South_Georgia');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-01:00','America/Scoresbysund');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-01:00','Atlantic/Azores');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('-01:00','Atlantic/Cape_Verde');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('00:00','Africa/Abidjan');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('00:00','Africa/Accra');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('00:00','Africa/Bamako');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('00:00','Africa/Banjul');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('00:00','Africa/Bissau');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('00:00','Africa/Casablanca');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('00:00','Africa/Conakry');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('00:00','Africa/Dakar');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('00:00','Africa/El_Aaiun');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('00:00','Africa/Freetown');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('00:00','Africa/Lome');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('00:00','Africa/Monrovia');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('00:00','Africa/Nouakchott');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('00:00','Africa/Ouagadougou');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('00:00','Africa/Sao_Tome');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('00:00','America/Danmarkshavn');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('00:00','Antarctica/Troll');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('00:00','Atlantic/Canary');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('00:00','Atlantic/Faroe');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('00:00','Atlantic/Madeira');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('00:00','Atlantic/Reykjavik');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('00:00','Atlantic/St_Helena');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('00:00','Europe/Dublin');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('00:00','Europe/Guernsey');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('00:00','Europe/Isle_of_Man');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('00:00','Europe/Jersey');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('00:00','Europe/Lisbon');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('00:00','Europe/London');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('01:00','Africa/Algiers');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('01:00','Africa/Bangui');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('01:00','Africa/Brazzaville');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('01:00','Africa/Ceuta');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('01:00','Africa/Douala');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('01:00','Africa/Kinshasa');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('01:00','Africa/Lagos');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('01:00','Africa/Libreville');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('01:00','Africa/Luanda');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('01:00','Africa/Malabo');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('01:00','Africa/Ndjamena');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('01:00','Africa/Niamey');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('01:00','Africa/Porto-Novo');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('01:00','Africa/Tunis');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('01:00','Africa/Windhoek');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('01:00','Arctic/Longyearbyen');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('01:00','Europe/Amsterdam');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('01:00','Europe/Andorra');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('01:00','Europe/Belgrade');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('01:00','Europe/Berlin');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('01:00','Europe/Bratislava');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('01:00','Europe/Brussels');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('01:00','Europe/Budapest');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('01:00','Europe/Copenhagen');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('01:00','Europe/Gibraltar');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('01:00','Europe/Ljubljana');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('01:00','Europe/Luxembourg');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('01:00','Europe/Madrid');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('01:00','Europe/Malta');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('01:00','Europe/Monaco');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('01:00','Europe/Oslo');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('01:00','Europe/Paris');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('01:00','Europe/Podgorica');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('01:00','Europe/Prague');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('01:00','Europe/Rome');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('01:00','Europe/San_Marino');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('01:00','Europe/Sarajevo');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('01:00','Europe/Skopje');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('01:00','Europe/Stockholm');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('01:00','Europe/Tirane');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('01:00','Europe/Vaduz');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('01:00','Europe/Vatican');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('01:00','Europe/Vienna');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('01:00','Europe/Warsaw');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('01:00','Europe/Zagreb');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('01:00','Europe/Zurich');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('02:00','Africa/Blantyre');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('02:00','Africa/Bujumbura');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('02:00','Africa/Cairo');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('02:00','Africa/Gaborone');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('02:00','Africa/Harare');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('02:00','Africa/Johannesburg');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('02:00','Africa/Kigali');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('02:00','Africa/Lubumbashi');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('02:00','Africa/Lusaka');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('02:00','Africa/Maputo');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('02:00','Africa/Maseru');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('02:00','Africa/Mbabane');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('02:00','Africa/Tripoli');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('02:00','Asia/Amman');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('02:00','Asia/Beirut');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('02:00','Asia/Damascus');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('02:00','Asia/Gaza');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('02:00','Asia/Hebron');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('02:00','Asia/Jerusalem');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('02:00','Asia/Nicosia');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('02:00','Europe/Athens');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('02:00','Europe/Bucharest');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('02:00','Europe/Chisinau');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('02:00','Europe/Helsinki');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('02:00','Europe/Istanbul');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('02:00','Europe/Kaliningrad');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('02:00','Europe/Kiev');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('02:00','Europe/Mariehamn');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('02:00','Europe/Riga');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('02:00','Europe/Sofia');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('02:00','Europe/Tallinn');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('02:00','Europe/Uzhgorod');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('02:00','Europe/Vilnius');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('02:00','Europe/Zaporozhye');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('03:00','Africa/Addis_Ababa');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('03:00','Africa/Asmara');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('03:00','Africa/Dar_es_Salaam');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('03:00','Africa/Djibouti');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('03:00','Africa/Juba');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('03:00','Africa/Kampala');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('03:00','Africa/Khartoum');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('03:00','Africa/Mogadishu');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('03:00','Africa/Nairobi');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('03:00','Antarctica/Syowa');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('03:00','Asia/Aden');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('03:00','Asia/Baghdad');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('03:00','Asia/Bahrain');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('03:00','Asia/Kuwait');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('03:00','Asia/Qatar');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('03:00','Asia/Riyadh');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('03:00','Europe/Minsk');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('03:00','Europe/Moscow');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('03:00','Europe/Simferopol');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('03:00','Europe/Volgograd');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('03:00','Indian/Antananarivo');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('03:00','Indian/Comoro');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('03:00','Indian/Mayotte');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('03:30','Asia/Tehran');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('04:00','Asia/Baku');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('04:00','Asia/Dubai');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('04:00','Asia/Muscat');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('04:00','Asia/Tbilisi');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('04:00','Asia/Yerevan');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('04:00','Europe/Astrakhan');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('04:00','Europe/Samara');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('04:00','Europe/Ulyanovsk');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('04:00','Indian/Mahe');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('04:00','Indian/Mauritius');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('04:00','Indian/Reunion');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('04:30','Asia/Kabul');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('05:00','Antarctica/Mawson');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('05:00','Asia/Aqtau');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('05:00','Asia/Aqtobe');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('05:00','Asia/Ashgabat');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('05:00','Asia/Dushanbe');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('05:00','Asia/Karachi');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('05:00','Asia/Oral');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('05:00','Asia/Samarkand');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('05:00','Asia/Tashkent');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('05:00','Asia/Yekaterinburg');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('05:00','Indian/Kerguelen');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('05:00','Indian/Maldives');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('05:30','Asia/Colombo');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('05:30','Asia/Kolkata');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('05:45','Asia/Kathmandu');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('06:00','Antarctica/Vostok');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('06:00','Asia/Almaty');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('06:00','Asia/Bishkek');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('06:00','Asia/Dhaka');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('06:00','Asia/Novosibirsk');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('06:00','Asia/Omsk');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('06:00','Asia/Qyzylorda');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('06:00','Asia/Thimphu');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('06:00','Asia/Urumqi');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('06:00','Indian/Chagos');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('06:30','Asia/Rangoon');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('06:30','Indian/Cocos');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('07:00','Antarctica/Davis');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('07:00','Asia/Bangkok');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('07:00','Asia/Barnaul');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('07:00','Asia/Hovd');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('07:00','Asia/Ho_Chi_Minh');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('07:00','Asia/Jakarta');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('07:00','Asia/Krasnoyarsk');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('07:00','Asia/Novokuznetsk');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('07:00','Asia/Phnom_Penh');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('07:00','Asia/Pontianak');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('07:00','Asia/Vientiane');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('07:00','Indian/Christmas');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('08:00','Antarctica/Casey');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('08:00','Asia/Brunei');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('08:00','Asia/Choibalsan');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('08:00','Asia/Hong_Kong');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('08:00','Asia/Irkutsk');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('08:00','Asia/Kuala_Lumpur');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('08:00','Asia/Kuching');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('08:00','Asia/Macau');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('08:00','Asia/Makassar');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('08:00','Asia/Manila');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('08:00','Asia/Shanghai');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('08:00','Asia/Singapore');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('08:00','Asia/Taipei');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('08:00','Asia/Ulaanbaatar');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('08:00','Australia/Perth');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('08:30','Asia/Pyongyang');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('08:45','Australia/Eucla');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('09:00','Asia/Chita');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('09:00','Asia/Dili');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('09:00','Asia/Jayapura');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('09:00','Asia/Khandyga');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('09:00','Asia/Seoul');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('09:00','Asia/Tokyo');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('09:00','Asia/Yakutsk');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('09:00','Pacific/Palau');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('09:30','Australia/Adelaide');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('09:30','Australia/Broken_Hill');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('09:30','Australia/Darwin');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('10:00','Antarctica/DumontDUrville');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('10:00','Asia/Ust-Nera');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('10:00','Asia/Vladivostok');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('10:00','Australia/Brisbane');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('10:00','Australia/Currie');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('10:00','Australia/Hobart');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('10:00','Australia/Lindeman');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('10:00','Australia/Melbourne');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('10:00','Australia/Sydney');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('10:00','Pacific/Chuuk');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('10:00','Pacific/Guam');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('10:00','Pacific/Port_Moresby');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('10:00','Pacific/Saipan');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('10:30','Australia/Lord_Howe');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('11:00','Antarctica/Macquarie');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('11:00','Asia/Magadan');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('11:00','Asia/Sakhalin');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('11:00','Asia/Srednekolymsk');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('11:00','Pacific/Bougainville');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('11:00','Pacific/Efate');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('11:00','Pacific/Guadalcanal');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('11:00','Pacific/Kosrae');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('11:00','Pacific/Norfolk');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('11:00','Pacific/Noumea');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('11:00','Pacific/Pohnpei');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('12:00','Antarctica/McMurdo');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('12:00','Asia/Anadyr');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('12:00','Asia/Kamchatka');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('12:00','Pacific/Auckland');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('12:00','Pacific/Fiji');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('12:00','Pacific/Funafuti');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('12:00','Pacific/Kwajalein');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('12:00','Pacific/Majuro');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('12:00','Pacific/Nauru');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('12:00','Pacific/Tarawa');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('12:00','Pacific/Wake');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('12:00','Pacific/Wallis');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('12:45','Pacific/Chatham');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('13:00','Pacific/Apia');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('13:00','Pacific/Enderbury');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('13:00','Pacific/Fakaofo');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('13:00','Pacific/Tongatapu');
INSERT INTO zonahoraria(zonahoraria,ciudad) VALUES('14:00','Pacific/Kiritimati');