-- Create the User table
CREATE TABLE User (
    UserID INT PRIMARY KEY,
    Username VARCHAR(255),
    Password VARCHAR(255)
);

-- Create the Basic_Usr table as a subtype of User
CREATE TABLE Basic_Usr (
    UserID INT PRIMARY KEY,
    RegistrationDate VARCHAR(255),
    FOREIGN KEY (UserID) REFERENCES User(UserID)
);

-- Create the Admin_Usr table as a subtype of User
CREATE TABLE Admin_Usr (
    UserID INT PRIMARY KEY,
    RoleName VARCHAR(255),
    FOREIGN KEY (UserID) REFERENCES User(UserID)
);

-- Create the Watchlist table
CREATE TABLE Watchlist (
    WatchlistID INT PRIMARY KEY,
    UserID INT,
    CryptoID INT,
    AddedDate VARCHAR(255),
    FOREIGN KEY (UserID) REFERENCES User(UserID),
    FOREIGN KEY (CryptoID) REFERENCES Cryptocurrency(CryptoID)
);

-- Create the Custom_Watchlist table as a subtype of Watchlist
CREATE TABLE Custom_Watchlist (
    WatchlistID INT PRIMARY KEY,
    Editable BOOLEAN,
    FOREIGN KEY (WatchlistID) REFERENCES Watchlist(WatchlistID)
);

-- Create the Default_Watchlist table as a subtype of Watchlist
CREATE TABLE Default_Watchlist (
    WatchlistID INT PRIMARY KEY,
    CategoryDefault VARCHAR(255),
    FOREIGN KEY (WatchlistID) REFERENCES Watchlist(WatchlistID)
);

-- Create the View_in table
CREATE TABLE View_in (
    WatchlistID INT,
    Currency VARCHAR(255),
    FOREIGN KEY (WatchlistID) REFERENCES Watchlist(WatchlistID)
);

-- Create the Cryptocurrency table
CREATE TABLE Cryptocurrency (
    CryptoID INT PRIMARY KEY,
    Rating INT,
    Name VARCHAR(255),
    Price INT,
    ChangeIn24Hours INT,
    SalesVolume INT
);

-- Create the TrackedCryptocurrency table as a subtype of Cryptocurrency
CREATE TABLE TrackedCryptocurrency (
    CryptoID INT PRIMARY KEY,
    FOREIGN KEY (CryptoID) REFERENCES Cryptocurrency(CryptoID)
);

-- Create the PreferredCryptocurrency table as a subtype of Cryptocurrency
CREATE TABLE PreferredCryptocurrency (
    CryptoID INT PRIMARY KEY,
    FOREIGN KEY (CryptoID) REFERENCES Cryptocurrency(CryptoID)
);
