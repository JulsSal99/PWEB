-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mar 05, 2022 alle 18:37
-- Versione del server: 10.4.22-MariaDB
-- Versione PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `meetupplanner`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `dipartimento`
--

CREATE TABLE `dipartimento` (
  `Nome` varchar(50) NOT NULL,
  `Indirizzo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `dipartimento`
--

INSERT INTO `dipartimento` (`Nome`, `Indirizzo`) VALUES
('caloria', 'via caloria, 18, milano'),
('dante', 'via dante, 43, milano'),
('ungheretti', 'via ungheretti, 34, milano');

-- --------------------------------------------------------

--
-- Struttura della tabella `dipendente`
--

CREATE TABLE `dipendente` (
  `Email` varchar(50) NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `Cognome` varchar(50) NOT NULL,
  `Ruolo` varchar(50) NOT NULL DEFAULT '' CHECK (`Ruolo` in ('impiegato','direttore')),
  `tipo_impiegato` varchar(50) DEFAULT NULL CHECK (`tipo_impiegato` = 'funzionario' or `tipo_impiegato` = 'capo settore' or `tipo_impiegato` = 'impiegato semplice'),
  `Foto` varchar(50) DEFAULT NULL,
  `Data_nascita` date DEFAULT NULL,
  `Data_proclamazione` date DEFAULT NULL,
  `nome_Dipartimento` varchar(50) NOT NULL,
  `email_auth` varchar(50) DEFAULT NULL,
  `data_auth` date DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `dipendente`
--

INSERT INTO `dipendente` (`Email`, `Nome`, `Cognome`, `Ruolo`, `tipo_impiegato`, `Foto`, `Data_nascita`, `Data_proclamazione`, `nome_Dipartimento`, `email_auth`, `data_auth`, `password`) VALUES
('A.Garf@Marvel.com', 'Andrew', 'Garfield', 'impiegato', 'impiegato semplice', 'profileimg1646486010.jpg', '1983-08-20', NULL, 'dante', 'm.belfiore@gmail.com', '2021-12-16', '123'),
('GianniMela@Fulvio.it', 'Gianni', 'Mela', 'impiegato', 'impiegato semplice', NULL, '2000-12-12', NULL, 'caloria', 'm.belfiore@gmail.com', NULL, 'avanti123'),
('giovanni.monte@azienda.it', 'giovanni', 'monte', 'direttore', NULL, 'profileimg1646064816.jpg', '1976-02-15', '2015-01-12', 'caloria', NULL, NULL, '123'),
('m.belfiore@gmail.com', 'Marisa', 'Belfiore', 'direttore', NULL, 'profileimg1645370263.png', '1985-02-23', '2010-03-04', 'ungheretti', NULL, NULL, 'cavallo'),
('marco.valle@azienda.it', 'Marco', 'Valle', 'impiegato', 'impiegato semplice', NULL, '1989-02-22', NULL, 'caloria', NULL, NULL, 'avanti123'),
('Mario.rossi@azienda.it', 'Mario', 'rossi', 'impiegato', NULL, NULL, '1992-12-10', NULL, 'caloria', 'm.belfiore@gmail.com', '2022-10-10', '123'),
('vale.r@yahooo.it', 'Valentina', 'Rossi', 'impiegato', NULL, 'profileimg1646064890.jpg', '1970-02-07', NULL, 'dante', 'giovanni.monte@azienda.it', '2021-10-30', '123');

-- --------------------------------------------------------

--
-- Struttura della tabella `invitato`
--

CREATE TABLE `invitato` (
  `Accettazione` enum('1','0') DEFAULT '0',
  `motivazione` varchar(255) DEFAULT '',
  `ID_Riunione` int(11) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `invitato`
--

INSERT INTO `invitato` (`Accettazione`, `motivazione`, `ID_Riunione`, `email`) VALUES
(NULL, '', 121, 'Mario.rossi@azienda.it'),
(NULL, '', 121, 'A.Garf@Marvel.com'),
(NULL, '', 121, 'vale.r@yahooo.it'),
(NULL, '', 121, 'm.belfiore@gmail.com'),
('1', '', 132, 'A.Garf@Marvel.com'),
(NULL, '', 132, 'vale.r@yahooo.it'),
(NULL, '', 138, 'Mario.rossi@azienda.it'),
(NULL, '', 138, 'A.Garf@Marvel.com'),
(NULL, '', 140, 'm.belfiore@gmail.com'),
(NULL, '', 141, 'giovanni.monte@azienda.it'),
(NULL, '', 141, 'Mario.rossi@azienda.it'),
(NULL, '', 142, 'giovanni.monte@azienda.it'),
(NULL, '', 143, 'Mario.rossi@azienda.it'),
(NULL, '', 144, 'giovanni.monte@azienda.it'),
(NULL, '', 144, 'GianniMela@Fulvio.it'),
(NULL, '', 147, 'giovanni.monte@azienda.it'),
('0', 'Famiglia', 147, 'GianniMela@Fulvio.it'),
(NULL, '', 147, 'marco.valle@azienda.it'),
('1', '', 147, 'm.belfiore@gmail.com'),
(NULL, '', 148, 'giovanni.monte@azienda.it'),
('0', '', 148, 'm.belfiore@gmail.com'),
(NULL, '', 149, 'giovanni.monte@azienda.it'),
(NULL, '', 149, 'm.belfiore@gmail.com'),
(NULL, '', 149, 'Mario.rossi@azienda.it'),
(NULL, '', 150, 'Mario.rossi@azienda.it'),
(NULL, '', 150, 'vale.r@yahooo.it'),
(NULL, '', 150, 'GianniMela@Fulvio.it'),
(NULL, '', 151, 'GianniMela@Fulvio.it'),
(NULL, '', 151, 'marco.valle@azienda.it'),
(NULL, '', 151, 'Mario.rossi@azienda.it'),
('0', 'Amore', 151, 'm.belfiore@gmail.com'),
(NULL, '', 152, 'giovanni.monte@azienda.it'),
(NULL, '', 152, 'Mario.rossi@azienda.it');

-- --------------------------------------------------------

--
-- Struttura della tabella `riunione`
--

CREATE TABLE `riunione` (
  `ID_Riunione` int(11) NOT NULL,
  `tema` varchar(50) DEFAULT '',
  `data` date DEFAULT NULL,
  `orario_inizio` time DEFAULT NULL,
  `orario_fine` time DEFAULT NULL,
  `email_creator` varchar(50) DEFAULT NULL,
  `ID_Sala` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `riunione`
--

INSERT INTO `riunione` (`ID_Riunione`, `tema`, `data`, `orario_inizio`, `orario_fine`, `email_creator`, `ID_Sala`) VALUES
(121, 'Consegna', '2022-02-25', '10:00:00', '13:00:00', 'giovanni.monte@azienda.it', 103),
(132, 'con', '2023-02-01', '12:00:00', '13:00:00', 'giovanni.monte@azienda.it', 103),
(134, 'con', '2022-02-26', '12:00:00', '13:00:00', 'giovanni.monte@azienda.it', 101),
(138, 'Cons', '2023-02-12', '12:00:00', '13:00:00', 'giovanni.monte@azienda.it', 101),
(140, 'Consegna', '2022-02-28', '12:00:00', '13:00:00', 'giovanni.monte@azienda.it', 100),
(141, 'Consegna', '2022-02-28', '12:00:00', '13:00:00', 'm.belfiore@gmail.com', 103),
(142, 'Panini', '2022-03-01', '12:00:00', '13:00:00', 'm.belfiore@gmail.com', 103),
(143, 'con', '2023-03-12', '12:00:00', '13:00:00', 'giovanni.monte@azienda.it', 101),
(144, 'Barbabietole', '2022-04-15', '12:00:00', '13:00:00', 'm.belfiore@gmail.com', 105),
(145, 'Festivita', '2025-01-12', '12:30:00', '18:02:00', 'm.belfiore@gmail.com', 100),
(147, 'Revisione', '2022-03-05', '21:02:00', '21:03:00', 'A.Garf@Marvel.com', 100),
(148, 'Calcetto', '2023-02-28', '16:00:00', '17:00:00', 'GianniMela@Fulvio.it', 105),
(149, 'Revisione', '2022-03-05', '19:00:00', '20:00:00', 'GianniMela@Fulvio.it', 115),
(150, 'Bolle', '2022-03-05', '19:00:00', '20:00:00', 'A.Garf@Marvel.com', 105),
(151, 'Pallavolo', '2022-03-05', '18:30:00', '19:00:00', 'giovanni.monte@azienda.it', 101),
(152, 'con', '2022-03-01', '13:00:00', '14:00:00', 'm.belfiore@gmail.com', 103);

-- --------------------------------------------------------

--
-- Struttura della tabella `sala_riunione`
--

CREATE TABLE `sala_riunione` (
  `ID_Sala` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `n_posti` int(11) DEFAULT 0,
  `n_tavoli` int(11) DEFAULT 0,
  `n_computer` int(11) DEFAULT NULL,
  `n_proiettori` int(11) DEFAULT NULL,
  `n_lavagne` int(11) DEFAULT NULL,
  `nome_Dipartimento` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `sala_riunione`
--

INSERT INTO `sala_riunione` (`ID_Sala`, `nome`, `n_posti`, `n_tavoli`, `n_computer`, `n_proiettori`, `n_lavagne`, `nome_Dipartimento`) VALUES
(100, 'alfa', 100, 4, NULL, 1, 3, 'caloria'),
(101, 'beta', 120, 3, 2, NULL, 1, 'dante'),
(103, 'teta', 140, 5, 10, NULL, NULL, 'dante'),
(105, 'gamma', 150, 1, 15, 13, 2, 'ungheretti'),
(115, 'sala grande', 150, 1, NULL, NULL, NULL, 'ungheretti');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `dipartimento`
--
ALTER TABLE `dipartimento`
  ADD PRIMARY KEY (`Nome`),
  ADD UNIQUE KEY `Indirizzo` (`Indirizzo`);

--
-- Indici per le tabelle `dipendente`
--
ALTER TABLE `dipendente`
  ADD PRIMARY KEY (`Email`),
  ADD KEY `nome_Dipartimento` (`nome_Dipartimento`),
  ADD KEY `email_auth` (`email_auth`);

--
-- Indici per le tabelle `invitato`
--
ALTER TABLE `invitato`
  ADD KEY `ID_Riunione` (`ID_Riunione`),
  ADD KEY `email` (`email`);

--
-- Indici per le tabelle `riunione`
--
ALTER TABLE `riunione`
  ADD PRIMARY KEY (`ID_Riunione`),
  ADD KEY `ID_Riunione` (`ID_Riunione`),
  ADD KEY `email_creator` (`email_creator`),
  ADD KEY `ID_Sala` (`ID_Sala`);

--
-- Indici per le tabelle `sala_riunione`
--
ALTER TABLE `sala_riunione`
  ADD PRIMARY KEY (`ID_Sala`),
  ADD KEY `nome_Dipartimento` (`nome_Dipartimento`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `riunione`
--
ALTER TABLE `riunione`
  MODIFY `ID_Riunione` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `dipendente`
--
ALTER TABLE `dipendente`
  ADD CONSTRAINT `dipendente_ibfk_1` FOREIGN KEY (`nome_Dipartimento`) REFERENCES `dipartimento` (`Nome`),
  ADD CONSTRAINT `dipendente_ibfk_2` FOREIGN KEY (`email_auth`) REFERENCES `dipendente` (`Email`) ON DELETE SET NULL;

--
-- Limiti per la tabella `invitato`
--
ALTER TABLE `invitato`
  ADD CONSTRAINT `invitato_ibfk_1` FOREIGN KEY (`ID_Riunione`) REFERENCES `riunione` (`ID_Riunione`) ON DELETE CASCADE,
  ADD CONSTRAINT `invitato_ibfk_2` FOREIGN KEY (`email`) REFERENCES `dipendente` (`Email`) ON DELETE CASCADE;

--
-- Limiti per la tabella `riunione`
--
ALTER TABLE `riunione`
  ADD CONSTRAINT `riunione_ibfk_1` FOREIGN KEY (`email_creator`) REFERENCES `dipendente` (`Email`) ON DELETE SET NULL,
  ADD CONSTRAINT `riunione_ibfk_2` FOREIGN KEY (`ID_Sala`) REFERENCES `sala_riunione` (`ID_Sala`);

--
-- Limiti per la tabella `sala_riunione`
--
ALTER TABLE `sala_riunione`
  ADD CONSTRAINT `sala_riunione_ibfk_1` FOREIGN KEY (`nome_Dipartimento`) REFERENCES `dipartimento` (`Nome`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
