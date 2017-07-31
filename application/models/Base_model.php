<?php

class Base_model extends CI_Model{ 
	
    /******************************
     * 数据库操作
     * ***************************/
    
	/**
	 * @param string $table:数据表
	 * @param string $order：排序
	 * @param string $limit：限制条数
	 * @return Object
	 * */
    public function getTable($table, $order=null, $limit=null)   //获取表数据
	{
	    if ($order === 'RANDOM') {
	        $this->db->order_by('id', 'RANDOM');
	    } else {
	        $order = $order ? $order : 'id DESC';
	        $this->db->order_by($order);
	    }
	    if ($limit) $this->db->limit($limit);
	    return $this->db->get($table);
	}
	
	/** 
	 * @param string $table:数据表
	 * @param array $where：条件
	 * @param string $order：排序
	 * @param string $limit：限制条数
	 * @return Object
	 */
	public function getWhere($table, $where, $order=null, $limit=null)  //按条件获取数据
	{
	    $order = $order ? $order : 'id DESC';
	    $this->db->order_by($order);
	    if ($limit) $this->db->limit($limit);
	    return $this->db->get_where($table, $where);
	}
	
	/**
	 * @param string $table:数据表
	 * @param array/string $where：条件
	 * @param array/string $orwhere：或者条件
	 * @param string $order：排序
	 * @param string $limit：限制条数
	 * @return Object
	 */
	public function getOrWhere($table, $where, $orwhere, $order=null, $limit=null)  //按条件获取数据
	{
	    $order = $order ? $order : 'id DESC';
	    $this->db->where($where);
	    $this->db->or_where($orwhere);
	    $this->db->order_by($order);
	    if ($limit) $this->db->limit($limit);
	    return $this->db->get($table);
	}
	
	/**
	 * @param string $table：数据表
	 * @param string $item：字段
	 * @param array $arr：数组
	 * @param array $where：条件
	 * @param string $order：排序
	 * @param string $limit：条数
	 * @return Object
	 * */
	
	public function getWherein($table, $item, $arr, $where=array(), $order=null, $limit=null)  //在$arr 内
	{
	    if (empty($arr)) return array();
	    $order = $order ? $order : 'id DESC';
	    $this->db->where_in($item, $arr);
	    if (!is_empty($where)) $this->db->where($where);
	    $this->db->order_by($order);
	    if ($limit) $this->db->limit($limit);
	    return $this->db->get($table)->result();
	}
	
	/**
	 * @param string $table：数据表
	 * @param string $item：字段
	 * @param array $arr：数组
	 * @param string $order：排序
	 * @param string $limit：条数
	 * @return Object
	 * */
	public function getWhereNotin($table, $item, $arr, $order=null, $limit=null)  //不在$arr内
	{
	    $order = $order ? $order : 'id DESC';
	    $this->db->where_not_in($item, $arr);
	    $this->db->order_by($order);
	    if ($limit) $this->db->limit($limit);
	    return $this->db->get($table);
	}
	
	/**
	 * @param string $table：数据表
	 * @param number $page：页数
	 * @param number $perpage：每页数量
	 * @param string $where：条件
	 * @param string $order：排序
	 * @return Object 数据
	 */
	public function getRow($table, $page, $perpage, $where=array(), $order=null) //分页
	{
	    $order = $order ? $order : 'id DESC';
	    if (!is_empty($where)) $this->db->where($where);
	    if (!empty($order)) $this->db->order_by($order);
	    return $this->db->get($table, $perpage, $perpage*$page);
	}
	
	/**
	 * @param string $table:数据表
	 * @param array $like：限制条件
	 * @param string $order：排序
	 * @param string $limit：条数
	 * @return Object
	 */
	public function getLike($table, $like, $order=null, $limit=null)  //按条件模糊获取数据
	{
	    $order = $order ? $order : 'id DESC';
	    $this->db->order_by($order);
	    if ($limit) $this->db->limit($limit);
	    $this->db->like($like);
	    return $this->db->get($table);
	}
	
	/**
	 * @param string $table：数据表
	 * @param array $orlike：模糊条件
	 * @param array $where：准确条件
	 * @param string $order：排序
	 * @param number $limit：条数
	 * @return Object
	 * */
	public function getOrLike($table, $orlike, $where=array(), $order=null, $limit)  //按条件模糊和准确条件获取数据
	{
	    $order = $order ? $order : 'id DESC';
	    $this->db->select('*');
	    $this->db->from($table);
	    $where_arr = array();
	    foreach($orlike as $k=>$v) {
	        $where_arr[] = "`{$k}`" . " LIKE '%" . $v . "%' ";
	    }
	    $where_str = implode(' OR ', $where_arr);
	    $this->db->where("($where_str)");
	    if (!empty($where)) $this->db->where($where);
	    $this->db->order_by($order);
	    if ($limit) $this->db->limit($limit);
	    return $this->db->get();
	}
	
