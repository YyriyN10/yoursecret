package service

import (
	"y-landing/models"
)

func (s *Service) GetAllBlogPosts(page, limit int) ([]models.PostData, error) {
	offset := generateOffset(page, limit)
	blogPosts, err := s.Repo.GetAllBlogPosts(offset, limit)
	if err != nil {
		return nil, err
	}

	categories, err := s.Repo.GetAllBlogCategories()
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

	posts := make([]models.PostData, len(blogPosts))
	for i, post := range blogPosts {
		posts[i] = models.PostData{
			Title:        post.Title,
			Slug:         post.Slug,
			ImageLink:    post.ImageLink,
			ShortText:    post.ShortText,
			FullText:     post.FullText,
			CategoryName: categoriesMap[post.BlogCategoryID].Name,
			CategorySlug: categoriesMap[post.BlogCategoryID].Slug,
			CreatedAt:    post.CreatedAt,
		}
	}

	return posts, nil

}

func (s *Service) GetBlogPagesNumber(limit int) (int, error) {
	count, err := s.Repo.GetBlogPostCount()
	if err != nil || count == 0 {
		return 0, err
	}

	pages := (count + limit - 1) / limit
	return pages, nil
}

func (s *Service) GetBlogPagesNumberCategory(category string, limit int) (int, error) {
	categoryID, err := s.Repo.GetBlogCategoryIDBySlug(category)
	if err != nil || categoryID == 0 {
		return 0, err
	}

	count, err := s.Repo.GetBlogPostCountByCategoryID(categoryID)
	if err != nil || count == 0 {
		return 0, err
	}
	pages := (count + limit - 1) / limit
	return pages, nil
}

func (s *Service) GetBlogPostBySlug(slug string) (models.PostData, error) {
	blog, err := s.Repo.GetBlogPostBySlug(slug)
	if err != nil {
		return models.PostData{}, err
	}

	category, err := s.Repo.GetBlogCategoryByID(int64(blog.BlogCategoryID))
	if err != nil {
		return models.PostData{}, err
	}

	post := models.PostData{
		Title:        blog.Title,
		Slug:         blog.Slug,
		ImageLink:    blog.ImageLink,
		FullText:     blog.FullText,
		CategoryName: category.Name,
		CategorySlug: category.Slug,
		CreatedAt:    blog.CreatedAt,
	}
	return post, nil
}

func (s *Service) GetAllBlogCategories() ([]models.Category, error) {
	return s.Repo.GetAllBlogCategories()
}

func (s *Service) GetBlogCategoryIDBySlug(slug string) (int64, error) {
	return s.Repo.GetBlogCategoryIDBySlug(slug)
}

func (s *Service) GetBlogPostsByCategorySlug(slug string, page int, limit int) (
	[]models.PostData, error,
) {
	offset := generateOffset(page, limit)
	categoryID, err := s.GetBlogCategoryIDBySlug(slug)
	if err != nil {
		return nil, err
	}

	category, err := s.Repo.GetBlogCategoryByID(categoryID)
	if err != nil {
		return nil, err
	}

	blogPosts, err := s.Repo.GetBlogPostsByCategoryID(categoryID, offset, limit)
	if err != nil {
		return nil, err
	}

	posts := make([]models.PostData, len(blogPosts))
	for i, post := range blogPosts {
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

func generateOffset(page, limit int) (offset int) {
	if page == 1 {
		offset = 0
		return
	}
	offset = limit * (page - 1)
	return
}
