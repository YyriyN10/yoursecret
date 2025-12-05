package service

import (
	"y-landing/models"
)

func (s *Service) GetAllNewsPosts(page, limit int) ([]models.PostData, error) {
	offset := generateOffset(page, limit)

	newsPosts, err := s.Repo.GetAllNewsPosts(offset, limit)
	if err != nil {
		return nil, err
	}

	categories, err := s.Repo.GetAllNewsCategories()
	if err != nil {
		return nil, err
	}

	categoriesMap := make(map[int]models.Category)
	for _, category := range categories {
		categoriesMap[category.ID] = models.Category{
			Name: category.Name,
			Slug: category.Slug,
		}
	}

	posts := make([]models.PostData, len(newsPosts))
	for i, post := range newsPosts {
		posts[i] = models.PostData{
			Title:        post.Title,
			Slug:         post.Slug,
			ImageLink:    post.ImageLink,
			ShortText:    post.ShortText,
			FullText:     post.FullText,
			CategoryName: categoriesMap[post.NewsCategoryID].Name,
			CategorySlug: categoriesMap[post.NewsCategoryID].Slug,
			CreatedAt:    post.CreatedAt,
		}
	}

	return posts, nil
}

func (s *Service) GetNewsPagesNumber(limit int) (int, error) {
	count, err := s.Repo.GetNewsPostCount()
	if err != nil || count == 0 {
		return 0, err
	}

	pages := (count + limit - 1) / limit
	return pages, nil
}

func (s *Service) GetNewsPagesNumberCategory(category string, limit int) (int, error) {
	categoryID, err := s.Repo.GetNewsCategoryIDBySlug(category)
	if err != nil || categoryID == 0 {
		return 0, err
	}

	count, err := s.Repo.GetNewsPostCountByCategoryID(categoryID)
	if err != nil || count == 0 {
		return 0, err
	}
	pages := (count + limit - 1) / limit
	return pages, nil
}

func (s *Service) GetAllNewsCategories() ([]models.Category, error) {
	return s.Repo.GetAllNewsCategories()
}

func (s *Service) GetNewsCategoryIDBySlug(name string) (int64, error) {
	return s.Repo.GetNewsCategoryIDBySlug(name)
}

func (s *Service) GetNewsPostsByCategorySlug(name string, page int, limit int) (
	[]models.PostData, error,
) {
	offset := generateOffset(page, limit)
	categoryID, err := s.GetNewsCategoryIDBySlug(name)
	if err != nil {
		return nil, err
	}

	category, err := s.Repo.GetNewsCategoryByID(categoryID)
	if err != nil {
		return nil, err
	}

	newsPosts, err := s.Repo.GetNewsPostsByCategoryID(categoryID, offset, limit)
	if err != nil {
		return nil, err
	}

	posts := make([]models.PostData, len(newsPosts))
	for i, post := range newsPosts {
		posts[i] = models.PostData{
			Title:        post.Title,
			Slug:         post.Slug,
			ImageLink:    post.ImageLink,
			ShortText:    post.ShortText,
			FullText:     post.FullText,
			CategoryName: category.Name,
			CategorySlug: category.Slug,
			CreatedAt:    post.CreatedAt,
		}
	}

	return posts, nil

}

func (s *Service) GetNewsPostBySlug(slug string) (models.PostData, error) {
	news, err := s.Repo.GetNewsPostBySlug(slug)
	if err != nil {
		return models.PostData{}, err
	}

	category, err := s.Repo.GetNewsCategoryByID(int64(news.NewsCategoryID))
	if err != nil {
		return models.PostData{}, err
	}

	post := models.PostData{
		Title:        news.Title,
		Slug:         news.Slug,
		ImageLink:    news.ImageLink,
		FullText:     news.FullText,
		CategoryName: category.Name,
		CategorySlug: category.Slug,
		CreatedAt:    news.CreatedAt,
	}
	return post, nil
}
