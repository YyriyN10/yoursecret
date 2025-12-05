package models

import (
	"fmt"
	"time"
)

type TemplateData struct {
	UserID         int
	ActiveMenuItem string
	Flash          string
	Warning        string
	Error          string
	Authenticated  bool
	UserRole       string
}

type User struct {
	ID       int    `db:"user_id"`
	Login    string `db:"user_login"`
	Password string `db:"user_pass"`
	Role     string `db:"user_role"`
	Active   bool   `db:"active"`
}

type ScrapingPoolItem struct {
	CreatedAt  time.Time
	UserID     int
	ScrapingID int
	EAN        string
	SKU        string
	Price      float64
	Name       string
	ParsedData map[string]ScrapedDataItem
}

type ScrapedDataItem struct {
	Finished   bool
	ScrapingID int
	Site       string
	Data       ScrapedData
	Err        error
}

type ScrapedData struct {
	Name   String
	Price  Float
	Link   String
	Amount String
}

type Float struct {
	Value float64
	Found bool
	Err   error
}

func (f Float) String() string {
	if f.Found && f.Err == nil {
		return fmt.Sprintf("%.2f", f.Value)
	} else if f.Err != nil {
		return fmt.Sprintf("no data (error: %s)", f.Err)
	} else {
		return "no data"
	}
}

type String struct {
	Value string
	Found bool
	Err   error
}

func (s String) String() string {
	if s.Found && s.Err == nil {
		return s.Value
	} else if s.Err != nil {
		return fmt.Sprintf("no data (error: %s)", s.Err)
	} else {
		return "no data"
	}
}

type ItemsForScraping struct {
	EAN   string
	SKU   string
	Price float64
	Name  string
}

type Group struct {
	GroupID  int
	Created  time.Time
	List     []int
	FileName string
	UserID   int
}

func (g Group) Time() string {
	duration := time.Since(g.Created)
	seconds := int(duration.Seconds())
	minutes := int(duration.Minutes())
	hours := int(duration.Hours())
	days := int(duration.Hours() / 24)

	switch {
	case days > 0:
		return fmt.Sprintf("%d days ago", days)
	case hours > 0:
		return fmt.Sprintf("%d hours ago", hours)
	case minutes > 0:
		return fmt.Sprintf("%d minutes ago", minutes)
	default:
		return fmt.Sprintf("%d seconds ago", seconds)
	}
}

type IncomeData struct {
	ScrapingID int
	EAN        string
	SKU        string
}

type Blog struct {
	ID             int       `db:"id"`
	Title          string    `db:"title"`
	Slug           string    `db:"slug"`
	ImageLink      string    `db:"image_link"`
	ShortText      string    `db:"short_text"`
	FullText       string    `db:"full_text"`
	BlogCategoryID int       `db:"blog_category_id"`
	CreatedAt      time.Time `db:"created_at"`
	UpdatedAt      time.Time `db:"updated_at"`
}

func (b Blog) Format(t time.Time) string {
	return t.Format("02.01.2006")
}

type News struct {
	ID             int       `db:"id"`
	Title          string    `db:"title"`
	Slug           string    `db:"slug"`
	ImageLink      string    `db:"image_link"`
	ShortText      string    `db:"short_text"`
	FullText       string    `db:"full_text"`
	NewsCategoryID int       `db:"news_category_id"`
	CreatedAt      time.Time `db:"created_at"`
	UpdatedAt      time.Time `db:"updated_at"`
}

func (b News) Format(t time.Time) string {
	return t.Format("02.01.2006")
}

type PostData struct {
	Title        string
	Slug         string
	ImageLink    string
	ShortText    string
	FullText     string
	CategoryName string
	CategorySlug string
	CreatedAt    time.Time
}

func (b PostData) Format(t time.Time) string {
	return t.Format("02.01.2006")
}

type Category struct {
	ID   int    `db:"id"`
	Name string `db:"name"`
	Slug string `db:"slug"`
}
