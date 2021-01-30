<?php 
class Dashboard_model extends CI_Model{
    public function getCountTrx()
    {
		$query = $this->db->query('SELECT * FROM transactions');
		return $query->num_rows();
    }
    public function getCountCategory()
    {
		$query = $this->db->query('SELECT * FROM categories');
		return $query->num_rows();
    }
    public function getCountProduct()
    {
		$query = $this->db->query('SELECT * FROM products');
		return $query->num_rows();
    }
    // hitung total data pada user
    public function getCountUser()
    {
		$query = $this->db->query('SELECT * FROM users');
		return $query->num_rows();
    }

}
?>
