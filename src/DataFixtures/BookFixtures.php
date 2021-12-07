<?php

namespace App\DataFixtures;

use App\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BookFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $book1 = new Book();
        $book1->setTitle("Design Patterns");
        $book1->setIsbn("978-0-201-63361-0");
        $book1->setAuthor("Eric Gamma, Richard Helm, Ralph Johnson, John Vlissides");
        // $book1->setImage("../img_books/pic1.jpg");
        $book1->setImage("img_books/pic1.jpg");
        $manager->persist($book1);

        $book2 = new Book();
        $book2->setTitle("Webbutveckling med PHP och MySQL");
        $book2->setIsbn("978-91-44-10556-7");
        $book2->setAuthor("Montathar Faraon");
        // $book2->setImage("../img_books/pic2.jpg");
        $book2->setImage("img_books/pic2.jpg");
        $manager->persist($book2);

        $book3 = new Book();
        $book3->setTitle("HTML- och CSS-boken");
        $book3->setIsbn("978-91-636-0994-7");
        $book3->setAuthor("Rolf Staflin");
//        $book3->setImage("../img_books/pic3.jpg");
        $book3->setImage("img_books/pic3.jpg");
        $manager->persist($book3);

        $manager->flush();
    }
}
