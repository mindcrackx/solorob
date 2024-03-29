USE solorob_db;

INSERT INTO tbl_rechte_funktion
    (rf_name)
VALUES
    ('Neubeschaffung'),
    ('Stammdatenverwaltung'),
    ('Ausmusterung'),
    ('Wartung'),
    ('Reporting');

INSERT INTO tbl_rechte_rolle
    (rr_name)
VALUES
    ('Systembetreuung'),
    ('Azubis'),
    ('Verwaltung'),
    ('Lehrkraft');

INSERT INTO tbl_rechte_zuordnung
    (rz_rolle_id, rz_funktion_id)
VALUES
    -- Systembetreuung
    (1, 1),
    (1, 2),
    (1, 3),
    (1, 4),
    (1, 5),
    -- Azubis
    (2, 1),
    (2, 2),
    (2, 3),
    (2, 4),
    (2, 5),
    -- Verwaltung
    (3, 5),
    -- Verwaltung
    (4, 5);

INSERT INTO tbl_raeume
    (r_nr, r_bezeichnung, r_notiz)
VALUES
    ('000', 'Ausmusterung', 'Hierhin werden ausgemusterte Komponenten verschoben.'),
    ('000', 'Lager', 'Hier befinden sich alle Komponenten die momentan keinem anderen Raum zugeordnet sind.');

INSERT INTO tbl_benutzer
    (b_name, b_vorname, b_nickname, b_password, b_rechte_rolle_id)
VALUES
    ('admin', 'admin', 'admin', '$2y$10$asYVvykhqIdLAwWZN72Dd.E2JQeviaf88uHr4DXEPyCTpS8hjWxeK', 1);