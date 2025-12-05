package service

import (
	"fmt"
	"regexp"
)

const emailRegex = "^[\\w-\\.]+@([\\w-]+\\.)+[\\w-]{2,4}$"

func (s *Service) CreateSubscription(email string) error {
	emailComp := regexp.MustCompile(emailRegex)

	if !emailComp.MatchString(email) {
		return fmt.Errorf("invalid email: %s", email)
	}

	return s.Repo.CreateSubscription(email)
}
