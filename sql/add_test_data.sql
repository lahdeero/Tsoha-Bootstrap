-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Vedonlyoja (nimi, salasana, saldo) VALUES ('Eero', 'Eero123', 10.2);
INSERT INTO Kohde (nimi, tyyppi, sulkeutumisaika) VALUES ('Kuopolan koijaus - Keikkaus OU', '1X2', '16.9.2017');
INSERT INTO Kohde (nimi, tyyppi, sulkeutumisaika) VALUES ('Pekkalan parhaat - Siippolan veijarit', '1X2', '17.9.2017');
INSERT INTO Kohde (nimi, tyyppi, sulkeutumisaika) VALUES ('Jukolan jankkaajat - Mellulan melumiehet', '1X2', '17.9.2017');
INSERT INTO Veto (merkki, summa, kohde_id, vedonlyoja_id) VALUES (1, 10, 1, 1);
INSERT INTO Veto (merkki, summa, kohde_id, vedonlyoja_id) VALUES (2, 17, 2, 1);
INSERT INTO Veto (merkki, summa, kohde_id, vedonlyoja_id) VALUES (0, 12, 3, 1);
INSERT INTO Yllapitaja (nimi, salasana) VALUES ('admin', 'password');
INSERT INTO Laji (nimi) VALUES ('Vesihiihto');
INSERT INTO Kilpailu(nimi) VALUES ('Vesalan vesihiihdon sm');
