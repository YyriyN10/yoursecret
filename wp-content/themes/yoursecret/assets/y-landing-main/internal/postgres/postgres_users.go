package postgres

import (
	"fmt"
	"y-landing/models"
)

const userTable = "users"

func (p *Postgres) GetUserByID(id int) (models.User, error) {
	user := models.User{}
	query := fmt.Sprintf("SELECT * FROM %s WHERE user_id = $1", userTable)
	err := p.db.Get(&user, query, id)
	if err != nil {
		return user, err
	}
	return user, nil
}

func (p *Postgres) GetUserByLogin(login string) (models.User, error) {
	user := models.User{}
	query := fmt.Sprintf("SELECT * FROM %s WHERE user_login = $1", userTable)
	err := p.db.Get(&user, query, login)
	if err != nil {
		return user, err
	}
	return user, nil
}

func (p *Postgres) GetAllUsers() ([]models.User, error) {
	users := []models.User{}
	query := fmt.Sprintf("SELECT * FROM %s", userTable)
	err := p.db.Select(&users, query)
	if err != nil {
		return users, err
	}
	return users, nil
}

func (p *Postgres) CreateUser(login string, pass string, role string) (int, error) {
	var id int
	query := fmt.Sprintf("INSERT INTO %s (user_login, user_pass, user_role) VALUES ($1, $2, $3) RETURNING user_id", userTable)
	row := p.db.QueryRow(query, login, pass, role)
	err := row.Scan(&id)
	if err != nil {
		return 0, err
	}
	return id, nil
}

func (p *Postgres) EditUser(userID int, login string, role string) error {
	query := fmt.Sprintf("UPDATE %s SET user_login=$1, user_role=$2 WHERE user_id=$3", userTable)
	_, err := p.db.Exec(query, login, role, userID)
	if err != nil {
		return err
	}
	return nil
}

func (p *Postgres) ChangePassword(userID int, pass string) error {
	query := fmt.Sprintf("UPDATE %s SET user_pass=$1 WHERE user_id=$2", userTable)
	_, err := p.db.Exec(query, pass, userID)
	if err != nil {
		return err
	}
	return nil
}

func (p *Postgres) GetUsersByOrgID(id int) ([]models.User, error) {
	users := []models.User{}
	query := fmt.Sprintf("SELECT * FROM %s WHERE org_id = $1", userTable)
	err := p.db.Select(&users, query, id)
	if err != nil {
		return users, err
	}
	return users, nil
}

func (p *Postgres) ActivateUser(userID int) error {
	query := fmt.Sprintf("UPDATE %s SET active=true WHERE user_id=$1", userTable)
	_, err := p.db.Exec(query, userID)
	if err != nil {
		return err
	}
	return nil
}

func (p *Postgres) DeactivateUser(userID int) error {
	query := fmt.Sprintf("UPDATE %s SET active=false WHERE user_id=$1", userTable)
	_, err := p.db.Exec(query, userID)
	if err != nil {
		return err
	}
	return nil
}
