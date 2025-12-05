package sessions

import (
	"github.com/alexedwards/scs/redisstore"
	"github.com/alexedwards/scs/v2"
	"github.com/gomodule/redigo/redis"
	"log"
	"net/http"
	"time"
)

type Sessions struct {
	SessionManager *scs.SessionManager
}

func NewSessions(redisAddress string) *Sessions {
	return &Sessions{
		SessionManager: initSession(redisAddress),
	}
}

func initSession(redisAddress string) *scs.SessionManager {
	log.Printf("Connecting to Redis: %s\n", redisAddress)
	session := scs.New()
	session.Store = redisstore.New(initRedis(redisAddress))
	session.Lifetime = 720 * time.Hour
	session.Cookie.Persist = true
	session.Cookie.SameSite = http.SameSiteLaxMode
	session.Cookie.Secure = false

	return session
}

func initRedis(address string) *redis.Pool {
	redisPool := &redis.Pool{
		MaxIdle: 10,
		Dial: func() (redis.Conn, error) {
			return redis.Dial("tcp", address)
		},
	}

	return redisPool
}
