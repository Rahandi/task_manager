<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use Auth;
// import our models
use App\Project;
use App\Task;
use App\TaskFiles;
use App\User; 
use App\AssignTask;

// use Illuminate\Support\Facades\Input; 


class TaskMhsController extends Controller
{
    public function index()
    {
        // dd() ;
        // $tasks = Task::all() ;  // retrieve all Tasks
        $users =  User::all() ; 
        // $tasks  = Task::orderBy('created_at', 'desc')->paginate(10) ;  // Paginate Tasks 
        $id = Auth::user()->id;
        // $projects = Project::all() ;
        $tasks = Task::where('user_id', $id)->orderBy('created_at', 'desc')->paginate(10);
        // dd($tks) ;
        // pass is_overdue
        // $today = \Carbon\Carbon::now() ; // not used
        // dd ($today) ;
        // return view('task.tasks')->with('tasks', $tasks) 
        //                          ->with('users', $users ) ;
        return view('task_mhs.index')->with('tasks', $tasks)
        ->with('users', $users ) ;
                                //  ->with('today', $today) ;
    }

    public function assign_task(Request $request){
        
        // dd($request->all());
        $id_user = Auth::user()->id;
        
        if( $request->hasFile('photos') ) {
                    
            foreach ($request->photos as $file) {
                
               
                $join = 'submit';
                $filename = strtr( pathinfo(  $join. '_' . $file->getClientOriginalName(), PATHINFO_FILENAME) , [' ' => '', '.' => ''] ) . '.' . pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
                
                    $file->move('images/submit_file',$filename);
                
                
                
                // save to DB
                AssignTask::create([
                    'task_id'  => $request->id_task, // newly created ID
                    'filename' => $filename, // For Regular Public Images
                    'id_user' => $id_user,
                    //'filename' => $filename[1]  // [0] => public, [1] => wKZsF9ltDSNj82ynh.png FOR STORAGE
                ]);
            }
        }
        $task_complete = Task::find($request->id_task) ;
        $task_complete->completed = 1;
        $task_complete->save() ;
        Session::flash('success', 'Submit Success') ;
        return redirect()->route('task_mhs.show') ; 
    }

    public function view($id)  {
        // dd($id);
        $images_set = [] ;
        $files_set = [] ;
        $images_array = ['png','gif','jpeg','jpg'] ;
        // get task file names with task_id number
        $taskfiles = TaskFiles::where('task_id', $id )->get() ;

        $submit = AssignTask::where('id_user', Auth::user()->id )->get() ;
        // dd($submit);
        if ( count($taskfiles) > 0 ) { 
            foreach ( $taskfiles as $taskfile ) {

                // explode the filename into 2 parts: the filename and the extension
                $taskfile = explode(".", $taskfile->filename ) ;
                // store images only in one array
                // $taskfile[0] = filename
                // $taskfile[1] = jpg
                // check if extension is a image filetype
                if ( in_array($taskfile[1], $images_array ) ) 
                    $images_set[] = $taskfile[0] . '.' . $taskfile[1] ;
                    // if not an image, store in files array
                else
                    $files_set[] = $taskfile[0] . '.' . $taskfile[1]; 
            }
        }



        $task_view = Task::find($id) ;

        // Get task created and due dates
        $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $task_view->created_at);
        $to   = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $task_view->duedate ); // add here the due date from create task

        $current_date = \Carbon\Carbon::now();
 
        // Format dates for Humans
        $formatted_from = $from->toRfc850String();  
        $formatted_to   = $to->toRfc850String();

        // Get Difference between current_date and duedate = days left to complete task
        // $diff_in_days = $from->diffInDays($to);
        $diff_in_days = $current_date->diffInDays($to);

        // Check for overdue tasks
        $is_overdue = ($current_date->gt($to) ) ? true : false ;

        // $task_view->project->project_name   will output the project name for this specific task
        // to populate the right sidebar with related tasks
        $projects = Project::all() ;
        return view('task_mhs.view')
            ->with('task_view', $task_view) 
            ->with('projects', $projects) 
            ->with('taskfiles', $taskfiles)
            ->with('diff_in_days', $diff_in_days )
            ->with('is_overdue', $is_overdue) 
            ->with('formatted_from', $formatted_from ) 
            ->with('formatted_to', $formatted_to )
            ->with('images_set', $images_set)
            ->with('files_set', $files_set) 
            ->with('submit', $submit) ;

    }

}
