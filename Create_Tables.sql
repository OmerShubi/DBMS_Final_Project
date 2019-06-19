<?php
CREATE TABLE Trek(
  trekName      VARCHAR(20) PRIMARY KEY,
  length        FLOAT,
  LAT			FLOAT,
  LONG			FLOAT
);

CREATE TABLE TrekInCountry(
  countryName   VARCHAR(20),
  trekName      VARCHAR(20),
  PRIMARY KEY (countryName, trekName),
  FOREIGN KEY (trekName) REFERENCES Trek(trekName) ON DELETE CASCADE
);

CREATE TABLE Hiker(
  ID             INTEGER PRIMARY KEY,
  fullName       VARCHAR(20) NOT NULL ,
  originCountry  VARCHAR(20) NOT NULL ,
  Smoker         VARCHAR(3),
  Fitness        INTEGER,
  CHECK (Smoker='Yes' OR Smoker='No'),
  CHECK (Fitness>=0 AND Fitness<=100)
)

CREATE TABLE HikerInTrek(
  hikerID         INTEGER,
  trekName        VARCHAR(20),
  startDate       DATE,
  PRIMARY KEY (hikerID, trekName),
  FOREIGN KEY (hikerID) REFERENCES Hiker(ID) ON DELETE CASCADE,
  FOREIGN KEY (trekName) REFERENCES Trek ON DELETE CASCADE
)
>


