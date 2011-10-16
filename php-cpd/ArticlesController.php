<?php
class ArticlesController extends Zend_Controller_action
{
    /**
     * Index action
     */
    public function indexAction()
    {
        /* naètení pøehledu èlánkù ... */
    }
    
    public function addArticleAction()
    {
        $form = new Zend_Form();
        
        $form->addElement(new Zend_Form_Element_Text(array(
            'name'     => 'name_cs',
            'label'    => 'nazev',
            'required' => true,
            'size'     => 60,
            'maxlength'  => 80,
        )));
        
        $form->addElement(new Zend_Form_Element_Textarea(array(
            'name'     => 'perex_cs',
            'label'    => 'perex',
            'cols'     => 80,
            'rows'     => 5,
            'required' => true,
        )));
        
        $form->addElement(new Zend_Form_Element_Textarea(array(
            'name'     => 'text_cs',
            'label'    => 'text',
            'cols'     => 80,
            'rows'     => 5,
            'required' => true,
        )));
        
        $form->addElement(new Zend_Form_Element_Multiselect(array(
            'name'    => 'categories',
            'label'   => 'kategorie',
            'size'    => 10,
            'description'  => 'Vyberte kategorie èlánku',
            'multiOptions' => (array) $this->_getCategories(/*...*/),
        )));
        
        $form->addElement(new Zend_Form_Element_Textarea(array(
            'name'     => 'note_cs',
            'label'    => 'poznamka',
            'cols'     => 80,
            'rows'     => 5,
            'required' => true,
        )));
        
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($_POST)) {
                $this->_articlesModel->addArticle($form->getValues());
                $this->_redirect('/');
            }
        }
    }

    public function editArticleAction()
    {
        $form = new Zend_Form();
        
        $form->addElement(new Zend_Form_Element_Text(array(
            'name'     => 'name_cs',
            'label'    => 'nazev',
            'required' => true,
            'size'     => 60,
            'maxlength'  => 80,
        )));
        
        $form->addElement(new Zend_Form_Element_Textarea(array(
            'name'     => 'perex_cs',
            'label'    => 'perex',
            'cols'     => 80,
            'rows'     => 5,
            'required' => true,
        )));
        
        $form->addElement(new Zend_Form_Element_Textarea(array(
            'name'     => 'text_cs',
            'label'    => 'text',
            'cols'     => 80,
            'rows'     => 5,
            'required' => true,
        )));
        
        $form->addElement(new Zend_Form_Element_Multiselect(array(
            'name'    => 'categories',
            'label'   => 'kategorie',
            'size'    => 10,
            'description'  => 'Vyberte kategorie èlánku',
            'multiOptions' => (array) $this->_getCategories(/*...*/),
        )));
        
        $form->addElement(new Zend_Form_Element_Textarea(array(
            'name'     => 'note_cs',
            'label'    => 'poznamka',
            'cols'     => 80,
            'rows'     => 5,
            'required' => true,
        )));
        
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($_POST)) {
                $this->_articlesModel->updateArticle((int) $this->_getParam('id'), $form->getValues());
                $this->_redirect('/');
            }
        } else {
            $form->setDefaults($this->_articlesModel->fetchArticle((int) $this->_getParam('id')));
        }
    }
}