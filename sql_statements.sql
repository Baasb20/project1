--Nashon Woldai--

--met dit statement maak je database aan
CREATE DATABASE project1;


-- met dit statement maak je in table in de database,genaamd account
CREATE TABLE account(
    id INT NOT NULL AUTO_INCREMENT,
    email VARCHAR(250) UNIQUE NOT NULL,
    password VARCHAR(250) NOT NULL,
    PRIMARY KEY(id)
);


-- met dit statement maak je table in de database, genaamd persoon.
CREATE TABLE persoon(
    id INT NOT NULL AUTO_INCREMENT,
    account_id INT NOT NULL,
    voornaam VARCHAR(250) NOT NULL,
    tussenvoegsel VARCHAR(250),
    achternaam VARCHAR(250) NOT NULL,
    gebruikersnaam VARCHAR (250) UNIQUE NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY (account_id) REFERENCES account(id)
);
