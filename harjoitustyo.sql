DROP DATABASE if exists harjoitustyo;

CREATE DATABASE harjoitustyo;

USE harjoitustyo;



CREATE TABLE `tyontekija` (
  `tyontekijanro` int(11) NOT NULL,
  `nimi` char(50) DEFAULT NULL,
  `sposti` char(100) DEFAULT NULL,
  `puhnro` char(10) DEFAULT NULL,
  `osoite` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE `tyontekija`
  ADD PRIMARY KEY (`tyontekijanro`);

ALTER TABLE `tyontekija`
  MODIFY `tyontekijanro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

