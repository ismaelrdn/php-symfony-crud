<?php

namespace App\DataFixtures;

use App\Entity\Film;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class Filmfixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

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

        $manager->persist($film);
        $manager->persist($film1);
        $manager->persist($film2);
        $manager->persist($film3);


        $manager->flush();
    }
}
