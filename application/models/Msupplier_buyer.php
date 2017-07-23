<?php
/**
 * Msupplier_buyer.php
 * ==============================================
 * Copy right 2017 http://www.texmall.com
 * ==============================================
 * @author: zoudong
 * @date: 2017年6月13日
 */
class Msupplier_buyer extends CI_Model{
	private $table = 'supplier_buyer';        
	
	/**
	 * @获取总条数
	 * */
	public function total($search)
	{
	    $this->db->select('id');
	    $this->db->from($this->table);
	    if (!empty($search['type'])) {
	        $this->db->where(array('type'=>$search['type']));
	    }
	    if (!empty($search['status'])) {
	        $this->db->where(array('status'=>$search['status']));
	    }
	    if (!empty($search['province_id'])) {
	        $this->db->where(array('province_id'=>$search['province_id']));
	    }
	    if (!empty($search['city_id'])) {
	        $this->db->where(array('city_id'=>$search['city_id']));
	    }
	    if (!empty($search['sta_time'])) {
	        $this->db->where(array('time >'=>strtotime($search['sta_time'])));
	    }
	    if (!empty($search['end_time'])) {
	        $this->db->where(array('time <'=>strtotime($search['end_time'])));
	    }
	    if (!empty($search['item'])) {
	        $this->db->group_start();
	        $this->db->like('company_name', $search['item']);
	        $this->db->or_like('main_business', $search['item']);
	        $this->db->or_like('ads_des', $search['item']);
	        $this->db->or_like('office_tel', $search['item']);
	        $this->db->or_like('company_des', $search['item']);
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
	    if (!empty($search['type'])) {
	        $this->db->where(array('type'=>$search['type']));
	    }
	    if (!empty($search['status'])) {
	        $this->db->where(array('status'=>$search['status']));
	    }
	    if (!empty($search['province_id'])) {
	        $this->db->where(array('province_id'=>$search['province_id']));
	    }
	    if (!empty($search['city_id'])) {
	        $this->db->where(array('city_id'=>$search['city_id']));
	    }
	    if (!empty($search['sta_time'])) {
	        $this->db->where(array('time >'=>strtotime($search['sta_time'])));
	    }
	    if (!empty($search['end_time'])) {
	        $this->db->where(array('time <'=>strtotime($search['end_time'])));
	    }
	    if (!empty($search['item'])) {
	        $this->db->group_start();
	        $this->db->like('company_name', $search['item']);
	        $this->db->or_like('main_business', $search['item']);
	        $this->db->or_like('ads_des', $search['item']);
	        $this->db->or_like('office_tel', $search['item']);
	        $this->db->or_like('company_des', $search['item']);
	        $this->db->group_end();
	    }
	    $this->db->order_by($order);
	    if ($perpage) $this->db->limit($perpage, $perpage*$page);
	    return $this->db->get();
	}
	
	
}

/** End of file Msupplier_buyer.php */
/** Location: ./application/models/Msupplier_buyer.php */