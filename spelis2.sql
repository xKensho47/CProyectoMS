-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-11-2023 a las 15:12:20
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `spelis2`
--
CREATE DATABASE spelis2;
USE spelis2;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actor`
--
CREATE TABLE `actor` (
  `id_actor` int(8) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `actor`
--

INSERT INTO `actor` (`id_actor`, `nombre`, `apellido`) VALUES
(4, 'Hitoshi', 'Takagi'),
(6, 'Noriko', 'Hidaka'),
(7, 'Sumi', 'Shimamoto'),
(8, 'Naoki', 'Tatsuta'),
(9, 'Jamie', 'Foxx'),
(10, 'Chirstoph', 'Waltz'),
(11, 'Leonardo', 'DiCaprio'),
(12, 'Margot', 'Robbie'),
(13, 'Ryan', 'Gosling'),
(14, 'America', 'Ferrera'),
(15, 'Will', 'Ferrell'),
(16, 'Kate', 'McKinnon'),
(19, 'Uma', 'Thurman'),
(20, 'Lucy', 'Liu'),
(21, 'Michael', 'Bowel'),
(22, 'Youji', 'Matsuda'),
(23, 'Yuriko', 'Ishida'),
(24, 'Yuko', 'Tanaka'),
(25, 'Carey', 'Mulligan'),
(26, 'Bryan', 'Cranston'),
(27, 'Oscar', 'Isaac'),
(28, 'Edward', 'Norton'),
(29, 'Helena', 'Bonham Carter'),
(30, 'Brad', 'Pitt'),
(31, 'Johnny', 'Depp'),
(32, 'Alan', 'Rickman'),
(33, 'Robin', 'Williams'),
(34, 'Ethan', 'Hawke'),
(35, 'Gale', 'Hansen'),
(36, 'Joaquin', 'Phoenix'),
(37, 'Robert', 'De Niro'),
(38, 'Zazie', 'Beetz'),
(39, 'Rami', 'Malek'),
(40, 'Gwilym', 'Lee'),
(41, 'Ben', 'Hardy'),
(42, 'Joseph', 'Mazzello'),
(43, 'Anya', 'Taylor Joy'),
(44, 'Chadwick', 'Boseman'),
(45, 'Michael Baraki', 'Jordan'),
(46, 'Michael Bakari', 'Jordan'),
(47, 'Lupita', 'Nyongo'),
(49, 'Logan', 'Grove'),
(50, 'Kyla', 'Kowalewski'),
(51, ' Kwesi', 'Boakye'),
(52, 'Meagan', 'Moore'),
(53, 'Tara', 'Strong'),
(54, 'Paul', 'Eiding'),
(55, 'Cathy', 'Cavadini'),
(56, 'Elizabeth', 'Daily'),
(57, 'Tom', 'Kenny'),
(58, 'Jeremy', 'Shada'),
(59, 'John', 'DiMaggio'),
(60, 'Hynden', 'Walch'),
(61, 'Adam', 'Sandler'),
(62, 'Andy', 'Samberg'),
(63, 'Selena', 'Gomez'),
(64, 'Bill', 'Kopp'),
(65, 'Jeff', 'Bennett'),
(66, 'Jay', 'Baruchel'),
(67, 'Gerard', 'Butler'),
(68, 'Jason', 'Lee'),
(69, 'Justin', 'Long'),
(70, 'David', 'Cross'),
(71, 'Cate', 'Blanchett'),
(72, 'Micah', 'Abbey'),
(73, 'Shamon', 'Brown Jr.'),
(74, 'Nicolas', 'Cantu'),
(75, 'Brady', 'Noon'),
(76, 'Mike', 'Myers'),
(77, 'Eddie', 'Murphy'),
(78, 'Cameron', 'Diaz'),
(79, 'Antonio', 'Banderas'),
(80, 'Elijah', 'Wood'),
(81, 'Sean', 'Astin'),
(82, 'Ian', 'McKellen'),
(83, 'Viggo', 'Mortensen'),
(84, 'Salma', 'Hayek Pinault'),
(85, 'Harvey', 'Guillén'),
(86, 'Wagner', 'Moura'),
(87, 'Daniel', 'Radcliffe'),
(88, 'Rupert', 'Grint'),
(89, 'Emma', 'Watson'),
(90, 'Harrison', 'Ford'),
(91, 'Karen', 'Allen'),
(92, 'Paul', 'Freeman'),
(93, 'Cillian', 'Murphy'),
(94, 'Emily', 'Blunt'),
(95, 'Matt', 'Damon'),
(96, 'Robert', 'Downey Jr.'),
(97, 'Mads', 'Mikkelsen'),
(98, 'Thomas', 'Vinterberg'),
(99, 'Annika', 'Wedderkopp'),
(100, 'Song', 'Kang-ho'),
(101, 'Choi', 'Woo-shik'),
(102, 'Park', 'So-dam'),
(103, 'Jang', 'Hye-jin'),
(104, 'Matthew', 'McConaughey'),
(105, 'Anne', 'Hathaway'),
(106, 'Jessica', 'Chastain'),
(107, 'Sam', 'Worthington'),
(108, 'Lily', 'Rabe'),
(109, 'Stephen', 'Tobolowsky'),
(110, 'Adjoa', 'Andoh'),
(111, 'Mark', 'Ruffalo'),
(112, 'Ben', 'Kingsley'),
(113, 'Junko', 'Iwao'),
(114, 'Rica', 'Matsumoto'),
(115, 'Shiho', 'Niiyama'),
(116, 'Megumi', 'Hayashibara'),
(117, 'Tohru', 'Emori'),
(118, 'Katsunosuke', 'Hori'),
(119, 'Toni', 'Collette'),
(120, 'Alex', 'Wolff'),
(121, 'Milly', 'Shapiro'),
(122, 'Mitchel', 'Musso'),
(123, 'Sam', 'Lerner'),
(124, 'Spencer', 'Locke'),
(125, 'Steve', 'Buscemi'),
(126, 'Jessica', 'Biel'),
(127, 'Jonathan', 'Tucker'),
(128, 'Andrew', 'Bryniarski'),
(129, 'Perdita', 'Weeks'),
(130, 'Ben', 'Feldman'),
(131, 'Edwin', 'Hodge'),
(132, 'Olivia', 'Cooke'),
(133, 'Ana', 'Coto'),
(134, 'Matthew', 'Settle'),
(135, 'Melissa', 'Barrera'),
(136, 'Jenna', 'Ortega'),
(137, 'Mason', 'Gooding'),
(138, 'Jodie', 'Foster'),
(139, 'Anthony', 'Hopkins'),
(140, 'Scott', 'Glenn'),
(141, 'Chris', 'Pratt'),
(142, 'Zoe', 'Saldaña'),
(143, 'Dave', 'Bautista'),
(144, 'Vin', 'Diesel'),
(145, 'Bradley', 'Cooper'),
(146, 'Michael', 'Cera'),
(147, 'Mary Elizabeth', 'Winstead'),
(148, 'Ellen', 'Wong'),
(149, 'Kieran', 'Culkin'),
(150, 'Ralph', 'Fiennes'),
(151, 'F. Murray', 'Abraham'),
(152, 'Tony', 'Revolori'),
(153, 'Jonah', 'Hill'),
(154, 'John', 'Travolta'),
(155, 'Samuel L.', 'Jackson'),
(156, 'Marlon', 'Brando'),
(157, 'Al', 'Pacino'),
(158, 'James', 'Caan');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `director`
--

CREATE TABLE `director` (
  `id_director` int(8) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `director`
--

INSERT INTO `director` (`id_director`, `nombre`, `apellido`) VALUES
(17, 'Hayao', 'Miyazaki'),
(18, 'Quentin', 'Tarantino'),
(22, 'Greta', 'Gerwig'),
(26, 'Nicolas', 'Winding Refn'),
(27, 'David', 'Fincher'),
(28, 'Tim', 'Burton'),
(29, 'Peter', 'Weir'),
(30, 'Todd', 'Phillips'),
(31, 'Anthony', 'McCarten'),
(32, 'George', 'Lucas'),
(33, 'Ryan', 'Coogler'),
(35, 'Mic', 'Graves'),
(36, 'Joe', 'Kelly'),
(37, 'Duncan', 'Rouleau'),
(38, 'Steven T.', 'Seagle'),
(39, 'Joe', 'Casey'),
(40, 'Craig', 'McCracken'),
(41, 'Pendleton', 'Ward'),
(42, 'Genndy', 'Tartakovsky'),
(43, 'Bill', 'Kopp'),
(44, 'Dean', 'DeBlois'),
(45, 'Tim', 'Hill'),
(46, 'Jeff', 'Rowe'),
(47, 'Andrew', 'Adamson'),
(48, 'Vicky', 'Jenson'),
(49, 'Conrad', 'Vernon'),
(50, 'Chris', 'Miller'),
(51, 'Peter', 'Jackson'),
(52, 'Joel', 'Crawford'),
(53, 'Chris', 'Columbus'),
(54, 'Steven', 'Spielberg'),
(55, 'Christopher', 'Nolan'),
(56, 'Thomas', 'Vinterberg'),
(57, 'Bong', 'Joon-ho'),
(58, 'Brad', 'Anderson'),
(59, 'Martin', 'Scorsese'),
(60, 'Satoshi', 'Kon'),
(61, 'Ari', 'Aster'),
(62, 'Gil', 'Kenan'),
(63, 'Marcus', 'Nispel'),
(64, 'John Erick', 'Dowdle'),
(65, 'Stiles', 'White'),
(66, 'Tyler', 'Gillett'),
(67, 'Jonathan', 'Demme'),
(68, 'James', 'Gunn'),
(69, 'Edgar', 'Wright'),
(70, 'Wes', 'Anderson'),
(71, 'Francis', 'Ford Coppola');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genero`
--

