package postgres

import (
	"fmt"
	"y-landing/models"
)

const blogPostTable = "blog_posts"

func (p *Postgres) GetAllBlogPosts(offset, limit int) ([]models.Blog, error) {
	blogPosts := []models.Blog{}
	query := fmt.Sprintf(
		"SELECT * FROM %s ORDER BY created_at DESC OFFSET $1 LIMIT $2", blogPostTable,
	)

	err := p.db.Select(&blogPosts, query, offset, limit)
	if err != nil {
		return blogPosts, err
	}
	return blogPosts, nil
}

func (p *Postgres) GetBlogPostsByCategoryID(categoryID int64, offset int, limit int) (
	[]models.Blog, error,
) {
	var blogPosts []models.Blog

	query := fmt.Sprintf(
		"SELECT * FROM %s WHERE blog_category_id = $1 ORDER BY created_at DESC OFFSET $2 LIMIT $3",
		blogPostTable,
	)

	err := p.db.Select(&blogPosts, query, categoryID, offset, limit)
	if err != nil {
		return blogPosts, err
	}

	return blogPosts, nil
}

func (p *Postgres) GetBlogPostCountByCategoryID(categoryID int64) (int, error) {
	var count int
	query := fmt.Sprintf("SELECT COUNT(*) FROM %s WHERE blog_category_id=$1", blogPostTable)
	err := p.db.Get(&count, query, categoryID)
	if err != nil {
		return count, err
	}
	return count, nil
}

func (p *Postgres) GetBlogPostCount() (int, error) {
	var count int
	query := fmt.Sprintf("SELECT COUNT(*) FROM %s", blogPostTable)
	err := p.db.Get(&count, query)
	if err != nil {
		return 0, err
	}

	return count, nil
}

func (p *Postgres) GetBlogPostBySlug(slug string) (models.Blog, error) {
	var blog models.Blog
	query := fmt.Sprintf("SELECT * FROM %s WHERE slug = $1", blogPostTable)
	err := p.db.Get(&blog, query, slug)
	if err != nil {
		return blog, err
	}
	return blog, nil
}
