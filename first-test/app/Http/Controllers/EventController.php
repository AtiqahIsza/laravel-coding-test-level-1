<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{

    public function index(){

        return response()->json(Event::orderBy('start_at')->get());

    }

    public function getActiveEvent(){
        
        $currDate = Carbon::now()->format('Y-m-d');
        $currDateTime = Carbon::now()->format('Y-m-d H:i');

        return response()->json(Event::whereDate('start_at', $currDate)
            ->whereTime('start_at', '>=',  $currDateTime)
            ->whereTime('end_at', '<=',  $currDateTime)
            ->orderBy('start_at')
            ->get());

    }

    public function getOneEvent($id){

        return response()->json(Event::findOrFail($id));

    }

    public function createEvent(Request $request){

        $validatedData = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'slug' => ['required', 'string'],
            'start_at' => 'required',
            'end_at' => 'required',
        ]);

        if ($validatedData->fails()) {

            return response()->json([
                'success' => false,
                'message' => $validatedData->messages()->first(),
            ]);

        }

        $checkSlug = Event::where('slug', $request->slug)->first();
        if($checkSlug) {

            return response()->json([
                'success' => false,
                'message' => "Existed slug"
            ]);

        }else{

            $new = new Event();
            $success = $new->create($request->all());
            if($success){

                return response()->json($new);

            }else{

                return response()->json([
                    'success' => false,
                    'message' => "Failed to create a new event!"
                ]);

            }

        }

    }

    public function createUpdate(Request $request, $id){

        $validatedData = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'slug' => ['required', 'string'],
            'start_at' => 'required',
            'end_at' => 'required',
        ]);

        if ($validatedData->fails()) {

            return response()->json([
                'success' => false,
                'message' => $validatedData->messages()->first(),
            ]);

        }

        $checkSlug = Event::where('slug', $request->slug)->first();
        if($checkSlug) {

            return response()->json([
                'success' => false,
                'message' => "Existed slug"
            ]);

        }else{

            $checkEvent = Event::find($id);
            if(empty($checkEvent)){

                $new = new Event();
                $success = $new->create($request->all());
                if($success){

                    return response()->json($new);

                }else{

                    return response()->json([
                        'success' => false,
                        'message' => "Failed to create a new event!"
                    ]);
                }

            }else{

                $success = $checkEvent->save($request->all());
                if($success){

                    return response()->json($checkEvent);
                    
                }else{

                    return response()->json([
                        'success' => false,
                        'message' => "Failed to update the event!"
                    ]);

                }

            }

        }

    }

    public function updateEvent(Request $request, $id){

        $validatedData = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'slug' => ['required', 'string'],
            'start_at' => 'required',
            'end_at' => 'required',
        ]);

        if ($validatedData->fails()) {

            return response()->json([
                'success' => false,
                'message' => $validatedData->messages()->first(),
            ]);

        }

        $checkSlug = Event::where('slug', $request->slug)->first();
        if($checkSlug) {

            return response()->json([
                'success' => false,
                'message' => "Existed slug"
            ]);

        }else{

            $checkEvent = Event::find($id);
            if($checkEvent){

                $success = $checkEvent->save($request->all());
                if($success){

                    return response()->json($checkEvent);
                    
                }else{

                    return response()->json([
                        'success' => false,
                        'message' => "Failed to update the event!"
                    ]);

                }

            }
            
        }

    }

    public function deleteEvent($id){
        
        $deletedEvent = Event::findOrFail($id);
        $deletedEvent->delete();

        return response()->json(Event::orderBy('start_at')->get());

    }
}
