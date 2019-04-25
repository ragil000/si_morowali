
<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
 
class Import extends CI_Model {
    // get employee list
    public function employeeList() {
        $this->db->select(array('e.id', 'e.first_name', 'e.last_name', 'e.email', 'e.dob', 'e.contact_no'));
        $this->db->from('import as e');
        $query = $this->db->get();
        return $query->result_array();
    }
}
?>