<?php

    // src/Controller/BranchController.php
    namespace App\Controller;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use App\Entity\BranchModel;
    use App\Controller\ApiController;


    class BranchController extends ApiController
    {

        //ziskaj feed z ulozenky
        public function getUlozenkaBranches(Request $request) {
            $session = $request->getSession();
            $query = $request->request->get('search'); //ziskaj query
            $branchList = array();
            $response = $this->getRequestAPI('https://www.ulozenka.cz/gmap'); //volaj getRequestApi z ApiController.php
            foreach ($response as $cell){   //prechadzaj feed po bunkach
                if((isset($query)) && ($query != "") && (strpos($cell["name"],$query)) === false) continue; //ak bola zadana query, tak pokracuj len ak sa achadza v adrese, inak preskoc iteraciu
                $branch = new BranchModel; //alokuj a napln model
                $branch->setInternalId($cell["id"]);
                $branch->setInternalName($cell["shortcut"]);
                $branch->setAddress($cell["name"]);
                $branch->setWeb($cell["odkaz"]);
                $branch->setLocation($cell["lat"],$cell["lng"]);
                $branch->setBusinessHours($cell["openingHours"]);
                if (empty($cell["announcements"]) == false) //v zadani je BranchModel->"string announcement", takze vyberam text prveho oznamu, ak existuje
                {
                    $branch->setAnnouncement($cell["announcements"][0]["text"]);
                }
                $branch->setActive($cell["active"]);
                $branch->setPublic($cell["public"]);
                array_push($branchList,$branch); //pushni do pola BranchModelov
            }
            if (empty($query)){  //ak nebolo zadane query
                return $this->render('listing.html.twig',['branches' => $branchList]);
            }
            else{ //ak bolo zadane query
                return $this->render('listing.html.twig',['branches' => $branchList, 'query' => $query]);
            }
        }
        

        
    }