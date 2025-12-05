package handler

import (
	"errors"
	"fmt"
	"github.com/labstack/echo/v4"
	"net/http"
	"y-landing/internal/postgres"
)

func (h *Handler) CreateSubscription(c echo.Context) error {
	email := c.FormValue("email")

	err := h.Service.CreateSubscription(email)
	if err != nil {
		if errors.Is(err, postgres.ErrEmailAlreadyExists) {
			fmt.Printf("%s: %s\n", err.Error(), email)
		} else {
			return c.Redirect(http.StatusSeeOther, "/download?success=false")
		}
	}

	return c.Redirect(http.StatusSeeOther, "/download?success=true")
}
