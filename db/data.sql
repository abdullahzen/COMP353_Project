USE `SCC`;

/* ====================================================================*/
/* roles table dump 
  the roles are as follows:
   1 - System Adminstrator
   2 - Event manager
   3 - Controller
   4 - Participant (default user of website)
*/
INSERT INTO `SCC`.`roles` (name) VALUES ('system_admin');
INSERT INTO `SCC`.`roles` (name) VALUES ('event_manager');
INSERT INTO `SCC`.`roles` (name) VALUES ('controller');
INSERT INTO `SCC`.`roles` (name) VALUES ('participant');
/* ====================================================================*/


/* ====================================================================*/
/* users table dump and user_roles table dump 
   the roles are as follows:
   1 - System Adminstrator
   2 - Event manager
   3 - Controller
   4 - Participant (default user of website)

   Note: a user can have multiple roles.
*/

/* System admins */
INSERT INTO `SCC`.`users` (name, email, password, address, phone_number) VALUES ('Natalie Burnham', 'natalie.burnham@gmail.com', '123456', '3871 Jade St, West Vancouver, BC V7V 1Y8, Canada', 6049281578);
INSERT INTO `SCC`.`users` (name, email, password, address, phone_number) VALUES ('Grant Skinner', 'grant_skinner@hotmail.com', '123456', '255 rue des Eglises Est, Notre Dame Du Laus, QC J0X 2M0, Canada', 8197672165);
INSERT INTO `SCC`.`user_roles` (user_ID, role_ID) VALUES (1,1);
INSERT INTO `SCC`.`user_roles` (user_ID, role_ID) VALUES (2,1);

/* system admin, event manager and a participant */
INSERT INTO `SCC`.`users` (name, email, password, address, phone_number) VALUES ('Jenny Souder', 'jenny.souder@gmail.com', '123456', '3170 Tanner Street, Vancouver, BC V5R 2T4, Canada', 6044562865);
INSERT INTO `SCC`.`user_roles` (user_ID, role_ID) VALUES (3,1);
INSERT INTO `SCC`.`user_roles` (user_ID, role_ID) VALUES (3,2);
INSERT INTO `SCC`.`user_roles` (user_ID, role_ID) VALUES (3,4);

/* event manager, controller and a participant */
INSERT INTO `SCC`.`users` (name, email, password, address, phone_number) VALUES ('James Parrish', 'james.parrish@gmail.com' ,'123456', '4245 Galts Ave, Red Deer, AB T4N 2A6, Canada', 4035059447);
INSERT INTO `SCC`.`user_roles` (user_ID, role_ID) VALUES (4,2);
INSERT INTO `SCC`.`user_roles` (user_ID, role_ID) VALUES (4,3);
INSERT INTO `SCC`.`user_roles` (user_ID, role_ID) VALUES (4,4);

/* event managers and a participant */
INSERT INTO `SCC`.`users` (name, email, password, address, phone_number) VALUES ('Katherine Lawson', 'katherine.lawson@hotmal.com', '123456', '4917 Eglinton Avenue, Toronto, ON M4P 1A6, Canada', 4164826721);
INSERT INTO `SCC`.`user_roles` (user_ID, role_ID) VALUES (5,2);
INSERT INTO `SCC`.`user_roles` (user_ID, role_ID) VALUES (5,4);

/* event managers */
INSERT INTO `SCC`.`users` (name, email, password, address, phone_number) VALUES ('Leonard Pratt', 'leonard.p@gmail.com','123456', '155 avenue de Port-Royal, Bonnaventure, QC G0C 1E0, Canada', 4187528048);
INSERT INTO `SCC`.`users` (name, email, password, address, phone_number) VALUES ('Lawrence Porter', 'porter.lawrence@hotmail.com', '123456', '1179 Merton Street, Toronto, ON M1L 3K7, Canada', 4169385193);
INSERT INTO `SCC`.`user_roles` (user_ID, role_ID) VALUES (6,2);
INSERT INTO `SCC`.`user_roles` (user_ID, role_ID) VALUES (7,2);

