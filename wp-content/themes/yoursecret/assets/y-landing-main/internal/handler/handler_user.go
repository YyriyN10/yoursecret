package handler

import (
	"fmt"
	"net/http"
	"strconv"
	"y-landing/constants"
	"y-landing/models"
	"y-landing/view-admin/pages"

	"github.com/labstack/echo/v4"
)

func (h *Handler) Users(c echo.Context) error {
	userID := h.Sess.SessionManager.GetInt(c.Request().Context(), "user")
	if userID == 0 {
		h.Sess.SessionManager.Put(c.Request().Context(), "warning", "Authorization required")
		return c.Redirect(http.StatusSeeOther, "/login")
	}
	userRole := h.Sess.SessionManager.GetString(c.Request().Context(), "user-role")
	if userRole != constants.AdminRole && userRole != constants.ManagerRole {
		h.Sess.SessionManager.Put(c.Request().Context(), "warning", "You do not have permission to access this resource: "+userRole)
		return c.Redirect(http.StatusSeeOther, "/")
	}

	users, err := h.Service.GetAllUsers()
	if err != nil {
		h.Sess.SessionManager.Put(c.Request().Context(), "warning", "Error getting all users")
		return c.Redirect(http.StatusSeeOther, "/")
	}

	return render(c, http.StatusOK, pages.Users(h.AddDefaultData(nil, c), users))
}

func (h *Handler) User(c echo.Context) error {
	userID := h.Sess.SessionManager.GetInt(c.Request().Context(), "user")
	if userID == 0 {
		h.Sess.SessionManager.Put(c.Request().Context(), "warning", "Authorization required")
		return c.Redirect(http.StatusSeeOther, "/login")
	}

	selectedUser := c.Param("id")

	selectedUserID, err := strconv.Atoi(selectedUser)
	if err != nil {
		h.Sess.SessionManager.Put(c.Request().Context(), "warning", "Error parsing user id")
		return c.Redirect(http.StatusSeeOther, "/users")
	}

	userRole := h.Sess.SessionManager.GetString(c.Request().Context(), "user-role")
	if userRole != constants.AdminRole && userRole != constants.ManagerRole && userID != selectedUserID {
		h.Sess.SessionManager.Put(c.Request().Context(), "warning", "You do not have permission to access this resource")
		return c.Redirect(http.StatusSeeOther, "/")
	}

	selectedUserData, err := h.Service.GetUserByID(selectedUserID)
	if err != nil {
		h.Sess.SessionManager.Put(c.Request().Context(), "warning", "Error getting user data")
		return c.Redirect(http.StatusSeeOther, "/users")
	}

	return render(c, http.StatusOK, pages.User(h.AddDefaultData(&models.TemplateData{}, c), selectedUserData))
}

func (h *Handler) UserAddGet(c echo.Context) error {
	userID := h.Sess.SessionManager.GetInt(c.Request().Context(), "user")
	if userID == 0 {
		h.Sess.SessionManager.Put(c.Request().Context(), "warning", "Authorization required")
		return c.Redirect(http.StatusSeeOther, "/login")
	}
	userRole := h.Sess.SessionManager.GetString(c.Request().Context(), "user-role")
	if userRole != constants.AdminRole {
		h.Sess.SessionManager.Put(c.Request().Context(), "warning", "You do not have permission to access this resource: "+userRole)
		return c.Redirect(http.StatusSeeOther, "/")
	}

	return render(c, http.StatusOK, pages.AddUser(h.AddDefaultData(&models.TemplateData{}, c)))
}

func (h *Handler) UserAddPost(c echo.Context) error {
	userID := h.Sess.SessionManager.GetInt(c.Request().Context(), "user")
	if userID == 0 {
		h.Sess.SessionManager.Put(c.Request().Context(), "warning", "Authorization required")
		return c.Redirect(http.StatusSeeOther, "/login")
	}
	userRole := h.Sess.SessionManager.GetString(c.Request().Context(), "user-role")
	if userRole != constants.AdminRole {
		h.Sess.SessionManager.Put(c.Request().Context(), "warning", "You do not have permission to access this resource: "+userRole)
		return c.Redirect(http.StatusSeeOther, "/")
	}

	login := c.FormValue("login")
	pass := c.FormValue("pass")
	role := c.FormValue("role")
	if login == "" || pass == "" || role == "" {
		h.Sess.SessionManager.Put(c.Request().Context(), "error", "Error: some fields are empty")
		return c.Redirect(http.StatusSeeOther, "/users/add")
	}

	id, err := h.Service.CreateUser(login, pass, role)
	if err != nil {
		h.Sess.SessionManager.Put(c.Request().Context(), "error", fmt.Sprintf("Error: %s", err))
		return c.Redirect(http.StatusSeeOther, "/users/add")
	}
	return c.Redirect(http.StatusSeeOther, fmt.Sprintf("/users/%d", id))
}

