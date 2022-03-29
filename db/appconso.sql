-- CREATE OR REPLACE DATABASE appconso;
DROP DATABASE IF EXISTS appconso;
-- CREATE DATABASE IF NOT EXISTS appconso;
CREATE DATABASE appconso;

USE appconso;

create table if not exists utilisateur (
	id bigint auto_increment primary key,
	name varchar(128) charset utf8,
	username varchar(128) charset utf8,
	password varchar(128) charset utf8
) engine=InnoDB default charset latin1;


create table if not exists  maison(
	id bigint auto_increment primary key,
	address varchar(128) charset utf8,
	postal_code  varchar(128) charset utf8,
	utilisateur_id bigint,
	constraint fk_utilisateur foreign key(utilisateur_id) references utilisateur(id) ON DELETE CASCADE ON UPDATE CASCADE
) engine=InnoDB default charset latin1;


create table if not exists apareil (
	id bigint auto_increment primary key,
	name varchar(128) charset utf8,
	watts_heure int,
	heures_printemps int,
	heures_ete int,
	heures_aoutomme int,
	heures_hiver int
) engine=InnoDB default charset latin1;

create table maison_appareil(
    id_maison bigint not null,
    id_appareil bigint not null,
    primary key(id_maison, id_appareil),
    CONSTRAINT fk_maison_appareil_maison foreign key (id_maison) references maison (id) ON DELETE CASCADE ON UPDATE CASCADE, 
    CONSTRAINT fk_maison_appareil_appareil foreign key (id_appareil) references apareil (id) ON DELETE CASCADE ON UPDATE CASCADE
) engine=InnoDB default charset latin1;



INSERT INTO utilisateur VALUES(NULL, 'Lili_user','lili','pass');

INSERT INTO maison VALUES(NULL, 'shawi 123','g8p 6j9',1);

INSERT INTO apareil VALUES(NULL, 'congelador',4 , 1, 6, 1, 1);

INSERT INTO maison_appareil VALUES(1, 1);
