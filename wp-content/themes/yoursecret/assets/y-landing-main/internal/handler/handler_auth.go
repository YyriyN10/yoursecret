package handler

import (
	"database/sql"
	"fmt"
	"net/http"
	"y-landing/view-admin/pages"

	"github.com/labstack/echo/v4"
)

func (h *Handler) LoginGet(c echo.Context) error {
	return render(c, http.StatusOK, pages.Login(h.AddDefaultData(nil, c)))
}

func (h *Handler) LoginPost(c echo.Context) error {
	_ = h.Sess.SessionManager.RenewToken(c.Request().Context())
	login := c.FormValue("login")
	pass := c.FormValue("pass")
	user, err := h.Service.GetUserByLoginAndPass(login, pass)
	if err == sql.ErrNoRows {
		h.Sess.SessionManager.Put(c.Request().Context(), "error", "Wrong login or password")
		return c.Redirect(http.StatusSeeOther, "/login")
	}
	if err != nil {
		fmt.Println(err)
		h.Sess.SessionManager.Put(c.Request().Context(), "error", fmt.Sprintf("Error: %s", err))
		return c.Redirect(http.StatusSeeOther, "/login")
	}
	if !user.Active {
		h.Sess.SessionManager.Put(c.Request().Context(), "error", "Account is deactivated")
		return c.Redirect(http.StatusSeeOther, "/login")
	}

	if user.Role == "" {
		h.Sess.SessionManager.Put(c.Request().Context(), "error", "Wrong user role")
		return c.Redirect(http.StatusSeeOther, "/login")
	} else {
		h.Sess.SessionManager.Put(c.Request().Context(), "user", &user.ID)
		h.Sess.SessionManager.Put(c.Request().Context(), "user-role", &user.Role)
		h.Sess.SessionManager.Put(c.Request().Context(), "flash", "Success!")
		return c.Redirect(http.StatusSeeOther, "/")
	}
}

func (h *Handler) LogOut(c echo.Context) error {
	_ = h.Sess.SessionManager.Destroy(c.Request().Context())
	_ = h.Sess.SessionManager.RenewToken(c.Request().Context())
	return c.Redirect(http.StatusSeeOther, "/login")
}
