<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Output\ConsoleOutput;

class EventController extends Controller
{
    public function index()
    {

        $events = Event::latest()->paginate(5);
    
        return view('event.index',compact('events'))
            ->with('i', (request()->input('page', 1) - 1) * 5);

    }

    public function create()
    {

        $out = new ConsoleOutput();
        $out->writeln("YOU ARE IN create()");
        return view('event.create');

    }

    public function store(Request $request)
    {

        $validatedData = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'slug' => ['required', 'string'],
            'start_at' => 'required',
            'end_at' => 'required',
        ])->validate();

        $checkSlug = Event::where('slug', $request->slug)->first();
        if($checkSlug) {

            return redirect()->route('viewAll')->with('failed','Slug already exist');


        }else{

            $new = new Event();
            $success = $new->create($request->all());
            if($success){

                return redirect()->route('viewAll')->with('success','Event created successfully');

            }else{

                return redirect()->route('viewAll')->with('failed','Event failed to create');

            }

        }

    }

    public function show(Request $request)
    {
        
        $out = new ConsoleOutput();
        $out->writeln("YOU ARE IN show()");
        $events = Event::find($request->id);
        return view('event.show',compact('events'));

    }
    

    public function edit(Request $request)
    {

        $events = Event::find($request->id);
        return view('event.edit',compact('events'));

    }

    public function update(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'slug' => ['required', 'string'],
            'start_at' => 'required',
            'end_at' => 'required',
        ])->validate();
      
        $checkSlug = Event::where('slug', $request->slug)->where('id', '!=', $request->id)->first();
        if($checkSlug) {

            return redirect()->route('viewAll')->with('failed','Slug already exist!');

        }else{

            $events = Event::find($request->id);
            $success = $events->update($request->all());
            if($success){

                return redirect()->route('viewAll')->with('success','Event updated successfully');

            }else{

                return redirect()->route('viewAll')->with('failed','Event failed to update');

            }
        }
    }

    public function destroy(Request $request)
    {
        $deletedEvent = Event::findOrFail($request->id);
        $deletedEvent->delete();
        return redirect()->route('viewAll')->with('success','Event deleted successfully');
    }

    
    public function search(Request $request)
    {
        $search = $request->get('search');
        if($search != ''){

            $events = Event::where('name','like', '%' .$search. '%')->paginate(5);
            $events->appends(array('search'=> $request->input('search')));

            
            if(count($events )>0){

                return view('event.index',compact('events'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);;

            }

            return redirect()->route('viewAll')->with('failed','No results Found');
        }
    }
}