/* controllers */
INSERT INTO `SCC`.`users` (name, email, password, address, phone_number) VALUES ('James Joe', 'james.joe@aol.com', '123456', '2393 Central Parkway, Malton, ON L5T 2B7, Canada', 9057951413);
INSERT INTO `SCC`.`users` (name, email, password, address, phone_number) VALUES ('Robert Pospisil', 'robert_p@yahoo.ca', '123456', '2215 MacLaren Street, Ottawa, ON K1P 5M7, Canada', 6132387113);
INSERT INTO `SCC`.`user_roles` (user_ID, role_ID) VALUES (8,3);
INSERT INTO `SCC`.`user_roles` (user_ID, role_ID) VALUES (9,3);

/* participants */
INSERT INTO `SCC`.`users` (name, email, password, address, phone_number) VALUES ('James Williams', 'jameswilliams@outlook.com', '123456', '3871 Jade St, West Vancouver, BC V7V 1Y8, Canada', 6049215788);
INSERT INTO `SCC`.`users` (name, email, password, address, phone_number) VALUES ('Alfred Salisbury', 'alfredsalis@hotmail.com', '123456', '4037 Papineau Avenue, Montreal, QC H2K 4J5, Canada', 5142961590);
INSERT INTO `SCC`.`users` (name, email, password, address, phone_number) VALUES ('Steven Hudson', 'stevie.hudson@outlook.com', '123456', '4442 chemin Hudson, Montreal, QC H4J 1M9, Canada', 5145889175);
INSERT INTO `SCC`.`users` (name, email, password, address, phone_number) VALUES ('Nancy Rummel', 'nancy.rummel@hotmail.com', '123456', '1009 James Street, St Catherines, ON L2R 3H6, Canada', 9056412070);
INSERT INTO `SCC`.`users` (name, email, password, address, phone_number) VALUES ('Anne Herring', 'anne.h@aol.com', '123456', '535 Eglinton Avenue, Toronto, ON M4P 1A6, Canada', 4163221977);
INSERT INTO `SCC`.`users` (name, email, password, address, phone_number) VALUES ('Anita Wilson', 'anita.w@yahoo.ca', '123456', '2063 Central-East Parkway, Missisauga, ON L5C 3T6, Canada', 9053610822);
INSERT INTO `SCC`.`users` (name, email, password, address, phone_number) VALUES ('Lucille Sira', 'lucille.sira@outlook.com', '123456', 'De la Providence Avenue, Gatineau, QC J8P 8A5, Canada', 471150417);
INSERT INTO `SCC`.`users` (name, email, password, address, phone_number) VALUES ('Sara Parada', 'sara.p@hotmail.com', '123456', '2170 Marie Street, Burlington, ON L7R 2G6, Canada', 9056314310);
INSERT INTO `SCC`.`users` (name, email, password, address, phone_number) VALUES ('Ela Lewis', 'ela.lewis@outlook.com', '123456', '1939 Bay Street, Toronto, ON M5J 2R8, Canada', 6478186713);
INSERT INTO `SCC`.`user_roles` (user_ID, role_ID) VALUES (10,4);
INSERT INTO `SCC`.`user_roles` (user_ID, role_ID) VALUES (11,4);
INSERT INTO `SCC`.`user_roles` (user_ID, role_ID) VALUES (12,4);
INSERT INTO `SCC`.`user_roles` (user_ID, role_ID) VALUES (13,4);
INSERT INTO `SCC`.`user_roles` (user_ID, role_ID) VALUES (14,4);
INSERT INTO `SCC`.`user_roles` (user_ID, role_ID) VALUES (15,4);
INSERT INTO `SCC`.`user_roles` (user_ID, role_ID) VALUES (16,4);
INSERT INTO `SCC`.`user_roles` (user_ID, role_ID) VALUES (17,4);
INSERT INTO `SCC`.`user_roles` (user_ID, role_ID) VALUES (18,4);
/* ====================================================================*/


