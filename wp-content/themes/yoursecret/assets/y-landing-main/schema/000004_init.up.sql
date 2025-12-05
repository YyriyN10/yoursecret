CREATE TABLE IF NOT EXISTS news_posts
(
    id         SERIAL PRIMARY KEY,
    title      TEXT,
    image_link TEXT,
    short_text TEXT,
    full_text  TEXT,
    created_at TIMESTAMPTZ,
    updated_at TIMESTAMPTZ
);

CREATE TABLE IF NOT EXISTS blog_posts
(
    id         SERIAL PRIMARY KEY,
    title      TEXT,
    image_link TEXT,
    short_text TEXT,
    full_text  TEXT,
    created_at TIMESTAMPTZ,
    updated_at TIMESTAMPTZ
);