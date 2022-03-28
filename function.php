<?php 
function count_data($tarif) {
    return $this->ci->db->get($tarif)->num_rows();
}

function count_data($Customer) {
    return $this->ci->db->get($Customer)->num_rows();
}

function count_data($User) {
    return $this->ci->db->get($Users)->num_rows();
}

?>