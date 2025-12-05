package handler

import (
	"net/http"
	"y-landing/internal/sessions"
	"y-landing/models"
	"y-landing/view-landing/pages"

	"github.com/labstack/echo/v4"
)

type Handler struct {
	Service Service
	Sess    *sessions.Sessions
}

type Service interface {
	GetUserByLoginAndPass(login, pass string) (models.User, error)
	GeneratePasswordHash(password string) string
	GetAllUsers() ([]models.User, error)
	GetUserByID(id int) (models.User, error)
	CreateUser(login string, pass string, role string) (int, error)
	EditUser(userID int, login string, role string) error
	ChangePassword(userID int, pass string) error
	ActivateOrDeactivateUser(userID int) error
	CreateSubscription(email string) error
	GetAllBlogPosts(page, limit int) ([]models.PostData, error)
	GetBlogPagesNumber(limit int) (int, error)
	GetAllNewsPosts(page, limit int) ([]models.PostData, error)
	GetNewsPagesNumber(limit int) (int, error)
	GetBlogPostBySlug(slug string) (models.PostData, error)
	GetNewsPostBySlug(slug string) (models.PostData, error)
	GetAllNewsCategories() ([]models.Category, error)
	GetAllBlogCategories() ([]models.Category, error)
	GetNewsCategoryIDBySlug(name string) (int64, error)
	GetBlogCategoryIDBySlug(name string) (int64, error)
	GetBlogPostsByCategorySlug(slug string, page int, limit int) (
		[]models.PostData, error,
	)
	GetNewsPostsByCategorySlug(slug string, page int, limit int) ([]models.PostData, error)
	GetBlogPagesNumberCategory(category string, limit int) (int, error)
	GetNewsPagesNumberCategory(category string, limit int) (int, error)
}

func NewHandler(service Service, sess *sessions.Sessions) *Handler {
	return &Handler{
		Service: service,
		Sess:    sess,
	}
}

func (h *Handler) Home(c echo.Context) error {
	return render(c, http.StatusOK, pages.Home())
}

func (h *Handler) PrivacyPolicy(c echo.Context) error {
	return render(c, http.StatusOK, pages.PrivacyPolicy())
}

func (h *Handler) CookiesPolicy(c echo.Context) error {
	return render(c, http.StatusOK, pages.CookiesPolicy())
}

func (h *Handler) Terms(c echo.Context) error {
	return render(c, http.StatusOK, pages.Terms())
}

func (h *Handler) LegalResponsibility(c echo.Context) error {
	return render(c, http.StatusOK, pages.LegalResp())
}

func (h *Handler) AboutCompany(c echo.Context) error {
	return render(c, http.StatusOK, pages.AboutCompany())
}

func (h *Handler) BrandTools(c echo.Context) error {
	return render(c, http.StatusOK, pages.BrandTools())
}

func (h *Handler) AccountDelete(c echo.Context) error {
	return render(c, http.StatusOK, pages.Delete())
}

func (h *Handler) Jobs(c echo.Context) error {
	return render(c, http.StatusOK, pages.Jobs())
}

func (h *Handler) ContactUs(c echo.Context) error {
	return render(c, http.StatusOK, pages.ContactUs())
}

func (h *Handler) Faq(c echo.Context) error {
	return render(c, http.StatusOK, pages.Faq())
}

func (h *Handler) Report(c echo.Context) error {
	return render(c, http.StatusOK, pages.Report())
}

func (h *Handler) Support(c echo.Context) error {
	return render(c, http.StatusOK, pages.SupportService())
}

func (h *Handler) HowItWorks(c echo.Context) error {
	return render(c, http.StatusOK, pages.HowItWorks())
}

func (h *Handler) Donate(c echo.Context) error {
	return render(c, http.StatusOK, pages.Donate())
}

func (h *Handler) SafetyCenter(c echo.Context) error {
	return render(c, http.StatusOK, pages.SafetyCenter())
}

func (h *Handler) Moderation(c echo.Context) error {
	return render(c, http.StatusOK, pages.Moderation())
}

func (h *Handler) CommunityGuidelines(c echo.Context) error {
	return render(c, http.StatusOK, pages.CommunityGuidelines())
}

func (h *Handler) Download(c echo.Context) error {
	success := c.QueryParam("success") == "true"
	return render(c, http.StatusOK, pages.Download(success))
}

func (h *Handler) Invite(c echo.Context) error {
	return render(c, http.StatusOK, pages.Invite())
}

func (h *Handler) GoogleAnalyticsVerification(c echo.Context) error {
	verificationCode := "google-site-verification: google6445e6399eb6df6f.html"
	return c.String(http.StatusOK, verificationCode)
}

func (h *Handler) AssetLinks(c echo.Context) error {
	assetLinks := `[
  {
	"relation": ["delegate_permission/common.handle_all_urls"],
	"target": {
		"namespace": "android_app",
		"package_name": "com.app.yoursecret",
		"sha256_cert_fingerprints": [
			"24:F8:40:F9:E1:27:90:4D:CC:73:7E:81:11:BE:78:95:4F:F5:7D:31:D7:79:0F:94:FB:53:0B:A0:DC:6E:BC:DD",
			"19:D5:18:18:D9:DD:24:D1:B1:AA:35:F7:BF:49:F3:23:94:89:F5:28:0C:D6:5D:59:BE:0A:B8:75:6A:FF:11:E6"
		]
		}
	}
]`
	return c.JSONBlob(http.StatusOK, []byte(assetLinks))
}

func (h *Handler) AppleAppSiteAssociation(c echo.Context) error {
	appleAssociation := `{
  "applinks": {
    "apps": [],
    "details": [
      {
        "appID": "NV55U9SH3M.com.farnora.yoursecret",
        "paths": ["/dl/*", "/invite/*"]
      }
    ]
  }
}`
	return c.JSONBlob(http.StatusOK, []byte(appleAssociation))
}
