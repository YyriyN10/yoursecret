CREATE TABLE IF NOT EXISTS subscriptions (
    subscription_id SERIAL PRIMARY KEY,
    subscription_email VARCHAR(255) NOT NULL UNIQUE,
    subscription_created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);