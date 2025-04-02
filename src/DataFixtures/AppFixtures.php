<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Admin;
use App\Entity\Client;
use App\Entity\Detail;
use App\Entity\Produit;
use App\Entity\Commande;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }
    
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $admin = new Admin();
        $admin->setNom('webmaster');
        $admin->setUsername("admin");
        $admin->setRoles((['ROLE_ADMIN']));
        $password=$this->hasher->hashPassword($admin, 'admin');
        $admin->setPassword($password);
        $manager->persist($admin);

        $clients = [
            ['B112','HANSENNE','23, r. Dumont','Poitiers','C1',1250],
            ['C123','MERCIER','25, r. Lemaître','Namur','C1',-2300],
            ['B332','MONTI','112, r. Neuve','Genève','B2',0],
            ['F010','TOUSSAINT','5, r. Godefroid','Poitiers','C1',0],
            ['K111','VANBIST','180, r. Florimont','Lille','B1',720],
            ['S127','VANDERKA','3, av. des Roses','Namur','C1',-4580],
            ['B512','GILLET','14, r. de l\'Eté','Toulouse','B1',-8700],
            ['B062','GOFFIN','72, r. de la Gare','Namur','B2',-3200],
            ['C400','FERARD','65, r. du Tertre','Poitiers','B2',350],
            ['C003','AVRON','8, ch. de la Cure','Toulouse','B1',-1700],
            ['K729','NEUMAN','40, r. Bransart','Toulouse',null,0],
            ['F011','PONCELET','17, Clôs des Erables','Toulouse','B2',0],
            ['L422','FRANCK','60, r. de Wépion','Namur','C1',0],
            ['S712','GUILLAUME','14a, ch. des Roses','Paris','B1',0],
            ['D063','MERCIER','201, bvd du Nord','Toulouse',null,-2250],
            ['F400','JACOB','78, ch. du Moulin','Bruxelles','C2',0]
        ];
       foreach ($clients as $c)
        {
            $client = new Client();
            $client->setNcli($c[0]);
            $client->setNom($c[1]);
            $client->setAdresse($c[2]);
            $client->setLocalite($c[3]);
            $client->setCat($c[4]);
            $client->setCompte($c[5]);
            $manager->persist($client);
        }

        $produits = [
            ['CS262','CHEV. SAPIN 200x6x2',75,45],
            ['CS264','CHEV. SAPIN 200x6x4',120,2690],
            ['CS464','CHEV. SAPIN 400x6x4',220,450],
            ['PA45' ,'POINTE ACIER 45 (1K)',105,580],
            ['PA60' ,'POINTE ACIER 60 (1K)',95,134],
            ['PH222','PL. HETRE 200x20x2',230,782],
            ['PS222','PL. SAPIN 200x20x2',185,1220],
        ];

        foreach ($produits as $p) {
            $produit = new Produit();
            $produit->setNpro($p[0]);
            $produit->setLibelle($p[1]);
            $produit->setPrix($p[2]);
            $produit->setQstock($p[3]);
            $manager->persist($produit);
        }

        $manager->flush();

        $commandes = [
            ['30178','K111','2015-12-21'],
            ['30179','C400','2015-12-22'],
            ['30182','S127','2015-12-23'],
            ['30184','C400','2015-12-23'],
            ['30185','F011','2016-01-02'],
            ['30186','C400','2016-01-02'],
            ['30188','B512','2016-01-03'],
        ];

        foreach ($commandes as $c) {
            $commande = new Commande();
            $commande->setNcom($c[0]);
            $client = new Client();
            $client = $manager->getRepository(Client::class)->findOneBy(['ncli' => $c[1]]);
            $commande->setNcli($client); 
            $commande->setDatecom(new \DateTime($c[2]));
            $manager->persist($commande);
        }


        $manager->flush();


            $details = [
                    ['30178','CS464',25],
                    ['30179','PA60',20],
                    ['30179','CS262',60],
                    ['30182','PA60',30],
                    ['30184','CS464',120],
                    ['30184','PA45',20],
                    ['30185','PA60',15],
                    ['30185','PS222',600],
                    ['30185','CS464',260],
                    ['30186','PA45',3],
                    ['30188','PA60',70],
                    ['30188','PH222',92],
                    ['30188','CS464',180],
                    ['30188','PA45',22],
                ];
        
                foreach ($details as $d) {
                    $detail = new Detail();
                    $commande = new Commande();
                    $commande = $manager->getRepository(Commande::class)->findOneBy(['ncom' => $d[0]]);
                    $detail->setNcom($commande);
                    $produit = new Produit();
                    $produit = $manager->getRepository(Produit::class)->findOneBy(['npro' => $d[1]]);
                    $detail->setNpro($produit);
                    $detail->setQcom($d[2]);
                    $manager->persist($detail);
                }
        

        $manager->flush();


    }

}
