<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crop_disease_model extends CI_Model {

    var $table = 'crop_disease';
    var $column_order = array('crop_id','disease_name'); //set column field database for datatable orderable
    var $column_search = array('crop_id','disease_name'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('dis_id' => 'desc'); // default order

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {

        $this->db->from($this->table);

        $i = 0;

        foreach ($this->column_search as $item) // loop column
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {

                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function select_table($table,$select,$order)
    {
        $this -> db -> select($select);
        $this -> db -> from($table);
        $this->db->order_by($order, "desc");
        $query = $this->db->get();
        return $query->result();
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('crop_id',$id);
        $query = $this->db->get();

        return $query->row();
    }

    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_by_id($id)
    {
        $this->db->where('crop_id', $id);
        $this->db->delete($this->table);
    }

    function select_table_join($table,$table2,$select,$wheretable1,$wheretable2,$order)
    {
        $this -> db -> select($select);
        $this -> db -> from($table);
        $this->db->join($table2, $table2.'.'.$wheretable2.'='.$table.'.'.$wheretable1.'', 'left');
        $this->db->order_by($table.".".$order, "desc");
        $query = $this->db->get();
        return $query->result();
    }


}
