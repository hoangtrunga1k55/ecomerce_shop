<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table='product';
    private $id;
    private $name;
    private $price;
    private $stock;
    private $descripiton;
    private $img;
    private $id_feature_latest;
    private $id_menu;
    private $active;

//    /**
//     * Product constructor.
//     * @param $id
//     * @param $name
//     * @param $price
//     * @param $stock
//     * @param $descripiton
//     * @param $img
//     * @param $id_feature_latest
//     * @param $id_menu
//     * @param $active
//     */
//    public function __construct($id, $name, $price, $stock, $descripiton, $img, $id_feature_latest, $id_menu, $active)
//    {
//        $this->id = $id;
//        $this->name = $name;
//        $this->price = $price;
//        $this->stock = $stock;
//        $this->descripiton = $descripiton;
//        $this->img = $img;
//        $this->id_feature_latest = $id_feature_latest;
//        $this->id_menu = $id_menu;
//        $this->active = $active;
//    }
//
//
//    /**
//     * @return string
//     */
//    public function getTable(): string
//    {
//        return $this->table;
//    }
//
//
//    /**
//     * @return mixed
//     */
//    public function getId()
//    {
//        return $this->id;
//    }
//
//    /**
//     * @param mixed $id
//     */
//    public function setId($id): void
//    {
//        $this->id = $id;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getName()
//    {
//        return $this->name;
//    }
//
//    /**
//     * @param mixed $name
//     */
//    public function setName($name): void
//    {
//        $this->name = $name;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getPrice()
//    {
//        return $this->price;
//    }
//
//    /**
//     * @param mixed $price
//     */
//    public function setPrice($price): void
//    {
//        $this->price = $price;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getStock()
//    {
//        return $this->stock;
//    }
//
//    /**
//     * @param mixed $stock
//     */
//    public function setStock($stock): void
//    {
//        $this->stock = $stock;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getDescripiton()
//    {
//        return $this->descripiton;
//    }
//
//    /**
//     * @param mixed $descripiton
//     */
//    public function setDescripiton($descripiton): void
//    {
//        $this->descripiton = $descripiton;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getImg()
//    {
//        return $this->img;
//    }
//
//    /**
//     * @param mixed $img
//     */
//    public function setImg($img): void
//    {
//        $this->img = $img;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getIdFeatureLatest()
//    {
//        return $this->id_feature_latest;
//    }
//
//    /**
//     * @param mixed $id_feature_latest
//     */
//    public function setIdFeatureLatest($id_feature_latest): void
//    {
//        $this->id_feature_latest = $id_feature_latest;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getIdMenu()
//    {
//        return $this->id_menu;
//    }
//
//    /**
//     * @param mixed $id_menu
//     */
//    public function setIdMenu($id_menu): void
//    {
//        $this->id_menu = $id_menu;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getActive()
//    {
//        return $this->active;
//    }
//
//    /**
//     * @param mixed $active
//     */
//    public function setActive($active): void
//    {
//        $this->active = $active;
//    }






    public function Category(){
        return $this->belongsTo('App\Category','id_category','id');
    }
    public function Feature(){
        return $this->belongsTo('App\Feature','id_feature_latest','id');
    }
    public function Latest(){
        return $this->belongsTo('App\Latest','id_feature_latest','id');
    }
    public function Size(){
        return $this->belongsToMany('App\Size', 'product_size', 'idProduct', 'idSize');
    }
    public function Order(){
        return $this->hasMany('App\Order','idProduct','id');
    }
}
