<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;
class AcceptAnswerController extends Controller
{
    public function accept(Answer $answer){
        $answer->question->bestAcceptAnswer($answer);
        return back();
    }
}
