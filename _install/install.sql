-- -----------------------------------------------------
-- Schema event-planner
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `event-planner` ;

-- -----------------------------------------------------
-- Schema event-planner
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `event-planner` DEFAULT CHARACTER SET utf8 ;
USE `event-planner` ;

-- -----------------------------------------------------
-- Table `event-planner`.`userRole`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `event-planner`.`userRole` ;

CREATE TABLE IF NOT EXISTS `event-planner`.`userRole` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `description` TEXT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `userRole_id_UNIQUE` (`id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `event-planner`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `event-planner`.`user` ;

CREATE TABLE IF NOT EXISTS `event-planner`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(255) NULL,
  `firstName` VARCHAR(255) NULL,
  `lastName` VARCHAR(255) NULL,
  `email` VARCHAR(45) NULL,
  `password` VARCHAR(255) NULL,
  `phone` VARCHAR(15) NULL,
  `active` VARCHAR(45) NULL,
  `userRoleId` INT NOT NULL,
  `employer` VARCHAR(255) NULL,
  `jobTitle` VARCHAR(255) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `user_id_UNIQUE` (`id` ASC),
  INDEX `fk_user_user_role_idx` (`userRoleId` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  CONSTRAINT `fk_user_user_role`
    FOREIGN KEY (`userRoleId`)
    REFERENCES `event-planner`.`userRole` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `event-planner`.`eventType`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `event-planner`.`eventType` ;

CREATE TABLE IF NOT EXISTS `event-planner`.`eventType` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` TEXT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `event-planner`.`event`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `event-planner`.`event` ;

CREATE TABLE IF NOT EXISTS `event-planner`.`event` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` TEXT NULL,
  `location` TEXT NULL,
  `host` VARCHAR(255) NULL,
  `startDateTime` DATETIME NULL,
  `endDateTime` DATETIME NULL,
  `message` TEXT NULL,
  `guests` TEXT NULL,
  `user_id` INT NOT NULL,
  `eventType_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_event_user1_idx` (`user_id` ASC),
  INDEX `fk_event_eventType1_idx` (`eventType_id` ASC),
  CONSTRAINT `fk_event_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `event-planner`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_event_eventType1`
    FOREIGN KEY (`eventType_id`)
    REFERENCES `event-planner`.`eventType` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `event-planner`.`userLog`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `event-planner`.`userLog` ;

CREATE TABLE IF NOT EXISTS `event-planner`.`userLog` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `loginDateTime` DATETIME NULL,
  `user_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_userLog_user1_idx` (`user_id` ASC),
  CONSTRAINT `fk_userLog_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `event-planner`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Data for table `event-planner`.`userRole`
-- -----------------------------------------------------
START TRANSACTION;
USE `event-planner`;
INSERT INTO `event-planner`.`userRole` (`id`, `name`, `description`) VALUES (1, 'Guest', 'Read-only access');
INSERT INTO `event-planner`.`userRole` (`id`, `name`, `description`) VALUES (2, 'Contributor', 'Read and write access');
INSERT INTO `event-planner`.`userRole` (`id`, `name`, `description`) VALUES (3, 'Admin', 'Access to everything');
INSERT INTO `event-planner`.`userRole` (`id`, `name`, `description`) VALUES (4, 'Overlord', 'Title given to the creator');

COMMIT;


-- -----------------------------------------------------
-- Data for table `event-planner`.`eventType`
-- -----------------------------------------------------
START TRANSACTION;
USE `event-planner`;
INSERT INTO `event-planner`.`eventType` (`id`, `name`) VALUES (1, 'Party');
INSERT INTO `event-planner`.`eventType` (`id`, `name`) VALUES (2, 'Conference');
INSERT INTO `event-planner`.`eventType` (`id`, `name`) VALUES (3, 'Birthday Party');
INSERT INTO `event-planner`.`eventType` (`id`, `name`) VALUES (4, 'Presentation');
INSERT INTO `event-planner`.`eventType` (`id`, `name`) VALUES (5, 'Concert');
INSERT INTO `event-planner`.`eventType` (`id`, `name`) VALUES (6, 'Show');

COMMIT;

