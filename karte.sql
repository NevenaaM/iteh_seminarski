-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2020 at 12:00 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 5.6.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `karte`
--

-- --------------------------------------------------------

--
-- Table structure for table `dogadjaj`
--

CREATE TABLE `dogadjaj` (
  `dogadjajID` int(11) NOT NULL,
  `naziv` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `opis` text COLLATE utf8_unicode_ci NOT NULL,
  `datum` date NOT NULL,
  `brojKarata` int(11) NOT NULL,
  `cenaPoKarti` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dogadjaj`
--

INSERT INTO `dogadjaj` (`dogadjajID`, `naziv`, `opis`, `datum`, `brojKarata`, `cenaPoKarti`) VALUES
(1, 'EXIT', 'EXIT je višestruko nagrađivani internacionalni letnji muzički festival. Održava se svake godine u Novom Sadu u Srbiji, na Petrovaradinskoj tvrđavi, koju mnogi smatraju za jednu od najboljih festivalskih lokacija na svetu, i na njemu nastupa preko 1000 izvođača na više od 40 bina i festivalskih zona.\r\nPored titule „Najbolji evropski festival” osvojene na Evropskim festivalskim nagradama 2013. i 2017. godine, EXIT je 2007. godine proglašen za najbolji evropski festival na Britanskim festivalskim nagradama. EXIT je proglašen i za Najbolji evropski festival za 2016. godinu od strane vodećeg evropskog turističkog priznanja “European Best Destinations“, koje se dodeljuje u saradnji sa sa Evropskom komisijom, dok je Savet za regionalnu saradnju 2017. odabrao EXIT festival za Šampiona regionalne saradnje u Jugoistočnoj Evropi.\r\n\r\nO Exitu su pisali svi važni mediji sveta, a priznanja su dobijena od medijskih magnata kao što su CNN (“World’s Top 5 Festivals”), The Guardian (“World’s Best Festival”), The Sun (“One of Europe’s most popular music events”), Euronews, New York Times, BBC (“Top 3 Music Festivals”), Forbes (“Thanks to EXIT, Serbia is a festival hot spot worth your attention”), The Times (“Best European Festival”), MTV (“World’s Best Festival”), Huffington Post, Conde Nast Traveller, Daily Mail, The Independent, Lonely Planet i brojnih drugih.', '2020-07-15', 97, 4000),
(2, 'Guca', 'Dragačevski sabor trubača, takođe poznat i kao Guča festival, je tradicionalna festivalska manifestacija i jedinstvena smotra tubaštva koja se svake godine održava u gradiću Guča, u Dragačevu, u regionu Zapadne Srbije. Skoro milion posetilaca iz Srbije i inostranstva dolazi u gradić od dve hiljade stanovnika svakog Avgusta. Zahvaljujući festivalu Guča je postala poznata u celom svetu kao mesto održavanja najvećeg festivala trubačke muzike širom planete, gde su još zatupljene i druge tradicionalne vrednosti, kao što su tradicionalne pesme, igre i nošnje regiona Dragačeva i Zapadne Srbije.', '2020-08-07', 4, 2500),
(3, 'Novi dogadjaj', 'Proba', '2020-04-22', 12, 250);

-- --------------------------------------------------------

--
-- Table structure for table `narudzbina`
--

CREATE TABLE `narudzbina` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `dogadjajID` int(11) NOT NULL,
  `kolicina` int(11) NOT NULL,
  `ukupno` double NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `narudzbina`
--

INSERT INTO `narudzbina` (`id`, `userID`, `dogadjajID`, `kolicina`, `ukupno`, `status`) VALUES
(1, 1, 1, 2, 8000, 'Odobren'),
(3, 1, 1, 10, 40000, 'Odbijen'),
(4, 1, 1, 92, 368000, 'Odbijen'),
(5, 4, 1, 3, 12000, 'U obradi');

-- --------------------------------------------------------

--
-- Table structure for table `slike`
--

CREATE TABLE `slike` (
  `id` int(11) NOT NULL,
  `dogadjajID` int(11) NOT NULL,
  `slika` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `slike`
--

INSERT INTO `slike` (`id`, `dogadjajID`, `slika`) VALUES
(3, 3, 'ashaman.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(11) NOT NULL,
  `imePrezime` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rola` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Korisnik'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `imePrezime`, `username`, `password`, `rola`) VALUES
(1, 'Admin', 'admin', 'admin', 'Administrator'),
(3, 'afasfasf', 'asfasfasf', 'asfasfasfas', 'Korisnik'),
(4, 'Nenad', 'nesa', 'nesa', 'Korisnik');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dogadjaj`
--
ALTER TABLE `dogadjaj`
  ADD PRIMARY KEY (`dogadjajID`);

--
-- Indexes for table `narudzbina`
--
ALTER TABLE `narudzbina`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slike`
--
ALTER TABLE `slike`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dogadjaj`
--
ALTER TABLE `dogadjaj`
  MODIFY `dogadjajID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `narudzbina`
--
ALTER TABLE `narudzbina`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `slike`
--
ALTER TABLE `slike`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
