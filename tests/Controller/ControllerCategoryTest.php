<?php

namespace App\Tests\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\InMemoryUser;

class ControllerCategoryTest extends WebTestCase
{
    private static ?int $id = null;

//    public function testIndex(): void
//    {
//        $client = self::createClient();
//        $user = new InMemoryUser('admin', 'password', ['ROLE_ADMIN']);
//        $client->loginUser($user);
//
//        $client->request('GET', '/admin/category');
//        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
//    }
//
//    public function testNewCategory(): void
//    {
//        $client = self::createClient();
//        $user = new InMemoryUser('admin', 'password', ['ROLE_ADMIN']);
//        $client->loginUser($user);
//
//        $crawler = $client->request('GET', '/admin/category/new');
//
//        $buttonCrawlerNode = $crawler->selectButton('Save');
//        $form = $buttonCrawlerNode->form();
//
//        $form['category[title]'] = 'Blabla';
//
//
//        $client->submit($form);
//
//        $container = self::getContainer();
//        $product = $container->get(CategoryRepository::class)->findOneBy(['title' => 'Blabla']);
//        self::$id = $product->getId();
//
//        $this->assertResponseRedirects('/admin/category');
//    }
//
//    public function testEditCategory(): void
//    {
//        $client = self::createClient();
//        $user = new InMemoryUser('admin', 'password', ['ROLE_ADMIN']);
//        $client->loginUser($user);
//
//        $crawler = $client->request('GET', '/admin/category/'. self::$id .'/edit');
//
//        $buttonCrawlerNode = $crawler->selectButton('Update');
//        $form = $buttonCrawlerNode->form();
//
//        $form['category[title]'] = 'BienChange';
//
//        $client->submit($form);
//
//
//        $this->assertResponseRedirects('/admin/category');
//    }
    public function testIndex(): void
    {
        $client = self::createClient();
        $user = new InMemoryUser('admin', 'password', ['ROLE_ADMIN']);
        $client->loginUser($user);

        $client->request('GET', '/admin/category');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function testNewCategory(): void
    {
        $client = self::createClient();
        $user = new InMemoryUser('admin', 'password', ['ROLE_ADMIN']);
        $client->loginUser($user);

        $crawler = $client->request('GET', '/admin/category/new');

        $buttonCrawlerNode = $crawler->selectButton('Save');
        $form = $buttonCrawlerNode->form();

        $form['category[title]'] = 'New Category';
        $client->submit($form);

        $container = self::getContainer();
        $category = $container->get(CategoryRepository::class)->findOneBy(['title' => 'New Category']);
        self::$id = $category->getId();

        $this->assertResponseRedirects('/admin/category');
    }

    public function testEditCategory(): void
    {
        $client = self::createClient(); //configurer le client
        $user = new InMemoryUser('admin', 'password', ['ROLE_ADMIN']);//identifier le client
        $client->loginUser($user);

        $crawler = $client->request('GET', '/admin/category/'. self::$id .'/edit');

        $buttonCrawlerNode = $crawler->selectButton('Update');// recuperation du boutton pour le formulaire
        $form = $buttonCrawlerNode->form();

        $form['category[title]'] = 'plop';

        $client->submit($form);// soumettre mon formulaire


        $this->assertResponseRedirects('/admin/category');//ecouter la redirection
    }
    public function testShowCategory(): void
    {
        $client = self::createClient();
        $user = new InMemoryUser('admin', 'password', ['ROLE_ADMIN']);
        $client->loginUser($user);

        $client->request('GET', '/admin/category/'. self::$id);

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }
}
