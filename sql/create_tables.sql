CREATE TABLE Laji(
	id SERIAL PRIMARY KEY,
	nimi varchar(70) UNIQUE
);

CREATE TABLE Kohde(
	id SERIAL PRIMARY KEY,
	nimi varchar(70),
	tyyppi varchar(25),
	sulkeutumisaika varchar(50),
	tulos integer,
	laji_id integer REFERENCES Laji(id)
);

CREATE TABLE Vedonlyoja(
	id SERIAL PRIMARY KEY,
	nimi varchar(20) NOT NULL UNIQUE,
	salasana varchar(20),
	saldo decimal,
	rekisteroitymispaiva DATE,
	yllapitaja integer DEFAULT 0
);

CREATE TABLE Valinta(
	id SERIAL PRIMARY KEY,
	nimi varchar(25),
	kerroin decimal,
	kohde_id integer,
	FOREIGN KEY(kohde_id) REFERENCES Kohde(id) ON DELETE CASCADE
);

CREATE TABLE Veto(
	id SERIAL PRIMARY KEY,
	panos decimal,
	palautus decimal,
	kohde_id integer,
	vedonlyoja_id integer,
	valinta_id integer,
	FOREIGN KEY(kohde_id) REFERENCES Kohde(id) ON DELETE CASCADE,
	FOREIGN KEY(vedonlyoja_id) REFERENCES Vedonlyoja(id) ON DELETE CASCADE,
	FOREIGN KEY(valinta_id) REFERENCES Valinta(id) ON DELETE SET NULL
);

CREATE TABLE Ehdotus(
	id SERIAL PRIMARY KEY,
	nimi varchar(70) NOT NULL,
	selvennys varchar(505),
	laji_id integer,
	FOREIGN KEY(laji_id) REFERENCES Laji(id)
);