CREATE TABLE `genero` (
  `id_genero` int(8) NOT NULL,
  `nombre_genero` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `genero`
--

INSERT INTO `genero` (`id_genero`, `nombre_genero`) VALUES
(2, 'Kids'),
(3, 'Infantil'),
(4, 'Fantasía'),
(5, 'Dramático'),
(6, 'Wéstern'),
(7, 'Familiar'),
(8, 'Comedia'),
(9, 'Sátira'),
(11, 'Acción'),
(12, 'Thriller'),
(13, 'Aventura'),
(14, 'Suspenso'),
(15, 'Crimen'),
(16, 'Terror'),
(17, 'Misterio'),
(18, 'Historia Real'),
(19, 'Musical'),
(20, 'Documental'),
(21, 'Super Héroes'),
(22, 'Ciencia Ficción'),
(24, 'Futurista'),
(25, 'Épicas'),
(26, 'Religioso'),
(27, 'Policial'),
(28, 'Históricas'),
(29, 'Gangsters'),
(30, 'Deportivas'),
(32, 'Bélicas'),
(34, 'Juveniles'),
(37, 'Animación');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peli`
--

CREATE TABLE `peli` (
  `id_peli` int(8) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `path_poster` varchar(255) NOT NULL,
  `estreno` date NOT NULL,
  `descripcion` text NOT NULL,
  `duracion` int(4) DEFAULT NULL,
  `calificacion` float DEFAULT NULL,
  `cant_review` int(10) DEFAULT NULL,
  `cant_estrellas` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `peli` (`id_peli`, `titulo`, `path_poster`, `estreno`, `descripcion`, `duracion`, `calificacion`, `cant_review`, `cant_estrellas`) VALUES
(48, 'Mi Vecino Totoro', 'posters/20230928200113to.jpg', '1988-04-16', 'Una familia japonesa se traslada al campo. Las dos hijas se encuentran con un espíritu llamado Totoro, que habita en el bosque. Junto a él, comparten mágicas aventuras.',86, 6, 3, 18),
(49, 'Django Desencadenado', 'posters/20230928200128dj.jpg', '2013-01-31', 'Acompañado por un cazarrecompensas alemán, un esclavo liberado, Django viaja a través de Estados Unidos para liberar a su esposa del sádico propietario de una plantación.', 165, 0, 0, 0),
(52, 'Barbie', 'posters/20230930155146barbi.jpg', '2023-07-20', 'Barbie lleva una vida ideal en Barbieland, allí todo es perfecto, con fiestas llenas de música y color, todos los días son el mejor día. Claro que Barbie se hace algunas preguntas, cuestiones bastante incómodas que no encajan con el mundo idílico en el que ella y las demás Barbies viven. Cuando Barbie se dé cuenta de que es capaz de apoyar los talones en el suelo, y tener los pies planos, decidirá calzarse unos zapatos sin tacones y viajar hasta el mundo real.', 114, 0, 0, 0),
(73, 'Kill Bill', 'posters/20231003224718kb.jpg', '2003-11-27', 'El día de su boda, una asesina profesional sufre el ataque de algunos miembros de su propia banda, que obedecen las órdenes de Bill, el jefe de la organización criminal. Logra sobrevivir al ataque, aunque queda en coma. Cuatro años después despierta dominada por un gran deseo de venganza. ', 110, 0, 0, 0),
(74, 'La Princesa Mononoke', 'posters/20231003232650mo.jpg', '1997-07-12', 'Tras sufrir el ataque de un monstruoso jabalí maldito, el joven Ashitaka emprende el camino en busca de la cura que detenga la infección. Mientras, los humanos están acabando con los bosques y los dioses convertidos en temibles bestias hacen todo lo posible por protegerlo encabezados por Mononoke, una princesa guerrera. Ashikata deberá escoger bando y decidir si ayudar a los hombres o las deidades intentando detener su maldición.', 134, 0, 0, 0),
(75, 'Drive', 'posters/20231004005342dri.jpg', '2012-03-01', 'Durante el día, Driver trabaja en un taller y es conductor especialista de cine, pero, algunas noches de forma esporádica, trabaja como chófer para delincuentes. Shannon, su mentor y jefe, que conoce bien su talento al volante, le busca directores de cine y televisión o criminales que necesiten al mejor conductor para sus fugas, llevándose la correspondiente comisión. Pero el mundo de Driver cambia el día en que conoce a Irene, una guapa vecina que tiene un hijo pequeño y a su marido en la cárcel.', 100, 0, 0, 0),
(76, 'El Club de la Pelea', 'posters/20231003235405ec.jpg', '1999-11-04', 'Un joven sin ilusiones lucha contra su insomnio, consecuencia quizás de su hastío por su gris y rutinaria vida. En un viaje en avión conoce a Tyler Durden, un carismático vendedor de jabón que sostiene una filosofía muy particular: el perfeccionismo es cosa de gentes débiles; en cambio, la autodestrucción es lo único que hace que realmente la vida merezca la pena. Ambos deciden entonces formar un club secreto de lucha donde descargar sus frustaciones y su ira que tendrá un éxito arrollador.', 139, 0, 0, 0),
(77, 'Sweeney Todd: El barbero diabólico de la calle Fleet', 'posters/20231004005437sw.jpg', '2008-01-25', 'Benjamin Barker, un hombre encarcelado 15 años injustamente en el otro lado del mundo, que escapa y vuelve a Londres con la promesa de vengarse, junto a su obsesiva y devota cómplice, la Sra. Nellie Lovett. Adoptando el disfraz de Sweeney Todd, Barker regresa a su antigua barbería encima del local de empanadas de carne de la Sra. Lovett, y fija su mira en el juez Turpin que, con la ayuda de su vil secuaz Beadle Bamford, lo encarcelaron con una acusación falsa y así poder robarle a su esposa, Lucy, y a su hija bebé.', 117, 0, 0, 0),
(78, 'El Club de los Poetas Muetos', 'posters/20231004002321ecp.jpg', '1990-02-15', 'En un elitista y estricto colegio privado de Nueva Inglaterra, un grupo de alumnos descubrirá la poesía, el significado de \"Carpe Diem\" -aprovechar el momento- y la importancia de perseguir los sueños, gracias a un excéntrico profesor que despierta sus mentes por medio de métodos poco convencionales.', 128, 0, 0, 0),
(79, 'Joker', 'posters/20231004005315ej.jpg', '2019-10-03', 'Arthur Fleck es un hombre ignorado por la sociedad, cuya motivación en la vida es hacer reír. Pero una serie de trágicos acontecimientos le llevarán a ver el mundo de otra forma. Película basada en Joker, el popular personaje de DC Comics y archivillano de Batman, pero que en este film toma un cariz más realista y oscuro.', 122, 0, 0, 0),
(80, 'Bohemian Rhapsody', 'posters/20231004004942dh.jpg', '2018-11-01', 'Bohemian Rhapsody es una rotunda y sonora celebración de Queen, de su música y de su extraordinario cantante Freddie Mercury, que desafió estereotipos e hizo añicos tradiciones para convertirse en uno de los showmans más queridos del mundo. ', 134, 0, 0, 0),
(85, 'Pantera Negra', 'posters/20231020223942bp.jpg', '2018-02-15', 'Situada después de los eventos de Capitán América: Civil War, TChalla, hijo del fallecido rey TChaka, asciende al trono de Wakanda y se convierte en Pantera Negra, pero descubre que reinar su nación será un desafío para él, ya que no solo debe gobernar y proteger su país, sino también derrotar a un viejo enemigo del pasado, que amenaza a todo el mundo.', 134, 0, 0, 0),
(90, 'El asombroso mundo de Gumball', 'posters/20231031203045dMYY2XqsQvDEdTtPfykTEOUZngK.jpg', '2011-05-03', 'Las divertidas aventuras de Gumball y su peculiar familia en el idílico pueblecito de Elmore. Un papá conejo rosa de 1,95 metros, una madre que se gana la vida vendiendo arco iris, un gato azul muy torpe y una conejita con un cerebro superdotado componen la familia protagonista. No hay que olvidar a Darwin, un pez rojo que se convirtió en miembro del clan el día en que le crecieron piernas y pulmones. Así es el asombroso mundo de Gumball.', 0, NULL, NULL, NULL),
(91, 'Ben 10', 'posters/20231031203927eogRp6oAPK0SEvQmCrQ78LTlSdp.jpg', '2005-12-27', 'Ben 10 cuenta las aventuras de Ben Tennyson, un niño normal de diez años que descubre en sus vacaciones de verano un extraño reloj extraterrestre dentro de un meteorito que chocó contra la Tierra. Ben pronto se da cuenta de que este reloj no es un aparato cualquiera, sino el artefacto alienígena mas poderoso del Universo, el Omnitrix. Este reloj le permite transformarse en diez seres extraterrestres distintos sin perder su personalidad, aunque eventualmente sería capaz de desbloquear nuevos alienígenas. Ahora, con la ayuda del Omnitrix, Ben, junto a su prima Gwen y a su abuelo Max combatirán un sinfín de villanos.', NULL, NULL, NULL, NULL),
(92, 'Las Chicas Superpoderosas', 'posters/20231031204708468mmhMd21pY4Yx0S0woqeEcxtL.jpg', '1998-11-18', 'El profesor Utonium es un ingeniero genético que siempre está experimentando. Una noche decide hacer realidad su sueño más anhelado: crear una niña perfecta. El resultado es espectacular: en vez de una niña ha creado a tres superheroínas.', 0, NULL, NULL, NULL),
(93, 'Hora de Aventura', 'posters/20231031205125vpnV0g2VOounP0kHNi86oBPceMY.jpg', '2010-04-05', 'Finn un chico de doce años, fue encontrado en el bosque siendo un bebé por un perro de la familia, y su mejor amigo y hermano adoptivo es Jake, un perro de 28 años de edad, con poderes mágicos. Son aventureros que viven en \"La Tierra de Ooo\", un entorno lleno de personajes surrealistas. Algunas aventuras típicas del dúo son salvar princesas, luchar contra monstruos, la exploración de mazmorras o ayudar a los necesitados.', 0, NULL, NULL, NULL),
(94, 'Hotel Transilvania', 'posters/20231031210125eJGvzGrsfe2sqTUPv5IwLWXjVuR.jpg', '2012-10-04', 'Drácula regenta un hotel en el que se alojan personajes como Frankenstein, la Momia, el Hombre Invisible, hombres-lobo... El problema del conde es que tiene una hija de espíritu aventurero a la que le resulta difícil controlar. El conflicto surge cuando se aloja en el hotel un ser humano que se siente atraído por la hija del dueño.', 91, NULL, NULL, NULL),
(95, 'Tom y Jerry: Rápidos y Furiosos', 'posters/20231031210840adfvcdfv.jpg', '2022-01-24', 'Tom y Jerry, el dúo más famoso de la historia se ha quedado sin hogar. La simpática pareja decide inscribirse para participar en la Fabulosa Super-Carrera, un reality show de la TV donde el gran premio es una enorme mansión. Las travesuras de Tom y Jerry son la gran sensación del concurso y las carreras son cada vez más y más divertidas.', 75, NULL, NULL, NULL),
(96, 'Cómo entrenar a tu dragón', 'posters/20231031211241jjGyBXyhXs2aofZDVOf1zguTrvJ.jpg', '2010-03-25', 'la historia de Hipo, un vikingo adolescente que no encaja exactamente en la antiquísima reputación de su tribu como cazadores de dragones. El mundo de Hipo se trastoca al encontrar a un dragón que le desafía a él y a sus compañeros vikingos, a ver el mundo desde un punto de vista totalmente diferente.', 98, NULL, NULL, NULL),
(97, 'Alvin y las ardillas', 'posters/20231031211814jkgbf.jpg', '2007-12-16', 'La vida de Dave Seville, un compositor sin éxito, es monótona y frustrante, hasta que encuentra con tres ardillas (Alvin, Simon y Theodore) que vienen del bosque. Dave las expulsa de su casa al no encontrar natural que las ardillas hablen, pero cambia de opinión cuando las oye cantar y los invita a cantar sus letras. Dave acude a su discográfica para mostrar las ardillas a su jefe, pero este las engaña para que se queden con él.', 90, NULL, NULL, NULL),
(98, 'Cómo entrenar a tu dragón 2 ', 'posters/20231031212158dv.jpg', '2014-06-20', 'Han pasado cinco años desde que Hipo empezó a entrenar a su dragón, rompiendo la tradición vikinga de cazarlos. Astrid y el resto de la pandilla han conseguido difundir en la isla un nuevo deporte: las carreras de dragones. Mientras realizan una carrera, atraviesan los cielos llegando a territorios inhóspitos, donde nadie antes ha estado. Durante un viaje descubren una cueva cubierta de hielo que resulta ser el refugio de cientos de dragones salvajes, a los que cuida un misterioso guardián. Hipo y los suyos se unen al guardián para proteger a los dragones de las fuerzas malignas que quieren acabar con ellos.', 105, NULL, NULL, NULL),
(99, 'Cómo entrenar a tu dragón 3', 'posters/20231031212436casc.jpg', '2019-01-31', 'Lo que comenzó como la inesperada amistad entre un joven vikingo y un temible dragón, Furia Nocturna, se ha convertido en una épica trilogía que ha recorrido sus vidas. En esta nueva entrega, Hipo y Desdentao descubrirán finalmente su verdadero destino: para uno, gobernar Isla Mema junto a Astrid; para el otro, ser el líder de su especie. Pero, por el camino, deberán poner a prueba los lazos que los unen, plantando cara a la mayor amenaza que jamás haya afrontado... y a la aparición de una Furia Nocturna hembra.', 110, NULL, NULL, NULL),
(100, 'Las Tortugas Ninja: Caos mutante', 'posters/20231031212804asxs.jpg', '2023-08-17', 'Después de pasar años apartados del mundo humano, los hermanos Tortuga se proponen ganarse el corazón de los habitantes de Nueva York y que les acepten como quinceañeros normales, llevando a cabo actos heroicos. Su nueva amiga April O\'Neil les ayuda a enfrentarse a un misterioso sindicato del crimen, pero pronto se ven superados ante el ataque de un ejército de mutantes que se abalanza sobre ellos.', 100, NULL, NULL, NULL),
(101, 'Shrek', 'posters/20231031213318sdfs.jpg', '2001-07-19', 'Hace mucho, mucho tiempo, en una lejanísima ciénaga vivía un intratable ogro llamado Shrek. Pero de repente, un día, su absoluta soledad se ve interrumpida por una invasión de sorprendentes personajes de cuento. Para conseguir salvar su terreno, y de paso a sí mismo, Shrek hace un pacto con Lord Farquaad y emprende viaje para conseguir que la preciosa princesa Fiona.', 92, NULL, NULL, NULL),
(102, 'Shrek 2', 'posters/20231031213635dsd.jpg', '2004-06-17', 'Cuando Shrek y la princesa Fiona regresan de su luna de miel, los padres de ella los invitan a visitar el reino de Muy Muy Lejano para celebrar la boda. Para Shrek, al que nunca abandona su fiel amigo Asno, esto constituye un gran problema. Los padres de Fiona, por su parte, no esperaban que su yerno tuviera un aspecto semejante y, mucho menos, que su hija hubiera cambiado tanto. Todo esto trastoca los planes del rey respecto al futuro del reino. Pero entonces entran en escena la maquiavélica Hada Madrina, su arrogante hijo el Príncipe Encantador y un minino muy especial: el Gato con Botas, experto cazador de ogros.', 92, NULL, NULL, NULL),
(103, 'Shrek tercero', 'posters/20231031214006gcg.jpg', '2007-05-17', 'Shrek se casó con Fiona, pero lo que no tuvo en cuenta es que al casarse con una princesa... tarde o temprano uno termina siendo rey. Cuando su suegro, el Rey Harold, cae enfermo, Shrek se encuentra en riesgo de tener que abandonar su amado pantano por el trono. A menos claro que encuentre un heredero. Junto con Asno y el Gato con Botas, Shrek viaja para en busca del primo de Fiona, Arturo. Mientras, en Muy Muy Lejano, el Príncipe Encantador recluta un ejército de villanos de cuento para tomar el trono por la fuerza. Pero no cuentan con que Fiona y la Reina Lillian también han reunido su grupo de heroínas de cuento para hacerles frente...', 92, NULL, NULL, NULL),
(104, 'El Señor de los Anillos: El Retorno del Rey', 'posters/20231101121915es.jpg', '2004-01-01', 'Las fuerzas de Saruman han sido destruidas, y su fortaleza sitiada. Ha llegado el momento de que se decida el destino de la Tierra Media. En Gondor, el último reducto de los hombres, y del cual Aragorn tendrá que reclamar el trono para ocupar su puesto de rey. Mientras tanto, Frodo y Sam continuan su camino hacia Mordor, a la espera de que Sauron no repare en que dos pequeños Hobbits se acercan cada día más al final de su camino, el Monte del Destino.', 202, NULL, NULL, NULL),
(105, 'El señor de los anillos: La comunidad del anillo', 'posters/20231101122915esd.jpg', '2002-01-31', 'En la Tierra Media, el Señor Oscuro Saurón creó los Grandes Anillos de Poder, forjados por los herreros Elfos. Tres para los reyes Elfos, siete para los Señores Enanos, y nueve para los Hombres Mortales. Secretamente, Saurón también forjó un anillo maestro, el Anillo Único, que contiene en sí el poder para esclavizar a toda la Tierra Media. Con la ayuda de un grupo de amigos y de valientes aliados, Frodo emprende un peligroso viaje con la misión de destruir el Anillo Único.', 179, NULL, NULL, NULL),
(106, 'El señor de los anillos: Las dos torres', 'posters/20231101123129esdl.jpg', '2002-12-18', 'La Compañía del Anillo se ha disuelto. El portador del anillo Frodo y su fiel amigo Sam se dirigen hacia Mordor para destruir el Anillo Único y acabar con el poder de Sauron. Mientras, y tras la dura batalla contra los orcos donde cayó Boromir, el hombre Aragorn, el elfo Legolas y el enano Gimli intentan rescatar a los medianos Merry y Pipin, secuestrados por los ogros de Mordor.', 180, NULL, NULL, NULL),
(107, 'El Gato con Botas: El último deseo ', 'posters/20231101123727ga.jpg', '2023-01-05', 'El Gato con Botas descubre que, debido a su pasión por la aventura, ha gastado ya 8 de sus 9 vidas. Por tanto, emprende un peligroso viaje en busca del legendario Último Deseo para solicitar que le restauren las vidas que ya perdió.', 103, NULL, NULL, NULL),
(108, 'Harry Potter y la piedra filosofal ', 'posters/20231101124438hpp.jpg', '2001-11-19', 'Harry Potter es un huérfano que vive con sus desagradables tíos, los Dursley, y su repelente primo Dudley. Se acerca su undécimo cumpleaños y tiene pocas esperanzas de recibir algún regalo, ya que nunca nadie se acuerda de él. Sin embargo, pocos días antes de su cumpleaños, una serie de misteriosas cartas dirigidas a él y escritas con una estridente tinta verde rompen la monotonía de su vida: Harry es un mago y sus padres también lo eran.', 152, NULL, NULL, NULL),
(109, 'Indiana Jones: En busca del arca perdida', 'posters/20231101124850ind.jpg', '1981-12-25', 'Año 1936. Indiana Jones es un profesor de arqueología, dispuesto a correr peligrosas aventuras con tal de conseguir valiosas reliquias históricas. Después de una infructuosa misión en Sudamérica, el gobierno estadounidense le encarga la búsqueda del Arca de la Alianza, donde se conservan las Tablas de la Ley que Dios entregó a Moisés. Según la leyenda, quien las posea tendrá un poder absoluto, razón por la cual también la buscan los nazis.', 115, 5, 1, 5),
(110, 'Oppenheimer', 'posters/20231101130431op.jpg', '2023-07-29', 'Película sobre el físico J. Robert Oppenheimer y su papel como desarrollador de la bomba atómica. Basada en el libro \'American Prometheus: The Triumph and Tragedy of J. Robert Oppenheimer\' de Kai Bird y Martin J. Sherwin.', 181, NULL, NULL, NULL),
(111, 'La caza', 'posters/20231101131014th.jpg', '2013-06-13', 'El mundo de un maestro de guardería se colapsa a su alrededor después de que una de sus estudiantes, que está enamorada de él, asegura que éste cometió un acto lascivo frente a ella. En ese momento, nadie le concede el beneficio de la duda y todo el pueblo comienza a despreciarlo y acosarlo.', 115, NULL, NULL, NULL),
(112, 'Parásitos', 'posters/20231101131628pa.jpg', '2020-01-23', 'Tanto Gi Taek como su familia están sin trabajo. Cuando su hijo mayor, Gi Woo, empieza a recibir clases particulares en casa de Park, las dos familias, que tienen mucho en común pese a pertenecer a dos mundos totalmente distintos, comienzan una interrelación de resultados imprevisibles.', 132, NULL, NULL, NULL),
(113, 'Interstellar', 'posters/20231101131945in.jpg', '2014-11-06', 'La humanidad nació en la Tierra. Nunca estuvo destinada a morir aquí. Narra las aventuras de un grupo de exploradores que hacen uso de un agujero de gusano recientemente descubierto para superar las limitaciones de los viajes espaciales tripulados y vencer las inmensas distancias que tiene un viaje interestelar.', 169, NULL, NULL, NULL),
(114, 'Fractura', 'posters/20231101132343sacs.jpg', '2019-09-22', 'Tras la desaparición de su esposa y de su hija herida de las urgencias del hospital, un hombre se embarca en una búsqueda frenética convencido de que le ocultan algo.', 160, NULL, NULL, NULL),
(115, 'La Isla Siniestra', 'posters/20231101132840jdfvz.jpg', '2010-02-19', 'Verano de 1954. Los agentes judiciales Teddy Daniels y Chuck Aule son destinados a una remota isla del puerto de Boston para investigar la desaparición de una peligrosa asesina recluida en el hospital psiquiátrico Ashecliffe, un centro penitenciario para criminales perturbados dirigido por el siniestro doctor John Cawley. Pronto descubrirán que el centro guarda muchos secretos, y que la isla esconde algo más peligroso que los pacientes.', 138, NULL, NULL, NULL),
(116, 'Perfect Blue', 'posters/20231101133324sdcsd.jpg', '1998-02-28', 'Tras años siendo una ídolo juvenil que forma parte del exitoso trío musical CHAM!, Mima Kirigoe decide abandonar el grupo para perseguir su sueño de convertirse en actriz, lo que provoca la ira de muchos de sus fans. Pronto descubre que alguien está escribiendo un blog en internet en el que explica detalles íntimos sobre su vida. Mientras los cadáveres comienzan a acumularse a su alrededor, la realidad y las alucinaciones se mezclan en un mundo terrorífico en el que no hay lugar para la inocencia y los sueños se convierten en pesadillas.', 81, NULL, NULL, NULL),
(117, 'Paprika, detective de los sueños', 'posters/20231101133758gm.jpg', '2006-10-21', 'El psiquiatra Atsuko Chiba ha desarrollado un método de terapia revolucionario denominado \"PT\", un prototipo de máquina experimental gracias a la cual es posible introducirse en la mente de los pacientes para tratar sus ansiedades. Pero uno de los modelos de PT es robado del laboratorio del Dr. Atsuko, y comienzan a utilizarlo para invadir las mentes de sus creadores, destruyendo sus personalidades mientras duermen.', 90, NULL, NULL, NULL),
(118, 'Hereditary', 'posters/20231101134359gnfgn.jpg', '2018-06-07', 'Cosas extrañas comienzan a suceder en casa de los Graham tras la muerte de la abuela y matriarca, que deja en herencia su casa a su hija Annie. Annie Graham, una galerista casada y con dos hijos, no tuvo una infancia demasiado feliz junto a su madre, y cree que la muerte de ésta puede hacer que pase página. Pero todo se complica cuando su hija menor comienza a ver figuras fantasmales, que también empiezan a aparecer ante su hermano.', 126, NULL, NULL, NULL),
(119, 'Monster House', 'posters/20231101134754vmvjh.jpg', '2006-06-30', 'D.J. Walters es un chico de doce años al que se le ha metido en la cabeza que en la casa del anciano Nebbercracker, al otro lado de la calle, ocurre algo extraño. La víspera de Halloween, el balón con el que juegan D.J. y su amigo va a parar al jardín del señor Nebbercracker, pero misteriosamente llega al interior de la vivienda. Cuando su amiga Jenny está a punto de ser engullida por la extraña casa, nadie cree a los asustados chicos; así que los tres deciden investigar qué sucede en esa extraña casa.', 91, NULL, NULL, NULL),
(120, 'La matanza de Texas', 'posters/20231101135133fh.jpg', '2005-06-23', 'Durante un viaje de Texas a México, un grupo de jóvenes recoge a una autoestopista ensangrentada que asegura que es la única superviviente de una masacre ocurrida la noche anterior en una casa cercana. Remake del clásico homónimo de Tobe Hooper (1974).', 98, NULL, NULL, NULL),
(121, 'Así en la Tierra como en el Infierno', 'posters/20231101135516sdvd.jpg', '2014-08-29', 'Bajo los kilómetros y kilómetros de tortuosas catacumbas que hay bajo las calles de París, un grupo de exploradores se aventura entre los cientos de miles de huesos sin catalogar que ocupan el laberinto y acaban descubriendo cuál era la verdadera función de esta ciudad de los muertos. El recorrido se convierte en un viaje al corazón del terror.', 93, NULL, NULL, NULL),
(122, 'Ouija', 'posters/20231101140305kh.jpg', '2014-10-14', 'Después de que uno de sus amigos sea brutalmente asesinado por un malvado ente oscuro, un grupo de amigos juega a la ouija para intentar hablar con él desde el más allá. Sin embargo, lo que consiguen es despertar a un antiguo espíritu y a los demonios más salvajes. Los chicos tendrán que hacer frente a sus miedos más profundos e intentar acabar con ellos. Han descubierto que la ouija no es un juego de niños, es algo mucho más real.', 89, NULL, NULL, NULL),
(123, 'Scream', 'posters/20231101140529gbf.jpg', '2022-01-13', 'Una nueva entrega de la saga de terror \'Scream\' que seguirá a una mujer que regresa a su ciudad natal para intentar descubrir quién ha estado cometiendo una serie de crímenes atroces.', 120, NULL, NULL, NULL),
(124, 'El Silencio de los Inocentes', 'posters/20231101141522li.jpg', '1991-06-06', 'El FBI busca a \'Buffalo Bill\', un asesino en serie que mata a sus víctimas, todas adolescentes, después de prepararlas minuciosamente y arrancarles la piel. Para poder atraparlo recurren a Clarice Starling, una brillante licenciada universitaria, que aspira a formar parte del FBI. Siguiendo las instrucciones de su jefe, Jack Crawford, Clarice visita en una cárcel de alta seguridad a Hannibal Lecter, antiguo psicoanalista y asesino, dotado de una inteligencia superior a la normal. Su misión será intentar sacarle información sobre los patrones de conducta de \'Buffalo Bill\'.', 118, NULL, NULL, NULL),
(125, 'Guardianes de la Galaxia', 'posters/20231101142045gua.jpg', '2014-08-13', 'El temerario aventurero Peter Quill es objeto de un implacable cazarrecompensas después de robar una misteriosa esfera codiciada por Ronan, un poderoso villano cuya ambición amenaza todo el universo. Para poder escapar del incansable Ronan, Quill se ve obligado a pactar una complicada tregua con un cuarteto de inadaptados: Rocket, un mapache armado con un rifle, Groot, un humanoide con forma de árbol, la letal y enigmática Gamora y el vengativo Drax the Destroyer.', 122, NULL, NULL, NULL),
(126, 'Scott Pilgrim contra el mundo', 'posters/20231101142627sv.jpg', '2010-07-27', 'Scott Pilgrim, bajista de una banda de lo más corriente, los Sex Bob-omb. Este joven acaba de conocer a la chica de sus sueños… la de verdad. ¿Cuál es el problema a la hora de conquistar a Ramona Flowers? Los siete ex de la chica están decididos a matar a Scott.', 112, NULL, NULL, NULL),
(127, 'El Gran Hotel Budapest', 'posters/20231101142944bu.jpg', '2014-03-07', 'El Sr. Gustave H., un legendario conserje de un famoso hotel europeo de entreguerras, entabla amistad con Zero Moustafa, un joven empleado al que convierte en su protegido. La historia trata sobre el robo y la recuperación de una pintura renacentista de valor incalculable y sobre la batalla que enfrenta a los miembros de una familia por una inmensa fortuna.', 99, NULL, NULL, NULL),
(128, 'El lobo de Wall Street', 'posters/20231101143259lo.jpg', '2013-12-25', 'A mediados de los años 80, Jordan  Belfort era un joven honrado que perseguía el sueño americano, pero pronto en la agencia de valores aprendió que lo más importante no era hacer ganar a sus clientes, sino ser ambicioso y ganar una buena comisión. Su enorme éxito y fortuna le valió el mote de \"El lobo de Wall Street\". Dinero. Poder. Mujeres. Drogas. Las tentaciones abundaban y el temor a la ley era irrelevante. Jordan y su manada de lobos consideraban que la discreción era una cualidad anticuada; nunca se conformaban con lo que tenían.', 180, NULL, NULL, NULL),
(129, 'Pulp Fiction', 'posters/20231101143527pf.jpg', '1995-02-16', 'Jules y Vincent, dos asesinos a sueldo con muy pocas luces, trabajan para Marsellus Wallace. Vincent le confiesa a Jules que Marsellus le ha pedido que cuide de Mia, su mujer. Jules le recomienda prudencia porque es muy peligroso sobrepasarse con la novia del jefe. Cuando llega la hora de trabajar, ambos deben ponerse manos a la obra. Su misión: recuperar un misterioso maletín.', 154, NULL, NULL, NULL),
(130, 'El Padrino', 'posters/20231101143827ep.jpg', '2011-11-24', 'Don Vito Corleone, conocido dentro de los círculos del hampa como \'El Padrino\', es el patriarca de una de las cinco familias que ejercen el mando de la Cosa Nostra en Nueva York en los años cuarenta. Don Corleone tiene cuatro hijos: una chica, Connie, y tres varones; Sonny, Michael y Fredo. Cuando el Padrino reclina intervenir en el negocio de estupefacientes, empieza una cruenta lucha de violentos episodios entre las distintas familias del crimen organizado.', 175, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peli_actor`
--

CREATE TABLE `peli_actor` (
  `id_peli` int(8) NOT NULL,
  `id_actor` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `peli_actor`
--

INSERT INTO `peli_actor` (`id_peli`, `id_actor`) VALUES
(48, 4),
(48, 6),
(48, 7),
(49, 9),
(49, 10),
(49, 11),
(52, 12),
(52, 13),
(52, 14),
(52, 15),
(52, 16),
(73, 19),
(73, 20),
(73, 21),
(74, 22),
(74, 23),
(74, 24),
(75, 25),
(75, 26),
(75, 27),
(76, 28),
(76, 29),
(76, 30),
(77, 29),
(77, 31),
(77, 32),
(78, 33),
(78, 34),
(78, 35),
(79, 36),
(79, 37),
(79, 38),
(80, 39),
(80, 40),
(80, 41),
(80, 42),
(48, 8),
(85, 44),
(85, 46),
(85, 47),
(75, 13),
(90, 49),
(90, 50),
(90, 51),
(91, 52),
(91, 53),
(91, 54),
(92, 55),
(92, 53),
(92, 56),
(92, 57),
(93, 58),
(93, 59),
(93, 60),
(93, 57),
(94, 61),
(94, 62),
(94, 63),
(95, 59),
(95, 64),
(95, 65),
(96, 66),
(96, 67),
(96, 14),
(97, 68),
(97, 69),
(97, 70),
(98, 66),
(98, 67),
(98, 71),
(99, 71),
(99, 14),
(99, 66),
(100, 72),
(100, 73),
(100, 74),
(100, 75),
(101, 76),
(101, 77),
(101, 78),
(102, 76),
(102, 77),
(102, 78),
(102, 79),
(103, 76),
(103, 77),
(103, 78),
(104, 80),
(104, 81),
(104, 82),
(104, 83),
(105, 80),
(105, 81),
(105, 82),
(105, 83),
(106, 80),
(106, 81),
(106, 82),
(106, 83),
(107, 79),
(107, 84),
(107, 85),
(107, 86),
(108, 87),
(108, 88),
(108, 89),
(109, 90),
(109, 91),
(109, 92),
(110, 93),
(110, 94),
(110, 95),
(110, 96),
(111, 97),
(111, 98),
(111, 99),
(112, 100),
(112, 101),
(112, 102),
(112, 103),
(113, 104),
(113, 105),
(113, 106),
(114, 107),
(114, 108),
(114, 109),
(114, 110),
(115, 11),
(115, 111),
(115, 112),
(116, 113),
(116, 114),
(116, 115),
(117, 116),
(117, 117),
(117, 118),
(118, 119),
(118, 120),
(118, 121),
(119, 122),
(119, 123),
(119, 124),
(119, 125),
(120, 126),
(120, 127),
(120, 128),
(121, 129),
(121, 130),
(121, 131),
(122, 132),
(122, 133),
(122, 134),
(123, 135),
(123, 136),
(123, 137),
(124, 138),
(124, 139),
(124, 140),
(125, 141),
(125, 142),
(125, 143),
(125, 144),
(125, 145),
(126, 146),
(126, 147),
(126, 148),
(126, 149),
(127, 150),
(127, 151),
(127, 152),
(128, 11),
(128, 12),
(128, 104),
(128, 153),
(129, 19),
(129, 154),
(129, 155),
(130, 156),
(130, 157),
(130, 158);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peli_director`
--

CREATE TABLE `peli_director` (
  `id_peli` int(8) NOT NULL,
  `id_director` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `peli_director`
--

INSERT INTO `peli_director` (`id_peli`, `id_director`) VALUES
(49, 18),
(52, 22),
(73, 18),
(74, 17),
(75, 26),
(76, 27),
(77, 28),
(78, 29),
(79, 30),
(80, 31),
(85, 33),
(48, 17),
(90, 35),
(91, 36),
(91, 37),
(91, 38),
(91, 39),
(92, 40),
(93, 41),
(94, 42),
(95, 43),
(96, 44),
(97, 45),
(98, 44),
(99, 44),
(100, 46),
(101, 47),
(101, 48),
(102, 47),
(102, 49),
(103, 50),
(104, 51),
(105, 51),
(106, 51),
(107, 52),
(108, 53),
(109, 54),
(110, 55),
(111, 56),
(112, 57),
(113, 55),
(114, 58),
(115, 59),
(116, 60),
(117, 60),
(118, 61),
(119, 62),
(120, 63),
(121, 64),
(122, 65),
(123, 66),
(124, 67),
(125, 68),
(126, 69),
(127, 70),
(128, 59),
(129, 18),
(130, 71);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peli_genero`
--

CREATE TABLE `peli_genero` (
  `id_peli` int(8) NOT NULL,
  `id_genero` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `peli_genero`
--

INSERT INTO `peli_genero` (`id_peli`, `id_genero`) VALUES
(48, 2),
(48, 3),
(49, 5),
(49, 6),
(48, 7),
(52, 8),
(52, 4),
(52, 9),
(73, 11),
(74, 13),
(75, 5),
(75, 14),
(75, 15),
(76, 5),
(77, 5),
(77, 16),
(78, 5),
(79, 15),
(79, 5),
(79, 14),
(80, 5),
(80, 18),
(80, 19),
(85, 11),
(85, 21),
(85, 22),
(48, 4),
(90, 3),
(90, 4),
(90, 7),
(91, 3),
(91, 4),
(91, 13),
(92, 2),
(92, 3),
(92, 4),
(93, 2),
(93, 3),
(93, 4),
(93, 13),
(94, 4),
(94, 7),
(94, 8),
(95, 2),
(95, 3),
(96, 4),
(96, 7),
(96, 13),
(97, 7),
(97, 8),
(97, 37),
(98, 4),
(98, 7),
(98, 13),
(99, 4),
(99, 7),
(99, 13),
(99, 37),
(100, 2),
(100, 4),
(101, 4),
(101, 7),
(101, 8),
(101, 37),
(102, 4),
(102, 7),
(102, 8),
(102, 37),
(103, 4),
(103, 7),
(103, 8),
(103, 37),
(104, 4),
(104, 11),
(104, 13),
(104, 25),
(105, 4),
(105, 11),
(105, 13),
(105, 25),
(106, 4),
(106, 11),
(106, 13),
(106, 25),
(107, 4),
(107, 7),
(107, 13),
(107, 37),
(108, 4),
(108, 13),
(109, 11),
(109, 13),
(100, 37),
(110, 5),
(110, 28),
(111, 5),
(112, 5),
(112, 14),
(113, 5),
(113, 13),
(113, 22),
(114, 5),
(114, 14),
(115, 5),
(115, 14),
(115, 17),
(116, 14),
(116, 37),
(117, 14),
(117, 17),
(117, 37),
(118, 17),
(118, 14),
(118, 16),
(119, 37),
(119, 4),
(119, 2),
(119, 16),
(120, 16),
(121, 16),
(121, 12),
(122, 16),
(123, 17),
(123, 14),
(123, 16),
(124, 15),
(124, 5),
(124, 14),
(125, 11),
(125, 13),
(125, 22),
(126, 11),
(126, 8),
(127, 8),
(127, 5),
(128, 8),
(128, 15),
(128, 5),
(129, 11),
(129, 15),
(129, 14),
(130, 15),
(130, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `review`
--

CREATE TABLE `review` (
  `id_review` int(8) NOT NULL,
  `id_usuario` int(8) NOT NULL,
  `id_peli` int(8) NOT NULL,
  `calificacion` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `review`
--

INSERT INTO `review` (`id_review`, `id_usuario`, `id_peli`, `calificacion`) VALUES
(57, 12, 48, 7),
(58, 10, 48, 4),
(59, 14, 48, 7),
(65, 9, 109, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(8) NOT NULL,
  `nombre_usuario` varchar(15) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `administrador` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre_usuario`, `mail`, `contraseña`, `administrador`) VALUES
(7, 'kensho', 'kensho@mail.com', '81dc9bdb52d04dc20036dbd8313ed055', 1),
(9, 'chappa', 'claraschiappacassi@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', NULL),
(10, 'neik', 'nico.ruizx10@hotmail.com', '81dc9bdb52d04dc20036dbd8313ed055', NULL),
(11, 'dany', 'dany@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', NULL),
(12, 'ana', 'ana@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', NULL),
(13, 'juan', 'juan@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', NULL),
(14, 'tadeo', 'tadeo@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', NULL),
(15, 'lisa', 'lisa@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', NULL),
(16, 'homero', 'homero@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', NULL),
(17, 'pedro', 'pedro@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', NULL),
(18, 'Mariano.I', 'marianoingerto@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actor`
--
ALTER TABLE `actor`
  ADD PRIMARY KEY (`id_actor`);

--
-- Indices de la tabla `director`
--
ALTER TABLE `director`
  ADD PRIMARY KEY (`id_director`);

--
-- Indices de la tabla `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`id_genero`);

--
-- Indices de la tabla `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id_review`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_peli` (`id_peli`);

--
-- Indices de la tabla `peli`
--
ALTER TABLE `peli`
  ADD PRIMARY KEY (`id_peli`),
  ADD UNIQUE KEY `path_poster` (`path_poster`);

--
-- Indices de la tabla `peli_actor`
--
ALTER TABLE `peli_actor`
  ADD KEY `id_peli` (`id_peli`),
  ADD KEY `id_actor` (`id_actor`);

--
-- Indices de la tabla `peli_director`
--
ALTER TABLE `peli_director`
  ADD KEY `id_peli` (`id_peli`),
  ADD KEY `id_director` (`id_director`);

--
-- Indices de la tabla `peli_genero`
--
ALTER TABLE `peli_genero`
  ADD KEY `id_peli` (`id_peli`),
  ADD KEY `id_genero` (`id_genero`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actor`
--
ALTER TABLE `actor`
  MODIFY `id_actor` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT de la tabla `director`
--
ALTER TABLE `director`
  MODIFY `id_director` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT de la tabla `genero`
--
ALTER TABLE `genero`
  MODIFY `id_genero` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `peli`
--
ALTER TABLE `peli`
  MODIFY `id_peli` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT de la tabla `review`
--
ALTER TABLE `review`
  MODIFY `id_review` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `peli_actor`
--
ALTER TABLE `peli_actor`
  ADD CONSTRAINT `peli_actor_ibfk_1` FOREIGN KEY (`id_peli`) REFERENCES `peli` (`id_peli`),
  ADD CONSTRAINT `peli_actor_ibfk_2` FOREIGN KEY (`id_actor`) REFERENCES `actor` (`id_actor`);

--
-- Filtros para la tabla `peli_director`
--
ALTER TABLE `peli_director`
  ADD CONSTRAINT `peli_director_ibfk_1` FOREIGN KEY (`id_peli`) REFERENCES `peli` (`id_peli`),
  ADD CONSTRAINT `peli_director_ibfk_2` FOREIGN KEY (`id_director`) REFERENCES `director` (`id_director`);

--
-- Filtros para la tabla `peli_genero`
--
ALTER TABLE `peli_genero`
  ADD CONSTRAINT `peli_genero_ibfk_1` FOREIGN KEY (`id_peli`) REFERENCES `peli` (`id_peli`),
  ADD CONSTRAINT `peli_genero_ibfk_2` FOREIGN KEY (`id_genero`) REFERENCES `genero` (`id_genero`);

--
-- Filtros para la tabla `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`id_peli`) REFERENCES `peli` (`id_peli`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
