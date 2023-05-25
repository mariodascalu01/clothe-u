-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 23, 2023 alle 16:52
-- Versione del server: 10.4.27-MariaDB
-- Versione PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
CREATE Database clothe;
USE clothe;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clothe-u`
--

-- 

--
-- Struttura della tabella `carrello`
--

CREATE TABLE `carrello` (
  `id_carrello` int(20) NOT NULL,
  `utente` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

--
-- Dump dei dati per la tabella `carrello`
--

INSERT INTO `carrello` (`id_carrello`, `utente`) VALUES
(24, '13'),
(27, '14'),
(28, '15'),
(29, '16'),
(30, '17'),
(31, '18'),
(32, '19'),
(33, '20'),
(34, '21'),
(36, '22'),
(37, '23'),
(38, '24'),
(39, '1234354646');

-- --------------------------------------------------------

--
-- Struttura della tabella `categoria`
--

CREATE TABLE `categoria` (
  `nome_categoria` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

--
-- Dump dei dati per la tabella `categoria`
--

INSERT INTO `categoria` (`nome_categoria`) VALUES
('eleganti'),
('Sneaker Casual'),
('Sneaker Sportive'),
('sportive');

-- --------------------------------------------------------

--
-- Struttura della tabella `colori`
--

CREATE TABLE `colori` (
  `nome_colore` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

--
-- Dump dei dati per la tabella `colori`
--

INSERT INTO `colori` (`nome_colore`) VALUES
('Bianco'),
('Blu'),
('Giallo'),
('Grigio'),
('Nero'),
('Rosso'),
('Verde');

-- --------------------------------------------------------

--
-- Struttura della tabella `magazzino`
--

CREATE TABLE `magazzino` (
  `codice` int(20) NOT NULL,
  `modello` int(11) NOT NULL,
  `taglia` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

--
-- Dump dei dati per la tabella `magazzino`
--

INSERT INTO `magazzino` (`codice`, `modello`, `taglia`) VALUES
(21, 10, '38.00'),
(22, 10, '39.00'),
(23, 10, '40.00'),
(24, 10, '41.00'),
(25, 10, '42.00'),
(26, 10, '43.00'),
(27, 10, '44.00'),
(28, 10, '45.00'),
(29, 10, '38.00'),
(30, 10, '39.00'),
(31, 10, '40.00'),
(32, 10, '41.00'),
(33, 10, '42.00'),
(34, 10, '43.00'),
(35, 10, '44.00'),
(36, 10, '45.00'),
(37, 14, '38.00'),
(38, 14, '39.00'),
(39, 14, '40.00'),
(40, 14, '41.00'),
(41, 14, '42.00'),
(42, 14, '43.00'),
(43, 14, '44.00'),
(44, 14, '45.00'),
(45, 14, '38.00'),
(46, 14, '39.00'),
(47, 14, '40.00'),
(48, 14, '41.00'),
(49, 14, '42.00'),
(50, 14, '43.00'),
(51, 14, '44.00'),
(52, 14, '45.00'),
(53, 15, '38.00'),
(54, 15, '39.00'),
(55, 15, '40.00'),
(56, 15, '41.00'),
(57, 15, '42.00'),
(58, 15, '43.00'),
(59, 15, '44.00'),
(60, 15, '45.00'),
(61, 15, '38.00'),
(62, 15, '39.00'),
(63, 15, '40.00'),
(64, 15, '41.00'),
(65, 15, '42.00'),
(66, 15, '43.00'),
(67, 15, '44.00'),
(68, 15, '45.00'),
(69, 16, '38.00'),
(70, 16, '39.00'),
(71, 16, '40.00'),
(72, 16, '41.00'),
(73, 16, '42.00'),
(74, 16, '43.00'),
(75, 16, '44.00'),
(76, 16, '45.00'),
(77, 16, '38.00'),
(78, 16, '39.00'),
(79, 16, '40.00'),
(80, 16, '41.00'),
(81, 16, '42.00'),
(82, 16, '43.00'),
(83, 16, '44.00'),
(84, 16, '45.00');

-- --------------------------------------------------------

--
-- Struttura della tabella `ordini`
--

CREATE TABLE `ordini` (
  `id_ordine` int(255) NOT NULL,
  `id_utente` int(255) NOT NULL,
  `id_carrello` int(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cognome` varchar(255) NOT NULL,
  `indirizzo` varchar(255) NOT NULL,
  `civico` varchar(255) NOT NULL,
  `cap` varchar(25) NOT NULL,
  `modalita` varchar(255) NOT NULL,
  `carta` int(255) NOT NULL,
  `istante` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

--
-- Dump dei dati per la tabella `ordini`
--

