<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contactus extends Model
{
    protected $fillable = [
      'name',
      'email',
      'phone',
      'subject',
      'message',



    ]; 
    
    public function markAsRead(){
        $this->update(['read_at'=>now()]);
    }

}
