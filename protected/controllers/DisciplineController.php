<?php

class DisciplineController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + 
                delete, 
                deletelesson,
                deletetypelesson,
                deleteSpecialty', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array(   'studentprogress',
                                    'studentdiscipline'),
                'roles'=>array('student'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array(   'showprogress',
                                    'viewlesson', 
                                    'changelesson', 
                                    'deletelesson', 
                                    'view', 
                                    'list',
                                    'update'),
                'roles'=>array('teacher'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array(   'listtypelesson', 
                                    'typelesson', 
                                    'deletetypelesson',
                                    'listspecialty', 
                                    'specialty', 
                                    'deletespecialty',
                                    'addcurriculum',
                                    'curriculum',
                                    'delete', 
                                    'create', 
                                    'metblock',
                                    'listdiscip',
                                    'changediscip',
                                    'deletediscip',
                                    ),
                'roles'=>array('metodist'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    /*Создание/изменение типа урока*/
     public function actionTypelesson($id  = null)
    {
        if($id  === null){
            $this->pageTitle = 'Создать тип урока';
            $model=new TypeLesson;
        } else{
            $this->pageTitle = 'Изменить тип урока';
            $model= $this->loadModel('TypeLesson', $id);
        }    

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['TypeLesson']))
        {
            $model->attributes=$_POST['TypeLesson'];
            if($model->save())
                $this->redirect(array('listtypelesson'));
        }
        
        $this->render('typeLesson',array(
            'model'=>$model,
        ));
    }

    /*Список типов уроков*/
    public function actionListtypelesson()
    {
        $model=new TypeLesson('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['TypeLesson']))
            $model->attributes=$_GET['TypeLesson'];

        $this->render('listTypeLesson',array(
            'model'=>$model,
        ));
    }

    /*Удаление типа урока*/
    public function actionDeletetypelesson($id)
    {
        $this->loadModel('TypeLesson', $id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /*Создание/Изменение специальности*/
     public function actionSpecialty($id  = null)
    {
        if($id  === null){
            $this->pageTitle = 'Создать специальность';
            $model=new Specialty;
        } else{
            $this->pageTitle = 'Изменить специальность';
            $model= $this->loadModel('Specialty', $id);
        }    

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Specialty']))
        {
            $model->attributes=$_POST['Specialty'];
            if($model->save())
                $this->redirect(array('listSpecialty'));
        }
        
        $this->render('specialty',array(
            'model'=>$model,
        ));
    }

    /*Список специальностей*/
    public function actionListSpecialty()
    {
        $model=new Specialty('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Specialty']))
            $model->attributes=$_GET['Specialty'];

        $this->render('listSpecialty',array(
            'model'=>$model,
        ));
    }

    /*Удаление специальности*/
    public function actionDeleteSpecialty($id)
    {
        $this->loadModel('Specialty', $id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /*Создание/Изменение методического блока*/
     public function actionMetblock($id  = null)
    {
        if(isset($_POST['id_speciality'])){
            $model = MetBlock::model()->findAll(array('condition'=>'id_speciality = :id_speciality AND id_parent = 0', 'params'=>array(':id_speciality'=>$_POST['id_speciality'])));
            if($model)
                $this->renderPartial('_idParent', array('model' => $model, 'list'=>CHtml::listData($model, 'id_metBlock', 'title')));
            Yii::app()->end();
        }
        if($id  === null){
            $this->pageTitle = 'Создать методический блок';
            $model=new MetBlock;
        } else{
            $this->pageTitle = 'Изменить методический блок';
            $model= $this->loadModel('MetBlock', $id);
        }    


        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['MetBlock']))
        {
            $model->attributes=$_POST['MetBlock'];
            if($model->save())
                $this->redirect(array('curriculum'));
        }
        
        $this->render('metBlock',array(
            'model'=>$model,
        ));
    }

    /*Добавление пунктов в учебный план*/
    public function actionAddcurriculum(){
        $this->render('addcurriculum');
    }

    /*Учебный план*/
    public function actionCurriculum()
    {
        $this->pageTitle = "Учебный план";
        if(isset($_POST['id_speciality'])){
            $disciplines = Discipline::model()->findAll();
            $MetBlocks = MetBlock::model()->findAllByAttributes(array('id_speciality'=>$_POST['id_speciality']));
            
            //$arrCurriculum = $this->processingCurriculum($this->bildCurriculum($disciplines, $MetBlocks));
            
            $arrCurriculum = $this->summArray($this->processingCurriculum($this->bildCurriculum($disciplines, $MetBlocks)));
            // var_dump($arrCurriculum);
            if(!empty($MetBlocks))
                $this->renderPartial('_curriculum', array('arrCurriculum' => $arrCurriculum));
            Yii::app()->end();
        }
        $model=new MetBlock('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['MetBlock']))
            $model->attributes=$_GET['MetBlock'];
        
        $this->render('dropListSpecialty',array(
            'model'=>$model,
        ));
    }

    /*Удаление методического блока*/
    public function actionDeletemetblock($id)
    {
        $this->loadModel('MetBlock', $id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /*Создание дисциплины*/
    public function actionCreate($id  = null)
    {
        if($id  == null){
            $discipline=new Discipline;
            $this->pageTitle = 'Создание дисциплины';
        } else{
            $discipline=$this->loadModel('Discipline', $id);
            $this->pageTitle = 'Изменение дисциплины';
            $id_speciality = $discipline->metBlock->id_speciality;
        }
        
        // $this->performAjaxValidation($model);

        if(isset($_POST['Discipline']))
        {
            $id_speciality = $_POST['Discipline']['speciality'];
            $discipline->attributes=$_POST['Discipline'];

            if($discipline->save())
                $this->redirect(array('curriculum'));
            
        }

        if(isset($_POST['id_speciality'])){
            $list = MetBlock::model()->findAll(array('condition'=>'id_speciality = :id_speciality', 'params'=>array(':id_speciality'=>$_POST['id_speciality'])));
            if($list){
                $discipline->speciality = $_POST['id_speciality'];
                $this->renderPartial('_form', array('model' => $discipline, 'list'=>CHtml::listData($list, 'id_metBlock', 'title')));
            }else
                echo 'По данной специальности нет методических блоков';
            Yii::app()->end();
        }

        if($discipline->isNewRecord)
            $this->render('dropListSpecialty',array('discipline'=>$discipline));
        else{
            $list = MetBlock::model()->findAll(array('condition'=>'id_speciality = :id_speciality', 'params'=>array(':id_speciality'=>$id_speciality)));
            $this->render('_form', array('model' => $discipline, 'list'=>CHtml::listData($list, 'id_metBlock', 'title')));
        }

    }

    /*Список дисциплин*/
    public function actionList()
    {
        $criteria=new CDbCriteria;
        $criteria->compare('id_teacher', Yii::app()->user->id);

        $model=new DisciplineToTeacher('search');

        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Discipline']))
            $model->attributes=$_GET['Discipline'];

        $this->render('list',array(
            'model'=>$model,
            'criteria'=>$criteria,
        ));
    }

    /*Студенты изучающие дисциплину*/
    public function actionUpdate($id)
    {
        $discipline= DisciplineToTeacher::model()->findByPk($id);
        if($discipline->id_teacher != Yii::app()->user->id)
            throw new CHttpException(403, 'У вас недостаточно прав для выполнения указанного действия.');

    	if(isset($_POST['user'])){
    		$model = new DisciplineToUser;
    		$valid = true;
    		if(isset($_POST['addUser'])){
	    		foreach ($_POST['user'] as $user) {	    			
	    			$model->id_user = $user;
	    			$model->id_discipline = $id;
	    			$valid = $model->save() && $valid;
	    			$model->isNewRecord = true;
	    		}
	    	}
	    	if(isset($_POST['delUser'])){
	    		foreach ($_POST['user'] as $user) {	 
	    			$valid = $model->findByAttributes(array('id_user'=>$user, 'id_discipline'=>$id))->delete() && $valid;
	    		}
	    	}
    		if($valid){
    			$outUsers= $this->showStudent($discipline->id_group);
    			$inUsers= $this->showStudentByDiscipline($discipline->id_group, $id);
    			$outUsers = array_diff_key($outUsers, $inUsers);
    			$this->renderPartial('_addStudents', array('inUsers'=>$inUsers, 'outUsers'=>$outUsers));
    		}

    		Yii::app()->end();
    	}     

        $outUsers= $this->showStudent($discipline->id_group);
        $inUsers= $this->showStudentByDiscipline($discipline->id_group, $id);
        $outUsers = array_diff_key($outUsers, $inUsers);

        if(isset($_POST['Discipline'])){            
            $discipline->attributes=$_POST['Discipline'];
            if($discipline->save())
                $this->redirect(array('list'));
        }

        $this->render('update',array(
            'discipline'=>$discipline,
            'inUsers'=>$inUsers, 
            'outUsers'=>$outUsers
        ));
    }

    /*Удаление дисциплины*/
    public function actionDelete($id)
    {
        if(Yii::app()->request->isPostRequest){
            $this->loadModel('Discipline', $id)->delete();

            if(!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('list'));
        } else
            throw new CHttpException(400, 'Запрос не корректен. Пожалуйста не повторяйте этот запрос сново.');
    }

    /*Просмотр дисциплины*/
    public function actionView($id)
    {
        $discipline = $this->loadModel('DisciplineToTeacher', $id);
        if($discipline->id_teacher != Yii::app()->user->id)
            throw new CHttpException(403, 'У вас недостаточно прав для выполнения указанного действия.');

        $criteria=new CDbCriteria;
        $criteria->compare('id_discipline', $id);

        $model=new Lesson('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Lesson'])){
            $model->attributes=$_GET['Lesson'];
        }

        $this->render('view',array(
            'discipline' => $discipline,
            'model'=>$model,
            'criteria' => $criteria,
        ));
    }

    /*Удаление занятия*/
    public function actionDeletelesson($id)
    {
        if(Yii::app()->request->isPostRequest){
            $model = $this->loadModel('Lesson', $id);
            $discipline = $model->id_discipline;
            $model->delete();

            if(!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('view', 'id'=>$discipline));
        } else
            throw new CHttpException(400, 'Запрос не корректен. Пожалуйста не повторяйте этот запрос сново.');
    }

    /*Создание занятия*/
    public function actionChangelesson($idDis, $idLess = null)
    {
        if($idLess == null){
            $model = new Lesson;
            $model->id_discipline = $idDis; 
            $this->pageTitle = 'Создать урок';
        }
        else{
            $discipline= $this->loadModel('DisciplineToTeacher', $idDis);
            if($discipline->id_teacher != Yii::app()->user->id)
                throw new CHttpException(403, 'У вас недостаточно прав для выполнения указанного действия.');
            $model = Lesson::model()->findByPk($idLess);
            $this->pageTitle = 'Изменить урок';
        }

        if(isset($_POST['Lesson'])){
            $model->attributes=$_POST['Lesson'];
            if($model->save())
                $this->redirect(array('view', 'id'=>$model->id_discipline));
        }

        $this->render('changeLesson', array('model' => $model));
    }

    /*Просмотр занятия*/
    public function actionViewlesson($id){
        $lesson = $this->loadModel('Lesson', $id);
        
        if($lesson->discipline->id_teacher != Yii::app()->user->id)
            throw new CHttpException(403, 'У вас недостаточно прав для выполнения указанного действия.');
        
        $model = Progress::model()->findAllByAttributes(array('id_lesson' => $id));
        if($model===array())
            throw new CHttpException(404,'Страница не найдена.');
        if(isset($_POST['Progress'])){
            $transaction = Progress::model()->dbConnection->beginTransaction();
            try {
                foreach($model as $i=>$item){
                    if(isset($_POST['Progress'][$i])){
                        $item->attributes=$_POST['Progress'][$i];
                        $item->save();
                    }
                }
                $transaction->commit();
                $this->redirect(array('view', 'id'=>$lesson->id_discipline));
            } catch (Exception $e) {
                $transaction->rollBack();
            }
        }

        $this->render('viewlesson', array('model' => $model, 'lesson'=>$lesson,));
    }

    public function actionShowprogress(){
        $discipline = DisciplineToTeacher::model();

        $model=new Progress('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Progress']))
            $model->attributes=$_GET['Progress'];

        if(isset($_POST['id_discipline'])){
            $id = $_POST['id_discipline'];
            $criteria=new CDbCriteria;

            $criteria->compare('lesson.id_discipline', $id);
            $criteriaAttendance = clone($criteria);
            //$criteriaAttendance->compare('attendance', 1);
            $criteriaEstimate = clone($criteria);
            $criteriaEstimate->compare('attendance', 0);
            unset($criteria);

            $this->renderPartial('_progressAttendance', array(
                'model' => $model,
                'criteriaAttendance' => $criteriaAttendance,
                ));
            $this->renderPartial('_progressEstimate', array(
                'model' => $model,
                'criteriaEstimate' => $criteriaEstimate,
                ));
            Yii::app()->end();
        }

        $disp = DisciplineToTeacher::model()->findByAttributes(array('id_teacher'=>Yii::app()->user->id));
        $id = ($disp) ? $disp->id_notice : 0;

        $criteria=new CDbCriteria;
        $criteria->compare('lesson.id_discipline', $id);
        $criteriaAttendance = clone($criteria);
        //$criteriaAttendance->compare('attendance', '1');
        $criteriaEstimate = clone($criteria);
        $criteriaEstimate->compare('attendance', '0');
        unset($criteria);

        $this->render('showProgress', array(
            'discipline' => $discipline,
            'model' => $model,
            'criteriaAttendance' => $criteriaAttendance,
            'criteriaEstimate' => $criteriaEstimate,
            ));
    }

    /*Просмотр списка дисциплин для студента*/
    public function actionStudentdiscipline(){
        $criteria=new CDbCriteria;
        $criteria->compare('id_user', Yii::app()->user->id);

        $model=new DisciplineToUser('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['DisciplineToUser']))
            $model->attributes=$_GET['DisciplineToUser'];

        $this->render('showDiscipline', array(
            'model' => $model,
            'criteria' => $criteria,
            ));
    }

    /*Просмотр списка посещаемости для студента*/
    public function actionStudentprogress(){
        $model=new Progress('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Progress']))
            $model->attributes=$_GET['Progress'];

        if(isset($_POST['id_discipline'])){
            $id = $_POST['id_discipline'];
            $criteria=new CDbCriteria;
            $criteria->compare('lesson.id_discipline', $id);
            $criteria->compare('t.id_user', Yii::app()->user->id);
            $criteriaAttendance = clone($criteria);
            //$criteriaAttendance->compare('attendance', 1);
            $criteriaEstimate = clone($criteria);
            $criteriaEstimate->compare('attendance', 0);  
            unset($criteria);      

            $this->renderPartial('_progressAttendanceStudent', array(
                'model' => $model,
                'criteriaAttendance' => $criteriaAttendance,
                ));
            $this->renderPartial('_progressEstimateStudent', array(
                'model' => $model,
                'criteriaEstimate' => $criteriaEstimate,
                ));
            Yii::app()->end();
        }

        $disp = DisciplineToUser::model()->findByAttributes(array('id_user'=>Yii::app()->user->id));
        $id = ($disp) ? $disp->id_discipline : 0;

        $criteria=new CDbCriteria;
        $criteria->compare('lesson.id_discipline', $id);
        $criteria->compare('t.id_user', Yii::app()->user->id);
        $criteriaAttendance = clone($criteria);
        //$criteriaAttendance->compare('attendance', 1);
        $criteriaEstimate = clone($criteria);
        $criteriaEstimate->compare('attendance', 0);  
        unset($criteria); 

        $this->render('showProgressStudent', array(
            'model' => $model,
            'criteriaAttendance' => $criteriaAttendance,
            'criteriaEstimate' => $criteriaEstimate,
            ));
    }

    /*Список дисциплин для методиста*/
    public function actionListdiscip(){
        $discipline=new DisciplineToTeacher('search');
        $discipline->unsetAttributes();  // clear any default values
        if(isset($_GET['DisciplineToTeacher']))
            $discipline->attributes=$_GET['DisciplineToTeacher'];

        $this->render('allDiscipline', array('discipline'=>$discipline));
    }
    /*Создание / изменение дисциплин для методиста*/
    public function actionChangediscip($id = null){
        $specialty = new Specialty();
        $groups = array();
        $disciplins = array();
        if($id == null){
            $model = new DisciplineToTeacher;
            $this->pageTitle = 'Назначить дисциплину преподавателю';
        }
        else{
            $this->pageTitle = 'Изменить дисциплину';
            $model = DisciplineToTeacher::model()->findByPk($id);
            
            $specialty->id_specialty = $model->discipline->metBlock->id_speciality;
            
            $criteria=new CDbCriteria;        
            $criteria->condition='id_speciality=:id_specialty';
            $criteria->params=array(':id_specialty'=>$specialty->id_specialty);
            $groups = Group::getAll($criteria);

            $criteria=new CDbCriteria;
            $criteria->with=array('metBlock');        
            $criteria->condition='metBlock.id_speciality=:id_specialty';
            $criteria->params=array(':id_specialty'=>$specialty->id_specialty);
            $disciplins = Discipline::getAll($criteria);
        }
        if(isset($_POST['id_specialty'])){
            $criteria=new CDbCriteria;        
            $criteria->condition='id_speciality=:id_specialty';
            $criteria->params=array(':id_specialty'=>$_POST['id_specialty']);
            $groups = Group::getAll($criteria);

            $criteria=new CDbCriteria;
            $criteria->with=array('metBlock');        
            $criteria->condition='metBlock.id_speciality=:id_specialty';
            $criteria->params=array(':id_specialty'=>$_POST['id_specialty']);
            $disciplins = Discipline::getAll($criteria);

            $this->renderPartial('_forSpecialty', array('model'=>$model, 'groups'=>$groups, 'disciplins'=>$disciplins));
            Yii::app()->end();
        }

        if(isset($_POST['DisciplineToTeacher'])){
            $model->attributes=$_POST['DisciplineToTeacher'];
            if($model->save())
                $this->redirect('listdiscip');
        }


        $this->render('changeDisipline', array('model' => $model, 'specialty'=>$specialty, 'groups'=>$groups, 'disciplins'=>$disciplins));
    }
    /*Удаление дисциплины для методиста*/
    public function actionDeletediscip($id){
        if(Yii::app()->request->isPostRequest){
            DisciplineToTeacher::model()->findByPk($id)->delete();
    
            if(!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('listdiscip'));
        } else
            throw new CHttpException(400, 'Запрос не корректен. Пожалуйста не повторяйте этот запрос сново.');
    }
    /*Загрузка модуля*/
    public function loadModel($model, $id)
    {
        $model= $model::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'Страница не найдена.');
        return $model;
    }

    /*Вытаскивает всех студентов в группе*/
    protected function showStudent($idGroup){
        $group = Group::model()->findByPk($idGroup);
        $result = Yii::app()->db->createCommand()
        ->select("us.id_user, us.firstname, us.surname, us.middlename")
        ->from("{{user}} us")
        ->leftJoin("{{student}} st", "us.id_user = st.id_user")
        ->where("st.id_specialty = :id_specialty AND st.year_income = :year_income", 
            array(':id_specialty'=>$group->id_speciality,':year_income'=>$group->year_income))
        ->group("us.id_user")
        ->order("us.surname")
        ->queryAll();
        foreach ($result as $value) {
            $arrRes[$value['id_user']] = $value;
        }
        return $arrRes;
    }

    /*Вытаскивает всех студентов изучающие дисциплину*/
    protected function showStudentByDiscipline($idGroup, $idDis = 0){
        $group = Group::model()->findByPk($idGroup);
    	$result = Yii::app()->db->createCommand()
    	->select("us.id_user, us.firstname, us.surname, us.middlename")
    	->from("{{user}} us")
    	->leftJoin("{{student}} st", "us.id_user = st.id_user")
        ->leftJoin("{{disciplineToUser}} ud", "us.id_user = ud.id_user")
        ->where("ud.id_discipline = :id AND st.id_specialty = :id_specialty AND st.year_income = :year_income", 
            array(':id'=>$idDis, ':id_specialty'=>$group->id_speciality,':year_income'=>$group->year_income))
    	->group("us.id_user")
        ->order("us.surname")
    	->queryAll();
    	if(!$result) return array();
    	foreach ($result as $value) {
    		$arrRes[$value['id_user']] = $value;
    	}
    	return $arrRes;
    }

    protected function bildCurriculum($disciplines, $MetBlocks, $id_metBlock = 0, $res = array()){
        foreach ($MetBlocks as $mBlock) {
            $arrMetBlock = array();
            $stMetBlock = array();
            $buffer = array();

            if($mBlock['id_parent'] == $id_metBlock){ 
                foreach ($mBlock as $key => $value) {
                    $stMetBlock[$key] = $value;
                }
                $result = $this->bildCurriculum($disciplines, $MetBlocks, $mBlock['id_metBlock'], $res);
                foreach ($result as $val) {
                    if(isset($val["id_parent"]) && $val["id_parent"] == $mBlock['id_metBlock']){
                        $buffer[] = $val;
                    }
                    if(!empty($buffer)){
                        $stMetBlock['child'] = $buffer;
                        //$stMetBlock = $this->summArray($stMetBlock);
                    }
                }  

                $arrFild = array("exam", "dif_zachet", "zachet", "sam_rab", "lection", "pr_rab", "cours_rab", "ucheb_pr", "proizv_pr", "sem1", "sem2", "sem3", "sem4", "sem5", "sem6", "sem7", "sem8");
                foreach($disciplines as $dis){  
                $arrDis = array();         
                    if($dis['id_metBlock'] == $mBlock['id_metBlock']){                        
                        foreach ($dis as $key => $value) {
                            $arrDis[$key] = $value;
                        }
                        foreach ($dis as $key => $val) {
                            if(in_array($key, $arrFild))
                                $stMetBlock[$key] = (isset($stMetBlock[$key])) ? $stMetBlock[$key] + $val : $val;
                        }
                        if(!empty($arrDis))
                            $stMetBlock['child'][] = $arrDis;
                    }    
                }

            }

            if(!empty($stMetBlock)) 
                    $res[] = $stMetBlock; 
        }
        return $res;
    }

    protected function summArray($array){
        $arrFild = array("exam", "dif_zachet", "zachet", "max", "sam_rab", "lection", "all", "pr_rab", "cours_rab", "ucheb_pr", "proizv_pr", "sem1", "sem2", "sem3", "sem4", "sem5", "sem6", "sem7", "sem8");
        $bufferArray = array();

        foreach ($array as $item) {
            if(isset($item["child"])){
                //$item["child"] = $this->summArray($item["child"]);
                foreach ($item["child"] as $arrProp){
                    //var_dump($value); die;
                    foreach ($arrProp as $key => $prop) {
                        if(in_array($key, $arrFild))
                            $item[$key] += $prop; 
                    }                
                }
            }            
            $bufferArray[] = $item;
        }
        return $bufferArray;
        /*foreach ($array as $key => $value) {
            if($key != "child")
                $bufferArray[$key] = $value;
        }

        var_dump($array);
        if(isset($array["child"])){
            
            foreach ($array["child"] as $value) {
                foreach ($value as $key => $val) {
                   if(in_array($key, $arrFild)){
                        if($key == 'exam'){
                            echo $value['title'] . ': ';
                            echo $val . '...';
                        }
                     $bufferArray[$key] = (isset($bufferArray[$key])) ? $bufferArray[$key] + $val : $val;
                    }
                }            
            }        
            $bufferArray["child"] = $array["child"];
        }*/

       // return $bufferArray;
    }

    protected function processingCurriculum($array){
        $arrBuffer = array();
        $buffer = array();
        foreach ($array as $key => $value) {
            $sam_rab = isset($value["sam_rab"]) ? $value["sam_rab"] : 0;
            $lection = isset($value["lection"]) ? $value["lection"] : 0;
            $pr_rab = isset($value["pr_rab"]) ? $value["pr_rab"] : 0;
            $cours_rab = isset($value["cours_rab"]) ? $value["cours_rab"] : 0;

            $buffer[$key]['isBlock'] = isset($value["id_discipline"]);

            $buffer[$key]["id"] = isset($value["id_discipline"]) ?  $value["id_discipline"] : $value["id_metBlock"]; 
            $buffer[$key]["index"] = isset($value["index"]) ? $value["index"] : '';
            $buffer[$key]["title"] = $value["title"];
            $buffer[$key]["exam"] = isset($value["exam"]) ? $value["exam"] : '';
            $buffer[$key]["dif_zachet"] = isset($value["dif_zachet"]) ? $value["dif_zachet"] : '';
            $buffer[$key]["zachet"] = isset($value["zachet"]) ? $value["zachet"] : '';
            $buffer[$key]["max"] = $sam_rab + $lection + $pr_rab + $cours_rab;
            $buffer[$key]["sam_rab"] = isset($value["sam_rab"]) ? $value["sam_rab"] : '';
            $buffer[$key]["all"] = $lection + $pr_rab + $cours_rab;
            $buffer[$key]["lection"] = isset($value["lection"]) ? $value["lection"] : '';
            $buffer[$key]["pr_rab"] = isset($value["pr_rab"]) ? $value["pr_rab"] : '';
            $buffer[$key]["cours_rab"] = isset($value["cours_rab"]) ? $value["cours_rab"] : '';
            $buffer[$key]["ucheb_pr"] = isset($value["ucheb_pr"]) ? $value["ucheb_pr"] : '';
            $buffer[$key]["proizv_pr"] = isset($value["proizv_pr"]) ? $value["proizv_pr"] : '';
            $buffer[$key]["sem1"] = isset($value["sem1"]) ? $value["sem1"] : '';
            $buffer[$key]["sem2"] = isset($value["sem2"]) ? $value["sem2"] : '';
            $buffer[$key]["sem3"] = isset($value["sem3"]) ? $value["sem3"] : '';
            $buffer[$key]["sem4"] = isset($value["sem4"]) ? $value["sem4"] : '';
            $buffer[$key]["sem5"] = isset($value["sem5"]) ? $value["sem5"] : '';
            $buffer[$key]["sem6"] = isset($value["sem6"]) ? $value["sem6"] : '';
            $buffer[$key]["sem7"] = isset($value["sem7"]) ? $value["sem7"] : '';
            $buffer[$key]["sem8"] = isset($value["sem8"]) ? $value["sem8"] : '';
            $buffer[$key]["double"] = isset($value["double"]) ? $value["double"] : '';

            if(isset($value["child"])){                                  
                $buffer[$key]["child"] = $this->processingCurriculum($value["child"]);
            }

            $arrBuffer[] = $buffer[$key];
        }

        return $arrBuffer;
    }

    /**
     * Performs the AJAX validation.
     * @param Discipline $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='discipline-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}

