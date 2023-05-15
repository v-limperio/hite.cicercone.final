-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Set 10, 2019 alle 11:22
-- Versione del server: 10.3.16-MariaDB
-- Versione PHP: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cicerone`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `attività`
--


CREATE TABLE `utente` (
  `id` char(5) NOT NULL,
  `email` varchar(128) NOT NULL,
  `psw` varchar(16) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cognome` varchar(255) NOT NULL,
  `telefono` varchar(13) NOT NULL,
  `dataNascita` date NOT NULL,
  `citta` varchar(128) NOT NULL,
  `nazione` varchar(128) NOT NULL,
  `sesso` char(1) NOT NULL,
  `imgProfilo` tinyint(4) DEFAULT NULL,
  `segnalazioni` int(11) NOT NULL DEFAULT 0,
  `votipositivi` int(11) NOT NULL DEFAULT 0,
  `votinegativi` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `attivita` (
  `id` char(5) NOT NULL,
  `cicerone` char(5) NOT NULL,
  `titolo` varchar(255) NOT NULL,
  `descrizione` text NOT NULL,
  `tipologia` varchar(64) NOT NULL,
  `citta` varchar(255) NOT NULL,
  `indirizzo_incontro` varchar(255) NOT NULL,
  `incontro_lat` varchar(50) NOT NULL,
  `incontro_lng` varchar(50) NOT NULL,
  `lingua_parlata` varchar(255) NOT NULL,
  `img_attivita` tinyint(4) DEFAULT 0,
  `votipositivi` int(11) NOT NULL DEFAULT 0,
  `votinegativi` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `fk_attività` (`cicerone`),
  CONSTRAINT `fk_attività` FOREIGN KEY (`cicerone`) REFERENCES `utente` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `orario` (
  `attivita` char(5) NOT NULL,
  `data_attivita` date NOT NULL,
  `ora_inizio` time NOT NULL,
  `ora_termine` time,
  `chiusura_richieste` tinyint(1) DEFAULT 0,
  `stato` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`attivita`,`data_attivita`,`ora_inizio`),
  KEY `fk_orario_attività` (`attivita`),
  CONSTRAINT `fk_orario_attività` FOREIGN KEY (`attivita`) REFERENCES `attivita` (`id`) ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `itinerario` (
  `attivita` char(5) NOT NULL,
  `nome_luogo` varchar(100) NOT NULL,
  `descrizione` text NOT NULL,
  PRIMARY KEY (`nome_luogo`,`attivita`),
  KEY `attivita` (`attivita`),
  CONSTRAINT `itinerario_ibfk` FOREIGN KEY (`attivita`) REFERENCES `attivita` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `richiesta` (
  `partecipante` char(5) NOT NULL,
  `attivita` char(5) NOT NULL,
  `data_attivita` date NOT NULL,
  `ora_inizio` time NOT NULL,
  `accettazione` bit(1) NOT NULL DEFAULT b'0',
  `presenza` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`partecipante`,`attivita`,`data_attivita`,`ora_inizio`),
  KEY `fk_partecipazione1` (`attivita`, `data_attivita`, `ora_inizio`),
  KEY `fk_partecipazione4` (`partecipante`),
  CONSTRAINT `fk_partecipazione1` FOREIGN KEY (`attivita`, `data_attivita`, `ora_inizio`) REFERENCES `orario` (`attivita`,`data_attivita`, `ora_inizio`) ON DELETE CASCADE,
  CONSTRAINT `fk_partecipazione4` FOREIGN KEY (`partecipante`) REFERENCES `utente` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `segnalazione` (
  `segnalatore` char(5) NOT NULL,
  `segnalato` char(5) NOT NULL,
  `causa` varchar(500) NOT NULL,
  `commento` varchar(500) DEFAULT NULL,
  `datasegnalazione` date NOT NULL,
  PRIMARY KEY (`segnalatore`,`segnalato`),
  KEY `fk_segnalazione2` (`segnalato`),
  CONSTRAINT `fk_segnalazione1` FOREIGN KEY (`segnalatore`) REFERENCES `utente` (`id`),
  CONSTRAINT `fk_segnalazione2` FOREIGN KEY (`segnalato`) REFERENCES `utente` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `valutazione` (
  `utente` char(5) NOT NULL,
  `attività` char(5) NOT NULL,
  `voto` bit(1) NOT NULL,
  `recensione` varchar(500) NOT NULL,
  PRIMARY KEY (`utente`,`attività`),
  KEY `fk_valutazione1` (`attività`),
  CONSTRAINT `fk_valutazione1` FOREIGN KEY (`attività`) REFERENCES `attivita` (`id`),
  CONSTRAINT `fk_valutazione2` FOREIGN KEY (`utente`) REFERENCES `utente` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;









