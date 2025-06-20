<?php

namespace App\Filament\Widgets;

use App\Models\Task;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class SeverityTaskOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $role = Auth::user()->role;

        return [
            Stat::make(
                'High Task',
                Task::query()
                    ->when($role == "developer", fn(Builder $query) => $query->where("user_id", Auth::id()))
                    ->whereHas('severity', fn(Builder $query) => $query->where("name", "High"))
                    ->count()
            ),
            Stat::make(
                'Medium Task',
                Task::query()
                    ->when($role == "developer", fn(Builder $query) => $query->where("user_id", Auth::id()))
                    ->whereHas('severity', fn(Builder $query) => $query->where("name", "Medium"))
                    ->count()
            ),
            Stat::make(
                'Low Task',
                Task::query()
                    ->when($role == "developer", fn(Builder $query) => $query->where("user_id", Auth::id()))
                    ->whereHas('severity', fn(Builder $query) => $query->where("name", "Low"))
                    ->count()
            ),
        ];
    }
}
