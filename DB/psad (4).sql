-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-12-2017 a las 21:18:38
-- Versión del servidor: 10.1.16-MariaDB
-- Versión de PHP: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `psad`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acciones`
--

CREATE TABLE `acciones` (
  `id` int(10) UNSIGNED NOT NULL,
  `status_ac` int(11) NOT NULL DEFAULT '0',
  `descripcion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `desci` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `url` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `identificador` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `clase_cont` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `clase_css` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `clase_elem` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `ventana` int(11) NOT NULL DEFAULT '0',
  `orden` int(11) NOT NULL,
  `vista` int(11) NOT NULL,
  `submodulo_id` int(10) UNSIGNED NOT NULL,
  `tabla` int(11) NOT NULL,
  `accion_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `acciones`
--

INSERT INTO `acciones` (`id`, `status_ac`, `descripcion`, `desci`, `url`, `identificador`, `clase_cont`, `clase_css`, `clase_elem`, `ventana`, `orden`, `vista`, `submodulo_id`, `tabla`, `accion_id`) VALUES
(1, 1, 'Status Departamento', 'status', ' ', ' ', '', ' ', '', 0, 3, 1, 2, 0, 1),
(2, 1, 'Modificar departamento', 'modificar', ' #myModal2', 'modal', '', 'fa fa-pencil-square', 'tltp ModificaR', 0, 2, 1, 2, 0, 2),
(3, 1, 'Cargos Departamento', '', '  /menu/registros/departamentos/cargos/', '', '', 'fa fa-level-down', '', 1, 4, 1, 2, 0, 3),
(4, 1, 'Agregar Departamento', 'agregar', ' ', ' ', '', ' ', '', 0, 1, 1, 2, 0, 4),
(5, 1, 'Status Cargo', 'status', ' ', ' ', 'chbx', ' ', 'btnAcc', 0, 8, 2, 2, 1, 3),
(6, 1, 'Modificar Cargo', 'modificar', ' #myModal2', 'ModificaCar', 'iclsp', 'fa fa-pencil-square', 'tltp ModificaR', 0, 6, 2, 2, 1, 3),
(7, 1, 'Agregar Cargo', 'agregar', ' ', ' ', '', ' ', '', 0, 5, 0, 2, 1, 3),
(8, 1, 'Agregar Matriz', '', ' ', ' ', '', ' ', '', 0, 9, 0, 7, 0, 8),
(9, 1, 'Modificar Matriz', '', '/menu/registros/clientes/modificar', 'modal', '', 'fa fa-pencil-square', '', 0, 10, 0, 7, 0, 9),
(10, 1, 'Responsable Matriz', '', '/menu/registros/clientes/responsable/', ' ', '', 'fa fa-street-view', '', 1, 12, 0, 7, 0, 10),
(11, 1, 'Categorias Matriz', '', '/menu/registros/clientes/categoria/', ' ', '', 'fa fa-level-down', '', 1, 16, 0, 7, 0, 11),
(12, 1, 'Status Matriz', '', ' ', ' ', '', ' ', '', 0, 11, 0, 7, 0, 12),
(13, 1, 'Agr.Responsable Matriz', '', ' ', ' ', '', ' ', '', 0, 13, 0, 7, 0, 10),
(14, 1, 'Mod. Responsable Matriz', '', '', 'modal', '', 'fa fa-pencil-square', '', 0, 14, 0, 7, 0, 10),
(15, 1, 'Status Responsable Matriz ', '', ' ', ' ', '', ' ', '', 0, 15, 0, 7, 0, 10),
(16, 1, 'Modificar Categoria', '', ' ', 'modal', '', 'fa fa-pencil-square', '', 0, 18, 0, 7, 0, 11),
(17, 1, 'Responsable Categoria', '', '/menu/registros/clientes/categoria/responsable/', ' ', '', 'fa fa-street-view', '', 1, 20, 0, 7, 0, 11),
(18, 1, 'Status Categoria', '', ' ', ' ', '', ' ', '', 0, 19, 0, 7, 0, 11),
(19, 1, 'Sucursales Categoria ', '', '/menu/registros/clientes/categorias/sucursales/', ' ', '', 'fa fa-level-down', '', 1, 24, 0, 7, 0, 11),
(20, 1, 'Agregar categoria ', '', ' ', ' ', '', ' ', '', 0, 17, 0, 7, 0, 11),
(21, 1, 'Agr. Responsable Categoria', '', '', '', '', '', '', 0, 21, 0, 7, 0, 17),
(22, 1, 'Status Resp. Categoria', '', '', '', '', '', '', 0, 23, 0, 7, 0, 17),
(23, 1, 'Mod. Responsable Categoria ', '', '', 'modal', '', 'fa fa-pencil-square', '', 0, 22, 0, 7, 0, 17),
(24, 1, 'Agr. Sucursal', '', '', '', '', '', '', 0, 25, 0, 7, 0, 19),
(25, 1, 'Mod. Sucursal', '', '', 'modal', '', 'fa fa-pencil-square', '', 0, 26, 0, 7, 0, 19),
(26, 1, 'Resp. Sucursal', '', '/menu/registros/clientes/categoria/sucursal/responsable/', '', '', 'fa fa-street-view', '', 1, 28, 0, 7, 0, 19),
(27, 1, 'Planes Sucursal', '', '/menu/registros/clientes/categoria/sucursal/plan/', '', '', 'fa fa-cubes', '', 1, 32, 0, 7, 0, 19),
(28, 1, 'Equipos Sucursal ', '', '/menu/registros/clientes/categoria/sucursal/equipos/', '', '', 'fa fa-desktop', '', 1, 34, 0, 7, 0, 19),
(29, 1, 'Usuario Sucursal', '', '/menu/registros/clientes/categoria/sucursal/usuarios/', '', '', 'fa fa-user-plus', '', 1, 62, 0, 7, 0, 19),
(30, 1, 'Status Sucursal', '', '', '', '', '', '', 0, 27, 0, 7, 0, 19),
(31, 1, 'Agr. Responsable Sucursal', '', '', '', '', '', '', 0, 29, 0, 7, 0, 26),
(32, 1, 'Mod. Responsable Sucursal', '', '', 'modal', '', 'fa fa-pencil-square', '', 0, 30, 0, 7, 0, 26),
(33, 1, 'Status Responsable Sucursal', '', '', '', '', '', '', 0, 31, 0, 7, 0, 26),
(37, 1, 'Servicios', '', '/menu/registros/clientes/categoria/sucursal/plan/servicios', '', '', 'fa fa-cube', '', 0, 33, 0, 7, 0, 27),
(41, 1, 'Agr. Equipos Sucursal', '', '', '', '', '', '', 0, 35, 0, 7, 0, 28),
(42, 1, 'Mod. Equipos Sucursal', '', '', 'modal', '', 'fa fa-pencil-square', '', 0, 36, 0, 7, 0, 28),
(43, 1, 'Status Equipo Sucursal', '', '', '', '', '', '', 0, 37, 0, 7, 0, 28),
(44, 1, 'Componentes Equipo ', '', '/menu/registros/clientes/categoria/sucursal/equipos/componentes/', '', '', 'fa fa-cogs', '', 1, 38, 0, 7, 0, 28),
(45, 1, 'Agregar Componente', '', '', '', '', '', '', 0, 39, 0, 7, 0, 44),
(46, 1, 'Modificar Componete', '', '', 'modal', '', 'fa fa-pencil-square', '', 0, 40, 0, 7, 0, 44),
(47, 1, 'Status Componente', '', '', '', '', '', '', 0, 41, 0, 7, 0, 44),
(48, 1, 'Piezas Componente', '', '/menu/registros/clientes/categoria/sucursal/equipos/componentes/piezas/', '', '', 'fa fa-cog', '', 1, 42, 0, 7, 0, 44),
(49, 1, 'Aplicaciones Equipo', '', '/menu/registros/clientes/categoria/sucursal/equipos/aplicaciones/', '', '', 'fa fa-windows', '', 1, 46, 0, 7, 0, 28),
(50, 1, 'Agr. Aplicacion Equipo', '', '', '', '', '', '', 0, 47, 0, 7, 0, 49),
(51, 1, 'Mod. Aplicacion Equipo', '', '', 'modal', '', 'fa fa-pencil-square', '', 0, 48, 0, 7, 0, 49),
(52, 1, 'Status Aplicacion', '', '', '', '', '', '', 0, 49, 0, 7, 0, 49),
(53, 1, 'Agr. Pieza Componente', '', '', '', '', '', '', 0, 43, 0, 7, 0, 48),
(54, 1, 'Mod. Pieza Componente', '', '', 'modal', '', 'fa fa-pencil-square', '', 0, 44, 0, 7, 0, 48),
(55, 1, 'Status Pieza Equipo', '', '', '', '', '', '', 0, 45, 0, 7, 0, 48),
(64, 1, 'Agregar Plan', '', '', '', '', '', '', 0, 50, 0, 3, 0, 64),
(65, 1, 'Modificar Plan', '', '', 'modal', '', 'fa fa-pencil-square', '', 0, 51, 0, 3, 0, 65),
(66, 1, 'Status Plan', '', '', '', '', '', '', 0, 52, 0, 3, 0, 66),
(67, 1, 'Servicios Plan', '', '/menu/registros/planeservicios/servicios/', '', '', 'fa fa-cube', '', 1, 53, 0, 3, 0, 67),
(75, 1, 'Agr. Empleados', '', '   ', '', '', '', '', 0, 54, 0, 6, 0, 75),
(76, 1, 'Mod. Empleados', '', '', 'modal', '', 'fa fa-pencil-square', '', 0, 55, 0, 6, 0, 76),
(77, 1, 'Perfil Empleados', '', '/menu/registros/empleados/perfil/', '', '', 'fa fa-user-plus', '', 1, 57, 0, 6, 0, 77),
(78, 1, 'Status Empleado', '', '', '', '', '', '', 0, 56, 0, 6, 0, 78),
(83, 1, 'Agr. Perfil', '', '', '', '', '', '', 0, 58, 0, 5, 0, 83),
(84, 1, 'Mod. Perfil', '', '', '', '', 'fa fa-pencil-square', '', 0, 59, 0, 5, 0, 84),
(85, 1, 'Status Perfil', '', '', '', '', '', '', 0, 60, 0, 5, 0, 85),
(86, 1, 'Configurar Permisos', '', ' /menu/registros/perfiles/permisos/', ' ', '', ' fa fa-id-card-o', '', 1, 61, 0, 5, 0, 86),
(87, 0, 'Eliminar Cargo', '', ' /menu/registros/cargos/eliminar', ' EliminarCar', 'iclsp', ' fa fa-trash-o', 'EliminarR', 0, 7, 2, 2, 0, 3),
(88, 1, 'Gestion Tipo de Equipo', '', ' /menu/registros/datos/tipoequipo', 'img/pc.png', '', 'col-md-2 tge', '', 1, 62, 0, 4, 0, 88),
(89, 1, 'Gestion Marca Equipo', '', '/menu/registros/datos/marcaequipo', 'img/marcae.png ', '', 'col-md-2 tgme', '', 1, 63, 0, 4, 0, 89),
(90, 1, 'Gestion Marca Componete', '', '/menu/registros/datos/marcacomponente', 'img/marcac.png', '', 'col-md-2 tgmc', '', 1, 64, 0, 4, 0, 90),
(91, 1, 'Gestion Marca Pieza', '', '/menu/registros/datos/marcapieza', 'img/marcap.png', '', 'col-md-2 tgmp', '', 1, 65, 0, 4, 0, 91);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accion_perfil`
--

