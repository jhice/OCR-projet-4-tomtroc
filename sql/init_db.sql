-- =====================================================
-- Création de la table : books
-- =====================================================

DROP TABLE IF EXISTS books;

CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    comment TEXT,
    available BOOLEAN NOT NULL DEFAULT TRUE,
    photo VARCHAR(255)
);

-- =====================================================
-- Insertion de quelques œuvres
-- =====================================================

INSERT INTO books (title, comment, available, photo) VALUES
(
    'Esther',
    'Roman contemplatif autour du voyage intérieur et des paysages naturels.',
    TRUE,
    'esther.jpg'
),
(
    'The Kinfolk Table',
    'Livre lifestyle consacré aux repas conviviaux et à l’art de vivre.',
    TRUE,
    'the-kinfolk-table.jpg'
),
(
    'Wabi Sabi',
    'Ouvrage inspiré de la philosophie japonaise de la simplicité.',
    TRUE,
    'wabi-sabi.jpg'
),
(
    'Milk & Honey',
    'Recueil de poésie moderne abordant l’amour et la reconstruction.',
    TRUE,
    'milk-and-honey.jpg'
),
(
    'Delight!',
    'Livre de développement personnel autour de la créativité et de la joie.',
    FALSE,
    'delight.jpg'
),
(
    'Milwaukee Mission',
    'Roman dramatique sur la foi, la famille et la rédemption.',
    TRUE,
    'milwaukee-mission.jpg'
),
(
    'Minimalist Graphics',
    'Collection de compositions graphiques minimalistes et modernes.',
    TRUE,
    'minimalist-graphics.jpg'
),
(
    'Hygge',
    'Guide illustré sur le bien-être et le mode de vie scandinave.',
    TRUE,
    'hygge.jpg'
),
(
    'Innovation',
    'Essai sur les mécanismes de l’innovation et les idées disruptives.',
    TRUE,
    'innovation.jpg'
),
(
    'Psalms',
    'Livre illustré inspiré des psaumes et de la méditation.',
    TRUE,
    'psalms.jpg'
),
(
    'Thinking, Fast & Slow',
    'Best-seller sur les biais cognitifs et la prise de décision humaine.',
    FALSE,
    'thinking-fast-slow.jpg'
),
(
    'A Book Full Of Hope',
    'Petit ouvrage motivant centré sur l’espoir et les nouveaux départs.',
    TRUE,
    'book-full-of-hope.jpg'
),
(
    'The Subtle Art Of Not Giving A F*ck',
    'Livre de développement personnel au ton direct et humoristique.',
    TRUE,
    'subtle-art.jpg'
),
(
    'Narnia',
    'Roman de fantasy classique se déroulant dans le monde magique de Narnia.',
    FALSE,
    'narnia.jpg'
),
(
    'Company Of One',
    'Livre business sur l’entrepreneuriat indépendant et durable.',
    TRUE,
    'company-of-one.jpg'
),
(
    'The Two Towers',
    'Deuxième tome de la trilogie du Seigneur des Anneaux.',
    TRUE,
    'the-two-towers.jpg'
);