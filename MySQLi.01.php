<?php
// Datalayer for php
Class MySQLiDL
{
    
    private $cx = array();              // connection string
    private $conn;                      // connection
    private $rs = "";                  // record set
	public $IsOpen = true;               // is connection open
    public $Error;
    
    /// Pass the host, user and password to the routine.
    /// $cx[host] :: MySQL host
    /// $cx[user] :: User
    /// $cx[pass] :: Password    
	/// $cx[db] :: Default database
    public function MySQLiDL($cx)
    {        
	   $this->cx = $cx;
       include("Error.01.php");
       $this->Error = new Error("MySQLi");
    }
    
    /// Open the MySQL Connection
    /// Returns :: True/False
    public function Open()
    {
        $this->Error->Reset();
		$old_err_rpt = error_reporting();	// get the orginal error reporting number
		error_reporting(0);			        // suppress the error; let the class handle it
        $rtn = true;
        
        $this->conn = new mysqli($this->cx['host'],$this->cx['user'],$this->cx['pass'],$this->cx['db']);
        
        if ($this->conn->connect_error)           // if can't open return false
        {
            $this->Error->Add($this->conn->connect_error);	
            $rtn = false;
        }
        else
        {
            $this->IsOpen = true;
        }
		error_reporting($old_err_rpt);	// set back to orginal reporting	
        return $rtn;
    }
    
    /// Closes the connecton
    public function Close()
    {        
		$this->Error->Reset();
	    $this->conn->close();
        $this->IsOpen = false;
    }
    
    /// Query the table
    /// $query :: the query statement to execute
    public function Query($query)
    {
		$old_err_rpt = error_reporting();	// get the orginal error reporting number
		error_reporting(0);			// suppress the error; let the class handle it
	
		$rtn = false;
	
		$this->rs = $this->conn->query($query);
		
		if ($this->conn->connect_error)
        {
            $this->Error->Add($this->conn->connect_error);
        }
        else
        {
            $rtn = true;
        }
		error_reporting($old_err_rpt);	// set back to orginal reporting
		return $rtn;
	
    }
    
    /// Gets the next record in the record set
    /// Return :: array
    public function NextRecord()
    {
        $row = $this->rs->fetch_assoc();
        return $row;
    }
    
	/// Moves the array pointer to a specified record
	/// $rec : int of the record to move the poiter too
	public function GotoRec($rec)
	{
		$this->rs->data_seek($this->rs,$rec);
	}
	
    /// Executes a query statement that does not return a record set
    /// $query :: query statement
    /// Returns :: Last id (auto increment)
    public function NonQuery($query)
    {
		$old_err_rpt = error_reporting();	// get the orginal error reporting number
		error_reporting(0);					// suppress the error; let the class handle it
		$rtn = false;							// retun last id
        $rs = $this->Query($query);
        if ($rs)     
            $rtn = $this->conn->insert_id;
        
		error_reporting($old_err_rpt);	// set back to orginal reporting
        return $rtn;				// retun the last id

    }
    
  
}

?>