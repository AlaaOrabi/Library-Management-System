CREATE TABLE authors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author_id INT NOT NULL
   
);



CREATE TABLE borrowing (
    id INT AUTO_INCREMENT PRIMARY KEY,
    book_id INT NOT NULL,
    borrower_name VARCHAR(100) NOT NULL,
    borrowed_date DATE NOT NULL,
    return_date DATE
   
);

INSERT INTO borrowing (book_id, borrower_name, borrowed_date, return_date) VALUES
(1, 'Ali', '2024-01-15', '2024-02-15'),
(2, 'Sara', '2024-01-20', '2024-02-20'),
(3, 'Hassan', '2024-01-25', NULL),
(4, 'Aisha', '2024-01-30', NULL),
(5, 'Yousef', '2024-02-05', NULL);

INSERT INTO authors (name) VALUES
('Ahmed Al-Saud'),
('Mohammed Al-Saud'),
('Fatima Al-Saud'),
('Layla Al-Saud'),
('Omar Al-Saud');

INSERT INTO books (title, author_id) VALUES
('The Kingdom of Sand', 1),
('Echoes of Arabia', 2),
('Sands of Time', 3),
('Desert Rose', 4),
('Golden Sands', 5);