-- =====================================================
-- Création de la table : users
-- =====================================================

SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    nickname VARCHAR(255) NOT NULL,
    avatar VARCHAR(255)
);

INSERT INTO users (login, password, nickname, avatar) VALUES
('camilleclublit',  '$2y$demo$001', 'CamilleClubLit',  'camille.jpg'),
('alexlecture',     '$2y$10$si2KOtOxbRUdzU76j1JMwunFe4wiQngQ/hVRvO2F.twNDpG8xtu7O', 'Alexlecture',     'alex.jpg'),
('hugo1990_12',     '$2y$demo$003', 'Hugo1990.12',     'hugo.jpg'),
('juju1432',        '$2y$10$KGjiwO9BKJ.r9Q5lerL.p.Nuc2R95dR9kEDwwAAEbCPQ5kZWUsqeu', 'Juju1432',        'juju.jpg'),
('christiane75014', '$2y$demo$005', 'Christiane75014', 'christiane.jpg'),
('hamzalecture',    '$2y$demo$006', 'Hamzalecture',    'hamza.jpg'),
('louben50',        '$2y$demo$007', 'LouBen50',        'louben.jpg'),
('lolobzh',         '$2y$demo$008', 'Lolobzh',         'lolobzh.jpg'),
('sas634',          '$2y$demo$009', 'Sas634',          'sas634.jpg'),
('ml95',            '$2y$demo$010', 'ML95',            'ml95.jpg'),
('vergo933',        '$2y$demo$011', 'Vergo933',        'vergo933.jpg'),
('anikabrabms',     '$2y$demo$012', 'AnikaBrabms',     'anika.jpg'),
('victoriefabr912', '$2y$demo$013', 'VictorieFabr912', 'victorie.jpg'),
('lofranclub67',    '$2y$demo$014', 'Lofranclub67',    'lofran.jpg');

-- =====================================================
-- Création de la table : books
-- =====================================================

DROP TABLE IF EXISTS books;

CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    comment TEXT,
    author VARCHAR(255),
    available BOOLEAN NOT NULL DEFAULT TRUE,
    photo VARCHAR(255),
    user_id INT
);

-- =====================================================
-- Insertion des livres
-- =====================================================

INSERT INTO books (title, comment, author, available, photo, user_id) VALUES
(
    'Esther',
    'Roman contemplatif autour du voyage intérieur et des paysages naturels.',
    'Alabaster',
    TRUE,
    'esther.webp',
    1
),
(
    'The Kinfolk Table',
    'Livre lifestyle consacré aux repas conviviaux et à l’art de vivre.',
    'Nathan Williams',
    TRUE,
    'the-kinfolk-table.jpg',
    3
),
(
    'Wabi Sabi',
    'Ouvrage inspiré de la philosophie japonaise de la simplicité.',
    'Beth Kempton',
    TRUE,
    'wabi-sabi.jpg',
    4
),
(
    'Milk & Honey',
    'Recueil de poésie moderne abordant l’amour et la reconstruction.',
    'Rupi Kaur',
    TRUE,
    'milk-and-honey.jpg',
    1
),
(
    'Delight!',
    'Livre de développement personnel autour de la créativité et de la joie.',
    'Justin Rossow',
    FALSE,
    'delight.jpg',
    2
),
(
    'Milwaukee Mission',
    'Roman dramatique sur la foi, la famille et la rédemption.',
    'Elder Cooper Low',
    TRUE,
    'milwaukee-mission.jpg',
    10
),
(
    'Minimalist Graphics',
    'Collection de compositions graphiques minimalistes et modernes.',
    'Julia Schonlau',
    TRUE,
    'minimalist-graphics.webp',
    7
),
(
    'Hygge',
    'Guide illustré sur le bien-être et le mode de vie scandinave.',
    'Meik Wiking',
    TRUE,
    'hygge.jpg',
    3
),
(
    'Innovation',
    'Essai sur les mécanismes de l’innovation et les idées disruptives.',
    'Matt Ridley',
    FALSE,
    'innovation.webp',
    1
),
(
    'Psalms',
    'Livre illustré inspiré des psaumes et de la méditation.',
    'Alabaster',
    TRUE,
    'psalms.jpg',
    8
),
(
    'Thinking, Fast & Slow',
    'Best-seller sur les biais cognitifs et la prise de décision humaine.',
    'Daniel Kahneman',
    FALSE,
    'thinking-fast-slow.jpg',
    9
),
(
    'A Book Full Of Hope',
    'Petit ouvrage motivant centré sur l’espoir et les nouveaux départs.',
    'Rupi Kaur',
    TRUE,
    'the-book-of-hope.jpg',
    1
),
(
    'The Subtle Art Of Not Giving A F*ck',
    'Livre de développement personnel au ton direct et humoristique.',
    'Mark Manson',
    TRUE,
    'subtle-art.jpg',
    11
),
(
    'Narnia',
    'Roman de fantasy classique se déroulant dans le monde magique de Narnia.',
    'C.S. Lewis',
    FALSE,
    'narnia.jpg',
    2
),
(
    'Company Of One',
    'Livre business sur l’entrepreneuriat indépendant et durable.',
    'Paul Jarvis',
    TRUE,
    'company-of-one.jpg',
    2
),
(
    'The Two Towers',
    'Deuxième tome de la trilogie du Seigneur des Anneaux.',
    'J.R.R. Tolkien',
    TRUE,
    'the-two-towers.jpg',
    14
);

-- Clé étrangère

ALTER TABLE books ADD CONSTRAINT fk_books_user FOREIGN KEY (user_id) REFERENCES users(id);

