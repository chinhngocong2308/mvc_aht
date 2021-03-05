<?php

namespace mvc\Models;

use mvc\Core\Model;

class TaskModel extends Model {

	protected $title;
	protected $description;
	protected $id;

    public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function getTitle() {
		return $this->title;
	}

	public function setTitle($title) {
		$this->title = $title;
	}

	public function getDescription() {
		return $this->description;
	}

	public function setDescription($description) {
		$this->description = $description;
	}

}
