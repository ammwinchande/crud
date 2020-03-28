<?php

class QueryBuilder
{
	private $connect = '';
	protected $config;

	public function __construct()
	{
		$this->database_connection();
	}

	public function database_connection()
	{
		$config = require '../config.php';
		try {
            $this->connect = new PDO(
                $config['database']['connection'] . ';dbname=' . $config['database']['name'],
                $config['database']['username'],
                $config['database']['password'],
                $config['database']['options']
            );
        } catch (PDOException $exc) {
            die('Cannot connect' . $exc->getMessage());
        }
	}

	public function fetch_all($table, $has_is_deleted)
	{
		if (!$has_is_deleted) {
			$query = "SELECT * FROM ${table} ORDER BY id";
		}
		$query = "SELECT * FROM ${table} WHERE is_deleted <> 1 ORDER BY id";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			while($row = $statement->fetch(PDO::FETCH_ASSOC))
			{
				$data[] = $row;
			}
			return $data;
		}
	}

	public function insert()
	{
		if(isset($_POST["first_name"]))
		{
			$form_data = array(
				':first_name'		=>	$_POST["first_name"],
				':last_name'		=>	$_POST["last_name"]
			);
			$query = "
			INSERT INTO tbl_sample 
			(first_name, last_name) VALUES 
			(:first_name, :last_name)
			";
			$statement = $this->connect->prepare($query);
			if($statement->execute($form_data))
			{
				$data[] = array(
					'success'	=>	'1'
				);
			}
			else
			{
				$data[] = array(
					'success'	=>	'0'
				);
			}
		}
		else
		{
			$data[] = array(
				'success'	=>	'0'
			);
		}
		return $data;
	}

	public function fetch_single($id)
	{
		$query = "SELECT * FROM tbl_sample WHERE id='".$id."'";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			foreach($statement->fetchAll() as $row)
			{
				$data['first_name'] = $row['first_name'];
				$data['last_name'] = $row['last_name'];
			}
			return $data;
		}
	}

	public function update()
	{
		if(isset($_POST["first_name"]))
		{
			$form_data = array(
				':first_name'	=>	$_POST['first_name'],
				':last_name'	=>	$_POST['last_name'],
				':id'			=>	$_POST['id']
			);
			$query = "
			UPDATE tbl_sample 
			SET first_name = :first_name, last_name = :last_name 
			WHERE id = :id
			";
			$statement = $this->connect->prepare($query);
			if($statement->execute($form_data))
			{
				$data[] = array(
					'success'	=>	'1'
				);
			}
			else
			{
				$data[] = array(
					'success'	=>	'0'
				);
			}
		}
		else
		{
			$data[] = array(
				'success'	=>	'0'
			);
		}
		return $data;
	}
	public function delete($id)
	{
		$query = "DELETE FROM tbl_sample WHERE id = '".$id."'";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			$data[] = array(
				'success'	=>	'1'
			);
		}
		else
		{
			$data[] = array(
				'success'	=>	'0'
			);
		}
		return $data;
	}
}

?>