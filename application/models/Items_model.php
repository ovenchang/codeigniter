<?php
class Items_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        
        public function get_items($id = FALSE)
        {
                if ($id === FALSE)
                {
                        $query = $this->db->get('items');
                        return $query->result_array();
                }

                $query = $this->db->get_where('items', array('id' => $id));
                return $query->row_array();
        }
        public function set_items(){
                $this->load->helper('url');
                $desc = url_title($this->input->post('title'), 'dash', TRUE);

                $data = array(
                        'title' => $this->input->post('title'),
                        'desc' => $desc,
                        'text' => $this->input->post('text')
                );

                return $this->db->insert('items', $data); 
        }
}