package service_test

import (
	"fmt"
	"testing"
	"y-landing/internal/service"

	"github.com/stretchr/testify/assert"
)

func TestService_GeneratePasswordHash(t *testing.T) {
	s := service.NewService(nil)
	hash := s.GeneratePasswordHash("admin")
	assert.NotEmpty(t, hash)
	fmt.Println(hash)
}
