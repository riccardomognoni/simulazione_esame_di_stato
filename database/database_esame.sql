-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 23, 2024 alle 17:35
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database_esame`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `admin`
--

CREATE TABLE `admin` (
  `ID` int(11) NOT NULL,
  `nome` varchar(32) NOT NULL,
  `cognome` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dump dei dati per la tabella `admin`
--

INSERT INTO `admin` (`ID`, `nome`, `cognome`, `email`, `password`) VALUES
(1, 'admin', '1', 'admin1@gmail.com', 'e00cf25ad42683b3df678c61f42c6bda');

-- --------------------------------------------------------

--
-- Struttura della tabella `bicicletta`
--

CREATE TABLE `bicicletta` (
  `ID` int(11) NOT NULL,
  `KMtotali` float NOT NULL,
  `gps` varchar(16) NOT NULL,
  `RFID` varchar(16) NOT NULL,
  `attiva` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dump dei dati per la tabella `bicicletta`
--

INSERT INTO `bicicletta` (`ID`, `KMtotali`, `gps`, `RFID`, `attiva`) VALUES
(1, 0, 'GPS001', 'RFID001', 1),
(2, 0, 'GPS002', 'RFID002', 1),
(3, 0, 'GPS003', 'RFID003', 1),
(6, 27, 'GPS004', 'RFID004', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `cliente`
--

CREATE TABLE `cliente` (
  `ID` int(11) NOT NULL,
  `nome` varchar(32) NOT NULL,
  `cognome` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(32) NOT NULL,
  `numero_tessera` int(5) NOT NULL,
  `carta_credito` varchar(16) NOT NULL,
  `IDindirizzo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dump dei dati per la tabella `cliente`
--

INSERT INTO `cliente` (`ID`, `nome`, `cognome`, `email`, `password`, `numero_tessera`, `carta_credito`, `IDindirizzo`) VALUES
(17, 'Luca ', 'Bes', 'lucabesh@gmail.com', '0e727e10ae5fdc2b926ea06c8a41aceb', 93532, '2222333322223333', 15),
(18, 'Riccardo', 'Mognoni', 'riccardomognoni@gmail.com', '8ca432e2f074d100b0348b1cda090c27', 29017, '1111222233334444', 17);

-- --------------------------------------------------------

--
-- Struttura della tabella `indirizzo`
--

