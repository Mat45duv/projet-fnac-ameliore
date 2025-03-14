-- Création de la base de données
CREATE DATABASE IF NOT EXISTS bookstruct;
USE bookstruct;

-- Création de la table books
CREATE TABLE IF NOT EXISTS books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    isbn VARCHAR(13) UNIQUE NOT NULL,
    price DECIMAL(10, 2) NOT NULL
);

-- Insertion de quelques données d'exemple
INSERT INTO books (title, author, isbn, price) VALUES
('Le Petit Prince', 'Antoine de Saint-Exupéry', '9780156012195', 6.99),
('1984', 'George Orwell', '9780451524935', 9.99),
('L\'Étranger', 'Albert Camus', '9782070360025', 8.49),
('Harry Potter à l\'école des sorciers', 'J.K. Rowling', '9780747532699', 15.99),
('Les Misérables', 'Victor Hugo', '9780451419439', 11.99);
