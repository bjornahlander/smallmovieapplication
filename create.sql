CREATE TABLE movies (
  id SERIAL,
  title VARCHAR(250),
  description TEXT,
  rating INT,
  CHECK( rating >= 1 AND rating <= 5)
);