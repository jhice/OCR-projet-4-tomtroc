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
-- pwd : alexlecture
('alexlecture',     '$2y$10$si2KOtOxbRUdzU76j1JMwunFe4wiQngQ/hVRvO2F.twNDpG8xtu7O', 'Alexlecture',     'alex.jpg'),
('hugo1990_12',     '$2y$demo$003', 'Hugo1990.12',     'hugo.jpg'),
-- pwd : juju1432
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

-- =====================================================
-- Création de la table : conversations
-- =====================================================

DROP TABLE IF EXISTS conversations;

CREATE TABLE conversations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user1_id INT NOT NULL,
    user2_id INT NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    FOREIGN KEY (user1_id) REFERENCES users(id),
    FOREIGN KEY (user2_id) REFERENCES users(id)
);

-- =====================================================
-- Création de la table : messages
-- =====================================================

DROP TABLE IF EXISTS messages;

CREATE TABLE messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    conversation_id INT NOT NULL,
    sender_id INT NOT NULL,
    receiver_id INT NOT NULL,
    content TEXT NOT NULL,
    is_read BOOLEAN NOT NULL DEFAULT FALSE,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (conversation_id) REFERENCES conversations(id),
    FOREIGN KEY (sender_id) REFERENCES users(id),
    FOREIGN KEY (receiver_id) REFERENCES users(id)
);

INSERT INTO conversations (id, user1_id, user2_id) VALUES
(1, 1, 12),
(2, 1, 2),
(3, 3, 5),
(4, 7, 10),
(5, 4, 14);

INSERT INTO messages
(conversation_id, sender_id, receiver_id, content, is_read, created_at)
VALUES

-- Conversation 1
(
    1,
    1,
    12,
    'Bonjour Anika, je suis intéressée par votre exemplaire de Narnia.',
    TRUE,
    '2026-05-20 09:15:00'
),
(
    1,
    12,
    1,
    'Bonjour Camille, il est toujours disponible.',
    TRUE,
    '2026-05-20 09:18:00'
),
(
    1,
    1,
    12,
    'Seriez-vous intéressée par un échange contre Esther ?',
    TRUE,
    '2026-05-20 09:21:00'
),
(
    1,
    12,
    1,
    'Oui pourquoi pas, pouvez-vous m’envoyer une photo ?',
    FALSE,
    '2026-05-20 09:25:00'
),

-- Conversation 2
(
    2,
    2,
    1,
    'Bonjour, The Kinfolk Table est-il toujours disponible ?',
    TRUE,
    '2026-05-19 14:10:00'
),
(
    2,
    1,
    2,
    'Bonjour, oui tout à fait.',
    TRUE,
    '2026-05-19 14:17:00'
),
(
    2,
    2,
    1,
    'Parfait, je peux proposer Hygge en échange.',
    FALSE,
    '2026-05-19 14:23:00'
),

-- Conversation 3
(
    3,
    3,
    5,
    'Bonjour, votre livre Delight! m’intéresse.',
    TRUE,
    '2026-05-18 18:02:00'
),
(
    3,
    5,
    3,
    'Malheureusement il n’est plus disponible.',
    TRUE,
    '2026-05-18 18:11:00'
),

-- Conversation 4
(
    4,
    7,
    10,
    'Bonjour, acceptez-vous un échange contre Innovation ?',
    TRUE,
    '2026-05-17 11:05:00'
),
(
    4,
    10,
    7,
    'Bonjour, oui cela peut m’intéresser.',
    TRUE,
    '2026-05-17 11:13:00'
),
(
    4,
    7,
    10,
    'Je vous envoie des photos ce soir.',
    FALSE,
    '2026-05-17 11:16:00'
),

-- Conversation 5
(
    5,
    14,
    4,
    'Bonjour, The Two Towers est-il en bon état ?',
    TRUE,
    '2026-05-16 08:30:00'
),
(
    5,
    4,
    14,
    'Oui, quelques traces d’usage mais rien de gênant.',
    TRUE,
    '2026-05-16 08:37:00'
),
(
    5,
    14,
    4,
    'Merci pour votre retour !',
    FALSE,
    '2026-05-16 08:40:00'
);