-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 19, 2025 alle 18:42
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
-- Database: `medline`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `admin`
--

CREATE TABLE `admin` (
  `IDAdmin` int(2) NOT NULL,
  `Nome` varchar(30) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `PASSWORD` char(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `citta`
--

CREATE TABLE `citta` (
  `IDCitta` int(3) NOT NULL,
  `Nome` varchar(40) NOT NULL,
  `CAP` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `citta`
--

INSERT INTO `citta` (`IDCitta`, `Nome`, `CAP`) VALUES
(1, 'Foggia', '66666'),
(2, 'Mola', '66666');

-- --------------------------------------------------------

--
-- Struttura della tabella `farmacie`
--

CREATE TABLE `farmacie` (
  `IDFarmacia` int(4) NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `Indirizzo` varchar(100) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Telefono` varchar(15) NOT NULL,
  `CODProvince` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `farmaciemedicinali`
--

CREATE TABLE `farmaciemedicinali` (
  `IDFarmacia` int(4) NOT NULL,
  `IDMedicinale` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `medici`
--

CREATE TABLE `medici` (
  `IDMedico` int(5) NOT NULL,
  `Nome` varchar(40) NOT NULL,
  `Cognome` varchar(40) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Telefono` varchar(15) NOT NULL,
  `Indirizzo` varchar(50) NOT NULL,
  `Disponibilita` datetime NOT NULL,
  `Prezzo` decimal(6,2) NOT NULL,
  `CODSpecializzazioni` int(3) NOT NULL,
  `CODProvince` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `medicinali`
--

CREATE TABLE `medicinali` (
  `IDMedicinale` int(7) NOT NULL,
  `Nome` varchar(40) NOT NULL,
  `Prezzo` decimal(6,2) NOT NULL,
  `Scadenza` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `medicinali`
--

INSERT INTO `medicinali` (`IDMedicinale`, `Nome`, `Prezzo`, `Scadenza`) VALUES
(1, 'Tachipirina', 3.50, '2026-12-31'),
(2, 'Moment Act', 4.20, '2026-12-31'),
(3, 'Xanax', 8.75, '2027-06-30');

-- --------------------------------------------------------

--
-- Struttura della tabella `ordini`
--

CREATE TABLE `ordini` (
  `IDOrdine` int(7) NOT NULL,
  `DATA` date NOT NULL,
  `Indirizzo` varchar(100) NOT NULL,
  `Telefono` varchar(20) NOT NULL,
  `Stato` char(1) NOT NULL DEFAULT 'p' COMMENT 'p=in preparazione, s=spedito, c=consegnato',
  `CODProvince` int(11) DEFAULT NULL,
  `Priorita` tinyint(1) NOT NULL DEFAULT 0,
  `CODUtenti` int(7) NOT NULL,
  `CODPagamento` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `ordini`
--

INSERT INTO `ordini` (`IDOrdine`, `DATA`, `Indirizzo`, `Telefono`, `Stato`, `CODProvince`, `Priorita`, `CODUtenti`, `CODPagamento`) VALUES
(3, '2025-05-19', 'via da casa mia', '33333333333', 'i', 1, 0, 4, 1),
(4, '2025-05-19', 'via da casa mia', '33333333333', 'i', 1, 0, 4, 1),
(5, '2025-05-19', 'via da casa mia', '33333333333', 'i', 1, 0, 4, 1),
(6, '2025-05-19', 'via da casa mia', '33333333333', 'i', 1, 0, 4, 1),
(7, '2025-05-19', 'via da casa mia', '33333333333', 'i', 1, 0, 4, 1),
(8, '2025-05-19', 'via da casa mia', '33333333333', 'i', 1, 0, 4, 1),
(9, '2025-05-19', 'via da casa mia', '33333333333', 'i', 1, 0, 4, 2),
(10, '2025-05-19', 'via da casa mia', '33333333333', 'i', 1, 0, 4, 1),
(11, '2025-05-19', 'via da casa mia', '33333333333', 'i', 1, 0, 4, 2),
(12, '2025-05-19', 'via da casa mia', '33333333333', 'i', 1, 0, 4, 1),
(13, '2025-05-19', 'via da casa mia', '33333333333', 'i', 1, 0, 4, 1),
(14, '2025-05-19', 'via da casa mia', '33333333333', 'i', 1, 0, 4, 2),
(15, '2025-05-19', 'via da casa mia', '33333333333', 'i', 1, 0, 5, 1),
(16, '2025-05-19', 'via da casa mia', '33333333333', 'i', 1, 0, 5, 1),
(17, '2025-05-19', 'via da casa mia', '33333333333', 'i', 1, 1, 5, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `ordinimedicinali`
--

CREATE TABLE `ordinimedicinali` (
  `IDOrdine` int(7) NOT NULL,
  `IDMedicinale` int(7) NOT NULL,
  `Quantita` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `ordinimedicinali`
--

INSERT INTO `ordinimedicinali` (`IDOrdine`, `IDMedicinale`, `Quantita`) VALUES
(6, 1, 1),
(7, 1, 1),
(8, 1, 1),
(9, 1, 5),
(10, 1, 1),
(11, 1, 1),
(12, 1, 1),
(13, 1, 1),
(14, 1, 1),
(16, 1, 1),
(17, 2, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `ordinip`
--

CREATE TABLE `ordinip` (
  `IDOrdineP` int(7) NOT NULL,
  `DATA` date NOT NULL,
  `Indirizzo` varchar(100) NOT NULL,
  `Telefono` varchar(20) NOT NULL,
  `Stato` char(1) NOT NULL DEFAULT 'p',
  `CODProvince` int(11) DEFAULT NULL,
  `Priorita` tinyint(1) NOT NULL DEFAULT 0,
  `CODPrescrizioni` int(7) NOT NULL,
  `CODPagamento` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `ordinip`
--

INSERT INTO `ordinip` (`IDOrdineP`, `DATA`, `Indirizzo`, `Telefono`, `Stato`, `CODProvince`, `Priorita`, `CODPrescrizioni`, `CODPagamento`) VALUES
(1, '2025-05-19', 'via da casa mia', '33333333333', 'i', 1, 0, 4, 1),
(2, '2025-05-19', 'via da casa mia', '33333333333', 'i', 1, 0, 5, 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `ordinipmedicinali`
--

CREATE TABLE `ordinipmedicinali` (
  `IDOrdineP` int(7) NOT NULL,
  `IDMedicinale` int(7) NOT NULL,
  `Quantita` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `ordinipmedicinali`
--

INSERT INTO `ordinipmedicinali` (`IDOrdineP`, `IDMedicinale`, `Quantita`) VALUES
(1, 3, 1),
(2, 3, 5);

-- --------------------------------------------------------

--
-- Struttura della tabella `pagamenti`
--

CREATE TABLE `pagamenti` (
  `IDPagamento` int(2) NOT NULL,
  `Metodo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `pagamenti`
--

INSERT INTO `pagamenti` (`IDPagamento`, `Metodo`) VALUES
(1, 'Visa'),
(2, 'MasterCard');

-- --------------------------------------------------------

--
-- Struttura della tabella `prenotazioni`
--

CREATE TABLE `prenotazioni` (
  `IDPrenotazione` int(7) NOT NULL,
  `Ora` time NOT NULL,
  `DATA` date NOT NULL,
  `Stato` char(1) NOT NULL COMMENT 'c=confermato, r=rifiutato, a=in attesa',
  `Modalita` char(1) NOT NULL COMMENT 'c = a casa, p = sul posto',
  `Note` varchar(100) DEFAULT NULL,
  `CODUtenti` int(7) NOT NULL,
  `CODMedici` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `prescrizioni`
--

CREATE TABLE `prescrizioni` (
  `IDPrescrizioni` int(7) NOT NULL,
  `DATA` date NOT NULL,
  `FILE` varchar(255) NOT NULL,
  `CODUtenti` int(7) NOT NULL,
  `CODMedici` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `prescrizioni`
--

INSERT INTO `prescrizioni` (`IDPrescrizioni`, `DATA`, `FILE`, `CODUtenti`, `CODMedici`) VALUES
(1, '2025-05-19', 'C:\\xampp\\htdocs\\file\\Medline/../file/uploads/ricette/682b3ba759fed.pdf', 4, NULL),
(2, '2025-05-19', 'C:\\xampp\\htdocs\\file\\Medline/../file/uploads/ricette/682b3c49c83be.pdf', 4, NULL),
(3, '2025-05-19', 'C:\\xampp\\htdocs\\file\\Medline../ricette/682b3c5f5b78a.pdf', 4, NULL),
(4, '2025-05-19', 'C:\\xampp\\htdocs\\file\\Medline../ricette/682b3cd94d6bb.pdf', 4, NULL),
(5, '2025-05-19', 'C:\\xampp\\htdocs\\file\\Medline../ricette/682b3d4d20e92.pdf', 4, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `province`
--

CREATE TABLE `province` (
  `IDProvincia` int(4) NOT NULL,
  `Nome` varchar(20) NOT NULL,
  `CODCitta` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `province`
--

INSERT INTO `province` (`IDProvincia`, `Nome`, `CODCitta`) VALUES
(1, 'CE', 1),
(2, 'CE', 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `specializzazioni`
--

CREATE TABLE `specializzazioni` (
  `IDSpecializzazione` int(3) NOT NULL,
  `Nome` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `IDUtente` int(7) NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `Cognome` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `PASSWORD` char(64) NOT NULL,
  `Telefono` varchar(15) NOT NULL,
  `DataNascita` date NOT NULL,
  `CF` char(16) NOT NULL,
  `Abbonato` tinyint(1) NOT NULL,
  `Indirizzo` varchar(100) NOT NULL,
  `CODProvince` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`IDUtente`, `Nome`, `Cognome`, `Email`, `PASSWORD`, `Telefono`, `DataNascita`, `CF`, `Abbonato`, `Indirizzo`, `CODProvince`) VALUES
(1, 'pierpaolo', 'mastrangelo', 'pierpaolo.mastrangelo@marconibari.edu.it', 'de5e302fd8c8028c8de46e325b212a0c', '33333333333', '2011-03-03', 'LBNGRL07E05A662C', 0, 'via da casa mia', 1),
(3, 'pierpaolo', 'mastrangelo', 'pip@gmail.com', 'ef797c8118f02dfb649607dd5d3f8c76', '33333333333', '2011-03-03', 'MSTPPL06L14A662W', 0, 'via da casa mia', 1),
(4, 'pierpaolo', 'mastrangelo', 'pipo@gmail.com', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', '33333333333', '2011-03-03', 'MSTPPL06L14A661A', 0, 'via da casa mia', 1),
(5, 'pierpaolo', 'mastrangelo', 'pipo1@gmail.com', '9834876dcfb05cb167a5c24953eba58c4ac89b1adf57f28f2f9d09af107ee8f0', '33333333333', '2000-07-14', 'MSUUPL06L14A662W', 0, 'via da casa mia', 2);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`IDAdmin`);

--
-- Indici per le tabelle `citta`
--
ALTER TABLE `citta`
  ADD PRIMARY KEY (`IDCitta`);

--
-- Indici per le tabelle `farmacie`
--
ALTER TABLE `farmacie`
  ADD PRIMARY KEY (`IDFarmacia`),
  ADD KEY `CODProvince` (`CODProvince`);

--
-- Indici per le tabelle `farmaciemedicinali`
--
ALTER TABLE `farmaciemedicinali`
  ADD PRIMARY KEY (`IDFarmacia`,`IDMedicinale`),
  ADD KEY `IDMedicinale` (`IDMedicinale`);

--
-- Indici per le tabelle `medici`
--
ALTER TABLE `medici`
  ADD PRIMARY KEY (`IDMedico`),
  ADD KEY `CODSpecializzazioni` (`CODSpecializzazioni`),
  ADD KEY `CODProvince` (`CODProvince`);

--
-- Indici per le tabelle `medicinali`
--
ALTER TABLE `medicinali`
  ADD PRIMARY KEY (`IDMedicinale`);

--
-- Indici per le tabelle `ordini`
--
ALTER TABLE `ordini`
  ADD PRIMARY KEY (`IDOrdine`),
  ADD KEY `CODUtenti` (`CODUtenti`),
  ADD KEY `CODPagamento` (`CODPagamento`);

--
-- Indici per le tabelle `ordinimedicinali`
--
ALTER TABLE `ordinimedicinali`
  ADD PRIMARY KEY (`IDOrdine`,`IDMedicinale`),
  ADD KEY `IDMedicinale` (`IDMedicinale`);

--
-- Indici per le tabelle `ordinip`
--
ALTER TABLE `ordinip`
  ADD PRIMARY KEY (`IDOrdineP`),
  ADD KEY `CODPrescrizioni` (`CODPrescrizioni`),
  ADD KEY `CODPagamento` (`CODPagamento`);

--
-- Indici per le tabelle `ordinipmedicinali`
--
ALTER TABLE `ordinipmedicinali`
  ADD PRIMARY KEY (`IDOrdineP`,`IDMedicinale`),
  ADD KEY `IDMedicinale` (`IDMedicinale`);

--
-- Indici per le tabelle `pagamenti`
--
ALTER TABLE `pagamenti`
  ADD PRIMARY KEY (`IDPagamento`);

--
-- Indici per le tabelle `prenotazioni`
--
ALTER TABLE `prenotazioni`
  ADD PRIMARY KEY (`IDPrenotazione`),
  ADD KEY `CODUtenti` (`CODUtenti`),
  ADD KEY `CODMedici` (`CODMedici`);

--
-- Indici per le tabelle `prescrizioni`
--
ALTER TABLE `prescrizioni`
  ADD PRIMARY KEY (`IDPrescrizioni`),
  ADD KEY `CODUtenti` (`CODUtenti`),
  ADD KEY `CODMedici` (`CODMedici`);

--
-- Indici per le tabelle `province`
--
ALTER TABLE `province`
  ADD PRIMARY KEY (`IDProvincia`),
  ADD KEY `CODCitta` (`CODCitta`);

--
-- Indici per le tabelle `specializzazioni`
--
ALTER TABLE `specializzazioni`
  ADD PRIMARY KEY (`IDSpecializzazione`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`IDUtente`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `CF` (`CF`),
  ADD KEY `CODProvince` (`CODProvince`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `admin`
--
ALTER TABLE `admin`
  MODIFY `IDAdmin` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `citta`
--
ALTER TABLE `citta`
  MODIFY `IDCitta` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `farmacie`
--
ALTER TABLE `farmacie`
  MODIFY `IDFarmacia` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `medici`
--
ALTER TABLE `medici`
  MODIFY `IDMedico` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `medicinali`
--
ALTER TABLE `medicinali`
  MODIFY `IDMedicinale` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `ordini`
--
ALTER TABLE `ordini`
  MODIFY `IDOrdine` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT per la tabella `ordinip`
--
ALTER TABLE `ordinip`
  MODIFY `IDOrdineP` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `pagamenti`
--
ALTER TABLE `pagamenti`
  MODIFY `IDPagamento` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `prenotazioni`
--
ALTER TABLE `prenotazioni`
  MODIFY `IDPrenotazione` int(7) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `prescrizioni`
--
ALTER TABLE `prescrizioni`
  MODIFY `IDPrescrizioni` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `province`
--
ALTER TABLE `province`
  MODIFY `IDProvincia` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `specializzazioni`
--
ALTER TABLE `specializzazioni`
  MODIFY `IDSpecializzazione` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `utenti`
--
ALTER TABLE `utenti`
  MODIFY `IDUtente` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `farmacie`
--
ALTER TABLE `farmacie`
  ADD CONSTRAINT `farmacie_ibfk_1` FOREIGN KEY (`CODProvince`) REFERENCES `province` (`IDProvincia`);

--
-- Limiti per la tabella `farmaciemedicinali`
--
ALTER TABLE `farmaciemedicinali`
  ADD CONSTRAINT `farmaciemedicinali_ibfk_1` FOREIGN KEY (`IDFarmacia`) REFERENCES `farmacie` (`IDFarmacia`),
  ADD CONSTRAINT `farmaciemedicinali_ibfk_2` FOREIGN KEY (`IDMedicinale`) REFERENCES `medicinali` (`IDMedicinale`);

--
-- Limiti per la tabella `medici`
--
ALTER TABLE `medici`
  ADD CONSTRAINT `medici_ibfk_1` FOREIGN KEY (`CODSpecializzazioni`) REFERENCES `specializzazioni` (`IDSpecializzazione`),
  ADD CONSTRAINT `medici_ibfk_2` FOREIGN KEY (`CODProvince`) REFERENCES `province` (`IDProvincia`);

--
-- Limiti per la tabella `ordini`
--
ALTER TABLE `ordini`
  ADD CONSTRAINT `ordini_ibfk_1` FOREIGN KEY (`CODUtenti`) REFERENCES `utenti` (`IDUtente`),
  ADD CONSTRAINT `ordini_ibfk_2` FOREIGN KEY (`CODPagamento`) REFERENCES `pagamenti` (`IDPagamento`);

--
-- Limiti per la tabella `ordinimedicinali`
--
ALTER TABLE `ordinimedicinali`
  ADD CONSTRAINT `ordinimedicinali_ibfk_1` FOREIGN KEY (`IDOrdine`) REFERENCES `ordini` (`IDOrdine`),
  ADD CONSTRAINT `ordinimedicinali_ibfk_2` FOREIGN KEY (`IDMedicinale`) REFERENCES `medicinali` (`IDMedicinale`);

--
-- Limiti per la tabella `ordinip`
--
ALTER TABLE `ordinip`
  ADD CONSTRAINT `ordinip_ibfk_1` FOREIGN KEY (`CODPrescrizioni`) REFERENCES `prescrizioni` (`IDPrescrizioni`),
  ADD CONSTRAINT `ordinip_ibfk_2` FOREIGN KEY (`CODPagamento`) REFERENCES `pagamenti` (`IDPagamento`);

--
-- Limiti per la tabella `ordinipmedicinali`
--
ALTER TABLE `ordinipmedicinali`
  ADD CONSTRAINT `ordinipmedicinali_ibfk_1` FOREIGN KEY (`IDOrdineP`) REFERENCES `ordinip` (`IDOrdineP`),
  ADD CONSTRAINT `ordinipmedicinali_ibfk_2` FOREIGN KEY (`IDMedicinale`) REFERENCES `medicinali` (`IDMedicinale`);

--
-- Limiti per la tabella `prenotazioni`
--
ALTER TABLE `prenotazioni`
  ADD CONSTRAINT `prenotazioni_ibfk_1` FOREIGN KEY (`CODUtenti`) REFERENCES `utenti` (`IDUtente`),
  ADD CONSTRAINT `prenotazioni_ibfk_2` FOREIGN KEY (`CODMedici`) REFERENCES `medici` (`IDMedico`);

--
-- Limiti per la tabella `prescrizioni`
--
ALTER TABLE `prescrizioni`
  ADD CONSTRAINT `prescrizioni_ibfk_1` FOREIGN KEY (`CODUtenti`) REFERENCES `utenti` (`IDUtente`),
  ADD CONSTRAINT `prescrizioni_ibfk_2` FOREIGN KEY (`CODMedici`) REFERENCES `medici` (`IDMedico`);

--
-- Limiti per la tabella `province`
--
ALTER TABLE `province`
  ADD CONSTRAINT `province_ibfk_1` FOREIGN KEY (`CODCitta`) REFERENCES `citta` (`IDCitta`);

--
-- Limiti per la tabella `utenti`
--
ALTER TABLE `utenti`
  ADD CONSTRAINT `utenti_ibfk_1` FOREIGN KEY (`CODProvince`) REFERENCES `province` (`IDProvincia`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
