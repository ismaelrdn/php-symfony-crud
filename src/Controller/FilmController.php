<?php

namespace App\Controller;

use App\Entity\Film;
use App\Form\FilmType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
//use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Request as Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FilmController extends AbstractController
{
    #[Route("/", name: "home")]
    public function home()
    {
        return $this->render('film/homeFilm.html.twig');
    }

    #[Route("/film/{id}", name: "getFilm")]
    public function getFilm(EntityManagerInterface $doctrine, $id)
    {
        $repo = $doctrine->getRepository(Film::class);
        $film = $repo->find($id);

        return $this->render("film/getFilm.html.twig", ["film" => $film]);
    }

    #[Route("/films", name: "listFilms")]
    public function listFilms(EntityManagerInterface $doctrine)
    {

        $repo = $doctrine->getRepository(Film::class);
        $films = $repo->findAll();

        return $this->render("film/listFilms.html.twig", ["films" => $films]);
    }

    #[Route("/film/{id}/edit", name: "editFilm")]
    public function editFilm(Request $request, EntityManagerInterface $doctrine, $id)
    {
        $repo = $doctrine->getRepository(Film::class);
        $film = $repo->find($id);

        $form = $this->createForm(FilmType::class, $film);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $doctrine->flush();

            $this->addFlash('success', 'Película modificada exitosamente');

            return $this->redirectToRoute('listFilms');
        }

        return $this->render('film/editFilm.html.twig', ['filmForm' => $form->createView()]);
    }



    #[Route("/newFilm", name: "newFilm")]
    public function newFilm(Request $request, EntityManagerInterface $doctrine)
    {
        $form = $this->createForm(type: FilmType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $film = $form->getData();
            $doctrine->persist($film);
            $doctrine->flush();

            $this->addFlash(type: 'success', message: 'Película añadida');

            return $this->redirectToRoute(route: "listFilms");
        }

        return $this->render("film/newFilm.html.twig", ["filmForm" => $form]);
    }

    #[Route("/film/{id}/delete", name: "deleteFilm", methods: ["DELETE", "POST"])]
    public function deleteFilm(EntityManagerInterface $doctrine, $id)
    {
        $repo = $doctrine->getRepository(Film::class);
        $film = $repo->find($id);

        if (!$film) {
            throw $this->createNotFoundException('La película no existe');
        }

        $doctrine->remove($film);
        $doctrine->flush();

        $this->addFlash('success', 'Película eliminada exitosamente');

        return $this->redirectToRoute('listFilms');
    }

    #[Route("/insert/films")]
    public function insertFilm(EntityManagerInterface $doctrine)
    {
        $film = new Film();
        $film->setTitle(title: "El padrino");
        $film->setYear(year: 1972);
        $film->setImage(image: "https://www.themoviedb.org/t/p/w440_and_h660_face/ApiEfzSkrqS4m1L5a2GwWXzIiAs.jpg");
        $film->setRating(rating: 8.7);
        $film->setDescription(description: "Don Vito Corleone, conocido dentro de los círculos del hampa como 'El Padrino', es el patriarca de una de las cinco familias que ejercen el mando de la Cosa Nostra en Nueva York en los años cuarenta. Don Corleone tiene cuatro hijos: una chica, Connie, y tres varones; Sonny, Michael y Fredo. Cuando el Padrino reclina intervenir en el negocio de estupefacientes, empieza una cruenta lucha de violentos episodios entre las distintas familias del crimen organizado.");


        $film1 = new Film();
        $film1->setTitle(title: "Cadena perpetua");
        $film1->setYear(year: 1994);
        $film1->setImage(image: "https://www.themoviedb.org/t/p/w440_and_h660_face/dc1fX265fZIIY5Hab8I7CdETyJy.jpg");
        $film1->setRating(rating: 8.7);
        $film->setDescription(description: "Acusado del asesinato de su mujer, Andrew Dufresne, tras ser condenado a cadena perpetua, es enviado a la prisión de Shawshank. Con el paso de los años conseguirá ganarse la confianza del director del centro y el respeto de sus compañeros presidiarios, especialmente de Red, el jefe de la mafia de los sobornos.");

        $film2 = new Film();
        $film2->setTitle(title: "La lista Schindler");
        $film2->setYear(year: 1993);
        $film2->setImage(image: "https://www.themoviedb.org/t/p/w440_and_h660_face/3Ho0pXsnMxpGJWqdOi0KDNdaTkT.jpg");
        $film2->setRating(rating: 8.6);
        $film->setDescription(description: "Oskar Schindler, un hombre de enorme astucia y talento para las relaciones públicas, organiza un ambicioso plan para ganarse la simpatía de los nazis. Después de la invasión de Polonia por los alemanes, consigue, gracias a sus relaciones con los nazis, la propiedad de una fábrica de Cracovia. Allí emplea a cientos de operarios judíos, cuya explotación le hace prosperar rápidamente. Su gerente, también judío, es el verdadero director en la sombra, pues Schindler no tiene el menor conocimiento industrial.");

        $film3 = new Film();
        $film3->setTitle(title: "El bueno, el feo y el malo");
        $film3->setYear(year: 1966);
        $film3->setImage(image: "https://www.themoviedb.org/t/p/w440_and_h660_face/vd9uj5KLlOrJnvNH03exLDlMAE0.jpg");
        $film3->setRating(rating: 8.5);
        $film->setDescription(description: "Durante la Guerra de Secesión, tres cazadores de recompensas se lanzan a la búsqueda de un tesoro que ninguno de los tres truhanes puede localizar sin la ayuda de los otros dos. Tuco sabe que el tesoro se encuentra en un cementerio, mientras que Joe conoce el nombre inscrito en la tumba que lo esconde. Mientras tanto, Sentenza no duda en matar a mujeres y niños para conseguir su meta. De esta forma, los tres hombres colaboran en apariencia, pero al final intentarán eliminarse mutuamente.");

        $film4 = new Film();
        $film4->setTitle(title: "El pianista");
        $film4->setYear(year: 2002);
        $film4->setImage(image: "https://www.themoviedb.org/t/p/w440_and_h660_face/mxfLOWnHnSlbdraKfzRn5mqoqk7.jpg");
        $film4->setRating(rating: 8.2);
        $film->setDescription(description: "");

        $film5 = new Film();
        $film5->setTitle(title: "Luces de la ciudad");
        $film5->setYear(year: 1931);
        $film5->setImage(image: "https://www.themoviedb.org/t/p/w440_and_h660_face/15bnFY02iqWB6jN0sjxsxMNrmWS.jpg");
        $film5->setRating(rating: 8.0);
        $film->setDescription(description: "Varsovia, 1939. El pianista polaco de origen judío Wladyslaw Szpilman (Adrien Brody) interpreta un tema de Chopin en la radio nacional de Polonia mientras la aviación alemana bombardea la capital. El régimen nazi ha invadido el país, y como hace en otros países invadidos, lleva a cabo la misma política con respecto a los judíos. Así Szpilman y toda su familia -sus padres, su hermano y sus dos hermanas- se ven obligados a dejar su casa y todo lo que les pertenece para trasladarse con miles de personas de origen judío al ghetto de Varsovia. Mientras Wladyslaw trabaja como pianista en un restaurante propiedad de un judío que colabora con los nazis, su hermano Henryk (Ed Stoppard) prefiere luchar contra los nazis. Pero tres años más tarde, los habitantes del ghetto son trasladados en trenes hacia campos de concentración.");

        $film6 = new Film();
        $film6->setTitle(title: "Top Gun Maverick");
        $film6->setYear(year: 2022);
        $film6->setImage(image: "https://www.themoviedb.org/t/p/w440_and_h660_face/AlWpEpQq0RgZIXVHAHZtFhEvRgd.jpg");
        $film6->setRating(rating: 8.2);
        $film->setDescription(description: "Después de más de 30 años de servicio como uno de los mejores aviadores de la Armada, Pete Maverick Mitchell se encuentra dónde siempre quiso estar, empujando los límites como un valiente piloto de prueba y esquivando el alcance en su rango, que no le dejaría volar emplazándolo en tierra. Cuando se encuentra entrenando a un destacamento de graduados de Top Gun para una misión especializada, Maverick se encuentra allí con el teniente Bradley Bradshaw, el hijo de su difunto amigo Goose");

        $film7 = new Film();
        $film7->setTitle(title: "Intocable");
        $film7->setYear(year: 2011);
        $film7->setImage(image: "https://www.themoviedb.org/t/p/w440_and_h660_face/edPWyHqknFuxFY3sdmC3LtJITWC.jpg");
        $film7->setRating(rating: 8.0);
        $film->setDescription(description: "Philippe, un aristócrata que se ha quedado tetrapléjico a causa de un accidente de parapente, contrata como cuidador a domicilio a Driss, un inmigrante de un barrio marginal recién salido de la cárcel. Aunque, a primera vista, no parece la persona más indicada, los dos acaban logrando que convivan Vivaldi y Earth Wind and Fire, la elocuencia y la hilaridad, los trajes de etiqueta y el chándal. Dos mundos enfrentados que, poco a poco, congenian hasta forjar una amistad tan disparatada, divertida y sólida como inesperada, una relación única en su especie de la que saltan chispas.");

        $film8 = new Film();
        $film8->setTitle(title: "Malditos bastardos");
        $film8->setYear(year: 2009);
        $film8->setImage(image: "https://www.themoviedb.org/t/p/w440_and_h660_face/dqu7nUtKTLdpM7DaJvD4zcSXhn1.jpg");
        $film8->setRating(rating: 7.8);
        $film->setDescription(description: "Segunda Guerra Mundial. Durante la ocupación de Francia por los alemanes, Shosanna Dreyfus presencia la ejecución de su familia por orden del coronel nazi Hans Landa. Ella consigue huir a París, donde adopta una nueva identidad como propietaria de un cine. En otro lugar de Europa, el teniente Aldo Raine adiestra a un grupo de soldados judíos, Los bastardos, para atacar objetivos concretos. Los hombres de Raine y una actriz alemana, que trabaja para los aliados, deben llevar a cabo una misión que hará caer a los jefes del Tercer Reich. El destino quiere que todos se encuentren bajo la marquesina de un cine donde Shosanna espera para vengarse.");

        $film9 = new Film();
        $film9->setTitle(title: "Gladiator");
        $film9->setYear(year: 2000);
        $film9->setImage(image: "https://www.themoviedb.org/t/p/w440_and_h660_face/90QFOG5zSN4cbrIVs4DL4ePAuA5.jpg");
        $film9->setRating(rating: 8.2);
        $film->setDescription(description: "En el año 180, el Imperio Romano domina todo el mundo conocido. Tras una gran victoria sobre los bárbaros del norte, el anciano emperador Marco Aurelio decide transferir el poder a Máximo, bravo general de sus ejércitos y hombre de inquebrantable lealtad al imperio. Pero su hijo Cómodo, que aspiraba al trono, no lo acepta y trata de asesinar a Máximo.");

        $doctrine->persist($film);
        $doctrine->persist($film1);
        $doctrine->persist($film2);
        $doctrine->persist($film3);
        $doctrine->persist($film4);
        $doctrine->persist($film5);
        $doctrine->persist($film6);
        $doctrine->persist($film7);
        $doctrine->persist($film8);
        $doctrine->persist($film9);

        $doctrine->flush();

        return new Response(content: "funciona!");
    }
};
