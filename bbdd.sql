DROP DATABASE IF EXISTS dragones;
CREATE DATABASE
IF NOT EXISTS dragones;
USE dragones;

-- -----------------------------------------------------
-- Tabla categorias
-- -----------------------------------------------------
CREATE TABLE
IF NOT EXISTS categorias
(id INT UNSIGNED NOT NULL AUTO_INCREMENT,
nombre VARCHAR
(45) NOT NULL,
PRIMARY KEY
(id)
)ENGINE = InnoDB;

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
categorias_id INT UNSIGNED,

PRIMARY KEY
(id),

FOREIGN KEY
(categorias_id) REFERENCES categorias
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
    ('Mesopotámica'),
    -- 8:
    ('Babilónica'),
    -- 9:
    ('Vietnamita'),
    -- 10:
    ('Filipina'),
    -- 11:
    ('Coreana');

-- DRAGONES

INSERT INTO dragones
SET nombre
= 'Addanc',
descripcion = 'Tienen 4 patas cortas con garras, por este motivo muchos que los vieron los confundieron con cocodrilos. No tienen alas, y su cuerpo esta cubierto por escamas grandes y duras de color verde. Su cabeza es como la de un reptil, con ojos ávidos y boca llena de dientes poderosos, y una lengua bífida larga.',

imagen = "addanc_2.jpg",

categorias_id = 1;

INSERT INTO dragones
SET nombre
= 'Shenlong',
descripcion = 'Es un dragón espiritual chino que controla la lluvia y el viento. Este gigante volaba en el cielo y debido a su color azul que cambiaba constantemente era difícil de ver con claridad.',

imagen = "shenlong_2.jpg",

categorias_id = 2;

INSERT INTO dragones
SET nombre
= 'Ladón',
descripcion = 'Ladón es descrito como un dragón de cien cabezas que custodiaba el Jardín de las Hespérides, el cual fue asesinado, según algunas versiones, por Atlas y según otras, Heracles. Cuando fue destripado, su sangre cayó al suelo del Jardín y de cada gota creció un árbol drago.',

imagen = "ladon_2.jpg",

categorias_id = 3;

INSERT INTO dragones
SET nombre
= 'Nidhogg',
descripcion = 'Nidhogg (Old Norse Níðhöggr, literalmente "el atacante de la maldición" o "el que golpea con malicia") es la primera de varias serpientes o dragones que viven bajo el árbol mundial Yggdrasil y se comen sus raíces. Las acciones de Nidhogg están destinadas a devolver el cosmos al caos, y él y su cohorte de reptiles pueden por tanto clasificarse entre los gigantes (o, como se les llamaba en tiempos precristianos, los "devoradores").',

imagen = "nidhogg_2.jpg",

categorias_id = 4;

INSERT INTO dragones
SET nombre
= 'Yamata no Orochi',
descripcion = 'Yamata no Orochi es el dragón mitológico de las 8 cabezas. Forma parte de las leyendas de Japón, una de las culturas que más mitifica a esos seres fantásticos. La leyenda habla de una época en la que humanos, bestias y dioses vivían juntos en la tierra. Los dioses eran seres benévolos que ayudaban a los humanos, y estos a cambio les ofrecían su admiración y lealtad. Las bestias vivían a su aire, sin buscar problemas. Todo esto cambio por culpa de la guerra entre el dios Izanagi y su esposa Izanami. Desde ese momento la vida tal y como hasta entonces se había conocido, desapareció.',

imagen = "yamata_2.jpg",

categorias_id = 5;

INSERT INTO dragones
SET nombre
= 'Quetzalcóatl',
descripcion = 'Considerado como «la Serpiente Emplumada», la cual es una deidad que representa la dualidad inherente a la condición humana: la «serpiente» es cuerpo físico con sus limitaciones y las «plumas» son los principios espirituales. Es uno de los más importantes dioses de la cultura mesoamericana, a veces considerado la principal divinidad del panteón mexica. Dios de la vida, la luz, la fertilidad, la civilización y el conocimiento. En ocasiones, también señor de los vientos y regidor del Oeste.',

imagen = "quetzalcoatl_2.jpg",

categorias_id = 6;

