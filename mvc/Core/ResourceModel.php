<?php
namespace mvc\Core;

use mvc\Config\Database;
use PDO;

class ResourceModel implements ResourceModelInterface {
	protected $table;
	protected $id;
	protected $model;

	public function _init($table, $id, $model) {
		$this->table = $table;
		$this->id    = $id;
		$this->model = $model;
	}

	public function save($model) {
		$properties = $model->getProperties();
		$check_id      = $model->getId();

		$key_name = [];
		$add      = [];

		$edit = [];
		
		if ($check_id == null) {
			foreach ($properties as $key => $value) {
				array_push($add, ':'.$key); //PDO style values
				$key_name[] = $key;
			}
			$arr_col = implode(',', $key_name);
			$arr_add_value = implode(',', $add);
			$date = array("created_at" => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'));
			// echo'<br>';
			// echo($arradd);
			// echo'<pre>';
			// var_dump($keyAssignment);
			// echo'<pre>';
			$sql = "INSERT INTO $this->table ({$arr_col}, created_at, updated_at) VALUES ({$arr_add_value}, :created_at, :updated_at)";
			$req    = Database::getBdd()->prepare($sql);

			return $req->execute(array_merge($properties, $date));

		} elseif ($check_id != null) {
			foreach ($properties as $key => $value) {
				array_push($edit, $key.' = :'.$key);
			}
			$date = array("id" => $check_id , 'updated_at' => date('Y-m-d H:i:s'));
			$arr_edit = implode(',', $edit);
			// echo'<br>';
			// echo($arredit);
			$sql = "UPDATE {$this->table} SET " . $arr_edit . ', updated_at = :updated_at WHERE id = :id';
			$req     = Database::getBdd()->prepare($sql);

			return $req->execute(array_merge($properties, $date));

		}
	}

	public function delete($id) {
		$sql = "DELETE FROM $this->table WHERE id = $id";
		$req    = Database::getBdd()->prepare($sql);
		return $req->execute();
	}

	public function get($id) {
		$sql = "SELECT * FROM $this->table WHERE id = $id";
		$req = Database::getBdd()->prepare($sql);
		$req->execute();
		return $req->fetch(PDO::FETCH_OBJ);
	}

	public function getAll() {
		$sql = "SELECT * FROM $this->table";
		$req    = Database::getBdd()->prepare($sql);
		$req->execute();
		return $req->fetchAll(PDO::FETCH_OBJ);
	}

}