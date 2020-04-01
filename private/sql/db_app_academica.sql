--
-- Base de datos: `db_app_academica`
--

CREATE DATABASE db_app_academica;

USE db_app_academica;


--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `idAlumno` int(10) NOT NULL,
  `codigo` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` char(65) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` char(150) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` char(9) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Estructura de tabla para la tabla `docentes`
--

CREATE TABLE `docentes` (
  `idDocente` int(10) NOT NULL,
  `codigo` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` char(50) COLLATE utf8_spanish_ci NOT NULL,
  `dui` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` char(65) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` char(9) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `materias` (
  `idMateria` int(10) NOT NULL,
  `codigo` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` char(50) COLLATE utf8_spanish_ci NOT NULL,
  `ciclo` int(2) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`idAlumno`),
  ADD UNIQUE KEY `codigo` (`codigo`);

--
-- Indices de la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD PRIMARY KEY (`idDocente`),
  ADD UNIQUE KEY `codigo` (`codigo`);

--
-- Indices de la tabla `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`idMateria`),
  ADD UNIQUE KEY `codigo` (`codigo`); 
--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `idAlumno` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `docentes`
--
ALTER TABLE `docentes`
  MODIFY `idDocente` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `materias`
--
ALTER TABLE `materias`
  MODIFY `idMateria` int(10) NOT NULL AUTO_INCREMENT;

