-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 25 Sie 2022, 19:02
-- Wersja serwera: 10.4.24-MariaDB
-- Wersja PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `bank`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `autoryzacje`
--

CREATE TABLE `autoryzacje` (
  `ID` int(11) NOT NULL,
  `Konto_firmowe` int(11) NOT NULL,
  `Konto_uzytkownika` int(11) NOT NULL,
  `Kwota` int(11) NOT NULL,
  `Data` varchar(30) NOT NULL,
  `Active` int(11) NOT NULL,
  `User_data` varchar(1000) NOT NULL,
  `Nazwa_firmy` varchar(100) NOT NULL,
  `Tytul` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `autoryzacje`
--

INSERT INTO `autoryzacje` (`ID`, `Konto_firmowe`, `Konto_uzytkownika`, `Kwota`, `Data`, `Active`, `User_data`, `Nazwa_firmy`, `Tytul`) VALUES
(1, 3527173, 6596160, 50, '2021-10-20 11:51:28', 2, '22', 'System zarządzania narzędziami', 'zaliczka za wypożyczenie'),
(2, 3527173, 6596160, 50, '2021-10-20 12:11:41', 2, '24', 'System zarządzania narzędziami', 'zaliczka za wypożyczenie'),
(3, 3527173, 6596160, 50, '2021-10-20 14:01:05', 2, '22', 'System zarządzania narzędziami', 'zaliczka za wypożyczenie');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `historia_przelewow`
--

CREATE TABLE `historia_przelewow` (
  `ID` int(11) NOT NULL,
  `Nr_OD` int(11) NOT NULL,
  `Nr_DO` int(11) NOT NULL,
  `Kwota` decimal(20,2) NOT NULL,
  `Data` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `historia_przelewow`
--

INSERT INTO `historia_przelewow` (`ID`, `Nr_OD`, `Nr_DO`, `Kwota`, `Data`) VALUES
(1, 6596160, 3527173, '50.00', '2021-10-20 11:52:02'),
(2, 6596160, 3527173, '50.00', '2021-10-20 12:12:00'),
(3, 6596160, 3527173, '50.00', '2021-10-20 14:01:16'),
(4, 6531461, 2332165, '500.00', '2021-10-20 14:07:31');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pozyczki`
--

CREATE TABLE `pozyczki` (
  `ID` int(11) NOT NULL,
  `ID_Uzytkownika` int(11) NOT NULL,
  `Kwota` decimal(20,2) NOT NULL,
  `Data` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `pozyczki`
--

INSERT INTO `pozyczki` (`ID`, `ID_Uzytkownika`, `Kwota`, `Data`) VALUES
(4, 8, '100.00', '2021-10-20 14:08:32');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rachunki`
--

CREATE TABLE `rachunki` (
  `ID` int(11) NOT NULL,
  `ID_Uzytkownika` int(11) NOT NULL,
  `Nr_konta` int(11) NOT NULL,
  `Stan_konta` decimal(20,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `rachunki`
--

INSERT INTO `rachunki` (`ID`, `ID_Uzytkownika`, `Nr_konta`, `Stan_konta`) VALUES
(1, 1, 6944321, '1999.80'),
(2, 2, 3418538, '1000.00'),
(3, 3, 6531461, '500.00'),
(4, 4, 6647947, '9960500.00'),
(5, 5, 789138, '10.00'),
(6, 6, 6596160, '850.00'),
(7, 7, 3527173, '150.00'),
(8, 8, 2332165, '580.00'),
(9, 9, 6663210, '0.00');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `ID` int(11) NOT NULL,
  `Login` varchar(30) NOT NULL,
  `Haslo` varchar(64) NOT NULL,
  `Imie` varchar(30) NOT NULL,
  `Nazwisko` varchar(30) NOT NULL,
  `Nr_konta` int(11) NOT NULL,
  `Ostatnie_logowanie` varchar(30) NOT NULL,
  `Grupa` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`ID`, `Login`, `Haslo`, `Imie`, `Nazwisko`, `Nr_konta`, `Ostatnie_logowanie`, `Grupa`) VALUES
(1, 'admin', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'Admin', 'Admin', 6944321, '2022-08-12 00:43:12', 'Administrator'),
(2, 'pracownik', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'Pracownik', 'Pracownik', 3418538, '2021-10-20 14:08:16', 'Pracownik'),
(3, 'user', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'User', 'User', 6531461, '2021-10-20 14:08:08', 'Uzytkownik'),
(6, 'klient1', 'e10adc3949ba59abbe56e057f20f883e', 'klient1', 'klient1', 6596160, '2021-10-20 13:49:40', 'Uzytkownik'),
(7, 'sys', 'e10adc3949ba59abbe56e057f20f883e', 'System zarządzania narzędziami', 'Firma', 3527173, '2021-10-20 11:51:07', 'Uzytkownik'),
(8, 'jank', '9e38e8d688743e0d07d669a1fcbcd35b', 'Jan', 'Kowalski', 2332165, '2021-10-20 14:07:15', 'Uzytkownik'),
(9, 'Grza', 'cd7ad32e65c470de69a3b55afefda7282c6c65a2f4f796ad9f85d66e58f23a20', 'Grzegorz', 'Adamczyk', 6663210, '2022-08-11 14:01:23', 'Uzytkownik');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wiadomosci`
--

CREATE TABLE `wiadomosci` (
  `ID` int(11) NOT NULL,
  `ID_Uzytkownika` int(11) NOT NULL,
  `Data` varchar(30) NOT NULL,
  `Wiadomosc` longtext NOT NULL,
  `Odpowiedz` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `wiadomosci`
--

INSERT INTO `wiadomosci` (`ID`, `ID_Uzytkownika`, `Data`, `Wiadomosc`, `Odpowiedz`) VALUES
(1, 3, '2021-10-20 14:07:48', 'Test', 'Odp');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `autoryzacje`
--
ALTER TABLE `autoryzacje`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `historia_przelewow`
--
ALTER TABLE `historia_przelewow`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `pozyczki`
--
ALTER TABLE `pozyczki`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `rachunki`
--
ALTER TABLE `rachunki`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `wiadomosci`
--
ALTER TABLE `wiadomosci`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `autoryzacje`
--
ALTER TABLE `autoryzacje`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `historia_przelewow`
--
ALTER TABLE `historia_przelewow`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `pozyczki`
--
ALTER TABLE `pozyczki`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `rachunki`
--
ALTER TABLE `rachunki`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT dla tabeli `wiadomosci`
--
ALTER TABLE `wiadomosci`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
