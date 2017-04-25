-- MySQL Script generated by MySQL Workbench
-- 04/25/17 11:14:52
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema gfiplay
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `gfiplay` ;

-- -----------------------------------------------------
-- Schema gfiplay
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `gfiplay` DEFAULT CHARACTER SET utf8 ;
USE `gfiplay` ;

-- -----------------------------------------------------
-- Table `gfiplay`.`JobApplication`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gfiplay`.`JobApplication` ;

CREATE TABLE IF NOT EXISTS `gfiplay`.`JobApplication` (
  `IdJobApplication` INT NOT NULL AUTO_INCREMENT,
  `Name` VARCHAR(45) NULL,
  PRIMARY KEY (`IdJobApplication`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gfiplay`.`User`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gfiplay`.`User` ;

CREATE TABLE IF NOT EXISTS `gfiplay`.`User` (
  `IdUser` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `Name` VARCHAR(45) NOT NULL,
  `Surname` VARCHAR(45) NOT NULL,
  `Birthdate` VARCHAR(45) NOT NULL,
  `Email` VARCHAR(45) NOT NULL,
  `CV` VARCHAR(45) NULL,
  `IdJobApplication` INT NOT NULL,
  `Role` VARCHAR(45) NULL,
  `Password` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`IdUser`, `IdJobApplication`),
  INDEX `fk_User_JobApplication1_idx` (`IdJobApplication` ASC),
  CONSTRAINT `fk_User_JobApplication1`
    FOREIGN KEY (`IdJobApplication`)
    REFERENCES `gfiplay`.`JobApplication` (`IdJobApplication`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gfiplay`.`Question`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gfiplay`.`Question` ;

CREATE TABLE IF NOT EXISTS `gfiplay`.`Question` (
  `IdQuestion` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `Wording` VARCHAR(45) NULL,
  `Type` VARCHAR(45) NULL,
  `IdJobApplication` INT NOT NULL,
  PRIMARY KEY (`IdQuestion`, `IdJobApplication`),
  INDEX `fk_Question_JobApplication1_idx` (`IdJobApplication` ASC),
  CONSTRAINT `fk_Question_JobApplication1`
    FOREIGN KEY (`IdJobApplication`)
    REFERENCES `gfiplay`.`JobApplication` (`IdJobApplication`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gfiplay`.`Answer`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gfiplay`.`Answer` ;

CREATE TABLE IF NOT EXISTS `gfiplay`.`Answer` (
  `IdAnswer` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `Text` VARCHAR(45) NULL,
  `Is_answer` VARCHAR(45) NULL,
  `IdQuestion` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`IdAnswer`, `IdQuestion`),
  INDEX `fk_Answer_QCM1_idx` (`IdQuestion` ASC),
  CONSTRAINT `fk_Answer_QCM1`
    FOREIGN KEY (`IdQuestion`)
    REFERENCES `gfiplay`.`Question` (`IdQuestion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gfiplay`.`Skills`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gfiplay`.`Skills` ;

CREATE TABLE IF NOT EXISTS `gfiplay`.`Skills` (
  `IdSkills` INT NOT NULL AUTO_INCREMENT,
  `Name` VARCHAR(45) NULL,
  `Type` TINYINT NULL,
  `Skillscol` VARCHAR(45) NULL,
  PRIMARY KEY (`IdSkills`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gfiplay`.`User_Skills`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gfiplay`.`User_Skills` ;

CREATE TABLE IF NOT EXISTS `gfiplay`.`User_Skills` (
  `IdUser` INT UNSIGNED NOT NULL,
  `IdSkills` INT NOT NULL,
  PRIMARY KEY (`IdUser`, `IdSkills`),
  INDEX `fk_User_has_Skills_Skills1_idx` (`IdSkills` ASC),
  INDEX `fk_User_has_Skills_User1_idx` (`IdUser` ASC),
  CONSTRAINT `fk_User_has_Skills_User1`
    FOREIGN KEY (`IdUser`)
    REFERENCES `gfiplay`.`User` (`IdUser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_User_has_Skills_Skills1`
    FOREIGN KEY (`IdSkills`)
    REFERENCES `gfiplay`.`Skills` (`IdSkills`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gfiplay`.`Game`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gfiplay`.`Game` ;

CREATE TABLE IF NOT EXISTS `gfiplay`.`Game` (
  `IdGame` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `IdUser` INT UNSIGNED NOT NULL,
  `Last_play` DATETIME NULL,
  `Score` INT NULL DEFAULT 0,
  `Last_question` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`IdGame`, `IdUser`, `Last_question`),
  INDEX `fk_Game_User1_idx` (`IdUser` ASC),
  INDEX `fk_Game_question1_idx` (`Last_question` ASC),
  CONSTRAINT `fk_Game_User1`
    FOREIGN KEY (`IdUser`)
    REFERENCES `gfiplay`.`User` (`IdUser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Game_question1`
    FOREIGN KEY (`Last_question`)
    REFERENCES `gfiplay`.`Question` (`IdQuestion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
