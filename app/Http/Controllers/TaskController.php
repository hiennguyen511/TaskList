<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\CreateTaskRequest;
use App\Http\Requests\Task\ListTaskRequest;
use App\Http\Requests\Task\ReorderTasksRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Services\ProjectService;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskController extends Controller
{
    //
    protected ?TaskService $taskService = null;
    public function __construct(TaskService $taskService){
        $this->taskService = $taskService;
    }
    public function index(){
        $project = (new ProjectService())->getAll();
        return view("tasks.index", ['projects' => $project]);
    } 
    public function list(ListTaskRequest $request): JsonResponse{
        $tasks = $this->taskService->list($request->get('project_id'));
        return response()->json([
            'success' => true,
            'tasks' => $tasks,
            'massage' => "Tasks retrieved successfull",
        ]);
    }
    public function store(CreateTaskRequest $request): JsonResponse
    {
        $this->taskService->store($request->all());

        return response()->json([
            'success' => true,
            'message' => "Task created successfully.",
        ], 201);
    }

    public function get(int $id): JsonResponse
    {
        $task = $this->taskService->getById($id);

        if ($task) {
            return response()->json([
                'success' => true,
                'task' => $task,
                'message' => "Task retrieved successfully.",
            ]); // 200
        } else {
            return response()->json([
                'success' => false,
                'message' => "Task not found!",
            ], 404);
        }
    }

    public function update(UpdateTaskRequest $request, int $id): JsonResponse
    {
        $this->taskService->update($id, $request->all());

        return response()->json([
            'success' => true,
            'message' => "Task updated successfully.",
        ], 201);
    }

    public function delete(int $id): JsonResponse
    {
        $this->taskService->delete($id);

        return response()->json([
            'success' => true,
            'message' => "Task deleted successfully.",
        ], 201);
    }

    public function reorder(ReorderTasksRequest $request): JsonResponse
    {
        $this->taskService->reorder(
            $request->get('project_id'),
            $request->get('start'),
            $request->get('end')
        );

        return response()->json([
            'success' => true,
            'message' => "Tasks reordered successfully.",
        ], 201);
    }
}
