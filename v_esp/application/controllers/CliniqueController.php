<?php

class CliniqueController extends Zend_Controller_Action {

    public function init() {
        Zend_Dojo::enableView($this->view);
        
    }

    public function indexAction() {
    }

    public function indexjsonAction() {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        
       $cliniques = new Application_Model_DbTable_Clinique();
        
       $select = $cliniques->getAdapter()->select()
                ->from(array('c' => 'clinique'),
                    array('idClinique','nomClinique','proprietaireClinique', 'telClinique','mailClinique','Adresse_idAdresse'))
                ->join(array('a' => 'adresse'),
                        'c.Adresse_idAdresse = a.idAdresse')
                ->join(array('v' => 'ville'),'a.Ville_idVille = v.idVille')
                ->join(array('d' => 'departement'),'v.Departement_idDepartement = d.idDepartement');
       $cliniques =$select->query()->fetchAll();   

        $dojoData = new Zend_Dojo_Data('idClinique', $cliniques, 'idClinique');
        $response = $this->getResponse();
        $response->setHeader('Content-type', 'application/json', true);
        $response->setBody($dojoData);

    }

    public function ajouterAction() {
        $form = new Application_Form_Clinique();
        $form->envoyer->setLabel('Ajouter');
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $nomClinique = $form->getValue('nomClinique');
                $proprietaireClinique = $form->getValue('proprietaireClinique');
                $telClinique = $form->getValue('telClinique');
                $mailClinique = $form->getValue('mailClinique');
                $numero = $form->getValue('numero');
                $rue = $form->getValue('rue');
                $longitude = $form->getValue('longitude');
                $lattitude = $form->getValue('lattitude');
                $nomVille = $form->getValue('nomVille');
                $codePostal = $form->getValue('codePostal');
                $nomDepartement = $form->getValue('nomDepartement');
                $codeDepartement = $form->getValue('codeDepartement');
                $cliniques = new Application_Model_DbTable_Clinique();
                $bootstrap = $this->getInvokeArg('bootstrap');
                $db = $bootstrap->getResource('db');
                $cliniques->ajouterClinique($db,$nomClinique, $proprietaireClinique, $telClinique, $mailClinique,$numero,$rue,$longitude,$lattitude,$nomVille,$codePostal,$nomDepartement,$codeDepartement);
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        }
    }

    public function modifierAction() {
        $form = new Application_Form_Clinique();
        $form->envoyer->setLabel('Sauvegarder');
        $this->view->form = $form;
        
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $idClinique = $form->getValue('idCliniqueM');
                $nomClinique = $form->getValue('nomClinique');
                $proprietaireClinique = $form->getValue('proprietaireClinique');
                $telClinique = $form->getValue('telClinique');
                $mailClinique = $form->getValue('mailClinique');
                $numero = $form->getValue('numero');
                $rue = $form->getValue('rue');
                $longitude = $form->getValue('longitude');
                $lattitude = $form->getValue('lattitude');
                $nomVille = $form->getValue('nomVille');
                $codePostal = $form->getValue('codePostal');
                $nomDepartement = $form->getValue('nomDepartement');
                $codeDepartement = $form->getValue('codeDepartement');
                $cliniques = new Application_Model_DbTable_Clinique();
                $bootstrap = $this->getInvokeArg('bootstrap');
                $db = $bootstrap->getResource('db');
                $cliniques->modifierClinique($db,$idClinique, $nomClinique, $proprietaireClinique, $telClinique, $mailClinique,$numero,$rue,$longitude,$lattitude,$nomVille,$codePostal,$nomDepartement,$codeDepartement);
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        } else {
            $idClinique = $this->_getParam('idCliniqueM', 0);
            if ($idClinique > 0) {
                $cliniques = new Application_Model_DbTable_Clinique();
                $form->populate($cliniques->obtenirClinique($idClinique));
            }
        }
    }

    public function supprimerAction() {
        if ($this->getRequest()->isPost()) {
            $supprimer = $this->getRequest()->getPost('supprimer');
            if ($supprimer == 'Oui') {
                $idClinique = $this->getRequest()->getPost('idCliniqueS');
                $cliniques = new Application_Model_DbTable_Clinique();
                $cliniques->supprimerClinique($idClinique);
            }

            $this->_helper->redirector('index');
        } else {
            $idClinique = $this->_getParam('idCliniqueS', 0);
            $cliniques = new Application_Model_DbTable_Clinique();
            $this->view->clinique = $cliniques->obtenirClinique($idClinique);
        }
    }
    
    public function getLog()
    {
        $bootstrap = $this->getInvokeArg('bootstrap');
        if (!$bootstrap->hasResource('Log')) {
            return false;
        }
        $log = $bootstrap->getResource('Log');
        return $log;
    }

}