SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS device_option;

CREATE TABLE `device_option` (
  `device_id` int(10) unsigned NOT NULL,
  `option_id` int(10) unsigned NOT NULL DEFAULT '0',
  UNIQUE KEY `device_id` (`device_id`,`option_id`),
  KEY `option_id` (`option_id`),
  CONSTRAINT `device_option_ibfk_2` FOREIGN KEY (`option_id`) REFERENCES `optiondef` (`option_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `device_option_ibfk_4` FOREIGN KEY (`device_id`) REFERENCES `device` (`device_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `device_option` (`device_id`, `option_id`)
VALUES
	(2, 97),
	(2, 355),
	(2, 356),
	(2, 357),
	(2, 358),
	(2, 359),
	(2, 360),
	(2, 361),
	(2, 408),
	(4, 12),
	(4, 13),
	(4, 153),
	(5, 6),
	(5, 72),
	(5, 73),
	(5, 79),
	(5, 173),
	(5, 174),
	(5, 441),
	(7, 12),
	(9, 12),
	(9, 13),
	(10, 54),
	(10, 365),
	(11, 13),
	(11, 54),
	(11, 365),
	(11, 442),
	(18, 12),
	(19, 12),
	(20, 12),
	(22, 12),
	(23, 12),
	(24, 12),
	(25, 12),
	(25, 400),
	(25, 401),
	(25, 402),
	(25, 403),
	(25, 404),
	(25, 405),
	(25, 406),
	(28, 12),
	(30, 92),
	(30, 371),
	(31, 96),
	(33, 12),
	(38, 12),
	(38, 13),
	(38, 54),
	(43, 97),
	(43, 112),
	(43, 113),
	(47, 399),
	(47, 407),
	(49, 6),
	(49, 12),
	(49, 72),
	(49, 73),
	(49, 388),
	(49, 400),
	(49, 401),
	(49, 402),
	(49, 403),
	(49, 404),
	(49, 405),
	(49, 406),
	(49, 412),
	(49, 413),
	(49, 414),
	(49, 415),
	(49, 416),
	(49, 417),
	(50, 363),
	(50, 364),
	(50, 365),
	(50, 366),
	(50, 367),
	(50, 368),
	(50, 383),
	(51, 437),
	(51, 438),
	(51, 439),
	(51, 440),
	(52, 96),
	(54, 96),
	(60, 79),
	(61, 6),
	(61, 72),
	(61, 79),
	(61, 173),
	(61, 174),
	(68, 12),
	(68, 388),
	(68, 400),
	(68, 401),
	(68, 402),
	(68, 403),
	(68, 404),
	(68, 405),
	(68, 406),
	(68, 425),
	(68, 426),
	(68, 427),
	(68, 428),
	(68, 429),
	(68, 430),
	(68, 431),
	(68, 432),
	(68, 433),
	(68, 434),
	(68, 435),
	(68, 436),
	(82, 12),
	(83, 12),
	(84, 12),
	(85, 12),
	(85, 13),
	(85, 392),
	(85, 393),
	(85, 394),
	(85, 410),
	(86, 181),
	(86, 182),
	(86, 189),
	(86, 191),
	(86, 195),
	(86, 196),
	(86, 197),
	(86, 198),
	(86, 199);

SET FOREIGN_KEY_CHECKS=1;
