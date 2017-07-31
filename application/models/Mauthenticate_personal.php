<?php
/**
 * Mauthenticate_personal.php
 * ==============================================
 * Copy right 2017 http://www.texmall.com
 * ==============================================
 * @author: zoudong
 * @date: 2017年6月13日
 */
class Mauthenticate_personal extends CI_Model{
	private $table = 'authenticate_personal';        
	
	/**
	 * @获取总条数
	 * */
	public function total($search)
	{
	    $this->db->select('id');
	    $this->db->from($this->table);
	    if (!empty($search['is_check'])) {
	        $this->db->where(array('is_check'=>$search['is_check']));
	    }
	    if (!empty($search['sta_time'])) {
	        $this->db->where(array('time >'=>strtotime($search['sta_time'])));
	    }
	    if (!empty($search['end_time'])) {
	        $this->db->where(array('time <'=>strtotime($search['end_time'])));
	    }
	    if (!empty($search['bank_address'])) {
	        $this->db->like(array('bank_address'=>$search['bank_address']));
	    }
	    if (!empty($search['item'])) {
	        $this->db->group_start();
	        $this->db->like('realname ', $search['item']);
	        $this->db->or_like('id_card', $search['item']);
	        $this->db->or_like('bank_name', $search['item']);
	        $this->db->or_like('bank_branch', $search['item']);
	        $this->db->or_like('bank_card', $search['item']);
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
	    if (!empty($search['is_check'])) {
	        $this->db->where(array('is_check'=>$search['is_check']));
	    }
	    if (!empty($search['sta_time'])) {
	        $this->db->where(array('time >'=>strtotime($search['sta_time'])));
	    }
	    if (!empty($search['end_time'])) {
	        $this->db->where(array('time <'=>strtotime($search['end_time'])));
	    }
	    if (!empty($search['bank_address'])) {
	        $this->db->like(array('bank_address'=>$search['bank_address']));
	    }
	    if (!empty($search['item'])) {
	        $this->db->group_start();
	        $this->db->like('realname ', $search['item']);
	        $this->db->or_like('id_card', $search['item']);
	        $this->db->or_like('bank_name', $search['item']);
	        $this->db->or_like('bank_branch', $search['item']);
	        $this->db->or_like('bank_card', $search['item']);
	        $this->db->group_end();
	    }
	    $this->db->order_by($order);
	    if ($perpage) $this->db->limit($perpage, $perpage*$page);
	    return $this->db->get();
	}
	
	
}

/** End of file Mauthenticate_personal.php */
/** Location: ./application/models/Mauthenticate_personal.php */