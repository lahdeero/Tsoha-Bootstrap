-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Laji (nimi) VALUES ('Suopallo');

INSERT INTO Kilpailu(nimi, laji_id) VALUES ('Vesalan suopallon sm', 1);

INSERT INTO Vedonlyoja (nimi, salasana, saldo, rekisteroitymispaiva, yllapitaja) VALUES ('Eero', 'eero123', 10.2, '2017-09-20', 1);
INSERT INTO Vedonlyoja (nimi, salasana, saldo, rekisteroitymispaiva) VALUES ('Matti', 'matti123', 15.6, '2017-09-23');
INSERT INTO Vedonlyoja (nimi, salasana, saldo, rekisteroitymispaiva) VALUES ('Sirkka', 'sirkka123', 100.8, '2017-09-23');
INSERT INTO Vedonlyoja (nimi, salasana, saldo, rekisteroitymispaiva, yllapitaja) VALUES ('Ohjaaja', 'ohja123', 0.0, '2017-09-29', 1);

INSERT INTO Kohde (nimi, tyyppi, sulkeutumisaika, kilpailu_id) VALUES ('Kuopolan koijaus - Keikkaus OU', '1X2', '2017-09-24 20:00:00', 1);
INSERT INTO Kohde (nimi, tyyppi, sulkeutumisaika, kilpailu_id) VALUES ('Pekkalan parhaat - Siippolan veijarit', '1X2', '2017-09-25 21:30:00', 1);
INSERT INTO Kohde (nimi, tyyppi, sulkeutumisaika, kilpailu_id) VALUES ('Jukolan jankkaajat - Mellulan melumiehet', '1X2', '2017-09-26 19:00:00', 1);

INSERT INTO Veto (merkki, panos, kohde_id, vedonlyoja_id) VALUES ('1', 10, 1, 1);
INSERT INTO Veto (merkki, panos, kohde_id, vedonlyoja_id) VALUES ('2', 17, 2, 2);
INSERT INTO Veto (merkki, panos, kohde_id, vedonlyoja_id) VALUES ('X', 12, 3, 3);

INSERT INTO Ehdotus (nimi, selvennys) VALUES ('Sulkavan sou-ut', 'Niin sellanen kisa että kuka soutaapi pisimpään, ois nii kiva saaha semmottii');
