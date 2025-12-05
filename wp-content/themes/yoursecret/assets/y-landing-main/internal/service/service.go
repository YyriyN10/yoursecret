package service

import (
	"y-landing/models"
)

type Service struct {
	Repo Repository
}

type Repository interface {
	GetUserByID(id int) (models.User, error)
	GetUserByLogin(login string) (models.User, error)
	GetAllUsers() ([]models.User, error)
	CreateUser(login string, pass string, role string) (int, error)
	EditUser(userID int, login string, role string) error
	ChangePassword(userID int, pass string) error
	GetUsersByOrgID(id int) ([]models.User, error)
	ActivateUser(userID int) error
	DeactivateUser(userID int) error
	CreateSubscription(email string) error
	GetAllBlogPosts(offset, limit int) ([]models.Blog, error)
	GetAllNewsPosts(offset, limit int) ([]models.News, error)
	GetBlogPostCount() (int, error)
	GetNewsPostCount() (int, error)
	GetBlogPostBySlug(slug string) (models.Blog, error)
	GetNewsPostBySlug(slug string) (models.News, error)
	GetAllBlogCategories() ([]models.Category, error)
	GetAllNewsCategories() ([]models.Category, error)
	GetBlogCategoryIDBySlug(slug string) (int64, error)
	GetNewsCategoryIDBySlug(name string) (int64, error)
	GetBlogPostsByCategoryID(categoryID int64, offset int, limit int) (
		[]models.Blog, error,
	)
	GetNewsPostsByCategoryID(categoryID int64, offset int, limit int) (
		[]models.News, error,
	)
	GetBlogPostCountByCategoryID(categoryID int64) (int, error)
	GetNewsPostCountByCategoryID(categoryID int64) (int, error)
	GetBlogCategoryByID(id int64) (models.Category, error)
	GetNewsCategoryByID(id int64) (models.Category, error)
}

func NewService(repo Repository) *Service {
	return &Service{
		Repo: repo,
	}
}
