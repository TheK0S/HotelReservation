CREATE TABLE users(
    id INT PRIMARY KEY AUTO_INCREMENT,
    firstName VARCHAR(50) NOT NULL,    
    lastName VARCHAR(50) NOT NULL,
    patronomic VARCHAR(50),
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    phoneNumber VARCHAR(20) NOT NULL,
    discount INT NOT NULL DEFAULT 0,
    birthdate DATE,
    registerDate DATE,
    role VARCHAR(20) NOT NULL DEFAULT 'user'
);

CREATE TABLE hotels(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,    
    address VARCHAR(255) NOT NULL,
    grade INT NOT NULL DEFAULT 1,
    title VARCHAR(255) NOT NULL,
    text VARCHAR(255) NOT NULL,
    phoneNumber VARCHAR(20) NOT NULL,
    birthdate DATE,
    reconstructionDate DATE,
    roomsCount INT NOT NULL DEFAULT 0,
    beachLine INT,
    imagePath VARCHAR(255) NOT NULL
);

CREATE TABLE rooms(
    id INT PRIMARY KEY AUTO_INCREMENT,
    hotelId INT NOT NULL,
    bedsCount INT NOT NULL,
    roomGrade INT NOT NULL,
    roomTitle VARCHAR(255) NOT NULL,
    roomText VARCHAR(255) NOT NULL,
    isConditioner BOOLEAN NOT NULL,
    isTV BOOLEAN NOT NULL,
    isWiFi BOOLEAN NOT NULL,
    price DECIMAL(10, 2),
    isReserved BOOLEAN NOT NULL
);

CREATE TABLE reservations(
    id INT PRIMARY KEY AUTO_INCREMENT,
    hotelId INT NOT NULL,
    roomId INT NOT NULL,
    userId INT NOT NULL,
    dateIn DATE,
    dateOut DATE,
    reservationDate DATE,
    reservationPrice DECIMAL(10, 2)
);

CREATE TABLE hotelImagePath(
    id INT PRIMARY KEY AUTO_INCREMENT,
    hotelId INT NOT NULL,   
    title VARCHAR(255) NOT NULL,
    imagePath VARCHAR(255) NOT NULL
);

ALTER TABLE rooms
ADD CONSTRAINT fk_rooms_hotels
FOREIGN KEY (hotelId)
REFERENCES hotels(id);

ALTER TABLE reservations
ADD CONSTRAINT fk_reservations_users
FOREIGN KEY (userId)
REFERENCES users(id);

ALTER TABLE reservations
ADD CONSTRAINT fk_reservations_rooms
FOREIGN KEY (roomId)
REFERENCES rooms(id);

ALTER TABLE reservations
ADD CONSTRAINT fk_reservations_hotels
FOREIGN KEY (hotelId)
REFERENCES hotels(id);

ALTER TABLE hotelImagePath
ADD CONSTRAINT fk_hotelImagePath_hotels
FOREIGN KEY (hotelId)
REFERENCES hotels(id);