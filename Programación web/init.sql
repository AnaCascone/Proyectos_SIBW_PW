-- Base de datos de la practica. Para cargarla:
--   USE dbanach2173_pw2526;
--   SOURCE init.sql;

-- Borramos la tablas si existen
DROP TABLE IF EXISTS pe2_viajes;
DROP TABLE IF EXISTS pe2_usuarios;
DROP TABLE IF EXISTS pe2_paises;

-- Creamos las tablas
CREATE TABLE pe2_usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre_usuario VARCHAR(50) NOT NULL UNIQUE,
  nombre_completo VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  contrasenia VARCHAR(255) NOT NULL,
  fecha_nacimiento DATE NOT NULL,
  tipo ENUM('administrador','usuario') NOT NULL DEFAULT 'usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
 
CREATE TABLE pe2_paises (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(50) NOT NULL UNIQUE,
  continente VARCHAR(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
 
CREATE TABLE pe2_viajes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  destino VARCHAR(100) NOT NULL,
  pais_id INT NOT NULL,
  descripcion TEXT NOT NULL,
  frase_promo VARCHAR(255) NOT NULL,
  imagen VARCHAR(150) NOT NULL,
  precio DECIMAL(10,2) NOT NULL,
  fecha_inicio DATE NOT NULL,
  fecha_fin DATE NOT NULL,
  FOREIGN KEY (pais_id) REFERENCES pe2_paises(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- usuario admin -> contraseña: admin123
INSERT INTO pe2_usuarios (nombre_usuario, nombre_completo, email, contrasenia, fecha_nacimiento, tipo) VALUES
('admin', 'Administrador Nexus Gate', 'admin@nexusgate.com',
 '$2y$10$Tgj3IZuqEOgE/8578TR9HeBJyPk9xOYyqedSbw6npdtzF0u3l2KZq',
 '2003-7-21', 'administrador');


-- Insertamos algunos países

INSERT INTO pe2_paises (id, nombre, continente) VALUES
(1, 'Japón', 'Asia'),
(2, 'Corea del Sur', 'Asia'),
(3, 'Alemania', 'Europa'),
(4, 'España', 'Europa'),
(5, 'Estados Unidos', 'América');

-- Insertamos algunos viajes

INSERT INTO pe2_viajes (destino, pais_id, descripcion, frase_promo, imagen, precio, fecha_inicio, fecha_fin) VALUES

('Tokio Gamer Experience', 1,
 'Sumérgete en el corazón de Japón y descubre Tokio como nunca antes.

Vive la experiencia gamer definitiva en Akihabara, explora arcades legendarios y disfruta de la cultura otaku en su máximo esplendor.

Este viaje combina tradición y modernidad, permitiéndote visitar templos históricos mientras disfrutas de los últimos avances tecnológicos y eventos de videojuegos.

Alojamiento recomendado: hotel en Shinjuku o Akihabara. Incluye visitas guiadas y actividades culturales.',
 '¡Vive la experiencia gamer definitiva en Tokio!', 'tokio.jpg', 1899.00, '2026-09-10', '2026-09-19'),

('Osaka Retro Gaming Tour', 1,
 'Recorre las tiendas retro de Den Den Town y descubre auténticas joyas clásicas del videojuego.

Osaka destaca por su ambiente desenfadado, su gastronomía y su enorme oferta de ocio relacionada con el gaming y la cultura japonesa.

Incluye rutas guiadas por las principales zonas comerciales y actividades para los amantes del videojuego retro.',
 'El paraíso del videojuego retro te espera.', 'osaka.jpg', 1750.00, '2026-09-05', '2026-09-13'),

('Kioto Tradicional & Gaming', 1,
 'Descubre una de las ciudades más emblemáticas de Japón mientras disfrutas de experiencias relacionadas con el mundo del videojuego.

Templos milenarios, jardines tradicionales y salones recreativos conviven en una ciudad donde pasado y futuro se encuentran.

Una experiencia ideal para quienes buscan cultura japonesa sin renunciar a su pasión gamer.',
 'Donde los samuráis se encuentran con los píxeles.', 'kioto.jpg', 1820.00, '2026-11-02', '2026-11-10'),

('Akihabara Tech Tour', 1,
 'Tour intensivo por el barrio tecnológico más famoso del planeta.

Electrónica, figuras coleccionables, tiendas especializadas, maid cafés y eventos exclusivos forman parte de esta experiencia única.

Perfecto para los aficionados a la tecnología, el anime y los videojuegos.',
 'El barrio más friki del planeta.', 'akihabara.jpg', 1450.00, '2026-12-01', '2026-12-07'),

('Seúl eSports Experience', 2,
 'Adéntrate en la capital mundial de los eSports y descubre por qué Corea del Sur es una referencia internacional en el sector.

Visitarás estadios profesionales, gaming cafés y zonas emblemáticas relacionadas con la competición profesional.

Incluye actividades culturales para conocer la historia y gastronomía coreanas.',
 'Adéntrate en la capital mundial de los eSports.', 'seul.jpg', 1950.00, '2026-09-20', '2026-09-28'),

('Busan Gaming Coast', 2,
 'Disfruta de la costa coreana mientras descubres uno de los principales centros tecnológicos y de ocio del país.

La experiencia combina playa, gastronomía local y la famosa feria G-Star, una de las más importantes de Asia.

Ideal para quienes buscan una mezcla de relax y entretenimiento digital.',
 'Videojuegos con vistas al mar.', 'busan.jpg', 1680.00, '2026-11-15', '2026-11-22'),

('Berlín Indie Gaming', 3,
 'Explora la capital europea del desarrollo independiente de videojuegos.

Conocerás estudios, eventos especializados y una de las comunidades creativas más importantes del continente.

Además de la experiencia gamer, disfrutarás de la oferta cultural y artística de Berlín.',
 'Descubre el corazón indie de Europa.', 'berlin.jpg', 1290.00, '2026-10-10', '2026-10-16'),

('Colonia Gamescom Tour', 3,
 'Vive desde dentro la mayor feria de videojuegos del mundo.

Incluye acceso prioritario a la Gamescom, alojamiento céntrico y tiempo libre para recorrer la ciudad de Colonia.

Una experiencia imprescindible para cualquier aficionado a los videojuegos.',
 'La feria gamer más grande del mundo.', 'colonia.jpg', 1550.00, '2026-08-19', '2026-08-25'),

('Granada Gamer & Alhambra', 4,
 'Descubre una de las ciudades más bellas de España mientras disfrutas de actividades relacionadas con el mundo del videojuego.

La Alhambra, los barrios históricos y el ambiente universitario convierten a Granada en un destino único.

El viaje incluye visitas culturales, zonas gaming y tiempo libre para disfrutar de la gastronomía local.',
 'Gaming, tapas y Alhambra: el plan más granaíno.', 'granada.jpg', 720.00, '2026-09-01', '2026-09-06'),

('Málaga FreakCon', 4,
 'Sol, playa y la convención freak más importante del sur de España.

Participa en actividades relacionadas con videojuegos, cómics, cosplay y cultura popular mientras disfrutas de la Costa del Sol.

Una escapada perfecta para quienes buscan ocio y buen clima.',
 'El plan gamer más soleado.', 'malaga.jpg', 690.00, '2026-07-12', '2026-07-16'),

('LA Gaming & Hollywood', 5,
 'Recorre los principales estudios relacionados con la industria del entretenimiento en Los Ángeles.

La experiencia combina videojuegos, parques temáticos, Hollywood y algunas de las zonas más emblemáticas de California.

Un viaje pensado para quienes quieren vivir el espectáculo a lo grande.',
 'Gaming a lo grande, estilo Hollywood.', 'los_angeles.jpg', 2450.00, '2026-10-20', '2026-10-28'),

('New York eSports Experience', 5,
 'La ciudad que nunca duerme también es un destino imprescindible para los amantes de los videojuegos.

Descubre arenas de eSports, tiendas especializadas y algunos de los lugares más icónicos de Manhattan.

Una combinación perfecta entre turismo urbano y cultura gamer.',
 'Videojuegos a lo grande en la capital del mundo.', 'nueva_york.jpg', 2590.00, '2026-12-10', '2026-12-17');


-- Añadimos algunos viajes adicionales de Japón para poder comprobar
-- correctamente la paginación cuando se filtra por país

INSERT INTO pe2_viajes
(destino, pais_id, descripcion, frase_promo, imagen, precio, fecha_inicio, fecha_fin)
VALUES

('Shibuya Night Gaming', 1,
 'Luces, videojuegos y vida nocturna en el corazón de Tokio.',
 'La experiencia gamer más vibrante de Japón.',
 'shibuya.jpg', 1790.00, '2027-03-10', '2027-03-18'),

('Hiroshima History & Gaming', 1,
 'Una combinación única de historia japonesa y entretenimiento moderno.',
 'Cultura histórica y ocio digital.',
 'hiroshima.jpg', 1650.00, '2027-04-15', '2027-04-22'),

('Nara Tradición & Gaming', 1,
 'Descubre la tradición japonesa junto a experiencias gamer únicas.',
 'Historia japonesa y cultura interactiva.',
 'nara.jpg', 1590.00, '2027-05-05', '2027-05-12'),

('Yokohama Digital Port', 1,
 'Tecnología, ocio y cultura en una de las ciudades más modernas de Japón.',
 'La puerta tecnológica del Pacífico.',
 'yokohama.jpg', 1720.00, '2027-06-12', '2027-06-19'),

('Kobe Gaming & Gastronomía', 1,
 'Videojuegos, gastronomía y cultura urbana japonesa.',
 'La combinación perfecta entre ocio y sabor.',
 'kobe.jpg', 1680.00, '2027-07-08', '2027-07-15'),

('Sapporo Snow & Gaming', 1,
 'La mejor experiencia gamer entre paisajes nevados.',
 'Invierno japonés para auténticos gamers.',
 'sapporo.jpg', 1820.00, '2027-01-15', '2027-01-22'),

('Nagoya Tech Experience', 1,
 'Industria tecnológica y entretenimiento en una de las ciudades más innovadoras de Japón.',
 'Tecnología japonesa en estado puro.',
 'nagoya.jpg', 1700.00, '2027-08-10', '2027-08-17'),

('Fukuoka Gaming & Cultura', 1,
 'Una ciudad moderna con gran ambiente gamer y tradición japonesa.',
 'El Japón más moderno te espera.',
 'fukuoka.jpg', 1660.00, '2027-09-03', '2027-09-10'),

('Hiroshima Peace & Tech', 1,
 'Historia, innovación y cultura en un viaje inolvidable.',
 'La unión perfecta entre pasado y futuro.',
 'hiroshima_tech.jpg', 1740.00, '2027-10-12', '2027-10-19');