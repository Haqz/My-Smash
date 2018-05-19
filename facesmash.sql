-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 19 Maj 2018, 16:27
-- Wersja serwera: 10.1.32-MariaDB
-- Wersja PHP: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `facesmash`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `posty`
--

CREATE TABLE `posty` (
  `content` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `id` int(11) NOT NULL,
  `creator` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `posty`
--

INSERT INTO `posty` (`content`, `id`, `creator`, `user_id`) VALUES
('siemaneczko', 28, 'Haqz', 13),
('asfd', 29, 'Haqz', 13),
('asfdsdf', 30, 'Haqz', 13),
('fasdfdsa', 31, 'Haqz', 13),
('sdds', 32, 'Haqz', 13),
('Eldo', 33, 'Haqz', 13),
('EBEEBE EBEEBE EBEEBE EBEEBE EBEEBE EBEEBE EBEEBE EBEEBE EBEEBE EBEEBE EBEEBE EBEEBE EBEEBE EBEEBE EBEEBE EBEEBE EBEEBE EBEEBE EBEEBE EBEEBE EBEEBE EBEEBE EBEEBE EBEEBE EBEEBE EBEEBE EBEEBE EBEEBE EBEEBE EBEEBE EBEEBE EBEEBE EBEEBE EBEEBE EBEEBE EBEEBE EBEEBE EBEEBE EBEEBE EBEEBE EBEEBE EBEEBE EBEEBE EBEEBE EBEEBE EBEEBE EBEEBE EBEEBE EBEEBE EBEEBE EBEEBE EBEEBE EBEEBE EBEEBE EBEEBE EBEEBE EBEEBE EBEEBE EBEEBE EBEEBE ', 34, 'Haqz', 13);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `nick` text NOT NULL,
  `pass` text NOT NULL,
  `email` text NOT NULL,
  `id` int(11) NOT NULL,
  `perm` int(11) NOT NULL,
  `token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`nick`, `pass`, `email`, `id`, `perm`, `token`) VALUES
('12345678', '$2y$10$ks/VnJzleWBBdOVcSX3Y7uJc3Swt/LA8iRcZ0ATGxJiDnpqs0cEEC', '12345678@gmai.co', 30, 0, '');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `posty`
--
ALTER TABLE `posty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `posty`
--
ALTER TABLE `posty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
