""""""""""""""users sql code"""""""""""""""""""""
create database users;
use users;

 CREATE TABLE users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) COLLATE utf8mb4_general_ci NOT NULL,
    email VARCHAR(255) COLLATE utf8mb4_general_ci NOT NULL,
    password VARCHAR(255) COLLATE utf8mb4_general_ci NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

""""""""""""""contacts sql code"""""""""""""""""""""
create database contacts;
use contacts;

CREATE TABLE contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    company VARCHAR(100),
    job_title VARCHAR(100),
    birthday DATE,
    tags VARCHAR(100),
    notes TEXT,
    address VARCHAR(255),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);


""""""""""""""data to insert"""""""""""""""""""""
INSERT INTO contacts (user_id, name, email, phone, company, job_title, birthday, tags, notes, address, created_at)
VALUES
  (1, 'Zara Anderson', 'zara.anderson1@hotmail.com', '8691165583', 'Acme Corp', 'Manager', '1989-12-17', 'Acquaintance', 'Test entry #1', '676 Pine Rd.', NOW()),
  (1, 'Diana Martin', 'diana.martin2@hotmail.com', '3607986602', 'Initech', 'Analyst', '1971-10-25', 'Acquaintance', 'Test entry #2', '401 Sunset Blvd.', NOW()),
  (1, 'Tina Rodriguez', 'tina.rodriguez3@gmail.com', '9551934800', 'Stark Industries', 'Consultant', '1989-04-18', 'Acquaintance', 'Test entry #3', '307 Cedar Ln.', NOW()),
  (1, 'Yusuf Martinez', 'yusuf.martinez4@yahoo.com', '5561318840', 'Cyberdyne', 'Analyst', '1986-08-17', 'Family', 'Test entry #4', '860 Main St.', NOW()),
  (1, 'Umar Jones', 'umar.jones5@hotmail.com', '5560058706', 'Cyberdyne', 'Administrator', '1999-08-25', 'Family', 'Test entry #5', '625 Lakeview Dr.', NOW()),
  (1, 'Ethan Jackson', 'ethan.jackson6@hotmail.com', '1194719184', 'Stark Industries', 'Consultant', '1990-07-14', 'Client', 'Test entry #6', '552 Elm St.', NOW()),
  (1, 'Paula Garcia', 'paula.garcia7@hotmail.com', '4772584916', 'Stark Industries', 'Coordinator', '1984-12-11', 'Acquaintance', 'Test entry #7', '830 Maple Ave.', NOW()),
  (1, 'Zara Garcia', 'zara.garcia8@gmail.com', '3531797374', 'Initech', 'Consultant', '1999-12-01', 'Acquaintance', 'Test entry #8', '168 Cedar Ln.', NOW()),
  (1, 'William Taylor', 'william.taylor9@yahoo.com', '4343847311', 'Wonka Industries', 'Coordinator', '1972-12-16', 'Acquaintance', 'Test entry #9', '716 Main St.', NOW()),
  (1, 'Rachel Hernandez', 'rachel.hernandez10@gmail.com', '4260705008', 'Initech', 'Director', '1972-05-06', 'Friend', 'Test entry #10', '350 Oak St.', NOW()),
  (1, 'Kevin Wilson', 'kevin.wilson11@yahoo.com', '0987051579', 'Umbrella Inc', 'Developer', '1993-12-04', 'Family', 'Test entry #11', '640 Oak St.', NOW()),
  (1, 'Victoria Taylor', 'victoria.taylor12@gmail.com', '8025870766', 'Cyberdyne', 'Analyst', '1977-04-29', 'Friend', 'Test entry #12', '457 Sunset Blvd.', NOW()),
  (1, 'Umar Williams', 'umar.williams13@yahoo.com', '5990047760', 'Hooli', 'Supervisor', '1978-02-24', 'Coworker', 'Test entry #13', '638 Sunset Blvd.', NOW()),
  (1, 'Zara Anderson', 'zara.anderson14@gmail.com', '0262325074', 'Soylent Corp', 'Manager', '1996-12-29', 'Acquaintance', 'Test entry #14', '141 Maple Ave.', NOW()),
  (1, 'Bob Garcia', 'bob.garcia15@hotmail.com', '2413848307', 'Umbrella Inc', 'Coordinator', '1992-05-01', 'Friend', 'Test entry #15', '187 Main St.', NOW()),
  (1, 'Tina Davis', 'tina.davis16@hotmail.com', '6257417191', 'Hooli', 'Manager', '1988-06-03', 'Client', 'Test entry #16', '825 Hillcrest Rd.', NOW()),
  (1, 'Kevin Jackson', 'kevin.jackson17@hotmail.com', '3797213397', 'Cyberdyne', 'Supervisor', '1981-04-29', 'Acquaintance', 'Test entry #17', '414 Main St.', NOW()),
  (1, 'Kevin Anderson', 'kevin.anderson18@hotmail.com', '1776174202', 'Soylent Corp', 'Supervisor', '1975-10-09', 'Client', 'Test entry #18', '311 Lakeview Dr.', NOW()),
  (1, 'Steven Moore', 'steven.moore19@yahoo.com', '8167166600', 'Cyberdyne', 'Supervisor', '1982-05-15', 'Client', 'Test entry #19', '958 Sunset Blvd.', NOW()),
  (1, 'Umar Thomas', 'umar.thomas20@yahoo.com', '0493577002', 'Soylent Corp', 'Manager', '1996-04-15', 'Family', 'Test entry #20', '427 Cedar Ln.', NOW()),
  (1, 'Nina Johnson', 'nina.johnson21@hotmail.com', '1464840931', 'Wayne Enterprises', 'Manager', '1978-05-24', 'Coworker', 'Test entry #21', '105 Cedar Ln.', NOW()),
  (1, 'Zara Martin', 'zara.martin22@hotmail.com', '5649625907', 'Hooli', 'Administrator', '1985-03-24', 'Acquaintance', 'Test entry #22', '951 Sunset Blvd.', NOW()),
  (1, 'Bob Martinez', 'bob.martinez23@yahoo.com', '6778632390', 'Wonka Industries', 'Administrator', '1987-12-03', 'Friend', 'Test entry #23', '532 Oak St.', NOW()),
  (1, 'Yusuf Thomas', 'yusuf.thomas24@hotmail.com', '1104265978', 'Acme Corp', 'Supervisor', '1971-04-11', 'Coworker', 'Test entry #24', '205 Washington Ave.', NOW()),
  (1, 'George Thompson', 'george.thompson25@gmail.com', '8436057976', 'Cyberdyne', 'Consultant', '1999-05-30', 'Coworker', 'Test entry #25', '830 Hillcrest Rd.', NOW()),
  (1, 'Umar Davis', 'umar.davis26@gmail.com', '6843468542', 'Soylent Corp', 'Director', '1989-06-08', 'Client', 'Test entry #26', '832 Main St.', NOW()),
  (1, 'Tina Jackson', 'tina.jackson27@hotmail.com', '0654580941', 'Cyberdyne', 'Manager', '1979-12-11', 'Friend', 'Test entry #27', '453 Main St.', NOW()),
  (1, 'Ethan Johnson', 'ethan.johnson28@yahoo.com', '2928293832', 'Stark Industries', 'Manager', '1978-02-01', 'Coworker', 'Test entry #28', '895 Lakeview Dr.', NOW()),
  (1, 'Julia Davis', 'julia.davis29@gmail.com', '0458495429', 'Cyberdyne', 'Developer', '1985-12-10', 'Client', 'Test entry #29', '672 Lakeview Dr.', NOW()),
  (1, 'Zara Smith', 'zara.smith30@gmail.com', '0920351779', 'Umbrella Inc', 'Engineer', '1974-04-21', 'Coworker', 'Test entry #30', '282 Sunset Blvd.', NOW()),
  (1, 'Kevin Brown', 'kevin.brown31@yahoo.com', '7874904506', 'Hooli', 'Coordinator', '1986-08-31', 'Friend', 'Test entry #31', '512 Oak St.', NOW()),
  (1, 'Zara Smith', 'zara.smith32@yahoo.com', '3907967044', 'Umbrella Inc', 'Analyst', '1984-06-09', 'Acquaintance', 'Test entry #32', '466 Lakeview Dr.', NOW()),
  (1, 'Umar Wilson', 'umar.wilson33@hotmail.com', '3496026999', 'Umbrella Inc', 'Director', '1995-11-07', 'Friend', 'Test entry #33', '227 Maple Ave.', NOW()),
  (1, 'Ethan Martin', 'ethan.martin34@hotmail.com', '1961776719', 'Wayne Enterprises', 'Consultant', '1993-04-05', 'Acquaintance', 'Test entry #34', '666 Lakeview Dr.', NOW()),
  (1, 'Oliver Johnson', 'oliver.johnson35@hotmail.com', '0616457054', 'Globex', 'Supervisor', '1986-12-19', 'Coworker', 'Test entry #35', '990 Main St.', NOW()),
  (1, 'Nina Jones', 'nina.jones36@hotmail.com', '9316549704', 'Umbrella Inc', 'Administrator', '1976-11-24', 'Friend', 'Test entry #36', '687 Hillcrest Rd.', NOW()),
  (1, 'Xena Moore', 'xena.moore37@hotmail.com', '3153846092', 'Hooli', 'Manager', '1971-01-25', 'Friend', 'Test entry #37', '731 Sunset Blvd.', NOW()),
  (1, 'George Thomas', 'george.thomas38@gmail.com', '0964637297', 'Soylent Corp', 'Engineer', '1998-04-19', 'Family', 'Test entry #38', '421 Maple Ave.', NOW()),
  (1, 'Rachel Hernandez', 'rachel.hernandez39@yahoo.com', '7376720549', 'Umbrella Inc', 'Supervisor', '1979-03-04', 'Friend', 'Test entry #39', '372 Lakeview Dr.', NOW()),
  (1, 'Michael Johnson', 'michael.johnson40@yahoo.com', '9679810843', 'Stark Industries', 'Director', '1983-08-28', 'Acquaintance', 'Test entry #40', '594 Oak St.', NOW()),
  (1, 'Rachel Jackson', 'rachel.jackson41@hotmail.com', '2050058855', 'Wonka Industries', 'Consultant', '1973-08-30', 'Client', 'Test entry #41', '815 Oak St.', NOW()),
  (1, 'Hannah Martin', 'hannah.martin42@hotmail.com', '8553478767', 'Wonka Industries', 'Specialist', '1999-08-27', 'Friend', 'Test entry #42', '780 Hillcrest Rd.', NOW()),
  (1, 'Hannah Brown', 'hannah.brown43@gmail.com', '9824475177', 'Wonka Industries', 'Coordinator', '1980-04-18', 'Acquaintance', 'Test entry #43', '394 Maple Ave.', NOW()),
  (1, 'Kevin Davis', 'kevin.davis44@yahoo.com', '2283607064', 'Initech', 'Coordinator', '1984-12-03', 'Family', 'Test entry #44', '272 Elm St.', NOW()),
  (1, 'Victoria Moore', 'victoria.moore45@yahoo.com', '3689953153', 'Hooli', 'Administrator', '1983-10-29', 'Coworker', 'Test entry #45', '576 Sunset Blvd.', NOW()),
  (1, 'Nina Brown', 'nina.brown46@hotmail.com', '9774786574', 'Hooli', 'Director', '1976-04-04', 'Family', 'Test entry #46', '916 Cedar Ln.', NOW()),
  (1, 'Oliver Johnson', 'oliver.johnson47@hotmail.com', '3579667768', 'Cyberdyne', 'Consultant', '1975-12-18', 'Coworker', 'Test entry #47', '909 Washington Ave.', NOW()),
  (1, 'Tina Jackson', 'tina.jackson48@yahoo.com', '5584311620', 'Acme Corp', 'Manager', '1979-04-20', 'Family', 'Test entry #48', '586 Oak St.', NOW()),
  (1, 'Rachel Williams', 'rachel.williams49@yahoo.com', '0072423612', 'Cyberdyne', 'Coordinator', '1970-08-03', 'Family', 'Test entry #49', '824 Lakeview Dr.', NOW()),
  (1, 'Alice Anderson', 'alice.anderson50@yahoo.com', '5642758149', 'Cyberdyne', 'Analyst', '1982-08-07', 'Coworker', 'Test entry #50', '393 Sunset Blvd.', NOW());