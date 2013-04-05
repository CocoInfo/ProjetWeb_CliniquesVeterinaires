<?php

class Application_Form_Clinique extends Zend_Form {

    public function init() {
        $this->setName('clinique');

        $idClinique = new Zend_Form_Element_Hidden('idClinique');
        $idClinique->addFilter('Int');

        $nomClinique = new Zend_Dojo_Form_Element_TextBox('nomClinique');
        $nomClinique->setLabel('Nom')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');

        $proprietaireClinique = new Zend_Dojo_Form_Element_TextBox('proprietaireClinique');
        $proprietaireClinique->setLabel('Propriétaire')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');

        $telClinique = new Zend_Dojo_Form_Element_TextBox('telClinique');
        $telClinique->setLabel('Téléphone')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');

        $mailClinique = new Zend_Dojo_Form_Element_TextBox('mailClinique');
        $mailClinique->setLabel('Mail')
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
        $envoyer->setAttrib('idClinique', 'boutonenvoyer');

        $this->addElements(array($idClinique, $nomClinique, $proprietaireClinique, $telClinique, $mailClinique, $numero, $rue, $longitude, $lattitude, $nomVille, $codePostal, $nomDepartement, $codeDepartement, $envoyer));
    }

}