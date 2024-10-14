-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 27 Lut 2023, 18:11
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
(29, 'Album', '2022-12-21 23:48:10', 4),
(30, 'album tes', '2023-02-27 18:03:41', 3),
(31, 'album testy', '2023-02-27 18:03:47', 3),
(32, 'album testowy', '2023-02-27 18:03:57', 3),
(33, 'album dla na', '2023-02-27 18:04:04', 3),
(34, '1', '2023-02-27 18:04:15', 3),
(35, '2', '2023-02-27 18:04:17', 3),
(36, '3', '2023-02-27 18:04:19', 3),
(37, '4', '2023-02-27 18:04:21', 3),
(38, '5', '2023-02-27 18:04:23', 3);

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
(3, 'TestUser', 'cf7e29f8c5d70abb36ab16eb984e7102', 'TestEmail@test.com', '2022-12-21', 'administrator', 1),
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
(8, 'Testowy opis', 10, '2022-12-21 23:16:29', 0),
(9, 'Tes opisu \'\"\'\'\'//asad', 10, '2022-12-21 23:16:40', 1),
(10, 'Opisik', 9, '2022-12-21 23:17:04', 1),
(11, 'dsadsaad', 8, '2022-12-21 23:17:18', 1),
(12, 'Opcjonalne', 11, '2022-12-21 23:17:37', 1),
(13, '', 12, '2022-12-21 23:17:50', 1),
(15, '', 8, '2022-12-21 23:18:44', 1),
(16, '', 13, '2022-12-21 23:25:20', 1),
(17, '', 8, '2022-12-21 23:25:49', 1),
(18, '', 8, '2022-12-21 23:25:54', 0),
(19, '', 8, '2022-12-21 23:25:58', 1),
(20, '', 8, '2022-12-21 23:26:02', 1),
(21, '', 8, '2022-12-21 23:26:19', 0),
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
(61, '', 16, '2022-12-22 16:08:12', 0),
(62, '', 16, '2022-12-22 16:13:10', 0),
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
(2, 12, 3, '2022-12-21 23:24:35', 'Lorem ipsum dolor sit amet, consectetur adipisci elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur. Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint obcaecat cupiditat n', 1),
(3, 45, 3, '2023-02-27 18:07:08', ' {Man} Once upon a time there was a lovely princess.\r\n\r\nBut she had an enchantment upon her of a fearful sort which could only \r\n\r\nbe broken by love\'s first kiss.\r\n\r\nShe was locked away in a castle guarded by a terrible fire-breathing \r\n\r\ndragon.\r\n\r\nMany brave knigts had attempted to free her from this dreadful prison, \r\n\r\nbut non prevailed.\r\n\r\nShe waited in the dragon\'s keep in the highest room of the tallest \r\n\r\ntower for her true love and true love\'s first kiss.\r\n\r\n{Laughing} \r\n\r\nLike that\'s ever gonna happen.\r\n\r\n{Paper Rusting, Toilet Flushes}\r\n\r\nWhat a load of - \r\n\r\n\r\n\r\nSomebody once told me the world is gonna roll me\r\n\r\nI ain\'t the sharpest tool in the shed\r\n\r\nShe was lookin\' kind of dumb with her finger and her thumb\r\n\r\nIn the shape of an ', 0),
(4, 52, 3, '2023-02-27 18:07:32', ' \r\nAccording to all known laws\r\nof aviation,\r\n\r\n  \r\nthere is no way a bee\r\nshould be able to fly.\r\n\r\n  \r\nIts wings are too small to get\r\nits fat little body off the ground.\r\n\r\n  \r\nThe bee, of course, flies anyway\r\n\r\n  \r\nbecause bees don\'t care\r\nwhat humans think is impossible.\r\n\r\n  \r\nYellow, black. Yellow, black.\r\nYellow, black. Yellow, black.\r\n\r\n  \r\nOoh, black and yellow!\r\nLet\'s shake it up a little.\r\n\r\n  \r\nBarry! Breakfast is ready!\r\n\r\n  \r\nOoming!\r\n\r\n  \r\nHang on a second.\r\n\r\n  \r\nHello?\r\n\r\n  \r\n- Barry?\r\n- Adam?\r\n\r\n  \r\n- Oan you believe this is happening?\r\n- I can\'t. I\'ll pick you up.\r\n\r\n  \r\nLooking sharp.\r\n\r\n  \r\nUse the stairs. Your father\r\npaid good money for those.\r\n\r\n  \r\nSorry. I\'m excited.\r\n\r\n  \r\nHere\'s the graduate.\r\nWe\'re very proud of you, son.\r\n\r\n  \r\nA perfect report card, all B\'s.\r\n\r\n  \r\nVery proud.\r\n\r\n  \r\nMa! I got a thing going here.\r\n\r\n  \r\n- You got lint on your fuzz.\r\n- Ow! That\'s me!\r\n\r\n  \r\n- Wave to us! We\'ll be in row 118,000.\r\n- Bye!\r\n\r\n  \r\nBarry, I told you,\r\nstop flying in the house!\r\n\r\n  \r\n- Hey, Adam.\r\n- Hey, Barry.\r\n\r\n  \r\n- Is that fuzz gel?\r\n- A little. Special day, graduation.\r\n\r\n  \r\nNever thought I\'d make it.\r\n\r\n  \r\nThree days grade school,\r\nthree days high school.\r\n\r\n  \r\nThose were awkward.\r\n\r\n  \r\nThree days college. I\'m glad I took\r\na day and hitchhiked around the hive.\r\n\r\n  \r\nYou did come back different.', 0),
(5, 52, 3, '2023-02-27 18:07:58', 'We\'re no strangers to love\r\nYou know the rules and so do I (do I)\r\nA full commitment\'s what I\'m thinking of\r\nYou wouldn\'t get this from any other guy\r\nI just wanna tell you how I\'m feeling\r\nGotta make you understand\r\nNever gonna give you up\r\nNever gonna let you down\r\nNever gonna run around and desert you\r\nNever gonna make you cry\r\nNever gonna say goodbye\r\nNever gonna tell a lie and hurt you\r\nWe\'ve known each other for so long\r\nYour heart\'s been aching, but you\'re too shy to say it (say it)\r\nInside, we both know what\'s been going on (going on)\r\nWe know the game and we\'re gonna play it\r\nAnd if you ask me how I\'m feeling\r\nDon\'t tell me you\'re too blind to see\r\nNever gonna give you up\r\nNever gonna let you down\r\nNever gonna run around and desert you\r\nNever gonna make you cry\r\nNever gonna say goodbye\r\nNever gonna tell a lie and hurt you\r\nNever gonna give you up\r\nNever gonna let you down\r\nNever gonna run around and desert you\r\nNever gonna make you cry\r\nNever gonna say goodbye\r\nNever gonna tell a lie and hurt you\r\nWe\'ve known each other for so long\r\nYour heart\'s been aching, but you\'re too shy to say it (to say it)\r\nInside, we both know what\'s been going on (going on)\r\nWe know the game and we\'re gonna play it\r\nI just wanna tell you how I\'m feeling\r\nGotta make you understand', 0),
(6, 52, 3, '2023-02-27 18:08:15', 'I\'ve been cheated by you since I don\'t know when\r\nSo I made up my mind, it must come to an end\r\nLook at me now, will I ever learn\r\nI don\'t know how, but I suddenly lose control\r\nThere\'s a fire within my soul\r\nand I can hear a bell ring\r\n(One more look) and I forget everything, whoa\r\nMamma mia, here I go again\r\nMy, my, how can I resist you?\r\nMamma mia, does it show again\r\nMy, my, just how much I\'ve missed you?\r\nYes, I\'ve been brokenhearted\r\nBlue since the day we parted\r\nWhy, why did I ever let you go?\r\nMamma mia, now I really know\r\nMy, my, I could never let you go\r\nI\'ve been angry and sad about things that you do\r\nI can\'t count all the times that I\'ve told you we\'re through\r\nAnd when you go, when you slam the door\r\nI think you know that you won\'t be away too long\r\nYou know that I\'m not that strong', 0),
(7, 46, 3, '2023-02-27 18:08:49', 'They see me rollin\'\r\nThey hatin\'\r\nPatrollin\' and tryna catch me ridin\' dirty\r\nTryna catch me ridin\' dirty\r\nTryna catch me ridin\' dirty\r\nTryna catch me ridin\' dirty\r\nTryna catch me ridin\' dirty\r\nMy music\'s so loud\r\nI\'m swangin\'\r\nThey hopin\' that they gon\' catch me ridin\' dirty\r\nTryna catch me ridin\' dirty\r\nTryna catch me ridin\' dirty\r\nTryna catch me ridin\' dirty\r\nTryna catch me ridin\' dirty', 0),
(8, 46, 3, '2023-02-27 18:09:16', 'As he came into the window\r\nIt was the sound of a crescendo\r\nHe came into her apartment\r\nHe left the bloodstains on the carpet\r\nShe ran underneath the table\r\nHe could see she was unable\r\nSo she ran into the bedroom\r\nShe was struck down\r\nIt was her doom\r\nAnnie, are you okay?\r\nSo, Annie, are you okay?\r\nAre you okay, Annie?\r\nAnnie, are you okay?\r\nSo, Annie, are you okay?\r\nAre you okay, Annie?\r\nAnnie, are you okay?\r\nSo, Annie, are you okay?\r\nAre you okay, Annie?\r\nAnnie, are you okay?\r\nSo, Annie, are you okay?\r\nAre you okay, Annie?', 0),
(9, 46, 3, '2023-02-27 18:09:41', 'Czym jest Lorem Ipsum?\r\nLorem Ipsum jest tekstem stosowanym jako przykładowy wypełniacz w przemyśle poligraficznym. Został po raz pierwszy użyty w XV w. przez nieznanego drukarza do wypełnienia tekstem próbnej książki. Pięć wieków później zaczął być używany przemyśle elektronicznym, pozostając praktycznie niezmienionym. Spopularyzował się w latach 60. XX w. wraz z publikacją arkuszy Letrasetu, zawierających fragmenty Lorem Ipsum, a ostatnio z zawierającym różne wersje Lorem Ipsum oprogramowaniem przeznaczonym do realizacji druków na komputerach osobistych, jak Aldus PageMaker', 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
