<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class HelloController extends AbstractController {

    /**
     * @Route({
     * "fr" : "/sitefr",
     * "en" : "/siteen"})
     */
    //change les locales en fonction de l'appel
    function bienvenue(Request $request) {
        $locale = $request->getLocale();
        return new Response('Site avec locale : ' . $locale);
    }

    /**
     * @Route("locale/{_locale}")
     */
    //test avec ../locale/fr ../locale/en
    //voir documentation de symfony pour l'implementation des parametres de routing particulier (Special routing parameters)
    function locale(Request $request) {
        $locale = $request->getLocale();
        return new Response('Bonjour , locale : ' . $locale);
    }


    /**
     * @Route("connect")
     */
    function connect() {
        return $this->render('user.html.twig');
    }

    /**
    * @Route("connect/{name}", name="connectWithName") 
    */
    function connectWithName($name) {
        return new Response('SALUT ' . $name);
    }

    /**
     * @Route("test/{param}")
     */
    //Routage de ../test/llll
    //attention le chemin ../test retourne une erreur de page non trouvé
    function test() {
        return new Response("test aha ");
    }

    /**
    * @Route("recup/{param}")
    */
    //exemple pour récupérer les paramétres de la requete ../recup/toto renvoie toto
    function recup($param) {
        return new Response("Le reste de l'URL " . $param);
    }

    /**
     * @Route("api/{param}", requirements={"param"="\d+"})
     */
    function apiNumber($param) {
        return new Response("URL avec numérique " . $param);
    }
    /**
     * @Route("api/{param}")
     */
    function apiTexte($param) {
        return new Response("URL avec parametre " . $param);
    }

    /**
     * @Route("api/{premier}/{second}/document/{troisieme}")
     */
    function api($premier, $second, $troisieme) {
        return new Response("Le reste de l'URL " . $premier . "/" . $second . "/document/" . $troisieme);
    }

     /**
     * @Route("api/get/{param}", requirements={"param"="\d+"}, methods={"GET"})
     */
    //uniquement sur get, post retournera une erreur
    //tester avec postman pour faire un post
    function apiget($param) {
        return new Response("appel get avec url " . $param);
    }




    /*function hello() {
        //return new Response('Hello !'); //affiche hello
        //return $this->render('base.html.twig'); //ouvre la page templates/base.html.twig
        //return $this->redirectToRoute('/'); //redirige sur la page d'accueil
        //throw $this->createNotFoundException(); //retourne une erreur
        
        //ouvre la page hello.html et lui passe des paramêtres
        $title = "utilisateurs";
        $users = ["Mickey","Leo","Donald","Minny"];
        return $this->render('hello.html.twig',['title' => $title, 'array' => $users]);
    }*/

    /**
     * @Route("hello")
     */
    //exemple pour lire les parametre passé dans ../hello?Param=test
    function hello(Request $request) {
        $params = $request->query->all();
        $string = "Les paramètres sont : </br>";
        foreach($params as $key => $value) {
            $string= $string . '-' . $key . ":" . $value . '</br>';
            return new Response($string);
        } 
    }
     
    /**
     * @Route("bonjour")
     */
    function bonjour() {
        return new Response('bonjour !'); //affiche bonjour
    }

    /**
     * @Route("listUser")
     */
    function listUser() {
        $title = "utilisateurs";
        $users = ["Mickey","Leo","Donald","Minny"];
        return $this->render('hello.html.twig',['title' => $title, 'array' => $users]);
    }




}