<?php

class Application_Model_DbTable_Clinique extends Zend_Db_Table_Abstract {

    protected $_name = 'clinique';

    public function obtenirClinique($idClinique) {
        $idClinique = (int) $idClinique;
        
        $select = $this->getAdapter()->select()
                ->from(array('c' => 'clinique'),
                    array('idClinique','nomClinique','proprietaireClinique', 'telClinique','mailClinique','Adresse_idAdresse'))
                ->join(array('a' => 'adresse'),
                        'c.Adresse_idAdresse = a.idAdresse')
                ->join(array('v' => 'ville'),'a.Ville_idVille = v.idVille')
                ->join(array('d' => 'departement'),'v.Departement_idDepartement = d.idDepartement')
                ->where('c.idClinique = ?',$idClinique);
       $row =$select->query()->fetch();        
        
        if (!$row) {
            throw new Exception("Impossible de trouver la clinique $idClinique");
        }
        return $row;
    }
    
    public function obtenirCliniques()
    {
        $select = $this->select()
                ->from(array('c' => 'clinique'),
                    array('idClinique','nomClinique','proprietaireClinique', 'telClinique','mailClinique','Adresse_idAdresse'))
                ->join(array('a' => 'adresse'),
                        array('idAdresse'),
                        'c.Adresse_idAdresse = a.idAdresse')
                ->join(array('v' => 'ville'),'a.Ville_idVille = v.idVille')
                ->join(array('d' => 'departement'),'v.Departement_idDepartement = d.idDepartement');
       $row =$select->query()->fetchAll(); 
        
        if (!$row) {
            throw new Exception("Impossible de trouver les cliniques !");
        }
        return $row->toArray();
    }

    public function ajouterClinique($db,$nomClinique, $proprietaireClinique, $telClinique, $mailClinique,$numero,$rue,$longitude,$lattitude,$nomVille,$codePostal,$nomDepartement,$codeDepartement) {
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
            'nomClinique' => $nomClinique,
            'proprietaireClinique' => $proprietaireClinique,
            'telClinique' => $telClinique,
            'mailClinique' => $mailClinique,
            'Adresse_idAdresse' => $Adresse_idAdresse
        );
        $this->insert($data);
    }

    public function modifierClinique($db,$idClinique, $nomClinique, $proprietaireClinique, $telClinique, $mailClinique,$numero,$rue,$longitude,$lattitude,$nomVille,$codePostal,$nomDepartement,$codeDepartement) {
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
            'idClinique' => $idClinique,
            'nomClinique' => $nomClinique,
            'proprietaireClinique' => $proprietaireClinique,
            'telClinique' => $telClinique,
            'mailClinique' => $mailClinique,
            'Adresse_idAdresse' => $idAdresse
        );
        $this->update($data, 'idClinique = ' . (int) $idClinique);
    }

    public function supprimerClinique($idClinique) {
        $this->delete('idClinique =' . (int) $idClinique);
    }


}