-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Laji (nimi) VALUES ('Suopallo');

INSERT INTO Kilpailu(nimi, laji_id) VALUES ('Vesalan suopallon sm', 1);

INSERT INTO Yllapitaja (nimi, salasana) VALUES ('admin', 'password');

INSERT INTO Vedonlyoja (nimi, salasana, saldo, rekisteroitymispaiva) VALUES ('Eero', 'eero123', 10.2, '2017-09-20');
INSERT INTO Vedonlyoja (nimi, salasana, saldo, rekisteroitymispaiva) VALUES ('Matti', 'matti123', 15.2, '2017-09-23');
INSERT INTO Vedonlyoja (nimi, salasana, saldo, rekisteroitymispaiva) VALUES ('Sirkka', 'sirkka123', 100.2, '2017-09-23');

INSERT INTO Kohde (nimi, tyyppi, sulkeutumisaika, kilpailu_id) VALUES ('Kuopolan koijaus - Keikkaus OU', '1X2', '2017-09-24 20:00:00', 1);
INSERT INTO Kohde (nimi, tyyppi, sulkeutumisaika, kilpailu_id) VALUES ('Pekkalan parhaat - Siippolan veijarit', '1X2', '2017-09-25 20:00:00', 1);
INSERT INTO Kohde (nimi, tyyppi, sulkeutumisaika, kilpailu_id) VALUES ('Jukolan jankkaajat - Mellulan melumiehet', '1X2', '2017-09-26 19:00:00', 1);

INSERT INTO Veto (merkki, panos, kohde_id, vedonlyoja_id) VALUES (1, 10, 1, 1);
INSERT INTO Veto (merkki, panos, kohde_id, vedonlyoja_id) VALUES (2, 17, 2, 1);
INSERT INTO Veto (merkki, panos, kohde_id, vedonlyoja_id) VALUES (0, 12, 3, 1);
