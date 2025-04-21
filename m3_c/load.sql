USE sduprey2_1;


INSERT INTO Team
    (Team_id, Name, Stadium, Location)
VALUES
    (1, 'Los Angeles Lakers', 'Crypto.com Arena', 'Los Angeles'),
    (2, 'Golden State Warriors', 'Chase Center', 'San Francisco'),
    (3, 'Boston Celtics', 'TD Garden', 'Boston'),
    (4, 'Milwaukee Bucks', 'Fiserv Forum', 'Milwaukee'),
    (5, 'Denver Nuggets', 'Ball Arena', 'Denver'),
    (6, 'Dallas Mavericks', 'American Airlines Center', 'Dallas'),
    (7, 'Phoenix Suns', 'Footprint Center', 'Phoenix'),
    (8, 'Philadelphia 76ers', 'Wells Fargo Center', 'Philadelphia'),
    (9, 'Washington Wizards', 'Capital One Arena', 'Washington, D.C.'),
    (10, 'Miami Heat', 'Kaseya Center', 'Miami'),
    (11, 'Portland Trail Blazers', 'Moda Center', 'Portland'),
    (12, 'Cleveland Cavaliers', 'Rocket Mortgage FieldHouse', 'Cleveland'),
    (13, 'Minnesota Timberwolves', 'Target Center', 'Minneapolis'),
    (14, 'Indiana Pacers', 'Gainbridge Fieldhouse', 'Indianapolis'),
    (15, 'Memphis Grizzlies', 'FedExForum', 'Memphis'),
    (16, 'New Orleans Pelicans', 'Smoothie King Center', 'New Orleans'),
    (17, 'Atlanta Hawks', 'State Farm Arena', 'Atlanta'),
    (18, 'Charlotte Hornets', 'Spectrum Center', 'Charlotte'),
    (19, 'Toronto Raptors', 'Scotiabank Arena', 'Toronto'),
    (20, 'New York Knicks', 'Madison Square Garden', 'New York'),
    (21, 'San Antonio Spurs', 'Frost Bank Center', 'San Antonio'),
    (22, 'Sacramento Kings', 'Golden 1 Center', 'Sacramento'),
    (23, 'Chicago Bulls', 'United Center', 'Chicago'),
    (24, 'Houston Rockets', 'Toyota Center', 'Houston'),
    (25, 'Brooklyn Nets', 'Barclays Center', 'Brooklyn'),
    (26, 'Orlando Magic', 'Kia Center', 'Orlando'),
    (27, 'Detroit Pistons', 'Little Caesars Arena', 'Detroit'),
    (28, 'Oklahoma City Thunder', 'Paycom Center', 'Oklahoma City'),
    (29, 'Utah Jazz', 'Delta Center', 'Salt Lake City'),
    (30, 'Los Angeles Clippers', 'Crypto.com Arena', 'Los Angeles');


INSERT INTO Player
    (Player_id, Name, Age, Weight, Height, Team_id, Position)
VALUES
    (101, 'LeBron James', 39, 250, 6.9, 1, 'SF'),
    (102, 'Stephen Curry', 36, 185, 6.2, 2, 'PG'),
    (103, 'Jayson Tatum', 26, 210, 6.8, 3, 'SF'),
    (104, 'Giannis Antetokounmpo', 29, 243, 6.11, 4, 'PF'),
    (105, 'Nikola Jokic', 29, 284, 6.11, 5, 'C'),
    (106, 'Luka Doncic', 25, 230, 6.7, 6, 'PG'),
    (107, 'Kevin Durant', 35, 240, 6.10, 7, 'SF'),
    (108, 'Joel Embiid', 30, 280, 7.0, 8, 'C'),
    (109, 'Devin Booker', 27, 206, 6.6, 9, 'SG'),
    (110, 'Jimmy Butler', 34, 230, 6.7, 10, 'SF'),
    (111, 'Damian Lillard', 33, 195, 6.2, 11, 'PG'),
    (112, 'Donovan Mitchell', 27, 215, 6.1, 12, 'SG'),
    (113, 'Anthony Edwards', 22, 225, 6.4, 13, 'SG'),
    (114, 'Tyrese Haliburton', 24, 185, 6.5, 14, 'PG'),
    (115, 'Ja Morant', 24, 174, 6.2, 15, 'PG'),
    (116, 'Zion Williamson', 24, 284, 6.6, 16, 'PF'),
    (117, 'Brandon Ingram', 26, 190, 6.8, 16, 'SF'),
    (118, 'Bam Adebayo', 26, 255, 6.9, 10, 'C'),
    (119, 'Trae Young', 25, 164, 6.1, 17, 'PG'),
    (120, 'LaMelo Ball', 23, 180, 6.7, 18, 'PG'),
    (121, 'Scottie Barnes', 22, 225, 6.9, 19, 'SF'),
    (122, 'Pascal Siakam', 30, 230, 6.9, 19, 'PF'),
    (123, 'Jalen Brunson', 27, 190, 6.2, 20, 'PG'),
    (124, 'Julius Randle', 29, 250, 6.8, 20, 'PF'),
    (125, 'Kentavious Caldwell-Pope', 31, 204, 6.5, 5, 'SG'),
    (126, 'Jamal Murray', 27, 215, 6.4, 5, 'PG'),
    (127, 'Victor Wembanyama', 20, 225, 7.4, 21, 'C'),
    (128, 'Domantas Sabonis', 27, 240, 6.11, 22, 'C'),
    (129, 'DeAaron Fox', 26, 185, 6.3, 22, 'PG'),
    (130, 'Bradley Beal', 30, 207, 6.4, 9, 'SG');


