<?php

class Application_Model_DbTable_Veterinaire extends Zend_Db_Table_Abstract {

    protected $_name = 'personne';

    public function obtenirVeterinaire($idPersonne) {
        $idPersonne = (int) $idPersonne;

        $select = $this->getAdapter()->select()
                ->from(array('p' => 'personne'),
                    array('idPersonne','nomPersonne','prenomPersonne', 'dateNaissancePersonne','telFixePersonne','telMobilePersonne','mailPersonne','typePersonne','Adresse_idAdresse', 'pwd'))
                ->join(array('a' => 'adresse'),
                        'p.Adresse_idAdresse = a.idAdresse')
                ->join(array('v' => 'ville'),'a.Ville_idVille = v.idVille')
                ->join(array('d' => 'departement'),'v.Departement_idDepartement = d.idDepartement')
                ->where('p.idPersonne = ?', $idPersonne)
                ->where('p.typePersonne = ?','Veterinaire');
       $row =$select->query()->fetch();        
        
        if (!$row) {
            throw new Exception("Impossible de trouver le vétérinaire $idPersonne");
        }
        return $row;
    }
    
    public function obtenirVeterinaires()
    {
        $select = $this->select()
                ->from(array('p' => 'personne'),
                    array('idPersonne','nomPersonne','prenomPersonne', 'dateNaissancePersonne','telFixePersonne','telMobilePersonne','mailPersonne','typePersonne','Adresse_idAdresse', 'pwd'))
                ->join(array('a' => 'adresse'),
                        array('idAdresse'),
                        'p.Adresse_idAdresse = a.idAdresse')
                ->join(array('v' => 'ville'),'a.Ville_idVille = v.idVille')
                ->join(array('d' => 'departement'),'v.Departement_idDepartement = d.idDepartement')
                ->where('typePersonne = ?','Veterinaire');
       $row =$select->query()->fetchAll(); 
        
        if (!$row) {
            throw new Exception("Impossible de trouver les vétérinaires !");
        }
        return $row->toArray();
    }

    public function ajouterVeterinaire($db,$nomPersonne, $prenomPersonne, $dateNaissancePersonne, $telFixePersonne, $telMobilePersonne, $mailPersonne, $typePersonne,$pwd,$numero,$rue,$longitude,$lattitude,$nomVille,$codePostal,$nomDepartement,$codeDepartement) {
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
        
        $data = array(
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
        $this->insert($data);
    }

    public function modifierVeterinaire($db,$idPersonne, $nomPersonne, $prenomPersonne, $dateNaissancePersonne, $telFixePersonne, $telMobilePersonne, $mailPersonne, $typePersonne, $Adresse_idAdresse, $pwd,$numero,$rue,$longitude,$lattitude,$nomVille,$codePostal,$nomDepartement,$codeDepartement) {
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
            'Adresse_idAdresse' => $Adresse_idAdresse,
            'pwd' => $pwd
        );
        $this->update($data, 'idPersonne = ' . (int) $idPersonne);
    }

    public function supprimerVeterinaire($idPersonne) {
        $this->delete('idPersonne =' . (int) $idPersonne);
    }


}

