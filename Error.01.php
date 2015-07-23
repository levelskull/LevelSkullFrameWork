<?php
Class Error
{
	private $app = "";
	public $HasErr = false;
	private $errmsg = null;
	private $errno = null;
	
	public function Error($app)
	{
		$this->app = $app;
	}
	
	public function Add($errmsg, $errno)
	{
		$this->errno = $errno;
		$this->errmsg = $errmsg;
		$this->HasErr = true;
	}
	
	public function ShowError()
	{
		$rtn = "Error : <br>\r\n";
		$rtn .= "Error No : <br> \r\n";
		$rtn .= $this->errno."<br>\r\n";
		$rtn .= "Error Message : <br> \r\n";
		$rtn .= $this->errmsg."<br>\r\n";
		
		return $rtn;
	}
	
	public function Reset()
	{
		$this->errmsg = null;
		$this->errno = null;
		$this->HasErr = false;
	}
}	
?>