package postgres

import (
	"errors"
	"fmt"
	"github.com/lib/pq"
)

const subscriptionTable = "subscriptions"

var ErrEmailAlreadyExists = fmt.Errorf("email already exists")

func (p *Postgres) CreateSubscription(email string) error {
	query := fmt.Sprintf("INSERT INTO %s (subscription_email) VALUES ($1)", subscriptionTable)

	_, err := p.db.Exec(query, email)
	if err != nil {
		var pqErr *pq.Error
		if errors.As(err, &pqErr) {
			if pqErr.Code == "23505" {
				return ErrEmailAlreadyExists
			} else {
				return err
			}
		}
	}
	return nil
}
