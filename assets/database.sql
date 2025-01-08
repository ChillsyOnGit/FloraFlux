CREATE TABLE `Gebruiker` (
  `id` char(8) NOT NULL,
  `voornaam` varchar(32) NOT NULL,
  `achternaam` varchar(32) NOT NULL,
  `wachtwoord` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telefoonnummer` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `Appinstellingen` (
  `id` char(8) NOT NULL,
  `notificatieKritiek` tinyint(1) NOT NULL,
  `notificatieInfo` tinyint(1) NOT NULL,
  `notificatieherhaling` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`id`) REFERENCES `Gebruiker` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `Product` (
  `id` varchar(10) NOT NULL,
  `productsoort` ENUM('XL', 'L', 'M', 'S') NOT NULL,
  `nicknaam` varchar(255) DEFAULT NULL,
  `gebruikersId` char(8) DEFAULT NULL,
  `geactiveerd` tinyint(1) NOT NULL DEFAULT 0,
  `plaatje` varchar(255) DEFAULT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`gebruikersId`) REFERENCES `Gebruiker` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `Meting` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp(),
  `vochtigheid` int(3) NOT NULL,
  `waterGebruikt` int(5) NOT NULL,
  `product` varchar(10) NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`product`) REFERENCES `Product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
);
INSERT INTO `Gebruiker` (`id`, `voornaam`, `achternaam`, `wachtwoord`, `email`, `telefoonnummer`) VALUES
('G0000001', 'robin', 'rid', '$2y$10$E2VkfNQt6ArTpWMbUDUdNuSkr4eM1nZQHF9Wj3FAPjSrhsbngkjy6', 'buh@gmail.com', '1293478'),
('G0000002', 'Mike', 'vandenberg', '$2y$10$E2VkfNQt6ArTpWMbUDUdNuSkr4eM1nZQHF9Wj3FAPjSrhsbngkjy6', 'mikevdberg0511@gmail.com', '06245847');



INSERT INTO `Product` (`id`, `productsoort`, `nicknaam`, `gebruikersId`, `geactiveerd`, `plaatje`) VALUES
('a1b2c3d4e5', 'XL', 'buh', 'G0000001', 1, NULL),
('f6g7h8i9j0', 'L', NULL, NULL, 0, NULL),
('k1l2m3n4o5', 'M', NULL, NULL, 0, NULL),
('p6q7r8s9t0', 'S', NULL, NULL, 0, NULL),
('u1v2w3x4y5', 'M', NULL, NULL, 0, NULL),
('z1y2x3w4v5', 'XL', NULL, NULL, 0, NULL),
('t6s7r8q9p0', 'L', NULL, NULL, 0, NULL),
('o1n2m3l4k5', 'M', NULL, NULL, 0, NULL),
('j6i7h8g9f0', 'S', NULL, NULL, 0, NULL),
('e1d2c3b4a5', 'XL', NULL, NULL, 0, NULL),
('b1c2d3e4f5', 'XL', NULL, NULL, 0, NULL),
('g6h7i8j9k0', 'L', NULL, NULL, 0, NULL),
('l1m2n3o4p5', 'M', NULL, NULL, 0, NULL),
('q6r7s8t9u0', 'S', NULL, NULL, 0, NULL),
('v1w2x3y4z5', 'S', NULL, NULL, 0, NULL),
('a6b7c8d9e0', 'XL', NULL, NULL, 0, NULL),
('f1g2h3i4j5', 'L', NULL, NULL, 0, NULL),
('k6l7m8n9o0', 'M', NULL, NULL, 0, NULL),
('p1q2r3s4t5', 'S', NULL, NULL, 0, NULL),
('u6v7w8x9y0', 'XL', NULL, NULL, 0, NULL),
('z6y7x8w9v0', 'XL', NULL, NULL, 0, NULL),
('t1s2r3q4p5', 'L', NULL, NULL, 0, NULL),
('o6n7m8l9k0', 'M', NULL, NULL, 0, NULL),
('j1i2h3g4f5', 'S', NULL, NULL, 0, NULL),
('e6d7c8b9a0', 'S', NULL, NULL, 0, NULL),
('b6c7d8e9f0', 'XL', NULL, NULL, 0, NULL),
('g1h2i3j4k5', 'L', NULL, NULL, 0, NULL),
('l6m7n8o9p0', 'M', NULL, NULL, 0, NULL),
('q1r2s3t4u5', 'S', NULL, NULL, 0, NULL),
('v6w7x8y9z0', 'M', NULL, NULL, 0, NULL),
('a2b3c4d5e6', 'XL', NULL, NULL, 0, NULL),
('f7g8h9i0j1', 'L', NULL, NULL, 0, NULL),
('k2l3m4n5o6', 'M', NULL, NULL, 0, NULL),
('p7q8r9s0t1', 'S', NULL, NULL, 0, NULL),
('u2v3w4x5y6', 'M', NULL, NULL, 0, NULL),
('z7y8x9w0v1', 'XL', NULL, NULL, 0, NULL),
('t2s3r4q5p6', 'L', NULL, NULL, 0, NULL),
('o7n8m9l0k1', 'M', NULL, NULL, 0, NULL),
('j2i3h4g5f6', 'S', NULL, NULL, 0, NULL),
('e7d8c9b0a1', 'XL', NULL, NULL, 0, NULL),
('b2c3d4e5f6', 'XL', NULL, NULL, 0, NULL),
('g7h8i9j0k1', 'L', NULL, NULL, 0, NULL),
('l2m3n4o5p6', 'M', NULL, NULL, 0, NULL),
('q7r8s9t0u1', 'S', NULL, NULL, 0, NULL),
('v2w3x4y5z6', 'M', NULL, NULL, 0, NULL),
('a3b4c5d6e7', 'XL', NULL, NULL, 0, NULL),
('f8g9h0i1j2', 'L', NULL, NULL, 0, NULL),
('k3l4m5n6o7', 'M', NULL, NULL, 0, NULL),
('p8q9r0s1t2', 'S', NULL, NULL, 0, NULL),
('u3v4w5x6y7', 'S', NULL, NULL, 0, NULL);

INSERT INTO `Meting` (`id`, `timestamp`, `vochtigheid`, `waterGebruikt`, `product`) VALUES
(1, '2025-01-01 01:34:05', 10, 12, 'a1b2c3d4e5'),
(2, '2025-01-02 10:34:51', 10, 12, 'a1b2c3d4e5'),
(3, '2025-01-03 10:34:51', 10, 12, 'a1b2c3d4e5'),
(4, '2025-01-04 10:34:51', 10, 12, 'a1b2c3d4e5'),
(5, '2025-01-05 10:34:51', 10, 12, 'a1b2c3d4e5'),
(6, '2025-01-06 10:34:51', 10, 12, 'a1b2c3d4e5'),
(7, '2025-01-07 10:34:51', 10, 12, 'a1b2c3d4e5'),
(8, '2025-01-08 01:34:51', 10, 12, 'a1b2c3d4e5');