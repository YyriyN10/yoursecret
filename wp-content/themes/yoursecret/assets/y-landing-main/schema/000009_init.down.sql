BEGIN;

ALTER TABLE news_categories
    DROP CONSTRAINT IF EXISTS news_categories_slug_unique;
ALTER TABLE blog_categories
    DROP CONSTRAINT IF EXISTS blog_categories_slug_unique;

ALTER TABLE news_categories
    DROP COLUMN IF EXISTS slug;
ALTER TABLE blog_categories
    DROP COLUMN IF EXISTS slug;

COMMIT;
