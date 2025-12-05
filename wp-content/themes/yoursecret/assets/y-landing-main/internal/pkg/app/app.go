package app

import (
	"fmt"
	"y-landing/internal/handler"
	"y-landing/internal/postgres"
	"y-landing/internal/service"
	"y-landing/internal/sessions"

	"github.com/labstack/echo/v4"
	"github.com/labstack/echo/v4/middleware"
	session "github.com/spazzymoto/echo-scs-session"
)

type App struct {
	Server  *echo.Echo
	Handler *handler.Handler
	Service *service.Service
}

func NewApp(pgConfig, redisAddr string) (*App, error) {
	a := App{}

	pg, err := postgres.NewPostgres(pgConfig)
	if err != nil {
		return nil, err
	}
	fmt.Println(redisAddr)
	sess := sessions.NewSessions(redisAddr)
	a.Server = echo.New()
	a.Service = service.NewService(pg)
	a.Handler = handler.NewHandler(a.Service, sess)
	a.Server.Use(middleware.Logger())
	a.Server.Use(middleware.Recover())
	a.Server.Use(session.LoadAndSave(sess.SessionManager))
	a.Server.Static("static", "./static")

	a.Server.GET("/", a.Handler.Home)
	a.Server.GET("/privacy-policy", a.Handler.PrivacyPolicy)
	a.Server.GET("/cookies-policy", a.Handler.CookiesPolicy)
	a.Server.GET("/terms-of-use", a.Handler.Terms)
	a.Server.GET("/legal-responsibility", a.Handler.LegalResponsibility)
	a.Server.GET("/about-company", a.Handler.AboutCompany)
	a.Server.GET("/brand-tools", a.Handler.BrandTools)
	a.Server.GET("/info/delete", a.Handler.AccountDelete)
	a.Server.GET("/jobs", a.Handler.Jobs)
	a.Server.GET("/contact-us", a.Handler.ContactUs)
	a.Server.GET("/faq", a.Handler.Faq)
	a.Server.GET("/report", a.Handler.Report)
	a.Server.GET("/support", a.Handler.Support)
	a.Server.GET("/how-it-works", a.Handler.HowItWorks)
	a.Server.GET("/donate", a.Handler.Donate)
	a.Server.GET("/safety-center", a.Handler.SafetyCenter)
	a.Server.GET("/moderation", a.Handler.Moderation)
	a.Server.GET("/community-guidelines", a.Handler.CommunityGuidelines)
	a.Server.GET("/download", a.Handler.Download)
	a.Server.GET("/invite", a.Handler.Invite)
	a.Server.GET("/blog", a.Handler.Blog)
	a.Server.GET("/blog/:category", a.Handler.BlogCategory)
	a.Server.GET("/blog/:category/:slug", a.Handler.BlogPost)
	a.Server.GET("/news", a.Handler.News)
	a.Server.GET("/news/:category", a.Handler.NewsCategory)
	a.Server.GET("/news/:category/:slug", a.Handler.NewsPost)

	a.Server.POST("/subscribe", a.Handler.CreateSubscription)

	a.Server.GET("/google6445e6399eb6df6f.html", a.Handler.GoogleAnalyticsVerification)
	a.Server.GET("/.well-known/assetlinks.json", a.Handler.AssetLinks)
	a.Server.GET("/.well-known/apple-app-site-association", a.Handler.AppleAppSiteAssociation)

	admin := a.Server.Group("/admin")
	admin.Static("/static", "./static-admin")
	admin.GET("/login", a.Handler.LoginGet)
	admin.POST("/login", a.Handler.LoginPost)
	admin.GET("/logout", a.Handler.LogOut)
	admin.GET("/users", a.Handler.Users)
	admin.GET("/users/add", a.Handler.UserAddGet)
	admin.POST("/users/add", a.Handler.UserAddPost)
	admin.GET("/users/:id/edit", a.Handler.EditUser)
	admin.POST("/users/:id/edit", a.Handler.UserEditPost)
	admin.GET("/users/:id/edit-pass", a.Handler.ChangePass)
	admin.POST("/users/:id/edit-pass", a.Handler.ChangePassPost)
	admin.GET("/users/:id/activation", a.Handler.ActivateOrDiactivateUser)
	admin.GET("/users/:id", a.Handler.User)
	return &a, nil
}

func (a *App) Run(port string) error {
	return a.Server.Start(":" + port)
}
