<?php
/**
 * Mdeliver_address.php
 * ==============================================
 * Copy right 2017 http://www.texmall.com
 * ==============================================
 * @author: zoudong
 * @date: 2017年6月13日
 */
class Mdeliver_address extends CI_Model{
	private $table = 'deliver_address';        
	
	/**
	 * @获取总条数
	 * */
	public function total($search)
	{
	    $this->db->select('id');
	    $this->db->from($this->table);
	    if (!empty($search['item'])) {
	        $this->db->group_start();
	        $this->db->like('province_name', $search['item']);
	        $this->db->or_like('city_name', $search['item']);
	        $this->db->or_like('district_name', $search['item']);
	        $this->db->or_like('ads_des', $search['item']);
	        $this->db->or_like('receiver_name', $search['item']);
	        $this->db->or_like('tel', $search['item']);
	        $this->db->group_end();
	    }
	    return $this->db->count_all_results();
	}
	
	/**
	 * @分页
	 * @param number $page:页码
	 * @param number $perpage:每页数量
	 * @param array $search:查找条件
	 * @param string $order:排序
	 * */
	public function grid($page, $perpage, $search, $order='id desc')  
	{
	    $this->db->select('*');
	    $this->db->from($this->table);
	    if (!empty($search['item'])) {
	        $this->db->group_start();
	        $this->db->like('province_name', $search['item']);
	        $this->db->or_like('city_name', $search['item']);
	        $this->db->or_like('district_name', $search['item']);
	        $this->db->or_like('ads_des', $search['item']);
	        $this->db->or_like('receiver_name', $search['item']);
	        $this->db->or_like('tel', $search['item']);
	        $this->db->group_end();
	    }
	    $this->db->order_by($order);
	    if ($perpage) $this->db->limit($perpage, $perpage*$page);
	    return $this->db->get();
	}
	
	
	
	
}

/** End of file Mdeliver_address.php */
/** Location: ./application/models/Mdeliver_address.php */