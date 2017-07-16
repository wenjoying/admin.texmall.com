<?php
/**
 * Mad_img.php
 * ==============================================
 * Copy right 2017 http://www.texmall.com
 * ==============================================
 * @author: zoudong
 * @date: 2017年6月13日
 */
class Mad_img extends CI_Model{
	private $table = 'ad_img';        
	
	/**
	 * @param array $search:查找条件
	 * @param string $order:排序
	 * */
	public function grid($search, $order='id desc')  
	{
	    $this->db->select('*');
	    $this->db->from($this->table);
	    if (!empty($search['status'])) {
	        $this->db->where(array('status'=>$search['status']));
	    }
	    if (!empty($search['item'])) {
	        $this->db->group_start();
	        $this->db->like('ad_name', $search['item']);
	        $this->db->or_like('ad_info', $search['item']);
	        $this->db->group_end();
	    }
	    $this->db->order_by($order);
	    return $this->db->get();
	}
	
	
}

/** End of file Mad_img.php */
/** Location: ./application/models/Mad_img.php */