<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RegexField.
 *
 * @author  The scaffold-interface created at 2018-02-27 02:24:29pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class RegexField extends Model
{

    protected $table      = 'regex_field';
    public $timestamps    = false;
    protected $primaryKey = 'field_id';

}
