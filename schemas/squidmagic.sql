SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `squidmagic`
--

-- --------------------------------------------------------

--
-- Table structure for table `squidmagic_c2c`
--

CREATE TABLE IF NOT EXISTS `squidmagic_c2c` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ipaddress` varchar(20) NOT NULL,
  `squid` varchar(16) NOT NULL,
  `status` varchar(16) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;