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