CREATE TABLE `accion_perfil` (
  `id` int(10) UNSIGNED NOT NULL,
  `perfil_id` int(10) UNSIGNED NOT NULL,
  `accion_id` int(10) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `accion_perfil`
--

INSERT INTO `accion_perfil` (`id`, `perfil_id`, `accion_id`, `status`) VALUES
(559, 12, 1, 1),
(560, 12, 2, 1),
(561, 12, 3, 1),
(562, 12, 4, 1),
(563, 12, 5, 1),
(564, 12, 6, 1),
(565, 12, 7, 1),
(566, 12, 8, 1),
(567, 12, 9, 1),
(568, 12, 10, 0),
(569, 12, 11, 1),
(570, 12, 12, 1),
(571, 12, 13, 0),
(572, 12, 14, 0),
(573, 12, 15, 0),
(574, 12, 16, 1),
(575, 12, 17, 1),
(576, 12, 18, 1),
(577, 12, 19, 1),
(578, 12, 20, 1),
(579, 12, 21, 1),
(580, 12, 22, 1),
(581, 12, 23, 1),
(582, 12, 24, 1),
(583, 12, 25, 1),
(584, 12, 26, 1),
(585, 12, 27, 1),
(586, 12, 28, 1),
(587, 12, 29, 1),
(588, 12, 30, 1),
(589, 12, 31, 1),
(590, 12, 32, 1),
(591, 12, 33, 1),
(593, 12, 37, 1),
(594, 12, 41, 1),
(595, 12, 42, 1),
(596, 12, 43, 1),
(597, 12, 44, 1),
(598, 12, 45, 1),
(599, 12, 46, 1),
(600, 12, 47, 1),
(601, 12, 48, 1),
(602, 12, 49, 1),
(603, 12, 50, 1),
(604, 12, 51, 1),
(605, 12, 52, 1),
(606, 12, 53, 1),
(607, 12, 54, 1),
(608, 12, 55, 1),
(609, 12, 64, 1),
(610, 12, 65, 1),
(611, 12, 66, 1),
(612, 12, 67, 1),
(616, 12, 75, 1),
(617, 12, 76, 1),
(618, 12, 77, 1),
(619, 12, 78, 1),
(621, 12, 83, 1),
(622, 12, 84, 1),
(623, 12, 85, 1),
(624, 12, 86, 1),
(625, 12, 87, 1),
(627, 13, 1, 1),
(628, 13, 2, 1),
(629, 13, 3, 1),
(630, 13, 4, 1),
(631, 13, 5, 1),
(632, 13, 6, 1),
(633, 13, 7, 1),
(634, 13, 8, 1),
(635, 13, 9, 1),
(636, 13, 10, 1),
(637, 13, 11, 1),
(638, 13, 12, 1),
(639, 13, 13, 1),
(640, 13, 14, 1),
(641, 13, 15, 1),
(642, 13, 16, 1),
(643, 13, 17, 1),
(644, 13, 18, 1),
(645, 13, 19, 1),
(646, 13, 20, 1),
(647, 13, 21, 1),
(648, 13, 22, 1),
(649, 13, 23, 1),
(650, 13, 24, 1),
(651, 13, 25, 1),
(652, 13, 26, 1),
(653, 13, 27, 1),
(654, 13, 28, 1),
(655, 13, 29, 1),
(656, 13, 30, 1),
(657, 13, 31, 1),
(658, 13, 32, 1),
(659, 13, 33, 1),
(661, 13, 37, 1),
(662, 13, 41, 1),
(663, 13, 42, 1),
(664, 13, 43, 1),
(665, 13, 44, 1),
(666, 13, 45, 1),
(667, 13, 46, 1),
(668, 13, 47, 1),
(669, 13, 48, 1),
(670, 13, 49, 1),
(671, 13, 50, 1),
(672, 13, 51, 1),
(673, 13, 52, 1),
(674, 13, 53, 1),
(675, 13, 54, 1),
(676, 13, 55, 1),
(677, 13, 64, 1),
(678, 13, 65, 1),
(679, 13, 66, 1),
(680, 13, 67, 1),
(684, 13, 75, 1),
(685, 13, 76, 1),
(686, 13, 77, 1),
(687, 13, 78, 1),
(689, 13, 83, 1),
(690, 13, 84, 1),
(691, 13, 85, 1),
(692, 13, 86, 1),
(693, 13, 87, 1),
(695, 14, 1, 1),
(696, 14, 2, 1),
(697, 14, 3, 1),
(698, 14, 4, 1),
(699, 14, 5, 1),
(700, 14, 6, 1),
(701, 14, 7, 1),
(702, 14, 8, 1),
(703, 14, 9, 1),
(704, 14, 10, 1),
(705, 14, 11, 1),
(706, 14, 12, 1),
(707, 14, 13, 1),
(708, 14, 14, 1),
(709, 14, 15, 1),
(710, 14, 16, 1),
(711, 14, 17, 1),
(712, 14, 18, 1),
(713, 14, 19, 1),
(714, 14, 20, 1),
(715, 14, 21, 1),
(716, 14, 22, 1),
(717, 14, 23, 1),
(718, 14, 24, 1),
(719, 14, 25, 1),
(720, 14, 26, 1),
(721, 14, 27, 1),
(722, 14, 28, 1),
(723, 14, 29, 1),
(724, 14, 30, 1),
(725, 14, 31, 1),
(726, 14, 32, 1),
(727, 14, 33, 1),
(729, 14, 37, 1),
(730, 14, 41, 1),
(731, 14, 42, 1),
(732, 14, 43, 1),
(733, 14, 44, 1),
(734, 14, 45, 1),
(735, 14, 46, 1),
(736, 14, 47, 1),
(737, 14, 48, 1),
(738, 14, 49, 1),
(739, 14, 50, 1),
(740, 14, 51, 1),
(741, 14, 52, 1),
(742, 14, 53, 1),
(743, 14, 54, 1),
(744, 14, 55, 1),
(745, 14, 64, 1),
(746, 14, 65, 1),
(747, 14, 66, 1),
(748, 14, 67, 1),
(752, 14, 75, 1),
(753, 14, 76, 1),
(754, 14, 77, 1),
(755, 14, 78, 1),
(757, 14, 83, 1),
(758, 14, 84, 1),
(759, 14, 85, 1),
(760, 14, 86, 1),
(761, 14, 87, 1),
(762, 15, 1, 1),
(763, 15, 2, 1),
(764, 15, 3, 1),
(765, 15, 4, 1),
(766, 15, 5, 1),
(767, 15, 6, 1),
(768, 15, 7, 1),
(769, 15, 8, 1),
(770, 15, 9, 1),
(771, 15, 10, 1),
(772, 15, 11, 1),
(773, 15, 12, 1),
(774, 15, 13, 1),
(775, 15, 14, 1),
(776, 15, 15, 1),
(777, 15, 16, 1),
(778, 15, 17, 1),
(779, 15, 18, 1),
(780, 15, 19, 1),
(781, 15, 20, 1),
(782, 15, 21, 1),
(783, 15, 22, 1),
(784, 15, 23, 1),
(785, 15, 24, 1),
(786, 15, 25, 1),
(787, 15, 26, 1),
(788, 15, 27, 1),
(789, 15, 28, 1),
(790, 15, 29, 1),
(791, 15, 30, 1),
(792, 15, 31, 1),
(793, 15, 32, 1),
(794, 15, 33, 1),
(795, 15, 37, 1),
(796, 15, 41, 1),
(797, 15, 42, 1),
(798, 15, 43, 1),
(799, 15, 44, 1),
(800, 15, 45, 1),
(801, 15, 46, 1),
(802, 15, 47, 1),
(803, 15, 48, 1),
(804, 15, 49, 1),
(805, 15, 50, 1),
(806, 15, 51, 1),
(807, 15, 52, 1),
(808, 15, 53, 1),
(809, 15, 54, 1),
(810, 15, 55, 1),
(811, 15, 64, 1),
(812, 15, 65, 1),
(813, 15, 66, 1),
(814, 15, 67, 1),
(815, 15, 75, 1),
(816, 15, 76, 1),
(817, 15, 77, 1),
(818, 15, 78, 1),
(819, 15, 83, 1),
(820, 15, 84, 1),
(821, 15, 85, 1),
(822, 15, 86, 1),
(823, 15, 87, 1),
(871, 16, 1, 0),
(872, 16, 2, 0),
(873, 16, 3, 0),
(874, 16, 4, 0),
(875, 16, 5, 0),
(876, 16, 6, 0),
(877, 16, 7, 0),
(878, 16, 8, 0),
(879, 16, 9, 0),
(880, 16, 10, 0),
(881, 16, 11, 0),
(882, 16, 12, 0),
(883, 16, 13, 0),
(884, 16, 14, 0),
(885, 16, 15, 0),
(886, 16, 16, 0),
(887, 16, 17, 0),
(888, 16, 18, 0),
(889, 16, 19, 0),
(890, 16, 20, 0),
(891, 16, 21, 0),
(892, 16, 22, 0),
(893, 16, 23, 0),
(894, 16, 24, 0),
(895, 16, 25, 0),
(896, 16, 26, 0),
(897, 16, 27, 0),
(898, 16, 28, 0),
(899, 16, 29, 0),
(900, 16, 30, 0),
(901, 16, 31, 0),
(902, 16, 32, 0),
(903, 16, 33, 0),
(904, 16, 37, 0),
(905, 16, 41, 0),
(906, 16, 42, 0),
(907, 16, 43, 0),
(908, 16, 44, 0),
(909, 16, 45, 0),
(910, 16, 46, 0),
(911, 16, 47, 0),
(912, 16, 48, 0),
(913, 16, 49, 0),
(914, 16, 50, 0),
(915, 16, 51, 0),
(916, 16, 52, 0),
(917, 16, 53, 0),
(918, 16, 54, 0),
(919, 16, 55, 0),
(920, 16, 64, 0),
(921, 16, 65, 0),
(922, 16, 66, 0),
(923, 16, 67, 0),
(924, 16, 75, 0),
(925, 16, 76, 0),
(926, 16, 77, 0),
(927, 16, 78, 0),
(928, 16, 83, 0),
(929, 16, 84, 0),
(930, 16, 85, 0),
(931, 16, 86, 0),
(932, 16, 87, 0),
(1077, 12, 88, 1),
(1078, 12, 89, 1),
(1079, 12, 90, 1),
(1080, 12, 91, 1),
(1081, 13, 88, 1),
(1082, 13, 89, 1),
(1083, 13, 90, 1),
(1084, 13, 91, 1),
(1085, 14, 88, 1),
(1086, 14, 89, 1),
(1087, 14, 90, 1),
(1088, 14, 91, 1),
(1089, 15, 88, 1),
(1090, 15, 89, 1),
(1091, 15, 90, 1),
(1092, 15, 91, 1),
(1093, 16, 88, 1),
(1094, 16, 89, 1),
(1095, 16, 90, 1),
(1096, 16, 91, 1),
(1097, 17, 1, 1),
(1098, 17, 2, 1),
(1099, 17, 3, 1),
(1100, 17, 4, 1),
(1101, 17, 5, 1),
(1102, 17, 6, 1),
(1103, 17, 7, 1),
(1104, 17, 8, 1),
(1105, 17, 9, 1),
(1106, 17, 10, 1),
(1107, 17, 11, 1),
(1108, 17, 12, 1),
(1109, 17, 13, 1),
(1110, 17, 14, 1),
(1111, 17, 15, 1),
(1112, 17, 16, 1),
(1113, 17, 17, 1),
(1114, 17, 18, 1),
(1115, 17, 19, 1),
(1116, 17, 20, 1),
(1117, 17, 21, 1),
(1118, 17, 22, 1),
(1119, 17, 23, 1),
(1120, 17, 24, 1),
(1121, 17, 25, 1),
(1122, 17, 26, 1),
(1123, 17, 27, 1),
(1124, 17, 28, 1),
(1125, 17, 29, 1),
(1126, 17, 30, 1),
(1127, 17, 31, 1),
(1128, 17, 32, 1),
(1129, 17, 33, 1),
(1130, 17, 37, 1),
(1131, 17, 41, 1),
(1132, 17, 42, 1),
(1133, 17, 43, 1),
(1134, 17, 44, 1),
(1135, 17, 45, 1),
(1136, 17, 46, 1),
(1137, 17, 47, 1),
(1138, 17, 48, 1),
(1139, 17, 49, 1),
(1140, 17, 50, 1),
(1141, 17, 51, 1),
(1142, 17, 52, 1),
(1143, 17, 53, 1),
(1144, 17, 54, 1),
(1145, 17, 55, 1),
(1146, 17, 64, 1),
(1147, 17, 65, 1),
(1148, 17, 66, 1),
(1149, 17, 67, 1),
(1150, 17, 75, 1),
(1151, 17, 76, 1),
(1152, 17, 77, 1),
(1153, 17, 78, 1),
(1154, 17, 83, 1),
(1155, 17, 84, 1),
(1156, 17, 85, 1),
(1157, 17, 86, 1),
(1158, 17, 87, 1),
(1159, 17, 88, 1),
(1160, 17, 89, 1),
(1161, 17, 90, 1),
(1162, 17, 91, 1),
(1163, 18, 1, 1),
(1164, 18, 2, 1),
(1165, 18, 3, 1),
(1166, 18, 4, 1),
(1167, 18, 5, 1),
(1168, 18, 6, 1),
(1169, 18, 7, 1),
(1170, 18, 8, 1),
(1171, 18, 9, 1),
(1172, 18, 10, 1),
(1173, 18, 11, 1),
(1174, 18, 12, 1),
(1175, 18, 13, 1),
(1176, 18, 14, 1),
(1177, 18, 15, 1),
(1178, 18, 16, 1),
(1179, 18, 17, 1),
(1180, 18, 18, 1),
(1181, 18, 19, 1),
(1182, 18, 20, 1),
(1183, 18, 21, 1),
(1184, 18, 22, 1),
(1185, 18, 23, 1),
(1186, 18, 24, 1),
(1187, 18, 25, 1),
(1188, 18, 26, 1),
(1189, 18, 27, 1),
(1190, 18, 28, 1),
(1191, 18, 29, 1),
(1192, 18, 30, 1),
(1193, 18, 31, 1),
(1194, 18, 32, 1),
(1195, 18, 33, 1),
(1196, 18, 37, 1),
(1197, 18, 41, 1),
(1198, 18, 42, 1),
(1199, 18, 43, 1),
(1200, 18, 44, 1),
(1201, 18, 45, 1),
(1202, 18, 46, 1),
(1203, 18, 47, 1),
(1204, 18, 48, 1),
(1205, 18, 49, 1),
(1206, 18, 50, 1),
(1207, 18, 51, 1),
(1208, 18, 52, 1),
(1209, 18, 53, 1),
(1210, 18, 54, 1),
(1211, 18, 55, 1),
(1212, 18, 64, 1),
(1213, 18, 65, 1),
(1214, 18, 66, 1),
(1215, 18, 67, 1),
(1216, 18, 75, 1),
(1217, 18, 76, 1),
(1218, 18, 77, 1),
(1219, 18, 78, 1),
(1220, 18, 83, 1),
(1221, 18, 84, 1),
(1222, 18, 85, 1),
(1223, 18, 86, 1),
(1224, 18, 87, 1),
(1225, 18, 88, 1),
(1226, 18, 89, 1),
(1227, 18, 90, 1),
(1228, 18, 91, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aplicaciones`
--

CREATE TABLE `aplicaciones` (
  `id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `licencia` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `version` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `equipo_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `aplicaciones`
--

INSERT INTO `aplicaciones` (`id`, `descripcion`, `licencia`, `version`, `status`, `equipo_id`) VALUES
(1, 'MICROSOFT WINDOWS', '123-klklk-12121', '10', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(10) UNSIGNED NOT NULL,
  `departamento_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auxiliares`
--

CREATE TABLE `auxiliares` (
  `id` int(10) UNSIGNED NOT NULL,
  `ultimo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacoras`
--

CREATE TABLE `bitacoras` (
  `id` int(10) UNSIGNED NOT NULL,
  `usuario` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `accion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `registro_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ventana` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `detalles` varchar(400) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `bitacoras`
--

INSERT INTO `bitacoras` (`id`, `usuario`, `accion`, `created_at`, `updated_at`, `registro_id`, `ventana`, `detalles`) VALUES
(1, 'VINCEN SANTAELLA', 'Modificar Perfil', '2017-12-23 00:06:48', '2017-12-23 00:06:48', '12', 'Perfil -> Modificar Perfil', '{"DESCRIPCION":"ACTUALIZADO_ -> ACTUALIZADO"}'),
(2, 'VINCEN SANTAELLA', 'Cambiar Status', '2017-12-23 00:07:05', '2017-12-23 00:07:05', '12', 'Perfil', '{"status":"1 -> 0"}'),
(3, 'VINCEN SANTAELLA', 'Modificar Plan', '2017-12-23 00:09:07', '2017-12-23 00:09:07', '5', 'Planes -> Modificar Plan', '{"NOMBREP":"BASICO 1 -> BASICO 2"}'),
(4, 'VINCEN SANTAELLA', 'Cambiar Status', '2017-12-23 00:09:17', '2017-12-23 00:09:17', '5', 'Planes', '{"status":"0 -> 1"}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE `cargos` (
  `id` int(10) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `descripcion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `area_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `cliente_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `status`, `cliente_id`) VALUES
(3, 'BLUE-3', 1, 6),
(4, 'EPIC', 1, 6),
(5, 'NUEVO', 1, 6),
(6, 'NUEVA CATEGORIA', 1, 15),
(7, 'NUEVA CATEGORIA', 1, 6),
(8, 'INTERCOTTON cascada', 1, 6),
(9, 'POLAR MARGARITA', 1, 18),
(10, 'POLAR PARIAGUAN', 1, 18),
(11, 'NUEVA', 1, 6),
(12, 'GHGH', 1, 6),
(13, 'BLUE-2', 1, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_persona`
--

CREATE TABLE `categoria_persona` (
  `id` int(10) UNSIGNED NOT NULL,
  `categoria_id` int(10) UNSIGNED NOT NULL,
  `persona_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `categoria_persona`
--

INSERT INTO `categoria_persona` (`id`, `categoria_id`, `persona_id`) VALUES
(5, 3, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cedulas`
--

CREATE TABLE `cedulas` (
  `id` int(10) UNSIGNED NOT NULL,
  `numero` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `rol` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `tipo_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `cedulas`
--

INSERT INTO `cedulas` (`id`, `numero`, `rol`, `tipo_id`) VALUES
(1, '123', 'empleado', 14),
(2, '19438777', '', 14),
(3, '18235312', '', 14),
(4, '20457035', '', 14),
(6, '147896', '', 15),
(7, '1478523', '', 14),
(8, '1478523', '', 14),
(9, '1478523', '', 14),
(10, '1478523', '', 14),
(11, '1478523', '', 14),
(12, '1478523', '', 14),
(13, '17849', '', 14),
(14, '4546546562226', '', 15),
(15, '45456321', '', 14),
(16, '19438374', '', 14),
(17, '14789523', '', 14),
(18, '19500074', '', 14),
(19, '32546565', '', 14),
(20, '123123456', '', 14),
(21, '11111111', '', 14),
(22, '11111111', '', 0),
(23, '11111111', '', 1),
(24, '11111111', '', 14),
(25, '564', 'empleado', 14),
(26, '54645456', 'empleado', 14),
(27, '786786', 'empleado', 14),
(28, '67867', 'empleado', 14),
(29, '35498465', 'empleado', 14),
(30, '213213213212', 'empleado', 14),
(31, '19437386', 'cliente', 14),
(32, '19438374', 'cliente', 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(10) UNSIGNED NOT NULL,
  `razon_s` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nombre_c` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `rif_id` int(10) UNSIGNED NOT NULL,
  `tipo_id` int(10) UNSIGNED NOT NULL,
  `direccion_id` int(10) UNSIGNED NOT NULL,
  `direccion__id` int(10) UNSIGNED NOT NULL,
  `contacto_id` int(10) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `razon_s`, `nombre_c`, `rif_id`, `tipo_id`, `direccion_id`, `direccion__id`, `contacto_id`, `status`) VALUES
(6, 'XC2', 'xc2', 40, 13, 50, 51, 30, 0),
(14, 'solincamfer', 'PDVSA CABRUTICA', 48, 13, 66, 67, 50, 1),
(15, 'SANDIEGO', 'Solincamfer', 49, 13, 68, 69, 51, 1),
(16, 'PDVSA', 'empresa 1', 50, 13, 70, 71, 52, 1),
(17, 'XC#', 'XC2', 51, 12, 72, 73, 53, 0),
(18, '1121211', 'polar S.A', 52, 13, 74, 75, 57, 0),
(19, 'deded', 'edede', 54, 13, 78, 79, 63, 0),
(20, 'hdlgr', 'hdjgr', 61, 12, 86, 87, 70, 0),
(21, 'sasas', 'asasas', 62, 12, 88, 89, 72, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `componentes`
--

CREATE TABLE `componentes` (
  `id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `serial` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `marca` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `modelo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `equipo_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `componentes`
--

INSERT INTO `componentes` (`id`, `descripcion`, `serial`, `marca`, `modelo`, `status`, `equipo_id`) VALUES
(1, 'CPU', 'FP-00-99', 'HP', '1245', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos`
--

CREATE TABLE `contactos` (
  `id` int(10) UNSIGNED NOT NULL,
  `tipo_id` int(10) UNSIGNED NOT NULL,
  `tipo__id` int(10) UNSIGNED NOT NULL,
  `telefono_m` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `telefono_f` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `correo` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `contactos`
--

INSERT INTO `contactos` (`id`, `tipo_id`, `tipo__id`, `telefono_m`, `telefono_f`, `correo`) VALUES
(1, 6, 9, '185-1084', '259-36-93', ''),
(2, 6, 9, '886-9639', '789-541', ''),
(29, 10, 11, '1236985', '2587411', 'xc2@gmail.com'),
(30, 10, 11, '9999999', '2587411', 'xc2@gmail.com'),
(31, 9, 11, '8887777', '0000000', 'josetayupo@gmail.com'),
(32, 8, 11, '9996666', '1111111', 'vincensantaella@xc2.com'),
(33, 10, 11, '5555222', '2222222', 'ricardovirguez@xc2.com'),
(34, 6, 11, '4443331', '3333333', 'angeltoyo@xc2.com'),
(35, 8, 11, '1236547', '1234569', 'j@gmail'),
(36, 6, 11, '1236547', '1234567', 'j@gmail'),
(37, 7, 11, '1236547', '1234567', 'j@gmail'),
(38, 7, 11, '8153543', '1478569', 'josetayupo@gmail.com'),
(39, 8, 11, '1236547', '1234567', 'josetayupo@gmail.com'),
(40, 6, 11, '1478523', '147852', 'juan@gmail.com'),
(41, 6, 11, '1478523', '147852', 'juan@gmail.com'),
(42, 6, 11, '1478523', '147852', 'juan@gmail.com'),
(43, 6, 11, '7894563', '1478955', 'ronald@gmail.com'),
(44, 7, 11, '867654', '6768425', 'vinras@gmail.com'),
(45, 7, 11, '7894562', '1234569', 'guiller@gmail.com'),
(46, 7, 11, '1478963', '1234569', 'josetayupo@gmail.com'),
(47, 8, 11, '1478523', '1478523', 'jean@gmail.com'),
(48, 7, 11, '7894562', '7894563', 'empresa1@gmail.com'),
(49, 7, 11, '7894562', '1478523', 'empresa2@gmail.com'),
(50, 7, 11, '1245636', '1234569', 'pdvsajunin@gmail.com'),
(51, 6, 11, '8888888', '7878787', 'SANDIEGO@gmail.com'),
(52, 6, 11, '1234561', '1234564', 'empresa1@gmail.com'),
(53, 8, 11, '1236547', '1234568', 'google@gmail.com'),
(54, 8, 11, '1111104', '2222222', 'coperativa@gmail.com'),
(55, 7, 11, '9879785', '5646555', 'asd@lmdkl'),
(56, 7, 11, '1234567', '1234567', 'moises@gmail.com'),
(57, 7, 11, '1234567', '1234567', 'polar@gmail.com'),
(58, 6, 11, '1111111', '1111111', 'mari@gmail.com'),
(59, 7, 11, '3333333', '1233333', 'cochano@gmail.com'),
(60, 6, 11, '1111111', '1111111', 'mami@gmail.com'),
(61, 1, 1, '1111111', '1111111', 'nadixa@gmail.com'),
(62, 7, 11, '1111111', '1111111', 'guiller@gmail.com'),
(63, 7, 11, '1111111', '1111111', 'josetayupo@gmail.com'),
(64, 11, 7, '23423', '23432', 'fgdfgd'),
(65, 11, 6, '04564', '123123', 'vincenlasd'),
(66, 11, 6, '04564', '123123', 'vincenlasd'),
(67, 11, 6, '04564', '123123', 'vincenlasd'),
(68, 11, 6, '5984651', '6549541', 'vincenasf '),
(69, 11, 6, '313213', '15321', 'cskllcksklc@gmail.com'),
(70, 6, 11, '2364589', '7897898', 'hdlgr@gmail.com'),
(71, 7, 11, '1851084', '1851084', 'naicelispulido@gmail.com'),
(72, 7, 11, '7851235', '7894565', 'asasas@gmail.com'),
(73, 6, 11, '8153543', '7894523', 'josetayupo@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `id` int(10) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `director_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`id`, `status`, `descripcion`, `director_id`) VALUES
(81, 1, 'RRHH', 1),
(82, 1, 'DESARROLLO', 1),
(83, 1, 'SOFTWARE', 1),
(84, 1, 'HARDWARE', 1),
(85, 1, 'INFRAESTRUCTURA', 1),
(86, 1, 'COMPRAS', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direcciones`
--

CREATE TABLE `direcciones` (
  `id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `municipio_id` int(10) UNSIGNED NOT NULL,
  `pais_id` int(10) UNSIGNED NOT NULL,
  `region_id` int(10) UNSIGNED NOT NULL,
  `estado_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `direcciones`
--

INSERT INTO `direcciones` (`id`, `descripcion`, `municipio_id`, `pais_id`, `region_id`, `estado_id`) VALUES
(2, 'vcvcvcvccv', 5, 1, 2, 6),
(3, 'HJHJHHJJ', 10, 1, 3, 9),
(4, 'klklkkkl', 7, 1, 3, 11),
(5, 'fvfvfvfvfv', 7, 1, 3, 11),
(6, 'sasasasas', 220, 1, 5, 21),
(7, 'sasasasas', 220, 1, 5, 21),
(8, 'sasasasas', 220, 1, 5, 21),
(9, 'sasasasas', 220, 1, 5, 21),
(11, 'sasasasas', 220, 1, 5, 21),
(13, 'sasasasas', 220, 1, 5, 21),
(15, 'sasasasas', 220, 1, 5, 21),
(17, 'sasasasas', 220, 1, 5, 21),
(19, 'sasasasas', 220, 1, 5, 21),
(21, 'sasasasas', 220, 1, 5, 21),
(23, 'sasasasas', 220, 1, 5, 21),
(25, 'asasasasasasasa', 220, 1, 1, 6),
(27, 'sasasasasas', 333, 1, 4, 27),
(29, 'asasasasasasas', 87, 1, 5, 6),
(31, 'asasasasasasas', 347, 1, 6, 27),
(32, 'asasasasas', 197, 1, 3, 6),
(34, 'asasasasas', 197, 1, 3, 6),
(36, 'asasasasas', 197, 1, 3, 6),
(38, 'hghghghgh', 312, 1, 3, 5),
(40, 'hghghghgh', 312, 1, 3, 5),
(42, 'asasasasas', 197, 1, 5, 6),
(44, 'asasasasas', 220, 1, 5, 21),
(45, '0', 64, 1, 5, 12),
(46, 'torre banco lara', 1, 1, 1, 2),
(47, '0', 1, 1, 1, 2),
(48, 'panamericana', 64, 1, 1, 2),
(49, '0', 1, 1, 1, 2),
(50, 'El tikgre', 1, 1, 1, 2),
(51, 'San jose de guanipa', 329, 1, 5, 16),
(52, 'nsanmsansnamnsansmnansas', 1, 1, 1, 2),
(53, '0', 1, 1, 1, 2),
(54, 'asasasasa', 44, 1, 3, 6),
(55, '0', 166, 1, 2, 9),
(56, 'sdsdsdsdsd', 1, 1, 1, 2),
(57, '0', 165, 1, 2, 9),
(58, 'asasasasasas', 212, 1, 4, 14),
(59, '0', 166, 1, 2, 9),
(60, 'asasasasas', 1, 1, 1, 2),
(61, '0', 166, 1, 2, 9),
(62, 'direcccion 1', 316, 1, 5, 16),
(63, '0', 167, 1, 2, 9),
(64, 'direccion 2', 166, 1, 2, 9),
(65, '0', 44, 1, 3, 6),
(66, 'san diego', 107, 1, 4, 12),
(67, '0', 96, 1, 4, 12),
(68, 'CHACAO AV LIBERTADOR', 166, 1, 2, 9),
(69, 'LEBRUN', 166, 1, 2, 9),
(70, 'PDVSA', 10, 1, 2, 10),
(71, 'PDVSA', 1, 1, 1, 2),
(72, 'Mapire', 2, 1, 1, 2),
(73, 'Pariaguan\r\n', 2, 1, 1, 2),
(74, 'direccion 2', 221, 1, 2, 10),
(75, 'direccion 1', 81, 1, 2, 8),
(76, 'el manguito', 107, 1, 4, 12),
(77, '''parigasas', 57, 1, 3, 7),
(78, 'errere', 166, 1, 2, 9),
(79, 'wrwwrw', 165, 1, 2, 9),
(80, 'sdsd', 5, 1, 1, 3),
(81, 'vincen@asdkasd', 198, 1, 4, 13),
(82, 'vincen@asdkasd', 198, 1, 4, 13),
(83, 'vincen@asdkasd', 198, 1, 4, 13),
(84, 'jkhu iuiuh', 323, 1, 5, 16),
(85, 'Los teques', 11, 1, 1, 3),
(86, '789897778787878787878787878778787', 1, 1, 1, 2),
(87, '7898777', 82, 1, 2, 8),
(88, 'asasasas', 166, 1, 2, 9),
(89, 'asasasasasas', 1, 1, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `directores`
--

CREATE TABLE `directores` (
  `id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `directores`
--

INSERT INTO `directores` (`id`, `descripcion`, `status`) VALUES
(1, 'Operaciones', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ecomponentes`
--

CREATE TABLE `ecomponentes` (
  `id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `ecomponentes`
--

INSERT INTO `ecomponentes` (`id`, `descripcion`) VALUES
(1, 'CPU'),
(2, 'MONITOR'),
(9, 'TECLADO'),
(10, 'VIDRIO'),
(11, 'PIEZA1'),
(12, 'PIEZA2'),
(13, 'PIEZA3'),
(14, 'PIEZA5'),
(16, 'NUEVA'),
(17, 'CORNETA'),
(19, 'PIEZAS'),
(20, 'NUEVO'),
(21, 'DISCO DURO'),
(22, 'LALA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ecomponente_epieza`
--

CREATE TABLE `ecomponente_epieza` (
  `id` int(10) UNSIGNED NOT NULL,
  `ecomponente_id` int(10) UNSIGNED NOT NULL,
  `epieza_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `ecomponente_epieza`
--

INSERT INTO `ecomponente_epieza` (`id`, `ecomponente_id`, `epieza_id`) VALUES
(2, 1, 2),
(3, 22, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ecomponente_tequipo`
--

CREATE TABLE `ecomponente_tequipo` (
  `id` int(10) UNSIGNED NOT NULL,
  `ecomponente_id` int(10) UNSIGNED NOT NULL,
  `tequipo_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `ecomponente_tequipo`
--

INSERT INTO `ecomponente_tequipo` (`id`, `ecomponente_id`, `tequipo_id`) VALUES
(2, 1, 1),
(9, 2, 1),
(11, 9, 1),
(12, 10, 16),
(13, 11, 7),
(14, 12, 7),
(15, 13, 7),
(16, 14, 7),
(18, 16, 16),
(19, 17, 13),
(21, 19, 13),
(22, 20, 3),
(23, 21, 20),
(24, 22, 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `emarcas`
--

CREATE TABLE `emarcas` (
  `id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `emodelos`
--

CREATE TABLE `emodelos` (
  `id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nombre_` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `apellido_` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `fechaN` date NOT NULL,
  `cedula_id` int(10) UNSIGNED NOT NULL,
  `rif_id` int(10) UNSIGNED NOT NULL,
  `departamento_id` int(10) UNSIGNED NOT NULL,
  `cargo_id` int(10) UNSIGNED NOT NULL,
  `direccion_id` int(10) UNSIGNED NOT NULL,
  `contacto_id` int(10) UNSIGNED NOT NULL,
  `usuario_id` int(10) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id`, `nombre`, `nombre_`, `apellido`, `apellido_`, `fechaN`, `cedula_id`, `rif_id`, `departamento_id`, `cargo_id`, `direccion_id`, `contacto_id`, `usuario_id`, `status`) VALUES
(1, 'VINCEN', 'JOEL', 'SANTAELLA', 'MOLINA', '2003-05-21', 1, 1, 69, 1, 2, 32, 1, 0),
(2, 'JOSE', 'ALBERTO', 'TAYUPO', 'GUZMAN', '1989-10-09', 1, 1, 69, 1, 2, 32, 4, 1),
(3, 'SUPER USUARIO', ' ', 'PSAD', ' ', '1989-10-09', 1, 1, 69, 1, 2, 32, 5, 1),
(4, 'yoel', 'asd', 'sdfsdfwrt', 'gdfgdfg', '2017-01-12', 28, 58, 69, 1, 83, 67, 6, 1),
(5, 'Nuevo', 'nuevo', 'Empleado', 'nuevo', '2017-01-26', 29, 59, 69, 1, 84, 68, 7, 1),
(6, 'Carlos', 'Eduardo', 'Ceballos', 'Campo', '2017-07-07', 30, 60, 69, 1, 85, 69, 8, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `epiezas`
--

CREATE TABLE `epiezas` (
  `id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `epiezas`
--

INSERT INTO `epiezas` (`id`, `descripcion`, `status`) VALUES
(2, 'MEMORIA RAM', 0),
(3, 'ASASAS', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE `equipos` (
  `id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tipo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `marca` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `modelo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `serial` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `sucursal_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`id`, `descripcion`, `tipo`, `marca`, `modelo`, `serial`, `status`, `sucursal_id`) VALUES
(1, 'PC ADMINISTRATIVO', 'DESKTOP', 'HP', '123', 'FP-00-11-123456', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo_marca`
--

CREATE TABLE `equipo_marca` (
  `id` int(10) UNSIGNED NOT NULL,
  `tequipo_id` int(10) UNSIGNED NOT NULL,
  `emarca_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo_modelo`
--

CREATE TABLE `equipo_modelo` (
  `id` int(10) UNSIGNED NOT NULL,
  `tequipo_id` int(10) UNSIGNED NOT NULL,
  `emodelo_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `region_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id`, `descripcion`, `region_id`) VALUES
(2, 'Dtto. Capital', 1),
(3, 'Miranda', 1),
(4, 'Vargas', 1),
(5, 'Aragua', 3),
(6, 'Carabobo', 3),
(7, 'Cojedes', 3),
(8, 'Falcon', 2),
(9, 'Lara', 2),
(10, 'Portuguesa', 2),
(11, 'Yaracuy', 2),
(12, 'Anzoategui', 4),
(13, 'Monagas', 4),
(14, 'Nueva Esparta', 4),
(15, 'Sucre', 4),
(16, 'Zulia', 5),
(19, 'Apure', 6),
(20, 'Guarico', 6),
(21, 'Barinas', 7),
(22, 'Merida', 7),
(23, 'Tachira', 7),
(24, 'Trujillo', 7),
(25, 'Amazonas', 8),
(26, 'Bolivar', 8),
(27, 'Delta Amacuro', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `plan_id` int(10) UNSIGNED NOT NULL,
  `horaI` time NOT NULL,
  `horaF` time NOT NULL,
  `diaI` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `diaF` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `precio` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`id`, `plan_id`, `horaI`, `horaF`, `diaI`, `diaF`, `precio`) VALUES
(3, 6, '08:00:00', '19:30:00', 'Lunes', 'Sabado', 1624),
(4, 8, '18:00:00', '00:00:00', 'Miercoles', 'Sabado', 64),
(7, 5, '08:00:00', '17:00:00', 'Lunes', 'Viernes', 1),
(8, 9, '01:01:00', '02:00:00', 'Martes', 'Lunes', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca_modelo`
--

CREATE TABLE `marca_modelo` (
  `id` int(10) UNSIGNED NOT NULL,
  `emarca_id` int(10) UNSIGNED NOT NULL,
  `emodelo_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2016_11_13_002045_CrearTablaPerfiles', 1),
(2, '2016_11_13_002344_CrearTablaUsuarios', 2),
(3, '2016_11_13_002819_CrearTablaModulos', 3),
(4, '2016_11_13_003246_CrearTablaSubmoodulos', 4),
(6, '2016_11_13_003901_TablaModuloPerfil', 6),
(7, '2016_11_13_004126_TablaPerfilSubmodulo', 7),
(8, '2016_11_13_004303_TablaAccionPerfil', 8),
(9, '2016_11_13_004641_TablaDepartamentos', 9),
(10, '2016_11_13_004935_TablaCargos', 10),
(12, '2016_11_14_184308_CrearTablaPais', 12),
(13, '2016_11_14_184554_CrearTablRegiones', 13),
(14, '2016_11_14_184923_CrearTablaEstados', 14),
(15, '2016_11_14_190523_CrearTablaMunicipios', 15),
(17, '2016_11_14_191008_CrearTablaDirecciones', 16),
(18, '2016_11_21_160318_CrearTablaTipos', 17),
(19, '2016_11_21_164932_CrearTablaRifs', 18),
(20, '2016_11_21_165812_CrearTablaContactos', 19),
(21, '2016_11_21_170931_CrarTablaClienteMatriz', 20),
(22, '2016_11_23_183042_CrearTablaCedulas', 21),
(23, '2016_11_23_183402_CrearTablaPersonas', 22),
(24, '2016_11_23_212749_CrearTablaCategorias', 23),
(25, '2016_11_23_213401_TablaCategoriaPersona', 24),
(27, '2016_11_26_191951_CrearCampoStatusClientes', 25),
(28, '2016_11_26_192936_CrearCampoStatusParaResponsables', 26),
(30, '2016_11_26_193322_CampoStatusCategorias', 27),
(31, '2016_11_27_184917_CambiarTablaCategorias', 27),
(33, '2016_11_30_184036_CrearTablaSucursales', 28),
(34, '2017_01_04_154040_CrearTablaPlanes', 29),
(35, '2017_01_04_155202_ServHorario', 30),
(37, '2017_01_04_163426_ServSoportePres', 31),
(38, '2017_01_04_164258_ServSoporRemt', 31),
(39, '2017_01_04_164706_ServSoporTele', 32),
(41, '2017_01_04_164836_ServTiemporesp', 33),
(47, '2016_11_13_003615_CrearTablaAcciones', 34),
(54, '2017_01_12_151621_CrearTablaTequipos', 35),
(55, '2017_01_12_151928_CrearTablaEmarcas', 35),
(56, '2017_01_12_152050_CrearTablaEmodelos', 35),
(57, '2017_01_12_152244_CrearTablaEquiposMmarca', 35),
(58, '2017_01_12_155539_CrearTablaMarcaModelo', 35),
(59, '2017_01_12_160344_CrearTablaEequipoModelo', 35),
(60, '2017_01_13_185204_CrearTablaAuxiliar', 35),
(61, '2017_01_13_200839_CrearTablaComponentesE', 35),
(62, '2017_01_13_201912_TipoEquipoComponente', 35),
(63, '2017_01_13_202818_CrearTablaPiezas', 35),
(64, '2017_01_13_203257_CrearTablaConponentePieza', 35),
(65, '2017_01_16_194812_EmpledosTabla', 36),
(67, '2017_01_19_193504_CrearTablaEquipos', 37),
(68, '2017_01_19_195559_CrearTablaComponentes', 37),
(69, '2017_01_19_201439_CrearTablaAplicaciones', 38),
(70, '2017_01_19_202450_PiezasTabla', 39),
(71, '2017_01_20_060539_TablaPlanSucursal', 40),
(72, '2017_06_07_135919_TablaPersonaSucursal', 41),
(73, '2017_12_18_185024_CrearTablaDirectores', 42),
(74, '2017_12_18_194627_CrearTablaAreas', 43),
(75, '2017_12_18_194907_addForeignKeyCargos', 44),
(76, '2017_12_18_220820_CreateForeignAreas', 45),
(77, '2017_12_18_221641_CreateForeignCargos', 46),
(78, '2017_12_19_131022_CreateForeignDepartamentos', 47),
(79, '2017_12_18_182721_tablaBitacora', 48);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos`
--

CREATE TABLE `modulos` (
  `id` int(10) UNSIGNED NOT NULL,
  `status_m` int(11) NOT NULL DEFAULT '0',
  `descripcion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `modulos`
--

INSERT INTO `modulos` (`id`, `status_m`, `descripcion`, `url`) VALUES
(1, 1, 'Registros Basicos', ' '),
(2, 1, 'HelpDesk', ' '),
(3, 1, 'Estadisticas', ' ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo_perfil`
--

CREATE TABLE `modulo_perfil` (
  `id` int(10) UNSIGNED NOT NULL,
  `perfil_id` int(10) UNSIGNED NOT NULL,
  `modulo_id` int(10) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `modulo_perfil`
--

INSERT INTO `modulo_perfil` (`id`, `perfil_id`, `modulo_id`, `status`) VALUES
(25, 12, 1, 1),
(26, 12, 2, 0),
(27, 12, 3, 0),
(28, 13, 1, 1),
(29, 13, 2, 1),
(30, 13, 3, 1),
(31, 14, 1, 1),
(32, 14, 2, 0),
(33, 14, 3, 0),
(34, 15, 1, 1),
(35, 15, 2, 1),
(36, 15, 3, 1),
(37, 16, 1, 0),
(38, 16, 2, 0),
(39, 16, 3, 0),
(40, 17, 1, 1),
(41, 17, 2, 1),
(42, 17, 3, 1),
(43, 18, 1, 1),
(44, 18, 2, 1),
(45, 18, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipios`
--

CREATE TABLE `municipios` (
  `id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `estado_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `municipios`
--

INSERT INTO `municipios` (`id`, `descripcion`, `estado_id`) VALUES
(1, 'Libertador', 2),
(2, 'Acevedo', 3),
(3, 'Andrés Bello', 3),
(4, 'Baruta', 3),
(5, 'Brión', 3),
(6, 'Buroz', 3),
(7, 'Carrizal', 3),
(8, 'Chacao', 3),
(9, 'Cristóbal Rojas', 3),
(10, 'El Hatillo', 3),
(11, 'Guaicaipuro', 3),
(12, 'Independencia', 3),
(13, 'Lander', 3),
(14, 'Los Salias', 3),
(15, 'Los Páez', 3),
(16, 'Paz Castillo', 3),
(17, 'Pedro Gual', 3),
(18, 'Plaza', 3),
(19, 'Simón Bolívar', 3),
(20, 'Sucre', 3),
(21, 'Urdaneta', 3),
(22, 'Zamora', 3),
(23, 'Vargas', 4),
(24, 'Bolívar', 5),
(25, 'Camatagua', 5),
(26, 'Francisco Linares Alcántara', 5),
(27, 'Girardot', 5),
(28, 'José Angel Lamas', 5),
(29, 'José Félix Ribas', 5),
(30, 'José Rafael Revenga', 5),
(31, 'Libertador', 5),
(32, 'Mario Briceño Iragorry', 5),
(33, 'Ocumare de La Costa de Oro', 5),
(34, 'San Casimiro', 5),
(35, 'San Sebastián', 5),
(36, 'Santiago Mariño', 5),
(37, 'Santos Michelena', 5),
(38, 'Sucre', 5),
(39, 'Tovar', 5),
(40, 'Urdaneta', 5),
(41, 'Zamora', 5),
(42, 'Bejuma', 6),
(43, 'Carlos Arvelo', 6),
(44, 'Diego Ibarra', 6),
(45, 'Guacara', 6),
(46, 'Juan Jose Mora', 6),
(47, 'Libertador', 6),
(48, 'Los Guayos', 6),
(49, 'Miranda', 6),
(50, 'Montalban', 6),
(51, 'Naguanagua', 6),
(52, 'Puerto Cabello', 6),
(53, 'San Diego', 6),
(54, 'San Joaquin', 6),
(55, 'Valencia', 6),
(56, 'Anzoategui', 7),
(57, 'Falcon', 7),
(58, 'Girardot', 7),
(59, 'Lima Blanco', 7),
(60, 'Pao de San Juan Bautista', 7),
(61, 'Ricaurte', 7),
(62, 'Romulo Gallegos', 7),
(63, 'San Carlos', 7),
(64, 'Acosta', 8),
(65, 'Bolívar', 8),
(66, 'Buchivacoa', 8),
(67, 'Cacique Manaure', 8),
(68, 'Carirubana', 8),
(69, 'Colina', 8),
(70, 'Dabajuro', 8),
(71, 'Democracia', 8),
(72, 'Falcon', 8),
(73, 'Federacion', 8),
(74, 'Jacura', 8),
(75, 'Los Taques', 8),
(76, 'Mauroa', 8),
(77, 'Miranda', 8),
(78, 'Monseñor Iturriza', 8),
(79, 'Palmasola', 8),
(80, 'Piritu', 8),
(81, 'San Francisco', 8),
(82, 'Silva', 8),
(83, 'Sucre', 8),
(84, 'Union', 8),
(85, 'Urumaco', 8),
(86, 'Zamora', 8),
(87, 'Alto Orinoco', 25),
(88, 'Atabapo', 25),
(89, 'Atures', 25),
(90, 'Autana', 25),
(91, 'Manapiare', 25),
(92, 'Maroa', 25),
(93, 'Río Negro', 25),
(94, 'Anaco', 12),
(95, 'Aragua', 12),
(96, 'Manuel Ezequiel Bruzual', 12),
(97, 'Diego Bautista Urbaneja', 12),
(98, 'Fernando Peñalver', 12),
(99, 'Francisco Del Carmen Carvajal', 12),
(100, 'General Sir Arthur McGregor', 12),
(101, 'Guanta', 12),
(102, 'Independencia', 12),
(103, 'José Gregorio Monagas', 12),
(104, 'Juan Antonio Sotillo', 12),
(105, 'Juan Manuel Cajigal', 12),
(106, 'Libertad', 12),
(107, 'Francisco de Miranda', 12),
(108, 'Pedro María Freites', 12),
(109, 'Píritu', 12),
(110, 'San José de Guanipa', 12),
(111, 'San Juan de Capistrano', 12),
(112, 'Santa Ana', 12),
(113, 'Simón Bolívar', 12),
(114, 'Simón Rodríguez', 12),
(115, 'Achaguas', 19),
(116, 'Biruaca', 19),
(117, 'Muñóz', 19),
(118, 'Páez', 19),
(119, 'Pedro Camejo', 19),
(120, 'Rómulo Gallegos', 19),
(121, 'San Fernando', 19),
(122, 'Alberto Arvelo Torrealba', 21),
(123, 'Andrés Eloy Blanco', 21),
(124, 'Antonio José de Sucre', 21),
(125, 'Arismendi', 21),
(126, 'Barinas', 21),
(127, 'Bolívar', 21),
(128, 'Cruz Paredes', 21),
(129, 'Ezequiel Zamora', 21),
(130, 'Obispos', 21),
(131, 'Pedraza', 21),
(132, 'Rojas', 21),
(133, 'Sosa', 21),
(134, 'Caroní', 26),
(135, 'Cedeño', 26),
(136, 'El Callao', 26),
(137, 'Gran Sabana', 26),
(138, 'Heres', 26),
(139, 'Piar', 26),
(140, 'Angostura (Raúl Leoni)', 26),
(141, 'Roscio', 26),
(142, 'Sifontes', 26),
(143, 'Sucre', 26),
(144, 'Padre Pedro Chien', 26),
(145, 'Antonio Díaz', 27),
(146, 'Casacoima', 27),
(147, 'Pedernales', 27),
(148, 'Tucupita', 27),
(149, 'Camaguán', 20),
(150, 'Chaguaramas', 20),
(151, 'El Socorro', 20),
(152, 'José Félix Ribas', 20),
(153, 'José Tadeo Monagas', 20),
(154, 'Juan Germán Roscio', 20),
(155, 'Julián Mellado', 20),
(156, 'Las Mercedes', 20),
(157, 'Leonardo Infante', 20),
(158, 'Pedro Zaraza', 20),
(159, 'Ortíz', 20),
(160, 'San Gerónimo de Guayabal', 20),
(161, 'San José de Guaribe', 20),
(162, 'Santa María de Ipire', 20),
(163, 'Sebastián Francisco de Miranda', 20),
(164, 'Andrés Eloy Blanco', 9),
(165, 'Crespo', 9),
(166, 'Iribarren', 9),
(167, 'Jiménez', 9),
(168, 'Morán', 9),
(169, 'Palavecino', 9),
(170, 'Simón Planas', 9),
(171, 'Torres', 9),
(172, 'Urdaneta', 9),
(173, 'Alberto Adriani', 22),
(174, 'Andrés Bello', 22),
(175, 'Antonio Pinto Salinas', 22),
(176, 'Aricagua', 22),
(177, 'Arzobispo Chacón', 22),
(178, 'Campo Elías', 22),
(179, 'Caracciolo Parra Olmedo', 22),
(180, 'Cardenal Quintero', 22),
(181, 'Guaraque', 22),
(182, 'Julio César Salas', 22),
(183, 'Justo Briceño', 22),
(184, 'Libertador', 22),
(185, 'Miranda', 22),
(186, 'Obispo Ramos de Lora', 22),
(187, 'Padre Noguera', 22),
(188, 'Pueblo Llano', 22),
(189, 'Rangel', 22),
(190, 'Rivas Dávila', 22),
(191, 'Santos Marquina', 22),
(192, 'Sucre', 22),
(193, 'Tovar', 22),
(194, 'Tulio Febres Cordero', 22),
(195, 'Zea', 22),
(196, 'Acosta', 13),
(197, 'Aguasay', 13),
(198, 'Bolívar', 13),
(199, 'Caripe', 13),
(200, 'Cedeño', 13),
(201, 'Ezequiel Zamora', 13),
(202, 'Libertador', 13),
(203, 'Maturín', 13),
(204, 'Piar', 13),
(205, 'Punceres', 13),
(206, 'Santa Bárbara', 13),
(207, 'Sotillo', 13),
(208, 'Uracoa', 13),
(209, 'Antolín del Campo', 14),
(210, 'Arismendi', 14),
(211, 'García', 14),
(212, 'Gómez', 14),
(213, 'Maneiro', 14),
(214, 'Marcano', 14),
(215, 'Mariño', 14),
(216, 'Península de Macanao', 14),
(217, 'Tubores', 14),
(218, 'Villalba', 14),
(219, 'Díaz', 14),
(220, 'Agua Blanca', 10),
(221, 'Araure', 10),
(222, 'Esteller', 10),
(223, 'Guanare', 10),
(224, 'Guanarito', 10),
(225, 'Monseñor José Vicente de Unda', 10),
(226, 'Ospino', 10),
(227, 'Páez', 10),
(228, 'Papelón', 10),
(229, 'San Genaro de Boconoíto', 10),
(230, 'San Rafael de Onoto', 10),
(231, 'Santa Rosalía', 10),
(232, 'Sucre', 10),
(233, 'Turén', 10),
(249, 'Andrés Bello', 23),
(250, 'Antonio Rómulo Costa', 23),
(251, 'Ayacucho', 23),
(252, 'Bolívar', 23),
(253, 'Cárdenas', 23),
(254, 'Córdoba', 23),
(255, 'Fernández Feo', 23),
(256, 'Francisco de Miranda', 23),
(257, 'García de Hevia', 23),
(258, 'Guásimos', 23),
(259, 'Independencia', 23),
(260, 'Jáuregui', 23),
(261, 'José María Vargas', 23),
(262, 'Junín', 23),
(263, 'Libertad', 23),
(264, 'Libertador', 23),
(265, 'Lobatera', 23),
(266, 'Michelena', 23),
(267, 'Panamericano', 23),
(268, 'Pedro María Ureña', 23),
(269, 'Rafael Urdaneta', 23),
(270, 'Samuel Darío Maldonado', 23),
(271, 'San Cristóbal', 23),
(272, 'Seboruco', 23),
(273, 'Simón Rodríguez', 23),
(274, 'Sucre', 23),
(275, 'Torbes', 23),
(276, 'Uribante', 23),
(277, 'San Judas Tadeo', 23),
(278, 'Andrés Bello', 24),
(279, 'Boconó', 24),
(280, 'Bolívar', 24),
(281, 'Candelaria', 24),
(282, 'Carache', 24),
(283, 'Escuque', 24),
(284, 'José Felipe Márquez Cañizalez', 24),
(285, 'Juan Vicente Campos Elías', 24),
(286, 'La Ceiba', 24),
(287, 'Miranda', 24),
(288, 'Monte Carmelo', 24),
(289, 'Motatán', 24),
(290, 'Pampán', 24),
(291, 'Pampanito', 24),
(292, 'Rafael Rangel', 24),
(293, 'San Rafael de Carvajal', 24),
(294, 'Sucre', 24),
(295, 'Trujillo', 24),
(296, 'Urdaneta', 24),
(297, 'Valera', 24),
(298, 'Arístides Bastidas', 11),
(299, 'Bolívar', 11),
(300, 'Bruzual', 11),
(301, 'Cocorote', 11),
(302, 'Independencia', 11),
(303, 'José Antonio Páez', 11),
(304, 'La Trinidad', 11),
(305, 'Manuel Monge', 11),
(306, 'Nirgua', 11),
(307, 'Peña', 11),
(308, 'San Felipe', 11),
(309, 'Sucre', 11),
(310, 'Urachiche', 11),
(311, 'José Joaquín Veroes', 11),
(312, 'Almirante Padilla', 16),
(313, 'Baralt', 16),
(314, 'Cabimas', 16),
(315, 'Catatumbo', 16),
(316, 'Colón', 16),
(317, 'Francisco Javier Pulgar', 16),
(318, 'Páez', 16),
(319, 'Jesús Enrique Losada', 16),
(320, 'Jesús María Semprún', 16),
(321, 'La Cañada de Urdaneta', 16),
(322, 'Lagunillas', 16),
(323, 'Machiques de Perijá', 16),
(324, 'Mara', 16),
(325, 'Maracaibo', 16),
(326, 'Miranda', 16),
(327, 'Rosario de Perijá', 16),
(328, 'San Francisco', 16),
(329, 'Santa Rita', 16),
(330, 'Simón Bolívar', 16),
(331, 'Sucre', 16),
(332, 'Valmore Rodríguez', 16),
(333, 'Andrés Eloy Blanco', 15),
(334, 'Andrés Mata', 15),
(335, 'Arismendi', 15),
(336, 'Benítez', 15),
(337, 'Bermúdez', 15),
(338, 'Bolívar', 15),
(339, 'Cajigal', 15),
(340, 'Cruz Salmerón Acosta', 15),
(341, 'Libertador', 15),
(342, 'Mariño', 15),
(343, 'Mejía', 15),
(344, 'Montes', 15),
(345, 'Ribero', 15),
(346, 'Sucre', 15),
(347, 'Valdéz', 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE `paises` (
  `id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `paises`
--

INSERT INTO `paises` (`id`, `descripcion`) VALUES
(1, 'Venezuela');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE `perfiles` (
  `id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`id`, `descripcion`, `status`) VALUES
(12, 'ACTUALIZADO', 0),
(13, 'SUPER USUARIO', 1),
(14, 'ADMINISTRADOR', 1),
(15, 'PRUEBA', 1),
(16, 'ESTANDAR', 0),
(17, 'PRUEBA 43', 1),
(18, 'ANALISTA 1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil_submodulo`
--

CREATE TABLE `perfil_submodulo` (
  `id` int(10) UNSIGNED NOT NULL,
  `perfil_id` int(10) UNSIGNED NOT NULL,
  `submodulo_id` int(10) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `perfil_submodulo`
--

INSERT INTO `perfil_submodulo` (`id`, `perfil_id`, `submodulo_id`, `status`) VALUES
(92, 12, 1, 1),
(93, 12, 2, 1),
(94, 12, 3, 1),
(95, 12, 4, 1),
(96, 12, 5, 1),
(97, 12, 6, 1),
(98, 12, 7, 1),
(99, 12, 10, 1),
(100, 12, 11, 1),
(101, 12, 12, 0),
(102, 13, 1, 1),
(103, 13, 2, 1),
(104, 13, 3, 1),
(105, 13, 4, 1),
(106, 13, 5, 1),
(107, 13, 6, 1),
(108, 13, 7, 1),
(109, 13, 10, 1),
(110, 13, 11, 1),
(111, 13, 12, 1),
(112, 14, 1, 1),
(113, 14, 2, 1),
(114, 14, 3, 1),
(115, 14, 4, 1),
(116, 14, 5, 1),
(117, 14, 6, 1),
(118, 14, 7, 1),
(119, 14, 10, 1),
(120, 14, 11, 1),
(121, 14, 12, 0),
(122, 15, 1, 1),
(123, 15, 2, 1),
(124, 15, 3, 1),
(125, 15, 4, 1),
(126, 15, 5, 1),
(127, 15, 6, 1),
(128, 15, 7, 1),
(129, 15, 10, 1),
(130, 15, 11, 1),
(131, 15, 12, 1),
(132, 16, 1, 1),
(133, 16, 2, 0),
(134, 16, 3, 0),
(135, 16, 4, 0),
(136, 16, 5, 0),
(137, 16, 6, 0),
(138, 16, 7, 0),
(139, 16, 10, 1),
(140, 16, 11, 0),
(141, 16, 12, 0),
(142, 17, 1, 1),
(143, 17, 2, 1),
(144, 17, 3, 1),
(145, 17, 4, 1),
(146, 17, 5, 1),
(147, 17, 6, 1),
(148, 17, 7, 1),
(149, 17, 10, 1),
(150, 17, 11, 1),
(151, 17, 12, 1),
(152, 18, 1, 1),
(153, 18, 2, 1),
(154, 18, 3, 1),
(155, 18, 4, 1),
(156, 18, 5, 1),
(157, 18, 6, 1),
(158, 18, 7, 1),
(159, 18, 10, 1),
(160, 18, 11, 1),
(161, 18, 12, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id` int(10) UNSIGNED NOT NULL,
  `p_nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `p_apellido` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `cargo` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `encargado` int(11) NOT NULL DEFAULT '0',
  `cedula_id` int(10) UNSIGNED NOT NULL,
  `contacto_id` int(10) UNSIGNED NOT NULL,
  `cliente_id` int(10) UNSIGNED NOT NULL,
  `statusR` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id`, `p_nombre`, `p_apellido`, `cargo`, `encargado`, `cedula_id`, `contacto_id`, `cliente_id`, `statusR`) VALUES
(1, 'Juan', 'Tayupo', 'programador backend', 0, 1, 31, 6, 1),
(2, 'V', 'Santaella', 'coordinador', 1, 2, 32, 6, 1),
(3, 'Ricardo', 'Virguez', 'Programador Front End', 0, 3, 33, 6, 0),
(4, 'Angel', 'Toyo', 'Programador Front End', 0, 4, 34, 6, 1),
(5, 'Juan Jose', 'Perez', '1', 0, 12, 42, 6, 0),
(6, 'Ronald ', 'Campo', '1', 0, 13, 43, 6, 0),
(12, 'vincen', 'Prueba', 'dasdas@dasda', 0, 19, 55, 17, 0),
(13, 'Moises', 'Guzman', 'gerente', 0, 20, 56, 6, 0),
(14, 'Coromoto', 'Guzman', 'cargo', 0, 21, 58, 6, 0),
(15, 'naicelis', 'pulido', 'coordinador', 0, 31, 71, 6, 0),
(16, 'Guiller', 'Alberto', 'supervisor', 0, 32, 73, 6, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona_sucursal`
--

CREATE TABLE `persona_sucursal` (
  `id` int(10) UNSIGNED NOT NULL,
  `sucursal_id` int(10) UNSIGNED NOT NULL,
  `persona_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `persona_sucursal`
--

INSERT INTO `persona_sucursal` (`id`, `sucursal_id`, `persona_id`) VALUES
(1, 2, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `piezas`
--

CREATE TABLE `piezas` (
  `id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `serial` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `marca` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `modelo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `componente_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `piezas`
--

INSERT INTO `piezas` (`id`, `descripcion`, `serial`, `marca`, `modelo`, `status`, `componente_id`) VALUES
(1, 'MEMORIA RAM', 'jjj-ll-00', 'CORSAIR', 'DDR2', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planes`
--

CREATE TABLE `planes` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombreP` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `descuento` int(10) UNSIGNED NOT NULL,
  `status` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `planes`
--

INSERT INTO `planes` (`id`, `nombreP`, `descuento`, `status`) VALUES
(5, 'BASICO 2', 50, 1),
(6, 'MEDIO', 0, 1),
(7, 'VIP', 0, 1),
(8, 'PEGATE CON TODO', 0, 1),
(9, 'NUEVA', 10, 1),
(10, 'NUEVA1', 10, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan_sucursal`
--

CREATE TABLE `plan_sucursal` (
  `id` int(10) UNSIGNED NOT NULL,
  `plan_id` int(10) UNSIGNED NOT NULL,
  `sucursal_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `plan_sucursal`
--

INSERT INTO `plan_sucursal` (`id`, `plan_id`, `sucursal_id`) VALUES
(1, 5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presenciales`
--

CREATE TABLE `presenciales` (
  `id` int(10) UNSIGNED NOT NULL,
  `plan_id` int(10) UNSIGNED NOT NULL,
  `etiqueta` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `valor` int(10) UNSIGNED NOT NULL,
  `precio` double(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `presenciales`
--

INSERT INTO `presenciales` (`id`, `plan_id`, `etiqueta`, `valor`, `precio`) VALUES
(3, 6, 'contabilizado', 20, 2000.00),
(4, 8, 'contabilizado', 50, 6000.00),
(5, 5, 'contabilizado', 10, 1500.00),
(6, 10, 'contabilizado', 1200, 1200.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `regiones`
--

CREATE TABLE `regiones` (
  `id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `pais_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `regiones`
--

INSERT INTO `regiones` (`id`, `descripcion`, `pais_id`) VALUES
(1, 'Capital', 1),
(2, 'Occidental', 1),
(3, 'Central', 1),
(4, 'Oriental', 1),
(5, 'Zulia', 1),
(6, 'Los Llanos', 1),
(7, 'Los Andes', 1),
(8, 'Guayana', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `remotos`
--

CREATE TABLE `remotos` (
  `id` int(10) UNSIGNED NOT NULL,
  `plan_id` int(10) UNSIGNED NOT NULL,
  `etiqueta` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `valor` int(10) UNSIGNED NOT NULL,
  `precio` double(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `remotos`
--

INSERT INTO `remotos` (`id`, `plan_id`, `etiqueta`, `valor`, `precio`) VALUES
(4, 6, 'contabilizado', 20, 2400.00),
(5, 8, 'contabilizado', 60, 6000.00),
(14, 5, 'contabilizado', 1, 1500.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE `respuestas` (
  `id` int(10) UNSIGNED NOT NULL,
  `plan_id` int(10) UNSIGNED NOT NULL,
  `maximo` int(10) UNSIGNED NOT NULL,
  `precio` double(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `respuestas`
--

INSERT INTO `respuestas` (`id`, `plan_id`, `maximo`, `precio`) VALUES
(3, 6, 2, 3200.00),
(4, 8, 1, 4500.00),
(7, 5, 7, 1500.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rifs`
--

CREATE TABLE `rifs` (
  `id` int(10) UNSIGNED NOT NULL,
  `numero` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `rol` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `tipo_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `rifs`
--

INSERT INTO `rifs` (`id`, `numero`, `rol`, `tipo_id`) VALUES
(1, '34567', '0', 1),
(2, '7892', 'empleado', 2),
(3, '1111111', '0', 1),
(4, '1111111', '0', 1),
(5, '1111111', '0', 1),
(6, '1111111', '0', 1),
(7, '1111111111', '0', 2),
(8, '5555555555', '0', 3),
(9, '1111111111', '0', 2),
(10, '1111111111', '0', 2),
(11, '1111111111', '0', 2),
(12, '1111111111', '0', 2),
(13, '1111111111', '0', 2),
(14, '1111111111', '0', 2),
(15, '1111111111', '0', 2),
(16, '3745899911', '0', 2),
(17, '3745899911', '0', 2),
(18, '3745899911', '0', 2),
(19, '3745899911', '0', 2),
(20, '3745899911', '0', 2),
(21, '3745899911', '0', 2),
(22, '3745899911', '0', 2),
(23, '3745899911', '0', 2),
(24, '3745899911', '0', 2),
(25, '3745899911', '0', 2),
(26, '3745899911', '0', 2),
(27, '1111111111', '0', 1),
(28, '1111111111', '0', 2),
(29, '1111111111', '0', 3),
(30, '1111111111', '0', 3),
(31, '1111111111', '0', 2),
(32, '1111111111', '0', 2),
(33, '1111111111', '0', 2),
(34, '1111111111', '0', 1),
(35, '1111111111', '0', 1),
(36, '1111111111', '0', 2),
(37, '1111111111', '0', 2),
(38, '7894561233', '0', 2),
(39, '1943837489', '0', 2),
(40, '1943837489', '0', 3),
(41, '4567899632', '0', 2),
(42, '7894561230', '0', 2),
(43, '1111111111', '0', 2),
(44, '7894563258', '0', 2),
(45, '4566546555', '0', 2),
(46, '7894563112', '0', 2),
(47, '7894563123', '0', 2),
(48, '1452367891', '0', 2),
(49, '7894562014', '0', 2),
(50, '1478523691', '0', 4),
(51, '1230001211', '0', 1),
(52, '1234567899', '0', 1),
(53, '1234567890', '0', 2),
(54, '1111111111', '0', 1),
(55, '1564', 'empleado', 1),
(56, '234234534', 'empleado', 1),
(57, '768786', 'empleado', 1),
(58, '6768', 'empleado', 1),
(59, '16565', 'empleado', 1),
(60, '1313213213', 'empleado', 1),
(61, '194383745', 'cliente', 2),
(62, '77777777', 'cliente', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `submodulos`
--

CREATE TABLE `submodulos` (
  `id` int(10) UNSIGNED NOT NULL,
  `status_sm` int(11) NOT NULL DEFAULT '0',
  `descripcion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ruta` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `modulo_id` int(10) UNSIGNED NOT NULL,
  `padre` int(11) NOT NULL,
  `orden` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `submodulos`
--

INSERT INTO `submodulos` (`id`, `status_sm`, `descripcion`, `url`, `ruta`, `modulo_id`, `padre`, `orden`) VALUES
(1, 0, 'Modulos', ' ', ' ', 1, 1, 0),
(2, 1, 'Departamentos', 'departamentos', ' /menu/registros/departamentos/', 1, 1, 1),
(3, 1, 'Planes y Servicios', 'planeservicios', ' /menu/registros/planeservicios/', 1, 1, 5),
(4, 1, 'Datos Complementarios', 'datos', ' /menu/registros/datos/', 1, 1, 4),
(5, 1, 'Perfiles', 'perfiles', ' /menu/registros/perfiles/', 1, 1, 2),
(6, 1, 'Empleados', 'empleados', ' /menu/registros/empleados/', 1, 1, 3),
(7, 1, 'Clientes', 'clientes', ' /menu/registros/clientes/', 1, 1, 6),
(10, 1, 'Cargos', ' ', ' /menu/registros/departamentos/cargos', 1, 0, 0),
(11, 1, 'Pruebas', '/menu/registros/prueba', '/menu/registros/prueba', 1, 1, 7),
(12, 1, 'Bandeja de entrada', ' ', ' ', 2, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursales`
--

CREATE TABLE `sucursales` (
  `id` int(10) UNSIGNED NOT NULL,
  `razon_s` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nombre_c` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `rif_id` int(10) UNSIGNED NOT NULL,
  `tipo_id` int(10) UNSIGNED NOT NULL,
  `direccion_id` int(10) UNSIGNED NOT NULL,
  `direccion__id` int(10) UNSIGNED NOT NULL,
  `contacto_id` int(10) UNSIGNED NOT NULL,
  `cliente_id` int(10) UNSIGNED NOT NULL,
  `categoria_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `sucursales`
--

INSERT INTO `sucursales` (`id`, `razon_s`, `nombre_c`, `status`, `rif_id`, `tipo_id`, `direccion_id`, `direccion__id`, `contacto_id`, `cliente_id`, `categoria_id`) VALUES
(1, 'Sambil Caracas', 'Sambil Caracas', 0, 1, 13, 70, 71, 30, 6, 3),
(2, 'Aviadore', 'Aviadores', 1, 1, 13, 69, 71, 29, 6, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `telefonicos`
--

CREATE TABLE `telefonicos` (
  `id` int(10) UNSIGNED NOT NULL,
  `plan_id` int(10) UNSIGNED NOT NULL,
  `etiqueta` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `valor` int(10) UNSIGNED NOT NULL,
  `precio` double(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `telefonicos`
--

INSERT INTO `telefonicos` (`id`, `plan_id`, `etiqueta`, `valor`, `precio`) VALUES
(3, 5, 'contabilizado', 10, 1500.00),
(5, 6, 'contabilizado', 20, 1800.00),
(6, 8, 'contabilizado', 60, 6000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tequipos`
--

CREATE TABLE `tequipos` (
  `id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tequipos`
--

INSERT INTO `tequipos` (`id`, `descripcion`) VALUES
(1, 'DESKTOP'),
(2, 'LAPTOP'),
(3, 'ROUTER'),
(4, 'DVR'),
(5, 'CENTRAL TELEFONICA'),
(6, 'MAQUINA FISCAL'),
(7, 'IMPRESORA'),
(8, 'SWICTH'),
(9, 'LKLKLK'),
(10, 'FISCAL'),
(11, 'CAMARA'),
(12, 'TELEVISOR'),
(13, 'CORNETAS'),
(14, 'SILLA'),
(15, 'ESCRITORIO'),
(16, 'PANTALLA'),
(17, 'TELEFONO'),
(18, 'NUEVO'),
(19, 'NUEVO 1'),
(20, 'PC');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos`
--

CREATE TABLE `tipos` (
  `id` int(10) UNSIGNED NOT NULL,
  `numero_c` int(11) NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tipos`
--

INSERT INTO `tipos` (`id`, `numero_c`, `descripcion`) VALUES
(1, 1, 'V-'),
(2, 1, 'J-'),
(3, 1, 'P-'),
(4, 1, 'G-'),
(5, 1, 'J-'),
(6, 2, '0424-'),
(7, 2, '0426-'),
(8, 2, '0414-'),
(9, 2, '0416-'),
(10, 2, '0412-'),
(11, 3, '0212-'),
(12, 4, 'Ordinario'),
(13, 4, 'Especial'),
(14, 5, 'V-'),
(15, 5, 'E-');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `n_usuario` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `clave` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `perfil_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `n_usuario`, `clave`, `status`, `perfil_id`) VALUES
(1, 'SantaellaV', '123', 1, 14),
(3, 'VirguezR', '10', 1, 14),
(4, 'TayupoJ', '789', 1, 14),
(5, 'SUPSAD', 'SUPSAD00', 1, 13),
(6, 'molinaqw', '2343242', 1, 14),
(7, 'molina', '123', 1, 16),
(8, 'CeballosC', '123', 1, 15);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acciones`
--
ALTER TABLE `acciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `acciones_submodulo_id_foreign` (`submodulo_id`),
  ADD KEY `acciones_accion_id_foreign` (`accion_id`);

--
-- Indices de la tabla `accion_perfil`
--
ALTER TABLE `accion_perfil`
  ADD PRIMARY KEY (`id`),
  ADD KEY `accion_perfil_perfil_id_foreign` (`perfil_id`),
  ADD KEY `accion_perfil_accion_id_foreign` (`accion_id`);

--
-- Indices de la tabla `aplicaciones`
--
ALTER TABLE `aplicaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aplicaciones_equipo_id_foreign` (`equipo_id`);

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `areas_departamento_id_foreign` (`departamento_id`);

--
-- Indices de la tabla `auxiliares`
--
ALTER TABLE `auxiliares`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `bitacoras`
--
ALTER TABLE `bitacoras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cargos_area_id_foreign` (`area_id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categorias_cliente_id_foreign` (`cliente_id`);

--
-- Indices de la tabla `categoria_persona`
--
ALTER TABLE `categoria_persona`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_persona_categoria_id_foreign` (`categoria_id`),
  ADD KEY `categoria_persona_persona_id_foreign` (`persona_id`);

--
-- Indices de la tabla `cedulas`
--
ALTER TABLE `cedulas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cedulas_tipo_id_foreign` (`tipo_id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clientes_rif_id_foreign` (`rif_id`),
  ADD KEY `clientes_tipo_id_foreign` (`tipo_id`),
  ADD KEY `clientes_direccion_id_foreign` (`direccion_id`),
  ADD KEY `clientes_direccion__id_foreign` (`direccion__id`),
  ADD KEY `clientes_contacto_id_foreign` (`contacto_id`);

--
-- Indices de la tabla `componentes`
--
ALTER TABLE `componentes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `componentes_equipo_id_foreign` (`equipo_id`);

--
-- Indices de la tabla `contactos`
--
ALTER TABLE `contactos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contactos_tipo_id_foreign` (`tipo_id`),
  ADD KEY `contactos_tipo__id_foreign` (`tipo__id`);

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departamentos_director_id_foreign` (`director_id`);

--
-- Indices de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `direcciones_municipio_id_foreign` (`municipio_id`),
  ADD KEY `direcciones_pais_id_foreign` (`pais_id`),
  ADD KEY `direcciones_region_id_foreign` (`region_id`),
  ADD KEY `direcciones_estado_id_foreign` (`estado_id`);

--
-- Indices de la tabla `directores`
--
ALTER TABLE `directores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ecomponentes`
--
ALTER TABLE `ecomponentes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ecomponente_epieza`
--
ALTER TABLE `ecomponente_epieza`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ecomponente_epieza_ecomponente_id_foreign` (`ecomponente_id`),
  ADD KEY `ecomponente_epieza_epieza_id_foreign` (`epieza_id`);

--
-- Indices de la tabla `ecomponente_tequipo`
--
ALTER TABLE `ecomponente_tequipo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ecomponente_tequipo_ecomponente_id_foreign` (`ecomponente_id`),
  ADD KEY `ecomponente_tequipo_tequipo_id_foreign` (`tequipo_id`);

--
-- Indices de la tabla `emarcas`
--
ALTER TABLE `emarcas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `emodelos`
--
ALTER TABLE `emodelos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `empleados_cedula_id_foreign` (`cedula_id`),
  ADD KEY `empleados_rif_id_foreign` (`rif_id`),
  ADD KEY `empleados_departamento_id_foreign` (`departamento_id`),
  ADD KEY `empleados_cargo_id_foreign` (`cargo_id`),
  ADD KEY `empleados_direccion_id_foreign` (`direccion_id`),
  ADD KEY `empleados_contacto_id_foreign` (`contacto_id`),
  ADD KEY `empleados_usuario_id_foreign` (`usuario_id`);

--
-- Indices de la tabla `epiezas`
--
ALTER TABLE `epiezas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `equipos_sucursal_id_foreign` (`sucursal_id`);

--
-- Indices de la tabla `equipo_marca`
--
ALTER TABLE `equipo_marca`
  ADD PRIMARY KEY (`id`),
  ADD KEY `equipo_marca_tequipo_id_foreign` (`tequipo_id`),
  ADD KEY `equipo_marca_emarca_id_foreign` (`emarca_id`);

--
-- Indices de la tabla `equipo_modelo`
--
ALTER TABLE `equipo_modelo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `equipo_modelo_tequipo_id_foreign` (`tequipo_id`),
  ADD KEY `equipo_modelo_emodelo_id_foreign` (`emodelo_id`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estados_region_id_foreign` (`region_id`);

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `horarios_plan_id_foreign` (`plan_id`);

--
-- Indices de la tabla `marca_modelo`
--
ALTER TABLE `marca_modelo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `marca_modelo_emarca_id_foreign` (`emarca_id`),
  ADD KEY `marca_modelo_emodelo_id_foreign` (`emodelo_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `modulo_perfil`
--
ALTER TABLE `modulo_perfil`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modulo_perfil_perfil_id_foreign` (`perfil_id`),
  ADD KEY `modulo_perfil_modulo_id_foreign` (`modulo_id`);

--
-- Indices de la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `municipios_estado_id_foreign` (`estado_id`);

--
-- Indices de la tabla `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `perfil_submodulo`
--
ALTER TABLE `perfil_submodulo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `perfil_submodulo_perfil_id_foreign` (`perfil_id`),
  ADD KEY `perfil_submodulo_submodulo_id_foreign` (`submodulo_id`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `personas_cedula_id_foreign` (`cedula_id`),
  ADD KEY `personas_contacto_id_foreign` (`contacto_id`),
  ADD KEY `personas_cliente_id_foreign` (`cliente_id`);

--
-- Indices de la tabla `persona_sucursal`
--
ALTER TABLE `persona_sucursal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `persona_sucursal_sucursal_id_foreign` (`sucursal_id`),
  ADD KEY `persona_sucursal_persona_id_foreign` (`persona_id`);

--
-- Indices de la tabla `piezas`
--
ALTER TABLE `piezas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `piezas_componente_id_foreign` (`componente_id`);

--
-- Indices de la tabla `planes`
--
ALTER TABLE `planes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `plan_sucursal`
--
ALTER TABLE `plan_sucursal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plan_sucursal_plan_id_foreign` (`plan_id`),
  ADD KEY `plan_sucursal_sucursal_id_foreign` (`sucursal_id`);

--
-- Indices de la tabla `presenciales`
--
ALTER TABLE `presenciales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `presenciales_plan_id_foreign` (`plan_id`);

--
-- Indices de la tabla `regiones`
--
ALTER TABLE `regiones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `regiones_pais_id_foreign` (`pais_id`);

--
-- Indices de la tabla `remotos`
--
ALTER TABLE `remotos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `remotos_plan_id_foreign` (`plan_id`);

--
-- Indices de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `respuestas_plan_id_foreign` (`plan_id`);

--
-- Indices de la tabla `rifs`
--
ALTER TABLE `rifs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rifs_tipo_id_foreign` (`tipo_id`);

--
-- Indices de la tabla `submodulos`
--
ALTER TABLE `submodulos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `submodulos_modulo_id_foreign` (`modulo_id`);

--
-- Indices de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sucursales_rif_id_foreign` (`rif_id`),
  ADD KEY `sucursales_tipo_id_foreign` (`tipo_id`),
  ADD KEY `sucursales_direccion_id_foreign` (`direccion_id`),
  ADD KEY `sucursales_direccion__id_foreign` (`direccion__id`),
  ADD KEY `sucursales_contacto_id_foreign` (`contacto_id`),
  ADD KEY `sucursales_cliente_id_foreign` (`cliente_id`),
  ADD KEY `sucursales_categoria_id_foreign` (`categoria_id`);

--
-- Indices de la tabla `telefonicos`
--
ALTER TABLE `telefonicos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `telefonicos_plan_id_foreign` (`plan_id`);

--
-- Indices de la tabla `tequipos`
--
ALTER TABLE `tequipos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipos`
--
ALTER TABLE `tipos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuarios_perfil_id_foreign` (`perfil_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acciones`
--
ALTER TABLE `acciones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;
--
-- AUTO_INCREMENT de la tabla `accion_perfil`
--
ALTER TABLE `accion_perfil`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1229;
--
-- AUTO_INCREMENT de la tabla `aplicaciones`
--
ALTER TABLE `aplicaciones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `auxiliares`
--
ALTER TABLE `auxiliares`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `bitacoras`
--
ALTER TABLE `bitacoras`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `categoria_persona`
--
ALTER TABLE `categoria_persona`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `cedulas`
--
ALTER TABLE `cedulas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de la tabla `componentes`
--
ALTER TABLE `componentes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `contactos`
--
ALTER TABLE `contactos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;
--
-- AUTO_INCREMENT de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;
--
-- AUTO_INCREMENT de la tabla `directores`
--
ALTER TABLE `directores`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `ecomponentes`
--
ALTER TABLE `ecomponentes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT de la tabla `ecomponente_epieza`
--
ALTER TABLE `ecomponente_epieza`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `ecomponente_tequipo`
--
ALTER TABLE `ecomponente_tequipo`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `emarcas`
--
ALTER TABLE `emarcas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `emodelos`
--
ALTER TABLE `emodelos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `epiezas`
--
ALTER TABLE `epiezas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `equipo_marca`
--
ALTER TABLE `equipo_marca`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `equipo_modelo`
--
ALTER TABLE `equipo_modelo`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `marca_modelo`
--
ALTER TABLE `marca_modelo`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;
--
-- AUTO_INCREMENT de la tabla `modulos`
--
ALTER TABLE `modulos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `modulo_perfil`
--
ALTER TABLE `modulo_perfil`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT de la tabla `municipios`
--
ALTER TABLE `municipios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=348;
--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `perfil_submodulo`
--
ALTER TABLE `perfil_submodulo`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;
--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `persona_sucursal`
--
ALTER TABLE `persona_sucursal`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `piezas`
--
ALTER TABLE `piezas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `planes`
--
ALTER TABLE `planes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `plan_sucursal`
--
ALTER TABLE `plan_sucursal`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `presenciales`
--
ALTER TABLE `presenciales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `regiones`
--
ALTER TABLE `regiones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `remotos`
--
ALTER TABLE `remotos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `rifs`
--
ALTER TABLE `rifs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT de la tabla `submodulos`
--
ALTER TABLE `submodulos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `telefonicos`
--
ALTER TABLE `telefonicos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `tequipos`
--
ALTER TABLE `tequipos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de la tabla `tipos`
--
ALTER TABLE `tipos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `acciones`
--
ALTER TABLE `acciones`
  ADD CONSTRAINT `acciones_accion_id_foreign` FOREIGN KEY (`accion_id`) REFERENCES `acciones` (`id`),
  ADD CONSTRAINT `acciones_submodulo_id_foreign` FOREIGN KEY (`submodulo_id`) REFERENCES `submodulos` (`id`);

--
-- Filtros para la tabla `accion_perfil`
--
ALTER TABLE `accion_perfil`
  ADD CONSTRAINT `accion_perfil_accion_id_foreign` FOREIGN KEY (`accion_id`) REFERENCES `acciones` (`id`),
  ADD CONSTRAINT `accion_perfil_perfil_id_foreign` FOREIGN KEY (`perfil_id`) REFERENCES `perfiles` (`id`);

--
-- Filtros para la tabla `aplicaciones`
--
ALTER TABLE `aplicaciones`
  ADD CONSTRAINT `aplicaciones_equipo_id_foreign` FOREIGN KEY (`equipo_id`) REFERENCES `equipos` (`id`);

--
-- Filtros para la tabla `areas`
--
ALTER TABLE `areas`
  ADD CONSTRAINT `areas_departamento_id_foreign` FOREIGN KEY (`departamento_id`) REFERENCES `departamentos` (`id`);

--
-- Filtros para la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD CONSTRAINT `cargos_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`);

--
-- Filtros para la tabla `componentes`
--
ALTER TABLE `componentes`
  ADD CONSTRAINT `componentes_equipo_id_foreign` FOREIGN KEY (`equipo_id`) REFERENCES `equipos` (`id`);

--
-- Filtros para la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD CONSTRAINT `departamentos_director_id_foreign` FOREIGN KEY (`director_id`) REFERENCES `directores` (`id`);

--
-- Filtros para la tabla `ecomponente_epieza`
--
ALTER TABLE `ecomponente_epieza`
  ADD CONSTRAINT `ecomponente_epieza_ecomponente_id_foreign` FOREIGN KEY (`ecomponente_id`) REFERENCES `ecomponentes` (`id`),
  ADD CONSTRAINT `ecomponente_epieza_epieza_id_foreign` FOREIGN KEY (`epieza_id`) REFERENCES `epiezas` (`id`);

--
-- Filtros para la tabla `ecomponente_tequipo`
--
ALTER TABLE `ecomponente_tequipo`
  ADD CONSTRAINT `ecomponente_tequipo_ecomponente_id_foreign` FOREIGN KEY (`ecomponente_id`) REFERENCES `ecomponentes` (`id`),
  ADD CONSTRAINT `ecomponente_tequipo_tequipo_id_foreign` FOREIGN KEY (`tequipo_id`) REFERENCES `tequipos` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
