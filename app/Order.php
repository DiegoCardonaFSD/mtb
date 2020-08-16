<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
	protected $guarded = [];


	public function whenIsClient($id){
		return $this->where('user_id',$id);
	}

	public function roleCondition(){
		if(auth()->user() && auth()->user()->role == 'admin'){
			return $this;
		}
		return $this->whenIsClient(auth()->user()->id);
	}

}
