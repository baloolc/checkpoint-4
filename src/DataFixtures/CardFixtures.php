<?php

namespace App\DataFixtures;

use App\Entity\Card;
use App\Service\CallApiService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CardFixtures extends Fixture implements DependentFixtureInterface
{
    private CallApiService $callApiService;

    public function __construct(CallApiService $callApiService)
    {
        $this->callApiService = $callApiService;
    }

    public function load(ObjectManager $manager): void
    {
        $apiCard = $this->callApiService->getCardData();

        for($i=0; $i <= 99; $i++){
            $card = new Card();
            $card->setName($apiCard['cards'][$i]['name']);
            if(isset($apiCard['cards'][$i]['imageUrl'])){
                $card->setImage($apiCard['cards'][$i]['imageUrl']);
            }
            if(isset($apiCard['cards'][$i]['power'])){
                $card->setPower($apiCard['cards'][$i]['power']);
            }
            if(isset($apiCard['cards'][$i]['toughness'])){
                $card->setToughness($apiCard['cards'][$i]['toughness']);
            }
            $card->setApiId($i);
            if(isset($apiCard['cards'][$i]['text'])){
                $card->setDescription($apiCard['cards'][$i]['text']);
            }
            $card->setRarity($apiCard['cards'][$i]['rarity']);
            $card->setManaCost($apiCard['cards'][$i]['manaCost']);
            $card->setType($apiCard['cards'][$i]['type']);
            $card->setUser($this->getReference('user_'));
            $manager->persist($card);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}
