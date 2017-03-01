/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Дамп структуры базы данных prodex-2
CREATE DATABASE IF NOT EXISTS `prodex-2` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `prodex-2`;

-- Дамп структуры для таблица prodex-2.images
CREATE TABLE IF NOT EXISTS `images` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `imageName` varchar(255) NOT NULL,
  `small` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы prodex-2.images: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` (`id`, `imageName`, `small`) VALUES
	(1, 'WaLLMiX90.jpg', 'sm-WaLLMiX90.jpg'),
	(2, 'WaLLMiX28.jpg', 'sm-WaLLMiX28.jpg'),
	(3, 'WaLLMiX35.jpg', 'sm-WaLLMiX35.jpg');
/*!40000 ALTER TABLE `images` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
