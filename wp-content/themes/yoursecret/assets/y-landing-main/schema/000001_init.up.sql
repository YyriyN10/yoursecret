CREATE TABLE users (
       user_id SERIAL PRIMARY KEY NOT NULL,
       user_login VARCHAR(100) NOT NULL UNIQUE,
       user_pass VARCHAR(300) NOT NULL,
       user_role VARCHAR(20) NOT NULL,
       active BOOLEAN DEFAULT true NOT NULL
);