INSERT INTO dragones
SET nombre
= 'Anzû',
descripcion = 'Este dios sumerio está dentro de las leyendas de los Anunnakis, consideradas una de las historias más enigmáticas y apasionantes de toda la humanidad. Y esto es debido a que las teorías apuntan a que estos seres mitológicos provenían del espacio exterior, es decir que eran extraterrestres que llegaron a la Tierra para colonizarla. No está muy claro que fuera un dragón, de hecho muchas veces se cataloga a esta criatura como un dinosaurio por su aspecto y la época en la que vivió. Su aspecto de pájaro gigante con garras, alas poderosas y brillantes, y cabeza de león; unido al hecho de que respirara fuego, le da cierto parecido a uno de estos mitológicos seres.',

imagen = "anzu_2.jpg",

categorias_id = 7;

INSERT INTO dragones
SET nombre
= 'Mushussu',
    descripcion = 'Se parece a un dragón con el cuerpo recubierto de escamas, las patas delanteras de león y las traseras con garras de águila. También tiene un cuello largo y una cola, cabeza con cuernos, una lengua como de serpiente y una cresta.
Fue símbolo de diferentes divinidades: al principio fue asociado al dios Ninazu, que era venerado en Ešnunna, luego se asoció al dios Tishpak.',

    imagen = "mushussu.jpg",

    categorias_id = 6;

INSERT INTO dragones
SET nombre
= 'Watatsumi',
    descripcion = 'Fue creado cuando Izanagi se lavó en el mar, tras volver de la Tierra de la Oscuridad. Es el dominador de los peces y de todos los seres vivientes del mar y además es quien controla las mareas. Tiene el poder de controlar cualquier criatura que nade en el mar y puede mover las aguas del océano a su antojo. En su forma verdadera es un dragón serpiente de color verde, pero se encuentra igualmente cómodo tomando la forma de un hombre viejo. Watatsumi vive en un gran palacio en el fondo del mar.',

    imagen = "watatsumi.jpg",

    categorias_id = 5;

INSERT INTO dragones
SET nombre
= 'Toyotama-hime',
    descripcion = 'Es la princesa dragón de los mares. Es la hija de Ryujin, el Dios Dragón de los mares. Ella está casada con el Dios Hoori, hijo de Konohana y Ninigi. Otohime es vista como una joven de una belleza increíble, pero cuando está transformada en dragón, pierde su hermosura. Ella anda siempre con un traje que está permanentemente húmedo.',

    imagen = "toyotama.jpg",

    categorias_id = 5;

INSERT INTO dragones
SET nombre
= 'Jörmungandr',
    descripcion = 'Jörmungandr, también conocido como la Serpiente de Midgard, es el hijo medio de un gigante y Loki, dios del fuego y el caos. Su antitesis está representada por Thor , el dios del trueno y el relampago, protector de la humanidad. La gente lo llamaba la Serpiente de Midgard cuyo cuerpo rodeaba todo el Midgard con su cola en la boca. En realidad, la apariencia de Jormungandr se suponía que era la combinación de dragón y serpiente.Según las leyendas, Odín tomó a Jormungand y lo arrojó al gran océano que rodea a Midgard, nuestro mundo.',

    imagen = "jormungandr.jpg",

    categorias_id = 4;

INSERT INTO dragones
SET nombre
= 'Fafnir',
    descripcion = 'Fafnir era un enano, hijo del mago Hreidman y hermano de Otr y Reginn. Se dice que Fáfnir, fue maldecido en algún momento por un anillo mágico creado por un enano mago llamado Andvari que lo convirtió en un dragón. Posteriormente, es asesinado por Sigurd, un legendario héroe nórdico.',

    imagen = "fafnir.jpg",

    categorias_id = 4;

INSERT INTO dragones
SET nombre
= 'Typhoon',
    descripcion = 'Tifón (o Typhoeus) era el hijo de Gaia y Tártaro. Era un dragón gigante con cien cabezas, alas emplumadas y escupía llamas y piedras. Se casó con Echidna, de quien tuvo como hijos a Cerbero, Otro, Quimera e Hidra. Su madre lo obligó a luchar con Zeus porque éste había matado a sus hijos, los Titanes. El dragón logró aplastar a Zeus quitándole los tendones para evitar que se moviera y se los confió a su hermana Delfine. El dios Pan logró recuperar los tendones y Zeus derrotó a Tifón encerrándolo bajo una montaña, pero el dragón no estaba muerto y todavía escupe fuego y piedras. La montaña bajo la que aún vive el tifón es el Etna.',

    imagen = "typhoon.jpg",

    categorias_id = 3;

