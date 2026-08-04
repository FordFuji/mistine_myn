<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class Model_ford_datatable extends CI_Model { 
 	
 	private $column_order = array('ford_id', 'ford_image', 'ford_name', 'ford_ckeditor', 'ford_id'); //set column field database for datatable orderable
    private $column_search = array('ford_id', 'ford_image', 'ford_name', 'ford_ckeditor', 'ford_id'); //set column field database for datatable searchable 
    private $order = array('ford_id' => 'asc'); // default order
    
    private $result_table;
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
 
 	// datatable
 	// เขียน Query 2 ที่ นี่ที่แรก
    private function _get_datatables_query() {
        $this->db->from('ci_ford');
 		
        $i = 0;
        foreach($this->column_search as $item) {
        	if($_POST['search']['value']) { 
                if($i===0) {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            
            if(!empty($_POST['columns'][$i]['search']['value'])) {
				$this->db->where($item, $_POST['columns'][$i]['search']['value']);
			}
            $i++;
        }
         
        if(isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if(isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables() {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered() {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
 	// เขียน Query 2 ที่ นี่ที่ที่สอง
    public function count_all() {
        $this->db->from('ci_ford');
        return $this->db->count_all_results();
    }
	// end datatable
}
?>