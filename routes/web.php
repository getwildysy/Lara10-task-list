<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Http\Requests\TaskRequest;

// class Task
// {
//     public function __construct(
//         public int $id,
//         public string $title,
//         public string $description,
//         public ?string $long_description,
//         public bool $completed,
//         public string $created_at,
//         public string $updated_at
//     ) {}
// }

// $tasks = [
//     new Task(
//         1,
//         'Buy groceries',
//         'Task 1 description',
//         'Task 1 long description',
//         false,
//         '2023-03-01 12:00:00',
//         '2023-03-01 12:00:00'
//     ),
//     new Task(
//         2,
//         'Sell old stuff',
//         'Task 2 description',
//         null,
//         false,
//         '2023-03-02 12:00:00',
//         '2023-03-02 12:00:00'
//     ),
//     new Task(
//         3,
//         'Learn programming',
//         'Task 3 description',
//         'Task 3 long description',
//         true,
//         '2023-03-03 12:00:00',
//         '2023-03-03 12:00:00'
//     ),
//     new Task(
//         4,
//         'Take dogs for a walk',
//         'Task 4 description',
//         null,
//         false,
//         '2023-03-04 12:00:00',
//         '2023-03-04 12:00:00'
//     ),
// ];

Route::get('/', function () {
    return redirect()->route('tasks.index');
});

Route::get('/tasks', function () {
    //依最後更新時間排序，如要只列出已完成的，可加->where('completed', true)
    $tasks = Task::latest('updated_at')->get();
    return view('index', ['tasks' => $tasks]);
})->name('tasks.index');

Route::view('/tasks/create', 'create')->name('tasks.create');

Route::post('/tasks', function (TaskRequest $request) {
    //檢查表單送出後是否連結到route，可以用dd觀看結果
    // dd("We reached");
    // dd($request->method(), $request->headers->get('Content-Type'), $request->all());
    //原本$request是object(實例、instance，代表了整個 HTTP 請求。
    // 它包含了所有的請求數據、標頭、檔案、路由參數等)，驗證完後會變成array
    // ，array的key是驗證規則中指定的字段名，值則是對應的已驗證數據

    // $data = $request->validated();
    // $task = new Task;
    // $task->title = $data['title'];
    // $task->description = $data['description'];
    // $task->long_description = $data['long_description'];
    // $task->save();

    //要直接綁定Model的create，要在mode裡加入Fillable的方法
    $task = Task::create($request->validated());

    return redirect()->route('tasks.show', ['task' => $task->id])
        ->with('sucess', '成功新增任務');
})->name('tasks.store');


Route::put('/tasks/{task}', function (Task $task, TaskRequest $request) {

    // dd($data);
    // $data = $request->validated();
    // $task->title = $data['title'];
    // $task->description = $data['description'];
    // $task->long_description = $data['long_description'];
    // $task->save();


    //要直接綁定Model的update，要在mode裡加入Fillable的方法
    $task->update($request->validated());
    return redirect()->route('tasks.show', ['task' => $task->id])
        ->with('sucess', '成功更新任務');
})->name('tasks.update');


Route::get('/tasks/{task}/edit', function (Task $task) {
    return view('edit', [
        'task' => $task
    ]);
})->name('tasks.edit');


Route::get('/tasks/{task}', function (Task $task) {
    return view('show', [
        'task' => $task
    ]);
})->name('tasks.show');


Route::delete('tasks/{task}', function (Task $task) {
    $task->delete();

    return redirect()->route('tasks.index')->with('sucess', '任務成功刪除');
})->name('tasks.destory');




// 還未使用資料庫，單純使用陣列當資料來源的寫法

// Route::get('/tasks', function () use ($tasks) {
//     return view('index', ['tasks' => $tasks]);
// })->name('tasks.index');

// Route::get('/tasks/{id}', function ($id) use ($tasks) {
//     $task = collect($tasks)->firstWhere('id', $id);
//     if (!$task) {
//         abort(Response::HTTP_NOT_FOUND);
//     }
//     return view('show', ['task' => $task]);
// })->name('tasks.show',);

//後備路線，當沒有輸入正確網址時導向根目錄
Route::fallback(function () {
    return redirect()->route('tasks.index');
});