func (h *Handler) EditUser(c echo.Context) error {
	userID := h.Sess.SessionManager.GetInt(c.Request().Context(), "user")
	if userID == 0 {
		h.Sess.SessionManager.Put(c.Request().Context(), "warning", "Authorization required")
		return c.Redirect(http.StatusSeeOther, "/login")
	}

	selectedUser := c.Param("id")

	selectedUserID, err := strconv.Atoi(selectedUser)
	if err != nil {
		h.Sess.SessionManager.Put(c.Request().Context(), "warning", "Error parsing user id")
		return c.Redirect(http.StatusSeeOther, "/users")
	}

	userRole := h.Sess.SessionManager.GetString(c.Request().Context(), "user-role")
	if userRole != constants.AdminRole {
		h.Sess.SessionManager.Put(c.Request().Context(), "warning", "You do not have permission to access this resource")
		return c.Redirect(http.StatusSeeOther, "/")
	}

	selectedUserData, err := h.Service.GetUserByID(selectedUserID)
	if err != nil {
		h.Sess.SessionManager.Put(c.Request().Context(), "warning", "Error getting user data")
		return c.Redirect(http.StatusSeeOther, "/users")
	}

	return render(c, http.StatusOK, pages.EditUser(h.AddDefaultData(&models.TemplateData{}, c), selectedUserData))
}

func (h *Handler) UserEditPost(c echo.Context) error {
	userID := h.Sess.SessionManager.GetInt(c.Request().Context(), "user")
	if userID == 0 {
		h.Sess.SessionManager.Put(c.Request().Context(), "warning", "Authorization required")
		return c.Redirect(http.StatusSeeOther, "/login")
	}
	userRole := h.Sess.SessionManager.GetString(c.Request().Context(), "user-role")
	if userRole != constants.AdminRole {
		h.Sess.SessionManager.Put(c.Request().Context(), "warning", "You do not have permission to access this resource: "+userRole)
		return c.Redirect(http.StatusSeeOther, "/")
	}

	selectedUser := c.Param("id")

	selectedUserID, err := strconv.Atoi(selectedUser)
	if err != nil {
		h.Sess.SessionManager.Put(c.Request().Context(), "warning", "Error parsing user id")
		return c.Redirect(http.StatusSeeOther, "/users")
	}

	login := c.FormValue("login")
	role := c.FormValue("role")
	if login == "" || role == "" {
		h.Sess.SessionManager.Put(c.Request().Context(), "error", "Error: some fields are empty")
		return c.Redirect(http.StatusSeeOther, fmt.Sprintf("/users/%s", selectedUser))
	}

	err = h.Service.EditUser(selectedUserID, login, role)
	if err != nil {
		h.Sess.SessionManager.Put(c.Request().Context(), "error", fmt.Sprintf("Error: %s", err))
		return c.Redirect(http.StatusSeeOther, fmt.Sprintf("/users/%s", selectedUser))
	}
	return c.Redirect(http.StatusSeeOther, fmt.Sprintf("/users/%s", selectedUser))
}

func (h *Handler) ChangePass(c echo.Context) error {
	userID := h.Sess.SessionManager.GetInt(c.Request().Context(), "user")
	if userID == 0 {
		h.Sess.SessionManager.Put(c.Request().Context(), "warning", "Authorization required")
		return c.Redirect(http.StatusSeeOther, "/login")
	}

	selectedUser := c.Param("id")

	selectedUserID, err := strconv.Atoi(selectedUser)
	if err != nil {
		h.Sess.SessionManager.Put(c.Request().Context(), "warning", "Error parsing user id")
		return c.Redirect(http.StatusSeeOther, "/users")
	}

	userRole := h.Sess.SessionManager.GetString(c.Request().Context(), "user-role")
	if userRole != constants.AdminRole && userID != selectedUserID {
		h.Sess.SessionManager.Put(c.Request().Context(), "warning", "You do not have permission to access this resource: "+userRole)
		return c.Redirect(http.StatusSeeOther, "/")
	}

	return render(c, http.StatusOK, pages.ChangePass(h.AddDefaultData(&models.TemplateData{}, c), selectedUserID))
}