/* ====================================================================*/
/* events table dump */
/* events that have groups associated to them */
INSERT INTO `SCC`.`events` (name, address, manager_ID, date, price) VALUES ('James Williams Birthday Party', '1608 Boulevard Cremazie, Quebec, QC G1R 1B8', 5, '2019-12-05', 30);
INSERT INTO `SCC`.`events` (name, address, manager_ID, date, price) VALUES ('Steve and Lina Wedding Party', '2144 Jade St, West Vancouver, BC V7V 1Y8', 4, '2020-02-01', 140);
INSERT INTO `SCC`.`events` (name, address, manager_ID, date, price) VALUES ('World Medical Conference 2019', '2412 No. 3 Road Richmond, BC V6X 2B8', 3, '2020-05-10', 500);
INSERT INTO `SCC`.`events` (name, address, manager_ID, date, price) VALUES ('Coding Workshop', '216 Sherbrooke Ouest,Montreal, QC H4A 1H3', 5, '2020-01-24', 15);
INSERT INTO `SCC`.`events` (name, address, manager_ID, date, price) VALUES ('Jana Birthday Party', '272 Boulevard Cremazie, Quebec, QC G1R 1B8', 6, '2020-01-05',30);
INSERT INTO `SCC`.`events` (name, address, manager_ID, date, price) VALUES ('Kayne and Jessica Engagement Party', '4253 Nelson Street, Manitouwadge, ON P0T 2C0', 7, '2020-06-24', 120);
INSERT INTO `SCC`.`events` (name, address, manager_ID, date, price) VALUES ('ITSolutions Corporation Farewell Party', '3989 rue des Églises Est, St Hippolyte, QC J0R 1P0', 6, '2020-03-01', 40);
INSERT INTO `SCC`.`events` (name, address, manager_ID, date, price) VALUES ('Veterans Memorial', '2965 Leslie Street, Newmarket, ON L3Y 2A3', 7, '2020-03-02', 50);
INSERT INTO `SCC`.`events` (name, address, manager_ID, date, price) VALUES ('John Graduation Party', '4499 Bayfield St, Oak Ridges, ON L4E 2Z8', 3, '2020-06-25', 100);
INSERT INTO `SCC`.`events` (name, address, manager_ID, date, price) VALUES ('ITSolutions Christmas Party', '956 Dominion St, Avonmore, ON K0C 1C0', 4, '2019-12-25', 110);
INSERT INTO `SCC`.`events` (name, address, manager_ID, date, price) VALUES ('Concordias Career Fair 2019', '1148 Robson St, Vancouver, BC V6B 3K9', 4, '2020-04-29', 40);
/* events without any groups associated to them */
INSERT INTO `SCC`.`events` (name, address, manager_ID, date, price) VALUES ('Build Your CV Event', '4264 Papineau Avenue, Montreal, QC H2K 4J5', 6, '2020-03-13', 15);
/* ====================================================================*/


/* ====================================================================*/
/* groups table data dump */
/* groups associated to events */
INSERT INTO `SCC`.`groups` (name, manager_ID) VALUES ('James Williams Birthday Party', 5);
INSERT INTO `SCC`.`groups` (name, manager_ID) VALUES ('Steve and Lina Wedding Party', 4);
INSERT INTO `SCC`.`groups` (name, manager_ID) VALUES ('World Medical Conference 2019', 3);
INSERT INTO `SCC`.`groups` (name, manager_ID) VALUES ('Coding Workshop', 5);
INSERT INTO `SCC`.`groups` (name, manager_ID) VALUES ('Jana Birthday Party', 6);
INSERT INTO `SCC`.`groups` (name, manager_ID) VALUES ('Kayne and Jessica Engagement Party', 7);
INSERT INTO `SCC`.`groups` (name, manager_ID) VALUES ('ITSolutions Corporation Farewell Party', 6);
INSERT INTO `SCC`.`groups` (name, manager_ID) VALUES ('Veterans Memorial', 7);
INSERT INTO `SCC`.`groups` (name, manager_ID) VALUES ('John Graduation Party', 3);
INSERT INTO `SCC`.`groups` (name, manager_ID) VALUES ('ITSolutions Christmas Party', 4);
INSERT INTO `SCC`.`groups` (name, manager_ID) VALUES ('Concordias Career Fair 2019', 4);

/* general groups created by users */
INSERT INTO `SCC`.`groups` (name, manager_ID) VALUES ('Johnny Surprise Party', 10);
INSERT INTO `SCC`.`groups` (name, manager_ID) VALUES ('COMP353 Group', 11);
INSERT INTO `SCC`.`groups` (name, manager_ID) VALUES ('Business Events Sharing', 13);
INSERT INTO `SCC`.`groups` (name, manager_ID) VALUES ('Stocks and the market group', 14);
INSERT INTO `SCC`.`groups` (name, manager_ID) VALUES ('Coding help group', 18);
/* ====================================================================*/


