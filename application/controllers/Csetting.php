<?php 
/**
 * Csetting.php
 * ==============================================
 * Copy right 2017 http://www.texmall.com
 * ==============================================
 * @author: zoudong
 * @date: 2017年6月13日
 */
 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Csetting extends TM_Controller {
    
    function _init()
	{
		header("Content-type: text/html; Charset=utf-8");
	}
	
	/**
	 * @数据字典
	 * */
	public function mysql_dict_new()
	{
	    $tables = $this->db->list_tables();
	    
	    foreach ($tables as $table) {
	        $tab = '';
	        $sql = "SELECT COLUMN_COMMENT AS `mark` FROM information_schema.COLUMNS WHERE TABLE_NAME='".$table."'";
	        $data = $this->db->query($sql)->result();
	        $fields = $this->db->field_data($table);
	        $i = 0;
	        foreach ($fields as $field) {
	            $tab .= '</br>|'.$field->name;
	            $tab .= '|'.($field->primary_key?'是':'');
	            $tab .= '|'.$field->type.'('.$field->max_length.')';
	            $tab .= '|'.$field->default;
	            $tab .= '|'.$data[$i]->mark.'|';
	            $i ++;
	        }
	        $tab .= '</br>'.$table;
	        echo $tab;
	        echo '</br></br></br>';
	    }
	}
	
	/**
	 * @数据字典
	 * */
	public function mysql_dict() 
	{
	    $tables = $this->db->list_tables();
	    $tab = '<html lang="zh">
                <head>
                <meta charset="utf-8">
	           <title>数据字典</title>
	           <style>
                .tab{margin-top:15px;border:2px solid #111;}
                .tab th,.tab td{border:1px solid #e2e2e2;}
               </style>
	           </head>
	           <body>';
	    foreach ($tables as $table) {
	        $tab .= '<table class="tab">';
	        $tab .= '<tr><td colspan="6">数据表：'.$table.'</td></tr>';
	        $tab .= '<tr><td>字段</td><td>主键</td><td>类型</td><td>长度</td><td>默认</td><td>注释</td></tr>';
	        
	        $sql = "SELECT COLUMN_COMMENT AS `mark` FROM information_schema.COLUMNS WHERE TABLE_NAME='".$table."'";
	        $data = $this->db->query($sql)->result();
	        $fields = $this->db->field_data($table);
	        $i = 0;
	        foreach ($fields as $field) {
	            $tab .= '<tr>';
	            $tab .= '<td>'.$field->name.'</td>';
	            $tab .= '<td>'.($field->primary_key?'是':'').'</td>';
	            $tab .= '<td>'.$field->type.'</td>';
	            $tab .= '<td>'.$field->max_length.'</td>';
	            $tab .= '<td>'.$field->default.'</td>';
	            $tab .= '<td>'.$data[$i]->mark.'</td>';
	            $tab .= '</tr>';
	            $i ++;
	        }
	        $tab .= '</table>';
	    }
	    $tab .= '</body></html>';
// 	    echo $tab;
	    file_put_contents('tab.html', $tab);
	    
	}
	
}

/** End of file Csetting.php */
/** Location: ./application/controllers/Csetting.php */
