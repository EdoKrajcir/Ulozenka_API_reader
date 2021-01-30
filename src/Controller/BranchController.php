<?php

    // src/Controller/BranchController.php
    namespace App\Controller;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use App\Entity\Branch;
    use App\Controller\ApiController;


    class BranchController extends ApiController
    {


        public function getUlozenkaBranches(Request $request) {
            $session = $request->getSession();
            $query = $request->request->get('search');
            $branchList = array();
            $response = $this->getRequestAPI('https://www.ulozenka.cz/gmap');
            foreach ($response as $cell){
                if((isset($query)) && ($query != "") && (strpos($cell["name"],$query)) === false) continue;
                $branch = new Branch;
                $branch->setInternalId($cell["id"]);
                $branch->setInternalName($cell["shortcut"]);
                $branch->setAddress($cell["name"]);
                $branch->setWeb($cell["odkaz"]);
                $branch->setLocation($cell["lat"],$cell["lng"]);
                $branch->setBusinessHours($cell["openingHours"]);
                if (empty($cell["announcements"]) == false) 
                {
                    $branch->setAnnouncement($cell["announcements"][0]["text"]);
                }
                $branch->setActive($cell["active"]);
                $branch->setPublic($cell["public"]);
                array_push($branchList,$branch);
            }
            if (empty($query)){
                return $this->render('base.html.twig',['branches' => $branchList]);
            }
            else{
                return $this->render('base.html.twig',['branches' => $branchList, 'query' => $query]);
            }
        }
        

        
    }