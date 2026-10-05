SET NAMES utf8mb4;

/* Crear las tablas */

CREATE TABLE noticias (
    id INT AUTO_INCREMENT PRIMARY KEY,

    titulo VARCHAR(255) NOT NULL,

    resumen VARCHAR(255) NOT NULL,

    cuerpo TEXT NOT NULL,

    fecha DATE NOT NULL,

    concejalia VARCHAR(100) NOT NULL,

    responsables VARCHAR(255) NOT NULL,

    publicado TINYINT(1) NOT NULL DEFAULT 1
    
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE TABLE imagenes (
    id INT AUTO_INCREMENT PRIMARY KEY,

    id_noticia INT  NOT NULL,

    archivo VARCHAR(255) NOT NULL,

    descripcion TEXT  NOT NULL,

    FOREIGN KEY (id_noticia)
        REFERENCES noticias(id)
        ON DELETE CASCADE

) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE TABLE comentarios (

    id INT AUTO_INCREMENT PRIMARY KEY,

    id_noticia INT  NOT NULL,

    nombre VARCHAR(100) NOT NULL,

    email VARCHAR(100) NOT NULL,

    texto TEXT NOT NULL,

    fecha DATETIME NOT NULL,

    editado TINYINT(1) DEFAULT 0,

    FOREIGN KEY (id_noticia)
        REFERENCES noticias(id)
        ON DELETE CASCADE

) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE TABLE localidades (

    id INT AUTO_INCREMENT PRIMARY KEY,

    nombre VARCHAR(100) NOT NULL,

    provincia VARCHAR(100) NOT NULL

) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;


/* =================== Insertar datos iniciales =================== */

/* Insertar noticias iniciales */

    /* Museo de Mazonovo*/

    INSERT INTO noticias
    (
        titulo,
        resumen,
        cuerpo,
        fecha,
        concejalia,
        responsables,
        publicado
    )

    VALUES

    (
        'Daños por borrasca en Mazonovo',

        'Una borrasca ha provocado daños en una zona exterior del Museo de los Molinos de Mazonovo',

        'Durante la madrugada del pasado martes, una borrasca provocó daños en una zona exterior del Museo de los Molinos de Mazonovo, uno de los espacios más visitados del concejo de Taramundi.

    Las intensas lluvias registradas durante varias horas, unidas a fuertes rachas de viento, afectaron a distintos elementos de madera situados en el recorrido exterior, así como a parte de la estructura visible de la rueda de algunos molinos.

    Según la primera valoración realizada por el Ayuntamiento, los desperfectos se concentran sobre todo en la pasarela de acceso y en varios tramos próximos al cauce, donde el agua y la humedad han debilitado algunos apoyos. También se han detectado daños en piezas externas del molino, por lo que se ha procedido a balizar la zona afectada para evitar el paso de visitantes hasta que se complete la revisión técnica.

    Desde el consistorio se ha informado de que el museo continúa abierto con normalidad en el resto de sus instalaciones, aunque algunas zonas del itinerario exterior permanecerán temporalmente restringidas. El objetivo es garantizar la seguridad de los visitantes y del personal mientras se estudia el alcance exacto de los daños y se planifican las labores de reparación.

    La Concejalía de Obras y Patrimonio, en coordinación con los servicios técnicos municipales, ha iniciado ya una inspección detallada de la estructura para determinar qué intervenciones son necesarias a corto plazo. Entre las primeras actuaciones previstas se encuentra la consolidación de los puntos más afectados, la retirada de elementos inestables y la reposición de varias piezas de madera deterioradas por el temporal.

    El Museo de los Molinos de Mazonovo constituye uno de los principales referentes patrimoniales y turísticos de Taramundi, por lo que el Ayuntamiento ha señalado que la recuperación de la zona dañada será una prioridad en los próximos días. Asimismo, no se descarta solicitar apoyo técnico adicional si la reparación requiere una intervención más compleja de la prevista inicialmente.

    Mientras duren los trabajos, se recomienda a vecinos y visitantes respetar la señalización instalada, evitar acceder a las áreas restringidas y seguir en todo momento las indicaciones del personal del museo. El Ayuntamiento irá informando a través de sus canales habituales sobre la evolución de la incidencia y la reapertura completa del recorrido afectado.',

        '2026-05-21',

        'Obras y Patrimonio',

        'Ayuntamiento de Taramundi y personal técnico municipal',

        '1'
    );

    INSERT INTO imagenes
    (id_noticia, archivo, descripcion)
    VALUES

    (
        1,
        'incidente1_molinoroto.png',
        'Molino y puente afectados por la borrasca'
    ),

    (
        1,
        'incidente1_normal.jpg',
        'Se continúan las actividades pero con limitaciones'
    ),

    (
        1,
        'incidente1_vertical.JPEG',
        'Por suerte, muchos molinos han salido intactos'
    );

    /* Carreteras cortadas */
    INSERT INTO noticias
    (
        titulo,
        resumen,
        cuerpo,
        fecha,
        concejalia,
        responsables,
        publicado
    )

    VALUES
    (
        'Corte temporal de tráfico en la AS-21 por trabajos forestales',

        'Trabajos forestales provocarán cortes temporales en la AS-21 durante la mañana del jueves.',

        'El Ayuntamiento de Taramundi informa de un corte temporal de tráfico en la carretera AS-21 durante la mañana del próximo jueves debido a labores de limpieza y mantenimiento forestal.

    Los trabajos se desarrollarán entre las 9:00 y las 13:00 horas en el tramo comprendido entre Mousende y Vega de Zarza.

    Se recomienda utilizar rutas alternativas y extremar la precaución en los accesos secundarios habilitados.',

        '2026-05-23',

        'Obras y Medio Rural',

        'Brigada Forestal de Taramundi',
        
        '1'
    );

    INSERT INTO imagenes
    (
        id_noticia,
        archivo,
        descripcion
    )

    VALUES
    (
        2,
        'noticia2.jpeg',
        'Calles cortadas por obras'
    );

/* Insertar comentarios iniciales */ 
    INSERT INTO comentarios
    (id_noticia, nombre, email, texto, fecha)
    VALUES

    (
        1,
        'María',
        'mariahm@gmail.com',
        'Una pena lo ocurrido en Mazonovo.',
        '2026-05-22 10:34:00'
    ),

    (
        1,
        'Carlos',
        'carlos456@gmail.com',
        '¡Espero que lo arreglen pronto! Cada cierto tiempo me gusta visitarlo con mis hijos. Es una experiencia muy bonita.',
        '2026-05-21 11:02:00'
    ),

    (
        1,
        'Lucía',
        'lucianoebff@gmail.com',
        'No me atrevo a ir allí por el momento. Espero que examinen todos los molinos para asegurarse de que no se produzca ningún accidente en un futuro.',
        '2026-05-22 12:15:00'
    );

/* Insertar localidades iniciales */
    INSERT INTO localidades
    (nombre, provincia)
    VALUES

    ('Taramundi', 'Asturias'),

    ('Mazonovo', 'Asturias'),

    ('Cudillero', 'Asturias'),

    ('Lugo', 'Lugo'),

    ('Lastres', 'Asturias'),

    ('Llanes', 'Asturias'),

    ('Ribadesella', 'Asturias'),

    ('Málaga', 'Málaga'),

    ('Granada', 'Granada');



/* ============================================== */
/*                 Práctica 4                     */
/* ============================================== */

CREATE TABLE usuarios (

    id INT AUTO_INCREMENT PRIMARY KEY,

    nombre VARCHAR(100) NOT NULL UNIQUE,

    email VARCHAR(100) NOT NULL UNIQUE,

    password VARCHAR(255) NOT NULL,

    rol ENUM(
        'registrado',
        'moderador',
        'gestor',
        'superusuario'
    ) NOT NULL DEFAULT 'registrado'

) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;


CREATE TABLE hashtags (

    id INT AUTO_INCREMENT PRIMARY KEY,

    nombre VARCHAR(100) NOT NULL UNIQUE

) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

/* Tabla intermedia para la relación muchos a muchos entre noticias y hashtags */
CREATE TABLE noticias_hashtags (

    id_noticia INT NOT NULL,

    id_hashtag INT NOT NULL,

    PRIMARY KEY(id_noticia, id_hashtag),

    FOREIGN KEY (id_noticia)
        REFERENCES noticias(id)
        ON DELETE CASCADE,

    FOREIGN KEY (id_hashtag)
        REFERENCES hashtags(id)
        ON DELETE CASCADE

) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;



/* Insertar superusuario inicial */
    INSERT INTO usuarios
    (nombre, email, password, rol)
    VALUES

    (
        'Admin',
        'admin@taramundi.es',
        '$2y$10$Tgj3IZuqEOgE/8578TR9HeBJyPk9xOYyqedSbw6npdtzF0u3l2KZq',
        'superusuario'
    );


/* Insertar hashtags iniciales */
    INSERT INTO hashtags
    (nombre)
    VALUES

    ('trafico'),

    ('carreteras'),

    ('obras');

    /* Relacionar hashtagas con la noticia */
    INSERT INTO noticias_hashtags
    (
        id_noticia,
        id_hashtag
    )

    VALUES
    (2, 1),
    (2, 2),
    (2, 3);