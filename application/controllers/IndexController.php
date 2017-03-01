<?php

namespace controllers;

use claviska\SimpleImage;

class IndexController extends \Controller {

    public function actionIndex() {
        $this->view->tag_title = 'Реестр задач';
        $this->view->h1 = 'Реестр задач';
        $this->view->user = $this->request->session_get('user');

        if (!$this->request->session_get('taskListPage')) {
            $this->request->session_set('taskListPage', 1);
        }
        $this->view->taskListPage = $this->request->session_get('taskListPage');
        
        $sort = $this->request->session_get('sort') ? $this->request->session_get('sort') : 'desc';
        $sortName = $this->request->session_get('sortName') ? $this->request->session_get('sortName') : 'id';
        $filterStatus = $this->request->session_get('filterStatus') && $this->request->session_get('filterStatus') != 'all' ? $this->request->session_get('filterStatus') : '';
        $filterText = $this->request->session_get('filterText') ? $this->request->session_get('filterText') : '';
        $whereStatus = $filterStatus != '' ? ' status="'.$filterStatus.'"' : '';
        $whereText = $filterText != '' ? ' ( author LIKE "%'.$filterText.'%" OR email LIKE "%'.$filterText.'%" )'  : '';
        $and = $whereStatus && $whereText ? ' AND': '';
        $where = $whereStatus || $whereText ? ' WHERE': '';
        $sortArray = [
            'sort'=>$sort,
            'sortName'=>$sortName,
            'filterStatus'=>$filterStatus,
            'filterText'=>$filterText,
        ];
        $this->view->sort = $sortArray;

        $countOnPage = 8;
        $queryCount = new \Db();
        $queryCount->query("SELECT COUNT(*) FROM task $where $whereText $and $whereStatus");
        
        $countTasks = (array) $queryCount->result();
        $countTasks = $countTasks['COUNT(*)'];
        $countPages = ceil($countTasks / $countOnPage);
        $this->view->countPages = $countPages;
        $this->view->taskListPage = $this->view->taskListPage > $countPages ? $countPages : $this->view->taskListPage;
        $firstTask = ($this->view->taskListPage - 1) * 5;
        $firstTask = $firstTask < 0 ? 0 : $firstTask;
        $query = new \Db();
        $query->query("SELECT * FROM task $where $whereText $and $whereStatus ORDER BY $sortName $sort LIMIT $firstTask, $countOnPage");
        
//        print_r("SELECT * FROM task $where $whereText $and $whereStatus ORDER BY $sortName $sort LIMIT $firstTask, $countOnPage") ;exit;
        $this->view->models = $query->results();
        $this->view->content = $this->view->render('/index/index');
    }

    public function actionNotFound() {
        $this->view->noNav = 'true';
        header("HTTP/1.0 404 Not Found");
        $this->view->content = $this->view->render('/index/not-found');
    }

    public function actionCreate() {
        $model = new \models\Task();
        if (!empty($_POST) && $model->load() && $model->triggers() && $model->insert()) {

            if (!empty($_FILES)) {
                $name = $model->find()->id;
                $tempFile = $_FILES['image']['tmp_name'];

                $fileTypes = array('jpg', 'jpeg', 'gif', 'png');
                $fileParts = pathinfo($_FILES['image']['name']);

                $targetFolder = '\..\..\public_html\uploads\\';
                $targetPath = dirname(__FILE__) . '/' . $targetFolder;
                $targetFile = rtrim($targetPath, '/') . '/' . $name . '.' . $fileParts['extension'];

                if (in_array($fileParts['extension'], $fileTypes)) {
                    try {
                        $image = new SimpleImage();
                        $image->fromFile($tempFile)->bestFit(320, 240)->toFile($targetFile, 'image/jpeg');
                    } catch (Exception $err) {
                        echo $err->getMessage();
                    }
                }
            }
            return $this->redirect('/');
        } else {
            $post = $_POST;
            $this->view->author = $post['author'];
            $this->view->email = $post['email'];
            $this->view->text = $post['text'];
            $this->view->errors = $model->getErrors();
            $this->request->session_set('task', $this->view);
//            $this->view->content = $this->view->render('/index/index');
            return $this->redirect('/');
        }
    }

    public function actionPreUploadImage() {

        if (!empty($_FILES)) {
            $fileTypes = array('jpg', 'jpeg', 'gif', 'png');
            $fileParts = pathinfo($_FILES['image']['name']);
            $response = array();
            if (in_array($fileParts['extension'], $fileTypes)) {
                $response['success'] = 1;
                echo json_encode($response);
            } else {
                $response['success'] = 0;
                $response['error'] = 'Invalid file type.';
                echo json_encode($response);
            }
        }
    }

    public function actionNextPage() {
        if ($_POST['page']) {
            $this->request->session_set('taskListPage', $_POST['page']);
            $response['success'] = 1;
            echo json_encode($response);
        }
    }

    public function actionSaveText() {
        if ($_POST['id'] && $_POST['text']) {
            $model = new \models\Task();
            if ($model->update($_POST['id'], ['text' => $_POST['text']])) {
                echo 1;
            }else{
                echo 2;
            }
        }
    }

    public function actionSuccessTask() {
        if ($_POST['id']) {
            $model = new \models\Task();
            $task = $model->find($_POST['id']);
            if ($task->status == 'new' && $model->update($_POST['id'], ['status' => 'success'])){
                echo 'success';
            }
            if ($task->status == 'success' && $model->update($_POST['id'], ['status' => 'new'])){
                echo 'new';
            }
        }
    }

    public function actionChangeSort() {
        if (isset($_POST['filterText'])) {
            $this->request->session_set('filterText', $_POST['filterText']);
            echo 1;
        }
        if ($_POST['filterStatus']) {
            $this->request->session_set('filterStatus', $_POST['filterStatus']);
            echo 1;
        }
        if ($_POST['sortName']) {
            $this->request->session_set('sortName', $_POST['sortName']);
            echo 1;
        }
        if ($_POST['sort']) {
            $this->request->session_set('sort', $_POST['sort']);
            echo 1;
        }
    }

}
