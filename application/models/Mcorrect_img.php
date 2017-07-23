<?php
/**
 * Mcorrect_img.php
 * ==============================================
 * Copy right 2017 http://www.texmall.com
 * ==============================================
 * @author: zoudong
 * @date: 2017年6月13日
 */
class Mcorrect_img extends CI_Model{
	private $table = 'correct_img';        
	
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
	    if (!empty($search['sta_time'])) {
	        $this->db->where(array('time >'=>strtotime($search['sta_time'])));
	    }
	    if (!empty($search['end_time'])) {
	        $this->db->where(array('time <'=>strtotime($search['end_time'])));
	    }
	    if (!empty($search['item'])) {
	        $this->db->group_start();
	        $this->db->like('img_name', $search['item']);
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
	 * @param string $order:排序
	 * */
	public function grid($page, $perpage, $search, $order='id desc')  
	{
	    $this->db->select('*');
	    $this->db->from($this->table);
	    if (!empty($search['type'])) {
	        $this->db->where(array('type'=>$search['type']));
	    }
	    if (!empty($search['sta_time'])) {
	        $this->db->where(array('time >'=>strtotime($search['sta_time'])));
	    }
	    if (!empty($search['end_time'])) {
	        $this->db->where(array('time <'=>strtotime($search['end_time'])));
	    }
	    if (!empty($search['item'])) {
	        $this->db->group_start();
	        $this->db->like('img_name', $search['item']);
	        $this->db->or_like('des', $search['item']);
	        $this->db->group_end();
	    }
	    $this->db->order_by($order);
	    if ($perpage) $this->db->limit($perpage, $perpage*$page);
	    return $this->db->get();
	}
	
	
	/**
	 * @生成标准图名字
	 * */
	public function create_name($type = 'tex')
	{
	    $this->db->select_max('img_name');
	    $this->db->where(array('type'=>$type));
	    $name = $this->db->get($this->table)->row()->img_name;
	    if ($name == NULL) {
	        return $type=='tex' ? 'A0001' : 'M0001';
	    } else {
	        $k = $name{0};
	        $n = (int)mb_substr($name, 1, 4) +1;
	        return $k.(string)sprintf('%04d', $n);
	    }
// 	    return chr(ord($k)+1).'0001';
	}
	
	
}

/** End of file Mcorrect_img.php */
/** Location: ./application/models/Mcorrect_img.php */