	/**
	 * @param string $table：数据表
	 * @param string $distinct：查询字段
	 * @param string $group：分组
	 * @param string $where：限制条件
	 * @param string $order：排序
	 * @param number $limit：条数
	 * @return Object
	 * ---还有一种更简便：select * from table group by name---
	 * */
	public function getDistinct($table, $distinct, $group, $where=array(), $order=null, $limit=null)   //查询某字段非重复数据
	{
	    $order = $order ? $order : 'id DESC';
	    $this->db->select('*, count(distinct `' . $distinct . '`) as `dis`');
	    if (!empty($where)) $this->db->where($where);
	    $this->db->group_by($group);
	    $this->db->order_by($order);
	    if ($limit) $this->db->limit($limit);
	    return $this->db->get($table);
	}
	
	/** $this->db->trans_start();$this->db->trans_complete();
	 * @param string $table:数据表
	 * @param array $data：数据
	 * @return id：插入id
	 */
	public function insert($table, $data)   //插入数据
	{
	    $this->db->insert($table, $data);
	    return $this->db->insert_id();
	}
	
	/**
	 * @param string $table:数据表
	 * @param array $data:二维数组
	 * @return unknown
	 * */
	public function insertArray($table, $data)  //插入多条数据
	{
	    return $this->db->insert_batch($table, $data);
	}
	
	/**
	 * @param string $table：数据表
	 * @param array $where：限制条件
	 * @param array $data：数据
	 * @return $num :影响数据条数
	 */
	public function update($table, $where, $data)  //更新数据
	{
	    $this->db->update($table, $data, $where);
	    return $this->db->affected_rows();
	}
	
	/**
	 * @param string $table：数据表
	 * @param array $data：数据
	 * @param array $field：字段
	 * @return $num :影响数据条数
	 */
	public function updateArray($table, $data, $field) //批量更新数据
	{
	    return $this->db->update_batch($table, $data, $field);
	}
	
	/**
	 * @param string $table
	 * @param string $item
	 * @param array $arr
	 * @return $num :影响数据条数
	 */
	public function updateWherein($table, $item, $arr, $data)  //删除数据
	{
	    if (empty($arr)) return 0;
	    $this->db->where_in($item, $arr);
	    $this->db->update($table, $data);
	    return $this->db->affected_rows();
	}
	
	/** 
	 * @param string $table
	 * @param array $where
	 * @return $num :影响数据条数
	 */
	public function delete($table, $where)  //删除数据
	{
	    $this->db->delete($table, $where);
	    return $this->db->affected_rows();
	}
	
	/**
	 * @param string $table
	 * @param string $item
	 * @param array $arr
	 * @return $num :影响数据条数
	 */
	public function deleteWherein($table, $item, $arr)  //删除数据
	{
	    if (empty($arr)) return 0;
	    $this->db->where_in($item, $arr);
	    $this->db->delete($table);
	    return $this->db->affected_rows();
	}
	
	/**
	 * @param string $table:数据表
	 * @param array $where:('id'=>$id);
	 * @param array $field:字段
	 * @param array $field:字段操作
	 * @return $num:影响数据条数
	 * */
    public function clickAdd($table, $where=array(), $field='click', $act='click +1')  //投票/浏览量/点击量加1/减1
	{
		$this->db->set($field, $act, FALSE);
		if (!empty($where)) $this->db->where($where);
		$this->db->update($table);
		return $this->db->affected_rows();
	}
	
	/**
	 * @param string $table:数据表
	 * @param string/array  $data:单个字段或字段数组
	 * @return Object
	 */
	public function groupBy($table, $group, $where=array(), $order='id ASC')   //分组获取数据
	{
	    if (!is_empty($where)) $this->db->where($where);
		$this->db->group_by($group);
		$this->db->order_by($order);
		return $this->db->get($table);
	}
	
	/**
	 * @param string $table:数据表
	 * @param array $where:限制条件
	 * @return $num 数据条数
	 */
	public function getTableNum($table, $where=array())  //按条件获取条数
	{ 
	    if (!empty($where)) $this->db->where($where);
	    return $this->db->count_all_results($table);
	}
	
	/**
	 * @param string $table:数据表
	 * @param array $where:限制条件
	 * @return 分组数据
	 */
	public function getCountNum($table, $group, $where=array())  //按条件获取分组数据
	{
	    $this->db->select('*, COUNT(id) as count_num');
	    if (!empty($where)) $this->db->where($where);
	    $this->db->group_by($group);
	    return $this->db->get($table);
	}
	
	/**
	 * @param string $table:数据表
	 * @param string $field:表字段
	 * @return 分组数据
	 */
	public function getFieldRes($table, $field, $where=array())
	{
	    $this->db->select($field);
	    if (!empty($where)) $this->db->where($where);
	    return $this->db->get($table);
	}
	
	/**
	 * @param string $table:数据表
	 * @param string $field:表字段
	 * @return 分组数据
	 */
	public function getSum($table, $field, $where=array())
	{
	    $this->db->select_sum($field);
	    if (!empty($where)) $this->db->where($where);
	    return $this->db->get($table);
	}
	
}