/* ====================================================================*/
/* event_group table data dump */
INSERT INTO `SCC`.`event_group` (event_ID, group_ID) VALUES (1, 1);
INSERT INTO `SCC`.`event_group` (event_ID, group_ID) VALUES (2, 2);
INSERT INTO `SCC`.`event_group` (event_ID, group_ID) VALUES (3, 3);
INSERT INTO `SCC`.`event_group` (event_ID, group_ID) VALUES (4, 4);
INSERT INTO `SCC`.`event_group` (event_ID, group_ID) VALUES (5, 5);
INSERT INTO `SCC`.`event_group` (event_ID, group_ID) VALUES (6, 6);
INSERT INTO `SCC`.`event_group` (event_ID, group_ID) VALUES (7, 7);
INSERT INTO `SCC`.`event_group` (event_ID, group_ID) VALUES (8, 8);
INSERT INTO `SCC`.`event_group` (event_ID, group_ID) VALUES (9, 9);
INSERT INTO `SCC`.`event_group` (event_ID, group_ID) VALUES (10, 10);
INSERT INTO `SCC`.`event_group` (event_ID, group_ID) VALUES (11, 11);
/* ====================================================================*/


/* ====================================================================*/
/* organizations table data dump */
INSERT INTO `SCC`.`organizations` (name, type) VALUES ('Concordia University', 'non-profit');
INSERT INTO `SCC`.`organizations` (name, type) VALUES ('ITSolutions', 'private');
INSERT INTO `SCC`.`organizations` (name, type) VALUES ('Birthday party', 'family');
INSERT INTO `SCC`.`organizations` (name, type) VALUES ('Wedding', 'personal');
INSERT INTO `SCC`.`organizations` (name, type) VALUES ('Engagement party', 'personal');
INSERT INTO `SCC`.`organizations` (name, type) VALUES ('Workshop', 'non-profit');
INSERT INTO `SCC`.`organizations` (name, type) VALUES ('Government', 'public');
INSERT INTO `SCC`.`organizations` (name, type) VALUES ('Party', 'personal');
/* ====================================================================*/