INSERT INTO Player_Stats
    (Player_id, Points, Rebounds, Assists, Steals, Blocks, Turnovers, Field_goal_percentage, Three_point_percentage, Minutes)
VALUES
    (101, 27.2, 8.1, 7.4, 1.6, 0.6, 4.5, 0.511, 0.304, 34),
    (102, 29.9, 5.3, 6.3, 1.6, 0.2, 3.1, 0.473, 0.420, 34),
    (103, 26.4, 7.0, 4.5, 1.1, 0.7, 3.0, 0.457, 0.376, 35),
    (104, 29.9, 11.6, 5.9, 1.0, 1.4, 3.5, 0.553, 0.303, 34),
    (105, 26.1, 10.9, 7.7, 0.5, 1.0, 4.0, 0.567, 0.318, 34),
    (106, 32.4, 8.1, 8.6, 1.1, 0.2, 4.0, 0.484, 0.348, 35),
    (107, 28.1, 7.1, 4.8, 1.0, 1.1, 3.6, 0.539, 0.375, 33),
    (108, 30.3, 10.5, 4.2, 1.6, 2.5, 3.8, 0.539, 0.329, 35),
    (109, 27.8, 4.3, 5.5, 1.2, 0.4, 2.6, 0.485, 0.376, 34),
    (110, 22.9, 6.2, 5.3, 1.7, 0.4, 2.5, 0.488, 0.321, 34),
    (111, 24.8, 4.0, 7.3, 0.8, 0.1, 3.0, 0.437, 0.366, 35),
    (112, 25.6, 3.6, 4.4, 1.1, 0.3, 2.3, 0.472, 0.383, 34),
    (113, 23.0, 5.8, 3.5, 1.5, 0.7, 2.7, 0.473, 0.368, 33),
    (114, 20.3, 4.0, 9.6, 1.4, 0.1, 3.3, 0.454, 0.358, 33),
    (115, 22.8, 4.4, 7.3, 1.0, 0.3, 3.2, 0.474, 0.308, 34),
    (116, 27.0, 6.9, 3.6, 0.6, 0.5, 3.8, 0.617, 0.326, 33),
    (117, 22.6, 5.5, 2.9, 0.9, 0.4, 2.7, 0.487, 0.364, 33),
    (118, 16.7, 8.4, 2.1, 1.0, 1.0, 1.8, 0.508, 0.335, 33),
    (119, 24.0, 3.8, 9.1, 1.3, 0.2, 3.5, 0.435, 0.344, 34),
    (120, 19.7, 5.5, 6.9, 1.5, 0.4, 3.4, 0.434, 0.367, 33),
    (121, 14.7, 7.2, 2.8, 1.0, 0.5, 2.4, 0.452, 0.341, 32),
    (122, 21.3, 8.4, 4.3, 1.3, 0.9, 2.7, 0.467, 0.359, 34),
    (123, 16.8, 3.3, 5.4, 0.9, 0.2, 2.3, 0.488, 0.338, 33),
    (124, 20.0, 9.3, 2.8, 1.0, 0.5, 3.1, 0.458, 0.336, 34),
    (125, 14.1, 4.2, 2.5, 0.9, 0.3, 1.7, 0.467, 0.380, 30),
    (126, 15.9, 3.6, 3.1, 1.0, 0.2, 1.5, 0.457, 0.342, 32),
    (127, 18.7, 10.5, 1.1, 1.0, 2.5, 2.8, 0.482, 0.242, 33),
    (128, 19.4, 12.1, 3.7, 1.2, 1.3, 3.0, 0.506, 0.342, 34),
    (129, 17.2, 4.0, 5.8, 1.0, 0.3, 2.1, 0.472, 0.319, 33),
    (130, 23.3, 3.5, 4.6, 1.2, 0.3, 2.7, 0.474, 0.375, 32);

