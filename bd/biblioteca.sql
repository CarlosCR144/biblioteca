-- Script base de datos para implementar BD en MySQL Workbench

-- crear base de datos
CREATE DATABASE biblioteca;

-- utilizar base de datos
USE biblioteca;

-- crear estructura de tablas con sus tipos de datos

CREATE TABLE categoria (
	id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion VARCHAR(255)
);

CREATE TABLE editorial (
	id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    pais VARCHAR(100) NOT NULL
);

CREATE TABLE libro (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    autor VARCHAR(255),
    isbn INT NOT NULL,
    anio_publicacion INT,
    ejemplares_disponibles INT NOT NULL,
    ejemplares_totales INT NOT NULL,
    id_categoria INT NOT NULL,
    id_editorial INT NOT NULL,
    FOREIGN KEY (id_categoria) REFERENCES categoria (id),
    FOREIGN KEY (id_editorial) REFERENCES editorial (id)
);

-- tabla estudiante
CREATE TABLE estudiante (
    id INT AUTO_INCREMENT PRIMARY KEY,
    rut VARCHAR(12) NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    direccion VARCHAR(200) NOT NULL,
    fecha_nacimiento DATE NOT NULL,
    telefono VARCHAR(20),
    email VARCHAR(100),
    nacionalidad VARCHAR(100)
);
-- tabla prestamo
CREATE TABLE prestamo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_libro INT NOT NULL,
    id_estudiante INT NOT NULL,
    fecha_prestamo DATE NOT NULL,
    fecha_devolucion DATE,
    estado ENUM('Pendiente', 'Devuelto') DEFAULT 'PENDIENTE',
    FOREIGN KEY (id_libro) REFERENCES libro(id),
    FOREIGN KEY (id_estudiante) REFERENCES estudiante(id)
);

-- logica será un libro pedido es un préstamo

-- inserción datos
-- Agregar 10 registros a la tabla "categoria"
INSERT INTO categoria (nombre, descripcion)
VALUES
    ('Aventura', 'Libros de aventuras emocionantes'),
    ('Ciencia', 'Libros de divulgación científica'),
    ('Poesía', 'Colección de poemas'),
    ('Suspenso', 'Libros de suspenso y misterio'),
    ('Drama', 'Libros dramáticos'),
    ('Historia del Arte', 'Libros sobre la historia del arte'),
    ('Política', 'Libros sobre política y sociedad'),
    ('Fantasía Épica', 'Libros de fantasía épica'),
    ('Autoayuda', 'Libros de autoayuda y desarrollo personal'),
    ('Humor', 'Libros humorísticos');

-- Agregar 10 registros a la tabla "editorial"
INSERT INTO editorial (nombre, pais)
VALUES
    ('Editorial Anagrama', 'España'),
    ('HarperCollins', 'Reino Unido'),
    ('Editorial Alfaguara', 'España'),
    ('Ediciones Siruela', 'España'),
    ('Editorial Montena', 'España'),
    ('Editorial Océano', 'México'),
    ('Ediciones B', 'España'),
    ('Editorial Norma', 'Colombia'),
    ('Editorial Sudamericana', 'Argentina'),
    ('Editorial Everest', 'España');

-- Agregar 10 registros a la tabla "libro"
INSERT INTO libro (titulo, autor, isbn, anio_publicacion, ejemplares_disponibles, ejemplares_totales, id_categoria, id_editorial)
VALUES
    ('La sombra del viento', 'Carlos Ruiz Zafón', 97884080, 2001, 5, 10, 1, 1),
    ('Mujer en punto cero', 'Nawal El Saadawi', 97884322, 1973, 7, 7, 2, 2),
    ('Romeo y Julieta', 'William Shakespeare', 7884376, 1597, 8, 10, 5, 3),
    ('La catedral del mar', 'Ildefonso Falcones', 97884666, 2006, 6, 8, 1, 4),
    ('Rayuela', 'Julio Cortázar', 77978843, 1963, 9, 12, 3, 5),
    ('Los pilares de la Tierra', 'Ken Follett', 39788497, 1989, 5, 8, 4, 6),
    ('La carretera', 'Cormac McCarthy', 89786073, 2006, 4, 6, 2, 7),
    ('La Sombra de Ender', 'Orson Scott Card', 87697884, 1999, 7, 9, 1, 8),
    ('El túnel', 'Ernesto Sabato', 337884323, 1948, 6, 7, 5, 9),
    ('El nombre del viento', 'Patrick Rothfuss', 99082479, 2007, 8, 10, 8, 10);

