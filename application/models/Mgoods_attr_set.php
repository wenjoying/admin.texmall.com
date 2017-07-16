<?php
/**
 * Mgoods_attr_set.php
 * ==============================================
 * Copy right 2017 http://www.texmall.com
 * ==============================================
 * @author: zoudong
 * @date: 2017年6月13日
 */
class Mgoods_attr_set extends CI_Model{
	private $table = 'goods_attr_set';        
	
	/**
	 * @获取总条数
	 * */
	public function total($search)
	{
	    $this->db->select('id');
	    $this->db->from($this->table);
	    if (!empty($search['is_multi'])) {
	        $this->db->where(array('is_multi'=>$search['is_multi']));
	    }
	    if (!empty($search['is_show'])) {
	        $this->db->where(array('is_show'=>$search['is_show']));
	    }
	    if (!empty($search['item'])) {
	        $this->db->group_start();
	        $this->db->like('attr_en_name', $search['item']);
	        $this->db->or_like('attr_name', $search['item']);
	        $this->db->or_like('attr_val', $search['item']);
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
	    if (!empty($search['is_multi'])) {
	        $this->db->where(array('is_multi'=>$search['is_multi']));
	    }
	    if (!empty($search['is_show'])) {
	        $this->db->where(array('is_show'=>$search['is_show']));
	    }
	    if (!empty($search['item'])) {
	        $this->db->group_start();
	        $this->db->like('attr_en_name', $search['item']);
	        $this->db->or_like('attr_name', $search['item']);
	        $this->db->or_like('attr_val', $search['item']);
	        $this->db->group_end();
	    }
	    $this->db->order_by($order);
	    if ($perpage) $this->db->limit($perpage, $perpage*$page);
	    return $this->db->get();
	}
	
	
}

/** End of file Mgoods_attr_set.php */
/** Location: ./application/models/Mgoods_attr_set.php */