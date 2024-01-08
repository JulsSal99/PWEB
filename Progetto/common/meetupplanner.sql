-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Feb 17, 2022 alle 22:31
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
('A.Garf@Marvel.com', 'Andrew', 'Garfield', 'impiegato', 'impiegato semplice', 'confidential.jpg', '1983-08-20', NULL, 'dante', 'm.belfiore@gmail.com', '2021-12-16', NULL),
('GianniMela@Fulvio.it', 'Gianni', 'Mela', 'impiegato', 'funzionario', '', '2022-02-02', NULL, 'caloria', NULL, NULL, '123'),
('giovanni.monte@azienda.it', 'giovanni', 'monte', 'direttore', NULL, 'montagna.png', '1976-02-15', '2015-01-12', 'caloria', NULL, NULL, NULL),
('m.belfiore@gmail.com', 'Marisa', 'Belfiore', 'direttore', NULL, 'gattoUWU.jpg', '1985-02-23', '2010-03-04', 'ungheretti', NULL, NULL, NULL),
('marco.valle@azienda.it', 'marco', 'valle', 'impiegato', NULL, NULL, '1998-06-10', NULL, 'caloria', NULL, NULL, NULL),
('Mario.rossi@azienda.it', 'Mario', 'rossi', 'impiegato', NULL, NULL, '1992-12-10', NULL, 'caloria', NULL, NULL, NULL),
('vale.r@yahooo.it', 'Valentina', 'Rossi', 'impiegato', NULL, 'mare.jpg', '1970-02-07', NULL, 'dante', 'giovanni.monte@azienda.it', '2021-10-30', NULL);

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
('1', '', 100, 'm.belfiore@gmail.com'),
('0', 'Malattia', 100, 'vale.r@yahooo.it'),
(NULL, 'Sto facendo altro', 100, 'A.Garf@Marvel.com'),
('1', '', 102, 'marco.valle@azienda.it'),
('1', '', 102, 'A.Garf@Marvel.com');

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
  `email_creator` varchar(50) NOT NULL,
  `ID_Sala` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `riunione`
--

INSERT INTO `riunione` (`ID_Riunione`, `tema`, `data`, `orario_inizio`, `orario_fine`, `email_creator`, `ID_Sala`) VALUES
(100, 'festività', '2022-12-08', '20:54:15', '22:54:15', 'giovanni.monte@azienda.it', 101),
(102, 'stipendio', '2021-12-08', '15:59:00', '19:56:00', 'Mario.rossi@azienda.it', 101),
(103, 'Esame', '2022-02-24', '12:00:00', '14:00:00', 'm.belfiore@gmail.com', 115),
(116, 'Consegna', '2022-02-20', '12:00:00', '13:00:00', 'm.belfiore@gmail.com', 115);

-- --------------------------------------------------------

--
-- Struttura della tabella `sala_riunione`
--

CREATE TABLE `sala_riunione` (
  `ID_Sala` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `n_posti` int(11) DEFAULT 0,
  `n_tavoli` int(11) DEFAULT 0,
  `strumentazione` varchar(255) DEFAULT '',
  `nome_Dipartimento` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `sala_riunione`
--

INSERT INTO `sala_riunione` (`ID_Sala`, `nome`, `n_posti`, `n_tavoli`, `strumentazione`, `nome_Dipartimento`) VALUES
(100, 'alfa', 100, 4, 'lim e impianto audio', 'caloria'),
(101, 'beta', 120, 3, 'lim e proiettore', 'dante'),
(103, 'teta', 140, 5, 'lim ', 'dante'),
(105, 'gamma', 150, 1, 'lim ', 'ungheretti'),
(115, 'sala grande', 150, 1, 'poltroncine con leggii', 'ungheretti');

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
  MODIFY `ID_Riunione` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

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
  ADD CONSTRAINT `invitato_ibfk_1` FOREIGN KEY (`ID_Riunione`) REFERENCES `riunione` (`ID_Riunione`),
  ADD CONSTRAINT `invitato_ibfk_2` FOREIGN KEY (`email`) REFERENCES `dipendente` (`Email`) ON DELETE CASCADE;

--
-- Limiti per la tabella `riunione`
--
ALTER TABLE `riunione`
  ADD CONSTRAINT `riunione_ibfk_1` FOREIGN KEY (`email_creator`) REFERENCES `dipendente` (`Email`),
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
