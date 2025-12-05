ALTER TABLE blog_posts
    ADD COLUMN slug TEXT DEFAULT '';
ALTER TABLE news_posts
    ADD COLUMN slug TEXT DEFAULT '';

ALTER TABLE blog_posts
    ALTER COLUMN slug DROP DEFAULT;
ALTER TABLE blog_posts
    ALTER COLUMN slug SET NOT NULL;
ALTER TABLE blog_posts
    ADD CONSTRAINT blog_posts_slug_key UNIQUE (slug);

ALTER TABLE news_posts
    ALTER COLUMN slug DROP DEFAULT;
ALTER TABLE news_posts
    ALTER COLUMN slug SET NOT NULL;
ALTER TABLE news_posts
    ADD CONSTRAINT news_posts_slug_key UNIQUE (slug);