/* ====================================================================*/
/* event_organization_participants table data dump */
INSERT INTO `SCC`.`event_organization_participants` (event_ID, organization_ID, user_ID) VALUES (1, 3, 4);
INSERT INTO `SCC`.`event_organization_participants` (event_ID, organization_ID, user_ID) VALUES (1, 3, 10);
INSERT INTO `SCC`.`event_organization_participants` (event_ID, organization_ID, user_ID) VALUES (1, 3, 11);
INSERT INTO `SCC`.`event_organization_participants` (event_ID, organization_ID, user_ID) VALUES (2, 4, 12);
INSERT INTO `SCC`.`event_organization_participants` (event_ID, organization_ID, user_ID) VALUES (2, 4, 13);
INSERT INTO `SCC`.`event_organization_participants` (event_ID, organization_ID, user_ID) VALUES (2, 4, 5);
INSERT INTO `SCC`.`event_organization_participants` (event_ID, organization_ID, user_ID) VALUES (2, 4, 3);
INSERT INTO `SCC`.`event_organization_participants` (event_ID, organization_ID, user_ID) VALUES (3, 7, 14);
INSERT INTO `SCC`.`event_organization_participants` (event_ID, organization_ID, user_ID) VALUES (3, 7, 15);
INSERT INTO `SCC`.`event_organization_participants` (event_ID, organization_ID, user_ID) VALUES (4, 6, 16);
INSERT INTO `SCC`.`event_organization_participants` (event_ID, organization_ID, user_ID) VALUES (4, 6, 17);
INSERT INTO `SCC`.`event_organization_participants` (event_ID, organization_ID, user_ID) VALUES (4, 6, 18);
INSERT INTO `SCC`.`event_organization_participants` (event_ID, organization_ID, user_ID) VALUES (5, 3, 10);
INSERT INTO `SCC`.`event_organization_participants` (event_ID, organization_ID, user_ID) VALUES (5, 3, 11);
INSERT INTO `SCC`.`event_organization_participants` (event_ID, organization_ID, user_ID) VALUES (5, 3, 12);
INSERT INTO `SCC`.`event_organization_participants` (event_ID, organization_ID, user_ID) VALUES (6, 5, 13);
INSERT INTO `SCC`.`event_organization_participants` (event_ID, organization_ID, user_ID) VALUES (6, 5, 14);
INSERT INTO `SCC`.`event_organization_participants` (event_ID, organization_ID, user_ID) VALUES (6, 5, 15);
INSERT INTO `SCC`.`event_organization_participants` (event_ID, organization_ID, user_ID) VALUES (7, 2, 16);
INSERT INTO `SCC`.`event_organization_participants` (event_ID, organization_ID, user_ID) VALUES (7, 2, 17);
INSERT INTO `SCC`.`event_organization_participants` (event_ID, organization_ID, user_ID) VALUES (7, 2, 3);
INSERT INTO `SCC`.`event_organization_participants` (event_ID, organization_ID, user_ID) VALUES (8, 7, 4);
INSERT INTO `SCC`.`event_organization_participants` (event_ID, organization_ID, user_ID) VALUES (8, 7, 5);
INSERT INTO `SCC`.`event_organization_participants` (event_ID, organization_ID, user_ID) VALUES (9, 8, 18);
INSERT INTO `SCC`.`event_organization_participants` (event_ID, organization_ID, user_ID) VALUES (9, 8, 10);
INSERT INTO `SCC`.`event_organization_participants` (event_ID, organization_ID, user_ID) VALUES (9, 8, 11);
INSERT INTO `SCC`.`event_organization_participants` (event_ID, organization_ID, user_ID) VALUES (10, 2, 12);
INSERT INTO `SCC`.`event_organization_participants` (event_ID, organization_ID, user_ID) VALUES (10, 2, 13);
INSERT INTO `SCC`.`event_organization_participants` (event_ID, organization_ID, user_ID) VALUES (10, 2, 14);
INSERT INTO `SCC`.`event_organization_participants` (event_ID, organization_ID, user_ID) VALUES (10, 2, 15);
INSERT INTO `SCC`.`event_organization_participants` (event_ID, organization_ID, user_ID) VALUES (11, 1, 16);
INSERT INTO `SCC`.`event_organization_participants` (event_ID, organization_ID, user_ID) VALUES (11, 1, 17);
INSERT INTO `SCC`.`event_organization_participants` (event_ID, organization_ID, user_ID) VALUES (12, 1, 18);
INSERT INTO `SCC`.`event_organization_participants` (event_ID, organization_ID, user_ID) VALUES (12, 1, 5);
INSERT INTO `SCC`.`event_organization_participants` (event_ID, organization_ID, user_ID) VALUES (12, 1, 3);
/* ====================================================================*/