INSERT INTO dragones
SET nombre
= 'Kampe',
    descripcion = 'Una dragona con cabeza de mujer, cuerpo de escorpión y de cola de pez. Fue colocada por el titán Cronos para custodiar el Tártaro y proteger al Ecantonchiri y al Cíclope. Ella fue asesinada por el dios Zeus para liberar a estos últimos y hacerlos luchar en la batalla contra los titanes.',

    imagen = "kampe.jpg",

    categorias_id = 3;

INSERT INTO dragones
SET nombre
= 'Pitón',
    descripcion = 'Pitón era un dragón hijo de Gea producido del barro de la tierra después del Diluvio Universal. Guardó el Oráculo de Delfos en nombre de su madre junto con Delfine. El dios Apolo lo mató porque Python había perseguido a Leto, la madre del dios.',

    imagen = "piton.jpg",

    categorias_id = 3;

INSERT INTO dragones
SET nombre
= 'Hydra',
    descripcion = 'Hydra es un dragón en forma de serpiente con muchas cabezas, hija de Tifón y Echidna. Tenía nueve cabezas, la central de las cuales era inmortal. En algunas versiones se habla de cincuenta cabezas de oro. Cualquier cabeza que fuera cortada era reemplazada por otras dos. El aliento y la sangre de la Hidra eran muy venenosos y podían escupir fuego. Vivía en el pantano de Lerna, en Argólida, donde los asesinos venían a purificarse.',

    imagen = "hydra.jpg",

    categorias_id = 3;

INSERT INTO dragones
SET nombre
= 'Sirrush',
    descripcion = 'Sirrush era un dragón sometido por Marduk, que se puso a sus pies y se convirtió en el símbolo de la cabeza de los dioses babilónicos. En las paredes de los edificios de la antigua Babilonia se encontró un fresco que representaba a esta criatura. A diferencia de muchos otros animales mitológicos, la imagen no fue pintada de diferentes maneras a lo largo del tiempo y mantuvo la misma forma a través de los siglos.',

    imagen = "sirrush.jpg",

    categorias_id = 8;

INSERT INTO dragones
SET nombre
= 'Yong',
    descripcion = 'Es un Dragón de los Cielos, prácticamente idéntico al Lóng chino. Al igual que el Lóng, el Yong y otros dragones coreanos, suelen atribuirse al agua y al clima. En coreano puro también se le conoce como Mireu.',

    imagen = "yong.jpg",

    categorias_id = 11;

INSERT INTO dragones
SET nombre
= 'Immogi',
    descripcion = 'Es un dragón de los océanos, usualmente es comparado con las serpientes marinas. La leyenda de Imoogi cuenta que el dios del sol le dio al Imoogi sus poderes a través de una chica humana, que se convertiría en Imoogi el día de su cumpleaños 17. La leyenda también dice que una marca en forma de Dragón puede verse en el hombro de la niña, revelando su verdadera identidad como Imoogi en forma humana.',

    imagen = "immogi.jpg",

    categorias_id = 11;

INSERT INTO dragones
SET nombre
= 'Bakunawa',
    descripcion = 'El Bakunawa aparece como una serpiente gigante que vive en el mar. Los nativos del pasado creían que los Bakunawa causaban eclipses de sol y luna. También se dijo que durante ciertos períodos del año, los Bakunawa emergieron del océano para tragarse toda la luna.',

    imagen = "bakunawa.jpg",

    categorias_id = 10;

INSERT INTO dragones
SET nombre
= 'Rong',
    descripcion = 'Los cuerpos de estos dragones están doblados en forma de doce crestas de olas, para simbolizar los meses del año. Pueden cambiar el clima y son responsables de los cultivos. A lo largo de toda la espalda del Dragón hay pequeñas escamas ininterrumpidas, la cabeza tiene una crin gruesa, bigote, ojos prominentes, una cresta en la nariz pero no tiene cuernos. La mandíbula es ancha y abierta, con una lengua larga y delgada.',

    imagen = "rong.jpg",

    categorias_id = 9;

INSERT INTO dragones
SET nombre
= 'Tianlong',
    descripcion = 'Es un dragón volador en la mitología china, una estrella en la astrología china, y un nombre propio.',

    imagen = "tianlong.jpg",

    categorias_id = 2;

INSERT INTO dragones
SET nombre
= 'Yinglong',
    descripcion = 'Es un dragón que se cree que había sido un poderoso sirviente de Huang Di, el Emperador Amarillo, y que fue inmortalizado posteriormente en forma de dragón. Una leyenda dice que Yinglong ayudó a un hombre llamado Yu a evitar el desbordamiento del río Amarillo cavando largos canales con su cola.',

    imagen = "yinlong.jpg",

    categorias_id = 2;