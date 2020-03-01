<?php

namespace App\DataFixtures;

use App\Entity\Bank;
use App\Entity\Flocage;
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
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
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

            $normalizer = new ObjectNormalizer();
            $encoder = new JsonEncoder();

            $serializer = new Serializer([$normalizer], [$encoder]);
            $serializer->serialize($team, 'json', ['ignored_attributes' => ['league_id']]);

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
        /****============== FLOCAGE ==============****/
        /****------------- Juventus ------------ ****/
        $floc_juv = ['7. Ronaldo', '10. Dybala', '16. Cuadrado'];
        $floc_juv_tab = [];
        for ($f = 0; $f < sizeof($floc_juv); $f++) {
            $flocage = new Flocage();
            $flocage->setFlocage($floc_juv[$f]);
            $flocage->setTeam($cl_teams_tab[0]);

            $manager->persist($flocage);
            $floc_juv_tab[] = $floc_juv;
        }
        /****------------- Real Madrid ------------ ****/
        $floc_real = ['9. Benzema', '7. Hazard', '25. Vinicus Jr.'];
        $floc_real_tab = [];
        for ($f = 0; $f < sizeof($floc_real); $f++) {
            $flocage = new Flocage();
            $flocage->setFlocage($floc_real[$f]);
            $flocage->setTeam($cl_teams_tab[1]);

            $manager->persist($flocage);
            $floc_real_tab[] = $floc_real;
        }
        /****------------- Manchester United ------------ ****/
        $floc_mu = ['24. Martial', '22. Rashford', '26. Pogba.'];
        $floc_mu_tab = [];
        for ($f = 0; $f < sizeof($floc_mu); $f++) {
            $flocage = new Flocage();
            $flocage->setFlocage($floc_mu[$f]);
            $flocage->setTeam($cl_teams_tab[2]);

            $manager->persist($flocage);
            $floc_mu_tab[] = $floc_mu;
        }
        /****------------- PSG ------------ ****/
        $floc_psg = ['7. Mbappe', '10. Neymar Jr.', '11. Di Maria.'];
        $floc_psg_tab = [];
        for ($f = 0; $f < sizeof($floc_psg); $f++) {
            $flocage = new Flocage();
            $flocage->setFlocage($floc_psg[$f]);
            $flocage->setTeam($cl_teams_tab[3]);

            $manager->persist($flocage);
            $floc_psg_tab[] = $floc_psg;
        }
        /****------------- Liverpool ------------ ****/
        $floc_liv = ['11. Salah', '10. Mane', '3. Fabinho'];
        $floc_liv_tab = [];
        for ($f = 0; $f < sizeof($floc_liv); $f++) {
            $flocage = new Flocage();
            $flocage->setFlocage($floc_liv[$f]);
            $flocage->setTeam($cl_teams_tab[4]);

            $manager->persist($flocage);
            $floc_liv_tab[] = $floc_liv;
        }
        /****------------- Arsenal ------------ ****/
        $floc_ars = ['9. Aubameyang', '1. ARS', '3. ARS'];
        $floc_ars_tab = [];
        for ($f = 0; $f < sizeof($floc_ars); $f++) {
            $flocage = new Flocage();
            $flocage->setFlocage($floc_ars[$f]);
            $flocage->setTeam($cl_teams_tab[5]);

            $manager->persist($flocage);
            $floc_ars_tab[] = $floc_ars;
        }
        /****------------- AC Milan ------------ ****/
        $floc_milan = ['9. Milan', '1. MIL', '3. MIL'];
        $floc_milan_tab = [];
        for ($f = 0; $f < sizeof($floc_milan); $f++) {
            $flocage = new Flocage();
            $flocage->setFlocage($floc_milan[$f]);
            $flocage->setTeam($cl_teams_tab[6]);

            $manager->persist($flocage);
            $floc_milan_tab[] = $floc_milan;
        }
        /****------------- Bayern Munich ------------ ****/
        $floc_bayern = ['9. Lewandoski', '11. Gnabry', '3. BAYERN'];
        $floc_bayern_tab = [];
        for ($f = 0; $f < sizeof($floc_bayern); $f++) {
            $flocage = new Flocage();
            $flocage->setFlocage($floc_bayern[$f]);
            $flocage->setTeam($cl_teams_tab[7]);

            $manager->persist($flocage);
            $floc_bayern_tab[] = $floc_bayern;
        }
        /****------------- Borussia Dortmund ------------ ****/
        $floc_dort = ['10. Reus', '17. Haaland', '3. DORT'];
        $floc_dort_tab = [];
        for ($f = 0; $f < sizeof($floc_dort); $f++) {
            $flocage = new Flocage();
            $flocage->setFlocage($floc_dort[$f]);
            $flocage->setTeam($cl_teams_tab[8]);

            $manager->persist($flocage);
            $floc_dort_tab[] = $floc_dort;
        }
        /****------------- Ajax Amsterdam ------------ ****/
        $floc_ajax = ['10. AJAX', '17. AJAX', '3. AJAX'];
        $floc_ajax_tab = [];
        for ($f = 0; $f < sizeof($floc_ajax); $f++) {
            $flocage = new Flocage();
            $flocage->setFlocage($floc_ajax[$f]);
            $flocage->setTeam($cl_teams_tab[9]);

            $manager->persist($flocage);
            $floc_ajax_tab[] = $floc_ajax;
        }
        /****------------- FC Barcelone ------------ ****/
        $floc_barca = ['9. Suarez', '17. Griezmann', '10. Messi'];
        $floc_barca_tab = [];
        for ($f = 0; $f < sizeof($floc_barca); $f++) {
            $flocage = new Flocage();
            $flocage->setFlocage($floc_barca[$f]);
            $flocage->setTeam($cl_teams_tab[10]);

            $manager->persist($flocage);
            $floc_barca_tab[] = $floc_barca;
        }
        /****=====================================****/
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

            $normalizer = new ObjectNormalizer();
            $encoder = new JsonEncoder();

            $serializer = new Serializer([$normalizer], [$encoder]);
            $serializer->serialize($product, 'json', ['ignored_attributes' => ['team_id', 'state_id', 'size_id']]);

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
