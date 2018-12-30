<?php
/**
  * @brief CRM Tickets
  * @author jambonbill
 */

namespace CRM;


use PDO;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;


class Ticket
{
	
    private $db=null;
	private $Base=null;
	//private $_user;

	public function __construct (Base $B)
    {
        $this->Base=$B;
        $this->db=$B->db();
    }


    /**
     * Return db connector
     * @return [type] [description]
     */
    private function db()
    {
        return $this->db;
    }

    public function user_id()
    {
        return $this->Base->user_id();
    }

    
    /**
     * Return list of tickets
     * @return [type] [description]
     */
    public function tickets()
    {
        $sql="SELECT * FROM tickets WHERE t_id>0;";
        $q=$this->db()->query($sql) or die("Error:$sql");
        
        $dat=[];
        while($r=$q->fetch(PDO::FETCH_ASSOC)){
            $dat[]=$r;
        }
        return $dat;
    }
    
    
    /**
     * Return ticket
     * @param  integer $id [description]
     * @return [type]      [description]
     */
    public function ticket($id=0)
    {
        $id*=1;
        if(!$id)return false;

        $sql="SELECT * FROM tickets WHERE t_id=$id LIMIT 1;";
        $q=$this->db()->query($sql) or die("Error:$sql");
        
        $dat=[];
        while($r=$q->fetch(PDO::FETCH_ASSOC)){
            $dat[]=$r;
        }
        return $dat;
    }

    
    /**
     * Create a ticket
     * @return [type] [description]
     */
    public function ticketCreate()
    {

    }
    
    
    /**
     * Update one ticket
     * @param  integer $id   [description]
     * @param  array   $data [description]
     * @return [type]        [description]
     */
    public function ticketUpdate($id=0,$data=[])
    {

    }
    
    
    /**
     * Delete a ticket
     * @param  integer $id [description]
     * @return [type]      [description]
     */
    public function ticketDelete($id=0)
    {

    }

}