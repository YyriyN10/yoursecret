INSERT INTO blog_categories (name)
VALUES ('Other');
INSERT INTO news_categories (name)
VALUES ('Other');

ALTER TABLE blog_posts
    ADD COLUMN blog_category_id INT REFERENCES blog_categories (id);
ALTER TABLE news_posts
    ADD COLUMN news_category_id INT REFERENCES news_categories (id);

UPDATE blog_posts
SET blog_category_id = (SELECT id FROM blog_categories WHERE name = 'Other');
UPDATE news_posts
SET news_category_id = (SELECT id FROM news_categories WHERE name = 'Other');

ALTER TABLE blog_posts ALTER COLUMN blog_category_id SET NOT NULL;
ALTER TABLE news_posts ALTER COLUMN news_category_id SET NOT NULL;