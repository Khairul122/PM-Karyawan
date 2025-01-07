-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 07, 2025 at 07:16 AM
-- Server version: 8.0.30
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penerimaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `master_pelamar`
--

CREATE TABLE `master_pelamar` (
  `id_pelamar` int NOT NULL,
  `nama_pelamar` varchar(50) NOT NULL,
  `no_hp` varchar(12) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `master_pelamar`
--

INSERT INTO `master_pelamar` (`id_pelamar`, `nama_pelamar`, `no_hp`, `email`) VALUES
(10, 'MIRANDA PUTRI MELAYU', '081234567890', 'miranda.putri@email.com'),
(11, 'INTAN DEVIA INDAH', '081234567891', 'intan.devia@email.com'),
(12, 'MELISA LATIFAH ALNUR', '081234567892', 'melisa.latifah@email.com'),
(13, 'FANI RAMASARI', '081234567893', 'fani.ramasari@email.com'),
(14, 'PUTRI MAHARANI', '081234567894', 'putri.maharani@email.com'),
(15, 'FAUZIAH RAHMADANI', '081234567895', 'fauziah.rahmadani@email.com'),
(16, 'VANESSA VERONICA', '081234567896', 'vanessa.veronica@email.com'),
(17, 'RAFI SEPTINO', '081234567897', 'rafi.septino@email.com'),
(18, 'BIMA SAPUTRA', '081234567898', 'bima.saputra@email.com'),
(19, 'ADAM FAJAR PRAMUJA', '081234567899', 'adam.fajar@email.com'),
(20, 'MUHAMMER KHADAFI', '081234567900', 'muhammer.khadafi@email.com'),
(21, 'KELVIN JAYA', '081234567901', 'kelvin.jaya@email.com'),
(22, 'PUTRI HUMAIRA', '081234567902', 'putri.humaira@email.com'),
(23, 'YOVI YUHENDRI', '081234567903', 'yovi.yuhendri@email.com'),
(24, 'DITO AMANDA', '081234567904', 'dito.amanda@email.com'),
(25, 'ZAHRA NAZYFAH FARHAH', '081234567905', 'zahra.nazyfah@email.com'),
(26, 'NUR’AINI', '081234567906', 'nur.aini@email.com'),
(27, 'MUHAMMAD DIO', '081234567907', 'muhammad.dio@email.com'),
(28, 'KAMELIA PUTRI', '081234567908', 'kamelia.putri@email.com'),
(29, 'ENJELIKA RAMSKI', '081234567909', 'enjelika.ramski@email.com'),
(30, 'TYARA ADELIA', '081234567910', 'tyara.adelia@email.com'),
(31, 'JEFRI SEPTIAN', '081234567911', 'jefri.septian@email.com'),
(32, 'REHAN PRAMANA', '081234567912', 'rehan.pramana@email.com'),
(33, 'GILANG PERMANA', '081234567913', 'gilang.permana@email.com'),
(34, 'AFIS RAMADHAN', '081234567914', 'afis.ramadhan@email.com'),
(35, 'RIMA ASRAWATI', '081234567915', 'rima.asrawati@email.com'),
(36, 'ANYA PUTRI MABEL', '081234567916', 'anya.mabel@email.com'),
(37, 'DINDA NOSA PUTRI', '081234567917', 'dinda.nosa@email.com'),
(38, 'SUKMA DWI HENDRIA', '081234567918', 'sukma.hendria@email.com'),
(39, 'HERU SAPUTRA', '081234567919', 'heru.saputra@email.com'),
(40, 'MUHAMMAD ADHA', '081234567920', 'muhammad.adha@email.com'),
(41, 'IRWAN SYAHPUTRA', '081234567921', 'irwan.syahputra@email.com'),
(42, 'IQBAL MAULANA', '081234567922', 'iqbal.maulana@email.com'),
(43, 'WAZNA RAUDATUL', '081234567923', 'wazna.raudatul@email.com'),
(44, 'WELLA NANDA PUTRI', '081234567924', 'wella.nanda@email.com'),
(45, 'KURNIASIH RAHAYU', '081234567925', 'kurniasih.rahayu@email.com'),
(46, 'NICO FEBRIANTO', '081234567926', 'nico.febrianto@email.com'),
(47, 'ANGGI ARIZAL PUTRA', '081234567927', 'anggi.arizal@email.com'),
(48, 'RIFANI SEPTIMA YANTI', '081234567928', 'rifani.septima@email.com'),
(49, 'NADILA VARDIANI', '081234567929', 'nadila.vardiani@email.com');

-- --------------------------------------------------------

--
-- Table structure for table `master_user`
--

CREATE TABLE `master_user` (
  `id_user` int NOT NULL,
  `username` varchar(30) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` tinyint(1) NOT NULL,
  `dibuat_oleh` int NOT NULL,
  `tgl_dibuat` datetime NOT NULL,
  `diubah_oleh` int NOT NULL,
  `tgl_diubah` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `master_user`
--

INSERT INTO `master_user` (`id_user`, `username`, `nama`, `password`, `level`, `dibuat_oleh`, `tgl_dibuat`, `diubah_oleh`, `tgl_diubah`) VALUES
(1, 'admin', 'Administrator', '21232f297a57a5a743894a0e4a801fc3', 1, 1, '2020-08-25 22:05:05', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `pm_aspek`
--

CREATE TABLE `pm_aspek` (
  `id_aspek` tinyint UNSIGNED NOT NULL,
  `aspek` varchar(100) NOT NULL,
  `prosentase` float NOT NULL,
  `bobot_core` float NOT NULL,
  `bobot_secondary` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pm_aspek`
--

INSERT INTO `pm_aspek` (`id_aspek`, `aspek`, `prosentase`, `bobot_core`, `bobot_secondary`) VALUES
(8, 'Kemampuan Berkomunikasi', 25, 60, 40),
(7, 'Etika Kerja', 25, 60, 40),
(9, 'Inisiatif', 25, 60, 40),
(10, 'Kerjasama', 25, 60, 40);

-- --------------------------------------------------------

--
-- Table structure for table `pm_bobot`
--

CREATE TABLE `pm_bobot` (
  `selisih` tinyint NOT NULL,
  `bobot` float NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pm_bobot`
--

INSERT INTO `pm_bobot` (`selisih`, `bobot`, `keterangan`) VALUES
(-4, 1, 'Kompetensi individu kekurangan 4 tingkat'),
(4, 1.5, 'Kompetensi individu kelebihan 4 tingkat'),
(-3, 2, 'Kompetensi individu kekurangan 3 tingkat'),
(3, 2.5, 'Kompetensi individu kelebihan 3 tingkat'),
(-2, 3, 'Kompetensi individu kekurangan 2 tingkat'),
(2, 3.5, 'Kompetensi individu kelebihan 2 tingkat'),
(-1, 4, 'Kompetensi individu kekurangan 1 tingkat'),
(1, 4.5, 'Kompetensi individu kelebihan 1 tingkat'),
(0, 5, 'Tidak ada selisih');

-- --------------------------------------------------------

--
-- Table structure for table `pm_faktor`
--

CREATE TABLE `pm_faktor` (
  `id_faktor` tinyint UNSIGNED NOT NULL,
  `id_aspek` tinyint UNSIGNED NOT NULL,
  `faktor` varchar(30) NOT NULL,
  `target` tinyint NOT NULL,
  `type` set('core','secondary') DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pm_faktor`
--

INSERT INTO `pm_faktor` (`id_faktor`, `id_aspek`, `faktor`, `target`, `type`) VALUES
(27, 8, 'Kemampuan Mendengar', 3, 'secondary'),
(26, 8, 'Kemampuan Menulis', 3, 'secondary'),
(25, 8, 'Kemampuan Presentasi', 4, 'core'),
(24, 7, 'Integritas', 3, 'secondary'),
(23, 7, 'Tanggung Jawab', 4, 'core'),
(22, 7, 'Kedisiplinan', 4, 'core'),
(28, 9, 'Pemecahan Masalah', 4, 'core'),
(29, 9, 'Pengambilan Keputusan	', 4, 'core'),
(30, 9, 'Kreativitas', 3, 'secondary'),
(31, 10, 'Koordinasi Tim', 4, 'core'),
(32, 10, 'Adaptasi', 3, 'secondary'),
(33, 10, 'Kontribusi', 4, 'core');

-- --------------------------------------------------------

--
-- Table structure for table `pm_ranking`
--

CREATE TABLE `pm_ranking` (
  `id_pelamar` int NOT NULL,
  `nilai_akhir` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pm_ranking`
--

INSERT INTO `pm_ranking` (`id_pelamar`, `nilai_akhir`) VALUES
(8, '1.84'),
(9, '4.03'),
(1, '4.05'),
(2, '4.45'),
(3, '4.47'),
(4, '4.31'),
(5, '4.42'),
(10, '0.00'),
(11, '0.00'),
(12, '0.00'),
(13, '0.00'),
(14, '0.00'),
(15, '0.00'),
(16, '0.00'),
(17, '0.00'),
(18, '0.00'),
(19, '0.00'),
(20, '0.00'),
(21, '0.00'),
(22, '0.00'),
(23, '0.00'),
(24, '0.00'),
(25, '0.00'),
(26, '0.00'),
(27, '0.00'),
(28, '0.00'),
(29, '0.00'),
(30, '0.00'),
(31, '0.00'),
(32, '0.00'),
(33, '0.00'),
(34, '0.00'),
(35, '0.00'),
(36, '0.00'),
(37, '0.00'),
(38, '0.00'),
(39, '0.00'),
(40, '0.00'),
(41, '0.00'),
(42, '0.00'),
(43, '0.00'),
(44, '0.00'),
(45, '0.00'),
(46, '0.00'),
(47, '0.00'),
(48, '0.00'),
(49, '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `pm_sample`
--

CREATE TABLE `pm_sample` (
  `id_sample` int UNSIGNED NOT NULL,
  `id_pelamar` tinyint UNSIGNED NOT NULL,
  `id_faktor` tinyint UNSIGNED NOT NULL,
  `value` tinyint UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pm_sample`
--

INSERT INTO `pm_sample` (`id_sample`, `id_pelamar`, `id_faktor`, `value`) VALUES
(1640, 49, 30, 2),
(1639, 49, 29, 3),
(1638, 49, 28, 4),
(1637, 48, 30, 4),
(1636, 48, 29, 2),
(1635, 48, 28, 3),
(1634, 47, 30, 3),
(1633, 47, 29, 4),
(1632, 47, 28, 2),
(1631, 46, 30, 2),
(1630, 46, 29, 3),
(1629, 46, 28, 4),
(1628, 45, 30, 4),
(1627, 45, 29, 2),
(1626, 45, 28, 3),
(1625, 44, 30, 3),
(1624, 44, 29, 4),
(1623, 44, 28, 2),
(1622, 43, 30, 2),
(1621, 43, 29, 3),
(1620, 43, 28, 4),
(1619, 42, 30, 4),
(1618, 42, 29, 2),
(1617, 42, 28, 3),
(1616, 41, 30, 3),
(1615, 41, 29, 4),
(1614, 41, 28, 2),
(1613, 40, 30, 2),
(1612, 40, 29, 3),
(1611, 40, 28, 4),
(1610, 39, 30, 4),
(1609, 39, 29, 2),
(1608, 39, 28, 3),
(1607, 38, 30, 3),
(1606, 38, 29, 4),
(1605, 38, 28, 2),
(1604, 37, 30, 2),
(1603, 37, 29, 3),
(1602, 37, 28, 4),
(1601, 36, 30, 4),
(1600, 36, 29, 2),
(1599, 36, 28, 3),
(1598, 35, 30, 3),
(1597, 35, 29, 4),
(1596, 35, 28, 2),
(1595, 34, 30, 2),
(1594, 34, 29, 3),
(1593, 34, 28, 4),
(1592, 33, 30, 4),
(1591, 33, 29, 2),
(1590, 33, 28, 3),
(1589, 32, 30, 3),
(1588, 32, 29, 4),
(1587, 32, 28, 2),
(1586, 31, 30, 2),
(1585, 31, 29, 3),
(1584, 31, 28, 4),
(1583, 30, 30, 4),
(1582, 30, 29, 2),
(1581, 30, 28, 3),
(1580, 29, 30, 3),
(1579, 29, 29, 4),
(1578, 29, 28, 2),
(1577, 28, 30, 2),
(1576, 28, 29, 3),
(1575, 28, 28, 4),
(1574, 27, 30, 4),
(1573, 27, 29, 2),
(1572, 27, 28, 3),
(1571, 26, 30, 3),
(1570, 26, 29, 4),
(1569, 26, 28, 2),
(1568, 25, 30, 2),
(1567, 25, 29, 3),
(1566, 25, 28, 3),
(1565, 24, 30, 3),
(1564, 24, 29, 2),
(1563, 24, 28, 4),
(1562, 23, 30, 4),
(1561, 23, 29, 3),
(1560, 23, 28, 2),
(1559, 22, 30, 2),
(1558, 22, 29, 4),
(1557, 22, 28, 3),
(1556, 21, 30, 3),
(1555, 21, 29, 2),
(1554, 21, 28, 4),
(1553, 20, 30, 3),
(1552, 20, 29, 3),
(1551, 20, 28, 2),
(1550, 19, 30, 4),
(1549, 19, 29, 2),
(1548, 19, 28, 3),
(1547, 18, 30, 2),
(1546, 18, 29, 3),
(1545, 18, 28, 4),
(1544, 17, 30, 3),
(1543, 17, 29, 4),
(1542, 17, 28, 2),
(1541, 16, 30, 2),
(1540, 16, 29, 3),
(1539, 16, 28, 3),
(1538, 15, 30, 3),
(1537, 15, 29, 2),
(1536, 15, 28, 4),
(1535, 14, 30, 2),
(1534, 14, 29, 4),
(1533, 14, 28, 3),
(1532, 13, 30, 4),
(1531, 13, 29, 3),
(1530, 13, 28, 2),
(1529, 12, 30, 2),
(1528, 12, 29, 3),
(1527, 12, 28, 4),
(1526, 11, 30, 3),
(1525, 11, 29, 2),
(1524, 11, 28, 3),
(1523, 10, 30, 4),
(1522, 10, 29, 3),
(1521, 10, 28, 4),
(1520, 49, 25, 3),
(1519, 49, 26, 4),
(1518, 49, 27, 4),
(1517, 48, 25, 4),
(1516, 48, 26, 3),
(1515, 48, 27, 4),
(1514, 47, 25, 4),
(1513, 47, 26, 4),
(1512, 47, 27, 3),
(1511, 46, 25, 3),
(1510, 46, 26, 4),
(1509, 46, 27, 4),
(1508, 45, 25, 4),
(1507, 45, 26, 3),
(1506, 45, 27, 4),
(1505, 44, 25, 4),
(1504, 44, 26, 4),
(1503, 44, 27, 3),
(1502, 43, 25, 3),
(1501, 43, 26, 4),
(1500, 43, 27, 4),
(1499, 42, 25, 4),
(1498, 42, 26, 3),
(1497, 42, 27, 4),
(1496, 41, 25, 4),
(1495, 41, 26, 4),
(1494, 41, 27, 3),
(1493, 40, 25, 3),
(1492, 40, 26, 4),
(1491, 40, 27, 4),
(1490, 39, 25, 4),
(1489, 39, 26, 3),
(1488, 39, 27, 4),
(1487, 38, 25, 3),
(1486, 38, 26, 4),
(1485, 38, 27, 3),
(1484, 37, 25, 3),
(1483, 37, 26, 4),
(1482, 37, 27, 4),
(1481, 36, 25, 4),
(1480, 36, 26, 3),
(1479, 36, 27, 4),
(1478, 35, 25, 4),
(1477, 35, 26, 4),
(1476, 35, 27, 3),
(1475, 34, 25, 3),
(1474, 34, 26, 4),
(1473, 34, 27, 4),
(1472, 33, 25, 4),
(1471, 33, 26, 3),
(1470, 33, 27, 4),
(1469, 32, 25, 4),
(1468, 32, 26, 4),
(1467, 32, 27, 3),
(1466, 31, 25, 3),
(1465, 31, 26, 4),
(1464, 31, 27, 4),
(1463, 30, 25, 4),
(1462, 30, 26, 3),
(1461, 30, 27, 4),
(1460, 29, 25, 4),
(1459, 29, 26, 4),
(1458, 29, 27, 3),
(1457, 28, 25, 3),
(1456, 28, 26, 4),
(1455, 28, 27, 4),
(1454, 27, 25, 4),
(1453, 27, 26, 3),
(1452, 27, 27, 4),
(1451, 26, 25, 4),
(1450, 26, 26, 4),
(1449, 26, 27, 3),
(1448, 25, 25, 3),
(1447, 25, 26, 4),
(1446, 25, 27, 4),
(1445, 24, 25, 4),
(1444, 24, 26, 3),
(1443, 24, 27, 4),
(1442, 23, 25, 4),
(1441, 23, 26, 4),
(1440, 23, 27, 3),
(1439, 22, 25, 3),
(1438, 22, 26, 4),
(1437, 22, 27, 4),
(1436, 21, 25, 4),
(1435, 21, 26, 3),
(1434, 21, 27, 4),
(1433, 20, 25, 4),
(1432, 20, 26, 4),
(1431, 20, 27, 3),
(1430, 19, 25, 3),
(1429, 19, 26, 4),
(1428, 19, 27, 4),
(1427, 18, 25, 4),
(1426, 18, 26, 3),
(1425, 18, 27, 4),
(1424, 17, 25, 3),
(1423, 17, 26, 4),
(1422, 17, 27, 3),
(1421, 16, 25, 4),
(1420, 16, 26, 3),
(1419, 16, 27, 4),
(1418, 15, 25, 4),
(1417, 15, 26, 4),
(1416, 15, 27, 3),
(1415, 14, 25, 3),
(1414, 14, 26, 4),
(1413, 14, 27, 4),
(1412, 13, 25, 3),
(1411, 13, 26, 3),
(1410, 13, 27, 4),
(1409, 12, 25, 4),
(1408, 12, 26, 4),
(1407, 12, 27, 3),
(1406, 11, 25, 4),
(1405, 11, 26, 3),
(1404, 11, 27, 4),
(1403, 10, 25, 4),
(1402, 10, 26, 4),
(1401, 10, 27, 4),
(1400, 49, 22, 4),
(1399, 49, 23, 4),
(1398, 49, 24, 4),
(1397, 48, 22, 3),
(1396, 48, 23, 4),
(1395, 48, 24, 3),
(1394, 47, 22, 4),
(1393, 47, 23, 3),
(1392, 47, 24, 4),
(1391, 46, 22, 4),
(1390, 46, 23, 3),
(1389, 46, 24, 3),
(1388, 45, 22, 3),
(1387, 45, 23, 4),
(1386, 45, 24, 4),
(1385, 44, 22, 4),
(1384, 44, 23, 4),
(1383, 44, 24, 3),
(1382, 43, 22, 3),
(1381, 43, 23, 3),
(1380, 43, 24, 4),
(1379, 42, 22, 4),
(1378, 42, 23, 4),
(1377, 42, 24, 3),
(1376, 41, 22, 3),
(1375, 41, 23, 2),
(1374, 41, 24, 4),
(1373, 40, 22, 4),
(1372, 40, 23, 3),
(1371, 40, 24, 3),
(1370, 39, 22, 4),
(1369, 39, 23, 4),
(1368, 39, 24, 4),
(1367, 38, 22, 3),
(1366, 38, 23, 3),
(1365, 38, 24, 3),
(1364, 37, 22, 4),
(1363, 37, 23, 3),
(1362, 37, 24, 4),
(1361, 36, 22, 4),
(1360, 36, 23, 3),
(1359, 36, 24, 3),
(1358, 35, 22, 3),
(1357, 35, 23, 4),
(1356, 35, 24, 4),
(1355, 34, 22, 4),
(1354, 34, 23, 4),
(1353, 34, 24, 3),
(1352, 33, 22, 3),
(1351, 33, 23, 3),
(1350, 33, 24, 4),
(1349, 32, 22, 4),
(1348, 32, 23, 4),
(1347, 32, 24, 3),
(1346, 31, 22, 3),
(1345, 31, 23, 3),
(1344, 31, 24, 4),
(1343, 30, 22, 4),
(1342, 30, 23, 3),
(1341, 30, 24, 3),
(1340, 29, 22, 4),
(1339, 29, 23, 4),
(1338, 29, 24, 4),
(1337, 28, 22, 3),
(1336, 28, 23, 4),
(1335, 28, 24, 3),
(1334, 27, 22, 4),
(1333, 27, 23, 3),
(1332, 27, 24, 4),
(1331, 26, 22, 4),
(1330, 26, 23, 3),
(1329, 26, 24, 3),
(1328, 25, 22, 3),
(1327, 25, 23, 4),
(1326, 25, 24, 4),
(1325, 24, 22, 4),
(1324, 24, 23, 4),
(1323, 24, 24, 3),
(1322, 23, 22, 3),
(1321, 23, 23, 3),
(1320, 23, 24, 4),
(1319, 22, 22, 4),
(1318, 22, 23, 4),
(1317, 22, 24, 3),
(1316, 21, 22, 3),
(1315, 21, 23, 3),
(1314, 21, 24, 4),
(1313, 20, 22, 4),
(1312, 20, 23, 3),
(1311, 20, 24, 3),
(1310, 19, 22, 4),
(1309, 19, 23, 4),
(1308, 19, 24, 4),
(1307, 18, 22, 3),
(1306, 18, 23, 4),
(1305, 18, 24, 3),
(1304, 17, 22, 4),
(1303, 17, 23, 3),
(1302, 17, 24, 4),
(1301, 16, 22, 4),
(1300, 16, 23, 3),
(1299, 16, 24, 3),
(1298, 15, 22, 3),
(1297, 15, 23, 4),
(1296, 15, 24, 4),
(1295, 14, 22, 4),
(1294, 14, 23, 4),
(1293, 14, 24, 3),
(1292, 13, 22, 3),
(1291, 13, 23, 3),
(1290, 13, 24, 4),
(1289, 12, 22, 4),
(1288, 12, 23, 4),
(1287, 12, 24, 3),
(1286, 11, 22, 4),
(1285, 11, 23, 3),
(1284, 11, 24, 4),
(1283, 10, 22, 4),
(1282, 10, 23, 4),
(1281, 10, 24, 4),
(1641, 10, 31, 3),
(1642, 10, 32, 4),
(1643, 10, 33, 2),
(1644, 11, 31, 4),
(1645, 11, 32, 2),
(1646, 11, 33, 3),
(1647, 12, 31, 2),
(1648, 12, 32, 3),
(1649, 12, 33, 4),
(1650, 13, 31, 3),
(1651, 13, 32, 2),
(1652, 13, 33, 3),
(1653, 14, 31, 4),
(1654, 14, 32, 3),
(1655, 14, 33, 2),
(1656, 15, 31, 2),
(1657, 15, 32, 4),
(1658, 15, 33, 3),
(1659, 16, 31, 3),
(1660, 16, 32, 2),
(1661, 16, 33, 4),
(1662, 17, 31, 4),
(1663, 17, 32, 3),
(1664, 17, 33, 2),
(1665, 18, 31, 2),
(1666, 18, 32, 4),
(1667, 18, 33, 3),
(1668, 19, 31, 3),
(1669, 19, 32, 2),
(1670, 19, 33, 4),
(1671, 20, 31, 1),
(1672, 20, 32, 3),
(1673, 20, 33, 3),
(1674, 21, 31, 4),
(1675, 21, 32, 2),
(1676, 21, 33, 3),
(1677, 22, 31, 3),
(1678, 22, 32, 4),
(1679, 22, 33, 1),
(1680, 23, 31, 2),
(1681, 23, 32, 3),
(1682, 23, 33, 4),
(1683, 24, 31, 4),
(1684, 24, 32, 1),
(1685, 24, 33, 3),
(1686, 25, 31, 3),
(1687, 25, 32, 4),
(1688, 25, 33, 2),
(1689, 26, 31, 2),
(1690, 26, 32, 3),
(1691, 26, 33, 4),
(1692, 27, 31, 4),
(1693, 27, 32, 2),
(1694, 27, 33, 1),
(1695, 28, 31, 3),
(1696, 28, 32, 4),
(1697, 28, 33, 2),
(1698, 29, 31, 1),
(1699, 29, 32, 3),
(1700, 29, 33, 4),
(1701, 30, 31, 4),
(1702, 30, 32, 2),
(1703, 30, 33, 3),
(1704, 31, 31, 2),
(1705, 31, 32, 4),
(1706, 31, 33, 3),
(1707, 32, 31, 3),
(1708, 32, 32, 1),
(1709, 32, 33, 4),
(1710, 33, 31, 4),
(1711, 33, 32, 3),
(1712, 33, 33, 2),
(1713, 34, 31, 2),
(1714, 34, 32, 4),
(1715, 34, 33, 3),
(1716, 35, 31, 3),
(1717, 35, 32, 2),
(1718, 35, 33, 1),
(1719, 36, 31, 4),
(1720, 36, 32, 3),
(1721, 36, 33, 2),
(1722, 37, 31, 1),
(1723, 37, 32, 4),
(1724, 37, 33, 3),
(1725, 38, 31, 3),
(1726, 38, 32, 2),
(1727, 38, 33, 4),
(1728, 39, 31, 2),
(1729, 39, 32, 3),
(1730, 39, 33, 1),
(1731, 40, 31, 4),
(1732, 40, 32, 2),
(1733, 40, 33, 3),
(1734, 41, 31, 3),
(1735, 41, 32, 4),
(1736, 41, 33, 2),
(1737, 42, 31, 1),
(1738, 42, 32, 3),
(1739, 42, 33, 4),
(1740, 43, 31, 4),
(1741, 43, 32, 2),
(1742, 43, 33, 3),
(1743, 44, 31, 2),
(1744, 44, 32, 4),
(1745, 44, 33, 1),
(1746, 45, 31, 3),
(1747, 45, 32, 1),
(1748, 45, 33, 4),
(1749, 46, 31, 4),
(1750, 46, 32, 3),
(1751, 46, 33, 2),
(1752, 47, 31, 2),
(1753, 47, 32, 4),
(1754, 47, 33, 3),
(1755, 48, 31, 3),
(1756, 48, 32, 2),
(1757, 48, 33, 4),
(1758, 49, 31, 1),
(1759, 49, 32, 3),
(1760, 49, 33, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `master_pelamar`
--
ALTER TABLE `master_pelamar`
  ADD PRIMARY KEY (`id_pelamar`);

--
-- Indexes for table `master_user`
--
ALTER TABLE `master_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `pm_aspek`
--
ALTER TABLE `pm_aspek`
  ADD PRIMARY KEY (`id_aspek`);

--
-- Indexes for table `pm_bobot`
--
ALTER TABLE `pm_bobot`
  ADD PRIMARY KEY (`selisih`);

--
-- Indexes for table `pm_faktor`
--
ALTER TABLE `pm_faktor`
  ADD PRIMARY KEY (`id_faktor`);

--
-- Indexes for table `pm_sample`
--
ALTER TABLE `pm_sample`
  ADD PRIMARY KEY (`id_sample`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `master_pelamar`
--
ALTER TABLE `master_pelamar`
  MODIFY `id_pelamar` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `master_user`
--
ALTER TABLE `master_user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pm_aspek`
--
ALTER TABLE `pm_aspek`
  MODIFY `id_aspek` tinyint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pm_faktor`
--
ALTER TABLE `pm_faktor`
  MODIFY `id_faktor` tinyint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `pm_sample`
--
ALTER TABLE `pm_sample`
  MODIFY `id_sample` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1761;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
