<?php

namespace App\DataFixtures;

use App\Entity\Quote;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $quote = new Quote();
	    $quote->setText("The best thing about a boolean is even if you are wrong, you are only off by a bit.");
        $quote->setAuthor("Anonymous");
        $quote->setAppId("app0");
        $manager->persist($quote);
    
        $quote = new Quote();
	    $quote->setText("Before software can be reusable it first has to be usable.");
        $quote->setAuthor("Ralph Johnson");
        $quote->setAppId("app0");
        $manager->persist($quote);
    
        $quote = new Quote();
	    $quote->setText("Without requirements or design, programming is the art of adding bugs to an empty text file.");
        $quote->setAuthor("Louis Srygley");
        $quote->setAppId("app0");
        $manager->persist($quote);
    
        $quote = new Quote();
	    $quote->setText("The best method for accelerating a computer is the one that boosts it by 9.8 m/s2.");
        $quote->setAuthor("Anonymous");
        $quote->setAppId("app0");
        $manager->persist($quote);
    
        $quote = new Quote();
	    $quote->setText("I think Microsoft named .Net so it wouldn’t show up in a Unix directory listing.");
        $quote->setAuthor("Oktal");
        $quote->setAppId("app0");
        $manager->persist($quote);
    
        $quote = new Quote();
	    $quote->setText("If builders built buildings the way programmers wrote programs, then the first woodpecker that came along would destroy civilization.");
        $quote->setAuthor("Gerald Weinberg");
        $quote->setAppId("app0");
        $manager->persist($quote);
    
        $quote = new Quote();
	    $quote->setText("There are two ways to write error-free programs; only the third one works.");
        $quote->setAuthor("Alan J. Perlis");
        $quote->setAppId("app0");
        $manager->persist($quote);
    
        $quote = new Quote();
	    $quote->setText("Ready, fire, aim: the fast approach to software development. Ready, aim, aim, aim, aim: the slow approach to software development.");
        $quote->setAuthor("Anonymous");
        $quote->setAppId("app0");
        $manager->persist($quote);
    
        $quote = new Quote();
	    $quote->setText("It’s not a bug – it’s an undocumented feature.");
        $quote->setAuthor("Anonymous");
        $quote->setAppId("app0");
        $manager->persist($quote);
    
        $quote = new Quote();
	    $quote->setText("One man’s crappy software is another man’s full-time job.");
        $quote->setAuthor("Jessica Gaston");
        $quote->setAppId("app0");
        $manager->persist($quote);
    
        $quote = new Quote();
	    $quote->setText("A good programmer is someone who always looks both ways before crossing a one-way street.");
        $quote->setAuthor("Doug Linder");
        $quote->setAppId("app1");
        $manager->persist($quote);
    
        $quote = new Quote();
	    $quote->setText("Always code as if the guy who ends up maintaining your code will be a violent psychopath who knows where you live.");
        $quote->setAuthor("Martin Golding");
        $quote->setAppId("app1");
        $manager->persist($quote);
    
        $quote = new Quote();
	    $quote->setText("Programming is like sex. One mistake and you have to support it for the rest of your life.");
        $quote->setAuthor("Michael Sinz");
        $quote->setAppId("app1");
        $manager->persist($quote);
    
        $quote = new Quote();
	    $quote->setText("Deleted code is debugged code.");
        $quote->setAuthor("Jeff Sickel");
        $quote->setAppId("app1");
        $manager->persist($quote);
    
        $quote = new Quote();
	    $quote->setText("Walking on water and developing software from a specification are easy if both are frozen.");
        $quote->setAuthor("Edward V Berard");
        $quote->setAppId("app1");
        $manager->persist($quote);
    
        $quote = new Quote();
	    $quote->setText("If debugging is the process of removing software bugs, then programming must be the process of putting them in.");
        $quote->setAuthor("Edsger Dijkstra");
        $quote->setAppId("app1");
        $manager->persist($quote);
    
        $quote = new Quote();
	    $quote->setText("Software undergoes beta testing shortly before it’s released. Beta is Latin for “still doesn’t work.");
        $quote->setAuthor("Anonymous");
        $quote->setAppId("app1");
        $manager->persist($quote);
    
        $quote = new Quote();
	    $quote->setText("Programming today is a race between software engineers striving to build bigger and better idiot-proof programs, and the universe trying to produce bigger and better idiots. So far, the universe is winning.");
        $quote->setAuthor("Rick Cook");
        $quote->setAppId("app1");
        $manager->persist($quote);
    
        $quote = new Quote();
	    $quote->setText("It’s a curious thing about our industry: not only do we not learn from our mistakes, but we also don’t learn from our successes.");
        $quote->setAuthor("Keith Braithwaite");
        $quote->setAppId("app1");
        $manager->persist($quote);
    
        $quote = new Quote();
	    $quote->setText("There are only two kinds of programming languages: those people always bitch about and those nobody uses.");
        $quote->setAuthor("Bjarne Stroustrup");
        $quote->setAppId("app1");
        $manager->persist($quote);
    
        $quote = new Quote();
	    $quote->setText("In order to understand recursion, one must first understand recursion.");
        $quote->setAuthor("Anonymous");
        $quote->setAppId("app2");
        $manager->persist($quote);
    
        $quote = new Quote();
	    $quote->setText("The cheapest, fastest, and most reliable components are those that aren’t there.");
        $quote->setAuthor("Gordon Bell");
        $quote->setAppId("app2");
        $manager->persist($quote);
    
        $quote = new Quote();
	    $quote->setText("The best performance improvement is the transition from the nonworking state to the working state.");
        $quote->setAuthor("J. Osterhout");
        $quote->setAppId("app2");
        $manager->persist($quote);
    
        $quote = new Quote();
	    $quote->setText("The trouble with programmers is that you can never tell what a programmer is doing until it’s too late.");
        $quote->setAuthor("Seymour Cray");
        $quote->setAppId("app2");
        $manager->persist($quote);
    
        $quote = new Quote();
	    $quote->setText("Don’t worry if it doesn’t work right. If everything did, you’d be out of a job.");
        $quote->setAuthor("Mosher");
        $quote->setAppId("app2");
        $manager->persist($quote);

        $manager->flush();
    }
}
