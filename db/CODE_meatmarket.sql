-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema meatmarket
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema meatmarket
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `meatmarket` DEFAULT CHARACTER SET utf8 ;
USE `meatmarket` ;

-- -----------------------------------------------------
-- Table `meatmarket`.`Supplier`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `meatmarket`.`Supplier` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `phone` VARCHAR(45) NOT NULL,
  `email` VARCHAR(80) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `phone_UNIQUE` (`phone` ASC) ,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `meatmarket`.`Type`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `meatmarket`.`Type` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `type` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `meatmarket`.`Origin`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `meatmarket`.`Origin` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `pays` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `meatmarket`.`Quality`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `meatmarket`.`Quality` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `quality` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `meatmarket`.`Meat`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `meatmarket`.`Meat` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `quantity` INT NOT NULL,
  `idSupplier` INT NOT NULL,
  `arrival` DATE NOT NULL,
  `idType` INT NOT NULL,
  `idOrigin` INT NOT NULL,
  `idQuality` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `idmeatType_UNIQUE` (`id` ASC) ,
  INDEX `fk_Animal_Supplier_idx` (`idSupplier` ASC) ,
  INDEX `fk_Meat_Type1_idx` (`idType` ASC) ,
  INDEX `fk_Meat_Origin1_idx` (`idOrigin` ASC) ,
  INDEX `fk_Meat_Quality1_idx` (`idQuality` ASC) ,
  CONSTRAINT `fk_Animal_Supplier`
    FOREIGN KEY (`idSupplier`)
    REFERENCES `meatmarket`.`Supplier` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Meat_Type1`
    FOREIGN KEY (`idType`)
    REFERENCES `meatmarket`.`Type` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Meat_Origin1`
    FOREIGN KEY (`idOrigin`)
    REFERENCES `meatmarket`.`Origin` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Meat_Quality1`
    FOREIGN KEY (`idQuality`)
    REFERENCES `meatmarket`.`Quality` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `meatmarket`.`Cuts`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `meatmarket`.`Cuts` (
  `id` INT NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `price` DOUBLE NOT NULL,
  `stocks` DOUBLE NOT NULL,
  `expiration` DATE NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `meatmarket`.`AnimalCuts`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `meatmarket`.`AnimalCuts` (
  `Meat_idMeat` INT NOT NULL,
  `Cuts_idCuts` INT NOT NULL,
  PRIMARY KEY (`Meat_idMeat`, `Cuts_idCuts`),
  INDEX `fk_Animal_has_Cuts_Cuts1_idx` (`Cuts_idCuts` ASC) ,
  CONSTRAINT `fk_Animal_has_Cuts_Animal1`
    FOREIGN KEY (`Meat_idMeat`)
    REFERENCES `meatmarket`.`Meat` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Animal_has_Cuts_Cuts1`
    FOREIGN KEY (`Cuts_idCuts`)
    REFERENCES `meatmarket`.`Cuts` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `meatmarket`.`Privilege`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `meatmarket`.`Privilege` (
  `id` INT NOT NULL,
  `privilege` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `meatmarket`.`Employee`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `meatmarket`.`Employee` (
  `id` INT NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `password` VARCHAR(100) NOT NULL,
  `email` VARCHAR(60) NOT NULL,
  `idPrivilege` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) ,
  INDEX `fk_Employee_Privileges1_idx` (`idPrivilege` ASC) ,
  CONSTRAINT `fk_Employee_Privileges1`
    FOREIGN KEY (`idPrivilege`)
    REFERENCES `meatmarket`.`Privilege` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `meatmarket`.`Tracker`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `meatmarket`.`Tracker` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `ip` VARCHAR(100) NOT NULL,
  `date` DATE NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `visited` VARCHAR(150) NOT NULL,
  `idEmployee` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Tracker_Employee1_idx` (`idEmployee` ASC),
  CONSTRAINT `fk_Tracker_Employee1`
    FOREIGN KEY (`idEmployee`)
    REFERENCES `meatmarket`.`Employee` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
