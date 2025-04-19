
-- Create the NBA Stats database
CREATE DATABASE IF NOT EXISTS sduprey2_1;
USE sduprey2_1;

-- Create Teams table
CREATE TABLE IF NOT EXISTS Team (
    Team_id INT PRIMARY KEY,
    Name VARCHAR(50) UNIQUE,
    Stadium VARCHAR(50),
    Location VARCHAR(50)
);

-- Create Players table
CREATE TABLE IF NOT EXISTS Player (
    Player_id INT PRIMARY KEY,
    Name VARCHAR(50),
    Age INT,
    Weight INT,
    Height DECIMAL(4,2),
    Team_id INT,
    Position VARCHAR(5),
    FOREIGN KEY (Team_id) REFERENCES Team(Team_id)
);

-- Create Player Stats table
CREATE TABLE IF NOT EXISTS Player_Stats (
    Player_id INT PRIMARY KEY,
    Points DECIMAL(4,2),
    Rebounds DECIMAL(4,2),
    Assists DECIMAL(4,2),
    Steals DECIMAL(4,2),
    Blocks DECIMAL(4,2),
    Turnovers DECIMAL(4,2),
    Field_goal_percentage DECIMAL(4,3),
    Three_point_percentage DECIMAL(4,3),
    Minutes INT,
    FOREIGN KEY (Player_id) REFERENCES Player(Player_id)
);

-- Create Team Stats table
CREATE TABLE IF NOT EXISTS Team_Stats (
    Team_id INT PRIMARY KEY,
    Wins INT,
    Losses INT,
    Games_played INT,
    Win_percentage DECIMAL(4,3),
    Home_record VARCHAR(10),
    Away_record VARCHAR(10),
    FOREIGN KEY (Team_id) REFERENCES Team(Team_id)
);

-- Create Player Advanced Stats table
CREATE TABLE IF NOT EXISTS Player_Advanced_Stats (
    Player_id INT PRIMARY KEY,
    True_shooting_percentage DECIMAL(4,3),
    Effective_field_goal_percentage DECIMAL(4,3),
    Usage_rate DECIMAL(4,3),
    Plus_minus INT,
    Per DECIMAL(6,3),
    FOREIGN KEY (Player_id) REFERENCES Player(Player_id)
);
