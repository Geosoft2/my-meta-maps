<?php

class Search extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'Search';
	
	/**
	 * Tell the ORM to use timestamp fields or not. 
	 * 
	 * @var boolean
	 */
	public $timestamps = false;

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array();

}
?>