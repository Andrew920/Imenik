CREATE TABLE contact(
  	id INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT,
    ime VARCHAR(100),
    priimek VARCHAR(100),
    telst VARCHAR(9),
    email VARCHAR(100),
    starost INT,
    modified DATE,
    FOREIGN KEY (id_user) REFERENCES users(id)
);