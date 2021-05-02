DROP DATABASE IF EXISTS dragones;
CREATE DATABASE
IF NOT EXISTS dragones;
USE dragones;

-- -----------------------------------------------------
-- Tabla dragones
-- -----------------------------------------------------
CREATE TABLE
IF NOT EXISTS dragones
(id INT UNSIGNED NOT NULL AUTO_INCREMENT, 
nombre VARCHAR
(45) NOT NULL,
imagen VARCHAR
(60) NOT NULL DEFAULT 'default.jpg',
descripcion TEXT
(1000), 
categoria_id INT UNSIGNED,

PRIMARY KEY
(id),

FOREIGN KEY
(categoria_id) REFERENCES categoria
(id) ON
DELETE
SET NULL
ON
UPDATE CASCADE
)ENGINE = InnoDB;

-- -----------------------------------------------------
-- Tabla usuarios
-- -----------------------------------------------------
CREATE TABLE
IF NOT EXISTS usuarios
(
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  email VARCHAR
(45) NOT NULL UNIQUE,
  usuario VARCHAR
(45) UNIQUE,
  password VARCHAR
(255) NOT NULL,

  PRIMARY KEY
(id)
)ENGINE = InnoDB;

-- INSERTS

-- CATEGORÍAS

INSERT INTO categorias
    (nombre)
VALUES
    -- 1:
    ('Celta'),
    -- 2:
    ('China'),
    -- 3:    
    ('Griega'),
    -- 4:
    ('Nórdica'),
    -- 5:
    ('Japonesa'),
    -- 6:
    ('Mesoamericana'),
    -- 7:
    ('Mesopotámica');

-- DRAGONES

INSERT INTO dragones
SET nombre
= 'Addanc',
descripcion = 'Tienen 4 patas cortas con garras, por este motivo muchos que los vieron los confundieron con cocodrilos. No tienen alas, y su cuerpo esta cubierto por escamas grandes y duras de color verde. Su cabeza es como la de un reptil, con ojos ávidos y boca llena de dientes poderosos, y una lengua bífida larga.',
categorias_id = 1;

INSERT INTO dragones
SET nombre
= 'Shenlong',
descripcion = 'Es un dragón espiritual chino que controla la lluvia y el viento. Este gigante volaba en el cielo y debido a su color azul que cambiaba constantemente era difícil de ver con claridad.',
categorias_id = 2;

INSERT INTO dragones
SET nombre
= 'Ladón',
descripcion = 'Ladón es descrito como un dragón de cien cabezas que custodiaba el Jardín de las Hespérides, el cual fue asesinado, según algunas versiones, por Atlas y según otras, Heracles. Cuando fue destripado, su sangre cayó al suelo del Jardín y de cada gota creció un árbol drago.',
categorias_id = 3;

INSERT INTO dragones
SET nombre
= 'Nidhogg',
descripcion = 'Nidhogg (Old Norse Níðhöggr, literalmente "el atacante de la maldición" o "el que golpea con malicia") es la primera de varias serpientes o dragones que viven bajo el árbol mundial Yggdrasil y se comen sus raíces. Las acciones de Nidhogg están destinadas a devolver el cosmos al caos, y él y su cohorte de reptiles pueden por tanto clasificarse entre los gigantes (o, como se les llamaba en tiempos precristianos, los "devoradores").',
categorias_id = 4;

INSERT INTO dragones
SET nombre
= 'Yamata no Orochi',
descripcion = 'Yamata no Orochi es el dragón mitológico de las 8 cabezas. Forma parte de las leyendas de Japón, una de las culturas que más mitifica a esos seres fantásticos. La leyenda habla de una época en la que humanos, bestias y dioses vivían juntos en la tierra. Los dioses eran seres benévolos que ayudaban a los humanos, y estos a cambio les ofrecían su admiración y lealtad. Las bestias vivían a su aire, sin buscar problemas. Todo esto cambio por culpa de la guerra entre el dios Izanagi y su esposa Izanami. Desde ese momento la vida tal y como hasta entonces se había conocido, desapareció.',
categorias_id = 5;

INSERT INTO dragones
SET nombre
= 'Quetzalcóatl',
descripcion = 'Considerado como «la Serpiente Emplumada», la cual es una deidad que representa la dualidad inherente a la condición humana: la «serpiente» es cuerpo físico con sus limitaciones y las «plumas» son los principios espirituales. Es uno de los más importantes dioses de la cultura mesoamericana, a veces considerado la principal divinidad del panteón mexica. Dios de la vida, la luz, la fertilidad, la civilización y el conocimiento. En ocasiones, también señor de los vientos y regidor del Oeste.',
categorias_id = 6;

INSERT INTO dragones
SET nombre
= 'Anzû',
descripcion = 'Este dios sumerio está dentro de las leyendas de los Anunnakis, consideradas una de las historias más enigmáticas y apasionantes de toda la humanidad. Y esto es debido a que las teorías apuntan a que estos seres mitológicos provenían del espacio exterior, es decir que eran extraterrestres que llegaron a la Tierra para colonizarla. No está muy claro que fuera un dragón, de hecho muchas veces se cataloga a esta criatura como un dinosaurio por su aspecto y la época en la que vivió. Su aspecto de pájaro gigante con garras, alas poderosas y brillantes, y cabeza de león; unido al hecho de que respirara fuego, le da cierto parecido a uno de estos mitológicos seres.',
categorias_id = 7;