/* ====================================================================*/
/* group_members table data dump */
INSERT INTO `SCC`.`group_members` (group_ID, user_ID) VALUES (1, 4);
INSERT INTO `SCC`.`group_members` (group_ID, user_ID) VALUES (1, 10);
INSERT INTO `SCC`.`group_members` (group_ID, user_ID) VALUES (1, 11);
INSERT INTO `SCC`.`group_members` (group_ID, user_ID) VALUES (2, 12);
INSERT INTO `SCC`.`group_members` (group_ID, user_ID) VALUES (2, 13);
INSERT INTO `SCC`.`group_members` (group_ID, user_ID) VALUES (2, 5);
INSERT INTO `SCC`.`group_members` (group_ID, user_ID) VALUES (2, 3);
INSERT INTO `SCC`.`group_members` (group_ID, user_ID) VALUES (3, 14);
INSERT INTO `SCC`.`group_members` (group_ID, user_ID) VALUES (3, 15);
INSERT INTO `SCC`.`group_members` (group_ID, user_ID) VALUES (4, 16);
INSERT INTO `SCC`.`group_members` (group_ID, user_ID) VALUES (4, 17);
INSERT INTO `SCC`.`group_members` (group_ID, user_ID) VALUES (4, 18);
INSERT INTO `SCC`.`group_members` (group_ID, user_ID) VALUES (5, 10);
INSERT INTO `SCC`.`group_members` (group_ID, user_ID) VALUES (5, 11);
INSERT INTO `SCC`.`group_members` (group_ID, user_ID) VALUES (5, 12);
INSERT INTO `SCC`.`group_members` (group_ID, user_ID) VALUES (6, 13);
INSERT INTO `SCC`.`group_members` (group_ID, user_ID) VALUES (6, 14);
INSERT INTO `SCC`.`group_members` (group_ID, user_ID) VALUES (6, 15);
INSERT INTO `SCC`.`group_members` (group_ID, user_ID) VALUES (7, 16);
INSERT INTO `SCC`.`group_members` (group_ID, user_ID) VALUES (7, 17);
INSERT INTO `SCC`.`group_members` (group_ID, user_ID) VALUES (7, 3);
INSERT INTO `SCC`.`group_members` (group_ID, user_ID) VALUES (8, 4);
INSERT INTO `SCC`.`group_members` (group_ID, user_ID) VALUES (8, 5);
INSERT INTO `SCC`.`group_members` (group_ID, user_ID) VALUES (9, 18);
INSERT INTO `SCC`.`group_members` (group_ID, user_ID) VALUES (9, 10);
INSERT INTO `SCC`.`group_members` (group_ID, user_ID) VALUES (9, 11);
INSERT INTO `SCC`.`group_members` (group_ID, user_ID) VALUES (10, 12);
INSERT INTO `SCC`.`group_members` (group_ID, user_ID) VALUES (10, 13);
INSERT INTO `SCC`.`group_members` (group_ID, user_ID) VALUES (10, 14);
INSERT INTO `SCC`.`group_members` (group_ID, user_ID) VALUES (10, 15);
INSERT INTO `SCC`.`group_members` (group_ID, user_ID) VALUES (11, 16);
INSERT INTO `SCC`.`group_members` (group_ID, user_ID) VALUES (11, 17);

INSERT INTO `SCC`.`group_members` (group_ID, user_ID) VALUES (12, 16);
INSERT INTO `SCC`.`group_members` (group_ID, user_ID) VALUES (12, 17);
INSERT INTO `SCC`.`group_members` (group_ID, user_ID) VALUES (12, 18);
INSERT INTO `SCC`.`group_members` (group_ID, user_ID) VALUES (13, 12);
INSERT INTO `SCC`.`group_members` (group_ID, user_ID) VALUES (13, 3);
INSERT INTO `SCC`.`group_members` (group_ID, user_ID) VALUES (13, 13);
INSERT INTO `SCC`.`group_members` (group_ID, user_ID) VALUES (14, 11);
INSERT INTO `SCC`.`group_members` (group_ID, user_ID) VALUES (14, 10);
INSERT INTO `SCC`.`group_members` (group_ID, user_ID) VALUES (14, 18);
INSERT INTO `SCC`.`group_members` (group_ID, user_ID) VALUES (15, 16);
INSERT INTO `SCC`.`group_members` (group_ID, user_ID) VALUES (15, 17);
INSERT INTO `SCC`.`group_members` (group_ID, user_ID) VALUES (16, 12);
INSERT INTO `SCC`.`group_members` (group_ID, user_ID) VALUES (16, 14);
/* ====================================================================*/


