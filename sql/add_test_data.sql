-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Laji (nimi) VALUES ('Suopallo');
INSERT INTO Laji (nimi) VALUES ('Vesihiihto');
INSERT INTO Laji (nimi) VALUES ('Lumiluistelu');
INSERT INTO Laji (nimi) VALUES ('Sauvanheitto');

INSERT INTO Vedonlyoja (nimi, salasana, saldo, rekisteroitymispaiva, yllapitaja) VALUES ('Eero', 'eero123', 10.2, '2017-09-20', 1);
INSERT INTO Vedonlyoja (nimi, salasana, saldo, rekisteroitymispaiva) VALUES ('Matti', 'matti123', 15.6, '2017-09-23');
INSERT INTO Vedonlyoja (nimi, salasana, saldo, rekisteroitymispaiva) VALUES ('Sirkka', 'sirkka123', 100.8, '2017-09-23');
INSERT INTO Vedonlyoja (nimi, salasana, saldo, rekisteroitymispaiva, yllapitaja) VALUES ('Ohjaaja', 'ohja123', 1337, '2017-09-29', 1);

INSERT INTO Kohde (nimi, tyyppi, sulkeutumisaika, laji_id) VALUES ('Kuopolan koijaus - Keikkaus OU', '1X2', '2017-09-24T20:00', 1);
INSERT INTO Kohde (nimi, tyyppi, sulkeutumisaika, laji_id) VALUES ('Pekkalan parhaat - Siippolan veijarit', '1X2', '2017-09-25T21:30', 1);
INSERT INTO Kohde (nimi, tyyppi, sulkeutumisaika, laji_id) VALUES ('Jukolan jankkaajat - Mellulan melumiehet', '1X2', '2017-09-26T19:00', 1);
INSERT INTO Kohde (nimi, tyyppi, sulkeutumisaika, laji_id) VALUES ('Vesihiihdon ALMM', 'Voittajaveto', '2017-12-24T22:00', 2);
INSERT INTO Kohde (nimi, tyyppi, sulkeutumisaika, laji_id) VALUES ('Lumiluistelun MM', 'Voittajaveto', '2017-12-24T22:00', 3);

INSERT INTO Valinta(nimi, kerroin, kohde_id) VALUES ('Kuopolan koijaus', 1.8, 1);
INSERT INTO Valinta(nimi, kerroin, kohde_id) VALUES ('Tasapeli', 3.5, 1);
INSERT INTO Valinta(nimi, kerroin, kohde_id) VALUES ('Keikkaus OU', 2.4, 1);

INSERT INTO Valinta(nimi, kerroin, kohde_id) VALUES ('Pekkalan parhaat', 2.9, 2);
INSERT INTO Valinta(nimi, kerroin, kohde_id) VALUES ('Tasapeli', 4.0, 2);
INSERT INTO Valinta(nimi, kerroin, kohde_id) VALUES ('Siippolan veijarit', 2.8, 2);

INSERT INTO Valinta(nimi, kerroin, kohde_id) VALUES ('Jukolan jankkaajat', 1.8, 3);
INSERT INTO Valinta(nimi, kerroin, kohde_id) VALUES ('Tasapeli', 4.0, 3);
INSERT INTO Valinta(nimi, kerroin, kohde_id) VALUES ('Mellulan melumiehet', 1.8, 3);

INSERT INTO Valinta(nimi, kerroin, kohde_id) VALUES ('Roope', 1.8, 4);
INSERT INTO Valinta(nimi, kerroin, kohde_id) VALUES ('Aku', 2.4, 4);
INSERT INTO Valinta(nimi, kerroin, kohde_id) VALUES ('Hessu', 3.3, 4);
INSERT INTO Valinta(nimi, kerroin, kohde_id) VALUES ('Iines', 4.1, 4);
INSERT INTO Valinta(nimi, kerroin, kohde_id) VALUES ('Mikki', 4.2, 4);
INSERT INTO Valinta(nimi, kerroin, kohde_id) VALUES ('Minni', 5.7, 4);
INSERT INTO Valinta(nimi, kerroin, kohde_id) VALUES ('Tulppu', 6.9, 4);
INSERT INTO Valinta(nimi, kerroin, kohde_id) VALUES ('Kroisos', 7.7, 4);

INSERT INTO Valinta(nimi, kerroin, kohde_id) VALUES ('Kiiraa Korpee', 1.7, 5);
INSERT INTO Valinta(nimi, kerroin, kohde_id) VALUES ('Petrii Kokkoon', 2.5, 5);
INSERT INTO Valinta(nimi, kerroin, kohde_id) VALUES ('Elinaa Ketuttaa', 3.3, 5);
INSERT INTO Valinta(nimi, kerroin, kohde_id) VALUES ('Laura Lepäilee', 4.1, 5);
INSERT INTO Valinta(nimi, kerroin, kohde_id) VALUES ('Kristiina WYSIWYG', 4.4, 5);
INSERT INTO Valinta(nimi, kerroin, kohde_id) VALUES ('Marcus Nikkaroi', 5.7, 5);
INSERT INTO Valinta(nimi, kerroin, kohde_id) VALUES ('Belaa Pappina', 6.9, 5);
INSERT INTO Valinta(nimi, kerroin, kohde_id) VALUES ('Jussivillelle Parta', 7.7, 5);

INSERT INTO Veto (panos, kohde_id, vedonlyoja_id, valinta_id) VALUES (10, 1, 1, 1);
INSERT INTO Veto (panos, kohde_id, vedonlyoja_id, valinta_id) VALUES (17, 2, 2, 2);
INSERT INTO Veto (panos, kohde_id, vedonlyoja_id, valinta_id) VALUES (12, 3, 3, 2);

INSERT INTO Ehdotus (nimi, selvennys) VALUES ('Sulkavan sou-ut', 'Niin sellanen kisa että kuka soutaapi pisimpään, ois nii kiva saaha semmottii');
INSERT INTO Ehdotus (nimi, selvennys) VALUES ('Sivuston ehrotustoiminto', 'Niin semmone veikkaus että millonkoha ehotustoiminto toimis');
