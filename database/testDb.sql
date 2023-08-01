-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost:3306
-- Üretim Zamanı: 29 Tem 2023, 12:33:14
-- Sunucu sürümü: 10.3.39-MariaDB-cll-lve
-- PHP Sürümü: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `sorupane_testDb`
--
-- --------------------------------------------------------
--
-- Tablo için tablo yapısı `construction_stages`


CREATE TABLE `construction_stages` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime DEFAULT NULL,
  `duration` float DEFAULT NULL,
  `durationUnit` varchar(50) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `externalId` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'NEW'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Tablo döküm verisi `construction_stages`
--

INSERT INTO `construction_stages` (`ID`, `name`, `start_date`, `end_date`, `duration`, `durationUnit`, `color`, `externalId`, `status`) VALUES
(1, 'Pension Mühlbachtal 36', '2021-05-01 00:00:00', NULL, NULL, NULL, NULL, NULL, 'NEW'),
(2, 'Reinigung VERO PB', '2021-05-01 00:00:00', NULL, NULL, NULL, NULL, NULL, 'NEW'),
(3, 'Bürotätigkeiten VERO PB 2021', '2021-01-01 00:00:00', '2021-12-31 00:00:00', NULL, NULL, NULL, NULL, 'NEW'),
(4, 'Ein Testprojekt ', '2021-07-20 00:00:00', NULL, NULL, NULL, NULL, NULL, 'NEW'),
(5, 'Stemmarbeiten in der Einlaufkammer und am Zyklons 4B', '2021-07-11 00:00:00', NULL, NULL, NULL, NULL, NULL, 'NEW'),
(6, 'Bachstraße 65+67 // Maler- und Dacharbeiten // Detmold', '2021-07-13 00:00:00', NULL, NULL, NULL, NULL, NULL, 'NEW'),
(7, 'Fassadengerüst im Innenhof', '2021-07-14 00:00:00', NULL, NULL, NULL, NULL, NULL, 'NEW'),
(8, 'Mietgerüst // BV Julius Leber Str. 24, Paderbor', '2021-08-18 00:00:00', NULL, NULL, NULL, NULL, NULL, 'NEW'),
(9, 'Lise Meitner Str. 33104 PB - 2. BA', '2021-09-06 00:00:00', '2021-09-08 00:00:00', NULL, NULL, NULL, NULL, 'NEW'),
(10, 'Kd: Bernd Langrock - Dachsanierung Reiheneckhaus ', '2021-08-31 00:00:00', NULL, NULL, NULL, NULL, NULL, 'NEW'),
(11, 'WT  Sanierung Stahlbetonriegel südseitig', '2021-09-02 00:00:00', NULL, NULL, NULL, NULL, NULL, 'NEW'),
(12, 'Name Or Title right', '2015-03-15 12:10:22', '2015-03-09 10:06:58', 6, 'DAYS', '', '', 'NEW'),
(13, 'Name Or Title right', '2015-03-15 12:10:22', '2015-03-09 10:06:58', 6, 'DAYS', '', '', 'NEW'),
(14, 'fuckkkk yeaaaaahhhh', '2021-09-08 00:00:00', NULL, NULL, NULL, NULL, NULL, 'NEW'),
(15, 'Einrüsten Station 150 (Power & Free) - Austausch des Schleppkettenantriebs', '2021-10-22 00:00:00', NULL, NULL, NULL, NULL, NULL, 'NEW'),
(16, 'WT Etage 3 am Zyklon 3 // Reparaturarbeite', '2021-09-10 00:00:00', NULL, NULL, NULL, NULL, NULL, 'NEW'),
(17, 'Ofenfundament 1 // Arbeitsgerüst ', '2021-09-10 00:00:00', NULL, NULL, NULL, NULL, NULL, 'NEW'),
(18, 'Drehofen Schutzgerüst -Werk PB-', '2021-09-21 00:00:00', NULL, NULL, NULL, NULL, NULL, 'NEW'),
(19, 'Treppenhaus Druckerei', '2021-09-21 00:00:00', NULL, NULL, NULL, NULL, NULL, 'NEW'),
(20, 'BV Neubau Ärztehaus \"An der Burg 7, 33154 Salzkotten\"', '2021-10-04 00:00:00', NULL, NULL, NULL, NULL, NULL, 'NEW'),
(21, 'BV Erweiterung Terminal 2, Pamplonastraße 1, 33106 Paderbor', '2022-01-10 00:00:00', NULL, NULL, NULL, NULL, NULL, 'NEW'),
(22, 'BV Ewers / Sindermann - Dachsanierung in Lichtenau-Holtheim', '2021-09-27 00:00:00', NULL, NULL, NULL, NULL, NULL, 'NEW'),
(23, 'Neubau des Pfarrhauses Schloß Neuhaus', '2021-10-11 00:00:00', NULL, NULL, NULL, NULL, NULL, 'NEW'),
(24, 'BV Feldmann - Dachsanierung einer Dachgaube in Ettel', '2021-10-11 00:00:00', NULL, NULL, NULL, NULL, NULL, 'NEW'),
(25, 'BV Boltenhof - Neubau eines EFH', '2021-10-07 00:00:00', NULL, NULL, NULL, NULL, NULL, 'NEW'),
(26, 'Gerüst für Dach Sanierungs-Arbeiten ', '2021-10-12 00:00:00', NULL, NULL, NULL, NULL, NULL, 'NEW'),
(27, 'BV Engemann - Naubau einer Halle zur Aufbereitung von Bioobst und -gemüse', '2021-10-25 00:00:00', NULL, NULL, NULL, NULL, NULL, 'NEW'),
(28, 'Längsriss im Drehofen Ennigerloh Nord', '2021-10-29 00:00:00', NULL, NULL, NULL, NULL, NULL, 'NEW'),
(29, 'BV Am Buchweizenfeld 9, 33161 Hövelhof', '2021-11-08 00:00:00', NULL, NULL, NULL, NULL, NULL, 'NEW'),
(30, 'BV Menne - Umbau eines EFH, Triftweg 37, PB', '2021-11-19 00:00:00', NULL, NULL, NULL, NULL, NULL, 'NEW'),
(31, 'Rohrleitungsbau - Halle 9 - Werk S', '2021-12-23 00:00:00', NULL, NULL, NULL, NULL, NULL, 'NEW'),
(32, 'BV Dimitri Fast - Einrüstung eines Wohnhauses inkl. Anbau', '2021-11-23 00:00:00', NULL, NULL, NULL, NULL, NULL, 'NEW'),
(33, 'Dachsanierung - Briloner Str. 30 - Büre', '2021-11-19 00:00:00', NULL, NULL, NULL, NULL, NULL, 'NEW'),
(34, 'Open topics for scaffold planning', '2021-12-08 00:00:00', NULL, NULL, NULL, NULL, NULL, 'NEW'),
(35, 'Rücktransport von Gerüstmaterial nach Bulgarien ', '2021-12-13 00:00:00', NULL, NULL, NULL, NULL, NULL, 'NEW'),
(36, 'Anbau 4. Gruppe Kindergarten Mantinghause', '2022-01-04 00:00:00', NULL, NULL, NULL, NULL, NULL, 'NEW'),
(37, 'Erweiterung Kita St. Elisabeth Sudhagen  -  Schlinger Straße 36, 33129 Delbrück', '2022-01-17 00:00:00', NULL, NULL, NULL, NULL, NULL, 'NEW'),
(38, 'Building project / Mühlbachtal, 33178 Borchen-Ettel', '2022-01-05 00:00:00', NULL, NULL, NULL, NULL, NULL, 'NEW'),
(39, 'Giebeleinrüstung eines EFH, Hauptstraße 45, Hegensdorf', '2022-01-12 00:00:00', NULL, NULL, NULL, NULL, NULL, 'NEW'),
(40, 'BV Julia und Christian Paschen // Mühle in Husen // Projekt 858', '2022-01-10 00:00:00', NULL, NULL, NULL, NULL, NULL, 'NEW'),
(41, '1. Woche ', '2022-01-10 00:00:00', '2022-01-15 00:00:00', 490, NULL, '', NULL, 'NEW'),
(42, '2. Woche ', '2022-01-17 00:00:00', '2022-01-22 00:00:00', 490, NULL, '', NULL, 'NEW'),
(43, '3. Woche', '2022-01-24 00:00:00', '2022-01-29 00:00:00', 490, NULL, '', NULL, 'NEW'),
(44, '4. Woche ', '2022-01-31 00:00:00', '2022-02-05 00:00:00', 490, NULL, '', NULL, 'NEW'),
(45, '5. Woche ', '2022-02-07 00:00:00', '2022-02-12 00:00:00', 490, NULL, '', NULL, 'NEW'),
(46, '6. Woche', '2022-02-14 00:00:00', '2022-02-19 00:00:00', 490, NULL, '', NULL, 'NEW'),
(47, '7. Woche ', '2022-02-21 00:00:00', '2022-02-26 00:00:00', 490, NULL, '', NULL, 'NEW'),
(48, '8. Woche ', '2022-02-28 00:00:00', '2022-03-05 00:00:00', 490, NULL, '', NULL, 'NEW'),
(49, 'Neubau MFH, Grüner Weg in Nordborche', '2022-01-14 00:00:00', NULL, NULL, NULL, NULL, NULL, 'NEW'),
(50, 'Neubau MFH mit 9 WE - Warburger Str. 95 in PB', '2022-01-26 00:00:00', NULL, NULL, NULL, NULL, NULL, 'NEW'),
(51, 'Werkstatt 2022', '2022-01-01 00:00:00', '2022-12-31 00:00:00', NULL, NULL, NULL, NULL, 'NEW'),
(52, 'Revision Mai 2022 4500613031 ', '2022-04-27 00:00:00', '2022-05-27 00:00:00', NULL, NULL, NULL, NULL, 'NEW'),
(53, 'Revision Heidelberg ', '2022-05-11 00:00:00', '2022-06-15 00:00:00', NULL, NULL, NULL, NULL, 'NEW'),
(54, 'AMD BG BAU (Arbeitsmedizinischer Dienst) / Vorsorgeuntersuchung 2022', '2022-02-09 00:00:00', '2022-12-31 00:00:00', NULL, NULL, NULL, NULL, 'NEW'),
(55, 'Dachsanierung Eickhoffer Str. 2, Büre', '2022-02-10 00:00:00', NULL, NULL, NULL, NULL, NULL, 'NEW'),
(56, 'Aufbau', '2022-02-28 00:00:00', '2022-04-06 00:00:00', 0, NULL, '#3CB247', NULL, 'NEW'),
(57, 'Neubau einer Rettungswache in Lichtenau', '2022-02-23 00:00:00', NULL, NULL, NULL, NULL, NULL, 'NEW'),
(58, 'HeidelbergCement AG Werk PB // Auswechseln Ofenschuss // Bestellung Nr. B201898', '2022-02-24 00:00:00', NULL, NULL, NULL, NULL, NULL, 'NEW'),
(59, 'Projekt HeidelbergCement Werk Ennigerloh // Maßnahme am Reaktor A', '2022-03-01 00:00:00', '2022-03-03 00:00:00', 0, NULL, '#3CB247', NULL, 'NEW'),
(60, 'Rundrüstung Durchmesser 3,50 m ', '2022-03-05 00:00:00', NULL, NULL, NULL, NULL, NULL, 'NEW'),
(62, 'Gesamtbauzeit ', '2022-03-21 00:00:00', '2022-11-30 00:00:00', 0, NULL, '#1726CC', NULL, 'NEW'),
(63, 'Gerüstaufbau ', '2022-03-21 00:00:00', '2022-05-31 00:00:00', 0, NULL, '#FD4030', NULL, 'NEW'),
(64, 'Gerüststandzeit mit eventuellen Umbaute', '2022-06-01 00:00:00', '2022-11-24 00:00:00', 0, NULL, '#FFEF00', NULL, 'NEW'),
(65, 'Abbau', '2022-03-24 00:00:00', '2022-04-18 00:00:00', 0, NULL, '#FD4030', NULL, 'NEW'),
(66, 'Aufbau ', '2022-04-05 00:00:00', '2022-04-10 00:00:00', 0, NULL, '#3CB247', NULL, 'NEW'),
(67, 'Abbau', '2022-04-19 00:00:00', '2022-04-26 00:00:00', 0, NULL, '#FD4030', NULL, 'NEW'),
(68, 'Aufbau ', '2022-03-18 00:00:00', '2022-04-05 00:00:00', 0, NULL, '#3CB247', NULL, 'NEW'),
(69, 'Umbau TH 1 auf TH 2', '2022-04-05 00:00:00', '2022-04-14 00:00:00', 0, NULL, '#0590FC', NULL, 'NEW'),
(70, 'Abbau Gerüst aus TH 2 und Abtransportiere', '2022-04-28 00:00:00', '2022-05-06 00:00:00', 0, NULL, '#FD4030', NULL, 'NEW'),
(71, 'Aufbau', '2022-03-16 00:00:00', '2022-03-16 00:00:00', 0, NULL, '#3CB247', NULL, 'NEW'),
(72, 'Abbau Treppenhausgerüst ', '2022-04-06 00:00:00', '2022-05-04 00:00:00', 0, NULL, '#FD4030', NULL, 'NEW'),
(73, 'Aufbau ', '2022-03-14 00:00:00', '2022-03-15 00:00:00', 0, NULL, '#3CB247', NULL, 'NEW'),
(74, 'Abbau', '2022-05-03 00:00:00', '2022-05-26 00:00:00', 0, NULL, '#FD4030', NULL, 'NEW'),
(75, 'Aufbau ', '2022-03-01 00:00:00', '2022-03-10 00:00:00', 0, NULL, '#3CB247', NULL, 'NEW'),
(76, 'Standzeit des Gerüstes', '2022-03-15 00:00:00', '2022-03-28 00:00:00', 0, NULL, '#0590FC', NULL, 'NEW'),
(77, 'Abbau', '2022-03-29 00:00:00', '2022-03-31 00:00:00', 0, NULL, '#FD4030', NULL, 'NEW'),
(78, 'Standzeit Mietgerüst', '2021-11-17 00:00:00', '2022-05-26 00:00:00', 0, NULL, '#0590FC', NULL, 'NEW'),
(79, 'Montagebegin', '2022-03-28 00:00:00', '2022-04-03 00:00:00', 0, NULL, '#3CB247', NULL, 'NEW'),
(80, 'Standzeit des Gerüstes', '2022-04-04 00:00:00', '2022-05-03 00:00:00', 0, NULL, '#FFEF00', NULL, 'NEW'),
(81, 'Demontage des Gerüstes', '2022-05-03 00:00:00', '2022-05-19 00:00:00', 0, NULL, '#FD4030', NULL, 'NEW'),
(82, 'Montage des Gerüstes ', '2022-03-29 00:00:00', '2022-03-30 00:00:00', 0, NULL, '#3CB247', NULL, 'NEW'),
(83, 'Standzeit des Gerüstes', '2022-03-31 00:00:00', '2022-05-31 00:00:00', 0, NULL, '#FFEF00', NULL, 'NEW'),
(84, 'Abbau des Gerüstes', '2022-06-01 00:00:00', '2022-06-02 00:00:00', 0, NULL, '#FD4030', NULL, 'NEW'),
(85, 'Montage des Gerüstes ', '2022-05-02 00:00:00', '2022-05-05 00:00:00', 90, NULL, '#3CB247', NULL, 'NEW'),
(86, 'Standzeit des Gerüstes', '2022-05-06 00:00:00', '2022-06-17 00:00:00', 0, NULL, '#FFEF00', NULL, 'NEW'),
(87, 'Abbau des Gerüstes ', '2022-06-20 00:00:00', '2022-06-22 00:00:00', 0, NULL, '#FD4030', NULL, 'NEW'),
(88, 'Neubau einer landw. Mehrzweckhalle // Am Langen Hahn 150, 33100 Paderborn-Dahl', '2022-03-17 00:00:00', '2022-03-18 00:00:00', 0, NULL, '#3cb247', NULL, 'NEW'),
(89, 'Montage des Gerüstes ', '2022-03-29 00:00:00', '2022-03-23 00:00:00', 60, NULL, '#3CB247', NULL, 'NEW'),
(90, 'Standzeit des Gerüstes', '2022-03-30 00:00:00', '2022-04-06 00:00:00', 0, NULL, '#FFEF00', NULL, 'NEW'),
(91, 'Abbau des Gerüstes ', '2022-04-07 00:00:00', '2022-04-08 00:00:00', 0, NULL, '#CA0E0E', NULL, 'NEW'),
(92, 'Traggerüst am Klinkergutförderband', '2022-02-21 00:00:00', '2022-03-31 00:00:00', NULL, NULL, NULL, NULL, 'NEW'),
(93, 'Kiga Lange Wenne // Auftrag A-22-03795 // Gebäude Nr. 519113', '2022-07-18 00:00:00', '2022-07-29 00:00:00', NULL, NULL, NULL, NULL, 'NEW'),
(94, 'Aufbau ', '2022-05-21 00:00:00', '2022-06-24 00:00:00', 2000, NULL, '#FD4030', NULL, 'NEW'),
(95, 'Abbau', '2022-08-08 00:00:00', '2022-08-31 00:00:00', 2000, NULL, '#009788', NULL, 'NEW'),
(96, 'Erstaufbau ', '2022-06-27 00:00:00', '2022-06-28 00:00:00', 65, NULL, '#FD4030', NULL, 'NEW'),
(97, 'Erstaufbau ', '2022-06-24 00:00:00', '2022-06-27 00:00:00', 85, NULL, '#FD4030', NULL, 'NEW'),
(98, 'Erstaufbau ', '2022-06-17 00:00:00', '2022-06-20 00:00:00', 45, NULL, '#FD4030', NULL, 'NEW'),
(99, 'Abbau (Angenommen)', '2022-07-26 00:00:00', '2022-07-27 00:00:00', 40, NULL, '#009788', NULL, 'NEW'),
(100, 'Abbau', '2022-07-26 00:00:00', '2022-07-30 00:00:00', 65, NULL, '#009788', NULL, 'NEW'),
(101, 'Aufbau ', '2022-05-20 00:00:00', '2022-06-24 00:00:00', 2000, NULL, '#FD4030', NULL, 'NEW'),
(102, 'Abbau', '2022-08-09 00:00:00', '2022-08-31 00:00:00', 2000, NULL, '#009788', NULL, 'NEW'),
(103, 'Name Or Title right', '2015-03-15 12:10:22', '2015-03-09 10:06:58', 6, 'DAYS', '', '', 'NEW'),
(104, 'Name Or Title right', '2015-03-15 12:10:22', '2015-03-09 10:06:58', 6, 'DAYS', '', '', 'NEW'),
(105, 'Name Or Title right', '2015-03-15 12:10:22', '2015-03-09 10:06:58', 6, 'DAYS', '', '', 'NEW');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `construction_stages`
--
ALTER TABLE `construction_stages`
  ADD PRIMARY KEY (`ID`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `construction_stages`
--
ALTER TABLE `construction_stages`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
