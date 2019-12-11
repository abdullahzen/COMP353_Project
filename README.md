# COMP353_Project

=======================================================================================================
=======================================================================================================

The following document contains the following sections in the order mentioned respectively:
- Group Information.
- Instalation instructions.
- Existing User Accounts with different roles and permissions that can be used to test the website.
- Changes made since the demo.
- List of files submitted
 
=======================================================================================================
=======================================================================================================

 ---------------------------------------------
 Group ID:COMP 353_group_15
 ---------------------------------------------
 Deployed project: https://orc353.encs.concordia.ca/

 Account for the deployed website: (Note that triggers are not working on AITS, because they require SUPER priveleges. However, running it locally does not have any issue with triggers.)

 Group Account: orc353_2
 
 Password: H8Y95r 
 
 Student Names and IDs:
 ----------------------
 
    Abdulla ALHAJ ZIN, 40013496, email: a_alhajz@encs.concordia.ca (Leader)


    Kevin LIN, 40002383, email: k_in@encs.concordia.ca


    Nour EL NATOUR,40013102, email: n_elnato@encs.concordia.ca


    Omnia GOMAA, 40017116 , email: o_gomaa@encs.concordia.ca


=======================================================================================================
=======================================================================================================
How to install and run the project locally from a clean installation?
--------------------------------------------------------------------
1- Make sure you have the following prerequisites installed on your PC before proceeding to the next steps:


2- 


3- 



=======================================================================================================
=======================================================================================================
Existing Registered Users on the system that can be used for testing the functionality of the system.

NOTE: (make sure to not add spaces to either the email of the password of these users)


Sign in as an event manager: (This user has many roles assigned: Admin, Event Manager, and Event Participant)
----------------------------
email: jenny.souder@gmail.com, passowrd: 12356


Sign in as an admin:
--------------------
email: natalie.burnham@gmail.com, password: 123456
email: grant_skinner@hotmail.com, password: 123456


Sign in as a Participant:
-------------------------
email: nancy.rummel@hotmail.com,
password: 123456


Sign in as a Controller:
-------------------------
email: robert_p@yahoo.ca,
password: 123456


=======================================================================================================
=======================================================================================================
Changes made since the demo:
-----------------------------
1- Added View All Groups Page
  - Including badges that identifies important information.
  - Any user can create a group.

2- Added View All events Page.
  - Including badges that identifies important information.

3- Added View Single Event Page.
  - This shows different views now for different roles. 
  - I.E: Event managers have the ability to create new users for the event, or add existing ones from the system.
  - Include posts, groups, participants, and other information related to the event. 
  - Only accessible by the event manager and event participants.

4- Added View Single Group Page.
  - This shows different views now for different roles. 
  - Include posts, associated events (if any), members, and any other information related to the group. 
  - Only accessible by the group manager and group members.

5- Added the functionality for users to send a request to join a group that has to be approved by the group manager before they become members.

6- Added Personal Profile Page (managing all personal data can be done on that page)
         + Public profile page.

7- Added Bank Info Page (Managing user credit card info for both admin and user)

8- Added google analytics 

9- Added customized header for each user role

10- Added a Role-list page where the user identifies what role they would like to view the website as from their given roles by the system or the admins.

11- Added ability to make a new Post on:
  - Any event page that you're a participant or a manager of.
  - Any group page that you're a member or a manager of.
  - Any group you're a member of even if it is associated to an event, and only group members see those posts, i.e if a person is an event participant but not a member of this associated group, that person won't be able to see the group posts. The person would only be able to see the posts of the event they're participating in, in that specific edge case.

12- Added ability to comment on:
  - Any post on the website.

13- Added Ability to delete post/comment if you are:
  - Owner of the post or comment
  - Group manager/ event manager depending on where the post/comment are.

14- Added messaging (chatting) system between all users of the website regardless of their roles.

15- Updated database tables + E-R diagrams in report

16- Updated most section of the report to match changes made.


=======================================================================================================
=======================================================================================================
List of Files included in the submission:
------------------------------------------

- App
    - Operations
        - auth.php 
        - commentsCrud.php 
        - crud.php
        - eventsCrud.php
        - groupsCrud.php
        - helper.php
        - postsCrud.php
        - sendMessage.php
- db
    - data.sql
    - data_server_notriggers.sql
    - schema.sql
- public
    - css
       - style.css
    - bank_information.php
    - bootstrap.php
    - create.php
    - event.php
    - events.php
    - group.php
    - groups.php
    - header.php
    - home.php
    - index.php
    - logout.php
    - message.php
    - messages.php
    - read.php
    - role-list.php
    - sign-in.php
    - sign-up.php
    - update.php
    - user.php
- .gitignore
- LICENSE
- README.md
- common.php
- config.php
- index.php
- install.php

