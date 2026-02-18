-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-02-2026 a las 20:29:52
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `wikipedia_dinamica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informacion`
--

CREATE TABLE `informacion` (
  `id_tabla` int(8) NOT NULL,
  `name_tabla` varchar(100) NOT NULL,
  `info_tabla` text NOT NULL,
  `img_tabla` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peticiones`
--

CREATE TABLE `peticiones` (
  `id_peticion` int(11) NOT NULL,
  `id_info` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `texto_peticion` text NOT NULL,
  `estado` enum('pendiente','aceptada','rechazada') DEFAULT 'pendiente',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_user` int(8) NOT NULL,
  `rol` enum('user','admin') DEFAULT 'user',
  `name` varchar(25) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `informacion`
--
ALTER TABLE `informacion`
  ADD PRIMARY KEY (`id_tabla`);

--
-- Indices de la tabla `peticiones`
--
ALTER TABLE `peticiones`
  ADD PRIMARY KEY (`id_peticion`),
  ADD KEY `id_info` (`id_info`),
  ADD KEY `id_user` (`id_user`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `informacion`
--
ALTER TABLE `informacion`
  MODIFY `id_tabla` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `peticiones`
--
ALTER TABLE `peticiones`
  MODIFY `id_peticion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_user` int(8) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `peticiones`
--
ALTER TABLE `peticiones`
  ADD CONSTRAINT `peticiones_ibfk_1` FOREIGN KEY (`id_info`) REFERENCES `informacion` (`id_tabla`),
  ADD CONSTRAINT `peticiones_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `usuarios` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
INSERT INTO usuarios (rol, name, email, password)
VALUES (
    'admin',
    'Administrador',
    'admin@wikiagora.com',
    '$2y$10$w7Xu8K4WN7HVB5yu9cFzaulFIgUvyJJldWESNDxZIhNhLMo2MoBmS'
);

INSERT INTO informacion (name_tabla, info_tabla, img_tabla) VALUES

('Imperio Solar de Aethernia',
'El Imperio Solar de Aethernia fue una de las civilizaciones más influyentes del continente occidental entre los siglos IV y IX. Según documentos preservados en crónicas fragmentarias, su sistema político estaba estructurado como una monarquía teocrática en la cual el emperador no solo ejercía el poder político absoluto, sino que además era considerado la encarnación terrenal de la divinidad solar. Esta creencia otorgaba legitimidad total a sus decisiones y consolidaba la unidad cultural del territorio.

La organización social de Aethernia era jerárquica. En la cima se encontraba la familia imperial, seguida de los Altos Astrónomos, encargados de interpretar los movimientos celestes. Posteriormente estaban los Guardianes del Alba, una élite militar cuya formación combinaba disciplina física con instrucción filosófica. Más abajo se encontraban comerciantes, artesanos especializados en cristal solar y agricultores que trabajaban extensas llanuras irrigadas mediante avanzados sistemas hidráulicos.

En el ámbito científico, desarrollaron calendarios de precisión notable basados en observaciones astronómicas sistemáticas. Sus estudios de tránsito solar y eclipses permitieron mejorar técnicas agrícolas, prediciendo estaciones con exactitud. Las infraestructuras urbanas destacaban por el uso de piedra blanca y estructuras alineadas astronómicamente.

Durante su expansión territorial, el Imperio estableció rutas comerciales que conectaban regiones montañosas con puertos marítimos. Esta red facilitó el intercambio de minerales raros, especias exóticas y conocimiento técnico. La caída del Imperio se atribuye a conflictos internos sucesorios combinados con presiones externas de pueblos fronterizos.

Su legado cultural persistió en la arquitectura posterior y en textos filosóficos que influyeron en civilizaciones vecinas durante siglos posteriores.',
''),

('La Revolución Digital Global',
'La Revolución Digital Global representa el conjunto de transformaciones tecnológicas, sociales y económicas que redefinieron el mundo desde finales del siglo XX hasta el presente. Este proceso comenzó con la expansión del internet comercial, la creación de redes interconectadas y la aparición de los primeros dispositivos móviles inteligentes.

En el ámbito económico, surgieron modelos de negocio basados en datos masivos, comercio electrónico y plataformas descentralizadas. Empresas tecnológicas adquirieron protagonismo global, modificando dinámicas laborales y creando nuevas profesiones vinculadas al desarrollo de software, análisis de datos y ciberseguridad.

Socialmente, la comunicación experimentó un cambio radical. Las redes sociales permitieron interacción inmediata entre individuos ubicados en distintos continentes, eliminando barreras geográficas tradicionales. Esto impulsó movimientos sociales digitales, nuevas formas de activismo y también desafíos relacionados con la desinformación.

En el sector educativo, el acceso abierto a información transformó metodologías de enseñanza, promoviendo aprendizaje autodidacta y cursos virtuales masivos. En salud, la digitalización permitió avances en telemedicina, diagnósticos asistidos por inteligencia artificial y análisis predictivos.

No obstante, también emergieron debates éticos sobre privacidad, vigilancia masiva y concentración de poder tecnológico. Gobiernos y organizaciones internacionales desarrollaron marcos regulatorios para equilibrar innovación y protección de derechos fundamentales.

Actualmente, la Revolución Digital continúa evolucionando mediante inteligencia artificial avanzada, computación cuántica y automatización industrial.',
''),

('Biblioteca Subterránea de Valdris',
'La Biblioteca Subterránea de Valdris fue descubierta accidentalmente en 1892 durante excavaciones mineras. El complejo consistía en una red de túneles excavados en piedra volcánica endurecida, diseñada para proteger manuscritos de guerras y catástrofes naturales.

Se estima que almacenó más de cuarenta mil manuscritos, organizados en galerías temáticas. Las secciones incluían matemáticas, filosofía natural, alquimia experimental, navegación estelar y medicina herbolaria. Los textos estaban protegidos en recipientes sellados con resinas especiales que impedían la humedad.

La estructura arquitectónica demuestra planificación avanzada: sistemas de ventilación pasiva, cámaras de presión y mecanismos de drenaje subterráneo. Investigadores modernos consideran que su construcción requirió varias generaciones de trabajo coordinado.

El descubrimiento generó impacto académico internacional. Numerosos estudios se centraron en reconstruir cronologías históricas basadas en documentos allí preservados. Algunos textos contenían teorías matemáticas adelantadas a su tiempo.

A día de hoy, gran parte del archivo permanece en estudio, siendo considerada una de las fuentes historiográficas más importantes del mundo antiguo.',
''),

('Teoría del Horizonte Infinito',
'La Teoría del Horizonte Infinito fue propuesta en 1974 por el físico teórico Elian Vortek. Postula que el universo observable es tan solo una fracción limitada de una estructura multidimensional mucho mayor que se expande en direcciones no perceptibles por la física clásica.

El modelo matemático de la teoría combina geometría no euclidiana con hipótesis de energía latente distribuida en planos superiores. Según Vortek, ciertos fenómenos cuánticos podrían interpretarse como interacciones mínimas entre dimensiones paralelas.

La comunidad científica reaccionó inicialmente con escepticismo. Sin embargo, avances posteriores en cosmología permitieron reconsiderar algunos aspectos teóricos. Estudios sobre expansión acelerada y materia oscura fueron reinterpretados a la luz de nuevas ecuaciones basadas en esta hipótesis.

Actualmente, aunque no está plenamente confirmada, la teoría continúa influyendo en investigaciones de física avanzada y cosmología teórica.',
''),

('Federación Interestelar de Orion',
'La Federación Interestelar de Orion es una entidad política ficticia situada en un contexto de colonización espacial avanzada. Fundada tras la expansión humana fuera del sistema solar, agrupa múltiples colonias distribuidas en sistemas planetarios cercanos.

Su gobierno se basa en una asamblea interplanetaria donde cada colonia posee representación proporcional a su población. Las decisiones estratégicas abarcan comercio interestelar, defensa conjunta y regulación científica.

Las tecnologías desarrolladas bajo la Federación incluyen motores de curvatura experimental, terraformación controlada y sistemas autónomos de soporte vital. Culturalmente, la mezcla de poblaciones provenientes de distintos planetas generó nuevas expresiones artísticas híbridas.

El sistema jurídico federado establece normas comunes sobre investigación genética, inteligencia artificial y recursos minerales extraterrestres.

Aunque ficticia, la Federación simboliza modelos hipotéticos de organización política futura en escenarios de exploración espacial prolongada.',
'');


UPDATE informacion 
SET img_tabla = '../fotos/artenia.jpg'
WHERE name_tabla = 'Imperio Solar de Aethernia';

UPDATE informacion 
SET img_tabla = '../fotos/digital.jpg'
WHERE name_tabla = 'La Revolución Digital Global';

UPDATE informacion 
SET img_tabla = '../fotos/biblio.jpg'
WHERE name_tabla = 'Biblioteca Subterránea de Valdris';

UPDATE informacion 
SET img_tabla = '../fotos/universo.jpg'
WHERE name_tabla = 'Teoría del Horizonte Infinito';

UPDATE informacion 
SET img_tabla = '../fotos/orion.jpg'
WHERE name_tabla = 'Federación Interestelar de Orion';
