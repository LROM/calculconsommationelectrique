-- CREATE OR REPLACE DATABASE appconso;
DROP DATABASE IF EXISTS appconso;
-- CREATE DATABASE IF NOT EXISTS appconso;
CREATE DATABASE appconso;

USE appconso;

create table if not exists utilisateur (
	id bigint auto_increment primary key,
	username varchar(128) charset utf8,
	courriel varchar(128) charset utf8,
	password varchar(128) charset utf8,
	CONSTRAINT username_unique UNIQUE (username)
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
	annee int not null,
	kilowatts_heure_moins_egal_40 DECIMAL (6,2) UNSIGNED not null,
	kilowatts_heure_plus_40 DECIMAL (6,2) UNSIGNED not null,
	cout_access_reseau_par_jour DECIMAL (6,2) UNSIGNED not null
) engine=InnoDB default charset latin1;

create table if not exists facture (
	id bigint auto_increment primary key,
	maisonId bigint not null,
	numeroFacture bigint not null,
	date_debut DATE,
	date_fin DATE,
	cout_kwh_jusqua_40kw_par_jour DECIMAL (6,2) UNSIGNED not null,
	cout_kwh_apres_40kw_par_jour DECIMAL (6,2) UNSIGNED not null,
	frais_access_reseau_par_jour  DECIMAL (6,2) UNSIGNED not null,
	total_sans_taxe  DECIMAL (6,2) UNSIGNED not null,
	CONSTRAINT fk_facture_maison foreign key(maisonId) references maison(id) ON DELETE CASCADE ON UPDATE CASCADE 
) engine=InnoDB default charset latin1;

INSERT INTO utilisateur VALUES(NULL, 'Liliana','lili@test.com','pass');

INSERT INTO maison VALUES(NULL, '123, 105E rue, Shawinigan', 'A1B 2C3',1);
INSERT INTO maison VALUES(NULL, '101, rue La Montagne, Sherbook', 'Z2X 3F9',1);

INSERT INTO appareil VALUES(NULL, 'Plinthe electrique', 1.5 );

INSERT INTO consommation VALUES(NULL, 1, 1, 3, 0, 3, 6);

INSERT INTO tarif_kwh VALUES(NULL, 2022, 0.0608, 0.0938, 0.4064);

INSERT INTO facture VALUES(NULL, 1, 1315, '2021-05-12', '2021-07-11', 115.00, 50.00, 10.00, 175.00);
INSERT INTO facture VALUES(NULL, 1, 1316, '2021-07-12', '2021-09-11', 120.33, 340.20, 24.0, 484.53);
INSERT INTO facture VALUES(NULL, 1, 1317, '2021-09-12', '2021-11-11', 120.33, 340.20, 24.0, 484.53);
INSERT INTO facture VALUES(NULL, 1, 1318, '2021-11-12', '2022-01-11', 120.33, 340.20, 24.0, 484.53);
INSERT INTO facture VALUES(NULL, 1, 1319, '2022-01-12', '2022-03-11', 120.33, 340.20, 24.0, 484.53);
INSERT INTO facture VALUES(NULL, 1, 1320, '2022-03-12', '2022-05-11', 120.33, 340.20, 24.0, 484.53);
