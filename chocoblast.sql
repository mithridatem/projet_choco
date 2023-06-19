-- création de la base de données
create database chocoblast;
use chocoblast;

-- création des tables
create table utilisateur(
id_utilisateur int primary key not null,
nom_utilisateur varchar(50) not null,
prenom_utilisateur varchar(50) not null,
mail_utilisateur varchar(50) not null,
password_utilisateur varchar(100) not null,
image_utilisateur varchar(100) null,
statut_utilisateur tinyint(1) default 0,
id_roles int null
)Engine=InnoDB;

create table roles(
id_roles int primary key not null,
nom_roles varchar(50) not null
)Engine=InnoDB;

create table chocoblast(
id_chocoblast int primary key not null,
slogan_chocoblast text not null,
date_chocoblast date not null,
statut_chocoblast tinyint(1) default 0,
cible_chocoblast int not null,
auteur_chocoblast int not null
)Engine=InnoDB;

create table commentaire(
id_commentaire int primary key not null,
note_commentaire int not null,
text_commentaire text not null,
date_commentaire datetime not null,
statut_commentaire tinyint(1) default 0,
id_chocoblast int not null,
auteur_commentaire int not null
)Engine=InnoDB;

-- ajout des contraintes
alter table utilisateur
add constraint fk_posseder_roles
foreign key(id_roles)
references roles(id_roles);

alter table chocoblast
add constraint fk_chocoblaster_chocoblast
foreign key(auteur_chocoblast)
references utilisateur(id_utilisateur);

alter table chocoblast
add constraint fk_cibler_chocoblast
foreign key(cible_chocoblast)
references utilisateur(id_utilisateur);

alter table commentaire
add constraint fk_poster_commentaire
foreign key(auteur_commentaire)
references utilisateur(id_utilisateur);

alter table commentaire
add constraint fk_rattacher_commentaire
foreign key(id_chocoblast)
references chocoblast(id_chocoblast);

