<?php
class JoinExpensesCategoriesModel extends Model
{
    private $expenseId;
    private $title;
    private $amount;
    private $categoriyId;
    private $date;
    private $nameCategory;
    private $color;

    public function __construct()
    {
        parent::__construct();
    }

    public function getAll($userid)
    {
        $items = [];
        try {
            $query = $this->prepare("SELECT expenses.id as expense_id. title, category_id, amount, date, id_user, categories.id, name, color FROM expenses INNER JOIN categories WHERE expenses.category_id = categories.id AND expenses.id_user = :userid ORDER BY date");
            $query->execute([
                'userid' => $userid
            ]);

            while ($p = $query->fetch(PDO::FETCH_ASSOC)) {
                $item = new JoinExpensesCategoriesModel();
                $item->from($p);
                array_push($items, $item);
            }
            return $items;
        } catch (PDOException $e) {
            return NULL;
        }
    }

    public function from($array)
    {
        $this->expenseId    = $array['expense_id'];
        $this->title        = $array['title'];
        $this->amount       = $array['amount'];
        $this->categoriyId  = $array['category_id'];
        $this->date         = $array['date'];
        $this->nameCategory = $array['name'];
        $this->color        = $array['color'];
        $this->userId       = $array['id_user'];
    }

    public function toArray()
    {
        $array = [];

        $array['id']            = $this->expenseId;
        $array['title']         = $this->title;
        $array['category_id']   = $this->categoriyId;
        $array['amount']        = $this->amount;
        $array['date']          = $this->date;
        $array['id_user']       = $this->userId;
        $array['name']          = $this->nameCategory;
        $array['color']         = $this->color;

        return $array;
    }

    // ----- Geters -----
    public function  getExpenseId()
    {
        return $this->expenseId;
    }
    public function  getTitle()
    {
        return $this->title;
    }
    public function  getAmount()
    {
        return $this->amount;
    }
    public function  getCategoriyId()
    {
        return $this->categoriyId;
    }
    public function  getDate()
    {
        return $this->date;
    }
    public function  getUserId()
    {
        return $this->userId;
    }
    public function  getNameCategory()
    {
        return $this->nameCategory;
    }
    public function  getColor()
    {
        return $this->color;
    }

    // ----- Seters -----
    public function  setExpenseId($value)
    {
        $this->expenseId = $value;
    }
    public function  setTitle($value)
    {
        $this->title = $value;
    }
    public function  setAmount($value)
    {
        $this->amount = $value;
    }
    public function  setCategoriyId($value)
    {
        $this->categoriyId = $value;
    }
    public function  setDate($value)
    {
        $this->date = $value;
    }
    public function  setUserId($value)
    {
        $this->userId = $value;
    }
    public function  setNameCategory($value)
    {
        $this->nameCategory = $value;
    }
    public function  setColor($value)
    {
        $this->color = $value;
    }
}
