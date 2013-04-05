<?php

class PersonneController extends Zend_Controller_Action {

    public function init() {
        Zend_Dojo::enableView($this->view);
    }

    public function indexAction() {

    }

    public function indexjsonAction() {

        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();

       $personnes = new Application_Model_DbTable_Personne();
        
       $select = $personnes->getAdapter()->select()
                ->from(array('p' => 'personne'),
                    array('idPersonne','nomPersonne','prenomPersonne', 'dateNaissancePersonne','telFixePersonne','telMobilePersonne','mailPersonne','typePersonne','Adresse_idAdresse', 'pwd'))
                ->join(array('a' => 'adresse'),'p.Adresse_idAdresse = a.idAdresse')
                ->join(array('v' => 'ville'),'a.Ville_idVille = v.idVille')
                ->join(array('d' => 'departement'),'v.Departement_idDepartement = d.idDepartement')
                ->where('typePersonne = ?','Proprietaire');
       $personnes =$select->query()->fetchAll();  

        $dojoData = new Zend_Dojo_Data('idPersonne', $personnes, 'idPersonne');
        $response = $this->getResponse();
        $response->setHeader('Content-type', 'application/json', true);
        $response->setBody($dojoData);
    }

    public function ajouterAction() {
        $form = new Application_Form_Personne();
        $form->envoyer->setLabel('Ajouter');
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $nomPersonne = $form->getValue('nomPersonne');
                $prenomPersonne = $form->getValue('prenomPersonne');
                $dateNaissancePersonne = $form->getValue('dateNaissancePersonne');
                $telFixePersonne = $form->getValue('telFixePersonne');
                $telMobilePersonne = $form->getValue('telMobilePersonne');
                $mailPersonne = $form->getValue('mailPersonne');
                $typePersonne = $form->getValue('typePersonne');
                $pwd = $form->getValue('pwd');
                $numero = $form->getValue('numero');
                $rue = $form->getValue('rue');
                $longitude = $form->getValue('longitude');
                $lattitude = $form->getValue('lattitude');
                $nomVille = $form->getValue('nomVille');
                $codePostal = $form->getValue('codePostal');
                $nomDepartement = $form->getValue('nomDepartement');
                $codeDepartement = $form->getValue('codeDepartement');
                $personnes = new Application_Model_DbTable_Personne();
                $bootstrap = $this->getInvokeArg('bootstrap');
                $db = $bootstrap->getResource('db');
                $personnes->ajouterPersonne($db,$nomPersonne, $prenomPersonne, $dateNaissancePersonne, $telFixePersonne, $telMobilePersonne, $mailPersonne, $typePersonne, $pwd,$numero,$rue,$longitude,$lattitude,$nomVille,$codePostal,$nomDepartement,$codeDepartement);
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        }
    }

    public function modifierAction() {
        $form = new Application_Form_Personne();
        $form->envoyer->setLabel('Sauvegarder');
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $idPersonne = $this->_getParam('idPersonneM', 0);
                $nomPersonne = $form->getValue('nomPersonne');
                $prenomPersonne = $form->getValue('prenomPersonne');
                $dateNaissancePersonne = $form->getValue('dateNaissancePersonne');
                $telFixePersonne = $form->getValue('telFixePersonne');
                $telMobilePersonne = $form->getValue('telMobilePersonne');
                $mailPersonne = $form->getValue('mailPersonne');
                $typePersonne = $form->getValue('typePersonne');
                $pwd = $form->getValue('pwd');
                $numero = $form->getValue('numero');
                $rue = $form->getValue('rue');
                $longitude = $form->getValue('longitude');
                $lattitude = $form->getValue('lattitude');
                $nomVille = $form->getValue('nomVille');
                $codePostal = $form->getValue('codePostal');
                $nomDepartement = $form->getValue('nomDepartement');
                $codeDepartement = $form->getValue('codeDepartement');
                $personnes = new Application_Model_DbTable_Personne();
                $bootstrap = $this->getInvokeArg('bootstrap');
                $db = $bootstrap->getResource('db');
                try {
                    $personnes->modifierPersonne($db,$idPersonne,$nomPersonne, $prenomPersonne, $dateNaissancePersonne, $telFixePersonne,$telMobilePersonne,$mailPersonne,$typePersonne, $pwd,$numero,$rue,$longitude,$lattitude,$nomVille,$codePostal,$nomDepartement,$codeDepartement);  
                } catch (Exception $e) {
                    $this->getLog()->log("modifier Personne : " . $e, Zend_Log::ERR);
                }
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        } else {
            $idPersonne = $this->_getParam('idPersonneM', 0);
            if ($idPersonne > 0) {
                $personnes = new Application_Model_DbTable_Personne();
                $form->populate($personnes->obtenirPersonne($idPersonne));
            }
        }
    }

    public function supprimerAction() {
        if ($this->getRequest()->isPost()) {
            $supprimer = $this->getRequest()->getPost('supprimer');
            if ($supprimer == 'Oui') {
                $idPersonne = $this->getRequest()->getPost('idPersonneS');
                $personnes = new Application_Model_DbTable_Personne();
                $bootstrap = $this->getInvokeArg('bootstrap');
                $db = $bootstrap->getResource('db');
                $personnes->supprimerPersonne($db,$idPersonne);
            }

            $this->_helper->redirector('index');
        } else {
            $idPersonne = $this->_getParam('idPersonneS', 0);
            $personnes = new Application_Model_DbTable_Personne();
            $this->view->personne = $personnes->obtenirPersonne($idPersonne);
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

