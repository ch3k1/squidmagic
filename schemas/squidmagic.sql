
CREATE TABLE IF NOT EXISTS `squidmagic_c2c` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ipaddress` varchar(20) NOT NULL,
  `squid` varchar(16) NOT NULL,
  `status` varchar(16) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
