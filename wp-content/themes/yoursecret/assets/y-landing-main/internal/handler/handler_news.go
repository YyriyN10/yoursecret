package handler

import (
	"fmt"
	"github.com/labstack/echo/v4"
	"net/http"
	"strconv"
	"y-landing/view-landing/pages"
)

func (h *Handler) News(c echo.Context) error {
	pageStr := c.QueryParam("page")
	page := 1
	if pageStr != "" {
		if p, err := strconv.Atoi(pageStr); err == nil && p >= 1 {
			page = p
		}
	}

	limitStr := c.QueryParam("limit")
	limit := 5
	if limitStr != "" {
		if l, err := strconv.Atoi(limitStr); err == nil && l >= 5 {
			limit = l
		}
	}

	posts, err := h.Service.GetAllNewsPosts(page, limit)
	if err != nil {
		fmt.Println(err)
		return c.Redirect(http.StatusSeeOther, "/news")
	}

	categories, err := h.Service.GetAllNewsCategories()
	if err != nil {
		fmt.Println(err)
		return c.Redirect(http.StatusSeeOther, "/news")
	}

	count, err := h.Service.GetNewsPagesNumber(limit)
	if err != nil {
		fmt.Println(err)
		return c.Redirect(http.StatusSeeOther, "/news")
	}

	return render(
		c, http.StatusOK, pages.News(posts, categories, count, page, limit, "All"),
	)
}

func (h *Handler) NewsCategory(c echo.Context) error {
	pageStr := c.QueryParam("page")
	page := 1
	if pageStr != "" {
		if p, err := strconv.Atoi(pageStr); err == nil && p >= 1 {
			page = p
		}
	}

	limitStr := c.QueryParam("limit")
	limit := 5
	if limitStr != "" {
		if l, err := strconv.Atoi(limitStr); err == nil && l >= 5 {
			limit = l
		}
	}

	category := c.Param("category")
	if category == "" {
		category = "All"
	}

	posts, err := h.Service.GetNewsPostsByCategorySlug(category, page, limit)
	if err != nil {
		fmt.Println(err)
		return c.Redirect(http.StatusSeeOther, "/news")
	}

	categories, err := h.Service.GetAllNewsCategories()
	if err != nil {
		fmt.Println(err)
		return c.Redirect(http.StatusSeeOther, "/news")
	}

	count, err := h.Service.GetNewsPagesNumberCategory(category, limit)
	if err != nil {
		fmt.Println(err)
		return c.Redirect(http.StatusSeeOther, "/news")
	}

	return render(
		c, http.StatusOK, pages.News(posts, categories, count, page, limit, category),
	)

}

func (h *Handler) NewsPost(c echo.Context) error {
	slug := c.Param("slug")

	post, err := h.Service.GetNewsPostBySlug(slug)
	if err != nil {
		fmt.Println(err)
		return c.Redirect(http.StatusSeeOther, fmt.Sprintf("/news/%s", post.CategorySlug))
	}

	return render(c, http.StatusOK, pages.Post(post, "News"))
}
