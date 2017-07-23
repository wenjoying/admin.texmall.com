<?php
/**
 * Morder_goods.php
 * ==============================================
 * Copy right 2017 http://www.texmall.com
 * ==============================================
 * @author: zoudong
 * @date: 2017年6月13日
 */
class Morder_goods extends CI_Model{
	private $table = 'order_goods';        
	
	/**
	 * @获取总条数
	 * */
	public function total($search)
	{
	    $this->db->select('id');
	    $this->db->from($this->table);
	    if (!empty($search['status'])) {
	        $this->db->where(array('status'=>$search['status']));
	    }
	    if (!empty($search['sta_time'])) {
	        $this->db->where(array('time >'=>strtotime($search['sta_time'])));
	    }
	    if (!empty($search['end_time'])) {
	        $this->db->where(array('time <'=>strtotime($search['end_time'])));
	    }
	    if (!empty($search['item'])) {
	        $this->db->group_start();
	        $this->db->like('supplier_code', $search['item']);
	        $this->db->or_like('username', $search['item']);
	        $this->db->or_like('des', $search['item']);
	        $this->db->group_end();
	    }
	    return $this->db->count_all_results();
	}
	
	/**
	 * @分页
	 * @param number $page:页码
	 * @param number $perpage:每页数量
	 * @param array $search:查找条件
	 * @param string $order_goods:排序
	 * */
	public function grid($page, $perpage, $search, $order_goods='id desc')  
	{
	    $this->db->select('*');
	    $this->db->from($this->table);
	    if (!empty($search['status'])) {
	        $this->db->where(array('status'=>$search['status']));
	    }
	    if (!empty($search['sta_time'])) {
	        $this->db->where(array('time >'=>strtotime($search['sta_time'])));
	    }
	    if (!empty($search['end_time'])) {
	        $this->db->where(array('time <'=>strtotime($search['end_time'])));
	    }
	    if (!empty($search['item'])) {
	        $this->db->group_start();
	        $this->db->like('supplier_code', $search['item']);
	        $this->db->or_like('username', $search['item']);
	        $this->db->or_like('des', $search['item']);
	        $this->db->group_end();
	    }
	    $this->db->order_by($order_goods);
	    if ($perpage) $this->db->limit($perpage, $perpage*$page);
	    return $this->db->get();
	}
	
	
	
}

/** End of file Morder_goods.php */
/** Location: ./application/models/Morder_goods.php */