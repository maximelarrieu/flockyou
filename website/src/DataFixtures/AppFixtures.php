<?php

namespace App\DataFixtures;

use App\Entity\Leagues;
use App\Entity\Teams;
use App\Entity\Sizes;
use App\Entity\States;
use App\Entity\Products;

use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        /****============== LEAGUES ==============****/
        $cl = ['Ligue des champions'];
        $cl_tab = [];
        for ($l = 0; $l < 1; $l++) {
            $league = new Leagues();
            $league->setLeagueName($cl[$l]);
            $league->setLeagueImg('/build/images/leagues/cl.png');
            $cl_tab[] = $league;

            $manager->persist($league);
        }
        $euro = ['Euro 2020'];
        $euro_tab = [];
        for ($l = 0; $l < 1; $l++) {
            $league = new Leagues();
            $league->setLeagueName($euro[$l]);
            $league->setLeagueImg('/assets/images/leagues/eurobanner.png');
            $euro_tab[] = $league;
            $manager->persist($league);
        }
        /****=====================================****/
        /****============== TEAMS ==============****/
        $cl_teams = ['Juventus', 'Real Madrid', 'Manchester United',
            'Paris-Saint-Germain', 'Liverpool', 'Arsenal', 'AC Milan',
            'Bayern Munich', 'Borussia Dortmund', 'Ajax'];
        $cl_teams_tab = [];
        for ($t = 0; $t < sizeof($cl_teams); $t++) {
            $team = new Teams();
            $team->setTeamName($cl_teams[$t]);
            $team->setSlug(strtoupper(substr($cl_teams[$t], 0, 3)));

            $teamsLeague = $faker->randomElements($cl_tab, $faker->numberBetween(1, 1));
            foreach ($teamsLeague as $league) {
                $team->setLeague($league);
            }
            $manager->persist($team);
            $cl_teams_tab[] = $team;
        }

        $euro_teams = ['Portugal', 'France', 'Allemagne',
            'Belgique', 'Suede', 'Suisse', 'Autriche', 'Russie',
            'Italie', 'Espagne', 'Pays-Bas', 'Irlande'];
        $euro_teams_tab = [];
        for ($t = 0; $t < sizeof($euro_teams); $t++) {
            $team = new Teams();
            $team->setTeamName($euro_teams[$t]);
            $team->setSlug(strtoupper(substr($euro_teams[$t], 0, 3)));

            $teamsLeague = $faker->randomElements($euro_tab, $faker->numberBetween(1, 1));
            foreach ($teamsLeague as $league) {
                $team->setLeague($league);
            }
            $manager->persist($team);
            $euro_teams_tab[] = $team;
        }
        $all_teams = array_merge($cl_teams_tab, $euro_teams_tab);
        /****===================================****/
        /****============== SIZES ==============****/
        $sizes = ['XS', 'S', 'M', 'L', 'XL'];
        $sizes_tab = [];
        for ($s = 0; $s < sizeof($sizes); $s++) {
            $size = new Sizes();
            $size->setSize($sizes[$s]);
            $sizes_tab[] = $size;
            $manager->persist($size);
        }
        /****====================================****/
        /****============== STATUS ==============****/
        $states = ['Domicile', 'Extérieur', 'Third'];
        $states_tab = [];
        for ($s = 0; $s < sizeof($states); $s++) {
            $state = new States();
            $state->setState($states[$s]);
            $manager->persist($state);
            $states_tab[] = $state;
        }
        /****====================================****/
        /****============== PRODUCTS ============****/
        $products = [];
        for ($p = 0; $p <= 50; $p++) {
            $product = new Products();
            $product->setPrice(50);

            $productTeam = $faker->randomElements($all_teams, $faker->numberBetween(1, sizeof($all_teams)));
            foreach ($productTeam as $team) {
                $product->setTeam($team);
            }
            $productState = $faker->randomElements($states_tab, $faker->numberBetween(1, sizeof($states_tab)));
            foreach ($productState as $state) {
                $product->setState($state);
            }
            $manager->persist($product);
            $products[] = $product;
        }
        /****====================================****/
        /****============== USERS ===============****/
        $users = [];
            for ($u = 0; $u <= 3; $u++) {
                $user = new Users();

                $password = $this->encoder->encodePassword($user, 'password');

                $user->setUsername($faker->userName);
                $user->setEmail($faker->freeEmail);
                $user->setPassword($password);
                $manager->persist($user);
                $users[] = $user;
            }
        /****====================================****/
        $manager->flush();
    }
}
