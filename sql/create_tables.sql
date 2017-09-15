CREATE TABLE Veto(
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

CREATE TABLE Yllapitaja(
	id SERIAL PRIMARY KEY,
	nimi varchar(20),
	salasana varchar(20),
	saldo decimal
);

CREATE TABLE Laji(
	id SERIAL PRIMARY KEY,
	nimi varchar(20)
);

CREATE TABLE Kilpailu(
	id SERIAL PRIMARY KEY,
	nimi varchar(20)
);
