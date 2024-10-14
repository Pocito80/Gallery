-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 22 Gru 2022, 16:49
-- Wersja serwera: 10.4.22-MariaDB
-- Wersja PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `maciejlecki_4a`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `albumy`
--

CREATE TABLE `albumy` (
  `id` int(11) NOT NULL,
  `tytul` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `data` datetime NOT NULL DEFAULT current_timestamp(),
  `id_uzytkownika` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `albumy`
--

INSERT INTO `albumy` (`id`, `tytul`, `data`, `id_uzytkownika`) VALUES
(8, 'TestAlbum1', '2022-12-21 23:15:41', 3),
(9, 'TestAlbum2', '2022-12-21 23:15:48', 3),
(10, 'TestAlbum3', '2022-12-21 23:15:54', 3),
(11, 'Album test 4', '2022-12-21 23:17:26', 3),
(12, 'test 5', '2022-12-21 23:17:44', 3),
(13, 'Test 7', '2022-12-21 23:25:11', 3),
(14, 'test', '2022-12-21 23:35:53', 3),
(15, 'test', '2022-12-21 23:35:55', 3),
(16, 'test', '2022-12-21 23:35:58', 3),
(17, 'test', '2022-12-21 23:36:00', 3),
(18, 'test', '2022-12-21 23:36:02', 3),
(19, 'test', '2022-12-21 23:36:05', 3),
(20, 'test', '2022-12-21 23:36:07', 3),
(21, 'test', '2022-12-21 23:36:09', 3),
(22, 'test', '2022-12-21 23:36:11', 3),
(23, 'test', '2022-12-21 23:36:13', 3),
(24, 'test', '2022-12-21 23:36:15', 3),
(25, 'test', '2022-12-21 23:36:17', 3),
(26, 'test', '2022-12-21 23:36:19', 3),
(27, 'test', '2022-12-21 23:36:22', 3),
(28, 'test', '2022-12-21 23:36:24', 3),
(29, 'Album', '2022-12-21 23:48:10', 4);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `id` int(11) NOT NULL,
  `login` varchar(16) COLLATE utf8_polish_ci NOT NULL,
  `haslo` varchar(32) COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_polish_ci NOT NULL,
  `zajerestrowany` date NOT NULL DEFAULT current_timestamp(),
  `uprawnienia` enum('użytkownik','moderator','administrator','') COLLATE utf8_polish_ci NOT NULL DEFAULT 'użytkownik',
  `aktywny` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `login`, `haslo`, `email`, `zajerestrowany`, `uprawnienia`, `aktywny`) VALUES