-- Agregar 10 registros  a la tabla "estudiante"
INSERT INTO estudiante (rut, nombre, direccion, fecha_nacimiento, telefono, email, nacionalidad)
VALUES
    ('34567890-1', 'María Rodríguez', 'Calle 345, Concepción, Chile', '2000-03-10', '+56 9 3456 7890', 'maria@example.com', 'Chilena'),
    ('45678901-2', 'Pedro Gómez', 'Avenida 456, Antofagasta, Chile', '1999-05-18', '+56 9 4567 8901', 'pedro@example.com', 'Chilena'),
    ('56789012-3', 'Laura Martínez', 'Ruta 567, Temuco, Chile', '1997-11-28', '+56 9 5678 9012', 'laura@example.com', 'Chilena'),
    ('67890123-4', 'Fernando Silva', 'Calle 678, Arica, Chile', '2002-02-15', '+56 9 6789 0123', 'fernando@example.com', 'Chilena'),
    ('78901234-5', 'Isabel Fernández', 'Avenida 789, La Serena, Chile', '1998-07-05', '+56 9 7890 1234', 'isabel@example.com', 'Chilena'),
    ('89012345-6', 'Eduardo Pérez', 'Ruta 890, Punta Arenas, Chile', '2001-09-21', '+56 9 8901 2345', 'eduardo@example.com', 'Chilena'),
    ('90123456-7', 'Carolina Soto', 'Calle 901, Rancagua, Chile', '1996-12-14', '+56 9 9012 3456', 'carolina@example.com', 'Chilena'),
    ('01234567-8', 'Manuel Torres', 'Ruta 012, Valdivia, Chile', '2003-04-03', '+56 9 0123 4567', 'manuel@example.com', 'Chilena'),
    ('12345678-9', 'Marcela López', 'Avenida 123, Santiago, Chile', '1995-08-07', '+56 9 1234 5678', 'marcela@example.com', 'Chilena'),
    ('23456789-0', 'Andrés González', 'Calle 234, Valparaíso, Chile', '2000-01-12', '+56 9 2345 6789', 'andres@example.com', 'Chilena');

-- Agregar 20 registros  a la tabla "prestamo" con ejemplares prestados
-- (Asumiendo que solo se prestan 1 ejemplar de cada libro en esta inserción)
INSERT INTO prestamo (id_libro, id_estudiante, fecha_prestamo, fecha_devolucion, estado)
VALUES
    (1, 1, '2023-09-01', NULL, 'Pendiente'),
    (2, 2, '2023-09-02', NULL, 'Pendiente'),
    (3, 1, '2023-09-03', NULL, 'Pendiente'),
    (1, 2, '2023-09-04', NULL, 'Pendiente'),
    (4, 3, '2023-09-05', NULL, 'Pendiente'),
    (5, 4, '2023-09-06', NULL, 'Pendiente'),
    (2, 5, '2023-09-07', NULL, 'Pendiente'),
    (6, 6, '2023-09-08', NULL, 'Pendiente'),
    (7, 7, '2023-09-09', NULL, 'Pendiente'),
    (8, 8, '2023-09-10', NULL, 'Pendiente'),
    (9, 9, '2023-09-11', NULL, 'Pendiente'),
    (10, 10, '2023-09-12', NULL, 'Pendiente'),
    (3, 1, '2023-09-13', NULL, 'Pendiente'),
    (4, 2, '2023-09-14', NULL, 'Pendiente'),
    (5, 3, '2023-09-15', NULL, 'Pendiente'),
    (6, 4, '2023-09-16', NULL, 'Pendiente'),
    (7, 5, '2023-09-17', NULL, 'Pendiente'),
    (8, 6, '2023-09-18', NULL, 'Pendiente'),
    (9, 7, '2023-09-19', NULL, 'Pendiente'),
    (10, 8, '2023-09-20', NULL, 'Pendiente');
    
-- SHOW TABLES;

-- SELECT * FROM categoria;
-- SELECT * FROM editorial;
-- SELECT * FROM estudiante;
-- SELECT * FROM libro;
-- SELECT * FROM prestamo;

