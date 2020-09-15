--Nashon Woldai--

--met dit statement maak je database aan
CREATE DATABASE project1;


-- met dit statement maak je in table in de database,genaamd account
CREATE TABLE account(
id int not null AUTO_INCREMENT,
email varchar(250) UNIQUE,
password varchar(250),
PRIMARY KEY(id)
);


-- met dit statement maak je table in de database, genaamd persoon.
CREATE TABLE persoon(
id int NOT null AUTO_INCREMENT,
voornaam varchar(250),
tussenvoegsel varchar(250),
achternaam varchar(250),
gebruikersnaam varchar (250),
PRIMARY KEY(id),
account_id int REFERENCES account(id)
);