INSERT INTO Team_Stats
    (Team_id, Wins, Losses, Games_played, Win_percentage)
VALUES
    (1, 50, 32, 82, 0.610),
    (2, 48, 34, 82, 0.585),
    (3, 61, 21, 82, 0.744),
    (4, 48, 34, 82, 0.585),
    (5, 50, 32, 82, 0.610),
    (6, 39, 43, 82, 0.476),
    (7, 36, 46, 82, 0.439),
    (8, 24, 58, 82, 0.293),
    (9, 18, 64, 82, 0.220),
    (10, 37, 45, 82, 0.451),
    (11, 36, 46, 82, 0.439),
    (12, 64, 18, 82, 0.780),
    (13, 49, 33, 82, 0.598),
    (14, 50, 32, 82, 0.610),
    (15, 48, 34, 82, 0.585),
    (16, 21, 61, 82, 0.256),
    (17, 40, 42, 82, 0.488),
    (18, 19, 63, 82, 0.232),
    (19, 30, 52, 82, 0.366),
    (20, 51, 31, 82, 0.622),
    (21, 34, 48, 82, 0.415),
    (22, 40, 42, 82, 0.488),
    (23, 39, 43, 82, 0.476),
    (24, 52, 30, 82, 0.634),
    (25, 26, 56, 82, 0.317),
    (26, 41, 41, 82, 0.500),
    (27, 44, 38, 82, 0.537),
    (28, 68, 14, 82, 0.829),
    (29, 17, 65, 82, 0.207),
    (30, 50, 32, 82, 0.610);


INSERT INTO Player_Advanced_Stats
    (Player_id, True_shooting_percentage, Effective_field_goal_percentage, Usage_rate, Plus_minus, Per)
VALUES
    (101, 0.607, 0.590, 0.302, 8, 27.5),
    (102, 0.625, 0.590, 0.311, 5, 24.1),
    (103, 0.585, 0.550, 0.265, 3, 21.3),
    (104, 0.603, 0.588, 0.300, 10, 26.7),
    (105, 0.605, 0.590, 0.305, 7, 27.1),
    (106, 0.588, 0.576, 0.285, 6, 22.5),
    (107, 0.582, 0.565, 0.290, 4, 23.3),
    (108, 0.635, 0.620, 0.315, 12, 30.2),
    (109, 0.550, 0.545, 0.270, 5, 22.0),
    (110, 0.610, 0.590, 0.280, 6, 21.5),
    (111, 0.567, 0.543, 0.265, 4, 22.1),
    (112, 0.572, 0.560, 0.255, 3, 20.4),
    (113, 0.587, 0.570, 0.250, 2, 18.9),
    (114, 0.561, 0.550, 0.245, 5, 20.0),
    (115, 0.570, 0.559, 0.280, 4, 19.6),
    (116, 0.566, 0.555, 0.225, 7, 19.1),
    (117, 0.578, 0.560, 0.265, 6, 19.8),
    (118, 0.602, 0.590, 0.285, 8, 25.3),
    (119, 0.563, 0.540, 0.255, 4, 18.7),
    (120, 0.590, 0.570, 0.260, 5, 21.1),
    (121, 0.590, 0.565, 0.270, 3, 21.4),

    (122, 0.585, 0.570, 0.280, 6, 22.0),

    (123, 0.570, 0.555, 0.260, 4, 20.2),
    
    (124, 0.598, 0.580, 0.295, 7, 23.0),

    (125, 0.562, 0.540, 0.250, 2, 18.3),

    (126, 0.565, 0.550, 0.235, 3, 19.0),

    (127, 0.650, 0.630, 0.310, 10, 28.1),
  
    (128, 0.598, 0.580, 0.285, 6, 24.5),
 
    (129, 0.578, 0.570, 0.270, 5, 21.0),

    (130, 0.573, 0.550, 0.265, 4, 20.5);
