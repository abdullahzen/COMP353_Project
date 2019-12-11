<!-- 
- P2 - Project 2
- Group 15
- Team Member, Student IDs, and Emails:
    Abdulla ALHAJ ZIN, 40013496, email: a_alhajz@encs.concordia.ca

    Kevin LIN, 40002383, email: k_in@encs.concordia.ca

    Nour EL NATOUR,40013102, email: n_elnato@encs.concordia.ca

    Omnia GOMAA, 40017116 , email: o_gomaa@encs.concordia.ca
-->

<?php

if($_COOKIE['email'] !== null && $_COOKIE['name'] !== null && $_COOKIE['time'] !== null) {
    header("location: role-list.php");
} else {
    header("location: public/sign-in.php");
}
