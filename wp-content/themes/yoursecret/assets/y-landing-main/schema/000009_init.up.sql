BEGIN;

ALTER TABLE news_categories
    ADD COLUMN slug TEXT;
ALTER TABLE blog_categories
    ADD COLUMN slug TEXT;

UPDATE news_categories
SET slug = LOWER(REPLACE(name, ' ', '-'))
WHERE slug IS NULL;

UPDATE blog_categories
SET slug = LOWER(REPLACE(name, ' ', '-'))
WHERE slug IS NULL;

ALTER TABLE news_categories
    ALTER COLUMN slug SET NOT NULL;
ALTER TABLE blog_categories
    ALTER COLUMN slug SET NOT NULL;

ALTER TABLE news_categories
    ADD CONSTRAINT news_categories_slug_unique UNIQUE (slug);
ALTER TABLE blog_categories
    ADD CONSTRAINT blog_categories_slug_unique UNIQUE (slug);

COMMIT;
