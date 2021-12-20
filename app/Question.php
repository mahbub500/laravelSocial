<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    // Mass Assignment
    protected $fillable = ['title','body'];
    
    // one to many(inverse)
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function getUrlAttribute(){
        return route('questions.show',  $this->slug);
    }
    
    public function setTitleAttribute($value){
        $this->attributes['title']=$value;
        $this->attributes['slug']=str_slug($value);
    }
    
    public function getCreateDateAttribute(){
        return $this->created_at->diffForHumans();
    }
    
    public function getStatusAttribute(){
        if($this-> answers_count > 0){
            if($this->best_answer_id){
                return "answered-accepted";
            }
            return "answered";
        }
        return "unanswered";
    }
    
    public function getBodyHtmlAttribute(){
        return \Parsedown::instance()->text($this->body);
    }
    
    public function Answers(){
        return $this->hasMany(Answer::class);
    }
    
    public function bestAcceptAnswer(Answer $answer){
        $this->best_answer_id = $answer->id;
        $this->save();
    }
}
