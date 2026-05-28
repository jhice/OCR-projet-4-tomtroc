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
    photo VARCHAR(255)
);

-- =====================================================
-- Insertion des livres visibles sur la capture
-- =====================================================

INSERT INTO books (title, comment, author, available, photo) VALUES
(
    'Esther',
    'Roman contemplatif autour du voyage intérieur et des paysages naturels.',
    'Alabaster',
    TRUE,
    'esther.webp'
),
(
    'The Kinfolk Table',
    'Livre lifestyle consacré aux repas conviviaux et à l’art de vivre.',
    'Nathan Williams',
    TRUE,
    'the-kinfolk-table.jpg'
),
(
    'Wabi Sabi',
    'Ouvrage inspiré de la philosophie japonaise de la simplicité.',
    'Beth Kempton',
    TRUE,
    'wabi-sabi.jpg'
),
(
    'Milk & Honey',
    'Recueil de poésie moderne abordant l’amour et la reconstruction.',
    'Rupi Kaur',
    TRUE,
    'milk-and-honey.jpg'
),
(
    'Delight!',
    'Livre de développement personnel autour de la créativité et de la joie.',
    'Justin Rossow',
    FALSE,
    'delight.jpg'
),
(
    'Milwaukee Mission',
    'Roman dramatique sur la foi, la famille et la rédemption.',
    'Elder Cooper Low',
    TRUE,
    'milwaukee-mission.jpg'
),
(
    'Minimalist Graphics',
    'Collection de compositions graphiques minimalistes et modernes.',
    'Julia Schonlau',
    TRUE,
    'minimalist-graphics.webp'
),
(
    'Hygge',
    'Guide illustré sur le bien-être et le mode de vie scandinave.',
    'Meik Wiking',
    TRUE,
    'hygge.jpg'
),
(
    'Innovation',
    'Essai sur les mécanismes de l’innovation et les idées disruptives.',
    'Matt Ridley',
    TRUE,
    'innovation.webp'
),
(
    'Psalms',
    'Livre illustré inspiré des psaumes et de la méditation.',
    'Alabaster',
    TRUE,
    'psalms.jpg'
),
(
    'Thinking, Fast & Slow',
    'Best-seller sur les biais cognitifs et la prise de décision humaine.',
    'Daniel Kahneman',
    FALSE,
    'thinking-fast-slow.jpg'
),
(
    'Book Of Hope',
    'A Survival Guide for an Endangered Planet.',
    'Jane Goodall',
    TRUE,
    'the-book-of-hope.jpg'
),
(
    'The Subtle Art Of Not Giving A F*ck',
    'Livre de développement personnel au ton direct et humoristique.',
    'Mark Manson',
    TRUE,
    'subtle-art.jpg'
),
(
    'Narnia',
    'Roman de fantasy classique se déroulant dans le monde magique de Narnia.',
    'C.S. Lewis',
    FALSE,
    'narnia.jpg'
),
(
    'Company Of One',
    'Livre business sur l’entrepreneuriat indépendant et durable.',
    'Paul Jarvis',
    TRUE,
    'company-of-one.jpg'
),
(
    'The Two Towers',
    'Deuxième tome de la trilogie du Seigneur des Anneaux.',
    'J.R.R. Tolkien',
    TRUE,
    'the-two-towers.jpg'
);