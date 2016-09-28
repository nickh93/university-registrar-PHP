<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Student.php";
    require_once __DIR__."/../src/Course.php";

    $app = new Silex\Application();

    $server = "mysql:host=localhost:8889;dbname=registrar";
    $username = "root";
    $password = "root";
    $DB = new PDO($server, $username, $password);

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->register(new Silex\Provider\TwigServiceProvider(), array("twig.path" => __DIR__."/../views"));

    $app->get("/", function() use ($app) {
        return $app["twig"]->render("index.html.twig");
    });

    $app->get("/courses", function() use ($app) {
        return $app["twig"]->render("courses.html.twig", array("courses" => Course::getAll()));
    });

    $app->post("/courses", function() use ($app) {
        $course_name = $_POST["c_name"];
        $course_number = $_POST["c_number"];
        $new_course = new Course($course_name, $course_number);
        $new_course->save();
        return $app["twig"]->render("courses.html.twig", array("courses" => Course::getAll()));
    });

    return $app;
 ?>
