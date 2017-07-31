<?php
/**
 * Muser.php
 * ==============================================
 * Copy right 2017 http://www.texmall.com
 * ==============================================
 * @author: zoudong
 * @date: 2017年6月13日
 */
class Muser extends CI_Model{
	private $table = 'user';        
	
	/**
	 * @获取总条数
	 * */
	public function total($search)
	{
	    $this->db->select('id');
	    $this->db->from($this->table);
	    if (!empty($search['role_id'])) {
	        $this->db->where(array('role_id'=>$search['role_id']));
	    }
	    if (!empty($search['reg_come'])) {
	        $this->db->where(array('reg_come'=>$search['reg_come']));
	    }
	    if (!empty($search['sta_time'])) {
	        $this->db->where(array('reg_time >'=>strtotime($search['sta_time'])));
	    }
	    if (!empty($search['end_time'])) {
	        $this->db->where(array('reg_time <'=>strtotime($search['end_time'])));
	    }
	    if (!empty($search['item'])) {
	        $this->db->group_start();
	        $this->db->like('device_id', $search['item']);
	        $this->db->or_like('username', $search['item']);
	        $this->db->or_like('mobile', $search['item']);
	        $this->db->or_like('company', $search['item']);
	        $this->db->or_like('id_card', $search['item']);
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
	    if (!empty($search['role_id'])) {
	        $this->db->where(array('role_id'=>$search['role_id']));
	    }
	    if (!empty($search['reg_come'])) {
	        $this->db->where(array('reg_come'=>$search['reg_come']));
	    }
	    if (!empty($search['sta_time'])) {
	        $this->db->where(array('reg_time >'=>strtotime($search['sta_time'])));
	    }
	    if (!empty($search['end_time'])) {
	        $this->db->where(array('reg_time <'=>strtotime($search['end_time'])));
	    }
	    if (!empty($search['item'])) {
	        $this->db->group_start();
	        $this->db->like('device_id', $search['item']);
	        $this->db->or_like('username', $search['item']);
	        $this->db->or_like('mobile', $search['item']);
	        $this->db->or_like('company', $search['item']);
	        $this->db->or_like('id_card', $search['item']);
	        $this->db->group_end();
	    }
	    $this->db->order_by($order);
	    if ($perpage) $this->db->limit($perpage, $perpage*$page);
	    return $this->db->get();
	}
	
	
}

/** End of file Muser.php */
/** Location: ./application/models/Muser.php */