<?php
class Connection
{
	var $servername;
    var $username;
    var $password;
	var $dbname;

        function Connection ($servername="localhost", $username="root", $password="rama@123", $dbname="emotech")
        {
            $this->host=$servername;
            $this->dbname=$dbname;
            $this->username=$username;
            $this->password=$password;
            $this->Connect();
        }	
		function Connect ()
        {
            $this->dbconnect =new mysqli($this->host, $this->username, $this->password, $this->dbname);
			
        }
		
		 function ExecQuery ($sql)
        {
            $this->result=$this->dbconnect->query($sql);
            //$this->query->Free();
            return $this->result;
        }

        function FetchResult ()
        {
            if ($this->result)
            {
                 $this->arr=$this->result->fetch_array ();
                 return $this->arr;
            }
            else
            {
                
                return null;
            }
        }
		function Error ()
        {
            if (version_compare(phpversion(), "4.2.0", "ge")>0)
                $this->error=$this->dbconnect->errno;
            return $this->error;
        }
		function numRows()
		{
			$this->rows=$this->result->num_rows;
			return $this->rows; 
		}
		function EscString($str)
       {
           $this->result=$this->dbconnect->real_escape_string($str);
           return $this->result;
       }
}
?>