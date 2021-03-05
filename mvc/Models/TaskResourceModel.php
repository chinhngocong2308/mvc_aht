<?php

namespace mvc\Models;

use mvc\Core\ResourceModel;
use mvc\Models\TaskModel;

class TaskResourceModel extends ResourceModel {
	public function __construct() {
		$task = 'tasks';
		$id   = 'id';

		$taskmodel = new TaskModel();

		$this->_init($task, $id, $taskmodel);
	}
}
