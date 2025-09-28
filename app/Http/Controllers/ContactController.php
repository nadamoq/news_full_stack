<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends Controller
{
    //
    public function create(){
        return response()->view('user-flow.contact');
    }
    public function store(StoreContactRequest $request){
       
       $message=Contact::create($request->validated());
       return response()->json(['message'=>$message?'sent ! thank you':'error'],
       $message?Response::HTTP_CREATED:Response::HTTP_BAD_REQUEST);

    }public function index(){

        $messages =Contact::latest('created_at')->paginate();
        return response()->view('cms.users.contact',['contacts'=>$messages]);
    }
    public function destroy($contact){

        $deleted=Contact::destroy($contact);
        return response()->json(['message'=>$deleted?'deleted successfuly':'error'],
        $deleted?Response::HTTP_OK:Response::HTTP_BAD_REQUEST);
    }
   
}