(3, 'TestUser', 'cf7e29f8c5d70abb36ab16eb984e7102', 'TestEmail@test.com', '2022-12-21', 'użytkownik', 1),
(4, 'TestUser2', 'cf7e29f8c5d70abb36ab16eb984e7102', 'email@l.com', '2022-12-21', 'użytkownik', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zdjecia`
--

CREATE TABLE `zdjecia` (
  `id` int(11) NOT NULL,
  `opis` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `id_album` int(11) NOT NULL,
  `data` datetime NOT NULL DEFAULT current_timestamp(),
  `zaakceptowane` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `zdjecia`
--

INSERT INTO `zdjecia` (`id`, `opis`, `id_album`, `data`, `zaakceptowane`) VALUES
(8, 'Testowy opis', 10, '2022-12-21 23:16:29', 1),
(9, 'Tes opisu \'\"\'\'\'//asad', 10, '2022-12-21 23:16:40', 1),
(10, 'Opisik', 9, '2022-12-21 23:17:04', 1),
(11, 'dsadsaad', 8, '2022-12-21 23:17:18', 1),
(12, 'Opcjonalne', 11, '2022-12-21 23:17:37', 1),
(13, '', 12, '2022-12-21 23:17:50', 1),
(15, '', 8, '2022-12-21 23:18:44', 1),
(16, '', 13, '2022-12-21 23:25:20', 1),
(17, '', 8, '2022-12-21 23:25:49', 1),
(18, '', 8, '2022-12-21 23:25:54', 1),
(19, '', 8, '2022-12-21 23:25:58', 1),
(20, '', 8, '2022-12-21 23:26:02', 1),
(21, '', 8, '2022-12-21 23:26:19', 1),
(22, '', 8, '2022-12-21 23:26:26', 1),
(23, '', 8, '2022-12-21 23:26:30', 1),
(24, '', 8, '2022-12-21 23:26:37', 1),
(26, '', 8, '2022-12-21 23:26:56', 1),
(28, '', 8, '2022-12-21 23:27:41', 1),
(29, '', 8, '2022-12-21 23:28:10', 1),
(30, '', 8, '2022-12-21 23:28:20', 1),
(31, '', 8, '2022-12-21 23:28:24', 1),
(32, '', 8, '2022-12-21 23:28:29', 1),
(33, '', 8, '2022-12-21 23:28:33', 1),
(34, '', 8, '2022-12-21 23:28:36', 1),
(35, '', 8, '2022-12-21 23:28:40', 1),
(36, '', 8, '2022-12-21 23:28:43', 1),
(37, '', 8, '2022-12-21 23:28:49', 1),
(38, '', 28, '2022-12-21 23:36:56', 1),
(39, '', 27, '2022-12-21 23:37:01', 1),
(40, '', 26, '2022-12-21 23:37:09', 1),
(42, '', 25, '2022-12-21 23:39:05', 1),
(44, '', 24, '2022-12-21 23:39:25', 1),
(45, '', 23, '2022-12-21 23:39:33', 1),
(46, '', 22, '2022-12-21 23:39:46', 1),
(47, '', 21, '2022-12-21 23:39:53', 1),
(48, '', 20, '2022-12-21 23:40:00', 1),
(49, '', 19, '2022-12-21 23:40:07', 1),
(50, '', 18, '2022-12-21 23:40:16', 1),
(51, '', 17, '2022-12-21 23:40:28', 1),
(52, '', 16, '2022-12-21 23:40:36', 1),
(53, '', 15, '2022-12-21 23:40:43', 1),
(54, '', 14, '2022-12-21 23:40:48', 1),
(55, '', 29, '2022-12-21 23:48:14', 0),
(56, '', 16, '2022-12-22 16:01:37', 0),
(57, '', 16, '2022-12-22 16:02:36', 0),
(58, '', 16, '2022-12-22 16:05:07', 0),
(59, '', 16, '2022-12-22 16:06:49', 0),
(60, '', 16, '2022-12-22 16:07:08', 0),
(61, '', 16, '2022-12-22 16:08:12', 0),
(62, '', 16, '2022-12-22 16:13:10', 0),
(63, '', 16, '2022-12-22 16:14:09', 0),
(64, '', 21, '2022-12-22 16:15:53', 0),
(90, '', 28, '2022-12-22 16:46:51', 0),
(92, '', 28, '2022-12-22 16:48:05', 0),
(93, '', 28, '2022-12-22 16:49:09', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zdjecia_komentarze`
--

CREATE TABLE `zdjecia_komentarze` (
  `id` int(11) NOT NULL,
  `id_zdjecia` int(11) NOT NULL,
  `id_uzytkownika` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `komentarz` text COLLATE utf8_polish_ci NOT NULL,
  `zaakceptowany` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `zdjecia_komentarze`
--

INSERT INTO `zdjecia_komentarze` (`id`, `id_zdjecia`, `id_uzytkownika`, `date`, `komentarz`, `zaakceptowany`) VALUES
(2, 12, 3, '2022-12-21 23:24:35', 'Lorem ipsum dolor sit amet, consectetur adipisci elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur. Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint obcaecat cupiditat n', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zdjecia_oceny`
--

CREATE TABLE `zdjecia_oceny` (
  `id_zdjecia` int(11) NOT NULL,
  `id_uzytkownika` int(11) NOT NULL,
  `ocena` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `zdjecia_oceny`
--

INSERT INTO `zdjecia_oceny` (`id_zdjecia`, `id_uzytkownika`, `ocena`) VALUES
(12, 3, 8),
(24, 3, 7),
(12, 1, 7);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `albumy`
--
ALTER TABLE `albumy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_uzytkownika` (`id_uzytkownika`);

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `zdjecia`
--
ALTER TABLE `zdjecia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_album` (`id_album`);

--
-- Indeksy dla tabeli `zdjecia_komentarze`
--
ALTER TABLE `zdjecia_komentarze`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_zdjecia_2` (`id_zdjecia`,`id_uzytkownika`),
  ADD KEY `id_uzytkownika` (`id_uzytkownika`),
  ADD KEY `id_zdjecia` (`id_zdjecia`,`id_uzytkownika`) USING BTREE;

--
-- Indeksy dla tabeli `zdjecia_oceny`
--
ALTER TABLE `zdjecia_oceny`
  ADD KEY `id_zdjecia` (`id_zdjecia`,`id_uzytkownika`),
  ADD KEY `id_uzytkownika` (`id_uzytkownika`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `albumy`
--
ALTER TABLE `albumy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `zdjecia`
--
ALTER TABLE `zdjecia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT dla tabeli `zdjecia_komentarze`
--
ALTER TABLE `zdjecia_komentarze`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
