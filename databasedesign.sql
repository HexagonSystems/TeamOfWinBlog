SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `tow` DEFAULT CHARACTER SET utf8 ;
USE `tow` ;

-- -----------------------------------------------------
-- Table `tow`.`users`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `tow`.`users` (
  `username` VARCHAR(255) NOT NULL ,
  `email` VARCHAR(255) NOT NULL ,
  `password` VARCHAR(255) NOT NULL ,
  `createDate` DATETIME NOT NULL ,
  `ACL` INT NULL DEFAULT NULL ,
  `lastLoginDate` DATETIME NULL DEFAULT NULL ,
  PRIMARY KEY (`username`) ,
  UNIQUE INDEX `username_UNIQUE` (`username` ASC) ,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tow`.`posts`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `tow`.`posts` (
  `postid` INT NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(255) NOT NULL ,
  `status` VARCHAR(45) NOT NULL DEFAULT 'draft' ,
  `ACL` INT NOT NULL DEFAULT 1 ,
  `content` LONGTEXT NULL DEFAULT NULL ,
  `date` DATETIME NOT NULL ,
  `username` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`postid`) ,
  UNIQUE INDEX `postid_UNIQUE` (`postid` ASC) ,
  INDEX `username_idx` (`username` ASC) ,
  CONSTRAINT `username`
    FOREIGN KEY (`username` )
    REFERENCES `tow`.`users` (`username` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tow`.`comments`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `tow`.`comments` (
  `commentid` INT NOT NULL AUTO_INCREMENT ,
  `username` VARCHAR(255) NOT NULL ,
  `postid` INT NOT NULL ,
  `content` TEXT NOT NULL ,
  `status` VARCHAR(45) NOT NULL DEFAULT 'live' ,
  `ACL` INT NOT NULL ,
  `date` DATETIME NOT NULL ,
  PRIMARY KEY (`commentid`) ,
  UNIQUE INDEX `commentid_UNIQUE` (`commentid` ASC) ,
  INDEX `postid_idx` (`postid` ASC) ,
  INDEX `username_idx` (`username` ASC) ,
  CONSTRAINT `postid`
    FOREIGN KEY (`postid` )
    REFERENCES `tow`.`posts` (`postid` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `author`
    FOREIGN KEY (`username` )
    REFERENCES `tow`.`users` (`username` )
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB;

USE `tow` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
