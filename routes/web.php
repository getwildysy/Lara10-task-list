<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Task;

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
    $tasks = \App\Models\Task::latest('updated_at')->get();
    return view('index', ['tasks' => $tasks]);
})->name('tasks.index');

Route::view('/tasks/create', 'create')->name('tasks.create');

Route::post('/tasks', function (Request $request) {
    //檢查表單送出後是否連結到route，可以用dd觀看結果
    // dd("We reached");
    // dd($request->method(), $request->headers->get('Content-Type'), $request->all());

    //原本$request是object(實例、instance，代表了整個 HTTP 請求。
    // 它包含了所有的請求數據、標頭、檔案、路由參數等)，驗證完後會變成array
    // ，array的key是驗證規則中指定的字段名，值則是對應的已驗證數據
    $data = $request->validate(
        [
            'title' => 'required|max:255',
            'description' => 'required',
            'long_description' => 'nullable',
        ]
    );
    // dd($data);
    $task = new Task;
    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description = $data['long_description'];
    $task->save();

    return redirect()->route('tasks.show', ['id' => $task->id])
        ->with('sucess', '成功新增任務');
})->name('tasks.store');


Route::get('/tasks/{id}', function ($id) {
    $task = \App\Models\Task::findOrFail($id);
    return view('show', ['task' => $task]);
})->name('tasks.show');




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
