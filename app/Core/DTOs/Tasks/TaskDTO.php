<?php

namespace App\Core\DTOs\Tasks;

use Carbon\Carbon;
use Illuminate\Support\Facades\Date;

class TaskDTO
{
    public string $title;
    public string $description;
    public string $status;
    public Carbon  $due_date;
    public int $category_id;
    public int $user_id;
    public int $project_id;

    public function __construct(
        string $title,
        string $description,
        string $status,
        Carbon $due_date,
        int $category_id,
        int $user_id,
        int $project_id
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->status = $status;
        $this->due_date = $due_date;
        $this->category_id = $category_id;
        $this->user_id = $user_id;
        $this->project_id = $project_id;
    }
}
