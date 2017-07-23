<?php
/**
 * Mdistrict.php
 * ==============================================
 * Copy right 2017 http://www.texmall.com
 * ==============================================
 * @author: zoudong
 * @date: 2017年6月13日
 */
class Mdistrict extends CI_Model{
	private $table = 'district';        
	
	/**
	 * @获取省份
	 * */
	public function grid($pid = 0)
	{
	    $this->db->where('pid', $pid);
	    return $this->db->get($this->table)->result();
	}
	
	/**
	 * @获取地址
	 * */
	public function get_address($p_id, $c_id, $d_id)
	{
	    $this->db->where_in('id', array($p_id, $c_id, $d_id));
	    return array_column($this->db->get($this->table)->result(), 'district_name', 'id');
	}
	
	
	
	
}

/** End of file Mdistrict.php */
/** Location: ./application/models/Mdistrict.php */