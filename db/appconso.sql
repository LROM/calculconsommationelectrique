-- CREATE OR REPLACE DATABASE appconso;
DROP DATABASE IF EXISTS appconso;
-- CREATE DATABASE IF NOT EXISTS appconso;
CREATE DATABASE appconso;

USE appconso;

create table if not exists utilisateur (
	id bigint auto_increment primary key,
	username varchar(128) charset utf8,
	courriel varchar(128) charset utf8,
	password varchar(128) charset utf8
) engine=InnoDB default charset latin1;


create table if not exists  maison(
	id bigint auto_increment primary key,
	address varchar(128) charset utf8,
	postal_code  varchar(128) charset utf8,
	utilisateur_id bigint,
	constraint fk_utilisateur foreign key(utilisateur_id) references utilisateur(id) ON DELETE CASCADE ON UPDATE CASCADE
) engine=InnoDB default charset latin1;


create table if not exists appareil (
	id bigint auto_increment primary key,
	name varchar(128) charset utf8,
	kilowatts_heure DECIMAL (6,2) UNSIGNED not null
) engine=InnoDB default charset latin1;


create table if not exists consommation(
	id bigint auto_increment primary key,
    id_maison bigint not null,
    id_appareil bigint not null,
	heures_par_jour_printemps int,
	heures_par_jour_ete int,
	heures_par_jour_automme int,
	heures_par_jour_hiver int,
    CONSTRAINT fk_consommation_maison foreign key(id_maison) references maison(id) ON DELETE CASCADE ON UPDATE CASCADE, 
    CONSTRAINT fk_consommation_appareil foreign key(id_appareil) references appareil(id) ON DELETE CASCADE ON UPDATE CASCADE
) engine=InnoDB default charset latin1;

create table if not exists tarif_kwh (
	id bigint auto_increment primary key,
	kilowatts_heure DECIMAL (6,2) UNSIGNED not null
) engine=InnoDB default charset latin1;


INSERT INTO utilisateur VALUES(NULL, 'lili','lili@test.com','pass');

INSERT INTO maison VALUES(NULL, 'shawi 123','g8p 6j9',1);

INSERT INTO appareil VALUES(NULL, 'congelador', 0.50 );

INSERT INTO consommation VALUES(NULL, 1, 1, 1, 6, 1, 1);

INSERT INTO tarif_kwh VALUES(NULL, 2.22);
