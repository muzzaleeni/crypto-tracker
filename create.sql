-- Create User table
CREATE TABLE User (
    UserID NUMBER PRIMARY KEY,
    Email VARCHAR2(255) NOT NULL,
    Username VARCHAR2(255) NOT NULL,
    Password VARCHAR2(255) NOT NULL,
    Is_Premium BOOLEAN
);

-- Create Basic_User table (Subclass of User)
CREATE TABLE Basic_User (
    UserID NUMBER PRIMARY KEY,
    FOREIGN KEY (UserID) REFERENCES User(UserID)
);

-- Create Premium_User table (Subclass of User)
CREATE TABLE Premium_User (
    UserID NUMBER PRIMARY KEY,
    Subscription_Type VARCHAR2(255),
    Subscription_Start_Date DATE,
    Subscription_End_Date DATE,
    FOREIGN KEY (UserID) REFERENCES User(UserID)
);

-- Create Silver_Subscription_User table (Subclass of Premium_User)
CREATE TABLE Silver_Subscription_User (
    UserID NUMBER PRIMARY KEY,
    FOREIGN KEY (UserID) REFERENCES Premium_User(UserID)
);

-- Create Gold_Subscription_User table (Subclass of Premium_User)
CREATE TABLE Gold_Subscription_User (
    UserID NUMBER PRIMARY KEY,
    FOREIGN KEY (UserID) REFERENCES Premium_User(UserID)
);

-- Create Platinum_Subscription_User table (Subclass of Premium_User)
CREATE TABLE Platinum_Subscription_User (
    UserID NUMBER PRIMARY KEY,
    FOREIGN KEY (UserID) REFERENCES Premium_User(UserID)
);

-- Create Watchlist table
CREATE TABLE Watchlist (
    WatchlistID NUMBER PRIMARY KEY,
    UserID NUMBER,
    FOREIGN KEY (UserID) REFERENCES User(UserID)
);

-- Create Cryptocurrency table
CREATE TABLE Cryptocurrency (
    CryptoID NUMBER PRIMARY KEY,
    Rating NUMBER,
    Name VARCHAR2(255) NOT NULL,
    Price NUMBER,
    Sales_Volume NUMBER
);

-- Create BasicCrypto table (Subclass of Cryptocurrency)
CREATE TABLE BasicCrypto (
    CryptoID NUMBER PRIMARY KEY,
    Change_In_12_Hours NUMBER(5, 2),
    FOREIGN KEY (CryptoID) REFERENCES Cryptocurrency(CryptoID)
);

-- Create PremiumCrypto table (Subclass of Cryptocurrency)
CREATE TABLE PremiumCrypto (
    CryptoID NUMBER PRIMARY KEY,
    Change_In_24_Hours NUMBER(5, 2), 
    Analysis VARCHAR2(4000), 
    FOREIGN KEY (CryptoID) REFERENCES Cryptocurrency(CryptoID)
);

-- Create a junction table to represent the relationship between Basic_User and Cryptocurrency (m:n)
CREATE TABLE Basic_User_Crypto (
    UserID NUMBER,
    CryptoID NUMBER,
    PRIMARY KEY (UserID, CryptoID),
    FOREIGN KEY (UserID) REFERENCES Basic_User(UserID),
    FOREIGN KEY (CryptoID) REFERENCES Cryptocurrency(CryptoID)
);

-- Create a junction table to represent the relationship between Premium_User and Watchlist (1:n)
CREATE TABLE Premium_User_Watchlist (
    UserID NUMBER PRIMARY KEY,
    WatchlistID NUMBER UNIQUE,
    FOREIGN KEY (UserID) REFERENCES Premium_User(UserID),
    FOREIGN KEY (WatchlistID) REFERENCES Watchlist(WatchlistID)
);

-- Create a junction table to represent the relationship between Watchlist and Cryptocurrency (0:n)
CREATE TABLE Watchlist_Crypto (
    WatchlistID NUMBER,
    CryptoID NUMBER,
    PRIMARY KEY (WatchlistID, CryptoID),
    FOREIGN KEY (WatchlistID) REFERENCES Watchlist(WatchlistID),
    FOREIGN KEY (CryptoID) REFERENCES Cryptocurrency(CryptoID)
);
