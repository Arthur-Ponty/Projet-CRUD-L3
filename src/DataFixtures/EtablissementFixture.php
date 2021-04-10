<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use \DateTime;

use App\Entity\Etablissement;

class EtablissementFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $csv = fopen('./data/fr-en-adresse-et-geolocalisation-etablissements-premier-et-second-degre.csv', 'r');

        $i = 1;
        while(!feof($csv))
        {
            $data = fgetcsv($csv, 0, ";");
            
            if($i > 1 && $data)
            {
                $etablissemenent = new Etablissement();
                $etablissemenent->setAppelationOfficielle($data[1]);
                $etablissemenent->setDenomination($data[2]);
                $etablissemenent->setSecteur($data[4]);
                $etablissemenent->setLongitude((float)$data[15]);
                $etablissemenent->setlatitude((float)$data[14]);
                $etablissemenent->setAdresse($data[5]);
                $etablissemenent->setDepartement($data[26]);
                $etablissemenent->setCommune($data[10]);
                $etablissemenent->setRegion($data[27]);
                $etablissemenent->setAcademie($data[28]);
                $etablissemenent->setIdCommune($data[25]);
                
                $date = new DateTime($data[34]);
                $etablissemenent->setDateOuverture($date);

                $manager->persist($etablissemenent);
            }

            if($i%100 == 0)
            {
                $manager->flush();
            }

            $i++;
        }

        $manager->flush();
    }
}
