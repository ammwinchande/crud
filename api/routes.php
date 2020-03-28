<?php

require 'QueryBuilder.php';

$query_builder = new QueryBuilder();

if($_GET["action"] == 'fetch_all')
{
	$data = $query_builder->fetch_all('customer', true);
}

if($_GET["action"] == 'insert')
{
	$data = $query_builder->insert();
}

if($_GET["action"] == 'fetch_single')
{
	$data = $query_builder->fetch_single($_GET["id"]);
}

if($_GET["action"] == 'update')
{
	$data = $query_builder->update();
}

if($_GET["action"] == 'delete')
{
	$data = $query_builder->delete($_GET["id"]);
}

echo json_encode($data);

?>