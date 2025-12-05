package postgres

import (
	"fmt"
	"y-landing/models"
)

const newsPostsTable = "news_posts"

func (p *Postgres) GetAllNewsPosts(offset, limit int) ([]models.News, error) {
	newsPosts := []models.News{}
	query := fmt.Sprintf(
		"SELECT * FROM %s ORDER BY created_at DESC OFFSET $1 LIMIT $2", newsPostsTable,
	)

	err := p.db.Select(&newsPosts, query, offset, limit)
	if err != nil {
		return newsPosts, err
	}
	return newsPosts, nil
}

func (p *Postgres) GetNewsPostCount() (int, error) {
	var count int
	query := fmt.Sprintf("SELECT COUNT(*) FROM %s", newsPostsTable)
	err := p.db.Get(&count, query)
	if err != nil {
		return 0, err
	}

	return count, nil
}

func (p *Postgres) GetNewsPostBySlug(slug string) (models.News, error) {
	newsPost := models.News{}
	query := fmt.Sprintf("SELECT * FROM %s WHERE slug = $1", newsPostsTable)
	err := p.db.Get(&newsPost, query, slug)
	if err != nil {
		return newsPost, err
	}
	return newsPost, nil
}

func (p *Postgres) GetNewsPostsByCategoryID(categoryID int64, offset int, limit int) (
	[]models.News, error,
) {
	var newsPosts []models.News

	query := fmt.Sprintf(
		"SELECT * FROM %s WHERE news_category_id = $1 ORDER BY created_at DESC OFFSET $2 LIMIT $3",
		newsPostsTable,
	)

	err := p.db.Select(&newsPosts, query, categoryID, offset, limit)
	if err != nil {
		return newsPosts, err
	}

	return newsPosts, nil
}

func (p *Postgres) GetNewsPostCountByCategoryID(categoryID int64) (int, error) {
	var count int
	query := fmt.Sprintf("SELECT COUNT(*) FROM %s WHERE news_category_id=$1", newsPostsTable)
	err := p.db.Get(&count, query, categoryID)
	if err != nil {
		return count, err
	}
	return count, nil
}
