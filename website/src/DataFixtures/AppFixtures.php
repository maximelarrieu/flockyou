<?php

namespace App\DataFixtures;

use App\Entity\Cart;
use App\Entity\Comment;
use App\Entity\Flocage;
use App\Entity\League;
use App\Entity\Purchase;
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
            'Bayern Munich', 'Borussia Dortmund', 'Ajax', 'FC Barcelone',
            'AS Monaco', 'Atletico Madrid', 'AS Rome', 'Benfica', 'FC Porto',
            'Galatasaray', 'Inter Milan', 'Lyon', 'Manchester City', 'Naples',
            'Schalke', 'Tottenham Hotspur'
        ];
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
            'Italie', 'Espagne', 'Pays-Bas', 'Irlande',
            'Turquie', 'Croatie', 'Finlande', 'Pays de Galles', 'Pologne',
            'République Tchèque'];
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
        /****~~~~~~~~~ Champions League ~~~~~~~~~****/
        /****------------- Juventus ------------ ****/
        $floc_juv = ['7. Ronaldo', '10. Dybala', '16. Cuadrado'];
        $floc_juv_tab = [];
        for ($f = 0; $f < sizeof($floc_juv); $f++) {
            $flocage = new Flocage();
            $flocage->setFlocage($floc_juv[$f]);
            $flocage->setTeam($cl_teams_tab[0]);

            $manager->persist($flocage);
            $floc_juv_tab[] = $flocage;
        }
        /****------------- Real Madrid ------------ ****/
        $floc_real = ['9. Benzema', '7. Hazard', '25. Vinicus Jr.'];
        $floc_real_tab = [];
        for ($f = 0; $f < sizeof($floc_real); $f++) {
            $flocage = new Flocage();
            $flocage->setFlocage($floc_real[$f]);
            $flocage->setTeam($cl_teams_tab[1]);

            $manager->persist($flocage);
            $floc_real_tab[] = $flocage;
        }
        /****------------- Manchester United ------------ ****/
        $floc_mu = ['24. Martial', '22. Rashford', '26. Pogba'];
        $floc_mu_tab = [];
        for ($f = 0; $f < sizeof($floc_mu); $f++) {
            $flocage = new Flocage();
            $flocage->setFlocage($floc_mu[$f]);
            $flocage->setTeam($cl_teams_tab[2]);

            $manager->persist($flocage);
            $floc_mu_tab[] = $flocage;
        }
        /****------------- PSG ------------ ****/
        $floc_psg = ['7. Mbappe', '10. Neymar Jr.', '11. Di Maria'];
        $floc_psg_tab = [];
        for ($f = 0; $f < sizeof($floc_psg); $f++) {
            $flocage = new Flocage();
            $flocage->setFlocage($floc_psg[$f]);
            $flocage->setTeam($cl_teams_tab[3]);

            $manager->persist($flocage);
            $floc_psg_tab[] = $flocage;
        }
        /****------------- Liverpool ------------ ****/
        $floc_liv = ['11. Salah', '10. Mane', '3. Fabinho'];
        $floc_liv_tab = [];
        for ($f = 0; $f < sizeof($floc_liv); $f++) {
            $flocage = new Flocage();
            $flocage->setFlocage($floc_liv[$f]);
            $flocage->setTeam($cl_teams_tab[4]);

            $manager->persist($flocage);
            $floc_liv_tab[] = $flocage;
        }
        /****------------- Arsenal ------------ ****/
        $floc_ars = ['14. Aubameyang', '9. Lacazette', '10. Ozil'];
        $floc_ars_tab = [];
        for ($f = 0; $f < sizeof($floc_ars); $f++) {
            $flocage = new Flocage();
            $flocage->setFlocage($floc_ars[$f]);
            $flocage->setTeam($cl_teams_tab[5]);

            $manager->persist($flocage);
            $floc_ars_tab[] = $flocage;
        }
        /****------------- AC Milan ------------ ****/
        $floc_milan = ['21. Ibrahimovic', '7. Castillejo', '4. Bennacer'];
        $floc_milan_tab = [];
        for ($f = 0; $f < sizeof($floc_milan); $f++) {
            $flocage = new Flocage();
            $flocage->setFlocage($floc_milan[$f]);
            $flocage->setTeam($cl_teams_tab[6]);

            $manager->persist($flocage);
            $floc_milan_tab[] = $flocage;
        }
        /****------------- Bayern Munich ------------ ****/
        $floc_bayern = ['9. Lewandoski', '22. Gnabry', '29. Couthino'];
        $floc_bayern_tab = [];
        for ($f = 0; $f < sizeof($floc_bayern); $f++) {
            $flocage = new Flocage();
            $flocage->setFlocage($floc_bayern[$f]);
            $flocage->setTeam($cl_teams_tab[7]);

            $manager->persist($flocage);
            $floc_bayern_tab[] = $flocage;
        }
        /****------------- Borussia Dortmund ------------ ****/
        $floc_dort = ['11. Reus', '17. Haaland', '7. Sancho'];
        $floc_dort_tab = [];
        for ($f = 0; $f < sizeof($floc_dort); $f++) {
            $flocage = new Flocage();
            $flocage->setFlocage($floc_dort[$f]);
            $flocage->setTeam($cl_teams_tab[8]);

            $manager->persist($flocage);
            $floc_dort_tab[] = $flocage;
        }
        /****------------- Ajax Amsterdam ------------ ****/
        $floc_ajax = ['23. Traoré', '11. Promes', '8. Eiting'];
        $floc_ajax_tab = [];
        for ($f = 0; $f < sizeof($floc_ajax); $f++) {
            $flocage = new Flocage();
            $flocage->setFlocage($floc_ajax[$f]);
            $flocage->setTeam($cl_teams_tab[9]);

            $manager->persist($flocage);
            $floc_ajax_tab[] = $flocage;
        }
        /****------------- FC Barcelone ------------ ****/
        $floc_barca = ['9. Suarez', '17. Griezmann', '10. Messi'];
        $floc_barca_tab = [];
        for ($f = 0; $f < sizeof($floc_barca); $f++) {
            $flocage = new Flocage();
            $flocage->setFlocage($floc_barca[$f]);
            $flocage->setTeam($cl_teams_tab[10]);

            $manager->persist($flocage);
            $floc_barca_tab[] = $flocage;
        }
        /****------------- AS Monaco ------------ ****/
        $floc_asm = ['9. Ben Yedder', '20. Slimani', '17. Golovin'];
        $floc_asm_tab = [];
        for ($f = 0; $f < sizeof($floc_asm); $f++) {
            $flocage = new Flocage();
            $flocage->setFlocage($floc_asm[$f]);
            $flocage->setTeam($cl_teams_tab[11]);

            $manager->persist($flocage);
            $floc_asm_tab[] = $flocage;
        }
        /****------------- Atlético Madrid ------------ ****/
        $floc_atm = ['11. Lemar', '7. Joäo Félix', '6. Koke'];
        $floc_atm_tab = [];
        for ($f = 0; $f < sizeof($floc_atm); $f++) {
            $flocage = new Flocage();
            $flocage->setFlocage($floc_atm[$f]);
            $flocage->setTeam($cl_teams_tab[12]);

            $manager->persist($flocage);
            $floc_atm_tab[] = $flocage;
        }
        /****------------- AS Rome ------------ ****/
        $floc_asr = ['6. Smalling', '7. Pelligrini', '9. Dzeko'];
        $floc_asr_tab = [];
        for ($f = 0; $f < sizeof($floc_asr); $f++) {
            $flocage = new Flocage();
            $flocage->setFlocage($floc_asr[$f]);
            $flocage->setTeam($cl_teams_tab[13]);

            $manager->persist($flocage);
            $floc_asr_tab[] = $flocage;
        }
        /****------------- Benfica ------------ ****/
        $floc_ben = ['19. Chiquinho', '27. Silva', '8. Gabriel'];
        $floc_ben_tab = [];
        for ($f = 0; $f < sizeof($floc_ben); $f++) {
            $flocage = new Flocage();
            $flocage->setFlocage($floc_ben[$f]);
            $flocage->setTeam($cl_teams_tab[14]);

            $manager->persist($flocage);
            $floc_ben_tab[] = $flocage;
        }
        /****------------- FC Porto ------------ ****/
        $floc_fcp = ['29. Soares', '8. Baro', '25. Octavio'];
        $floc_fcp_tab = [];
        for ($f = 0; $f < sizeof($floc_ben); $f++) {
            $flocage = new Flocage();
            $flocage->setFlocage($floc_fcp[$f]);
            $flocage->setTeam($cl_teams_tab[15]);

            $manager->persist($flocage);
            $floc_fcp_tab[] = $flocage;
        }
        /****------------- Galatasaray ------------ ****/
        $floc_ga = ['9. Falcao', '20. Akbaba', '14. Linnes'];
        $floc_ga_tab = [];
        for ($f = 0; $f < sizeof($floc_ga); $f++) {
            $flocage = new Flocage();
            $flocage->setFlocage($floc_ga[$f]);
            $flocage->setTeam($cl_teams_tab[16]);

            $manager->persist($flocage);
            $floc_ga_tab[] = $flocage;
        }
        /****------------- Inter Milan ------------ ****/
        $floc_im = ['24. Eriksen', '9. Lukaku', '20. Valero'];
        $floc_im_tab = [];
        for ($f = 0; $f < sizeof($floc_im); $f++) {
            $flocage = new Flocage();
            $flocage->setFlocage($floc_im[$f]);
            $flocage->setTeam($cl_teams_tab[17]);

            $manager->persist($flocage);
            $floc_im_tab[] = $flocage;
        }
        /****------------- Lyon ------------ ****/
        $floc_ly = ['18. Cherki', '9. Dembélé', '8. Aouar'];
        $floc_ly_tab = [];
        for ($f = 0; $f < sizeof($floc_ly); $f++) {
            $flocage = new Flocage();
            $flocage->setFlocage($floc_ly[$f]);
            $flocage->setTeam($cl_teams_tab[18]);

            $manager->persist($flocage);
            $floc_ly_tab[] = $flocage;
        }
        /****------------- Manchester City ------------ ****/
        $floc_mc = ['9. Jesus', '19. Sané', '7. Sterling'];
        $floc_mc_tab = [];
        for ($f = 0; $f < sizeof($floc_mc); $f++) {
            $flocage = new Flocage();
            $flocage->setFlocage($floc_mc[$f]);
            $flocage->setTeam($cl_teams_tab[19]);

            $manager->persist($flocage);
            $floc_mc_tab[] = $flocage;
        }
        /****------------- Naples ------------ ****/
        $floc_na = ['21. Politano', '5. Allan', '14. Mertens'];
        $floc_na_tab = [];
        for ($f = 0; $f < sizeof($floc_na); $f++) {
            $flocage = new Flocage();
            $flocage->setFlocage($floc_na[$f]);
            $flocage->setTeam($cl_teams_tab[20]);

            $manager->persist($flocage);
            $floc_na_tab[] = $flocage;
        }
        /****------------- Schalke ------------ ****/
        $floc_sch = ['14. Matondo', '37. Mercan', '8. Serdar'];
        $floc_sch_tab = [];
        for ($f = 0; $f < sizeof($floc_sch); $f++) {
            $flocage = new Flocage();
            $flocage->setFlocage($floc_sch[$f]);
            $flocage->setTeam($cl_teams_tab[21]);

            $manager->persist($flocage);
            $floc_sch_tab[] = $flocage;
        }
        /****------------- Tottenham Hotspur ------------ ****/
        $floc_tott = ['7. Son', '20. Alli', '10. Kane'];
        $floc_tott_tab = [];
        for ($f = 0; $f < sizeof($floc_tott); $f++) {
            $flocage = new Flocage();
            $flocage->setFlocage($floc_tott[$f]);
            $flocage->setTeam($cl_teams_tab[22]);

            $manager->persist($flocage);
            $floc_tott_tab[] = $flocage;
        }
        /****~~~~~~~~~ Euro 2020 ~~~~~~~~~****/
        /****------------- Portugal ------------ ****/
        $floc_port = ['7. Ronaldo', '10. Silva', '13. Pereira'];
        $floc_port_tab = [];
        for ($f = 0; $f < sizeof($floc_port); $f++) {
            $flocage = new Flocage();
            $flocage->setFlocage($floc_port[$f]);
            $flocage->setTeam($euro_teams_tab[0]);

            $manager->persist($flocage);
            $floc_port_tab[] = $flocage;
        }
        /****------------- France ------------ ****/
        $floc_fr = ['10. Mbappe', '9. Giroud', '12. Tolisso'];
        $floc_fr_tab = [];
        for ($f = 0; $f < sizeof($floc_fr); $f++) {
            $flocage = new Flocage();
            $flocage->setFlocage($floc_fr[$f]);
            $flocage->setTeam($euro_teams_tab[1]);

            $manager->persist($flocage);
            $floc_fr_tab[] = $flocage;
        }
        /****------------- Allemagne ------------ ****/
        $floc_all = ['20. Gnabry', '8. Kroos', '6. Kimmich'];
        $floc_all_tab = [];
        for ($f = 0; $f < sizeof($floc_all); $f++) {
            $flocage = new Flocage();
            $flocage->setFlocage($floc_all[$f]);
            $flocage->setTeam($euro_teams_tab[2]);

            $manager->persist($flocage);
            $floc_all_tab[] = $flocage;
        }
        /****------------- Belgique ------------ ****/
        $floc_bel = ['9. Lukaku', '23. Batshuayi', '10. Hazard'];
        $floc_bel_tab = [];
        for ($f = 0; $f < sizeof($floc_bel); $f++) {
            $flocage = new Flocage();
            $flocage->setFlocage($floc_bel[$f]);
            $flocage->setTeam($euro_teams_tab[3]);

            $manager->persist($flocage);
            $floc_bel_tab[] = $flocage;
        }
        /****------------- Suède ------------ ****/
        $floc_su = ['19. Larsson', '15. Berggren', '9. Karlsson'];
        $floc_su_tab = [];
        for ($f = 0; $f < sizeof($floc_su); $f++) {
            $flocage = new Flocage();
            $flocage->setFlocage($floc_su[$f]);
            $flocage->setTeam($euro_teams_tab[4]);

            $manager->persist($flocage);
            $floc_su_tab[] = $flocage;
        }
        /****------------- Suisse ------------ ****/
        $floc_sui = ['19. Vargas', '10. Xhaka', '8. Aebischer'];
        $floc_sui_tab = [];
        for ($f = 0; $f < sizeof($floc_sui); $f++) {
            $flocage = new Flocage();
            $flocage->setFlocage($floc_sui[$f]);
            $flocage->setTeam($euro_teams_tab[5]);

            $manager->persist($flocage);
            $floc_sui_tab[] = $flocage;
        }
        /****------------- Autriche ------------ ****/
        $floc_aut = ['8. Alaba', '22. Lazaro', '18. Laimer'];
        $floc_aut_tab = [];
        for ($f = 0; $f < sizeof($floc_aut); $f++) {
            $flocage = new Flocage();
            $flocage->setFlocage($floc_aut[$f]);
            $flocage->setTeam($euro_teams_tab[6]);

            $manager->persist($flocage);
            $floc_aut_tab[] = $flocage;
        }
        /****------------- Russie ------------ ****/
        $floc_ru = ['10. Bakaev', '7. Ozdoev', '17. FOmin'];
        $floc_ru_tab = [];
        for ($f = 0; $f < sizeof($floc_ru); $f++) {
            $flocage = new Flocage();
            $flocage->setFlocage($floc_ru[$f]);
            $flocage->setTeam($euro_teams_tab[7]);

            $manager->persist($flocage);
            $floc_ru_tab[] = $flocage;
        }
        /****------------- Italie ------------ ****/
        $floc_ita = ['17. Immobile', '10. Insigne', '6. Tonali'];
        $floc_ita_tab = [];
        for ($f = 0; $f < sizeof($floc_ita); $f++) {
            $flocage = new Flocage();
            $flocage->setFlocage($floc_ita[$f]);
            $flocage->setTeam($euro_teams_tab[8]);

            $manager->persist($flocage);
            $floc_ita_tab[] = $flocage;
        }
        /****------------- Espagne ------------ ****/
        $floc_esp = ['7. Morata', '9. Alcacer', '15. Ramos'];
        $floc_esp_tab = [];
        for ($f = 0; $f < sizeof($floc_esp); $f++) {
            $flocage = new Flocage();
            $flocage->setFlocage($floc_esp[$f]);
            $flocage->setTeam($euro_teams_tab[9]);

            $manager->persist($flocage);
            $floc_esp_tab[] = $flocage;
        }
        /****------------- Pays-Bas ------------ ****/
        $floc_pb = ['19. De Jong', '8. Wijnaldum', '3. De Light'];
        $floc_pb_tab = [];
        for ($f = 0; $f < sizeof($floc_pb); $f++) {
            $flocage = new Flocage();
            $flocage->setFlocage($floc_pb[$f]);
            $flocage->setTeam($euro_teams_tab[10]);

            $manager->persist($flocage);
            $floc_pb_tab[] = $flocage;
        }
        /****------------- Irlande ------------ ****/
        $floc_ir = ['24. Connolly', '12. Robinson', '10. Brady'];
        $floc_ir_tab = [];
        for ($f = 0; $f < sizeof($floc_ir); $f++) {
            $flocage = new Flocage();
            $flocage->setFlocage($floc_ir[$f]);
            $flocage->setTeam($euro_teams_tab[11]);

            $manager->persist($flocage);
            $floc_ir_tab[] = $flocage;
        }
        /****------------- Turquie ------------ ****/
        $floc_tur = ['10. Calhanoglu', '7. Kilinc', '11. Yazici'];
        $floc_tur_tab = [];
        for ($f = 0; $f < sizeof($floc_tur); $f++) {
            $flocage = new Flocage();
            $flocage->setFlocage($floc_tur[$f]);
            $flocage->setTeam($euro_teams_tab[12]);

            $manager->persist($flocage);
            $floc_tur_tab[] = $flocage;
        }
        /****------------- Croatie ------------ ****/
        $floc_cro = ['9. Jensen', '22. Raitala', '13. Solri'];
        $floc_cro_tab = [];
        for ($f = 0; $f < sizeof($floc_cro); $f++) {
            $flocage = new Flocage();
            $flocage->setFlocage($floc_cro[$f]);
            $flocage->setTeam($euro_teams_tab[13]);

            $manager->persist($flocage);
            $floc_cro_tab[] = $flocage;
        }
        /****------------- Finlande ------------ ****/
        $floc_fin = ['10. Calhanoglu', '7. Kilinc', '11. Yazici'];
        $floc_fin_tab = [];
        for ($f = 0; $f < sizeof($floc_fin); $f++) {
            $flocage = new Flocage();
            $flocage->setFlocage($floc_fin[$f]);
            $flocage->setTeam($euro_teams_tab[14]);

            $manager->persist($flocage);
            $floc_fin_tab[] = $flocage;
        }
        /****------------- Pays de Galles ------------ ****/
        $floc_pdg = ['7. Allen', '3. Taylor', '12. Vaulks'];
        $floc_pdg_tab = [];
        for ($f = 0; $f < sizeof($floc_pdg); $f++) {
            $flocage = new Flocage();
            $flocage->setFlocage($floc_pdg[$f]);
            $flocage->setTeam($euro_teams_tab[15]);

            $manager->persist($flocage);
            $floc_pdg_tab[] = $flocage;
        }
        /****------------- Pologne ------------ ****/
        $floc_pol = ['6. Golarski', '19. Szymanski', '14. Klich'];
        $floc_pol_tab = [];
        for ($f = 0; $f < sizeof($floc_pol); $f++) {
            $flocage = new Flocage();
            $flocage->setFlocage($floc_pol[$f]);
            $flocage->setTeam($euro_teams_tab[16]);

            $manager->persist($flocage);
            $floc_pol_tab[] = $flocage;
        }
        /****------------- République Tchèque ------------ ****/
        $floc_rp = ['9. Ondrasek', '15. Soucek', '8. Darida'];
        $floc_rp_tab = [];
        for ($f = 0; $f < sizeof($floc_rp); $f++) {
            $flocage = new Flocage();
            $flocage->setFlocage($floc_rp[$f]);
            $flocage->setTeam($euro_teams_tab[17]);

            $manager->persist($flocage);
            $floc_rp_tab[] = $flocage;
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
        /****============== USERS ===============****/
        $cart = new Cart();
        $adminRole = new Roles();
        $adminRole->setTitle('ROLE_ADMIN');
        $manager->persist($adminRole);

        $adminUser = new Users();
        $adminUser->setUsername('maximelarrieu')
            ->setEmail('maxime.larrieu@ynov.com')
            ->setPassword($this->encoder->encodePassword($adminUser, 'password'))
            ->addUserRole($adminRole)
            ->setBudget(300)
            ->setCart($cart);

        $manager->persist($adminUser);

        $users = [];
        for ($u = 0; $u < 3; $u++) {
            $user = new Users();

            $password = $this->encoder->encodePassword($user, 'password');

            $user->setUsername($faker->userName)
                ->setEmail($faker->freeEmail)
                ->setPassword($password)
                ->setBudget(200);
            $manager->persist($user);
        }
        $users[] = $user;
        /****====================================****/
        /****============== PRODUCTS ============****/
        $products = [];
        for ($p = 0; $p <= 25; $p++) {
            $product = new Product();
            $product->setPrice(49.99);
            $product->setQuantity(mt_rand(0,10));
            $product->setCreatedAt(new \DateTime());

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

            /***======== RATING ======***/
            $comment = new Comment();
            $comment->setContent($faker->paragraph())
                    ->setRating(mt_rand(1, 5))
                    ->setProduct($product)
                    ->setAuthor($user);

            $manager->persist($comment);

        }
        /****====================================****/

        $manager->flush();
    }
}
