package postgres

import (
	"fmt"
	"y-landing/models"
)

const newsCategoriesTable = "news_categories"

func (p *Postgres) GetAllNewsCategories() ([]models.Category, error) {
	var categories []models.Category

	query := fmt.Sprintf("SELECT * FROM %s", newsCategoriesTable)
	err := p.db.Select(&categories, query)
	if err != nil {
		return nil, err
	}
	return categories, nil
}

func (p *Postgres) GetNewsCategoryIDBySlug(slug string) (int64, error) {
	var id int64

	query := fmt.Sprintf("SELECT id FROM %s WHERE slug = $1", newsCategoriesTable)
	err := p.db.Get(&id, query, slug)
	if err != nil {
		return -1, err
	}
	return id, nil
}

func (p *Postgres) GetNewsCategoryByID(id int64) (models.Category, error) {
	var category models.Category
	query := fmt.Sprintf("SELECT * FROM %s WHERE id = $1", newsCategoriesTable)
	err := p.db.Get(&category, query, id)
	if err != nil {
		return category, err
	}
	return category, nil
}
