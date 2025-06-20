<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TaskResource\Pages;
use App\Filament\Resources\TaskResource\RelationManagers;
use App\Models\Task;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class TaskResource extends Resource
{
    protected static ?string $model = Task::class;
    protected static ?string $navigationLabel = 'Task Management';
    protected static ?string $navigationIcon = 'heroicon-o-document-plus';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('description')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('status_id')
                    ->relationship('status', 'name')
                    ->searchable()
                    ->preload(),
                Forms\Components\Select::make('severity_id')
                    ->relationship('severity', 'name')
                    ->searchable()
                    ->preload(),
                Forms\Components\Hidden::make('user_id')
                    ->default(Auth::id()),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status.name')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'Pending' => 'danger',
                        'In Progress' => 'warning',
                        'Completed' => 'success',
                        default => 'secondary',
                    }),
                Tables\Columns\TextColumn::make('severity.name')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'Low' => 'success',
                        'Medium' => 'warning',
                        'High' => 'danger',
                        default => 'secondary',
                    }),
                Tables\Columns\TextColumn::make('user.name')
                    ->label("Developer")
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status_id')
                    ->relationship('status', 'name')
                    ->searchable()
                    ->preload(),
                Tables\Filters\SelectFilter::make('severity_id')
                    ->relationship('severity', 'name')
                    ->searchable()
                    ->preload(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->visible(fn () => auth()->user()->can('updateStatus', Task::class)),
                    Tables\Actions\BulkAction::make('updateStatus')
                        ->label('Update Status')
                        ->form([
                            Forms\Components\Select::make('status_id')
                                ->label('Pilih Status Baru')
                                ->options(\App\Models\Status::pluck('name', 'id'))
                                ->required(),
                        ])
                        ->action(function (array $data, \Illuminate\Support\Collection $records) {
                            foreach ($records as $record) {
                                $record->update([
                                    'status_id' => $data['status_id'],
                                ]);
                            }
                        })
                        ->visible(fn () => auth()->user()->can('updateStatus', Task::class))
                        ->deselectRecordsAfterCompletion()
                        ->icon('heroicon-o-arrow-path')
                        ->color('success'),

                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTasks::route('/'),
            'create' => Pages\CreateTask::route('/create'),
            'edit' => Pages\EditTask::route('/{record}/edit'),
        ];
    }
}
