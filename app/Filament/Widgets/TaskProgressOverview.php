<?php

namespace App\Filament\Widgets;

use App\Models\Task;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class TaskProgressOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $role = Auth::user()->role;
        return [
            Stat::make(
                'All Task',
                Task::query()->when( $role == "developer", fn(Builder $query) => $query->where("user_id", Auth::id()))->count()
            ),
            Stat::make(
                'Completed Task',
                Task::query()
                    ->when( $role == "developer", fn(Builder $query) => $query->where("user_id", Auth::id()))
                    ->whereHas('status', fn(Builder $query) => $query->where("name", "Completed"))
                    ->count()
            ),
            Stat::make(
                'In Progress Task',
                Task::query()
                    ->when( $role == "developer", fn(Builder $query) => $query->where("user_id", Auth::id()))
                    ->whereHas('status', fn(Builder $query) => $query->where("name", "In Progress"))
                    ->count()
            ),
            Stat::make(
                'Pending Task',
                Task::query()
                    ->when( $role == "developer", fn(Builder $query) => $query->where("user_id", Auth::id()))
                    ->whereHas('status', fn(Builder $query) => $query->where("name", "Pending"))
                    ->count()
            ),
        ];
    }
}
