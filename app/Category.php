<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 6/12/2019
 * Time: 9:49 AM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $fillable = ['title', 'parent_id'];


    /**
     * Get the index name for the model.
     *
     * @return string
     */
    public function childs()
    {
        return $this->hasMany('App\Category', 'parent_id', 'id');
    }
}