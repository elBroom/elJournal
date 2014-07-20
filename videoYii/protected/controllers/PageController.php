<?php

class PageController extends Controller
{
	public function actionIndex($id)
	{
		$models = Page::model()->findAllByAttributes(array('category_id' => $id));
		$category = Category::model()->findByPk($id);
		$this->render('index', array('models' => $models, 'category' => $category));
	}

	public function actionView($id)
	{
		$model = Page::model()->findByPk($id);
		$this->render('view', array('model' => $model));
	}
}