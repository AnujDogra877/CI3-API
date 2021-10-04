<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BaseModel extends CI_Model {
    public function __construct(){
		parent::__construct();
	}
	
	/*********************************************************
	@desc: Add new record into specific table
	@params: string,array
	@return: int
	********************************************************/
	public function addNew($table,$arrData){
		$this->db->insert($table,$arrData);
		return $this->db->insert_id();
	}

	/*******************************************************
	@desc: Get All records from specific table with pagination
	@params: string
	@return: array_object
	********************************************************/
	public function getAllPagination($table,$pageID = null,$perPage = 1){
		$perPage = $perPage==''?1:$perPage;
		$this->db->limit($perPage,$pageID*$perPage - $perPage);
		$record = $this->db->get($table);
		return $record->result_object();
	}
	/*******************************************************
	@desc: Get All records from specific table
	@params: string
	@return: array_object
	********************************************************/
	public function getAll($table, $type= "object"){
		$record = $this->db->get($table);
		if($type == "object"){
			return $record->result_object();
		}else{
			return $record->result_array();
		}
	}

	/*******************************************************
	@desc: Get All records from specific table
	@params: string
	@return: array_object
	********************************************************/
	public function getAllOrderByLimit($mainTable,$col,$condition,$orderBy,$limit){
		foreach($condition as $table => $condition){
			$this->db->join($table,$condition);
		}
		$this->db->order_by($col, $orderBy);
		$this->db->limit($limit);
		$record = $this->db->get($mainTable);
		return $record->result_object();
	}


	/************************************************************
	@desc: Count all the records from the specific table.
	@params: string : table
	@return: int: count total
	*************************************************************/
	public function record_count($table) {
		return $this->db->count_all($table);
	}
	
	/***************************************
	Select Row Where Requirement
	@params: string,array
	@return: array_object
	****************************************/
	public function selectRowWhere($table,$condition){
		$this->db->where($condition);
		return $this->db->get($table)->row();
	}
	/*************************************************************
	Desc: Update the record into a table with where condition.
	@params: string,array
	@return: integer
	***************************************************************/
	public function updatedRec($table,$condition,$updatedArray){
		$this->db->where($condition);
		$this->db->update($table,$updatedArray);
		return $this->db->affected_rows();
		// die($this->db->last_query());
	}
	/**************************************************************
	@desc: Delete a specific record from the table.
 	@params: table(string), condition(array)
	**************************************************************/
	public function deleteRec($table,$condition){
		$this->db->where($condition);
		$this->db->delete($table);
		return $this->db->affected_rows();
	}
	/**************************************************************
	@desc: get the no of rows count from the table.
 	@params: table(string), condition(array)
	@return: integer
	**************************************************************/
	public function rowCount($table,$condition){
		$this->db->where($condition);
		return $this->db->get($table)->result();
	}

	/*************************************************************
	Author: Anuj Sharma
	Desc: Dynamic joins between tables
	@params: tablename(string),condition(array)
	@return: Array Object
	**************************************************************/
	public function select_join($mainTable,$condition,$orderBy){
		foreach($condition as $table => $condition){
			$this->db->join($table,$condition);
		}
		if(!empty($orderBy)){
			$this->db->order_by(key($orderBy), $orderBy[key($orderBy)]);
		}
		$record = $this->db->get($mainTable);
		// die($this->db->last_query());
		return $record->result_object();
	}

	/*************************************************************
	Author: Anuj Sharma
	Desc: Dynamic joins between tables with where condition
	@params: tablename(string),condition(array),where(array)
	@return: Array row Object
	**************************************************************/
	public function selectJoinWhereRow($mainTable,$condition,$where){
		foreach($condition as $table => $condition){
			$this->db->join($table,$condition);
		}
		$this->db->where($where);
		return $this->db->get($mainTable)->row();
		//die($this->db->last_query());
	}
}
