package service

import (
	"crypto/sha1"
	"fmt"
	"y-landing/models"
)

const (
	salt = "asDAJKDFHAWURY7AHWDFA3eq289291e>IQAWERHJAW"
)

func (s *Service) GetUserByLoginAndPass(login, pass string) (models.User, error) {
	user, err := s.Repo.GetUserByLogin(login)
	if err != nil {
		return models.User{}, err
	}
	if user.Password == s.GeneratePasswordHash(pass) {
		return user, nil
	} else {
		return models.User{}, fmt.Errorf("login and password don`t match")
	}
}

func (s *Service) GeneratePasswordHash(password string) string {
	hash := sha1.New()
	hash.Write([]byte(password))

	return fmt.Sprintf("%x", hash.Sum([]byte(salt)))
}

func (s *Service) GetAllUsers() ([]models.User, error) {
	return s.Repo.GetAllUsers()
}

func (s *Service) GetUserByID(id int) (models.User, error) {
	return s.Repo.GetUserByID(id)
}

func (s *Service) CreateUser(login string, pass string, role string) (int, error) {
	pass = s.GeneratePasswordHash(pass)
	return s.Repo.CreateUser(login, pass, role)
}

func (s *Service) EditUser(userID int, login string, role string) error {
	return s.Repo.EditUser(userID, login, role)
}

func (s *Service) ChangePassword(userID int, pass string) error {
	return s.Repo.ChangePassword(userID, pass)
}

func (s *Service) ActivateOrDeactivateUser(userID int) error {
	user, err := s.Repo.GetUserByID(userID)
	if err != nil {
		return err
	}

	if user.Active {
		return s.Repo.DeactivateUser(userID)
	} else {
		return s.Repo.ActivateUser(userID)
	}
}