INSERT INTO `ordini` (`id_ordine`, `id_utente`, `id_carrello`, `nome`, `cognome`, `indirizzo`, `civico`, `cap`, `modalita`, `carta`, `istante`) VALUES
(66, 13, 24, 'leo', 'leo', 'aaaa', 'aaa', 'aa', '2023-05-22', 2023, '2023-05-22 14:41:29'),
(67, 13, 24, 'leo', 'leo', 'aaaa', 'aaa', 'aa', '2023-05-22', 2023, '2023-05-22 17:25:27');

-- --------------------------------------------------------

--
-- Struttura della tabella `prodotti`
--

CREATE TABLE `prodotti` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `foto2` varchar(255) NOT NULL,
  `foto3` varchar(255) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `colore` varchar(10) NOT NULL,
  `prezzo` decimal(10,2) NOT NULL,
  `descrizione` text NOT NULL,
  `rating` decimal(10,2) NOT NULL,
  `categoria` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

--
-- Dump dei dati per la tabella `prodotti`
--

INSERT INTO `prodotti` (`id`, `nome`, `foto`, `foto2`, `foto3`, `marca`, `colore`, `prezzo`, `descrizione`, `rating`, `categoria`) VALUES
(10, 'Nike Air Max 90 Litri (GS)', './images/61XZefM4f1L._AC_UY625_.jpg', './images/41v57gVXbhL._AC_.jpg', './images/51DElKGECAL._AC_UX625_.jpg', 'Nike', 'Bianco', '25.00', 'Materiale esterno: Pelle<br>\r\nFodera: Sintetico<br>\r\nMateriale suola: Pelle<br>\r\nChiusura: Stringata<br>\r\nAltezza tacco: 3.8 cm<br>\r\nTipo di tacco: Piatto<br>\r\nLarghezza scarpa: Normale\r\n', '0.00', 'Sneaker Casual'),
(14, 'Nike Air Jordan 12 Retro', './images/61Wt6-2b-iL._AC_UX695_.jpg', './images/61YpQhORTwL._AC_UX695_.jpg', './images/71Zl0mWS9jL._AC_UY695_.jpg', 'Nike', 'Giallo', '27.00', 'Materiale esterno: Pelle\r\nMateriale suola: Gomma\r\nChiusura: Stringata\r\nTipo di tacco: Piatto\r\nComposizione materiale: Gomma\r\nLarghezza scarpa: Normale', '0.00', 'Sneaker Casual'),
(15, 'Nike Air Jordan 12 Retro (Bianco Blu Navy Light Smok)', './images/71NAzFdPanL._AC_SX695._SX._UX._SY._UY_.jpg', './images/61ZD8Cb8z5L._AC_SY695._SX._UX._SY._UY_.jpg', './images/61rU03aalYL._AC_SY695._SX._UX._SY._UY_.jpg', 'Nike', 'Bianco', '22.00', 'Materiale esterno: Pelle\r\nMateriale suola: Gomma\r\nChiusura: Stringata\r\nTipo di tacco: Piatto\r\nComposizione materiale: Gomma\r\nLarghezza scarpa: Normale', '0.00', 'Sneaker Casual'),
(16, 'Nike Air Jordan 1 Low (Grigio Fog Blu Void Bianco)', './images/61Ea6AtD7QL._AC_UX695_.jpg', './images/71TtOK5PCFL._AC_UX695_.jpg', './images/61cQCvxMXlL._AC_UX695_.jpg', 'Nike', 'Blu', '30.00', 'Materiale esterno: Pelle\r\nMateriale suola: Gomma\r\nChiusura: Stringata\r\nTipo di tacco: Piatto\r\nComposizione materiale: Pelle\r\nLarghezza scarpa: Normale', '0.00', 'Sneaker Casual');

-- --------------------------------------------------------

--
-- Struttura della tabella `prod_carrello`
--

