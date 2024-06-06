<?php

namespace Database\Seeders;

use App\Models\Ressource;
use App\Services\TruncateTableService;
use Illuminate\Database\Seeder;

class RessourceSeeder extends Seeder
{
    /**
     * The TruncateTableService instance.
     *
     * @var TruncateTableService
     */
    private $truncateTableService;

    /**
     * Constructor.
     *
     * @param TruncateTableService $truncateTableService
     */
    public function __construct(TruncateTableService $truncateTableService)
    {
        $this->truncateTableService = $truncateTableService;
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->truncateTableService->truncateTable('ressource');
        $ressourceData = [
            ['id' => 1, 'titre_res' => 'Comment améliorer vos compétences en communication', 'contenu_res' => 'Découvrez des conseils pratiques pour améliorer votre communication interpersonnelle et professionnelle.', 'url_res' => 'https://firebasestorage.googleapis.com/v0/b/cube-firebase-c82bf.appspot.com/o/2482efc3-bc9a-4920-9780-0df5e66cfae2.jpeg?alt=media&token=efebacda-f0dc-4f6e-9a64-a6e0b521e3b5', 'id_type_res' => 1, 'id_vis' => 1, 'id_createur' => 1, 'date_creation' => '2022-02-02 14:25:25', 'is_archive' => 0, 'id_etat' => 2 ],
            ['id' => 2, 'titre_res' => 'Les grands classiques de la littérature mondiale', 'contenu_res' => 'Explorez les chefs-d\'œuvre de la littérature mondiale, de Shakespeare à Tolstoï.', 'url_res' => 'https://firebasestorage.googleapis.com/v0/b/cube-firebase-c82bf.appspot.com/o/ai-generated-8116143_1280.jpg?alt=media&token=ce17ea7c-2615-4355-b294-fabeee801c89', 'id_type_res' => 2, 'id_vis' => 1, 'id_createur' => 2, 'date_creation' => '2022-02-02 15:25:25', 'is_archive' => 0, 'id_etat' => 2 ],
            ['id' => 3, 'titre_res' => 'Entraînement intensif pour devenir un athlète', 'contenu_res' => 'Suivez un programme d\'entraînement intense pour améliorer votre condition physique et devenir un meilleur athlète.', 'url_res' => 'https://firebasestorage.googleapis.com/v0/b/cube-firebase-c82bf.appspot.com/o/books-5372392_1280.jpg?alt=media&token=6f032daf-581a-43b9-a824-425b6d131a5d', 'id_type_res' => 3, 'id_vis' => 1, 'id_createur' => 3, 'date_creation' => '2022-02-02 13:25:25', 'is_archive' => 1, 'id_etat' => 2 ],
            ['id' => 4, 'titre_res' => 'Comment gérer son budget et ses finances', 'contenu_res' => 'Apprenez à établir un budget, à économiser de l\'argent et à investir pour votre avenir financier.', 'url_res' => 'https://firebasestorage.googleapis.com/v0/b/cube-firebase-c82bf.appspot.com/o/cactus-8384331_1280.jpg?alt=media&token=4e14d038-a700-4b76-bbe7-8e33d34d030c', 'id_type_res' => 1, 'id_vis' => 1, 'id_createur' => 1, 'date_creation' => '2022-02-02 14:30:00', 'is_archive' => 0, 'id_etat' => 2 ],
            ['id' => 5, 'titre_res' => 'Les nouvelles technologies qui changeront le monde', 'contenu_res' => 'Découvrez les dernières innovations technologiques et comment elles pourraient façonner notre avenir.', 'url_res' => 'https://firebasestorage.googleapis.com/v0/b/cube-firebase-c82bf.appspot.com/o/calculator-385506_1280.jpg?alt=media&token=9e1b42a6-fc89-4bfd-bd3c-eb444970413e', 'id_type_res' => 3, 'id_vis' => 1, 'id_createur' => 2, 'date_creation' => '2022-02-02 16:45:00', 'is_archive' => 0, 'id_etat' => 2 ],
            ['id' => 6, 'titre_res' => 'Guide pratique pour une alimentation saine', 'contenu_res' => 'Apprenez à manger sainement en suivant des conseils simples et des recettes nutritives.', 'url_res' => 'https://firebasestorage.googleapis.com/v0/b/cube-firebase-c82bf.appspot.com/o/carnival-8028612_1280.jpg?alt=media&token=a7d3b3f3-10e3-4493-a4d2-89744d97066e', 'id_type_res' => 3, 'id_vis' => 1, 'id_createur' => 3, 'date_creation' => '2022-02-02 12:10:00', 'is_archive' => 1, 'id_etat' => 2 ],
            ['id' => 7, 'titre_res' => 'Les techniques de méditation pour le bien-être mental', 'contenu_res' => 'Explorez différentes techniques de méditation pour réduire le stress et améliorer votre bien-être mental.', 'url_res' => 'https://firebasestorage.googleapis.com/v0/b/cube-firebase-c82bf.appspot.com/o/chess-1215079_1280.jpg?alt=media&token=a1a7a146-5d3d-41c0-9bbc-21088b8a6190', 'id_type_res' => 2, 'id_vis' => 1, 'id_createur' => 1, 'date_creation' => '2022-02-02 11:20:00', 'is_archive' => 0, 'id_etat' => 2 ],
            ['id' => 8, 'titre_res' => 'Conseils pour une vie plus écologique', 'contenu_res' => 'Découvrez des moyens simples de réduire votre empreinte écologique et de vivre de manière plus durable.', 'url_res' => 'https://firebasestorage.googleapis.com/v0/b/cube-firebase-c82bf.appspot.com/o/chili-pepper-1783761_1280.jpg?alt=media&token=25d785f8-73d4-46c6-b285-934790fe890d', 'id_type_res' => 1, 'id_vis' => 1, 'id_createur' => 2, 'date_creation' => '2022-02-02 10:05:00', 'is_archive' => 1, 'id_etat' => 2 ],
            ['id' => 9, 'titre_res' => 'Stratégies pour réussir vos études universitaires', 'contenu_res' => 'Apprenez des stratégies efficaces pour étudier, organiser votre temps et réussir vos examens à l\'université.', 'url_res' => 'https://firebasestorage.googleapis.com/v0/b/cube-firebase-c82bf.appspot.com/o/climbing-2609319_1280.jpg?alt=media&token=17828761-cfd4-4758-a215-ad3325fc1631', 'id_type_res' => 2, 'id_vis' => 1, 'id_createur' => 3, 'date_creation' => '2022-02-02 09:15:00', 'is_archive' => 0, 'id_etat' => 2 ],
            ['id' => 10, 'titre_res' => 'Conseils pour une meilleure gestion du temps', 'contenu_res' => 'Découvrez des techniques pour gérer votre temps efficacement, prioriser vos tâches et atteindre vos objectifs.', 'url_res' => 'https://firebasestorage.googleapis.com/v0/b/cube-firebase-c82bf.appspot.com/o/computer-games-6578102_1280.jpg?alt=media&token=71ab1f77-e94c-4706-8f7f-7990b395c232', 'id_type_res' => 1, 'id_vis' => 1, 'id_createur' => 1, 'date_creation' => '2022-02-02 08:30:00', 'is_archive' => 0, 'id_etat' => 2 ],
            ['id' => 11, 'titre_res' => 'Les secrets d\'une communication efficace', 'contenu_res' => 'Découvrez les clés pour communiquer efficacement dans toutes les situations, que ce soit en public, en ligne ou en face à face.', 'url_res' => 'https://firebasestorage.googleapis.com/v0/b/cube-firebase-c82bf.appspot.com/o/crayons-879973_1280.jpg?alt=media&token=385bf183-02b4-4907-b563-f37436d81e21', 'id_type_res' => 1, 'id_vis' => 1, 'id_createur' => 1, 'date_creation' => '2022-02-02 14:25:25', 'is_archive' => 0, 'id_etat' => 2 ],
            ['id' => 12, 'titre_res' => 'L\'art et la culture du monde entier', 'contenu_res' => 'Explorez la richesse de l\'art et de la culture à travers le monde, des grandes œuvres d\'art aux traditions culturelles uniques.', 'url_res' => 'https://firebasestorage.googleapis.com/v0/b/cube-firebase-c82bf.appspot.com/o/cyclists-1851269_1280.jpg?alt=media&token=dbdb2f04-00be-41a0-8ac7-ef856a43a958', 'id_type_res' => 2, 'id_vis' => 1, 'id_createur' => 2, 'date_creation' => '2022-02-02 15:25:25', 'is_archive' => 0, 'id_etat' => 2 ],
            ['id' => 13, 'titre_res' => 'Entraînement intensif pour devenir un athlète', 'contenu_res' => 'Suivez un programme d\'entraînement intense pour améliorer votre condition physique et devenir un meilleur athlète.', 'url_res' => 'https://firebasestorage.googleapis.com/v0/b/cube-firebase-c82bf.appspot.com/o/eye-1553789_1280.jpg?alt=media&token=212eb232-328e-46cb-9c5d-0dab41512061', 'id_type_res' => 3, 'id_vis' => 1, 'id_createur' => 3, 'date_creation' => '2022-02-02 13:25:25', 'is_archive' => 1, 'id_etat' => 2 ],
            ['id' => 14, 'titre_res' => 'Les dernières avancées technologiques', 'contenu_res' => 'Découvrez les toutes dernières avancées technologiques dans le domaine de la robotique, de l\'intelligence artificielle et bien plus encore.', 'url_res' => 'https://firebasestorage.googleapis.com/v0/b/cube-firebase-c82bf.appspot.com/o/flower-273391_1280.jpg?alt=media&token=6f46a58e-d6d7-4544-827b-5c09ba3d757b', 'id_type_res' => 1, 'id_vis' => 1, 'id_createur' => 2, 'date_creation' => '2022-02-03 09:15:30', 'is_archive' => 0, 'id_etat' => 2 ],
            ['id' => 15, 'titre_res' => 'Comment gérer vos finances personnelles efficacement', 'contenu_res' => 'Apprenez des techniques et des stratégies pour gérer vos finances personnelles de manière responsable et efficace.', 'url_res' => 'https://firebasestorage.googleapis.com/v0/b/cube-firebase-c82bf.appspot.com/o/flower-5431090_1280.jpg?alt=media&token=a6242dde-08ef-4970-b631-9028115e9f23', 'id_type_res' => 1, 'id_vis' => 1, 'id_createur' => 1, 'date_creation' => '2022-02-04 10:30:45', 'is_archive' => 0, 'id_etat' => 2 ],
            ['id' => 16, 'titre_res' => 'Guide pratique pour une éducation de qualité', 'contenu_res' => 'Découvrez des conseils pratiques pour améliorer la qualité de l\'éducation, que ce soit à l\'école, à la maison ou dans d\'autres environnements éducatifs.', 'url_res' => 'https://firebasestorage.googleapis.com/v0/b/cube-firebase-c82bf.appspot.com/o/flower-field-250016_1280.jpg?alt=media&token=bb1cd0de-7153-4bec-b39c-40b0ed90f02d', 'id_type_res' => 1, 'id_vis' => 1, 'id_createur' => 3, 'date_creation' => '2022-02-05 11:45:00', 'is_archive' => 0, 'id_etat' => 2 ],
            ['id' => 17, 'titre_res' => 'Les bienfaits d\'une vie saine', 'contenu_res' => 'Découvrez les nombreux avantages d\'un mode de vie sain, notamment sur la santé physique, mentale et émotionnelle.', 'url_res' => 'https://firebasestorage.googleapis.com/v0/b/cube-firebase-c82bf.appspot.com/o/football-488714_1280.jpg?alt=media&token=2ecd2118-1e56-4893-b423-a12f77aba0ed', 'id_type_res' => 1, 'id_vis' => 1, 'id_createur' => 1, 'date_creation' => '2022-02-06 12:55:00', 'is_archive' => 0, 'id_etat' => 2 ],
            ['id' => 18, 'titre_res' => 'Les techniques de méditation pour la tranquillité d\'esprit', 'contenu_res' => 'Explorez différentes techniques de méditation pour réduire le stress, améliorer la concentration et trouver la tranquillité d\'esprit.', 'url_res' => 'https://firebasestorage.googleapis.com/v0/b/cube-firebase-c82bf.appspot.com/o/football-67701_1280.jpg?alt=media&token=44658ddf-0d91-4056-83f4-170ecaf95f77', 'id_type_res' => 1, 'id_vis' => 1, 'id_createur' => 2, 'date_creation' => '2022-02-07 14:20:00', 'is_archive' => 0, 'id_etat' => 2 ],
            ['id' => 19, 'titre_res' => 'Les bases de la nutrition pour une vie équilibrée', 'contenu_res' => 'Apprenez les principes fondamentaux de la nutrition pour une alimentation équilibrée et un mode de vie sain.', 'url_res' => 'https://firebasestorage.googleapis.com/v0/b/cube-firebase-c82bf.appspot.com/o/gettyimages-108312496-612x612.jpg?alt=media&token=b5e4f15a-ad7c-4608-944e-80b8f1666cb4', 'id_type_res' => 1, 'id_vis' => 1, 'id_createur' => 3, 'date_creation' => '2022-02-08 16:30:00', 'is_archive' => 1, 'id_etat' => 2 ],
            ['id' => 20, 'titre_res' => 'Les nouvelles tendances dans le monde de l\'éducation', 'contenu_res' => 'Découvrez les nouvelles tendances et les innovations dans le domaine de l\'éducation, de l\'enseignement à distance à l\'apprentissage personnalisé.', 'url_res' => 'https://firebasestorage.googleapis.com/v0/b/cube-firebase-c82bf.appspot.com/o/gettyimages-1149548556-612x612.jpg?alt=media&token=622415a0-0bb7-4749-8ce2-570d70b4d221', 'id_type_res' => 1, 'id_vis' => 1, 'id_createur' => 1, 'date_creation' => '2022-02-08 16:30:00', 'is_archive' => 1, 'id_etat' => 2 ],
            ['id' => 21, 'titre_res' => 'Les secrets d\'une communication efficace en ligne', 'contenu_res' => 'Découvrez comment communiquer efficacement en ligne, que ce soit par e-mail, sur les réseaux sociaux ou lors de réunions virtuelles.', 'url_res' => 'https://firebasestorage.googleapis.com/v0/b/cube-firebase-c82bf.appspot.com/o/gettyimages-1152663825-612x612.jpg?alt=media&token=bb8d7561-8a3b-46e9-a1ab-04d08a8888c0', 'id_type_res' => 1, 'id_vis' => 1, 'id_createur' => 2, 'date_creation' => '2022-02-10 09:45:00', 'is_archive' => 0, 'id_etat' => 2 ],
            ['id' => 22, 'titre_res' => 'Exploration des arts du spectacle à travers les âges', 'contenu_res' => 'Découvrez l\'histoire et l\'évolution des arts du spectacle, y compris le théâtre, la danse, la musique et bien plus encore.', 'url_res' => 'https://firebasestorage.googleapis.com/v0/b/cube-firebase-c82bf.appspot.com/o/gettyimages-1152663825-612x612.jpg?alt=media&token=bb8d7561-8a3b-46e9-a1ab-04d08a8888c0', 'id_type_res' => 2, 'id_vis' => 2, 'id_createur' => 3, 'date_creation' => '2022-02-11 10:30:00', 'is_archive' => 0, 'id_etat' => 2 ],
            ['id' => 23, 'titre_res' => 'Programme d\'entraînement pour devenir un marathonien', 'contenu_res' => 'Suivez un programme d\'entraînement complet pour vous préparer à courir un marathon, du renforcement musculaire à la nutrition.', 'url_res' => 'https://firebasestorage.googleapis.com/v0/b/cube-firebase-c82bf.appspot.com/o/gettyimages-182898513-612x612.jpg?alt=media&token=03964757-3937-4e8e-97aa-846960cc4c8d', 'id_type_res' => 3, 'id_vis' => 1, 'id_createur' => 1, 'date_creation' => '2022-02-12 11:15:00', 'is_archive' => 0, 'id_etat' => 2 ],
            ['id' => 24, 'titre_res' => 'Les avancées révolutionnaires dans le domaine de la robotique', 'contenu_res' => 'Découvrez les dernières avancées dans le domaine de la robotique, de l\'intelligence artificielle et de la domotique, et leur impact sur notre vie quotidienne.', 'url_res' => 'https://firebasestorage.googleapis.com/v0/b/cube-firebase-c82bf.appspot.com/o/hockey-557219_1280.jpg?alt=media&token=e7e1f4fd-4a42-4329-a24e-a7bd94b71ae9', 'id_type_res' => 1, 'id_vis' => 1, 'id_createur' => 2, 'date_creation' => '2022-02-13 12:45:00', 'is_archive' => 0, 'id_etat' => 2 ],
            ['id' => 25, 'titre_res' => 'Stratégies pour investir dans l\'immobilier', 'contenu_res' => 'Apprenez comment investir dans l\'immobilier de manière intelligente, en choisissant les bons biens et en maximisant vos rendements.', 'url_res' => 'https://firebasestorage.googleapis.com/v0/b/cube-firebase-c82bf.appspot.com/o/icons-7752534_1280.jpg?alt=media&token=ffce9742-1f76-4034-8075-afad7e7cde7e', 'id_type_res' => 1, 'id_vis' => 1, 'id_createur' => 3, 'date_creation' => '2022-02-14 14:30:00', 'is_archive' => 1, 'id_etat' => 2 ],
            ['id' => 26, 'titre_res' => 'Les nouvelles technologies éducatives à explorer', 'contenu_res' => 'Découvrez comment les nouvelles technologies, telles que l\'intelligence artificielle et la réalité virtuelle, transforment l\'apprentissage et l\'enseignement.', 'url_res' => 'https://firebasestorage.googleapis.com/v0/b/cube-firebase-c82bf.appspot.com/o/jungle-1807476_1280.jpg?alt=media&token=54d679ee-a81d-4d38-8fca-c9ea55e747cc', 'id_type_res' => 1, 'id_vis' => 2, 'id_createur' => 1, 'date_creation' => '2022-02-15 15:20:00', 'is_archive' => 0, 'id_etat' => 2 ],
            ['id' => 27, 'titre_res' => 'Les bienfaits de l\'exercice physique pour la santé mentale', 'contenu_res' => 'Découvrez comment l\'exercice physique régulier peut aider à réduire le stress, l\'anxiété et la dépression, et à améliorer le bien-être mental.', 'url_res' => 'https://firebasestorage.googleapis.com/v0/b/cube-firebase-c82bf.appspot.com/o/laboratory-563423_1280.jpg?alt=media&token=c0622ab3-6cd6-47f8-b971-2a9dcfb5c573', 'id_type_res' => 1, 'id_vis' => 1, 'id_createur' => 2, 'date_creation' => '2022-02-16 16:40:00', 'is_archive' => 0, 'id_etat' => 2 ],
            ['id' => 28, 'titre_res' => 'Les secrets d\'une alimentation équilibrée', 'contenu_res' => 'Apprenez comment équilibrer votre alimentation pour obtenir tous les nutriments essentiels dont votre corps a besoin pour rester en bonne santé.', 'url_res' => 'https://firebasestorage.googleapis.com/v0/b/cube-firebase-c82bf.appspot.com/o/leaves-7597975_1280.jpg?alt=media&token=2eade9b7-6a8f-48fd-a738-e0c084ebacec', 'id_type_res' => 1, 'id_vis' => 1, 'id_createur' => 1, 'date_creation' => '2022-02-17 17:55:00', 'is_archive' => 0, 'id_etat' => 2 ],
            ['id' => 29, 'titre_res' => 'Les avantages du coaching en développement personnel', 'contenu_res' => 'Découvrez comment le coaching en développement personnel peut vous aider à atteindre vos objectifs, à améliorer vos compétences et à réaliser votre plein potentiel.', 'url_res' => 'https://firebasestorage.googleapis.com/v0/b/cube-firebase-c82bf.appspot.com/o/library-2507902_1280.jpg?alt=media&token=181799b3-7eea-4598-b7f9-8c52bb8936aa', 'id_type_res' => 1, 'id_vis' => 2, 'id_createur' => 3, 'date_creation' => '2022-02-18 09:30:00', 'is_archive' => 0, 'id_etat' => 2 ],
            ['id' => 30, 'titre_res' => 'Les grands artistes et mouvements artistiques du 20e siècle', 'contenu_res' => 'Explorez les œuvres et les mouvements artistiques qui ont marqué le 20e siècle, de l\'impressionnisme au surréalisme.', 'url_res' => 'https://firebasestorage.googleapis.com/v0/b/cube-firebase-c82bf.appspot.com/o/magic-cube-1976725_1280.jpg?alt=media&token=4504d4df-78b1-4e66-85e2-60476049044a', 'id_type_res' => 2, 'id_vis' => 1, 'id_createur' => 1, 'date_creation' => '2022-02-19 10:45:00', 'is_archive' => 0, 'id_etat' => 2 ],
            ['id' => 31, 'titre_res' => 'Les meilleures techniques de relaxation pour réduire le stress', 'contenu_res' => 'Apprenez des techniques simples de relaxation, telles que la respiration profonde et la méditation, pour réduire le stress et améliorer votre bien-être.', 'url_res' => 'https://firebasestorage.googleapis.com/v0/b/cube-firebase-c82bf.appspot.com/o/man-731900_1280.jpg?alt=media&token=15cf94dd-d35b-4fe7-a7d9-09a721d494a6', 'id_type_res' => 1, 'id_vis' => 1, 'id_createur' => 2, 'date_creation' => '2022-02-20 11:55:00', 'is_archive' => 0, 'id_etat' => 2 ],
            ['id' => 32, 'titre_res' => 'Les nouvelles technologies pour une mobilité durable', 'contenu_res' => 'Découvrez les dernières avancées technologiques dans le domaine de la mobilité durable, telles que les véhicules électriques et les transports en commun innovants.', 'url_res' => 'https://firebasestorage.googleapis.com/v0/b/cube-firebase-c82bf.appspot.com/o/nuts-8442168_1280.jpg?alt=media&token=bab03aab-8b0e-4934-8636-6ead5ff0c79b', 'id_type_res' => 1, 'id_vis' => 1, 'id_createur' => 3, 'date_creation' => '2022-02-21 13:10:00', 'is_archive' => 0, 'id_etat' => 2 ],
            ['id' => 33, 'titre_res' => 'Comment épargner et investir pour sa retraite', 'contenu_res' => 'Apprenez comment épargner et investir intelligemment pour assurer une retraite confortable et sécurisée.', 'url_res' => 'https://firebasestorage.googleapis.com/v0/b/cube-firebase-c82bf.appspot.com/o/pagoda-3863731_1280.jpg?alt=media&token=ec2481d8-b348-43b0-933a-136d53dfb07a', 'id_type_res' => 1, 'id_vis' => 2, 'id_createur' => 2, 'date_creation' => '2022-02-22 14:25:00', 'is_archive' => 0, 'id_etat' => 2 ],
            ['id' => 34, 'titre_res' => 'Les tendances émergentes dans le domaine de l\'enseignement supérieur', 'contenu_res' => 'Découvrez les nouvelles tendances et les défis émergents dans le domaine de l\'enseignement supérieur, de l\'enseignement en ligne à l\'apprentissage expérientiel.', 'url_res' => 'https://firebasestorage.googleapis.com/v0/b/cube-firebase-c82bf.appspot.com/o/people-2564045_1280.jpg?alt=media&token=c64d8342-b12f-4282-b54f-2aa68f9e2e85', 'id_type_res' => 1, 'id_vis' => 1, 'id_createur' => 1, 'date_creation' => '2022-02-23 15:40:00', 'is_archive' => 0, 'id_etat' => 2 ],
            ['id' => 35, 'titre_res' => 'Les bases de la médecine préventive', 'contenu_res' => 'Apprenez les principes fondamentaux de la médecine préventive pour maintenir une bonne santé tout au long de votre vie.', 'url_res' => 'https://firebasestorage.googleapis.com/v0/b/cube-firebase-c82bf.appspot.com/o/ps4-2326616_1280.jpg?alt=media&token=da728626-b159-485f-87fa-eb7170b61e1c', 'id_type_res' => 1, 'id_vis' => 1, 'id_createur' => 2, 'date_creation' => '2022-02-24 16:55:00', 'is_archive' => 0, 'id_etat' => 2 ],
            ['id' => 36, 'titre_res' => 'Les bienfaits du yoga pour le corps et l\'esprit', 'contenu_res' => 'Découvrez comment le yoga peut aider à renforcer le corps, à calmer l\'esprit et à améliorer votre bien-être général.', 'url_res' => 'https://firebasestorage.googleapis.com/v0/b/cube-firebase-c82bf.appspot.com/o/river-2951997_1280.jpg?alt=media&token=62b40027-09db-4dbe-b049-5aba008a1dfa', 'id_type_res' => 1, 'id_vis' => 2, 'id_createur' => 3, 'date_creation' => '2022-02-25 17:30:00', 'is_archive' => 0, 'id_etat' => 2 ],
            ['id' => 37, 'titre_res' => 'Les technologies émergentes dans le domaine de la santé', 'contenu_res' => 'Découvrez les dernières technologies émergentes qui révolutionnent le domaine de la santé, de la télémédecine aux dispositifs médicaux intelligents.', 'url_res' => 'https://firebasestorage.googleapis.com/v0/b/cube-firebase-c82bf.appspot.com/o/rowing-898008_1280.jpg?alt=media&token=dcb29fbf-f5ad-49cb-ae90-6297febda0f3', 'id_type_res' => 1, 'id_vis' => 1, 'id_createur' => 1, 'date_creation' => '2022-02-26 09:45:00', 'is_archive' => 0, 'id_etat' => 2 ],
            ['id' => 38, 'titre_res' => 'Les meilleures pratiques pour la gestion du stress au travail', 'contenu_res' => 'Apprenez des stratégies efficaces pour gérer le stress au travail, rester calme sous pression et maintenir un équilibre entre vie professionnelle et vie personnelle.', 'url_res' => 'https://firebasestorage.googleapis.com/v0/b/cube-firebase-c82bf.appspot.com/o/running-4782722_1280.jpg?alt=media&token=d6ce0d12-7819-4486-a8b3-432a65faf09d', 'id_type_res' => 1, 'id_vis' => 2, 'id_createur' => 2, 'date_creation' => '2022-02-27 10:15:00', 'is_archive' => 0, 'id_etat' => 2 ],
            ['id' => 39, 'titre_res' => 'Les secrets de la créativité artistique', 'contenu_res' => 'Découvrez des techniques pour stimuler votre créativité artistique et exprimer votre vision unique à travers l\'art.', 'url_res' => 'https://firebasestorage.googleapis.com/v0/b/cube-firebase-c82bf.appspot.com/o/smartphone-1894723_1280.jpg?alt=media&token=1ec30a33-9c74-4af7-a809-4176192853f9', 'id_type_res' => 2, 'id_vis' => 1, 'id_createur' => 1, 'date_creation' => '2022-02-28 11:30:00', 'is_archive' => 0, 'id_etat' => 2 ],
            ['id' => 40, 'titre_res' => 'Guide pratique pour la planification financière', 'contenu_res' => 'Apprenez à élaborer un plan financier solide pour atteindre vos objectifs à long terme, que ce soit pour l\'épargne, l\'investissement ou la retraite.', 'url_res' => 'https://firebasestorage.googleapis.com/v0/b/cube-firebase-c82bf.appspot.com/o/social-media-292988_1280.jpg?alt=media&token=140f1ecf-ef63-4d82-a6bc-d489872f0083', 'id_type_res' => 1, 'id_vis' => 1, 'id_createur' => 3, 'date_creation' => '2022-03-01 12:45:00', 'is_archive' => 0, 'id_etat' => 2 ],
            ['id' => 41, 'titre_res' => 'Les tendances émergentes dans le secteur de la technologie financière', 'contenu_res' => 'Découvrez les dernières tendances dans le secteur de la technologie financière, telles que les paiements sans contact, la blockchain et les robo-conseillers.', 'url_res' => 'https://firebasestorage.googleapis.com/v0/b/cube-firebase-c82bf.appspot.com/o/sunflowers-3526901_1280.jpg?alt=media&token=ca6c1b64-52c6-420f-b81e-57075139693d', 'id_type_res' => 1, 'id_vis' => 2, 'id_createur' => 2, 'date_creation' => '2022-03-02 13:55:00', 'is_archive' => 0, 'id_etat' => 2 ],
            ['id' => 42, 'titre_res' => 'Les nouvelles approches de l\'enseignement des sciences', 'contenu_res' => 'Explorez de nouvelles méthodes d\'enseignement des sciences pour engager les élèves et encourager la curiosité scientifique.', 'url_res' => 'https://firebasestorage.googleapis.com/v0/b/cube-firebase-c82bf.appspot.com/o/superbike-930715_1280.jpg?alt=media&token=c8f1f0e7-37c1-4f6f-bb2d-36f68a969cae', 'id_type_res' => 1, 'id_vis' => 1, 'id_createur' => 1, 'date_creation' => '2022-03-03 14:20:00', 'is_archive' => 0, 'id_etat' => 2 ],
            ['id' => 43, 'titre_res' => 'Les meilleures applications mobiles pour la santé et le bien-être', 'contenu_res' => 'Découvrez des applications mobiles innovantes pour vous aider à suivre votre santé, à gérer votre stress et à améliorer votre bien-être général.', 'url_res' => 'https://firebasestorage.googleapis.com/v0/b/cube-firebase-c82bf.appspot.com/o/teacher-3923074_1280.jpg?alt=media&token=5c0426fb-fdb4-49fc-82b6-f81f0bddfed4', 'id_type_res' => 1, 'id_vis' => 1, 'id_createur' => 2, 'date_creation' => '2022-03-04 15:30:00', 'is_archive' => 0, 'id_etat' => 2 ],
            ['id' => 44, 'titre_res' => 'Les principes de base de la méditation pour les débutants', 'contenu_res' => 'Apprenez les principes fondamentaux de la méditation pour débutants, y compris la posture, la respiration et la concentration.', 'url_res' => 'https://firebasestorage.googleapis.com/v0/b/cube-firebase-c82bf.appspot.com/o/telephone-3594206_1280.jpg?alt=media&token=8ef6717d-8a5b-46b8-9595-30b8848a5490', 'id_type_res' => 1, 'id_vis' => 2, 'id_createur' => 3, 'date_creation' => '2022-03-05 16:45:00', 'is_archive' => 0, 'id_etat' => 2 ],
            ['id' => 45, 'titre_res' => 'Les meilleures pratiques pour une alimentation saine et équilibrée', 'contenu_res' => 'Découvrez des conseils et des astuces pour adopter une alimentation saine et équilibrée, en incluant une variété de fruits, de légumes, de protéines et de grains entiers dans votre régime alimentaire.', 'url_res' => 'https://firebasestorage.googleapis.com/v0/b/cube-firebase-c82bf.appspot.com/o/tennis-7932067_1280.jpg?alt=media&token=ac62537c-8fcc-4f9a-9486-01634583ed74', 'id_type_res' => 1, 'id_vis' => 1, 'id_createur' => 1, 'date_creation' => '2022-03-06 17:55:00', 'is_archive' => 0, 'id_etat' => 2 ],
            ['id' => 46, 'titre_res' => 'Les dernières tendances en matière de fitness et d\'entraînement', 'contenu_res' => 'Découvrez les dernières tendances en matière de fitness et d\'entraînement, des entraînements haute intensité à la musculation fonctionnelle.', 'url_res' => 'https://firebasestorage.googleapis.com/v0/b/cube-firebase-c82bf.appspot.com/o/trading-8774164_1280.jpg?alt=media&token=690641a0-658d-425a-bd4f-97c8bfac6843', 'id_type_res' => 3, 'id_vis' => 2, 'id_createur' => 3, 'date_creation' => '2022-03-07 09:30:00', 'is_archive' => 0, 'id_etat' => 2 ],
            ['id' => 47, 'titre_res' => 'Les nouveaux développements dans le domaine de la biotechnologie', 'contenu_res' => 'Découvrez les derniers développements dans le domaine de la biotechnologie, de la médecine régénérative aux organismes génétiquement modifiés.', 'url_res' => 'https://firebasestorage.googleapis.com/v0/b/cube-firebase-c82bf.appspot.com/o/training-8122941_1280.jpg?alt=media&token=604ffc59-3467-488e-a384-e24529e1d27a', 'id_type_res' => 1, 'id_vis' => 1, 'id_createur' => 2, 'date_creation' => '2022-03-08 10:45:00', 'is_archive' => 0, 'id_etat' => 2 ],
            ['id' => 48, 'titre_res' => 'Les secrets d\'une gestion efficace du temps', 'contenu_res' => 'Apprenez des stratégies pour gérer votre temps de manière efficace, prioriser les tâches et éviter la procrastination.', 'url_res' => 'https://firebasestorage.googleapis.com/v0/b/cube-firebase-c82bf.appspot.com/o/tulips-1321025_1280.jpg?alt=media&token=ccc0d6fd-133b-49e0-ad53-42a90c018d41', 'id_type_res' => 1, 'id_vis' => 1, 'id_createur' => 1, 'date_creation' => '2022-03-09 11:30:00', 'is_archive' => 0, 'id_etat' => 2 ],
            ['id' => 49, 'titre_res' => 'Les dernières tendances en matière de design web', 'contenu_res' => 'Découvrez les dernières tendances en matière de design web, des mises en page créatives aux animations interactives.', 'url_res' => 'https://firebasestorage.googleapis.com/v0/b/cube-firebase-c82bf.appspot.com/o/woman-422546_1280.jpg?alt=media&token=86c701a6-12ae-446b-876e-011f2e208ab6', 'id_type_res' => 1, 'id_vis' => 2, 'id_createur' => 3, 'date_creation' => '2022-03-10 12:45:00', 'is_archive' => 0, 'id_etat' => 2 ],
            ['id' => 50, 'titre_res' => 'Les bases de la programmation informatique', 'contenu_res' => 'Apprenez les concepts fondamentaux de la programmation informatique, y compris les variables, les boucles et les fonctions.', 'url_res' => 'https://firebasestorage.googleapis.com/v0/b/cube-firebase-c82bf.appspot.com/o/word-cloud-639317_1280.png?alt=media&token=9f394e74-49f2-4937-bdae-958088f14908', 'id_type_res' => 1, 'id_vis' => 1, 'id_createur' => 2, 'date_creation' => '2022-03-11 13:50:00', 'is_archive' => 0, 'id_etat' => 2 ],
        ];

        foreach ($ressourceData as $ressource) {
            Ressource::create([
                'id' => $ressource['id'],
                'titre_res' => $ressource['titre_res'],
                'contenu_res' => $ressource['contenu_res'],
                'url_res' => $ressource['url_res'],
                'id_type_res' => $ressource['id_type_res'],
                'id_vis' => $ressource['id_vis'],
                'id_createur' => $ressource['id_createur'],
                'date_creation' => $ressource['date_creation'],
                'is_archive' => $ressource['is_archive'],
                'id_etat' => $ressource['id_etat']
            ]);
        }
    }
}


