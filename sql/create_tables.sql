CREATE TABLE Laji(
	id SERIAL PRIMARY KEY,
	nimi varchar(50)
);

CREATE TABLE Kilpailu(
	id SERIAL PRIMARY KEY,
	nimi varchar(50),
	laji_id integer,
	FOREIGN KEY(laji_id) REFERENCES Laji(id)
);

CREATE TABLE Kohde(
	id SERIAL PRIMARY KEY,
	nimi varchar(50),
	tyyppi varchar(50),
	sulkeutumisaika TIMESTAMP,
	tulos varchar(8),
	kilpailu_id integer,
	FOREIGN KEY(kilpailu_id) REFERENCES Kilpailu(id)
);

CREATE TABLE Vedonlyoja(
	id SERIAL PRIMARY KEY,
	nimi varchar(20) NOT NULL UNIQUE,
	salasana varchar(20),
	saldo decimal,
	rekisteroitymispaiva DATE
);

CREATE TABLE Veto(
	id SERIAL PRIMARY KEY,
	merkki varchar(3),
	panos decimal,
	palautus decimal,
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
