<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Models\TaskStatus;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $task = new Task();
        $taskStatus = new TaskStatus();

        $sortField = isset($_GET['sort_field']) ? $_GET['sort_field'] : null;
        $sortFields = [
            'status',
            'priority',
            'created_at',
        ];

        $statuses = $taskStatus->all();
        if ($statuses->isEmpty()) {
            $statuses = ['new', 'in progress', 'done'];
            foreach ($statuses as $status) {
                $taskStatus->create(['title' => $status]);
            }
        }

        if (isset($sortField) && in_array($sortField, $sortFields)) {
            $tasks = $task->all()->sortBy($sortField);
        } else {
            $tasks = $task->all();
        }

        return view('tasks', compact('statuses', 'tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function store(Request $request)
    {
        $task = new Task;
//        dd($request->all());
        $task->create($request->all());
        return redirect('/api/tasks');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
