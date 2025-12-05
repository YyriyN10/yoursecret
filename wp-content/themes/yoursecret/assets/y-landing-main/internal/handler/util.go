package handler

import (
	"y-landing/models"

	"github.com/a-h/templ"
	"github.com/labstack/echo/v4"
)

func render(e echo.Context, statusCode int, t templ.Component) error {
	buf := templ.GetBuffer()
	defer templ.ReleaseBuffer(buf)

	if err := t.Render(e.Request().Context(), buf); err != nil {
		return err
	}

	return e.HTML(statusCode, buf.String())
}

func (h *Handler) AddDefaultData(td *models.TemplateData, c echo.Context) *models.TemplateData {
	if td == nil {
		td = &models.TemplateData{}
	}
	td.UserID = h.Sess.SessionManager.GetInt(c.Request().Context(), "user")
	td.UserRole = h.Sess.SessionManager.GetString(c.Request().Context(), "user-role")
	td.Flash = h.Sess.SessionManager.PopString(c.Request().Context(), "flash")
	td.Warning = h.Sess.SessionManager.PopString(c.Request().Context(), "warning")
	td.Error = h.Sess.SessionManager.PopString(c.Request().Context(), "error")

	return td
}
