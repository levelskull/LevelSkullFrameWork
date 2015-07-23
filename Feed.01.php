<?php
Class Feed
{
	
	private $sql;
	private $sql_type;
	
	/// Feed
	/// $sql :: open sql framework
	/// $sql_type :: (MySQL,MSSQL)
	public function Feed($sql, $sql_type)
	{
		$this->sql = $sql;
	}
	
	/// Json Feed
	/// $query :: query to return json format
	/// Return :: Json Format
	public function Json($query)
	{
		$rs = $this->sql->Query($query);
		if (!$rs)
			die("Error");
		
		$rtn = array();
		
		while ($row = $this->sql->NextRecord())
		{
			$rtn[] = $row;
		}
		
		return Json_Encode($rtn);
	}
	
	/// Assoc Array Feed
	/// $query :: query to return json format
	/// Return :: Json Format
	public function AssocArray($query)
	{
		$rs = $this->sql->Query($query);
		if (!$rs)
			die("Error");
		
		$rtn = array();
		
		while ($row = $this->sql->NextRecord())
		{
			$rtn[] = $row;
		}
		
		return $rtn;
	}
}

	
?>