/* ====================================================================*/
/* posts table data dump */
INSERT INTO `SCC`.`posts` (title, text, media) VALUES ('Post 1', 'Post 1 text', NULL);
INSERT INTO `SCC`.`posts` (title, text, media) VALUES ('Post 2', 'Post 2 text', NULL);
INSERT INTO `SCC`.`posts` (title, text, media) VALUES ('Post 3', 'Post 3 text', NULL);
INSERT INTO `SCC`.`posts` (title, text, media) VALUES ('Post 4', 'Post 4 text', NULL);
INSERT INTO `SCC`.`posts` (title, text, media) VALUES ('Post 5', 'Post 5 text', NULL);
INSERT INTO `SCC`.`posts` (title, text, media) VALUES ('Post 6', 'Post 6 text', NULL);
INSERT INTO `SCC`.`posts` (title, text, media) VALUES ('Post 7', 'Post 7 text', NULL);
INSERT INTO `SCC`.`posts` (title, text, media) VALUES ('Post 8', 'Post 8 text', NULL);
INSERT INTO `SCC`.`posts` (title, text, media) VALUES ('Post 9', 'Post 9 text', NULL);
INSERT INTO `SCC`.`posts` (title, text, media) VALUES ('Post 10', 'Post 10 text', NULL);
INSERT INTO `SCC`.`posts` (title, text, media) VALUES ('Post 11', 'Post 11 text', NULL); 
INSERT INTO `SCC`.`posts` (title, text, media) VALUES ('Post 12', 'Post 12 text', NULL);
INSERT INTO `SCC`.`posts` (title, text, media) VALUES ('Post 13', 'Post 13 text', NULL); 
INSERT INTO `SCC`.`posts` (title, text, media) VALUES ('Post 14', 'Post 14 text', NULL); 
INSERT INTO `SCC`.`posts` (title, text, media) VALUES ('Post 15', 'Post 15 text', NULL); 
INSERT INTO `SCC`.`posts` (title, text, media) VALUES ('Post 16', 'Post 16 text', NULL);
INSERT INTO `SCC`.`posts` (title, text, media) VALUES ('Post 17', 'Post 17 text', NULL); 
INSERT INTO `SCC`.`posts` (title, text, media) VALUES ('Post 18', 'Post 18 text', NULL); 
/* ====================================================================*/


/* ====================================================================*/
/* group_posts table data dump 

   Note: groups have posts and events have posts through the groups associated to them.
*/

INSERT INTO `SCC`.`group_posts` (group_ID, post_ID) VALUES (1 ,1); 
INSERT INTO `SCC`.`group_posts` (group_ID, post_ID) VALUES (2 ,2); 
INSERT INTO `SCC`.`group_posts` (group_ID, post_ID) VALUES (3 ,3); 
INSERT INTO `SCC`.`group_posts` (group_ID, post_ID) VALUES (4 ,4); 
INSERT INTO `SCC`.`group_posts` (group_ID, post_ID) VALUES (5 ,5); 
INSERT INTO `SCC`.`group_posts` (group_ID, post_ID) VALUES (6 ,6); 
INSERT INTO `SCC`.`group_posts` (group_ID, post_ID) VALUES (7 ,7); 
INSERT INTO `SCC`.`group_posts` (group_ID, post_ID) VALUES (8 ,8);
INSERT INTO `SCC`.`group_posts` (group_ID, post_ID) VALUES (9 ,9); 
INSERT INTO `SCC`.`group_posts` (group_ID, post_ID) VALUES (10 ,10);
INSERT INTO `SCC`.`group_posts` (group_ID, post_ID) VALUES (11 ,11); 
INSERT INTO `SCC`.`group_posts` (group_ID, post_ID) VALUES (12 ,12);
INSERT INTO `SCC`.`group_posts` (group_ID, post_ID) VALUES (13 ,13); 
INSERT INTO `SCC`.`group_posts` (group_ID, post_ID) VALUES (14 ,14); 
INSERT INTO `SCC`.`group_posts` (group_ID, post_ID) VALUES (15 ,15); 
INSERT INTO `SCC`.`group_posts` (group_ID, post_ID) VALUES (16 ,16);
INSERT INTO `SCC`.`group_posts` (group_ID, post_ID) VALUES (1 ,17); 
INSERT INTO `SCC`.`group_posts` (group_ID, post_ID) VALUES (2 ,18); 
/* ====================================================================*/


