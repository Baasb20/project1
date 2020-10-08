--Nashon Woldai--

--met dit statement maak je database aan
CREATE DATABASE project1;


-- met dit statement maak je in table in de database,genaamd account
CREATE TABLE account(
    id INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(250) NOT NULL,
    email VARCHAR(250) UNIQUE NOT NULL,
    usertype_id INT NOT NULL,
    password VARCHAR(250) NOT NULL,
    create_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL,
    PRIMARY KEY(id)
    FOREIGN KEY(usertype_id) REFERENCES usertype(id)
);


-- met dit statement maak je table in table in de database, genaamd usertype
CREATE TABLE usertype(
    id INT NOT NULL AUTO_INCREMENT,
    type VARCHAR(250) NOT NULL,
    created_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL,
    PRIMARY KEY(id),
);


-- met dit statement maak je table in de database, genaamd persoon
CREATE TABLE persoon(
    id INT NOT NULL AUTO_INCREMENT,
    account_id INT NOT NULL,
    firstname VARCHAR(250) NOT NULL,
    middlename VARCHAR(250),
    lastname VARCHAR(250) NOT NULL,
    create_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY (account_id) REFERENCES account(id)
);


-- met dit statement kan je gegevens inserten in de database table
INSERT INTO account (id, username, email, password) VALUES (1, "admin", "admin@rocva.nl", "admin1234")

INSERT INTO persoon (id, account_id, firstname, middlename, lastname) VALUES (1, 1, "admin", " ", "admin")
