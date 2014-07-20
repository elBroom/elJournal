-- phpMyAdmin SQL Dump
-- version 4.0.6deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Июн 21 2014 г., 08:26
-- Версия сервера: 5.5.35-0ubuntu0.13.10.2
-- Версия PHP: 5.5.3-1ubuntu2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `elJournal`
--

-- --------------------------------------------------------

--
-- Структура таблицы `journal_discipline`
--

CREATE TABLE IF NOT EXISTS `journal_discipline` (
  `id_discipline` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `title` varchar(128) NOT NULL COMMENT 'Название',
  `index` varchar(8) NOT NULL DEFAULT '0' COMMENT 'Код дисциплины',
  `id_metBlock` int(11) NOT NULL COMMENT 'Методический блок',
  `exam` int(11) NOT NULL DEFAULT '0' COMMENT 'Экзамен',
  `dif_zachet` int(11) NOT NULL DEFAULT '0' COMMENT 'Диференциальный зачет',
  `zachet` int(11) NOT NULL DEFAULT '0' COMMENT 'Зачет',
  `sam_rab` int(11) NOT NULL DEFAULT '0' COMMENT 'Самостоятельная работа',
  `lection` int(11) NOT NULL DEFAULT '0' COMMENT 'Лекция',
  `pr_rab` int(11) NOT NULL DEFAULT '0' COMMENT 'Практическая работа',
  `cours_rab` int(11) NOT NULL DEFAULT '0' COMMENT 'Курсовая работа',
  `ucheb_pr` int(11) NOT NULL DEFAULT '0' COMMENT 'Учебная практика',
  `proizv_pr` int(11) NOT NULL DEFAULT '0' COMMENT 'Производственная практика',
  `double` int(1) NOT NULL DEFAULT '0' COMMENT 'Деление на подгруппы',
  `sem1` int(11) NOT NULL DEFAULT '0' COMMENT '1 семестр',
  `sem2` int(11) NOT NULL DEFAULT '0' COMMENT '2 семестр',
  `sem3` int(11) NOT NULL DEFAULT '0' COMMENT '3 семестр',
  `sem4` int(11) NOT NULL DEFAULT '0' COMMENT '4 семестр',
  `sem5` int(11) NOT NULL DEFAULT '0' COMMENT '5 семестр',
  `sem6` int(11) NOT NULL DEFAULT '0' COMMENT '6 семестр',
  `sem7` int(11) NOT NULL DEFAULT '0' COMMENT '7 семестр',
  `sem8` int(11) NOT NULL DEFAULT '0' COMMENT '8 семестр',
  PRIMARY KEY (`id_discipline`),
  KEY `id_metBlock` (`id_metBlock`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='дисциплины' AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `journal_discipline`
--

INSERT INTO `journal_discipline` (`id_discipline`, `title`, `index`, `id_metBlock`, `exam`, `dif_zachet`, `zachet`, `sam_rab`, `lection`, `pr_rab`, `cours_rab`, `ucheb_pr`, `proizv_pr`, `double`, `sem1`, `sem2`, `sem3`, `sem4`, `sem5`, `sem6`, `sem7`, `sem8`) VALUES
(4, 'Русский язык', 'ООД.01', 2, 2, 1, 0, 0, 68, 10, 0, 0, 0, 1, 34, 44, 0, 0, 0, 0, 0, 0),
(5, 'Математика', '0', 3, 2, 1, 0, 0, 78, 0, 0, 0, 0, 1, 34, 44, 0, 0, 0, 0, 0, 0),
(6, 'Экономика', 'ООД.02', 2, 2, 1, 0, 0, 68, 10, 0, 0, 0, 1, 0, 0, 34, 44, 0, 0, 0, 0),
(7, 'История', 'ООД.01', 5, 2, 1, 0, 0, 78, 0, 0, 0, 0, 1, 34, 44, 0, 0, 0, 0, 0, 0),
(8, 'Русский язык', 'ООД.02', 5, 2, 1, 0, 0, 68, 10, 0, 0, 0, 1, 0, 44, 34, 0, 0, 0, 0, 0),
(9, 'Высшая математика', 'ОМД.01', 6, 2, 1, 0, 0, 84, 0, 0, 0, 0, 1, 0, 0, 44, 40, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `journal_disciplineToTeacher`
--

CREATE TABLE IF NOT EXISTS `journal_disciplineToTeacher` (
  `id_notice` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID записи',
  `id_discipline` int(11) NOT NULL COMMENT 'Дисциплина',
  `id_group` int(11) NOT NULL COMMENT 'Группа',
  `id_teacher` int(11) NOT NULL COMMENT 'Преподаватель',
  `sem` int(11) NOT NULL COMMENT 'семестр',
  PRIMARY KEY (`id_notice`),
  KEY `id_discipline` (`id_discipline`,`id_group`,`id_teacher`),
  KEY `id_group` (`id_group`),
  KEY `id_teacher` (`id_teacher`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `journal_disciplineToTeacher`
--

INSERT INTO `journal_disciplineToTeacher` (`id_notice`, `id_discipline`, `id_group`, `id_teacher`, `sem`) VALUES
(1, 4, 1, 2, 1),
(2, 6, 2, 2, 3),
(3, 5, 1, 3, 3),
(4, 9, 3, 3, 2),
(5, 8, 4, 2, 1),
(6, 7, 4, 3, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `journal_disciplineToUser`
--

CREATE TABLE IF NOT EXISTS `journal_disciplineToUser` (
  `id_discipline` int(11) NOT NULL COMMENT 'Дисциплина',
  `id_user` int(11) NOT NULL COMMENT 'Id студента',
  PRIMARY KEY (`id_discipline`,`id_user`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Связь дисциплины с студентом';

--
-- Дамп данных таблицы `journal_disciplineToUser`
--

INSERT INTO `journal_disciplineToUser` (`id_discipline`, `id_user`) VALUES
(2, 5),
(2, 6),
(4, 7),
(4, 8),
(1, 9),
(3, 9),
(1, 10),
(3, 10),
(5, 11),
(6, 11),
(5, 12),
(6, 12);

-- --------------------------------------------------------

--
-- Структура таблицы `journal_group`
--

CREATE TABLE IF NOT EXISTS `journal_group` (
  `id_group` int(11) NOT NULL AUTO_INCREMENT,
  `id_speciality` int(11) NOT NULL COMMENT 'Специальность',
  `year_income` year(4) NOT NULL COMMENT 'Год поступления',
  `title` varchar(20) NOT NULL COMMENT 'Группа',
  PRIMARY KEY (`id_group`),
  KEY `id_speciality` (`id_speciality`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Группы' AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `journal_group`
--

INSERT INTO `journal_group` (`id_group`, `id_speciality`, `year_income`, `title`) VALUES
(1, 1, 2013, 'ИБ-11'),
(2, 1, 2012, 'ИБ-21'),
(3, 2, 2012, 'ИС-21'),
(4, 2, 2013, 'ИС-11');

-- --------------------------------------------------------

--
-- Структура таблицы `journal_lesson`
--

CREATE TABLE IF NOT EXISTS `journal_lesson` (
  `id_lesson` int(11) NOT NULL AUTO_INCREMENT,
  `id_discipline` int(11) NOT NULL,
  `date` date NOT NULL,
  `type` int(1) NOT NULL,
  PRIMARY KEY (`id_lesson`),
  KEY `id_discipline` (`id_discipline`),
  KEY `id_discipline_2` (`id_discipline`),
  KEY `type` (`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Уроки' AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `journal_lesson`
--

INSERT INTO `journal_lesson` (`id_lesson`, `id_discipline`, `date`, `type`) VALUES
(1, 3, '2014-01-11', 1),
(2, 3, '2014-01-10', 1),
(3, 1, '2014-01-14', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `journal_metBlock`
--

CREATE TABLE IF NOT EXISTS `journal_metBlock` (
  `id_metBlock` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `index` varchar(8) NOT NULL COMMENT 'Код',
  `title` varchar(255) NOT NULL COMMENT 'Название',
  `id_speciality` int(11) NOT NULL COMMENT 'Специальность',
  `id_parent` int(11) DEFAULT '0',
  PRIMARY KEY (`id_metBlock`),
  KEY `id_speciality` (`id_speciality`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Методические блоки' AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `journal_metBlock`
--

INSERT INTO `journal_metBlock` (`id_metBlock`, `index`, `title`, `id_speciality`, `id_parent`) VALUES
(1, 'О.О', 'Общеоброзовательный цикл', 1, 0),
(2, '', 'Общегуманитарный и социальноэкономический цикл', 1, 1),
(3, '', 'Математический и общий естественнонаучный цикл', 1, 1),
(4, '', 'Общеоброзовательный цикл', 2, 0),
(5, '', 'Общегуманитарный и социальноэкономический цикл', 2, 4),
(6, '', 'Математический и общий естественнонаучный цикл', 2, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `journal_progress`
--

CREATE TABLE IF NOT EXISTS `journal_progress` (
  `id_progress` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `id_lesson` int(11) NOT NULL COMMENT 'Урок',
  `id_user` int(11) NOT NULL COMMENT 'Студент',
  `estimate` int(11) NOT NULL COMMENT 'Оценка',
  `attendance` tinyint(1) NOT NULL COMMENT 'Посещение',
  PRIMARY KEY (`id_progress`),
  KEY `id_lesson` (`id_lesson`,`id_user`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Оценки за урок' AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `journal_progress`
--

INSERT INTO `journal_progress` (`id_progress`, `id_lesson`, `id_user`, `estimate`, `attendance`) VALUES
(1, 1, 9, 5, 0),
(2, 1, 10, 0, 1),
(3, 2, 9, 4, 0),
(4, 2, 10, 5, 0),
(5, 3, 9, 4, 0),
(6, 3, 10, 3, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `journal_role`
--

CREATE TABLE IF NOT EXISTS `journal_role` (
  `id_role` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `name` varchar(128) NOT NULL COMMENT 'Роль',
  `description` text NOT NULL COMMENT 'Описание',
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Роли' AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `journal_role`
--

INSERT INTO `journal_role` (`id_role`, `name`, `description`) VALUES
(1, 'admin', 'Администратор'),
(2, 'teacher', 'Преподаватель'),
(3, 'student', 'Студент'),
(4, 'metodist', 'Методист');

-- --------------------------------------------------------

--
-- Структура таблицы `journal_roleToUser`
--

CREATE TABLE IF NOT EXISTS `journal_roleToUser` (
  `id_role` int(11) NOT NULL COMMENT 'Роль',
  `id_user` int(11) NOT NULL COMMENT 'Id пользователя',
  PRIMARY KEY (`id_role`,`id_user`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Связь роли с пользователем';

--
-- Дамп данных таблицы `journal_roleToUser`
--

INSERT INTO `journal_roleToUser` (`id_role`, `id_user`) VALUES
(1, 1),
(2, 2),
(2, 3),
(4, 4),
(3, 5),
(3, 6),
(3, 7),
(3, 8),
(3, 9),
(3, 10),
(3, 11),
(3, 12);

-- --------------------------------------------------------

--
-- Структура таблицы `journal_specialty`
--

CREATE TABLE IF NOT EXISTS `journal_specialty` (
  `id_specialty` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(16) NOT NULL,
  `title` varchar(128) NOT NULL,
  PRIMARY KEY (`id_specialty`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Специальности' AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `journal_specialty`
--

INSERT INTO `journal_specialty` (`id_specialty`, `code`, `title`) VALUES
(1, '010101', 'Информационная безопасность'),
(2, '020202', 'Информационные системы');

-- --------------------------------------------------------

--
-- Структура таблицы `journal_statistic`
--

CREATE TABLE IF NOT EXISTS `journal_statistic` (
  `id_statistic` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `id_user` int(11) NOT NULL COMMENT 'Id пользователя',
  `date` int(11) NOT NULL COMMENT 'дата последнего посещения',
  PRIMARY KEY (`id_statistic`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Статистика по пользователям' AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `journal_statistic`
--

INSERT INTO `journal_statistic` (`id_statistic`, `id_user`, `date`) VALUES
(1, 1, 1403324125),
(2, 1, 1403324257),
(3, 4, 1403324343),
(4, 2, 1403324448);

-- --------------------------------------------------------

--
-- Структура таблицы `journal_student`
--

CREATE TABLE IF NOT EXISTS `journal_student` (
  `id_student` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_specialty` int(11) NOT NULL,
  `year_income` year(4) NOT NULL,
  PRIMARY KEY (`id_student`),
  KEY `id_user` (`id_user`,`id_specialty`),
  KEY `id_specialty` (`id_specialty`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Студенты' AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `journal_student`
--

INSERT INTO `journal_student` (`id_student`, `id_user`, `id_specialty`, `year_income`) VALUES
(1, 5, 1, 2012),
(2, 6, 1, 2012),
(3, 7, 2, 2012),
(4, 8, 2, 2012),
(5, 9, 1, 2013),
(6, 10, 1, 2013),
(7, 11, 2, 2013),
(8, 12, 2, 2013);

-- --------------------------------------------------------

--
-- Структура таблицы `journal_typeLesson`
--

CREATE TABLE IF NOT EXISTS `journal_typeLesson` (
  `id_typeLesson` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `title` varchar(128) NOT NULL COMMENT 'Тип',
  PRIMARY KEY (`id_typeLesson`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Тип урока' AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `journal_typeLesson`
--

INSERT INTO `journal_typeLesson` (`id_typeLesson`, `title`) VALUES
(1, 'Лекция'),
(2, 'Практическая'),
(3, 'Курсовая'),
(4, 'Экзамен');

-- --------------------------------------------------------

--
-- Структура таблицы `journal_user`
--

CREATE TABLE IF NOT EXISTS `journal_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `email` varchar(128) NOT NULL COMMENT 'Email',
  `login` varchar(128) NOT NULL COMMENT 'Логин',
  `password` varchar(128) NOT NULL COMMENT 'Пароль',
  `firstname` varchar(128) NOT NULL COMMENT 'Имя',
  `surname` varchar(128) NOT NULL COMMENT 'Фамилия',
  `middlename` varchar(128) NOT NULL COMMENT 'Отчество',
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Пользователи' AUTO_INCREMENT=13 ;

--
-- Дамп данных таблицы `journal_user`
--

INSERT INTO `journal_user` (`id_user`, `email`, `login`, `password`, `firstname`, `surname`, `middlename`) VALUES
(1, 'admin@admin.ad', 'admin', '635478c54748147a721f0f471a0e1991', 'Admin', 'Admin', 'Admin'),
(2, 'teacher1@test.ru', 'teacher1', '635478c54748147a721f0f471a0e1991', 'Teacher1', 'Teacher1', 'Teacher1'),
(3, 'teacher2@test.ru', 'teacher2', '635478c54748147a721f0f471a0e1991', 'Teacher2', 'Teacher2', 'Teacher2'),
(4, 'metodist@test.ru', 'metodist', '635478c54748147a721f0f471a0e1991', 'Metodist', 'Metodist', 'Metodist'),
(5, 'student1@test.ru', 'student1', '635478c54748147a721f0f471a0e1991', 'Student1', 'Student1', 'Student1'),
(6, 'student2@test.ru', 'student2', '635478c54748147a721f0f471a0e1991', 'Student2', 'Student2', 'Student2'),
(7, 'student3@test.ru', 'student3', '635478c54748147a721f0f471a0e1991', 'Student3', 'Student3', 'Student3'),
(8, 'student4@test.ru', 'student4', '635478c54748147a721f0f471a0e1991', 'Student4', 'Student4', 'Student4'),
(9, 'student5@test.ru', 'student5', '635478c54748147a721f0f471a0e1991', 'Student5', 'Student5', 'Student5'),
(10, 'student6@test.ru', 'student6', '635478c54748147a721f0f471a0e1991', 'Student6', 'Student6', 'Student6'),
(11, 'student7@test.ru', 'student7', '635478c54748147a721f0f471a0e1991', 'Student7', 'Student7', 'Student7'),
(12, 'student8@test.ru', 'student8', '635478c54748147a721f0f471a0e1991', 'Student8', 'Student8', 'Student8');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `journal_discipline`
--
ALTER TABLE `journal_discipline`
  ADD CONSTRAINT `journal_discipline_ibfk_1` FOREIGN KEY (`id_metBlock`) REFERENCES `journal_metBlock` (`id_metBlock`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `journal_disciplineToTeacher`
--
ALTER TABLE `journal_disciplineToTeacher`
  ADD CONSTRAINT `journal_disciplineToTeacher_ibfk_4` FOREIGN KEY (`id_discipline`) REFERENCES `journal_discipline` (`id_discipline`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_disciplineToTeacher_ibfk_5` FOREIGN KEY (`id_group`) REFERENCES `journal_group` (`id_group`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_disciplineToTeacher_ibfk_6` FOREIGN KEY (`id_teacher`) REFERENCES `journal_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `journal_disciplineToUser`
--
ALTER TABLE `journal_disciplineToUser`
  ADD CONSTRAINT `journal_disciplineToUser_ibfk_3` FOREIGN KEY (`id_discipline`) REFERENCES `journal_disciplineToTeacher` (`id_notice`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_disciplineToUser_ibfk_4` FOREIGN KEY (`id_user`) REFERENCES `journal_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `journal_group`
--
ALTER TABLE `journal_group`
  ADD CONSTRAINT `journal_group_ibfk_1` FOREIGN KEY (`id_speciality`) REFERENCES `journal_specialty` (`id_specialty`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `journal_lesson`
--
ALTER TABLE `journal_lesson`
  ADD CONSTRAINT `journal_lesson_ibfk_2` FOREIGN KEY (`type`) REFERENCES `journal_typeLesson` (`id_typeLesson`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_lesson_ibfk_3` FOREIGN KEY (`id_discipline`) REFERENCES `journal_disciplineToTeacher` (`id_notice`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `journal_progress`
--
ALTER TABLE `journal_progress`
  ADD CONSTRAINT `journal_progress_ibfk_3` FOREIGN KEY (`id_lesson`) REFERENCES `journal_lesson` (`id_lesson`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_progress_ibfk_4` FOREIGN KEY (`id_user`) REFERENCES `journal_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `journal_roleToUser`
--
ALTER TABLE `journal_roleToUser`
  ADD CONSTRAINT `journal_roleToUser_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `journal_role` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_roleToUser_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `journal_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `journal_student`
--
ALTER TABLE `journal_student`
  ADD CONSTRAINT `journal_student_ibfk_2` FOREIGN KEY (`id_specialty`) REFERENCES `journal_specialty` (`id_specialty`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_student_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `journal_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_student_ibfk_4` FOREIGN KEY (`id_user`) REFERENCES `journal_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