CREATE TABLE `prod_carrello` (
  `id` int(11) NOT NULL,
  `id_carrello` int(20) NOT NULL,
  `id_prodotto` int(11) NOT NULL,
  `taglia` decimal(10,2) NOT NULL,
  `quantita` int(10) NOT NULL,
  `inizio` date NOT NULL,
  `fine` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

-- --------------------------------------------------------

--
-- Struttura della tabella `prod_ordine`
--

CREATE TABLE `prod_ordine` (
  `id_prod_ordine` int(11) NOT NULL,
  `id_ordine` int(11) NOT NULL,
  `id_prod_magazzino` int(11) NOT NULL,
  `inizio` date NOT NULL,
  `fine` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

--
-- Dump dei dati per la tabella `prod_ordine`
--

INSERT INTO `prod_ordine` (`id_prod_ordine`, `id_ordine`, `id_prod_magazzino`, `inizio`, `fine`) VALUES
(42, 66, 37, '2023-05-22', '2023-05-23'),
(43, 66, 45, '2023-05-22', '2023-05-23'),
(44, 67, 38, '2023-05-22', '2023-05-23'),
(45, 67, 46, '2023-05-22', '2023-05-23'),
(46, 67, 54, '2023-05-22', '2023-05-23');

-- --------------------------------------------------------

--
-- Struttura della tabella `profili`
--

CREATE TABLE `profili` (
  `id_utente` int(11) NOT NULL,
  `nome_utente` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(50) NOT NULL,
  `indirizzo` varchar(50) NOT NULL,
  `civico` varchar(10) NOT NULL,
  `cap` varchar(5) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `iscrizione` timestamp NOT NULL DEFAULT current_timestamp(),
  `attivo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

--
-- Dump dei dati per la tabella `profili`
--

INSERT INTO `profili` (`id_utente`, `nome_utente`, `email`, `nome`, `cognome`, `indirizzo`, `civico`, `cap`, `password`, `telefono`, `iscrizione`, `attivo`) VALUES
(13, 'leo', 'leo@gmail.com', 'leo', 'leo', 'aaaa', 'aaa', 'aa', '0f759dd1ea6c4c76cedc299039ca4f23', 'aaa', '2023-05-12 14:11:51', 1),
(23, 'catini', 'catini@gmail.com', 'catini', 'catini', 'catini', '11', '11', '133f8e0a9dc152a9480f2502d05e3846', '11', '2023-05-23 14:28:13', 0),
(24, 'catini', 'catini@gmail.com', 'catini', 'catini', 'catini', '11', '11', '133f8e0a9dc152a9480f2502d05e3846', '11', '2023-05-23 14:29:57', 0);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `carrello`
--
ALTER TABLE `carrello`
  ADD PRIMARY KEY (`id_carrello`);

--
-- Indici per le tabelle `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`nome_categoria`);

--
-- Indici per le tabelle `colori`
--
ALTER TABLE `colori`
  ADD PRIMARY KEY (`nome_colore`);

--
-- Indici per le tabelle `magazzino`
--
ALTER TABLE `magazzino`
  ADD PRIMARY KEY (`codice`),
  ADD KEY `prodotto_magazzino` (`modello`) USING BTREE;

--
-- Indici per le tabelle `ordini`
--
ALTER TABLE `ordini`
  ADD PRIMARY KEY (`id_ordine`),
  ADD KEY `ordine-utente` (`id_utente`),
  ADD KEY `ordine-carrello` (`id_carrello`);

--
-- Indici per le tabelle `prodotti`
--
ALTER TABLE `prodotti`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `prodotti-colore` (`colore`),
  ADD KEY `prodotti-categoria` (`categoria`);

--
-- Indici per le tabelle `prod_carrello`
--
ALTER TABLE `prod_carrello`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `carrello` (`id_carrello`),
  ADD KEY `prodotto` (`id_prodotto`);

--
-- Indici per le tabelle `prod_ordine`
--
ALTER TABLE `prod_ordine`
  ADD PRIMARY KEY (`id_prod_ordine`);

--
-- Indici per le tabelle `profili`
--
ALTER TABLE `profili`
  ADD PRIMARY KEY (`id_utente`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `carrello`
--
ALTER TABLE `carrello`
  MODIFY `id_carrello` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT per la tabella `magazzino`
--
ALTER TABLE `magazzino`
  MODIFY `codice` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT per la tabella `ordini`
--
ALTER TABLE `ordini`
  MODIFY `id_ordine` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT per la tabella `prodotti`
--
ALTER TABLE `prodotti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT per la tabella `prod_carrello`
--
ALTER TABLE `prod_carrello`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT per la tabella `prod_ordine`
--
ALTER TABLE `prod_ordine`
  MODIFY `id_prod_ordine` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT per la tabella `profili`
--
ALTER TABLE `profili`
  MODIFY `id_utente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `magazzino`
--
ALTER TABLE `magazzino`
  ADD CONSTRAINT `vincolo1` FOREIGN KEY (`modello`) REFERENCES `prodotti` (`id`);

--
-- Limiti per la tabella `ordini`
--
ALTER TABLE `ordini`
  ADD CONSTRAINT `ordine-carrello` FOREIGN KEY (`id_carrello`) REFERENCES `carrello` (`id_carrello`),
  ADD CONSTRAINT `ordine-utente` FOREIGN KEY (`id_utente`) REFERENCES `profili` (`id_utente`);

--
-- Limiti per la tabella `prodotti`
--
ALTER TABLE `prodotti`
  ADD CONSTRAINT `prodotti-categoria` FOREIGN KEY (`categoria`) REFERENCES `categoria` (`nome_categoria`),
  ADD CONSTRAINT `prodotti-colore` FOREIGN KEY (`colore`) REFERENCES `colori` (`nome_colore`);

--
-- Limiti per la tabella `prod_carrello`
--
ALTER TABLE `prod_carrello`
  ADD CONSTRAINT `carrello` FOREIGN KEY (`id_carrello`) REFERENCES `carrello` (`id_carrello`),
  ADD CONSTRAINT `prodotto` FOREIGN KEY (`id_prodotto`) REFERENCES `prodotti` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
