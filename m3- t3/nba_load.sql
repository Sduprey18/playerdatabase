
-- Load data into Team table
LOAD DATA LOCAL INFILE 'teams.csv'
INTO TABLE Team
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS;

-- Load data into Player table
LOAD DATA LOCAL INFILE 'players.csv'
INTO TABLE Player
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS;

-- Load data into Player_Stats table
LOAD DATA LOCAL INFILE 'player_stats.csv'
INTO TABLE Player_Stats
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS;

-- Load data into Team_Stats table
LOAD DATA LOCAL INFILE 'team_stats.csv'
INTO TABLE Team_Stats
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS;

-- Load data into Player_Advanced_Stats table
LOAD DATA LOCAL INFILE 'player_advanced_stats.csv'
INTO TABLE Player_Advanced_Stats
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS;
