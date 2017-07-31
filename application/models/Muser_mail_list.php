<?php
/**
 * Muser_mail_list.php
 * ==============================================
 * Copy right 2017 http://www.texmall.com
 * ==============================================
 * @author: zoudong
 * @date: 2017年6月13日
 */
class Muser_mail_list extends CI_Model{
	private $table = 'user_mail_list';        
	
	/**
	 * @获取总条数
	 * */
	public function total($search)
	{
	    $this->db->select('id');
	    $this->db->from($this->table);
	    if (!empty($search['uid'])) {
	        $this->db->where(array('uid'=>$search['uid']));
	    }
	    if (!empty($search['sta_time'])) {
	        $this->db->where(array('time >'=>strtotime($search['sta_time'])));
	    }
	    if (!empty($search['end_time'])) {
	        $this->db->where(array('time <'=>strtotime($search['end_time'])));
	    }
	    if (!empty($search['item'])) {
	        $this->db->group_start();
	        $this->db->like('company', $search['item']);
	        $this->db->or_like('full_name', $search['item']);
	        $this->db->or_like('telphone', $search['item']);
	        $this->db->or_like('position', $search['item']);
	        $this->db->or_like('e_mail', $search['item']);
	        $this->db->or_like('address', $search['item']);
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
	    if (!empty($search['uid'])) {
	        $this->db->where(array('uid'=>$search['uid']));
	    }
	    if (!empty($search['sta_time'])) {
	        $this->db->where(array('time >'=>strtotime($search['sta_time'])));
	    }
	    if (!empty($search['end_time'])) {
	        $this->db->where(array('time <'=>strtotime($search['end_time'])));
	    }
	    if (!empty($search['item'])) {
	        $this->db->group_start();
	        $this->db->like('company', $search['item']);
	        $this->db->or_like('full_name', $search['item']);
	        $this->db->or_like('telphone', $search['item']);
	        $this->db->or_like('position', $search['item']);
	        $this->db->or_like('e_mail', $search['item']);
	        $this->db->or_like('address', $search['item']);
	        $this->db->group_end();
	    }
	    $this->db->order_by($order);
	    if ($perpage) $this->db->limit($perpage, $perpage*$page);
	    return $this->db->get();
	}
	
	
	
	
}

/** End of file Muser_mail_list.php */
/** Location: ./application/models/Muser_mail_list.php */