<?php
/*
328sdev/diner2/controllers/controller.php
*/

class Controller
{
    private $_f3;

    function __construct($f3)
    {
        $this->_f3 = $f3;
    }

    function home()
    {
        $view = new Template();
        echo $view->render('views/home.html');
    }

    function order()
    {
        //if the form has been submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //get food from POST array
            $food = $_POST['food'];
            $this->_f3->set('userFood', $food);
            //$f3->set('userFood'; $food);

            //get meal from POST array
            //option 1
            $meal = "";
            if (isset($_POST['meal'])) {
                $meal = $_POST['meal'];
            }

            //option 2
            //$meal = isset($_POST['meal']) ? $_POST['meal'] : "";

            //add the users meal to the hive
            $this->_f3->set('userMeal', $meal);

            //if data is valid
            if (Validation::validFood($food)) {
                //create a bew Irder object
                $order = new Order();

                //Add the food to the order
                $order->setFood($food);

                //store the order in session array
                $_SESSION['order'] = $order;
                //$_SESSION['food'] = $food;
            } //if data is not valid -> store an error message
            else {
                $this->_f3->set('errors["food"]', 'Please enter a food, at least 2 characters');
            }

            if (Validation::validMeal($meal)) {
                //store in session array
                $_SESSION['order']->setMeal($meal);
                //$_SESSION['meal'] = $meal;
                //$_SESSION['meal'] = $_POST['meal'];
            } //if data is not valid -> store an error message
            else {
                $this->_f3->set('errors["meal"]', 'Please select a meal');
            }

            //redirect to order2 route if there are no errors
            if (empty($this->_f3->get('errors'))) {
                header('location: order2');
            }
        }

        //add meal data to hive
        $this->_f3->set('meals', DataLayer::getMeals());
        //$f3->set('meals', getMeals());

        $view = new Template();
        echo $view->render('views/orderForm1.html');
        //echo '<h1>Order Page</h1>';
    }

    function order2(){
        //add condiment data to hive
        //$f3->set('condiments', getCondiments());
        $this->_f3->set('condiments', DataLayer::getCondiments());

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $conds = "";
            if(empty($_POST['conds'])) {
                $conds = "none selected";
            }
            else {
                $conds = implode(", ", $_POST['conds']);
            }
            $_SESSION['order']->setCondiments($conds);
            //$_SESSION['conds'] = $conds;

            header("location: summary");
        }

        $view = new Template();
        echo $view->render('views/orderForm2.html');

    }

    function summary(){
        //before changing to above if statement:

        //$_SESSION['conds'] = implode(", ", $_POST['conds']);

        $view = new Template();
        echo $view->render('views/orderSummary.html');
    }
}
