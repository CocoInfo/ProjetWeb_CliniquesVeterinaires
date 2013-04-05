<?php

class Application_Form_Personne extends Zend_Form {

    public function init() {
        $this->setName('personne');

        $idPersonne = new Zend_Form_Element_Hidden('idPersonne');
        $idPersonne->addFilter('Int');

        $nomPersonne = new Zend_Dojo_Form_Element_TextBox('nomPersonne');
        $nomPersonne->setLabel('Nom')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');

        $prenomPersonne = new Zend_Dojo_Form_Element_TextBox('prenomPersonne');
        $prenomPersonne->setLabel('Prenom')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');

        $dateNaissancePersonne = new Zend_Dojo_Form_Element_DateTextBox('dateNaissancePersonne');
        $dateNaissancePersonne->setLabel('Date de naissance')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');
        
        $telFixePersonne = new Zend_Dojo_Form_Element_TextBox('telFixePersonne');
        $telFixePersonne->setLabel('Telephone fixe')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');
        
        $telMobilePersonne = new Zend_Dojo_Form_Element_TextBox('telMobilePersonne');
        $telMobilePersonne->setLabel('Telephone mobile')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');

        $mailPersonne = new Zend_Dojo_Form_Element_TextBox('mailPersonne');
        $mailPersonne->setLabel('Mail')
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');
        
        $typePersonne = new Zend_Dojo_Form_Element_TextBox('typePersonne');
        $typePersonne->setLabel('Type')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');

        $pwd = new Zend_Dojo_Form_Element_TextBox('pwd');
        $pwd->setLabel('Mot de passe')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');

        $numero = new Zend_Dojo_Form_Element_NumberTextBox('numero');
        $numero->setLabel('Numero')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');
        
        $rue = new Zend_Dojo_Form_Element_TextBox('rue');
        $rue->setLabel('Rue')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');
        
        $longitude = new Zend_Dojo_Form_Element_NumberTextBox('longitude');
        $longitude->setLabel('Longitude')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');
        
        $lattitude = new Zend_Dojo_Form_Element_NumberTextBox('lattitude');
        $lattitude->setLabel('Lattitude')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');
        
        $nomVille = new Zend_Dojo_Form_Element_TextBox('nomVille');
        $nomVille->setLabel('Ville')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');
        
        $codePostal = new Zend_Dojo_Form_Element_NumberTextBox('codePostal');
        $codePostal->setLabel('Code Postal')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');
        
        $nomDepartement = new Zend_Dojo_Form_Element_TextBox('nomDepartement');
        $nomDepartement->setLabel('Département')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');
        
        $codeDepartement = new Zend_Dojo_Form_Element_NumberTextBox('codeDepartement');
        $codeDepartement->setLabel('Code Département')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');


        $envoyer = new Zend_Dojo_Form_Element_Button('envoyer', array('type' => 'submit'));
        $envoyer->setAttrib('idPersonne', 'boutonenvoyer');

        $this->addElements(array($idPersonne, $nomPersonne, $prenomPersonne, $dateNaissancePersonne, $telFixePersonne, $telMobilePersonne, $mailPersonne, $typePersonne, $pwd, $numero, $rue, $longitude, $lattitude, $nomVille, $codePostal, $nomDepartement, $codeDepartement, $envoyer));
    }

}

