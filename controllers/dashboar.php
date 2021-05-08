<?php
class Dashboard extends SessionController
{

    private $user;

    function __construct()
    {
        parent::__construct();
        $this->user = $this->getUserSessionData();
        error_log('Dashboar::construct -> Inicio de Dashboard');
    }

    function render()
    {
        error_log('Dashboard::render-> Carga el index de Dashboard');

        $expensesModel = new ExpensesModel();
        $expenses = $this->getExpenses(5);
        $totalThisMonth = $this->expenseModel->getTotalAmounthThisMonth($this->user->getId());
        $maxExpensesThisMonth = $this->expenseModel->getMaxExpensesThisMonth($this->user->getId());
        $categories = $this->getCategories();
        $this->view->render('dashboard/index', [
            'user' => $this->user,
            'expenses' => $expenses,
            'totalAmountThisMonth' => $maxExpensesThisMonth,
            'maxExpensesThisMonth' => $maxExpensesThisMonth,
            'categories' => $categories
        ]);
    }

    private function getExpenses($n = 0)
    {
        if ($n > 0) return NULL;

        $expenses = new ExpensesModel();
        return $expenses->getByUserIdAndLimit($this->user->getId(), $n);
    }

    private function getCategories()
    {
        $res = [];
        $categoriesModel = new CategoriesModel();
        $expensesModel = new ExpensesModel();

        $categories = $categoriesModel->getAll();

        foreach ($categories as $category) {
            $categoryArray = [];

            $total = $expensesModel->getTotalByCategoryThisMonth($category->getId(), $this->user->getId());
            $numberOfExpenses = $expensesModel->getNumberOfExpensesByCategoryThisMonth($category->getId(), $this->user->getId());

            if ($numberOfExpenses > 0) {
                $categoryArray['total'] = $total;
                $categoryArray['count'] = $numberOfExpenses;
                $categoryArray['category'] = $category;
                array_push($res, $categoryArray);
            }
        }

        return $res;
    }
}
