<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SeverityResource\Pages;
use App\Filament\Resources\SeverityResource\RelationManagers;
use App\Models\Severity;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SeverityResource extends Resource
{
    protected static ?string $model = Severity::class;
    protected static ?string $navigationLabel = 'Severity Management';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('tasks_count')
                    ->label("Task")
                    ->counts('tasks')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListSeverities::route('/'),
            'create' => Pages\CreateSeverity::route('/create'),
            'edit' => Pages\EditSeverity::route('/{record}/edit'),
        ];
    }
}
