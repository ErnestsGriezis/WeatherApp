CREATE TABLE IF NOT EXISTS cities
(
    id
    SERIAL
    PRIMARY
    KEY,
    name
    VARCHAR
(
    120
) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT NOW
(
)
    );

INSERT INTO cities (name)
VALUES ('Riga'),
       ('London'),
       ('New York'),
       ('Tokyo'),
       ('Sydney'),
       ('Berlin'),
       ('Paris'),
       ('Dubai'),
       ('Toronto'),
       ('Singapore') ON CONFLICT (name) DO NOTHING;
