<?php


class Category
{
    public static function getCategory(){
        $db = new DB();
        return $db->queryAssocNoP("SELECT * FROM category");
    }

    public static function checkCategory($category){
        $cat2 = Category::getCategory();
        foreach ($cat2 as $value){
            if ($value['id']==$category){
                return true;
                break;
            }
        }
        return false;
    }
}