ALTER TABLE `BOSCO_DB`.`pets`
  CHANGE COLUMN `gender` `gender` enum('macho','hembra') NOT NULL DEFAULT 'macho';
