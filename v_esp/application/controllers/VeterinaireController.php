<?php

class VeterinaireController extends Zend_Controller_Action {

    public function init() {
        Zend_Dojo::enableView($this->view);
        
    }

    public function indexAction() {

    }

    public function indexjsonAction() {

        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();

       $veterinaires = new Application_Model_DbTable_Veterinaire();
        
       $select = $veterinaires->getAdapter()->select()
                ->from(array('p' => 'personne'),
                    array('idPersonne','nomPersonne','prenomPersonne', 'dateNaissancePersonne','telFixePersonne','telMobilePersonne','mailPersonne','typePersonne','Adresse_idAdresse', 'pwd'))
                ->join(array('a' => 'adresse'),
                        'p.Adresse_idAdresse = a.idAdresse')
                ->join(array('v' => 'ville'),'a.Ville_idVille = v.idVille')
                ->join(array('d' => 'departement'),'v.Departement_idDepartement = d.idDepartement')
                ->where('typePersonne = ?','Veterinaire');
       $veterinaires =$select->query()->fetchAll();  

        $dojoData = new Zend_Dojo_Data('idPersonne', $veterinaires, 'idPersonne');
        $response = $this->getResponse();
        $response->setHeader('Content-type', 'application/json', true);
        $response->setBody($dojoData);
    }

    public function ajouterAction() {
        $form = new Application_Form_Veterinaire();
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
                $veterinaires = new Application_Model_DbTable_Veterinaire();
                $bootstrap = $this->getInvokeArg('bootstrap');
                $db = $bootstrap->getResource('db');
                $veterinaires->ajouterVeterinaire($db,$nomPersonne, $prenomPersonne, $dateNaissancePersonne, $telFixePersonne, $telMobilePersonne, $mailPersonne, $typePersonne, $pwd ,$numero,$rue,$longitude,$lattitude,$nomVille,$codePostal,$nomDepartement,$codeDepartement);
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        }
    }

    public function modifierAction() {
        $form = new Application_Form_Veterinaire();
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
                $veterinaires = new Application_Model_DbTable_Veterinaire();
                $bootstrap = $this->getInvokeArg('bootstrap');
                $db = $bootstrap->getResource('db');
                try {
                    $veterinaires->modifierVeterinaire($db,$idPersonne,$nomPersonne, $prenomPersonne, $dateNaissancePersonne, $telFixePersonne,$telMobilePersonne,$mailPersonne,$typePersonne, $pwd,$numero,$rue,$longitude,$lattitude,$nomVille,$codePostal,$nomDepartement,$codeDepartement);
                } catch (Exception $e) {
                    $this->getLog()->log("modifier Veterinaire : " . $e, Zend_Log::ERR);
                }
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        } else {
            $idPersonne = $this->_getParam('idPersonneM', 0);
            if ($idPersonne > 0) {
                $veterinaires = new Application_Model_DbTable_Veterinaire();
                $form->populate($veterinaires->obtenirVeterinaire($idPersonne));
            }
        }
    }

    public function supprimerAction() {
        if ($this->getRequest()->isPost()) {
            $supprimer = $this->getRequest()->getPost('supprimer');
            if ($supprimer == 'Oui') {
                $idPersonne = $this->getRequest()->getPost('idPersonneS');
                $veterinaires = new Application_Model_DbTable_Veterinaire();
                $veterinaires->supprimerVeterinaire($idPersonne);
            }

            $this->_helper->redirector('index');
            
        } else {
            $idPersonne = $this->_getParam('idPersonneS', 0);
            $veterinaires = new Application_Model_DbTable_Veterinaire();
            $this->view->veterinaire = $veterinaires->obtenirVeterinaire($idPersonne);
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