CREATE TABLE `indirizzo` (
  `ID` int(11) NOT NULL,
  `via` varchar(64) NOT NULL,
  `citta` varchar(32) NOT NULL,
  `latitudine` text NOT NULL,
  `longitudine` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dump dei dati per la tabella `indirizzo`
--

INSERT INTO `indirizzo` (`ID`, `via`, `citta`, `latitudine`, `longitudine`) VALUES
(7, 'Via Crotto 21', 'CantÃ¹', '45.7468552', '9.1287876'),
(9, 'Via Vergani ', 'CantÃ¹', '45.7445157', '9.1292519'),
(15, 'Via Giacomo Matteotti', 'CantÃ¹', '45.7378528', '9.1284712'),
(17, 'Via Verdi', 'CantÃ¹', '45.7237463', '9.119811'),
(18, 'Piazza Garibaldi', 'CantÃ¹', '45.7397039', '9.1286697'),
(19, 'Via Como', 'CantÃ¹', '45.7541878', '9.1236119');

-- --------------------------------------------------------

--
-- Struttura della tabella `operazione`
--

CREATE TABLE `operazione` (
  `ID` int(11) NOT NULL,
  `tipo` enum('noleggio','riconsegna') NOT NULL,
  `orario` datetime NOT NULL,
  `tariffa` float NOT NULL,
  `distanza_percorsa` float NOT NULL,
  `IDcliente` int(11) DEFAULT NULL,
  `IDbicicletta` int(11) NOT NULL,
  `IDstazione` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dump dei dati per la tabella `operazione`
--

INSERT INTO `operazione` (`ID`, `tipo`, `orario`, `tariffa`, `distanza_percorsa`, `IDcliente`, `IDbicicletta`, `IDstazione`) VALUES
(7, 'noleggio', '2024-05-23 16:33:30', 0, 0, 18, 1, 6),
(8, 'riconsegna', '2024-05-23 16:33:42', 5.6, 7, 18, 1, 6),
(10, 'riconsegna', '2024-05-23 16:35:11', 0, 0, NULL, 2, 6),
(11, 'riconsegna', '2024-05-23 16:35:19', 0, 0, NULL, 3, 5),
(12, 'riconsegna', '2024-05-23 17:16:03', 0, 0, NULL, 6, 8),
(13, 'noleggio', '2024-05-23 17:17:36', 0, 0, 17, 6, 8),
(14, 'riconsegna', '2024-05-23 17:17:50', 9.6, 12, 17, 6, 7),
(15, 'noleggio', '2024-05-23 17:33:48', 0, 0, 17, 6, 7),
(16, 'riconsegna', '2024-05-23 17:34:19', 21.6, 27, 17, 6, 8);

-- --------------------------------------------------------

--
-- Struttura della tabella `stazione`
--

CREATE TABLE `stazione` (
  `ID` int(11) NOT NULL,
  `nome` varchar(16) NOT NULL,
  `numero_slot` int(11) NOT NULL,
  `IDindirizzo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dump dei dati per la tabella `stazione`
--

INSERT INTO `stazione` (`ID`, `nome`, `numero_slot`, `IDindirizzo`) VALUES
(5, 'stazione 1', 14, 7),
(6, 'stazione 2', 24, 9),
(7, 'stazione 3', 45, 18),
(8, 'stazione 4', 15, 19);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indici per le tabelle `bicicletta`
--
ALTER TABLE `bicicletta`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `email` (`email`,`numero_tessera`),
  ADD UNIQUE KEY `email_2` (`email`),
  ADD UNIQUE KEY `IDindirizzo_2` (`IDindirizzo`),
  ADD UNIQUE KEY `numero_tessera` (`numero_tessera`),
  ADD KEY `IDindirizzo` (`IDindirizzo`);

--
-- Indici per le tabelle `indirizzo`
--
ALTER TABLE `indirizzo`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `operazione`
--
ALTER TABLE `operazione`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDcliente` (`IDcliente`,`IDbicicletta`,`IDstazione`),
  ADD KEY `IDbicicletta` (`IDbicicletta`),
  ADD KEY `IDstazione` (`IDstazione`);

--
-- Indici per le tabelle `stazione`
--
ALTER TABLE `stazione`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `codice` (`nome`),
  ADD KEY `IDindirizzo` (`IDindirizzo`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `bicicletta`
--
ALTER TABLE `bicicletta`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT per la tabella `cliente`
--
ALTER TABLE `cliente`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT per la tabella `indirizzo`
--
ALTER TABLE `indirizzo`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT per la tabella `operazione`
--
ALTER TABLE `operazione`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT per la tabella `stazione`
--
ALTER TABLE `stazione`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`IDindirizzo`) REFERENCES `indirizzo` (`ID`);

--
-- Limiti per la tabella `operazione`
--
ALTER TABLE `operazione`
  ADD CONSTRAINT `operazione_ibfk_1` FOREIGN KEY (`IDcliente`) REFERENCES `cliente` (`ID`),
  ADD CONSTRAINT `operazione_ibfk_2` FOREIGN KEY (`IDbicicletta`) REFERENCES `bicicletta` (`ID`),
  ADD CONSTRAINT `operazione_ibfk_3` FOREIGN KEY (`IDstazione`) REFERENCES `stazione` (`ID`);

--
-- Limiti per la tabella `stazione`
--
ALTER TABLE `stazione`
  ADD CONSTRAINT `stazione_ibfk_1` FOREIGN KEY (`IDindirizzo`) REFERENCES `indirizzo` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
