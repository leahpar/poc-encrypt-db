<?php


namespace App\Controller;


use App\Entity\MyEntity;
use App\Entity\MyGroup;
use App\Service\CrypterService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{

    /**
     * @Route("/test")
     */
    public function index(EntityManagerInterface $em)
    {
        $obj = new MyEntity();
        $obj->setEncryptedData("some data");
        $em->persist($obj);
        $em->flush();
        dump("stored entity", $obj);
        $id = $obj->getId();

        $obj = $em->getRepository(MyEntity::class)->find($id);
        dump("fetched entity", $obj);

        die();

    }


    /**
     * @Route("/test2")
     */
    public function index2(EntityManagerInterface $em)
    {
        $group = new MyGroup();
        $group->setEncryptedData("some group data");

        $group->addEntity(new MyEntity());
        $group->addEntity(new MyEntity());
        $group->addEntity(new MyEntity());

        dump($group);
        //die();

        $em->persist($group);
        $em->flush();

        die();
    }

    /**
     * @Route("/fetch")
     */
    public function fetch(EntityManagerInterface $em)
    {
        $objs = $em->getRepository(MyEntity::class)->findAll();
        dump($objs);

        die();
    }


    /**
     * @Route("/key")
     */
    public function generateKey(CrypterService $crypter)
    {
        $crypter->generateEncryptionKey();
        dump("done");
        die();
    }
}