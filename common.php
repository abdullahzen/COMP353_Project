<!--Team Member and their IDs:
Abdulla Alhaj Zin, 40013496, email: a_alhajz@encs.concordia.ca

Lin Kevin, 40002383, email: k_in@encs.concordia.ca

Nour El Natour,40013102, email: n_elnato@encs.concordia.ca

Omnia Gomaa, 40017116 , email: o_gomaa@encs.concordia.ca-->

<?php

/**
 * Escapes HTML for output
 *
 */

function escape($html) {
    return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
}