/* ====================================================================*/
/* post_comments table data dump */
INSERT INTO `SCC`.`post_comments` (post_ID, comment) VALUES (6, 'Hello');
INSERT INTO `SCC`.`post_comments` (post_ID, comment) VALUES (7, 'I like this post');
INSERT INTO `SCC`.`post_comments` (post_ID, comment) VALUES (11, 'I want to share this post');
INSERT INTO `SCC`.`post_comments` (post_ID, comment) VALUES (10, 'Please keep updating this post');
INSERT INTO `SCC`.`post_comments` (post_ID, comment) VALUES (14, 'Can you change the title of the post?');
INSERT INTO `SCC`.`post_comments` (post_ID, comment) VALUES (1, 'This event is really nice.');
INSERT INTO `SCC`.`post_comments` (post_ID, comment) VALUES (2, 'Looking forward for this event.');
INSERT INTO `SCC`.`post_comments` (post_ID, comment) VALUES (3, "Can't wait until the event time.");
INSERT INTO `SCC`.`post_comments` (post_ID, comment) VALUES (4, 'Can we change the location for the event?');
INSERT INTO `SCC`.`post_comments` (post_ID, comment) VALUES (5, 'I like this post');
INSERT INTO `SCC`.`post_comments` (post_ID, comment) VALUES (8, 'I want to share this post');
INSERT INTO `SCC`.`post_comments` (post_ID, comment) VALUES (5, 'I like this post');
INSERT INTO `SCC`.`post_comments` (post_ID, comment) VALUES (9, 'I want to share this post');
INSERT INTO `SCC`.`post_comments` (post_ID, comment) VALUES (12, 'I like this post');
INSERT INTO `SCC`.`post_comments` (post_ID, comment) VALUES (13, 'I want to share this post');
INSERT INTO `SCC`.`post_comments` (post_ID, comment) VALUES (15, 'I like this post');
INSERT INTO `SCC`.`post_comments` (post_ID, comment) VALUES (16, 'I want to share this post');
/* ====================================================================*/


/* ====================================================================*/
/* messages table data dump */
INSERT INTO `SCC`.`messages` (sender_ID, receiver_ID, text) VALUES (1, 2, 'Hello! Can you answer me?');
INSERT INTO `SCC`.`messages` (sender_ID, receiver_ID, text) VALUES (2, 1, 'Yes I can answer you.');
INSERT INTO `SCC`.`messages` (sender_ID, receiver_ID, text) VALUES (10, 4, 'Hello! Can we change the event location to be closer to me?');
INSERT INTO `SCC`.`messages` (sender_ID, receiver_ID, text) VALUES (4, 10, 'Sure thing, I will verify with the rest of the participants.');
INSERT INTO `SCC`.`messages` (sender_ID, receiver_ID, text) VALUES (10, 4, 'Thank you for your help.');
INSERT INTO `SCC`.`messages` (sender_ID, receiver_ID, text) VALUES (12, 13, 'Hey, lets throw a party for our friend Jim');
INSERT INTO `SCC`.`messages` (sender_ID, receiver_ID, text) VALUES (13, 12, 'Sure, when and where?');
INSERT INTO `SCC`.`messages` (sender_ID, receiver_ID, text) VALUES (12, 13, 'My place and next week.');
INSERT INTO `SCC`.`messages` (sender_ID, receiver_ID, text) VALUES (13, 12, 'I am super down! looking forward to it');
/* ====================================================================*/


/* ====================================================================*/
/* bank_information table data dump */
INSERT INTO `SCC`.`bank_information` (cardholder_name, address, card_number, expiration_date) VALUES ('Jenny Soder', '20 Fairway Drive', 4700252169583285,'2023-04-01');
INSERT INTO `SCC`.`bank_information` (cardholder_name, address, card_number, expiration_date) VALUES ('James Parrish', '110 Atlantic Avenue', 4569989104519623, '2024-02-01');
INSERT INTO `SCC`.`bank_information` (cardholder_name, address, card_number, expiration_date) VALUES ('Katherine Lawson', '108 Willow Avenue', 4781062638349156, '2020-10-01');
INSERT INTO `SCC`.`bank_information` (cardholder_name, address, card_number, expiration_date) VALUES ('Leonard Pratt', '155 avenue de Port-Royal', 4637788657077486, '2030-02-01');
INSERT INTO `SCC`.`bank_information` (cardholder_name, address, card_number, expiration_date) VALUES ('Lawrence Porter', '1179 Merton Street', 4398257159217528, '2023-07-01');
/* ====================================================================*/


/* ====================================================================*/
/* user_bank_information table data dump */
INSERT INTO `SCC`.`user_bank_information` (user_ID, bank_information_ID) VALUES (3, 1);
INSERT INTO `SCC`.`user_bank_information` (user_ID, bank_information_ID) VALUES (4, 2);
INSERT INTO `SCC`.`user_bank_information` (user_ID, bank_information_ID) VALUES (5, 3);
INSERT INTO `SCC`.`user_bank_information` (user_ID, bank_information_ID) VALUES (6, 4);
INSERT INTO `SCC`.`user_bank_information` (user_ID, bank_information_ID) VALUES (7, 5);
/* ====================================================================*/