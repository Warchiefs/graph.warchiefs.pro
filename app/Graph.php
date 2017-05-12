<?php

namespace App;

use Everyman\Neo4j\Client;
use Everyman\Neo4j\Index\NodeIndex;
use Illuminate\Database\Eloquent\Model;

class Graph extends Model
{
	/**
	 * Хост БД Neo4j
	 *
	 * @var mixed
	 */
    public $host;

	/**
	 * Порт БД Neo4j
	 *
	 * @var mixed
	 */
	public $port;

	/**
	 * Пользователь БД Neo4j
	 *
	 * @var mixed
	 */
	public $user;

	/**
	 * Пароль БД Neo4j
	 *
	 * @var mixed
	 */
	public $password;

	public $client;

	/**
	 * Graph constructor.
	 *
	 * Устанавливает и записывает соединение для дальнейшего использования
	 */
	public function __construct()
	{
		$this->host = env('NEO4J_HOST');
		$this->port = env('NEO4J_PORT');
		$this->user = env('NEO4J_USER');
		$this->password = env('NEO4J_PASSWORD');

		$this->client = $this->connect();
	}

	/**
	 * Устанавливает соединение с БД Neo4j
	 *
	 * @return Client | bool
	 */
	public function connect()
	{
		$client = new Client($this->host, $this->port);

		$client->getTransport()->setAuth($this->user, $this->password);

		if(!$client) {
			return false;
		}

		return $client;
	}

	/**
	 * Создание Node для пространства
	 *
	 * @param $workspace_id
	 * @param $params
	 *
	 * @return \Everyman\Neo4j\Node | bool
	 */
	public function makeNode($workspace_id, $params)
	{
		$index = new NodeIndex($this->client, 'workspace');

		if(!$index) {
			return false;
		}

		$node = $this->client->makeNode();

		if(!$node) {
			return false;
		}

		$node->setProperty('workspace_id', $workspace_id);
		foreach ($params as $key => $value)
		{
			$node->setProperty($key, $value);
		}

		$node->save();

		$index->add($node, 'workspace_id', $node->workspace_id);

		return $node;
	}

	/**
	 * Редактирует Node по id
	 *
	 * @param $node_id
	 * @param $params
	 *
	 * @return bool|\Everyman\Neo4j\Node
	 */
	public function editNode($node_id, $params)
	{
		$node = $this->client->getNode($node_id);

		if(!$node) {
			return false;
		}

		$properties = $node->getProperties();

		if(!$properties) {
			foreach ($params as $key => $value)
			{
				$node->setProperty($key, $value);
			}
		} else {
			foreach ($params as $key => $value)
			{
				if(isset($properties[$key])) {
					$node->removeProperty($key)->setProperty($key, $value);
				} else {
					$node->setProperty($key, $value);
				}
			}
		}

		$node->save();

		return $node;

	}

	/**
	 * Удаляет Node по id
	 *
	 * @param $node_id
	 *
	 * @return bool
	 */
	public function deleteNode($node_id)
	{
		$node = $this->client->getNode($node_id);

		if(!$node) {
			return false;
		}

		$node->delete();

		return true;
	}

	/**
	 * Создает связь между двумя Nodes с заданным типом и набором параметров
	 *
	 * @param $start_node_id
	 * @param $end_node_id
	 * @param $type
	 * @param $params
	 *
	 * @return bool|\Everyman\Neo4j\Relationship
	 */
	public function makeRelationship($start_node_id, $end_node_id, $type, $params = [])
	{

		$rel = $this->client
			->getNode($start_node_id)
			->relateTo($this->client->getNode($end_node_id), $type);

		if(!$rel) {
			return false;
		}

		if($params) {
			foreach ($params as $key => $value)
			{
				$rel->setProperty($key, $value);
			}
		}

		$rel->save();

		return $rel;
	}

	/**
	 * Редактирует связь по Id
	 *
	 * @param       $rel_id
	 * @param null  $type
	 * @param array $params
	 *
	 * @return bool|\Everyman\Neo4j\Relationship
	 */
	public function editRelationship($rel_id, $type = null, $params = [])
	{
		$rel = $this->client->getRelationship($rel_id);

		if(!$rel) {
			return false;
		}

		if($type) {
			$rel->setType($type);
		}

		if($params) {
			foreach ($params as $key => $value)
			{
				$rel->setProperty($key, $value);
			}
		}

		$rel->save();

		return $rel;
	}

	/**
	 * Удаляет связь по id
	 *
	 * @param $rel_id
	 *
	 * @return bool|\Everyman\Neo4j\Relationship
	 */
	public function deleteRelationship($rel_id)
	{
		$rel = $this->client->getRelationship($rel_id);

		if(!$rel) {
			return false;
		}

		$rel->delete();

		return $rel;
	}

	/**
	 * Удаляет все Node пространства и связи
	 *
	 * @param $workspace_id
	 *
	 * @return bool
	 */
	public function deleteNodesAndRelsForWorkspace($workspace_id)
	{
		$nodes = $this->getNodesWithRelsForWorkspace($workspace_id);

		if(!$nodes) {
			return false;
		}

		foreach ($nodes as $node) {
			$rels = $node->getRelationships();
			if($rels) {
				foreach ($rels as $rel) {
					$rel->delete();
				}
			}

			$node->delete();
		}

		return true;
	}

	/**
	 * Получает все Node пространства со связями
	 * Возвращает 2 массива nodes и edges для vis.js
	 *
	 * @param $workspace_id
	 *
	 * @return array|bool
	 */
	public function getNodesWithRelsForWorkspace($workspace_id)
	{
		$index = new NodeIndex($this->client, 'workspace');

		if(!$index) {
			return false;
		}

		$nodes = $index->find('workspace_id', $workspace_id);

		if(!$nodes) {
			return false;
		}

		// Формируем структуру данных для vis.js
		$return_nodes = [];
		$return_edges = [];

		foreach ($nodes as $node) {

			$properties = $node->getProperties();
			unset($properties['workspace_id']);

			$return_nodes[] = array_merge([ 'id' => $node->getId(), ], $properties);
			$rels = $node->getRelationships();
			foreach ($rels as $rel) {

				if(!in_array([
					'type' => $rel->getType(),
					'properties' => $rel->getProperties(),
					'id' => $rel->getId(),
					'from' => $rel->getStartNode()->getId(),
					'to' => $rel->getEndNode()->getId()
				], $return_edges)) {
					$return_edges[] = [
						'type' => $rel->getType(),
						'properties' => $rel->getProperties(),
						'id' => $rel->getId(),
						'from' => $rel->getStartNode()->getId(),
						'to' => $rel->getEndNode()->getId()
					];
				}


			}
		}

		return ['nodes' => $return_nodes, 'edges' => $return_edges];
	}
}
