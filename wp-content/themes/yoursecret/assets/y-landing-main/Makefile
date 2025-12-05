include debug.env

generate:
	~/go/bin/templ generate

up_dbs:
	@echo "Starting Docker images..."
	docker-compose up -d postgres redis
	@echo "All Docker images are started"

down:
	@echo "Stopping docker compose..."
	docker-compose down
	@echo "Done!"

debug:
	echo "Starting..."
	RD_PORT=${RD_PORT} RD_HOST=${RD_HOST} PORT=${PORT} PG_HOST=${PG_HOST} PG_PORT=${PG_PORT} PG_USER=${PG_USER} PG_PASS=${PG_PASS} PG_DB_NAME=${PG_DB_NAME} RD_HOST=${RD_HOST} RD_PORT=${RD_PORT} go run ./cmd/web/main.go -rod="show,slow=15s,trace"
	@echo "Started!"

run: generate
	@echo "Starting..."
	RD_PORT=${RD_PORT} RD_HOST=${RD_HOST} PORT=${PORT} PG_HOST=${PG_HOST} PG_PORT=${PG_PORT} PG_USER=${PG_USER} PG_PASS=${PG_PASS} PG_DB_NAME=${PG_DB_NAME} RD_HOST=${RD_HOST} RD_PORT=${RD_PORT} go run ./cmd/web/main.go
	@echo "Started!"

race:
	@echo "Starting..."
	RD_PORT=${RD_PORT} RD_HOST=${RD_HOST} PORT=${PORT} PG_HOST=${PG_HOST} PG_PORT=${PG_PORT} PG_USER=${PG_USER} PG_PASS=${PG_PASS} PG_DB_NAME=${PG_DB_NAME} RD_HOST=${RD_HOST} RD_PORT=${RD_PORT} go run -race ./cmd/web/main.go
	@echo "Started!"

build:
	@echo "Building..."
	go build -o ./bin/pricecomp ./cmd/web
	@echo "Built!"

makemigrations:
	migrate create -ext sql -dir ./schema -seq init