func (h *Handler) ChangePassPost(c echo.Context) error {
	userID := h.Sess.SessionManager.GetInt(c.Request().Context(), "user")
	if userID == 0 {
		h.Sess.SessionManager.Put(c.Request().Context(), "warning", "Authorization required")
		return c.Redirect(http.StatusSeeOther, "/login")
	}

	selectedUser := c.Param("id")

	selectedUserID, err := strconv.Atoi(selectedUser)
	if err != nil {
		h.Sess.SessionManager.Put(c.Request().Context(), "warning", "Error parsing user id")
		return c.Redirect(http.StatusSeeOther, "/users")
	}

	userRole := h.Sess.SessionManager.GetString(c.Request().Context(), "user-role")
	if userRole != constants.AdminRole && userID != selectedUserID {
		h.Sess.SessionManager.Put(c.Request().Context(), "warning", "You do not have permission to access this resource: "+userRole)
		return c.Redirect(http.StatusSeeOther, "/")
	}

	oldPass := c.FormValue("old_pass")
	newPass1 := c.FormValue("new_pass1")
	newPass2 := c.FormValue("new_pass_2")

	if newPass1 != newPass2 {
		h.Sess.SessionManager.Put(c.Request().Context(), "error", "Error: different passwords")
		return c.Redirect(http.StatusSeeOther, fmt.Sprintf("/users/%s/edit-pass", selectedUser))
	}

	if userRole != constants.AdminRole {
		user, err := h.Service.GetUserByID(selectedUserID)
		if err != nil {
			fmt.Println(err)
			h.Sess.SessionManager.Put(c.Request().Context(), "error", fmt.Sprintf("Error: %s", err))
			return c.Redirect(http.StatusSeeOther, fmt.Sprintf("/users/%s/edit-pass", selectedUser))
		}

		if oldPass == "" {
			h.Sess.SessionManager.Put(c.Request().Context(), "error", "Error: old password is empty")
			return c.Redirect(http.StatusSeeOther, fmt.Sprintf("/users/%s/edit-pass", selectedUser))
		}

		if h.Service.GeneratePasswordHash(oldPass) != user.Password {
			h.Sess.SessionManager.Put(c.Request().Context(), "error", "Error: old password is different")
			return c.Redirect(http.StatusSeeOther, fmt.Sprintf("/users/%s/edit-pass", selectedUser))
		}
	}

	err = h.Service.ChangePassword(selectedUserID, h.Service.GeneratePasswordHash(newPass1))
	if err != nil {
		h.Sess.SessionManager.Put(c.Request().Context(), "error", fmt.Sprintf("Error: %s", err))
		return c.Redirect(http.StatusSeeOther, fmt.Sprintf("/users/%s/edit-pass", selectedUser))
	}

	h.Sess.SessionManager.Put(c.Request().Context(), "flash", "Success")
	return c.Redirect(http.StatusSeeOther, fmt.Sprintf("/users/%s", selectedUser))
}

func (h *Handler) ActivateOrDiactivateUser(c echo.Context) error {
	userID := h.Sess.SessionManager.GetInt(c.Request().Context(), "user")
	if userID == 0 {
		h.Sess.SessionManager.Put(c.Request().Context(), "warning", "Authorization required")
		return c.Redirect(http.StatusSeeOther, "/login")
	}
	userRole := h.Sess.SessionManager.GetString(c.Request().Context(), "user-role")
	if userRole != constants.AdminRole {
		h.Sess.SessionManager.Put(c.Request().Context(), "warning", "You do not have permission to access this resource: "+userRole)
		return c.Redirect(http.StatusSeeOther, "/")
	}

	selectedUser := c.Param("id")

	selectedUserID, err := strconv.Atoi(selectedUser)
	if err != nil {
		h.Sess.SessionManager.Put(c.Request().Context(), "warning", "Error parsing user id")
		return c.Redirect(http.StatusSeeOther, "/users")
	}

	err = h.Service.ActivateOrDeactivateUser(selectedUserID)
	if err != nil {
		fmt.Println(err)
		h.Sess.SessionManager.Put(c.Request().Context(), "error", fmt.Sprintf("Error: %s", err))
		return c.Redirect(http.StatusSeeOther, fmt.Sprintf("/users/%d", selectedUserID))
	}

	h.Sess.SessionManager.Put(c.Request().Context(), "flash", "Succes")
	return c.Redirect(http.StatusSeeOther, fmt.Sprintf("/users/%d", selectedUserID))
}
