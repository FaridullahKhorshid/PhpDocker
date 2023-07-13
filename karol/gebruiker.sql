CREATE TABLE `gebruiker` (
 `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
 `voornaam` varchar(255) DEFAULT NULL,
 `tussenvoegsel` varchar(255) DEFAULT NULL,
 `achternaam` varchar(255) DEFAULT NULL,
 `email` varchar(255) DEFAULT NULL,
 `postcode` varchar(255) DEFAULT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;