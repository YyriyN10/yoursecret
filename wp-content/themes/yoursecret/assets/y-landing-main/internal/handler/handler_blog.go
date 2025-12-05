package handler

import (
	"fmt"
	"github.com/labstack/echo/v4"
	"y-landing/view-landing/pages"

	"net/http"
	"strconv"
)

func (h *Handler) Blog(c echo.Context) error {
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

	posts, err := h.Service.GetAllBlogPosts(page, limit)
	if err != nil {
		fmt.Println(err)
		return c.Redirect(http.StatusSeeOther, "/blog")
	}

	categories, err := h.Service.GetAllBlogCategories()
	if err != nil {
		fmt.Println(err)
		return c.Redirect(http.StatusSeeOther, "/blog")
	}

	count, err := h.Service.GetBlogPagesNumber(limit)
	if err != nil {
		fmt.Println(err)
		return c.Redirect(http.StatusSeeOther, "/blog")
	}

	return render(
		c, http.StatusOK, pages.Blog(posts, categories, count, page, limit, "All"),
	)
}

func (h *Handler) BlogCategory(c echo.Context) error {
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

	posts, err := h.Service.GetBlogPostsByCategorySlug(category, page, limit)
	if err != nil {
		fmt.Println(err)
		return c.Redirect(http.StatusSeeOther, "/blog")
	}

	categories, err := h.Service.GetAllBlogCategories()
	if err != nil {
		fmt.Println(err)
		return c.Redirect(http.StatusSeeOther, "/blog")
	}

	count, err := h.Service.GetBlogPagesNumberCategory(category, limit)
	if err != nil {
		fmt.Println(err)
		return c.Redirect(http.StatusSeeOther, "/blog")
	}

	return render(
		c, http.StatusOK, pages.Blog(posts, categories, count, page, limit, category),
	)

}

func (h *Handler) BlogPost(c echo.Context) error {
	slug := c.Param("slug")

	post, err := h.Service.GetBlogPostBySlug(slug)
	if err != nil {
		fmt.Println(err)
		return c.Redirect(http.StatusSeeOther, fmt.Sprintf("/blog/%s", post.CategorySlug))
	}

	return render(c, http.StatusOK, pages.Post(post, "Blog"))
}
