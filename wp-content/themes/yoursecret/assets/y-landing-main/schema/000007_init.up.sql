CREATE TABLE blog_categories
(
    id   SERIAL PRIMARY KEY NOT NULL,
    name TEXT               NOT NULL UNIQUE
);

CREATE TABLE news_categories
(
    id   SERIAL PRIMARY KEY NOT NULL,
    name TEXT               NOT NULL UNIQUE
);