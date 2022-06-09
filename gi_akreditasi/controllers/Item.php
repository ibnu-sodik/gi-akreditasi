<?php  
defined('BASEPATH') OR exit('No direct script access allowed');  

class Item extends CI_Controller {  

    /**  
     * This method is used to get all the data.  
     *  
     * @return Response  
    */  
    public function __construct() {  
    	parent::__construct();  
    	$this->load->database();  
    }  
    
    /**  
     * This method is used to get all the data.  
     *  
     * @return Response  
    */  
    public function index()  
    {  
    	$this->load->view('items');  
    }  

    /**  
     * This method is used to get all the Data.   
     *  
     * @return Response  
    */  
    public function getItem()  
    {  
    	$data = [];  
    	$parent_key = '0';  
    	$row = $this->db->query('SELECT * FROM tb_kategori');  

    	if($row->num_rows() > 0)  
    	{  
    		$data = $this->membersTree($parent_key);  
    	}else{  
    		$data=["id_kategori"=>"0","nama_kategori"=>"No Members presnt in list","slug"=>"No Members is presnt in list","nodes"=>[]];  
    	}  

    	echo json_encode(array_values($data));  
    }  

    /**  
     * This method is used to get all the data.  
     *  
     * @return Response  
    */  
    public function membersTree($parent_key)  
    {  
    	$row1 = [];  
    	$row = $this->db->query('SELECT * FROM tb_kategori WHERE parent_id="'.$parent_key.'"')->result_array();  
        $no=0;
    	foreach($row as $key => $value)  
    	{  
            $no++;
    		$id = $value['id_kategori'];  
    		$row1[$key]['id'] = $value['id_kategori'];  
    		$row1[$key]['name'] = $value['nama_kategori'];  
    		$row1[$key]['text'] = $no.'. '.$value['nama_kategori'];  
    		$row1[$key]['nodes'] = array_values($this->membersTree($value['id_kategori']));  
    	}  

    	return $row1;  
    }  

}  