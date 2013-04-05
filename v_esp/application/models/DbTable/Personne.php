<?php

class Application_Model_DbTable_Personne extends Zend_Db_Table_Abstract {

    protected $_name = 'personne';

    public function obtenirPersonne($idPersonne) {
        $idPersonne = (int) $idPersonne;

        $select = $this->getAdapter()->select()
                ->from(array('p' => 'personne'),
                    array('idPersonne','nomPersonne','prenomPersonne', 'dateNaissancePersonne','telFixePersonne','telMobilePersonne','mailPersonne','typePersonne','Adresse_idAdresse', 'pwd'))
                ->join(array('a' => 'adresse'),'p.Adresse_idAdresse = a.idAdresse')
                ->join(array('v' => 'ville'),'a.Ville_idVille = v.idVille')
                ->join(array('d' => 'departement'),'v.Departement_idDepartement = d.idDepartement')
                ->where('p.idPersonne = ?', $idPersonne)
                ->where('typePersonne = ?','Proprietaire');
                
       $row =$select->query()->fetch();        
        
        if (!$row) {
            throw new Exception("Impossible de trouver la personne $idPersonne");
        }
        return $row;
    }
    
    public function obtenirPersonnes()
    {
        $select = $this->select()
                ->from(array('p' => 'personne'),
                    array('idPersonne','nomPersonne','prenomPersonne', 'dateNaissancePersonne','telFixePersonne','telMobilePersonne','mailPersonne','typePersonne','Adresse_idAdresse', 'pwd'))
                ->join(array('a' => 'adresse'),
                        array('idAdresse'),'p.Adresse_idAdresse = a.idAdresse')
                ->join(array('v' => 'ville'),'a.Ville_idVille = v.idVille')
                ->join(array('d' => 'departement'),'v.Departement_idDepartement = d.idDepartement')
                ->where('typePersonne = ?','Proprietaire');
       $row =$select->query()->fetchAll(); 
        
        if (!$row) {
            throw new Exception("Impossible de trouver les personnes !");
        }
        return $row->toArray();
    }

    public function ajouterPersonne($db,$nomPersonne, $prenomPersonne, $dateNaissancePersonne, $telFixePersonne, $telMobilePersonne, $mailPersonne, $typePersonne, $pwd,$numero,$rue,$longitude,$lattitude,$nomVille,$codePostal,$nomDepartement,$codeDepartement) {
 
        $data1 = array(
            'nomDepartement' => $nomDepartement,
            'codeDepartement' => $codeDepartement
       );
       $db->insert('departement',$data1);
       (int)$Departement_idDepartement = $db->lastinsertId();
        
        $data2 = array(
            'nomVille' => $nomVille,
            'codePostal' => $codePostal,
            'Departement_idDepartement' => $Departement_idDepartement
       );
       $db->insert('ville',$data2);
       (int)$Ville_idVille = $db->lastinsertId();
        
        $data3 = array(
            'numero' => $numero,
            'rue' => $rue,
            'longitude' => $longitude,
            'lattitude' => $lattitude,
            'Ville_idVille' => $Ville_idVille
       );
       $db->insert('adresse',$data3);
       (int)$Adresse_idAdresse = $db->lastinsertId();

        $data4 = array(
            'nomPersonne' => $nomPersonne,
            'prenomPersonne' => $prenomPersonne,
            'dateNaissancePersonne' => $dateNaissancePersonne,
            'telFixePersonne' => $telFixePersonne,
            'telMobilePersonne' => $telMobilePersonne,
            'mailPersonne' => $mailPersonne,
            'typePersonne' => $typePersonne,
            'Adresse_idAdresse' => $Adresse_idAdresse,
            'pwd' => $pwd
        );
        $this->insert($data4);

    }

    public function modifierPersonne($db,$idPersonne,$nomPersonne, $prenomPersonne, $dateNaissancePersonne, $telFixePersonne, $telMobilePersonne, $mailPersonne, $typePersonne, $pwd,$numero,$rue,$longitude,$lattitude,$nomVille,$codePostal,$nomDepartement,$codeDepartement) {
       $select1 = $this->getAdapter()->select()
                ->from(array('p' => 'personne'),
                    array('Adresse_idAdresse'))
                ->join(array('a' => 'adresse'),'p.Adresse_idAdresse = a.idAdresse')
                ->where('p.idPersonne = ?', (int) $idPersonne)
                ->where('typePersonne = ?','Proprietaire');

       $idAdresse =$select1->query()->fetch(); 
       
       $select2 = $this->getAdapter()->select()
                ->from(array('a' => 'adresse'),
                    array('Ville_idVille'))
                ->join(array('v' => 'ville'),'a.Ville_idVille = v.idVille');

       $idVille =$select2->query()->fetch();
       
       $select3 = $this->getAdapter()->select()
                ->from(array('v' => 'ville'),
                    array('Departement_idDepartement'))
                ->join(array('d' => 'departement'),'v.Departement_idDepartement = d.idDepartement');
                
       $idDepartement =$select3->query()->fetch();      
        
        
        $data1 = array(
            'nomDepartement' => $nomDepartement,
            'codeDepartement' => $codeDepartement
       );
       $db->update('departement',$data1, 'idDepartement = ' . (int) $idDepartement);
    
       $data2 = array(
            'nomVille' => $nomVille,
            'codePostal' => $codePostal,
            'Departement_idDepartement' => $idDepartement
       );
       $db->update('ville',$data2, 'idVille = ' . (int) $idVille);        
        
        $data3 = array(
            'numero' => $numero,
            'rue' => $rue,
            'longitude' => $longitude,
            'lattitude' => $lattitude,
            'Ville_idVille' => $idVille
       );
       $db->update('adresse',$data3, 'idAdresse = ' . (int) $idAdresse);
        
        $data = array(
            'nomPersonne' => $nomPersonne,
            'prenomPersonne' => $prenomPersonne,
            'dateNaissancePersonne' => $dateNaissancePersonne,
            'telFixePersonne' => $telFixePersonne,
            'telMobilePersonne' => $telMobilePersonne,
            'mailPersonne' => $mailPersonne,
            'typePersonne' => $typePersonne,
            'Adresse_idAdresse' => $idAdresse,
            'pwd' => $pwd
        );
        $this->update($data, 'idPersonne = ' . (int) $idPersonne);
    }

    public function supprimerPersonne($db,$idPersonne) {

        /*$select1 = $this->getAdapter()->select()
                ->from(array('p' => 'personne'),
                    array('Adresse_idAdresse'))
                ->join(array('a' => 'adresse'),'p.Adresse_idAdresse = a.idAdresse')
                ->where('p.idPersonne = ?', (int) $idPersonne)
                ->where('typePersonne = ?','Proprietaire');

       $idAdresse =$select1->query()->fetch(); 
       
       $select2 = $this->getAdapter()->select()
                ->from(array('a' => 'adresse'),
                    array('Ville_idVille'))
                ->join(array('v' => 'ville'),'a.Ville_idVille = v.idVille');

       $idVille =$select2->query()->fetch();
       
       /*$select3 = $this->getAdapter()->select()
                ->from(array('v' => 'ville'),
                    array('Departement_idDepartement'))
                ->join(array('d' => 'departement'),'v.Departement_idDepartement = d.idDepartement');
                
       $idDepartement =$select3->query()->fetch();
       
       $db->delete('departement','idDepartement =' . (int) $idDepartement);*/
      // $db->delete('ville','idVille =' . (int) $idVille);
       // $db->delete('adresse','idAdresse =' . (int) $idAdresse);
        $this->delete('idPersonne =' . (int) $idPersonne);
    }


}

