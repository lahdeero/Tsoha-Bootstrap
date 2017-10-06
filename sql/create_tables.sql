CREATE TABLE Laji(
	id SERIAL PRIMARY KEY,
	nimi varchar(50) UNIQUE
);

CREATE TABLE Kohde(
	id SERIAL PRIMARY KEY,
	nimi varchar(50),
	tyyppi varchar(50),
	sulkeutumisaika varchar(50),
	tulos varchar(8),
	laji_id INTEGER REFERENCES Laji(id)
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
	kohde_id integer,
	FOREIGN KEY(kohde_id) REFERENCES Kohde(id)
);

CREATE TABLE Veto(
	id SERIAL PRIMARY KEY,
	panos decimal,
	palautus decimal,
	kohde_id integer,
	vedonlyoja_id integer,
	valinta_id integer,
	FOREIGN KEY(kohde_id) REFERENCES Kohde(id) ON DELETE CASCADE,
	FOREIGN KEY(vedonlyoja_id) REFERENCES Vedonlyoja(id),
	FOREIGN KEY(valinta_id) REFERENCES Valinta(id)
);

CREATE TABLE Ehdotus(
	id SERIAL PRIMARY KEY,
	nimi varchar(20) NOT NULL,
	selvennys varchar(500),
	laji_id integer,
	FOREIGN KEY(laji_id) REFERENCES Laji(id)
)
