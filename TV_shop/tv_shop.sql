-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2023. Nov 03. 20:27
-- Kiszolgáló verziója: 10.4.28-MariaDB
-- PHP verzió: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `tv_shop`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `megrendeles`
--

CREATE TABLE `megrendeles` (
  `userid` int(10) UNSIGNED NOT NULL,
  `termekid` int(10) UNSIGNED NOT NULL,
  `mennyiseg` int(10) NOT NULL,
  `osszeg` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `termekek`
--

CREATE TABLE `termekek` (
  `termekid` int(10) UNSIGNED NOT NULL,
  `termek_nev` varchar(100) NOT NULL,
  `felbontas` varchar(50) NOT NULL,
  `kepatlo` varchar(100) NOT NULL,
  `termek_ar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `termekek`
--

INSERT INTO `termekek` (`termekid`, `termek_nev`, `felbontas`, `kepatlo`, `termek_ar`) VALUES
(1, 'Smsung', '4K Ultra HD', ' 55\" (139,7 cm)', '159.900'),
(2, 'LD', 'Full HD', '32\'\' (82 cm)', '89.900');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `userid` int(10) UNSIGNED NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `megrendeles`
--
ALTER TABLE `megrendeles`
  ADD UNIQUE KEY `userid` (`userid`),
  ADD UNIQUE KEY `termekid` (`termekid`);

--
-- A tábla indexei `termekek`
--
ALTER TABLE `termekek`
  ADD UNIQUE KEY `termekid` (`termekid`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `userid` (`userid`);

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `termekek`
--
ALTER TABLE `termekek`
  ADD CONSTRAINT `termekek_ibfk_1` FOREIGN KEY (`termekid`) REFERENCES `megrendeles` (`termekid`);

--
-- Megkötések a táblához `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `megrendeles` (`userid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
