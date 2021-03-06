<?php
namespace mvc\Controllers;

use mvc\Core\Controller;
use mvc\Models\TaskModel;
use mvc\Models\TaskRepository;

class TasksController extends Controller {
	public function index() {

		$tasks = new TaskRepository();

		$data['tasks'] = $tasks->getAll();
		$this->set($data);
		$this->render("index");
	}

	public function create() {
		if (isset($_POST["title"])) {

			$model = new TaskModel();
			$model->setTitle($_POST['title']);
			$model->setDescription($_POST['description']);

			$add = new TaskRepository();

			if ($add->add($model)) {
				header("Location: ".WEBROOT."tasks/index");
			}
		}

		$this->render("create");
	}

	public function edit($id) {
		$task = new TaskRepository();

		$data["task"] = $task->get($id);
		// echo '<pre>';
		// var_dump($data["task"]);
		// echo '<pre>';

		if (isset($_POST["title"])) {
			$model = new TaskModel();
			$model->setId($id);
			$model->setTitle($_POST['title']);
			$model->setDescription($_POST['description']);

			$edit = new TaskRepository();
			if ($edit->edit($model)) {
				header("Location: ".WEBROOT."tasks/index");
			}
		}
		$this->set($data);
		$this->render("edit");
	}

	public function delete($id) {
		$task = new TaskRepository();
		if ($task->delete($id)) {
			header("Location: ".WEBROOT."tasks/index");
		}
	}
}
