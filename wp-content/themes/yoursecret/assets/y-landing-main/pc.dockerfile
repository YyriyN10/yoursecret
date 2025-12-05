#base go image

FROM golang:1.23.4-alpine3.21 as builder

RUN mkdir /app

COPY ./ /app

WORKDIR /app

RUN CGO_ENABLED=0 go build -o pc ./cmd/web

RUN chmod +x ./pc

#build a tiny docker image
FROM alpine:latest

RUN mkdir /app

COPY --from=builder /app /app

WORKDIR /app

CMD ["/app/pc"]