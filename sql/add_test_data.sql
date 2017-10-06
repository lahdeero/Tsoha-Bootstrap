-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Laji (nimi) VALUES ('Suopallo');
INSERT INTO Laji (nimi) VALUES ('Vesihiihto');
INSERT INTO Laji (nimi) VALUES ('Lumiluistelu');
INSERT INTO Laji (nimi) VALUES ('Sauvanheitto');

INSERT INTO Vedonlyoja (nimi, salasana, saldo, rekisteroitymispaiva, yllapitaja) VALUES ('Eero', 'eero123', 10.2, '2017-09-20', 1);
INSERT INTO Vedonlyoja (nimi, salasana, saldo, rekisteroitymispaiva) VALUES ('Matti', 'matti123', 15.6, '2017-09-23');
INSERT INTO Vedonlyoja (nimi, salasana, saldo, rekisteroitymispaiva) VALUES ('Sirkka', 'sirkka123', 100.8, '2017-09-23');
INSERT INTO Vedonlyoja (nimi, salasana, saldo, rekisteroitymispaiva, yllapitaja) VALUES ('Ohjaaja', 'ohja123', 0.0, '2017-09-29', 1);

INSERT INTO Kohde (nimi, tyyppi, sulkeutumisaika, laji_id) VALUES ('Kuopolan koijaus - Keikkaus OU', '1X2', '2017-09-24T20:00:00', 1);
INSERT INTO Kohde (nimi, tyyppi, sulkeutumisaika, laji_id) VALUES ('Pekkalan parhaat - Siippolan veijarit', '1X2', '2017-09-25T21:30:00', 1);
INSERT INTO Kohde (nimi, tyyppi, sulkeutumisaika, laji_id) VALUES ('Jukolan jankkaajat - Mellulan melumiehet', '1X2', '2017-09-26T19:00:00', 1);

INSERT INTO Valinta(nimi, kohde_id) VALUES ('Kuopolan koijaus', 1);
INSERT INTO Valinta(nimi, kohde_id) VALUES ('Tasapeli', 1);
INSERT INTO Valinta(nimi, kohde_id) VALUES ('Keikkaus OU', 1);

INSERT INTO Valinta(nimi, kohde_id) VALUES ('Pekkalan parhaat', 2);
INSERT INTO Valinta(nimi, kohde_id) VALUES ('Tasapeli', 2);
INSERT INTO Valinta(nimi, kohde_id) VALUES ('Siippolan veijarit', 2);

INSERT INTO Valinta(nimi, kohde_id) VALUES ('Jukolan jankkaajat', 3);
INSERT INTO Valinta(nimi, kohde_id) VALUES ('Tasapeli', 3);
INSERT INTO Valinta(nimi, kohde_id) VALUES ('Mellulan melumiehet', 3);

INSERT INTO Veto (panos, kohde_id, vedonlyoja_id, valinta_id) VALUES (10, 1, 1, 1);
INSERT INTO Veto (panos, kohde_id, vedonlyoja_id, valinta_id) VALUES (17, 2, 2, 2);
INSERT INTO Veto (panos, kohde_id, vedonlyoja_id, valinta_id) VALUES (12, 3, 3, 2);

INSERT INTO Ehdotus (nimi, selvennys) VALUES ('Sulkavan sou-ut', 'Niin sellanen kisa että kuka soutaapi pisimpään, ois nii kiva saaha semmottii');
