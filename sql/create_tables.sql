CREATE TABLE Kohde(
	id SERIAL PRIMARY KEY,
	nimi varchar(50),
	tyyppi varchar(50),
	sulkeutumisaika DATE
);

CREATE TABLE Vedonlyoja(
	id SERIAL PRIMARY KEY,
	nimi varchar(20),
	salasana varchar(20),
	saldo decimal
);

CREATE TABLE Veto(
	id SERIAL PRIMARY KEY,
	merkki integer,
	summa decimal,
	kohde_id integer,
	vedonlyoja_id integer,
	FOREIGN KEY(kohde_id) REFERENCES Kohde(id),
	FOREIGN KEY(vedonlyoja_id) REFERENCES Vedonlyoja(id)
);

CREATE TABLE Yllapitaja(
	id SERIAL PRIMARY KEY,
	nimi varchar(20),
	salasana varchar(20)
);

CREATE TABLE Laji(
	id SERIAL PRIMARY KEY,
	nimi varchar(50)
);

CREATE TABLE Kilpailu(
	id SERIAL PRIMARY KEY,
	nimi varchar(50)
);
