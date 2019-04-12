<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Data_customer_model extends CI_Model
{

    public $table = 'data_customer';
    public $id = 'id_customer';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('id_customer,nama_customer,alamat_customer,tanggal_lahir_customer,email_customer,no_telpon_customer');
        $this->datatables->from('data_customer');
        //add this line for join
        //$this->datatables->join('table2', 'data_customer.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('data_customer/read/$1'),'<i class="fa fa-eye" style="margin-right:5px;color:black;"></i>')." ".anchor(site_url('data_customer/delete/$1'),'<i class="fa fa-eraser" style="margin-right:5px;color:black;"></i>','onclick="javasciprt: return confirm(\'Anda Yakin?\')"'), 'id_customer');
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_customer', $q);
	$this->db->or_like('nama_customer', $q);
	$this->db->or_like('alamat_customer', $q);
	$this->db->or_like('tanggal_lahir_customer', $q);
	$this->db->or_like('email_customer', $q);
	$this->db->or_like('no_telpon_customer', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_customer', $q);
	$this->db->or_like('nama_customer', $q);
	$this->db->or_like('alamat_customer', $q);
	$this->db->or_like('tanggal_lahir_customer', $q);
	$this->db->or_like('email_customer', $q);
	$this->db->or_like('no_telpon_customer', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
    function count()
    {
        $query = $this->db->get('data_customer');
        if($query->num_rows() > 0){
            return $query->num_rows();
        }else{
            return 0;
        }
    }

}