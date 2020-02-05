<?php

namespace App\DataFixtures;

use App\Entity\Bank;
use App\Entity\League;
use App\Entity\Roles;
use App\Entity\Team;
use App\Entity\Size;
use App\Entity\State;
use App\Entity\Product;
use App\Entity\Users;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use function GuzzleHttp\_current_time;

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
            $league = new League();
            $league->setName($cl[$l]);
            $league->setImage('build/images/leagues/'.$league->getName().'/Logo.png');
            $league->setSlug('ligue-des-champions');
            $cl_tab[] = $league;

            $manager->persist($league);
        }
        $euro = ['Euro 2020'];
        $euro_tab = [];
        for ($l = 0; $l < 1; $l++) {
            $league = new League();
            $league->setName($euro[$l]);
            $league->setImage('build/images/leagues/'.$league->getName().'/Logo.png');
            $league->setSlug('euro-2020');
            $euro_tab[] = $league;

            $manager->persist($league);
        }
        /****=====================================****/
        /****============== TEAMS ==============****/
        $cl_teams = ['Juventus', 'Real Madrid', 'Manchester United',
            'Paris-Saint-Germain', 'Liverpool', 'Arsenal', 'AC Milan',
            'Bayern Munich', 'Borussia Dortmund', 'Ajax', 'FC Barcelone'];
        $cl_teams_tab = [];
        for ($t = 0; $t < sizeof($cl_teams); $t++) {
            $team = new Team();
            $team->setName($cl_teams[$t]);
            $team->setSlug(strtoupper(substr($cl_teams[$t], 0, 3)));
            $team->setImage('build/images/leagues/Ligue des champions/teams/'.$team->getName().'/Logo.png');

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
            $team = new Team();
            $team->setName($euro_teams[$t]);
            $team->setSlug(strtoupper(substr($euro_teams[$t], 0, 3)));
            $team->setImage('build/images/leagues/Euro 2020/teams/'.$team->getName().'/Logo.png');

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
            $size = new Size();
            $size->setName($sizes[$s]);
            $sizes_tab[] = $size;
            $manager->persist($size);
        }
        /****====================================****/
        /****============== STATUS ==============****/
        $states = ['Domicile', 'Extérieur'];
        $states_tab = [];
        for ($s = 0; $s < sizeof($states); $s++) {
            $state = new State();
            $state->setState($states[$s]);
            $manager->persist($state);
            $states_tab[] = $state;
        }
        /****====================================****/
        /****============== PRODUCTS ============****/
        $products = [];
        for ($p = 0; $p <= 25; $p++) {
            $product = new Product();
            $product->setPrice(49.99);
            $product->setQuantity(10);

            $productTeam = $faker->randomElements($all_teams, $faker->numberBetween(1, sizeof($all_teams)));
            foreach ($productTeam as $team) {
                $product->setTeam($team);
            }
            $productState = $faker->randomElements($states_tab, $faker->numberBetween(1, sizeof($states_tab)));
            foreach ($productState as $state) {
                $product->setState($state);
            }
            $product->setImage('build/images/leagues/'.$product->getTeam()->getLeague()->getName().'/teams/'. $product->getTeam()->getName() .'/'. $product->getState()->getState() .'.png');

            $manager->persist($product);
            $products[] = $product;
        }
        /****====================================****/
        /****============== USERS ===============****/
        $adminRole = new Roles();
        $adminRole->setTitle('ROLE_ADMIN');
        $manager->persist($adminRole);

        $adminUser = new Users();
        $adminUser->setUsername('maximelarrieu')
            ->setEmail('maxime.larrieu@ynov.com')
            ->setPassword($this->encoder->encodePassword($adminUser, 'password'))
            ->addUserRole($adminRole);
        $manager->persist($adminUser);

        $users = [];
            for ($u = 0; $u < 3; $u++) {
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
