<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Security\Core\User\InMemoryUser;

class ProductControllerTest extends WebTestCase
{
    public function testNewProduct(): void
    {
        $client = static::createClient();
        $user = new InMemoryUser('admin', 'password', ['ROLE_ADMIN']);
        $client->loginUser($user);

        $crawler = $client->request('GET', '/admin/product/new');

        $buttonCrawlerNode = $crawler->selectButton('Save');
        $form = $buttonCrawlerNode->form();

        $form['product[title]'] = 'Sneakers';
        $form['product[description]'] = 'Blablabla!';
        $form['product[price]'] = 123;
        $form['product[category]']->select('Pantalon');

        $client->submit($form);
        $this->assertResponseRedirects('/admin/product');
    }
}
